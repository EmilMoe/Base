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
            $table->bigInteger('key')->comment('Unique key to the entry');
            $table->integer('priority')->comment('Lowest first');
            $table->string('icon')->comment('HTML to parse icons');
            $table->string('text')->comment('Fallback name when translations is missing');
            $table->string('link')->('Route or URL method menu leading to');
            $table->text('active')->comment('Routes that renders the menu active');
            $table->text('permissions')->nullable()->comment('Permission key strings to see the entry');
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
