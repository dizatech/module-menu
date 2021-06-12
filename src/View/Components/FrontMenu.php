<?php

namespace Dizatech\ModuleMenu\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontMenu extends Component
{
    public $menuGroup;

    public function __construct($menuGroup)
    {
        // Set input variables to generate a component
        $this->menuGroup = $menuGroup;
    }

    public function render()
    {
        return view('vendor.ModuleMenu.components.front-menu.render');
    }
}
