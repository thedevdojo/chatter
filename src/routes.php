<?php


Route::group(['middleware' => 'web'], function () {

	$chatter_url = Config::get('chatter.routes.home');
	Route::get($chatter_url, 'DevDojo\Chatter\Controllers\ChatterController@index');

	$discussion_url = Config::get('chatter.routes.home') . '/' . Config::get('chatter.routes.discussion');
	Route::resource($discussion_url, 'DevDojo\Chatter\Controllers\ChatterDiscussionController');

	

});