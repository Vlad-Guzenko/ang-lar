<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//JWT
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Contracts\JWTSubject;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Manager as JWT;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }
    public function register(Request $request){
        $validator = Validator::make($request->json()->all(),[
            'first_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:8',
            'age'=>'required|integer|min:8|max:120',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        $user = User::create([
            'first_name'=>$request->json()->get('first_name'),
            'last_name'=>$request->json()->get('last_name'),
            'email'=>$request->json()->get('email'),
            'password'=>Hash::make($request->json()->get('password')),
            'age'=>$request->json()->get('age')
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(compact('user','token'),201);
    }

    public function login(Request $request){

        $credentials = $request->json()->all();
        try {
            if (!$token = JWTAuth::attempt($credentials)){
                return response()->json(['error'=>'invalid_credentials'],400);
            }
        }catch (JWTException $e){
            return response()->json(['error'=>'could_not_create_token'],500);
        }
        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser(){

        try {
            if (!$user = JWTAuth::parseToken()->authenticate()){
                return response()->json(['user_not_found'],404);
            }
        }catch (TokenExpiredException $e){
            return response()->json(['token_has_been_expired'],$e->getStatusCode());
        }catch (TokenInvalidException $e){
            return response()->json(['token_is_invalid'],$e->getStatusCode());
        }catch (JWTException $e){
            return response()->json(['token_absent'],$e->getStatusCode());
        }
        return response()->json(compact('user'));
    }

    public function logout() {

        /*$this->logHistory();*/

        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'status' => 'success',
                'msg' => 'You have successfully logged out.'
            ]);
        } catch (JWTException $e) {
            JWTAuth::unsetToken();
            // something went wrong tries to validate a invalid token
            return response()->json([
                'status' => 'error',
                'msg' => 'Failed to logout, please try again.'
            ]);
        }
    }
}
