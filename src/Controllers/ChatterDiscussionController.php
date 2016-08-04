<?php

namespace DevDojo\Chatter\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DevDojo\Chatter\Models\Category;
use DevDojo\Chatter\Models\Discussion;
use DevDojo\Chatter\Models\Post;
use Auth;

class ChatterDiscussionController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $total = 10;
        $offset = 0;
        if($request->total){
            $total = $request->total;
        }
        if($request->offset){
            $offset = $request->offset;
        }
        $discussions = Discussion::with('user')->with('post')->with('postsCount')->with('category')->orderBy('created_at', 'DESC')->take($total)->offset($offset)->get();
        return response()->json($discussions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
    	return view('chatter::discussion.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user_id = Auth::user()->id;        

        // *** Let's gaurantee that we always have a generic slug *** //
        $slug = str_slug($request->title, '-');

        $discussion_exists = Discussion::where('slug', '=', $slug)->first();
        $incrementer = 1;
        $new_slug = $slug;
        while(isset($discussion_exists->id)){
            $new_slug = $slug . '-' . $incrementer;
            $discussion_exists = Discussion::where('slug', '=', $new_slug)->first();
            $incrementer += 1;
        }

        if($slug != $new_slug){
            $slug = $new_slug;
        }

        $new_discussion = array(
            'title' => $request->title,
            'chatter_category_id' => $request->chatter_category_id,
            'user_id' => $user_id,
            'slug' => $slug,
            'color' => $request->color
            );

        $discussion = Discussion::create($new_discussion);

        $new_post = array(
            'chatter_discussion_id' => $discussion->id,
            'user_id' => $user_id,
            'body' => $request->body
            );

        $post = Post::create($new_post);

        if($post->id){
            return redirect('/' . config('chatter.routes.home') . '/' . config('chatter.routes.discussion') . '/' . $slug);
        } else {
            echo 'Whoops :( There seems to be a problem creating your discussion';
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $discussion = Discussion::where('slug', '=', $slug)->first();
        $posts = Post::with('user')->where('chatter_discussion_id', '=', $discussion->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('chatter::discussion.show', compact('discussion', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function sanitizeContent($content){
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

    private function removeElementsByTagName($tagName, $document) {
      $nodeList = $document->getElementsByTagName($tagName);
      for ($nodeIdx = $nodeList->length; --$nodeIdx >= 0; ) {
        $node = $nodeList->item($nodeIdx);
        $node->parentNode->removeChild($node);
      }
    }

}
