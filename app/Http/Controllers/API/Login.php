<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class Login extends  BaseController
{




    public function login(Request $request) {

        $input = $request->all();
        $validator = Validator::make($input , [
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if($validator->fails()){
            return $this->sendError('please Validate Error', $validator->errors());
        }

        if(Auth::attempt(['email'=> $request->email, 'password'=>$request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('@mohanedApiReq3@')->accessToken;
            $success['name'] = $user->name;
            $success['id'] = $user->id;
            $success['email'] = $user->email;
            $success['gender'] = $user->gender;
            $success['age'] = $user->age;
            return $this->sendResponse($success, 'User Login Successfuly');

        }else {
            return $this->sendError('Cheak Your Information', ['error'=>'Failed Login cheak Your Information']);

        }
    }


}
