<?php


namespace App\Services;


use App\Repository\LessonRepository;

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
        $this->respository->delete($lessonId);
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

}
