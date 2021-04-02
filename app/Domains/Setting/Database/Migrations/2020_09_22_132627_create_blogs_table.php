<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id', 11)->key()->unsigned(false);
            $table->string('name_en');
            $table->string('name_ar')->nullable();
            $table->longText('data')->nullable();
            $table->integer('category_id')->index()->nullable();
            $table->integer('author_id')->index()->nullable();
            $table->integer('editor_id')->index()->nullable();
            $table->integer('order')->default(0);
            $table->enum('status', [config('system.status')])->default(config('system.status.deactivate'));
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id', 'blogs_category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('author_id', 'blogs_author_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('editor_id', 'blogs_editor_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
