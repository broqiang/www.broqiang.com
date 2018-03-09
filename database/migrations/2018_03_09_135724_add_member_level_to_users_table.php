<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMemberLevelToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 为用户表添加 用户等级字段
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('member_level')->default(0)->comment('用户等级: 0 - 普通用户,1 - 高级用户');
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
            $table->dropColumn('member_level');
        });
    }
}
