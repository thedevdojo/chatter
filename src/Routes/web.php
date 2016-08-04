<?php

Route::group(['middleware' => 'web'], function () {

	$chatter_url = Config::get('chatter.routes.home');
	Route::get($chatter_url, 'DevDojo\Chatter\Controllers\ChatterController@index');

	Route::get($chatter_url.'/login', 'DevDojo\Chatter\Controllers\ChatterController@login');

	$chatter_category_url = Config::get('chatter.routes.home') . '/' . Config::get('chatter.routes.category');
	Route::get($chatter_category_url . '/{slug}', 'DevDojo\Chatter\Controllers\ChatterController@index');

	$discussion_url = Config::get('chatter.routes.home') . '/' . Config::get('chatter.routes.discussion');
	Route::resource($discussion_url, 'DevDojo\Chatter\Controllers\ChatterDiscussionController');

	$posts_url = Config::get('chatter.routes.home') . '/posts';
	Route::resource($posts_url, 'DevDojo\Chatter\Controllers\ChatterPostController');

});