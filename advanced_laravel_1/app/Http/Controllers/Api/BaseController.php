<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseController extends Controller{
    public function sendResponse($response , $status = 'success' , $code = 401)
    {
        return response()->json([
            'data' => $response,
            'status' => $status
        ],$code);
    }
    public function sendError($data){
        return $data;
    }
}
