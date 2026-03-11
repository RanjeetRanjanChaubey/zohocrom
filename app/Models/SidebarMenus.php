<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidebarMenus extends Model
{
    protected $table = 'sidebar_menus';

    protected $fillable = [
        'title', 'route_name', 'icon', 'parent_id', 'order', 'roles', 'is_active'
    ];

    public function children()
    {
        return $this->hasMany(SidebarMenus::class, 'parent_id')->orderBy('order');
    }

    public function isVisibleForRole($roleId)
    {
        if (!$this->roles) return true; // null = visible for all
        $roles = explode(',', $this->roles);
        return in_array($roleId, $roles);
    }
}
