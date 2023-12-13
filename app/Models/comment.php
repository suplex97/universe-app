<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

     // Define the User relationship
     public function user()
     {
         return $this->belongsTo(User::class);
     }
 
     // Define the Post relationship
     public function post()
     {
         return $this->belongsTo(Post::class);
     }


     public function comments()
     {
        return $this->hasMany(Comment::class);
     }
}
