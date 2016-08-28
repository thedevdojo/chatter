<?php

namespace DevDojo\Chatter\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model {

	protected $table = 'chatter_discussion';
	public $timestamps = true;
	protected $fillable = ['title', 'chatter_category_id', 'user_id', 'slug', 'color'];

	public function user(){
		return $this->belongsTo( config('chatter.user.namespace') );
	}

	public function category()
	{
		return $this->belongsTo('DevDojo\Chatter\Models\Category', 'chatter_category_id');
	}

	public function posts()
	{
		return $this->hasMany('DevDojo\Chatter\Models\Post', 'chatter_discussion_id');
	}

	public function post(){
		return $this->hasMany('DevDojo\Chatter\Models\Post', 'chatter_discussion_id')->orderBy('created_at', 'ASC');
	}

	public function postsCount()
	{
	  return $this->posts()
	    ->selectRaw('chatter_discussion_id, count(*)-1 as total')
	    ->groupBy('chatter_discussion_id');
	}

}
