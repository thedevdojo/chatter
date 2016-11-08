<?php

/**
 * Helpers.
 */

// Route helper.
$route = function ($accessor, $default = '') {
    return $this->app->config->get('chatter.routes.'.$accessor, $default);
};

// Middleware helper.
$middleware = function ($accessor, $default = []) {
    return $this->app->config->get('chatter.middleware.'.$accessor, $default);
};

// Authentication middleware helper.
$authMiddleware = function ($accessor) use ($middleware) {
    return array_unique(
        array_merge((array) $middleware($accessor), ['auth'])
    );
};

$options = [
    'prefix' => $route('home'),
    'middleware' => $middleware('global', 'web')
];

/**
 * Chatter routes.
 */
Route::group($options, function () use ($route, $middleware, $authMiddleware) {
    
    // Home view.
    Route::get('/', [
        'uses' => 'DevDojo\Chatter\Controllers\ChatterController@index',
        'as' => 'chatter.home',
        'middleware' => $middleware('home')
    ]);

    // Single category view.
    Route::get($route('category').'/{slug}', [
        'uses' => 'DevDojo\Chatter\Controllers\ChatterController@index',
        'as' => 'chatter.categories.show',
        'middleware' => $middleware('category.show')
    ]);
    
    /**
     * User routes.
     */
    
    // Login view.
    Route::get('login', [
        'uses' => 'DevDojo\Chatter\Controllers\ChatterController@login',
        'as' => 'chatter.login'
    ]);
    
    // Register view.
    Route::get('register', [
        'uses' => 'DevDojo\Chatter\Controllers\ChatterController@register',
        'as' => 'chatter.register'
    ]);
    
    /**
     * Discussion routes.
     */
    Route::group(['prefix' => $route('discussion')], function () use ($middleware, $authMiddleware) {
        
        // All discussions view.
        Route::get('/', [
            'uses' => 'DevDojo\Chatter\Controllers\ChatterDiscussionController@index',
            'as' => 'chatter.discussions.index',
            'middleware' => $middleware('discussion.index')
        ]);
        
        // Create discussion view.
        Route::get('create', [
            'uses' => 'DevDojo\Chatter\Controllers\ChatterDiscussionController@create',
            'as' => 'chatter.discussions.create',
            'middleware' => $authMiddleware('discussion.create')
        ]);
        
        // Store discussion action.
        Route::post('/', [
            'uses' => 'DevDojo\Chatter\Controllers\ChatterDiscussionController@store',
            'as' => 'chatter.discussions.store',
            'middleware' => $authMiddleware('discussion.store')
        ]);
        
        // Single discussion view.
        Route::get('{category}/{slug}', [
            'uses' => 'DevDojo\Chatter\Controllers\ChatterDiscussionController@show',
            'as' => 'chatter.discussions.showInCategory',
            'middleware' => $middleware('discussion.show')
        ]);
        
        /**
         * Specific discussion routes.
         */
        Route::group(['prefix' => '{slug}'], function () use ($middleware, $authMiddleware) {
            
            // Single discussion view.
            Route::get('/', [
                'uses' => 'DevDojo\Chatter\Controllers\ChatterDiscussionController@show',
                'as' => 'chatter.discussions.show',
                'middleware' => $middleware('discussion.show')
            ]);
            
            // Edit discussion view.
            Route::get('edit', [
                'uses' => 'DevDojo\Chatter\Controllers\ChatterDiscussionController@edit',
                'as' => 'chatter.discussions.edit',
                'middleware' => $authMiddleware('discussion.edit')
            ]);
            
            // Update discussion action.
            Route::put('/', [
                'uses' => 'DevDojo\Chatter\Controllers\ChatterDiscussionController@update',
                'as' => 'chatter.discussions.update',
                'middleware' => $authMiddleware('discussion.update')
            ]);
            
            // Destroy discussion action.
            Route::delete('/', [
                'uses' => 'DevDojo\Chatter\Controllers\ChatterDiscussionController@destroy',
                'as' => 'chatter.discussions.destroy',
                'middleware' => $authMiddleware('discussion.destroy')
            ]);
        });
    });
    
    /**
     * Post routes.
     */
    Route::group(['prefix' => $route('post', 'post')], function () use ($middleware, $authMiddleware) {
        
        // All posts view.
        Route::get('/', [
            'uses' => 'DevDojo\Chatter\Controllers\ChatterPostController@index',
            'as' => 'chatter.posts.index',
            'middleware' => $middleware('post.index')
        ]);
        
        // Create post view.
        Route::get('create', [
            'uses' => 'DevDojo\Chatter\Controllers\ChatterPostController@create',
            'as' => 'chatter.posts.create',
            'middleware' => $authMiddleware('post.create')
        ]);
        
        // Store post action.
        Route::post('/', [
            'uses' => 'DevDojo\Chatter\Controllers\ChatterPostController@store',
            'as' => 'chatter.posts.store',
            'middleware' => $authMiddleware('post.store')
        ]);
        
        /**
         * Specific post routes.
         */
        Route::group(['prefix' => '{id}'], function () use ($middleware, $authMiddleware) {
            
            // Single post view.
            Route::get('/', [
                'uses' => 'DevDojo\Chatter\Controllers\ChatterPostController@show',
                'as' => 'chatter.posts.show',
                'middleware' => $middleware('post.show')
            ]);
            
            // Edit post view.
            Route::get('edit', [
                'uses' => 'DevDojo\Chatter\Controllers\ChatterPostController@edit',
                'as' => 'chatter.posts.edit',
                'middleware' => $authMiddleware('post.edit')
            ]);
            
            // Update post action.
            Route::put('/', [
                'uses' => 'DevDojo\Chatter\Controllers\ChatterPostController@update',
                'as' => 'chatter.posts.update',
                'middleware' => $authMiddleware('post.update')
            ]);
            
            // Destroy post action.
            Route::delete('/', [
                'uses' => 'DevDojo\Chatter\Controllers\ChatterPostController@destroy',
                'as' => 'chatter.posts.destroy',
                'middleware' => $authMiddleware('post.destroy')
            ]);
        });
        
    });
});
