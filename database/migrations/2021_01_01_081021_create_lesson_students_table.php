<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_students', function (Blueprint $table) {
            $table->integer('lessonId')->comment('課程Id')->index();
            $table->integer('studentId')->comment('學生Id')->index();
            $table->integer('type')->comment('一般學生:0; 助教:1;');
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
        Schema::dropIfExists('lesson_students');
    }
}
