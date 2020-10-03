<?php

namespace MeinderA\Forum\Controllers;

use Auth;
use MeinderA\Forum\Models\Models;
use Illuminate\Routing\Controller as Controller;
use MeinderA\Forum\Helpers\ForumHelper as Helper;

class ForumController extends Controller
{
    public function index($slug = '')
    {
        $pagination_results = config('forum.paginate.num_of_results');
        
        $discussions = Models::discussion()->with('user')->with('post')->with('postsCount')->with('category')->orderBy(config('forum.order_by.discussions.order'), config('forum.order_by.discussions.by'));
        if (isset($slug)) {
            $category = Models::category()->where('slug', '=', $slug)->first();
            
            if (isset($category->id)) {
                $current_category_id = $category->id;
                $discussions = $discussions->where('forum_category_id', '=', $category->id);
            } else {
                $current_category_id = null;
            }
        }
        
        $discussions = $discussions->paginate($pagination_results);
        
        $categories = Models::category()->get();
        $categoriesMenu = Helper::categoriesMenu(array_filter($categories->toArray(), function ($item) {
            return $item['parent_id'] === null;
        }));
        
        $forum_editor = config('forum.editor');
        
        if ($forum_editor == 'simplemde') {
            // Dynamically register markdown service provider
            \App::register('GrahamCampbell\Markdown\MarkdownServiceProvider');
        }
        
        return view('forum::home', compact('discussions', 'categories', 'categoriesMenu', 'forum_editor', 'current_category_id'));
    }
    
    public function login()
    {
        if (!Auth::check()) {
            return \Redirect::to('/'.config('forum.routes.login').'?redirect='.config('forum.routes.home'))->with('flash_message', 'Please create an account before posting.');
        }
    }
    
    public function register()
    {
        if (!Auth::check()) {
            return \Redirect::to('/'.config('forum.routes.register').'?redirect='.config('forum.routes.home'))->with('flash_message', 'Please register for an account.');
        }
    }
}
