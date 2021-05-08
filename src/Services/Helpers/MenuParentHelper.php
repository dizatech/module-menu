<?php

namespace Dizatech\ModuleMenu\Services\Helpers;

use Dizatech\ModuleMenu\Models\ModuleMenu;
use Illuminate\Support\Facades\Schema;

class MenuParentHelper{

    function menu_item_select_options($menu_items, $current = "", $edit_id = "" ,$prefix = "")
    {
        $response = "";
        if ($edit_id != ""){
            $menu_items = $menu_items->except($edit_id);
        }
        foreach ($menu_items as $menu_item) {
            $selected = ($menu_item->id == $current) ? "selected='selected'" : "";
            $title = $menu_item->title;
            if ($prefix != "")
                $title = $prefix . " " . $title;
            $response .= "<option value='{$menu_item->id}' {$selected}>{$title}</option>";

            if ($menu_item->has('children'))
                $response .= $this->menu_item_select_options($menu_item->children, $current, $edit_id,$prefix . "--");
        }

        return $response;
    }

}
