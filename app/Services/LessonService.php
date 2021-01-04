<?php


namespace App\Services;


use App\Repository\LessonRepository;
use mysql_xdevapi\Exception;

class LessonService
{
    private $respository;

    public function __construct()
    {
        $this->respository = new LessonRepository();
    }

    public function add(string $name, string $content, int $teacherId)
    {
        return $this->respository->add($name, $content, $teacherId);
    }

    public function update(int $lessonId, string $name, string $content)
    {
        $this->respository->update($lessonId, $name, $content);
    }

    public function delete(int $lessonId)
    {
        $getStudentByLesson = $this->respository->getStudentsByLessonId($lessonId);

        $this->respository->delete($lessonId);

        if ($getStudentByLesson != null) {
            $this->respository->withdrawAllStudents($lessonId);
        }

    }

    public function getStudentList(int $lessonId)
    {
        $lessonModel = $this->respository->findOne($lessonId);
        $list = $this->respository->getStudentsByLessonId($lessonId)->toArray();
        foreach ($list as &$row) {
            $row = (array)$row;
        }
        return $list;
    }

    public function changeTeacher(int $lessonId, int $teacherId)
    {
        $lesson = $this->respository->findOne($lessonId);
        if ($lesson == null) {
            throw new \Exception('查無此課程');
        }

//        if ($lesson->teacherId != $teacherId) {
//            throw new \Exception('該課程已安排教師');
//        }

        $this->respository->changeTeacher($lessonId, $teacherId);

    }

    public function setTeacherAssistant(int $lessonId, int $studentId)
    {
        $getTeacherAssistantModel = $this->respository->findTeacherAssistant($lessonId);
        if ($getTeacherAssistantModel == null) {
            $this->respository->setTeacherAssistant($lessonId, $studentId);
        } else {
//            if ($getTeacherAssistantModel->studentId != $studentId) {
//                throw new \Exception('該課程已有選定的助教');
//            }
        }
    }

    public function selectLesson(int $lessonId, int $studentId)
    {
        $this->respository->selectLesson($lessonId, $studentId);
    }

    public function withdraw(int $lessonId, int $studentId)
    {
        $model = $this->respository->withdraw($lessonId, $studentId);
        if ($model == false) {
            throw new \Exception('退選失敗，請重試');
        }
    }

}
