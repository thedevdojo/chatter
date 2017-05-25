<?php

namespace DevDojo\Chatter\Models;

use DevDojo\Chatter\Helpers\ChatterHelper;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    public function getTable()
    {
        if (isset($this->table)) {
            return ChatterHelper::tableName($this->table);
        }
        return parent::getTable();
    }
}