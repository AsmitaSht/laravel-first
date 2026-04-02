<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\API\BaseController as BaseController;

class AuthController extends BaseController
{
        public function signup(Request $request)
        {
            $validateUser=Validator::make(
                $request->all(),[
                'name'=>'required',
                'email'=>'required|email|unique:users,email',
                'password'=>'required',
                ]);

                if($validateUser->fails())
                    {
                    return $this->sendError('error',$validateUser->err0rs()->all());
                    }

            $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            ]);
            return $this->sendResponse($user,'User Created');
        }
        

        public function login(Request $request)
            {
            $validateUser=Validator::make(
                $request-> all(),[
                   'email'=>'required|email',
                    'password'=>'required',
                ]
            );

            if($validateUser->fails())
                {
                return $this->sendError('login fail',$validateUser->errors()->all());
                }
                if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
                    $AuthUser=Auth::user();
            return response()->json([
                'status'=>true,
                'message'=>'successful',
                'token'=>$AuthUser->createToken('Token_id')->plainTextToken,
                'token_type'=>'bearer'
            ],200);
            }
            else{
                return $this->sendError('Unauthorised');
            }
        }

            

        public function logout(Request $request){
        $user=$request->user();
        $user->tokens()->delete();

        return $this->sendResponse($user,'logout successful');
        }
}
        