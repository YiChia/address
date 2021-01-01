<?php


namespace App\Repository;


use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentRepository
{
    public function add(string $account, string $name, string $password)
    {
        $model = new User();
        $model->account = $account;
        $model->name = $name;
        $model->password = Hash::make($password);
        $model->type = User::TYPE_STUDENT;

        if ($model->save() == false) {
            throw new \Exception('新增學生失敗');
        }

        return $model->id;
    }

    public function update(int $studentId, string $name)
    {
         return User::where('id', $studentId)
            ->where('type', User::TYPE_STUDENT)
            ->update(['name' => $name]);
    }

    public function delete(int $studentId)
    {
        return User::where('id', $studentId)
            ->where('type', User::TYPE_STUDENT)
            ->update(['softDelete' => 1]);
    }

}
