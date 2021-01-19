# Module Menu
This package has a menu manager and menu generator for 
laravel modules.

## Installation
Using Composer :

## Usage
1. Add the following code to module service provider , at the end of
   boot() function :

`ModuleMenusFacade::initModuleMenu('ExampleModule');`

* Please note that `ExampleModule` is your module name

2. Add the following code after `panel.layouts.navbar` component in 
   the app.blade.php main layout :

`@component('moduleMenu::layouts.sidebar')
@endcomponent`

## ChangeLog

### v 1.0.0
Initial release, base structure :
* Create, edit and delete menu
* Add permission or rule to the specific menu
* Handling menu permissions
