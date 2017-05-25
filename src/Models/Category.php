<?php

namespace DevDojo\Chatter\Models;


class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = true;

    public function discussions()
    {
        return $this->hasMany(Models::className(Discussion::class));
    }
}
