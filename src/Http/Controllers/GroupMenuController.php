<?php

namespace Dizatech\ModuleMenu\Http\Controllers;

use App\Http\Controllers\Controller;
use Dizatech\ModuleMenu\Models\MenuGroup;
use Illuminate\Http\Request;

class GroupMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu_groups = MenuGroup::query()->paginate();
        return view('vendor.ModuleMenu.menu-group.index', compact('menu_groups'));
    }
}
