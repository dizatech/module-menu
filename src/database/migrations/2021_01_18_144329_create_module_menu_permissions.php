<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleMenuPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_menu_permissions', function (Blueprint $table) {
            $table->bigInteger('module_menu_id')->comment('column:id, table:module_menus');
            $table->bigInteger('permission_id')->comment('column:id, table:permissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_menu_permissions');
    }
}
