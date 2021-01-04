<?php
/**
 * Created by PhpStorm.
 * User: 20170703
 * Date: 2018/12/14
 * Time: 下午 04:54
 */

namespace App\Repository;

use App\Lesson;
use App\LessonStudents;
use App\Library\Tool;
use App\Services\LessonService;
use App\User;
use Illuminate\Support\Facades\DB;

class LessonRepository
{
    public function add(string $name, string $content, int $teachedId)
    {
        $model = new Lesson();
        $model->name = $name;
        $model->content = $content;
        $model->code = Tool::generateRandomString(3);
        $model->status = Lesson::LESSON_DISABLE;
        $model->teacherId = $teachedId;

        if ($model->save() == false) {
            throw new \Exception('新增課程失敗');
        }
        return $model;
    }

    public function update(int $lessonId, string $name, string $content)
    {
        return Lesson::where('id', $lessonId)
            ->update([
                'name' => $name,
                'content' => $content
            ]);
    }

    public function delete(int $lessonId)
    {
        return Lesson::where('id', $lessonId)
            ->update(['softDelete' => 1]);
    }

    public function findOne(int $lessonId)
    {
        return Lesson::where('id', $lessonId)
            ->where('status', Lesson::LESSON_ENABLE)
            ->where('softDelete', 0)
            ->first();
    }

    public function getStudentsByLessonId(int $lessonId)
    {
        return DB::table('users')
            ->join("lesson_students AS ls", "ls.studentId", "=", "users.id")
            ->select('users.name')
            ->where('users.softDelete', 0)
            ->where('users.type', User::TYPE_STUDENT)
            ->get();
    }

    public function changeTeacher(int $lessonId, int $teacherId)
    {
        return Lesson::where('id', $lessonId)
            ->update(['teacherId' => $teacherId]);
    }

    public function setTeacherAssistant(int $lessonId, int $studentId)
    {
        //確認該名學生有修此堂課
        $model = LessonStudents::where('lessonId', $lessonId)
                ->where('studentId', $studentId)
                ->update(['type' => LessonStudents::TEACHER_ASSISTANT]);
        if ($model == 0) {
            throw new \Exception('該名學生不在此課堂內');
        }
    }

    public function findTeacherAssistant(int $lessonId)
    {
        return LessonStudents::where('lessonId', $lessonId)
            ->where('type', LessonStudents::TEACHER_ASSISTANT)
            ->first();
    }

    public function selectLesson(int $lessonId, int $studentId)
    {
        return LessonStudents::firstOrNew([
            'lessonId' => $lessonId,
            'studentId' => $studentId
        ]);
    }

    public function withdraw(int $lessonId, int $studentId)
    {
        return LessonStudents::where('lessonId', $lessonId)
                ->where('studentId', $studentId)
                ->delete();
    }

    public function withdrawAllStudents(int $lessonId)
    {
        return LessonStudents::where('lessonId', $lessonId)
            ->delete();
    }

}
