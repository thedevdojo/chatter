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
    public function index()
    {
        //
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

        $new_discussion = array(
            'title' => $request->title,
            'chatter_category_id' => $request->chatter_category_id,
            'user_id' => $user_id
            );

        $discussion = Discussion::create($new_discussion);

        $new_id = 'asdf' . $discussion->id;

        $new_post = array(
            'chatter_discussion_id' => $discussion->id,
            'user_id' => $user_id,
            'body' => $request->body
            );

        $post = Post::create($new_post);

        if($post->id){
            echo 'successfully created discussion';
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
    public function show($id)
    {
        $id = intval($id);
        $discussion = Discussion::find($id);
        return view('chatter::discussion.show', compact('discussion'));
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
