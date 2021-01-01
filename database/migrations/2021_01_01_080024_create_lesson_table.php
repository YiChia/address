<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('code')->unique()->index();
            $table->string('content')->comment('內容');
            $table->integer('teacherId')->comment('教師Id')->index();
            $table->tinyInteger('status')->default(0)->comment('停用:0; 啟用:1;');
            $table->tinyInteger('softDelete')->default(0)->comment('軟刪除 未刪除:0; 刪除:1;');
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
        Schema::dropIfExists('lesson');
    }
}
