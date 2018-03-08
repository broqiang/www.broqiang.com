<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->mediumtext('body');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('skill_id')->unsigned()->index();
            $table->integer('comment_count')->unsigned()->default(0);
            $table->integer('follow_count')->unsigned()->default(0);
            $table->integer('view_count')->unsigned()->default(0);
            $table->integer('order')->unsigned()->default(100);
            $table->string('excerpt',512);
            $table->string('slug')->default('');
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
        Schema::dropIfExists('posts');
    }
}
