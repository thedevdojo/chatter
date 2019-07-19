<?php

namespace DevDojo\Chatter\Controllers;

use Auth;
use DevDojo\Chatter\Helpers\ChatterHelper as Helper;
use DevDojo\Chatter\Models\Models;
use Illuminate\Routing\Controller as Controller;

class ChatterApiDiscussionController extends Controller
{
    public function index( $slug = '' )
    {
        $success = true;
        $pagination_results = config('chatter.paginate.num_of_results');

        $discussions = Models::discussion()->with('user')->with('post')->with('postsCount')->with('category')
                    ->orderBy( config('chatter.order_by.discussions.order'), config('chatter.order_by.discussions.by') );
        if (isset($slug)) {
            $category = Models::category()->where('slug', '=', $slug)->first();

            if (isset($category->id)) {
                $current_category_id = $category->id;
                $discussions = $discussions->where('chatter_category_id', '=', $category->id);
            } else {
                $success = false;
                $current_category_id = null;
                return response()->json( compact( 'success' ), 400 );
            }
        }

        $discussions = $discussions->take( 3 );

        return response()->json( compact( 'success', 'discussions' ) );
        //return view('chatter::home', compact('discussions', 'categories', 'categoriesMenu', 'chatter_editor', 'current_category_id'));
    }
}
