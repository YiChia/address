<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonStudents extends Model
{
    const NORMAL_STUDENT = 0;
    const TEACHER_ASSISTANT = 1;

    protected $table = 'lesson_students';


}
