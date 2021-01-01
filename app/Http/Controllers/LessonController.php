<?php

namespace App\Http\Controllers;

use App\Services\LessonService;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    private $service;

    /* TODO 授課老師驗證
     * 刪除課表邏輯
     */

    public function __construct()
    {
        $this->service = new LessonService();
    }

    public function create(Request $request)
    {
        try {
            $lessonModel = $this->service->add($request->post('name'), $request->post('content'), $request->post('teacherId'));
            return $this->responseData(200, '課程資料建立成功 課程代碼：'.$lessonModel->code, $lessonModel->code);
        } catch (\Exception $e) {
            return $this->responseData(101, '新增失敗:'. $e->getMessage());
        }
    }

    public function update(Request $request, int $lessonId)
    {
        try {
            $this->service->update($lessonId, $request->post('name'), $request->post('content'));
            return $this->responseData(200, '課程資料修改成功');
        } catch (\Exception $e) {
            return $this->responseData(101, '修改失敗:'. $e->getMessage());
        }
    }

    public function delete(Request $request, int $lessonId)
    {
        try {
            $this->service->delete($lessonId);
            return $this->responseData(200, '課程資料刪除成功');
        } catch (\Exception $e) {
            return $this->responseData(101, '刪除失敗:'. $e->getMessage());
        }
    }

    public function getStudentList(int $lessonId)
    {
        try {
            $list = $this->service->getStudentList($lessonId);
            return $this->responseData(200, '取得該課程學生列表成功', $list);
        } catch (\Exception $e) {
            return $this->responseData(101, '取得該課程學生列表失敗:'. $e->getMessage());
        }
    }
}
