<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * 回傳格式
     * @param $code
     * @param $msg
     * @param $data
     */
    public function responseData($code, $msg = '', $data = [])
    {
        $responseData = ['code' => $code, 'msg' => $msg, 'data' => $data];
        return response()->json($responseData, $code, [], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
