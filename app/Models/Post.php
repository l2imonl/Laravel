<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasHeaderImage;

class Post extends Model
{
    use HasFactory;
    use HasHeaderImage;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
