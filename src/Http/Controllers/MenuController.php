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
        return view('vendor.ModuleMenu.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('vendor.ModuleMenu.menu.create', [
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

        if ($request->roles != null){
            $menu->roles()->attach($request->roles);
        }
        if ($request->permissions != null){
            $menu->permissions()->attach($request->permissions);
        }

        session()->flash('success', 'منو با موفقیت ایجاد شد.');
        return redirect()->route('menu.edit', compact('menu'));
    }

    public function edit(ModuleMenu $menu)
    {
        return view('vendor.ModuleMenu.menu.edit', [
            'menus' => ModuleMenu::query()->get(),
            'menu' => $menu,
            'roles' => Role::all(),
            'permissions' => Permission::all()
        ]);
    }

    public function update(MenuRequest $request, ModuleMenu $menu)
    {
        $menu->fill($request->except(['roles','permissions']))->save();

        $menu->roles()->sync($request->roles);
        $menu->permissions()->sync($request->permissions);

        session()->flash('success', 'منو با موفقیت ویرایش شد.');
        return redirect()->back();
    }

    public function destroy(ModuleMenu $menu)
    {
        $menu->delete();
        return response()->json(['status' => 'با موفقیت حذف شد']);
    }
}
