<?php

namespace Dizatech\ModuleMenu\View\Components;

use Dizatech\ModuleMenu\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontMenu extends Component
{
    public $menuGroup, $menus;

    public function __construct($menuGroup)
    {
        // Set input variables to generate a component
        $this->menuGroup = $menuGroup;
    }

    public function render()
    {
        $this->getMenus();
        switch ($this->menuGroup){
            case 'desktop-navbar-menu':
                return view('vendor.ModuleMenu.components.front-menu.desktop-menu-render');
            case 'mobile-navbar-menu':
                return view('vendor.ModuleMenu.components.front-menu.mobile-menu-render');
        }
    }

    protected function getMenus()
    {
        $this->menus = Menu::query()
            ->where('status', '=', '1')
            ->orderBy('sort_order', 'asc')
            ->get();
    }
}
