<?php

namespace Dizatech\ModuleMenu\Http\Controllers;

use App\Http\Controllers\Controller;
use Dizatech\ModuleMenu\Facades\MenuParentFacade;
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
        $parent_menu = $MenuItem;
        if ($request->menu_item_id == 0){
            $menu = MenusFacade::createMenuItem($request,$MenuItem,$parent_menu);
            $response = json_encode(array(
                'status' => '200',
                'id' => $menu->id,
                'title' => $menu->title,
                'parent_title' => $menu->parent == null ? '-' : $menu->parent->title,
                'status_label' => $menu->status_label,
                'type_label' => $menu->type_label,
                'message' => 'آیتم باموفقیت ثبت شد.',
            ));
        }elseif ($request->menu_item_id > 0){
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
    public function destroy(MenuItem $MenuItem)
    {
        $MenuItem->delete();
        return response()->json(['status' => 'با موفقیت حذف شد']);
    }

    public function getMenuItems(Menu $MenuItem)
    {
        return json_encode($MenuItem->menu_items()->with('parent')->orderBy('sort_order')->get());
    }

    public function sortMenu(Request $request)
    {
        $request->validate([
            'menu_item_ids' => 'required'
        ]);
        MenusFacade::sortMenuItems($request->menu_item_ids);
        return json_encode(array(
            'status' => '200'
        ));
    }

    public function getMenuItem(Request $request)
    {
        $request->validate([
            'menu_item_id' => 'required'
        ]);
        $menu = MenusFacade::getMenuItem($request->menu_item_id);
        if ($menu->object_id != 0){
            $object = MenusFacade::getObject($menu->type,null,$menu->object_id);
            $object_title = $object->title;
        }else{
            $object_title = '';
        }
        return json_encode(array(
            'status' => '200',
            'title' => $menu->title,
            'css_class' => $menu->css_class,
            'status' => $menu->status,
            'menu_id' => $menu->id,
            'parent_id' => $menu->parent_id,
            'object_id' => $menu->object_id,
            'object_title' => $object_title,
            'url' => $menu->url,
            'type' => $menu->type,
        ));
    }

    public function getMenuObjects($type)
    {
        if (request()->has('q') && (!empty(request('q')) || request('q') != null)){
            $objects = MenusFacade::getObject($type,request('q'));
        }
        $results = [];
        foreach ($objects as $object) {
            $temp = new \stdClass();
            $temp->id = $object->id;
            $temp->text = $object->title;
            $results[] = $temp;
        }
        $output = new \stdClass();
        $output->results = $results;
        return json_encode($output);
    }

    public function getMenuParents(Request $request)
    {
        $request->validate([
            'menu_id' => 'required'
        ]);
        $menuItems = MenuItem::query()
            ->where('parent_id', 0)
            ->where('menu_id', $request->menu_id)
            ->get();
        if ($request->has('parent_id')){
            $menu_parent = MenuParentFacade::menu_item_select_options($menuItems, $request->parent_id ,$request->menu_item_id);
        }else{
            $menu_parent = MenuParentFacade::menu_item_select_options($menuItems);
        }
        return json_encode(array(
            'status' => '200',
            'menu_parent' => $menu_parent
        ));
    }
}
