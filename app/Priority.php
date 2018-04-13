<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    
    public function todos()
    {
        return $this->hasMany(App\Todo::class);
    }
}
