<?php

namespace Dizatech\ModuleMenu\Models;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModuleMenu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','title','icon','route','parent_id'];

    public function parent()
    {
        return $this->belongsTo(ModuleMenu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ModuleMenu::class, 'parent_id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'module_menu_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'module_menu_permissions');
    }
}
