<?php

namespace DevDojo\Chatter\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DevDojo\Chatter\Models\Category;
use DevDojo\Chatter\Models\Discussion;
use Auth;

class ChatterController extends Controller
{
    public function index($slug = ''){

    	$discussions = Discussion::with('user')->with('post')->with('postsCount')->with('category')->orderBy('created_at', 'DESC')->paginate(10);
    	if(isset($slug)){
    		$category = Category::where('slug', '=', $slug)->first();
    		if(isset($category->id)){
    			$discussions = Discussion::with('user')->with('post')->with('postsCount')->with('category')->where('chatter_category_id', '=', $category->id)->orderBy('created_at', 'DESC')->paginate(10);
    		} 
    		
    	}

    	$categories = Category::all();
    	return view('chatter::index', compact('discussions', 'categories'));
    }

    public function login(){
    	if (!Auth::check())
		{
			return \Redirect::to('/' . config('chatter.routes.login') . '?redirect=' . config('chatter.routes.home'))->with('flash_message', 'Please create an account before posting.');
		}
    }
}
