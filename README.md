# Module Menu

This package has a menu manager and menu generator for 
laravel modules.

## Installation

Using Composer :

`composer require dizatech/module-menu`

packagist : https://packagist.org/packages/dizatech/module-menu

## Usage

* publish blade files :

`php artisan vendor:publish --tag=module-menu`

** Please note if you already published the vendor, for updates you can run the following command :

`php artisan vendor:publish --tag=module-menu --force`

* run the following command :

`php artisan migrate`

* Add the following code to module service provider , at the end of
   boot() function :
   
`\ModuleMenu::init('ExampleModule');`

Please note that `ExampleModule` is your module name

* Add the following tags in your sidebar layout 
  (the module menus will be rendered by `modules` type
   and the menu manager will be rendered by `manager` type) :

`<x-module-menu type="modules"></x-module-menu>`

`<x-module-menu type="manager"></x-module-menu>`

or shorten tags :

`<x-module-menu type="modules" />`

`<x-module-menu type="manager" />`

Please note that the default type of `x-module-menu` tag is `manager`

## ChangeLog

https://github.com/dizatech/module-menu/wiki/ChangeLog
