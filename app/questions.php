<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class questions extends Model
{
    /*public function reply()
    {
        return $this->hasMany('App\Reply');
    }*/

    public function user() {
        return $this->belongsTo("App\User");
    }
}
