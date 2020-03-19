<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('route_name',100);
            $table->index('route_name');
            $table->string('menu_name',100);
            $table->string('icon',100);
            $table->integer('parent_id');
            $table->integer('order_id');
            $table->integer('is_show');
            $table->timestamps();
            $table->foreign('route_name')
            ->references('name')->on('app_routes')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_menus');
    }
}
