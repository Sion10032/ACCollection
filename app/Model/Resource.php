<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['name', 'bid', 'lastChapter'];

    public function favorite()
    {
        return $this->hasMany('App\Model\Favorite', 'resId', 'id');
    }
}
