<?php

namespace Dizatech\ModuleMenu\Services\Helpers;

use App\Models\ModuleMenu;
use Illuminate\Support\Facades\Schema;

class ModuleMenusHelper{

    public function getMenuList($module_name)
    {
        $items = array();
        $first_menu = $this->getMenu($module_name);
        if (!empty($first_menu) || $first_menu != null){
            $items = array(
                'name' => $first_menu->name,
                'title' => $first_menu->title,
                'admin_links' => []
            );
            $sub_menus = $first_menu->children;

            $items['admin_links'][] = array(
                'id' => $first_menu->name,
                'title' => $first_menu->title,
                'route' => '',
                'icon' => $first_menu->icon
            );
            $n = 0;
            if (!empty($sub_menus) || $sub_menus != null){
                foreach ($sub_menus as $sub_menu){
                    if ($sub_menu->children->count() > 0){
                        $items['admin_links'][] = array(
                            'id' => $sub_menu->name,
                            'title' => $sub_menu->title,
                            'route' => '',
                            'icon' => $sub_menu->icon
                        );
                        $n ++;
                        foreach ($sub_menu->children as $child){
                            $menu_item['id'] = $child['name'];
                            $menu_item['title'] = $child['title'];
                            $menu_item['route'] = $child['route'];

                            $items['admin_links'][$n]['children'][] = $menu_item;
                        }
                    }else{
                        $menu_item['id'] = $sub_menu['name'];
                        $menu_item['title'] = $sub_menu['title'];
                        $menu_item['route'] = $sub_menu['route'];

                        $items['admin_links'][$n]['children'][] = $menu_item;
                    }
                }
            }
        }
        return $items;
    }

    public function hasMenu($module_name)
    {
        $status = false;
        if (Schema::hasTable('module_menus')){
            $menu = $this->getMenu($module_name);
            if (empty($menu)){
                $status = false;
            }else{
                $status = true;
                if ($this->getMenuChildren($menu->id)->count() == 0){
                    $status = false;
                }
            }
        }
        return $status;
    }

    public function getMenu($module_name)
    {
        return ModuleMenu::query()
            ->where('name', '=', $module_name)
            ->where('parent_id', '=', '0')->first();
    }

    public function getMenuChildren($menu_id)
    {
        return ModuleMenu::query()
            ->where('parent_id', '=', $menu_id)->get();
    }

}
