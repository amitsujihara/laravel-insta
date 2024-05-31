<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory,SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class)        ->withTrashed();
    }
// to get category user post
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }

// to get all the comment related to a post
    public function comments(){
        return $this->hasMany(Comment::class);
    }

// to get the likes of a post
    public function likes(){
        return $this->hasMany(Like::class);
    }

// Returns true if the post already been liked bu the Auth user
    public function isLiked(){
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }
}
