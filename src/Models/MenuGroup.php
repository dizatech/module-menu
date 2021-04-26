<?php

namespace Dizatech\ModuleMenu\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuGroup extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function menus() {
        return $this->belongsToMany(Menu::class, 'menu_menu_group', 'menu_id', 'menu_group_id');
    }
}
