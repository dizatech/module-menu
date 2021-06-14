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

    protected $appends = ['status_label','type_label'];

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

    public function getTypeLabelattribute()
    {
        switch ($this->type){
            case 'custom':
                return 'منو سفارشی';
                break;
            case 'group':
                return 'گروه';
                break;
            case 'heading':
                return 'تیتر منو';
                break;
            case 'news':
                return 'خبر';
                break;
            case 'news_category':
                return 'دسته‌بندی خبر';
                break;
            case 'article':
                return 'مقاله';
                break;
            case 'article_category':
                return 'دسته‌بندی مقاله';
                break;
            case 'video':
                return 'ویدیو';
                break;
            case 'service':
                return 'خدمت';
                break;
            case 'laboratory':
                return 'آزمایشگاه';
                break;
            case 'equipment':
                return 'تجهیزات';
                break;
            default:
                return 'نامشخص';
        }
    }
}
