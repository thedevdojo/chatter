<?php

namespace DevDojo\Chatter\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GrahamCampbell\Markdown\Facades\Markdown;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'chatter_post';
    public $timestamps = true;
    protected $fillable = ['chatter_discussion_id', 'user_id', 'body', 'markdown'];
    protected $dates = ['deleted_at'];

    public function discussion()
    {
        return $this->belongsTo(Models::className(Discussion::class), 'chatter_discussion_id');
    }

    public function user()
    {
        return $this->belongsTo(config('chatter.user.namespace'));
    }

    public function getBodyAttribute($field)
    {
        if (isset($this->attributes['markdown']) && $this->attributes['markdown'] == true) {
            $field = Markdown::convertToHtml($discussion->post[0]->body);
        }

        return $field;
    }
}
