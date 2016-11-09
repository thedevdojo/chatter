<?php

namespace DevDojo\Chatter\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    /**
     * Post table foreign key.
     *
     * @var string
     */
    const POST_TABLE_KEY = 'chatter_discussion_id';
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chatter_discussion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'color',
        'user_id',
        'chatter_category_id'
    ];

    /**
     * User relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('chatter.user.namespace'));
    }

    /**
     * Category relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'chatter_category_id');
    }

    /**
     * Posts relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class, static::POST_TABLE_KEY);
    }

    /**
     * Post relation.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function post()
    {
        return $this->posts()->orderBy('created_at', 'ASC');
    }

    /**
     * Post count.
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function postsCount()
    {
      return $this->posts()
                  ->selectRaw('chatter_discussion_id, count(*)-1 as total')
                  ->groupBy(static::POST_TABLE_KEY);
    }
}
