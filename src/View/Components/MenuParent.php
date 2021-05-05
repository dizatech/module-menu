<?php

namespace Dizatech\ModuleMenu\View\Components;

use Dizatech\ModuleMenu\Facades\MenuParentFacade;
use Dizatech\ModuleMenu\Models\MenuItem;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuParent extends Component
{
    public $page;

    public $parent_id;

    public $type;

    public $menu_item_id;

    public function __construct($page,$menu_item = '',$parent = '')
    {
        // Set input variables to generate a component
        $this->page = $page;
        $this->parent_id = $parent;
        $this->menu_item_id = $menu_item;
    }

    public function render()
    {
        switch ($this->page){
            case 'create':
                return MenuParentFacade::menu_item_select_options($this->menu_items(), old('parent_id'));
            case 'edit':
                return MenuParentFacade::menu_item_select_options($this->menu_items(), old('parent_id', $this->parent_id), $this->menu_item_id);
        }
    }

    public function menu_items()
    {
        return MenuItem::query()->where('parent_id', 0)
            ->get();
    }
}
