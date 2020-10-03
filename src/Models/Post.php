<?php

namespace MeinderA\Forum\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $table = 'forum_post';
    public $timestamps = true;
    protected $fillable = ['forum_discussion_id', 'user_id', 'body', 'markdown'];
    protected $dates = ['deleted_at'];

    public function discussion()
    {
        return $this->belongsTo(Models::className(Discussion::class), 'forum_discussion_id');
    }

    public function user()
    {
        return $this->belongsTo(config('forum.user.namespace'));
    }
}
