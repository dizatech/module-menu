<?php

namespace Dizatech\ModuleMenu\Http\Controllers;

use App\Http\Controllers\Controller;
use Dizatech\ModuleMenu\Models\Menu;
use Dizatech\ModuleMenu\Models\MenuGroup;
use Illuminate\Http\Request;

class FrontMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuGroup $FrontMenu)
    {
        return view('vendor.ModuleMenu.front-menu.edit', [
            'menu_group' => $FrontMenu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuGroup $FrontMenu)
    {
        $menuGroup = $FrontMenu;
        if ($request->menu_id == 0){
            $menu = Menu::query()->create($request->except(['menu_id']));
            $menuGroup->menus()->attach($menu);
            $response = json_encode(array(
                'status' => '200',
                'id' => $menu->id,
                'title' => $menu->title,
                'status' => $menu->status,
                'message' => 'منو باموفقیت ثبت شد.',
            ));
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $FrontMenu)
    {
        $FrontMenu->delete();
        return response()->json(['status' => 'با موفقیت حذف شد']);
    }

    public function getMenus(MenuGroup $FrontMenu)
    {
        return json_encode($FrontMenu->menus);
    }
}
