<?php
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Dizatech\ModuleMenu\Http\Controllers',
    'prefix' => 'panel',
    'middleware' => ['web', 'auth', 'verified']
], function () {
    Route::resource('menu', 'MenuController')
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
});
