<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widgets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 100)->nullable();
            $table->tinyInteger('ordered');
            $table->tinyInteger('status')->default(1)->comment('show, hide');
            $table->string('show_at')->default('home')->comment('home, page, blog');
            $table->integer('widget_type')->default('1')->comment('html, text, menu, recent_post, pages, kategori, archivedyear');
            $table->text('widget_content');
            $table->softDeletes();
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
        Schema::dropIfExists('widgets');
    }
}
