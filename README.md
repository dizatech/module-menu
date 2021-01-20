# Module Menu
This package has a menu manager and menu generator for 
laravel modules.

## Installation
Using Composer :

`composer require dizatech/module-menu`

packagist : https://packagist.org/packages/dizatech/module-menu

## Usage
* first you need to run the following command :

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
or shorten type :
`<x-module-menu type="modules" />`
`<x-module-menu type="manager" />`

## ChangeLog

https://github.com/dizatech/module-menu/wiki/ChangeLog
