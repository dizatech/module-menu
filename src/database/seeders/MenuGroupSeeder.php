<?php

namespace Dizatech\ModuleMenu\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_groups')->insertOrIgnore([
            [
                'id' => 1,
                'title' => 'منو‌پیمایشی',
                'slug' => 'navbar-menu',
                'status' => 1
            ],
            [
                'id' => 2,
                'title' => 'منو‌فوتر',
                'slug' => 'footer-menu',
                'status' => 1
            ]
        ]);
    }
}
