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
        ->only(['edit']);
    Route::post('front-menu/get/menus/{FrontMenu}', 'FrontMenuController@getMenus');
    Route::patch('front-menu/update/{FrontMenu}', 'FrontMenuController@update');
});
