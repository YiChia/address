<?php


namespace App\Services;


use App\Repository\StudentRepository;

class StudentService
{
    private $respository;

    public function __construct()
    {
        $this->respository = new StudentRepository();
    }

    public function add(string $account, string $name, string $password)
    {
        $studentId = $this->respository->add($account, $name, $password);
        return $studentId;
    }

    public function update(int $studentId, string $name)
    {
        $this->respository->update($studentId, $name);
    }

    public function delete(int $studentId)
    {
        $this->respository->delete($studentId);
    }
}
