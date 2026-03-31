<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result,$message){
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];

        return response()->json($response,200);
    }

    public function sendError($error,$message=[],$code=404){
        $response=[
            'succcess'=>'false',
            'message'=>$error,
        ];
        if(!empty($message)){
            $response['data']=$message;
        }
        return response()->json($response, $code);
    }
}
