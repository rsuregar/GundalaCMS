<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppModulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_moduls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('route_name',100);
            $table->unsignedBigInteger('role_id',10)->index();
            $table->integer('is_active');
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
        Schema::dropIfExists('app_moduls');
    }
}
