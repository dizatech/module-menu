<?php

namespace Dizatech\ModuleMenu\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['menu_id','parent_id','title','url','type','css_class','object_id','status','sort_order'];

    protected $appends = ['status_label'];

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
