<?php

$chatter_url = Config::get('chatter.routes.home');

Route::resource($chatter_url, 'DevDojo\Chatter\Controllers\ChatterDiscussionController');
Route::get($chatter_url, 'DevDojo\Chatter\Controllers\ChatterController@index');