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
        dd($request->all());
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

    public function getMenuTypes($type)
    {
        if (request()->has('q') && (!empty(request('q')) || request('q') != null)){
            switch ($type){
                case 'news':
                    $item_refs = MenusFacade::findPost(request('q'), 'news');
                    break;
                case 'news_category':
                    $item_refs = MenusFacade::findCategory(request('q'), 'newsCategory');
                    break;
                case 'article':
                    $item_refs = MenusFacade::findPost(request('q'), 'article');
                    break;
                case 'article_category':
                    $item_refs = MenusFacade::findCategory(request('q'), 'articleCategory');
                    break;
                case 'video':
                    $item_refs = MenusFacade::findPost(request('q'), 'video');
                    break;
                case 'video_category':
                    $item_refs = MenusFacade::findCategory(request('q'), 'videoCategory');
                    break;
                case 'service':
                    $item_refs = MenusFacade::findService(request('q'));
                    break;
                case 'service_category':
                    $item_refs = MenusFacade::findCategory(request('q'), 'serviceCategory');
                    break;
                case 'equipment':
                    $item_refs = MenusFacade::findEquipment(request('q'));
                    break;
                case 'laboratory':
                    $item_refs = MenusFacade::findLaboratory(request('q'));
                    break;
            }
        }
        $results = [];
        foreach ($item_refs as $ref) {
            $temp = new \stdClass();
            $temp->id = $ref->id;
            $temp->text = $ref->title;
            $results[] = $temp;
        }
        $output = new \stdClass();
        $output->results = $results;
        return json_encode($output);
    }

    public function getMenuParents()
    {
        //MenuParentFacade::menu_item_select_options($this->menu_items(), old('parent_id', $this->parent_id), $this->menu_item_id);
        $menuItem = MenuItem::query()->where('parent_id', 0)
            ->get();
        return json_encode(array(
            'status' => '200',
            'menu_parent' => MenuParentFacade::menu_item_select_options($menuItem)
        ));
    }
}
