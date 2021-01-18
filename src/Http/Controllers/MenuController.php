<?php

namespace Dizatech\ModuleMenu\Http\Controllers;

use App\Http\Controllers\Controller;
use Dizatech\ModuleMenu\Http\Requests\MenuRequest;
use Dizatech\ModuleMenu\Models\ModuleMenu;
use App\Models\Permission;
use App\Models\Role;

class MenuController extends Controller
{
    public function index()
    {
        $menus = ModuleMenu::query()->paginate();
        return view('moduleMenu::menu.index', compact('menus'));
    }

    public function create()
    {
        return view('moduleMenu::menu.create', [
            'menus' => ModuleMenu::query()->get(),
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }

    public function store(MenuRequest $request, ModuleMenu $menu)
    {
        $menu->fill($request->except(['roles','permissions']));
        $menu->creator_id = Auth()->user()->id;
        $menu->save();
        session()->flash('success', 'منو با موفقیت ایجاد شد.');
        return redirect()->route('menu.edit', compact('menu'));
    }

    public function edit(ModuleMenu $menu)
    {
        return view('moduleMenu::menu.edit', [
            'menus' => ModuleMenu::query()->get(),
            'menu' => $menu,
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }

    public function update(MenuRequest $request, ModuleMenu $menu)
    {
        $menu->fill($request->except(['roles','permissions']))->save();
        session()->flash('success', 'منو با موفقیت ویرایش شد.');
        return redirect()->back();
    }

    public function destroy(ModuleMenu $menu)
    {
        $menu->delete();
        return response()->json(['status' => 'با موفقیت حذف شد']);
    }
}
