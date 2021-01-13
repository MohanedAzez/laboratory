<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result, $message){

        $reponse = [
            'success'=>true,
            'data' => $result,
            'message' => $message
        ];
        return response()->json($reponse, 200);
    }

    public function sendError($error, $errorMessage=[], $code=404){

        $reponse = [
            'success'=>false,
            'data' => $error

        ];
        if(!empty($errorMessage)){
            $reponse['data']=$errorMessage;
        }
        return response()->json($reponse, $code);
    }
}
