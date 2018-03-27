<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('文章标题');
            $table->mediumtext('body')->nullable();
            $table->string('slug')->comment('seo 友好路径');
            $table->unsignedInteger('pid')->default(0);
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('tutorial_id')->index();
            $table->unsignedInteger('comment_count')->default(0)->comment('评论数');
            $table->unsignedInteger('follow_count')->default(0)->comment('关注数');
            $table->unsignedInteger('view_count')->default(0)->comment('访问数');
            $table->unsignedInteger('sort')->default(100);
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
        Schema::dropIfExists('articles');
    }
}
