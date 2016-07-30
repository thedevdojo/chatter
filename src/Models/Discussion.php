<?php

namespace DevDojo\Chatter\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model {

	protected $table = 'chatter_discussion';
	public $timestamps = true;

	public function category()
	{
		return $this->belongsTo('Category', 'chatter_category_id');
	}

	public function posts()
	{
		return $this->hasMany('Post');
	}

}