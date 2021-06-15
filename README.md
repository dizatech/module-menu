# Module Menu

This package has a menu manager and menu generator for 
laravel modules.

## Installation

Using Composer :

`composer require dizatech/module-menu`

packagist : https://packagist.org/packages/dizatech/module-menu

## Admin Panel Usage

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

## Front-end Usage

to load desktop menus you must use this tag :

`<x-front-menu menuGroup="desktop-navbar-menu"></x-front-menu>`

to load mobile menus you must use this tag :

`<x-front-menu menuGroup="mobile-navbar-menu"></x-front-menu>`

## Create Menus

### Using UI (Menu Manager)

* from `menu/create` in your panel, you can create new menu
  
* manage created menus in the following url :

`http://example.com/example-panel/menu`

Please note that created menus are only available in module_menus table (in database), 
if you want to have migratable menus, use the `Laravel Seeder` 

### Using Laravel Seeder

The standard structure for packages or core (4 seeder needed)

* for packages you can use pacman (package-manager) to create seeders simply.

Download and install pacman : https://packagist.org/packages/dizatech/pacman

#### MenuSeeder

> Create menu items

* create `<package_name>MenuSeeder` using
  `php artisan pacman:seeder <package_name>MenuSeeder <package_name>` command

* in `run()` method add each menu in separate `if` conditions like the following codes:

** parent menu (first parent menu name must be equal to package name)

```
if (DB::table('module_menus')->where('name','<menu_name>')->count() == 0){ // for first parent you must use package_name for menu_name
    $parentID = DB::table('menu_menus')->insertGetId([ // set parent id of menu in $parentID variable
        'name' => '<menu_name>', // for first parent you must use package_name for menu_name
        'title' => '<package_first_parent_name>', // e.g. فرم ها
        'icon' => '<menu_icon>', // e.g. fa fa-wpforms
        'route' => '<menu_route>', // e.g. form.index
        'parent_id' => '0', // 0 for parent
        'creator_id' => '1', // creator user_id
        'created_at' => now()->toDateTimeString(), 
        'updated_at' => now()->toDateTimeString(),
        'deleted_at' => null,
    ]);
}
```

** child menu

```
if (DB::table('module_menus')->where('name','<menu_name>')->count() == 0){
    DB::table('module_menus')->insert([
        'name' => '<menu_name>', // menu name, e.g. site_forms
        'title' => '<child_name>', // menu title, e.g. ایجاد فرم
        'icon' => '<menu_icon>', // child menu icon, e.g. fa fa-circle-o
        'route' => '<menu_route>', // menu route, e.g. form.index
        'parent_id' => $parentID, // menu parent id, can be dynamic
        'creator_id' => '1', // creator user_id
        'created_at' => now()->toDateTimeString(),
        'updated_at' => now()->toDateTimeString(),
        'deleted_at' => null,
    ]);
}
```

#### PermissionsSeeder

> Create permission for each menu item

* create `<package_name>PermissionsSeeder` using
  `php artisan pacman:seeder <package_name>PermissionsSeeder <package_name>` command

* in `run()` method add the permissions in separate `if` conditions like the following code:

```
if (DB::table('permissions')->where('name','<permission_name>')->count() == 0){ // e.g. forms_access 
     DB::table('permissions')->insert([
          'name' => '<permission_name>', // e.g. forms_access 
          'display_name' => '<permission_display_name>', // e.g. دسترسی فرم ها
          'description' => '<permission_description>', // e.g. امکان دسترسی به فرم ها
          'created_at' => now()->toDateTimeString(),
          'updated_at' => now()->toDateTimeString()
     ]);
}
```

#### MenuPermissionsSeeder

> Connect each menu to specific permission

* create `<package_name>MenuPermissionsSeeder` using 
  `php artisan pacman:seeder <package_name>MenuPermissionsSeeder <package_name>` command
  
* in `run()` method add the following codes (first find menus, then attach theme permissions):

```
$parentMenu = ModuleMenu::where('name', '<parent_menu_name>')->first();
$childMenu = ModuleMenu::where('name', '<child_menu_name>')->first();

$parentMenu->permissions()->sync(Permission::where('name', '<permission_name>')->pluck('id'));
$childMenu->permissions()->sync(Permission::where('name', '<permission_name>')->pluck('id'));
```

#### RolePermissionsSeeder

> Connect each permission to specific role

* create `<package_name>RolePermissionsSeeder` using
  `php artisan pacman:seeder <package_name>RolePermissionsSeeder <package_name>` command

* in `run()` method add the following codes (first find role, then attach permissions to it):

```
$<role_name> = Role::where('name', '<role_name>')->first(); // main role

$permissions = DB::table('permissions')->whereIn('name', [
     '<permission_name_one>',
     '<permission_name_two>',
     ...
])->get()->pluck('id');
$<role_name>->permissions()->sync($permissions, false);
```

#### add new seeders in laravel core

* add new seeders in `/database/seeders/DatabaseSeeder.php` :

```
public function run()
{
  $this->call([
     ProvinceSeeder::class,
     UserSeeder::class,
     // new classes goes here
  ]);
}
```

#### Last step for laravel seeder

* run artisan seed :

`php artisan db:seed`

* clear all caches :

`php artisan cache:clear`

`php artisan view:clear`

`php artisan route:clear`

## ChangeLog

https://github.com/dizatech/module-menu/wiki/ChangeLog
