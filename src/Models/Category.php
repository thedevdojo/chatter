<?php

namespace MeinderA\Forum\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'forum_categories';
    public $timestamps = true;
    public $with = 'parents';

    public function discussions()
    {
        return $this->hasMany(Models::className(Discussion::class),'forum_category_id');
    }

    public function parents()
    {
        return $this->hasMany(Models::classname(self::class), 'parent_id')->orderBy('order', 'asc');
    }
}
