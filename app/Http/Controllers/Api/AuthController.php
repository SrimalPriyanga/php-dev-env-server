<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Controllers\API\BaseController as BaseController;

class AuthController extends Controller
{
    public function login(Request $request){

        $loginData=$request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($loginData)){
            return response(['massage'=>'Invalid Credentials']);
        }

       // $success['token'] =  $loginData->createToken('authToken')->accessToken;

        $accessToken= auth()->user()->createToken('authToken')->accessToken;
        return response(['user'=>auth()->user(),$accessToken]);
    }

    public function index(){

    }
}
