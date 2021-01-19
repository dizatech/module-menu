<?php

namespace Dizatech\ModuleMenu\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModuleMenu extends Component
{
    public function __construct()
    {

    }

    public function render()
    {
        return view('moduleMenu::components.menu-item');
    }
}
