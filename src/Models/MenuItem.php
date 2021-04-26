<?php

namespace Dizatech\ModuleMenu\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function children(){
        return $this->hasMany( MenuItem::class, 'parent_id' );
    }

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id' ,'id');
    }
}
