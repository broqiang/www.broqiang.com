<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('avatar')->default('https://image.broqiang.com/avatar_default_php.png');
            $table->string('realname',64)->default('');
            $table->string('introduction')->default('');
            $table->string('tel',64)->default('');
            $table->string('wechat',64)->default('');
            $table->string('qq',64)->default('');
            $table->string('github',64)->default('')->comment('github 主页');
            $table->string('github_account',64)->default('')->comment('github 账号');
            $table->string('homepage',128)->default('')->comment('个人主页链接');
            $table->string('weibo',128)->default('')->comment('个人主页链接');
            $table->boolean('is_admin')->default(0)->comment('是否是管理员: 0 - 否,1 - 是');
            $table->boolean('status')->default(0)->comment('用户状态: 0 - 正常,1 - 禁用');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('avatar');
            $table->dropColumn('introduction');
            $table->dropColumn('github');
            $table->dropColumn('github_account');
            $table->dropColumn('homepage');
            $table->dropColumn('weibo');
        });
    }
}
