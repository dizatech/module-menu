<?php

namespace Dizatech\ModuleMenu\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'url', 'css_class', 'status', 'sort_order'];
    protected $appends = ['status_label'];

    public function menu_groups() {
        return $this->belongsToMany(MenuGroup::class, 'menu_menu_group', 'menu_group_id', 'menu_id');
    }

    public function menu_items()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function active_menu_items()
    {
        return $this->hasMany(MenuItem::class)
            ->where('status', '=', '1')
            ->where('parent_id', '=', '0')
            ->orderBy('sort_order', 'asc');
    }

    public function getStatusLabelattribute()
    {
        switch ($this->status){
            case 0:
                return 'غیرفعال';
                break;
            case 1:
                return 'فعال';
                break;
            default:
                return 'نامشخص';
        }
    }
}
