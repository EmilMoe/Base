<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseMenuPermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_menu_permission', function (Blueprint $table) {
            $table->bigInteger('base_menu_id')->unsigned();
            $table->bigInteger('permission_id')->unsigned();
            $table->timestamps();
            $table->foreign('base_menu_id')->references('id')->on('base_menu')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('base_menu_permission');
    }
}
