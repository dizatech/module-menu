<?php

namespace Dizatech\ModuleMenu\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModuleMenu extends Component
{
    /**
     * The type of menu, modules or manager
     * @var
     */
    public $type;

    public function __construct($type = 'manager')
    {
        // Set input variables to generate a component
        $this->type = $type;
    }

    public function render()
    {
        switch ($this->type){
            case 'modules':
                return view('vendor.ModuleMenu.components.menu-item');
            case 'manager':
                return view('vendor.ModuleMenu.components.menu-manager');
        }
    }
}
