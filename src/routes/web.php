<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Dizatech\ModuleMenu\Http\Controllers',
    'prefix' => 'panel',
    'middleware' => ['web', 'auth', 'verified']
], function () {
    Route::resource('menu', 'MenuController')
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('menu-group', 'GroupMenuController')
        ->only(['index']);
    Route::resource('front-menu', 'FrontMenuController')
        ->only(['edit','destroy']);
    Route::group([
        'prefix' => 'front-menu',
    ], function () {
        Route::post('/get/menus/{FrontMenu}', 'FrontMenuController@getMenus');
        Route::patch('/createOrUpdate/{FrontMenu}', 'FrontMenuController@createOrUpdate');
        Route::post('/sort', 'FrontMenuController@sortMenu');
        Route::post('/get/menu', 'FrontMenuController@getMenu');
    });
    Route::resource('menu-item', 'MenuItemController')
        ->only(['edit','destroy']);
    Route::group([
        'prefix' => 'menu-item',
    ], function () {
        Route::post('/get/menu-items/{MenuItem}', 'MenuItemController@getMenuItems');
        Route::patch('/createOrUpdate/{MenuItem}', 'MenuItemController@createOrUpdate');
        Route::post('/sort', 'MenuItemController@sortMenu');
        Route::post('/get/menu-item', 'MenuItemController@getMenuItem');
        Route::get('/get/menu-objects/{type}', 'MenuItemController@getMenuObjects');
        Route::get('/get/menu-parents', 'MenuItemController@getMenuParents');
    });
});
