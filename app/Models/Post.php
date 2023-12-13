<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    Public function User(){
    return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(like::class, 'post_id');
    }

    public function comment()
    {
        return $this->hasMany(comment::class);
        //"One-to-Many" relationship between Post and Like
    }

    protected $fillable = [
        'user_id',
        'content',
        'post_type',
        'image',
        'link',
        'location',
        'privacy',
    ];



}
