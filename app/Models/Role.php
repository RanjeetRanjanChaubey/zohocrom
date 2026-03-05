<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AdminUsers;

class Role extends Model
{
    use HasFactory;

    public function AdminUsers()
    {
        return $this->hasMany(AdminUsers::class);
    }
}
