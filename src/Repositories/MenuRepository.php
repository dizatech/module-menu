<?php
namespace Dizatech\ModuleMenu\Repositories;

use App\Models\Category;
use Dizatech\ModuleMenu\Models\Menu;
use Dizatech\ModuleMenu\Models\MenuItem;
use Illuminate\Routing\Route;
use Modules\MahamaxCore\Models\Equipment;
use Modules\MahamaxCore\Models\Laboratory;
use Modules\MahamaxCore\Models\Service;
use Modules\Post\Models\Post;

class MenuRepository
{
    public function createMenu($request,$menuGroup)
    {
        $menu = Menu::query()->create([
            'title' => $request->title,
            'url' => $request->url,
            'css_class' => $request->css_class,
            'status' => $request->menu_status,
            'sort_order' => $this->getMenuSortOrder($menuGroup)
        ]);
        $menuGroup->menus()->attach($menu);
        return $menu;
    }

    public function updateMenu($request)
    {
        Menu::query()
            ->where('id', '=', $request->menu_id)
            ->update([
                'title' => $request->title,
                'url' => $request->url,
                'css_class' => $request->css_class,
                'status' => $request->menu_status,
            ]);
    }

    public function getMenuSortOrder($menuGroup)
    {
        $sort_order = 1;
        $last_menu = $menuGroup->menus()->latest()->first();
        if (!empty($last_menu) || $last_menu != null){
            $sort_order += $last_menu->sort_order;
        }
        return $sort_order;
    }

    public function sortMenus($menu_ids)
    {
        $sort_number = 1;
        foreach ($menu_ids as $menu_id){
            Menu::query()->findOrFail($menu_id)->update([
                'sort_order' => $sort_number
            ]);
            $sort_number ++;
        }
    }

    public function getMenu($menu_id)
    {
        return Menu::query()->findOrFail($menu_id);
    }

    public function urlGenerator($object_id, $object_type, $object)
    {
        $route_name = '';
        switch ($object_type){
            case 'news':
                $route_name = 'news.user_show';
                break;
            case 'news_category':
                $route_name = 'news_category.user_show';
                break;
            case 'article':
                $route_name = 'article.user_show';
                break;
            case 'article_category':
                $route_name = 'article_category.user_show';
                break;
            case 'video':
                $route_name = 'video.user_show';
                break;
            case 'service':
                $route_name = 'service.user_show';
                break;
            case 'equipment':
                $route_name = 'equipment.user_show';
                break;
            case 'laboratory':
                $route_name = 'laboratory.user_show';
                break;
        }
        return Route($route_name, $object->slug);
    }

    public function prepareRequest($request)
    {
        if ($request->type != 'heading' && $request->type != 'custom' && $request->type != 'group'){
            $object = $this->getObject($request->type, null, $request->object_id);
            $url = $this->urlGenerator($request->object_id,$request->type, $object);
            if (is_null($request->title)){
                $title = $object->slug;
            }else{
                $title = $request->title;
            }
            $object_id = $request->object_id;
        }else{
            if($request->type == 'heading'){
                $url = '';
            }else{
                $url = $request->url;
            }
            $title = $request->title;
            $object_id = 0;
            if ($request->type == 'group'){
                $title = '';
                $url = '';
            }
        }
        return [
            'title' => $title,
            'url' => $url,
            'object_id' => $object_id
        ];
    }

    public function createMenuItem($request,$menu,$parent_menu)
    {
        $prepared_request = $this->prepareRequest($request);
        $menu_item = MenuItem::query()->create([
            'title' => $prepared_request['title'],
            'css_class' => $request->css_class,
            'status' => $request->status,
            'menu_id' => $parent_menu->id,
            'parent_id' => $request->parent_id,
            'object_id' => $prepared_request['object_id'],
            'url' => $prepared_request['url'],
            'type' => $request->type,
            'sort_order' => $this->getMenuItemSortOrder($menu)
        ]);
        return $menu_item;
    }

    public function updateMenuItem($request)
    {
        $prepared_request = $this->prepareRequest($request);
        MenuItem::query()
            ->where('id', '=', $request->menu_item_id)
            ->update([
                'title' => $prepared_request['title'],
                'css_class' => $request->css_class,
                'status' => $request->status,
                'parent_id' => $request->parent_id,
                'object_id' => $prepared_request['object_id'],
                'url' => $prepared_request['url'],
                'type' => $request->type,
            ]);
    }

    public function getMenuItemSortOrder($menu)
    {
        $sort_order = 1;
        $last_menu_item = $menu->menu_items()->latest()->first();
        if (!empty($last_menu_item) || $last_menu_item != null){
            $sort_order += $last_menu_item->sort_order;
        }
        return $sort_order;
    }

    public function sortMenuItems($menu_item_ids)
    {
        $sort_number = 1;
        foreach ($menu_item_ids as $item_id){
            MenuItem::query()->findOrFail($item_id)->update([
                'sort_order' => $sort_number
            ]);
            $sort_number ++;
        }
    }

    public function getMenuItem($menu_item_id)
    {
        return MenuItem::query()->findOrFail($menu_item_id);
    }

    public function findPost($search = null, $type, $object_id = null)
    {
        if ($object_id == null){
            return Post::query()
                ->where('post_type', '=', $type)
                ->where(function ($query) use ($search){
                    $query->where("title", 'like', ['%' . $search . '%']);
                    $query->orWhere("sub_title", 'like', ['%' . $search . '%']);
                    $query->orWhere("slug", 'like', ['%' . $search . '%']);
                })
                ->get();
        }else{
            return Post::query()->findOrFail($object_id);
        }
    }

    public function findCategory($search = null, $type, $object_id = null)
    {
        if ($object_id == null){
            return Category::query()
                ->where('category_type', '=', $type)
                ->where(function ($query) use ($search){
                    $query->where("title", 'like', ['%' . $search . '%']);
                    $query->orWhere("slug", 'like', ['%' . $search . '%']);
                })
                ->get();
        }else{
            return Category::query()->findOrFail($object_id);
        }
    }

    public function findService($search = null, $object_id = null)
    {
        if ($object_id == null){
            return Service::query()
                ->where('publish_status', '=', 'published')
                ->where(function ($query) use ($search){
                    $query->where("title", 'like', ['%' . $search . '%']);
                    $query->orWhere("slug", 'like', ['%' . $search . '%']);
                })
                ->get();
        }else{
            return Service::query()->findOrFail($object_id);
        }

    }

    public function findLaboratory($search = null, $object_id = null)
    {
        if ($object_id == null){
            return Laboratory::query()
                ->where('publish_status', '=', 'published')
                ->where(function ($query) use ($search){
                    $query->where("title", 'like', ['%' . $search . '%']);
                    $query->orWhere("slug", 'like', ['%' . $search . '%']);
                })
                ->get();
        }else{
            return Laboratory::query()->findOrFail($object_id);
        }
    }

    public function findEquipment($search = null, $object_id = null)
    {
        if ($object_id == null){
            return Equipment::query()
                ->where('publish_status', '=', 'published')
                ->where(function ($query) use ($search){
                    $query->where("title", 'like', ['%' . $search . '%']);
                    $query->orWhere("slug", 'like', ['%' . $search . '%']);
                })
                ->get();
        }else{
            return Equipment::query()->findOrFail($object_id);
        }
    }

    public function getObject($type,$search_query = null,$object_id = null)
    {
        switch ($type){
            case 'news':
                $object = $this->findPost($search_query, 'news', $object_id);
                break;
            case 'news_category':
                $object = $this->findCategory($search_query, 'newsCategory', $object_id);
                break;
            case 'article':
                $object = $this->findPost($search_query, 'article', $object_id);
                break;
            case 'article_category':
                $object = $this->findCategory($search_query, 'articleCategory', $object_id);
                break;
            case 'video':
                $object = $this->findPost($search_query, 'video', $object_id);
                break;
            case 'service':
                $object = $this->findService($search_query, $object_id);
                break;
//            case 'service_category':
//                $object = $this->findCategory($search_query, 'serviceCategory', $object_id);
//                break;
            case 'equipment':
                $object = $this->findEquipment($search_query, $object_id);
                break;
            case 'laboratory':
                $object = $this->findLaboratory($search_query, $object_id);
                break;
        }
        return $object;
    }
}
