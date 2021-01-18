<?php
use Illuminate\Support\Facades\Route;

Route::resource('/menus', 'Menu\MenuController')
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
