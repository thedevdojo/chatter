<?php

namespace DevDojo\Chatter\Models;


class Post extends Model
{
    protected $table = 'post';
    public $timestamps = true;
    protected $fillable = ['chatter_discussion_id', 'user_id', 'body', 'markdown'];

    public function discussion()
    {
        return $this->belongsTo(Models::className(Discussion::class), 'chatter_discussion_id');
    }

    public function user()
    {
        return $this->belongsTo(config('chatter.user.namespace'));
    }
}
