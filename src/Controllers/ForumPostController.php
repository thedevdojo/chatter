<?php

namespace MeinderA\Forum\Controllers;

use Auth;
use Event;
use Purifier;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MeinderA\Forum\Models\Models;
use Illuminate\Support\Facades\Mail;
use Illuminate\Routing\Controller as Controller;
use MeinderA\Forum\Mail\ForumDiscussionUpdated;
use MeinderA\Forum\Events\ForumAfterNewResponse;
use MeinderA\Forum\Events\ForumBeforeNewResponse;

class ForumPostController extends Controller
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
        $posts = Models::post()->with('user')->orderBy('created_at', 'DESC')->take($total)->offset($offset)->get();*/

        // This is another unused route
        // we return an empty array to not expose user data to the public
        return response()->json([]);
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
        $stripped_tags_body = ['body' => strip_tags($request->body)];
        $validator = Validator::make($stripped_tags_body, [
            'body' => 'required|min:10',
        ],[
			'body.required' => trans('forum::alert.danger.reason.content_required'),
			'body.min' => trans('forum::alert.danger.reason.content_min'),
		]);

        Event::dispatch(new ForumBeforeNewResponse($request, $validator));
        if (function_exists('forum_before_new_response')) {
            forum_before_new_response($request, $validator);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (config('forum.security.limit_time_between_posts')) {
            if ($this->notEnoughTimeBetweenPosts()) {
                $minutes = trans_choice('forum::messages.words.minutes', config('forum.security.time_between_posts'));
                $forum_alert = [
                    'forum_alert_type' => 'danger',
                    'forum_alert'      => trans('forum::alert.danger.reason.prevent_spam', [
                                                'minutes' => $minutes,
                                            ]),
                    ];

                return back()->with($forum_alert)->withInput();
            }
        }

        $request->request->add(['user_id' => Auth::user()->id]);

        if (config('forum.editor') == 'simplemde'):
            $request->request->add(['markdown' => 1]);
        endif;

        $new_post = Models::post()->create($request->all());

        $discussion = Models::discussion()->find($request->forum_discussion_id);

        $category = Models::category()->find($discussion->forum_category_id);
        if (!isset($category->slug)) {
            $category = Models::category()->first();
        }

        if ($new_post->id) {
            $discussion->last_reply_at = $discussion->freshTimestamp();
            $discussion->save();


            Event::dispatch(new ForumAfterNewResponse($request, $new_post));
            if (function_exists('forum_after_new_response')) {
                forum_after_new_response($request);
            }

            // if email notifications are enabled
            if (config('forum.email.enabled')) {
                // Send email notifications about new post
                $this->sendEmailNotifications($new_post->discussion);
            }

            $forum_alert = [
                'forum_alert_type' => 'success',
                'forum_alert'      => trans('forum::alert.success.reason.submitted_to_post'),
                ];

            return redirect('/'.config('forum.routes.home').'/'.config('forum.routes.discussion').'/'.$category->slug.'/'.$discussion->slug)->with($forum_alert);
        } else {
            $forum_alert = [
                'forum_alert_type' => 'danger',
                'forum_alert'      => trans('forum::alert.danger.reason.trouble'),
                ];

            return redirect('/'.config('forum.routes.home').'/'.config('forum.routes.discussion').'/'.$category->slug.'/'.$discussion->slug)->with($forum_alert);
        }
    }

    private function notEnoughTimeBetweenPosts()
    {
        $user = Auth::user();

        $past = Carbon::now()->subMinutes(config('forum.security.time_between_posts'));

        $last_post = Models::post()->where('user_id', '=', $user->id)->where('created_at', '>=', $past)->first();

        if (isset($last_post)) {
            return true;
        }

        return false;
    }

    private function sendEmailNotifications($discussion)
    {
        $users = $discussion->users->except(Auth::user()->id);
        foreach ($users as $user) {
            Mail::to($user)->queue(new ForumDiscussionUpdated($discussion));
        }
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
        $stripped_tags_body = ['body' => strip_tags($request->body)];
        $validator = Validator::make($stripped_tags_body, [
            'body' => 'required|min:10',
        ],[
			'body.required' => trans('forum::alert.danger.reason.content_required'),
			'body.min' => trans('forum::alert.danger.reason.content_min'),
		]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $post = Models::post()->find($id);
        if (!Auth::guest() && (Auth::user()->id == $post->user_id)) {
            if ($post->markdown) {
                $post->body = $request->body;
            } else {
 	        $post->body = Purifier::clean($request->body);
            }
            $post->save();

            $discussion = Models::discussion()->find($post->forum_discussion_id);

            $category = Models::category()->find($discussion->forum_category_id);
            if (!isset($category->slug)) {
                $category = Models::category()->first();
            }

            $forum_alert = [
                'forum_alert_type' => 'success',
                'forum_alert'      => trans('forum::alert.success.reason.updated_post'),
                ];

            return redirect('/'.config('forum.routes.home').'/'.config('forum.routes.discussion').'/'.$category->slug.'/'.$discussion->slug)->with($forum_alert);
        } else {
            $forum_alert = [
                'forum_alert_type' => 'danger',
                'forum_alert'      => trans('forum::alert.danger.reason.update_post'),
                ];

            return redirect('/'.config('forum.routes.home'))->with($forum_alert);
        }
    }

    /**
     * Delete post.
     *
     * @param string $id
     * @param  \Illuminate\Http\Request
     *
     * @return \Illuminate\Routing\Redirect
     */
    public function destroy($id, Request $request)
    {
        $post = Models::post()->with('discussion')->findOrFail($id);

        if ($request->user()->id !== (int) $post->user_id) {
            return redirect('/'.config('forum.routes.home'))->with([
                'forum_alert_type' => 'danger',
                'forum_alert'      => trans('forum::alert.danger.reason.destroy_post'),
            ]);
        }

        if ($post->discussion->posts()->oldest()->first()->id === $post->id) {
            if(config('forum.soft_deletes')) {
                $post->discussion->posts()->delete();
                $post->discussion()->delete();
            } else {
                $post->discussion->posts()->forceDelete();
                $post->discussion()->forceDelete();
            }

            return redirect('/'.config('forum.routes.home'))->with([
                'forum_alert_type' => 'success',
                'forum_alert'      => trans('forum::alert.success.reason.destroy_post'),
            ]);
        }

        $post->delete();

        $url = '/'.config('forum.routes.home').'/'.config('forum.routes.discussion').'/'.$post->discussion->category->slug.'/'.$post->discussion->slug;

        return redirect($url)->with([
            'forum_alert_type' => 'success',
            'forum_alert'      => trans('forum::alert.success.reason.destroy_from_discussion'),
        ]);
    }
}
