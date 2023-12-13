<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;
    public function users() {
        return $this->belongsToMany(User::class, 'user_roles');
    }

    // Relationship with Permission
    public function permissions() {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }
}
