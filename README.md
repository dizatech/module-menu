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

2. Add the following code in the app.php main layout blade :

`@component('moduleMenu::layouts.sidebar')
@endcomponent`

