<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Role;

class AdminUsers extends Authenticatable 
{
    use HasFactory;

    protected $table = 'adminusers';

    // Relationship
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    protected $fillable = ['email', 'password', 'name', 'role_id','last_activity'];
}

