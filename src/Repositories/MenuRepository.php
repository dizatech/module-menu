<?php
namespace Dizatech\ModuleMenu\Repositories;

use Dizatech\ModuleMenu\Models\Menu;

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
}
