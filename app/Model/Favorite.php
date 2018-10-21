<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public $timestamps = false;

    protected $fillable = ['lastChapter', 'userId','resId'];

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'userId', 'id');
    }

    public function resource()
    {
        return $this->belongsTo('App\Model\Resource', 'resId', 'id');
    }
}
