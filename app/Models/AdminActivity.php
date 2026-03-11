<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminActivity extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'activity',
        'ip_address',
    ];

    public function admin()
    {
        return $this->belongsTo(AdminUsers::class, 'admin_id');
    }
}
