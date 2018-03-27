<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('教程标题');
            $table->string('description', 1024)->comment('教程描述');
            $table->string('title_page')->default('')->comment('封面图片 url');
            $table->string('slug')->comment('seo 友好路径');
            $table->unsignedInteger('category_id')->comment('所属分类');
            $table->unsignedInteger('sort')->default(100);
            $table->unsignedInteger('follows')->default(0)->comment('关注人数');
            $table->unsignedInteger('visits')->default(0)->comment('访问数');
            $table->unsignedInteger('article_counts')->default(0)->comment('包含文章数量');
            $table->boolean('auth')->default(0)->comment('权限： 0-私有的， 1-公开，但是会被权限控制控制');
            $table->boolean('status')->default(0)->comment('状态: 0-禁用， 1-启用');
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
        Schema::dropIfExists('tutorials');
    }
}
