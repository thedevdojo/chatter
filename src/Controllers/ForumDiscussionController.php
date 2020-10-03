<?php

namespace MeinderA\Forum\Controllers;

use Auth;
use Event;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MeinderA\Forum\Models\Models;
use Illuminate\Routing\Controller as Controller;
use MeinderA\Forum\Events\ForumAfterNewDiscussion;
use MeinderA\Forum\Events\ForumBeforeNewDiscussion;

class ForumDiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*$total = 10;
        $offset = 0;
        if ($request->total) {
            $total = $request->total;
        }
        if ($request->offset) {
            $offset = $request->offset;
        }
        $discussions = Models::discussion()->with('user')->with('post')->with('postsCount')->with('category')->orderBy('created_at', 'ASC')->take($total)->offset($offset)->get();*/

        // Return an empty array to avoid exposing user data to the public.
        // This index function is not being used anywhere.
        return response()->json([]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Models::category()->all();

        return view('forum::discussion.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['body_content' => strip_tags($request->body)]);

        $validator = Validator::make($request->all(), [
            'title'               => 'required|min:5|max:255',
            'body_content'        => 'required|min:10',
            'forum_category_id' => 'required',
         ],[
			'title.required' =>  trans('forum::alert.danger.reason.title_required'),
			'title.min'     => [
				'string'  => trans('forum::alert.danger.reason.title_min'),
			],
			'title.max' => [
				'string'  => trans('forum::alert.danger.reason.title_max'),
			],
			'body_content.required' => trans('forum::alert.danger.reason.content_required'),
			'body_content.min' => trans('forum::alert.danger.reason.content_min'),
			'forum_category_id.required' => trans('forum::alert.danger.reason.category_required'),
		]);
        

        Event::fire(new ForumBeforeNewDiscussion($request, $validator));
        if (function_exists('forum_before_new_discussion')) {
            forum_before_new_discussion($request, $validator);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user_id = Auth::user()->id;

        if (config('forum.security.limit_time_between_posts')) {
            if ($this->notEnoughTimeBetweenDiscussion()) {
                $minutes = trans_choice('forum::messages.words.minutes', config('forum.security.time_between_posts'));
                $forum_alert = [
                    'forum_alert_type' => 'danger',
                    'forum_alert'      => trans('forum::alert.danger.reason.prevent_spam', [
                                                'minutes' => $minutes,
                                            ]),
                    ];

                return redirect('/'.config('forum.routes.home'))->with($forum_alert)->withInput();
            }
        }

        // *** Let's gaurantee that we always have a generic slug *** //
        $slug = str_slug($request->title, '-');

        $discussion_exists = Models::discussion()->where('slug', '=', $slug)->withTrashed()->first();
        $incrementer = 1;
        $new_slug = $slug;
        while (isset($discussion_exists->id)) {
            $new_slug = $slug.'-'.$incrementer;
            $discussion_exists = Models::discussion()->where('slug', '=', $new_slug)->withTrashed()->first();
            $incrementer += 1;
        }

        if ($slug != $new_slug) {
            $slug = $new_slug;
        }

        $new_discussion = [
            'title'               => $request->title,
            'forum_category_id' => $request->forum_category_id,
            'user_id'             => $user_id,
            'slug'                => $slug,
            'color'               => $request->color,
            ];

        $category = Models::category()->find($request->forum_category_id);
        if (!isset($category->slug)) {
            $category = Models::category()->first();
        }

        $discussion = Models::discussion()->create($new_discussion);

        $new_post = [
            'forum_discussion_id' => $discussion->id,
            'user_id'               => $user_id,
            'body'                  => $request->body,
            ];

        if (config('forum.editor') == 'simplemde'):
           $new_post['markdown'] = 1;
        endif;

        // add the user to automatically be notified when new posts are submitted
        $discussion->users()->attach($user_id);

        $post = Models::post()->create($new_post);

        if ($post->id) {
            Event::fire(new ForumAfterNewDiscussion($request, $discussion, $post));
            if (function_exists('forum_after_new_discussion')) {
                forum_after_new_discussion($request);
            }

            $forum_alert = [
                'forum_alert_type' => 'success',
                'forum_alert'      => trans('forum::alert.success.reason.created_discussion'),
                ];

            return redirect('/'.config('forum.routes.home').'/'.config('forum.routes.discussion').'/'.$category->slug.'/'.$slug)->with($forum_alert);
        } else {
            $forum_alert = [
                'forum_alert_type' => 'danger',
                'forum_alert'      => trans('forum::alert.danger.reason.create_discussion'),
            ];

            return redirect('/'.config('forum.routes.home').'/'.config('forum.routes.discussion').'/'.$category->slug.'/'.$slug)->with($forum_alert);
        }
    }

    private function notEnoughTimeBetweenDiscussion()
    {
        $user = Auth::user();

        $past = Carbon::now()->subMinutes(config('forum.security.time_between_posts'));

        $last_discussion = Models::discussion()->where('user_id', '=', $user->id)->where('created_at', '>=', $past)->first();

        if (isset($last_discussion)) {
            return true;
        }

        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($category, $slug = null)
    {
        if (!isset($category) || !isset($slug)) {
            return redirect(config('forum.routes.home'));
        }

        $discussion = Models::discussion()->where('slug', '=', $slug)->first();
        if (is_null($discussion)) {
            abort(404);
        }

        $discussion_category = Models::category()->find($discussion->forum_category_id);
        if ($category != $discussion_category->slug) {
            return redirect(config('forum.routes.home').'/'.config('forum.routes.discussion').'/'.$discussion_category->slug.'/'.$discussion->slug);
        }
        $posts = Models::post()->with('user')->where('forum_discussion_id', '=', $discussion->id)->orderBy(config('forum.order_by.posts.order'), config('forum.order_by.posts.by'))->paginate(10);

        $forum_editor = config('forum.editor');

        if ($forum_editor == 'simplemde') {
            // Dynamically register markdown service provider
            \App::register('GrahamCampbell\Markdown\MarkdownServiceProvider');
        }

        $discussion->increment('views');
        
        return view('forum::discussion', compact('discussion', 'posts', 'forum_editor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function sanitizeContent($content)
    {
        libxml_use_internal_errors(true);
        // create a new DomDocument object
        $doc = new \DOMDocument();

        // load the HTML into the DomDocument object (this would be your source HTML)
        $doc->loadHTML($content);

        $this->removeElementsByTagName('script', $doc);
        $this->removeElementsByTagName('style', $doc);
        $this->removeElementsByTagName('link', $doc);

        // output cleaned html
        return $doc->saveHtml();
    }

    private function removeElementsByTagName($tagName, $document)
    {
        $nodeList = $document->getElementsByTagName($tagName);
        for ($nodeIdx = $nodeList->length; --$nodeIdx >= 0;) {
            $node = $nodeList->item($nodeIdx);
            $node->parentNode->removeChild($node);
        }
    }

    public function toggleEmailNotification($category, $slug = null)
    {
        if (!isset($category) || !isset($slug)) {
            return redirect(config('forum.routes.home'));
        }

        $discussion = Models::discussion()->where('slug', '=', $slug)->first();

        $user_id = Auth::user()->id;

        // if it already exists, remove it
        if ($discussion->users->contains($user_id)) {
            $discussion->users()->detach($user_id);

            return response()->json(0);
        } else { // otherwise add it
             $discussion->users()->attach($user_id);

            return response()->json(1);
        }
    }
}
