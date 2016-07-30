<?php

namespace DevDojo\Chatter\Controllers;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	protected $table = 'chatter_post';
	public $timestamps = true;

	public function discussion()
	{
		return $this->belongsTo('Discussion');
	}

}