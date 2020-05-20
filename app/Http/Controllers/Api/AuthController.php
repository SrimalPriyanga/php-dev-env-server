<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\School;

//use App\Http\Controllers\API\BaseController as BaseController;

class AuthController extends Controller
{
    public function login(Request $request){

        $loginData=$request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($loginData)){
            return response(['massage'=>'Invalid Credentials'],401);
        }

        // $success['token'] =  $loginData->createToken('authToken')->accessToken;

        // $accessToken= auth()->user()->createToken('authToken')->accessToken;
        //return response(['user'=>auth()->user(),$accessToken]);

        $user = auth()->user();

        $tokenResult = $user->createToken('authToken');
        $token = $tokenResult->token;

        return response()->json([
            'user'=>auth()->user(),
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
        ]);


    }

    public function index(){
        return response(['schools'=>School::all()],200);
    }
}
