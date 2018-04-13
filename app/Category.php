<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function todo() 
    {
        return $this->hasMany('App\Todo');
    }
}
