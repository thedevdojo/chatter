<?php

namespace DevDojo\Chatter\Controllers;

use DevDojo\Chatter\Helpers\ChatterHelper as Helper;
use DevDojo\Chatter\Models\Models;
use DevDojo\Chatter\Models\Post;
use Illuminate\Routing\Controller as Controller;

class ChatterSearchController extends Controller
{
    public function index()
    {
        $query = request('q');
        $orderBy = config('chatter.order_by.discussions.order');
        $orderDirection = config('chatter.order_by.discussions.by');
        $pagination_results = config('chatter.paginate.num_of_results');

        $posts = Post::search($query)->get()->pluck('chatter_discussion_id')->toArray();
        $discussionIds = array_values($posts);
        $discussions = Models::discussion()
                             ->with('user')
                             ->with('post')
                             ->with('category')
                             ->whereIn('id', $discussionIds)
                             ->groupBy('id')
                             ->orderBy($orderBy, $orderDirection)
                             ->paginate($pagination_results);

        $current_category_id = null;

        $categories = Models::category()->orderBy('order')->get();
        $categoriesMenu = Helper::categoriesMenu(array_filter($categories->toArray(), function ($item) {
            return $item['parent_id'] === null;
        }));

        $chatter_editor = config('chatter.editor');

        if ($chatter_editor == 'simplemde') {
            // Dynamically register markdown service provider
            \App::register('GrahamCampbell\Markdown\MarkdownServiceProvider');
        }

        return view('chatter::home', compact('discussions', 'categoriesMenu', 'chatter_editor', 'current_category_id'));
    }
}