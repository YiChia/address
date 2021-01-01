<?php

namespace App\Http\Controllers;

use App\Services\StudentService;
use Illuminate\Http\Request;
use PHPUnit\Util\Json;

class StudentController extends Controller
{
    private $service;


    public function __construct()
    {
        $this->service = new StudentService();
    }


    public function create(Request $request)
    {
        try {
            $studentId = $this->service->add($request->post('account'), $request->post('name'), $request->post('password'));
            return $this->responseData(200, '學生資料建立成功 學生編號：'.$studentId, $studentId);
        } catch (\Exception $e) {
            return $this->responseData(101, '新增失敗:'. $e->getMessage());
        }
    }

    public function update(Request $request, int $studentId)
    {
        try {
            $this->service->update($studentId, $request->post('name'));
            return $this->responseData(200, '學生資料修改成功');
        } catch (\Exception $e) {
            return $this->responseData(101, '修改失敗:'. $e->getMessage());
        }
    }

    public function delete(Request $request, int $studentId)
    {
        try {
            $this->service->delete($studentId);
            return $this->responseData(200, '學生資料刪除成功');
        } catch (\Exception $e) {
            return $this->responseData(101, '刪除失敗:'. $e->getMessage());
        }
    }
}
