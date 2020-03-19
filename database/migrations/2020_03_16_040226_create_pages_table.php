<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('author');
            $table->string('title');
            $table->string('slug');
            $table->longText('content')->nullabe();
            $table->string('status',30)->default('draft')->comment('draft, revision, published, trashed');
            $table->string('meta')->nullable();
            $table->string('keyword')->nullable();
            $table->string('visibility', 20)->default('public')->comment('public, private');
            $table->string('password', 20)->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('sidebar')->default(0)->comment('1=show, 0=hide');
            $table->integer('is_slider')->default(0)->comment('1=set, 0=unset');
            $table->integer('is_featured')->default(0)->comment('1=set, 0=unset');
            $table->timestamps();
            $table->foreign('author')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
