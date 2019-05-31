<?php

namespace DevDojo\Chatter\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Searchable;

class Discussion extends Model
{
    use SoftDeletes, Searchable;

    protected $table = 'chatter_discussion';
    public $timestamps = true;
    protected $fillable = ['title', 'chatter_category_id', 'user_id', 'slug', 'color'];
    protected $dates = ['deleted_at', 'last_reply_at'];

    public function user()
    {
        return $this->belongsTo(config('chatter.user.namespace'));
    }

    public function category()
    {
        return $this->belongsTo(Models::className(Category::class), 'chatter_category_id');
    }

    public function posts()
    {
        return $this->hasMany(Models::className(Post::class), 'chatter_discussion_id');
    }

    /**
     * The main post for this discussion
     *
     */
    public function post()
    {
        return $this->hasOne(Models::className(Post::class), 'chatter_discussion_id')->orderBy('created_at', 'asc');
    }

    public function users()
    {
        return $this->belongsToMany(config('chatter.user.namespace'), 'chatter_user_discussion', 'discussion_id', 'user_id');
    }

    public function getBodyAttribute()
    {
        $post = $this->posts()->orderBy('created_at', 'asc')->first();

        return $post->body;
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $posts = [];
        $this->posts()->select(['body'])->take(6)->get()->each(function ($post) use (&$posts) {
            $posts[] = Str::words($post->body, 50); // limit post body to 50 words
        });

        $array = $this->toArray();

        $array['category'] = $this->category->name;
        $array['body'] = $this->posts()->orderBy('created_at', 'asc')->first()->body;
        $array['posts'] = $posts;
        $array['posts_count'] = $this->posts->count();

        return $array;
    }
}
