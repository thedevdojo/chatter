<?php

Route::group(['middleware' => 'web'], function () {

	$chatter_url = Config::get('chatter.routes.home');
	Route::get($chatter_url, 'DevDojo\Chatter\Controllers\ChatterController@index');

	Route::get($chatter_url.'/login', 'DevDojo\Chatter\Controllers\ChatterController@login');
	Route::get($chatter_url.'/register', 'DevDojo\Chatter\Controllers\ChatterController@register');

	$chatter_category_url = Config::get('chatter.routes.home') . '/' . Config::get('chatter.routes.category');
	Route::get($chatter_category_url . '/{slug}', 'DevDojo\Chatter\Controllers\ChatterController@index');

	$discussion_url = Config::get('chatter.routes.home') . '/' . Config::get('chatter.routes.discussion');
	Route::resource($discussion_url, 'DevDojo\Chatter\Controllers\ChatterDiscussionController');
	Route::get($discussion_url . '/{category}/{slug}', 'DevDojo\Chatter\Controllers\ChatterDiscussionController@show');

	$posts_url = Config::get('chatter.routes.home') . '/posts';
	Route::resource($posts_url, 'DevDojo\Chatter\Controllers\ChatterPostController');

});