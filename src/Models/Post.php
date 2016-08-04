<?php

namespace DevDojo\Chatter\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	protected $table = 'chatter_post';
	public $timestamps = true;
	protected $fillable = ['chatter_discussion_id', 'user_id', 'body'];

	public function discussion()
	{
		return $this->belongsTo('DevDojo\Chatter\Models\Discussion');
	}

	public function user(){
		return $this->belongsTo( config('chatter.user.namespace') );
	}

}