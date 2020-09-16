<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    public function comments(){
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function heading_image(){
        return $this->hasOne('App\File', 'post_id');
    }

}
