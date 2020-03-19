<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentsettings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comment_type', 20)->default('facebook')->comment('facebook, discus');
            $table->string('appId')->unique();
            $table->tinyInteger('status')->default(0)->comment('true, false');
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
        Schema::dropIfExists('commentsettings');
    }
}
