<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBaseMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('module')->comment('Module that installed the menu item');
            $table->bigInteger('key');
            $table->integer('priority')->comment('Lowest first');
            $table->string('icon');
            $table->string('text')->comment('Fallback name when translations is missing');
            $table->string('link');
            $table->text('active');
            $table->text('permissions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('base_menu');
    }
}
