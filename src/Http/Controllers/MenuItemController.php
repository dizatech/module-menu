<?php

namespace Dizatech\ModuleMenu\Http\Controllers;

use App\Http\Controllers\Controller;
use Dizatech\ModuleMenu\Facades\MenusFacade;
use Dizatech\ModuleMenu\Http\Requests\FrontMenuRequest;
use Dizatech\ModuleMenu\Http\Requests\MenuItemRequest;
use Dizatech\ModuleMenu\Models\Menu;
use Dizatech\ModuleMenu\Models\MenuGroup;
use Dizatech\ModuleMenu\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
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
    public function edit(Menu $MenuItem)
    {
        return view('vendor.ModuleMenu.menu-item.edit', [
            'menu' => $MenuItem
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createOrUpdate(MenuItemRequest $request, Menu $MenuItem)
    {
        $response = json_encode(array(
            'status' => '500'
        ));
        if ($request->menu_id == 0){
            $menu = MenusFacade::createMenuItem($request,$MenuItem);
            $response = json_encode(array(
                'status' => '200',
                'id' => $menu->id,
                'title' => $menu->title,
                'status_label' => $menu->status_label,
                'message' => 'آیتم باموفقیت ثبت شد.',
            ));
        }elseif ($request->menu_id > 0){
            MenusFacade::updateMenuItem($request);
            $response = json_encode(array(
                'status' => '200',
                'message' => 'تغییرات آیتم باموفقیت ذخیره شد.'
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

    public function getMenuItems(MenuItem $menuItem)
    {
        return json_encode($menuItem->orderBy('sort_order')->get());
    }

    public function sortMenu(Request $request)
    {
        $request->validate([
            'menu_item_ids' => 'required'
        ]);
        MenusFacade::sortMenuItems($request->menu_ids);
        return json_encode(array(
            'status' => '200'
        ));
    }

    public function getMenuItem(Request $request)
    {
        $request->validate([
            'menu_item_id' => 'required'
        ]);
        $menu = MenusFacade::getMenuItem($request->menu_id);
        return json_encode(array(
            'status' => '200',
            'title' => $menu->title,
            'css_class' => $menu->css_class,
            'menu_status' => $menu->status,
            'menu_id' => $menu->id
        ));
    }
}
