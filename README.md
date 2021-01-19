# Module Menu
This package has a menu manager and menu generator for 
laravel modules.

## Installation
Using Composer :

`composer require dizatech/module-menu`

packagist : https://packagist.org/packages/dizatech/module-menu

## Usage
1. Add the following code to module service provider , at the end of
   boot() function :
   
`\ModuleMenu::init('ExampleModule');`

* Please note that `ExampleModule` is your module name

2. Add the following tag in your sidebar layout (the menus will be rendered by this tag) :

`<x-module-menu></x-module-menu>`
or
`<x-module-menu />`

3. run the following command :

`php artisan migrate`

## ChangeLog

### version 1.0.0
Initial release, base structure :
* Create, edit and delete menu
* Add permission or rule to the specific menu
* Handling menu permissions

### version 1.0.1
* Added ModuleMenu alias in composer json (Moved to serviceProvider since v1.0.2)
* x-module-menu tag is now available for menu render

### version 1.0.2
* Added ModuleMenu alias to easily use by `\ModuleMenu::init('ModuleName')` 
in modules service provider
* Removed ModuleMenu alias from composer json
