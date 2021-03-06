<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account')->unique()->index();
            $table->string('name');
            $table->string('password');
            $table->tinyInteger('status')->default(0)->comment('停用:0; 啟用:1;');
            $table->tinyInteger('type')->default(0)->comment('身份 學生:0; 老師:1');
            $table->tinyInteger('softDelete')->default(0)->comment('軟刪除 未刪除:0; 刪除:1;');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
