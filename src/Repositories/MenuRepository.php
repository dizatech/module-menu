<?php
namespace Dizatech\ModuleMenu\Repositories;

use Dizatech\ModuleMenu\Models\Menu;
use Dizatech\ModuleMenu\Models\MenuItem;

class MenuRepository
{
    public function createMenu($request,$menuGroup)
    {
        $menu = Menu::query()->create([
            'title' => $request->title,
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

    public function createMenuItem($request,$menu)
    {
        $menu_item = MenuItem::query()->create([
            'title' => $request->title,
            'css_class' => $request->css_class,
            'status' => $request->menu_status,
            'sort_order' => $this->getMenuItemSortOrder($menu)
        ]);
        $menu->menu_items()->attach($menu_item);
        return $menu_item;
    }

    public function updateMenuItem($request)
    {
        MenuItem::query()
            ->where('id', '=', $request->menu_item_id)
            ->update([
                'title' => $request->title,
                'css_class' => $request->css_class,
                'status' => $request->menu_status,
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

    public function findItemTypes($search)
    {
//        return test::query()
//            ->where(function ($query) use ($search){
//                $query->whereRaw("concat_ws('',test,tset) like ?", ['%' . $search . '%']);
//                $query->orWhere('test', 'like', ['%' . $search . '%']);
//            })
//            ->get();
    }
}
