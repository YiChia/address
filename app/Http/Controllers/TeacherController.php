<?php

namespace App\Http\Controllers;

use App\Services\TeacherService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    private $service;


    public function __construct()
    {
        $this->service = new TeacherService();
    }


    public function create(Request $request)
    {
        try {
            $teacherId = $this->service->add($request->post('account'), $request->post('name'), $request->post('password'));
            return $this->responseData(200, '老師資料建立成功 老師編號：'.$teacherId, $teacherId);
        } catch (\Exception $e) {
            return $this->responseData(101, '新增失敗:'. $e->getMessage());
        }
    }

    public function update(Request $request, int $teacherId)
    {
        try {
            $this->service->update($teacherId, $request->post('name'));
            return $this->responseData(200, '老師資料修改成功');
        } catch (\Exception $e) {
            return $this->responseData(101, '修改失敗:'. $e->getMessage());
        }
    }

    public function delete(Request $request, int $teacherId)
    {
        try {
            $this->service->delete($teacherId);
            return $this->responseData(200, '老師資料刪除成功');
        } catch (\Exception $e) {
            return $this->responseData(101, '刪除失敗:'. $e->getMessage());
        }
    }
}
