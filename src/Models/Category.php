<?php

namespace DevDojo\Chatter\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chatter_categories';

    /**
     * Discussions relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function discussions()
    {
        return $this->hasMany(Discussion::class);
    }
}
