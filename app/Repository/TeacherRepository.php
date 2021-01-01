<?php


namespace App\Repository;


use App\User;
use Illuminate\Support\Facades\Hash;

class TeacherRepository
{
    public function add(string $account, string $name, string $password)
    {
        $model = new User();
        $model->account = $account;
        $model->name = $name;
        $model->password = Hash::make($password);
        $model->type = User::TYPE_TEACHER;

        if ($model->save() == false) {
            throw new \Exception('新增老師失敗');
        }

        return $model->id;
    }

    public function update(int $teacherId, string $name)
    {
        return User::where('id', $teacherId)
            ->where('type', User::TYPE_TEACHER)
            ->update(['name' => $name]);
    }

    public function delete(int $teacherId)
    {
        return User::where('id', $teacherId)
            ->where('type', User::TYPE_TEACHER)
            ->update(['softDelete' => 1]);
    }
}
