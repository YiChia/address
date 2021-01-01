<?php


namespace App\Services;


use App\Repository\TeacherRepository;

class TeacherService
{
    private $respository;

    public function __construct()
    {
        $this->respository = new TeacherRepository();
    }

    public function add(string $account, string $name, string $password)
    {
        $lessonId = $this->respository->add($account, $name, $password);
        return $lessonId;
    }

    public function update(int $lessonId, string $name)
    {
        $this->respository->update($lessonId, $name);
    }

    public function delete(int $lessonId)
    {
        $this->respository->delete($lessonId);
    }

}
