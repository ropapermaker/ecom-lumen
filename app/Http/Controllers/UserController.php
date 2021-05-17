<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\UtilityService;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    protected $user;
    protected $utilityService;

    public function __constructor(){

        $this->middleware('auth:user', ['except'=>['login', 'register']]);
        $this->user = new User;
        $this->utilityService = new UtilityService;

    }

    // public function register(UserRegisterRequest $request){
    //     $password_hash = $this->utilityService->hash_password($request->password);
    //     $this->user->createUser($request, $password_hash);
    //     $success_message = 'Registration completed';
    //     return $this->utilityService->is200Response($success_message);
    // }

    public function register(UserRegisterRequest $request, UtilityService $uService, User $user){
        $password_hash = $uService->hash_password($request->password);
        $user->createUser($request, $password_hash);
        $success_message = "registration completed success";
        return $uService->is200Response($success_message);
    }

    // public function login(UserLoginRequest $request){
    //     $credentials = $request->only(['email', 'password']);
    //     if(!$token = Auth::guard('user')->attempt($credentials)){
    //         $responseMessage = 'Invalid email or password';
    //         return $this->utilityService->is422Response($responseMessage);
    //     }
    //     return $this->respondWithToken($token);
    // }

    public function login(UserLoginRequest $request, UtilityService $uService){
        $credentials = $request->only(['email', 'password']);
        if(!$token = Auth::guard('user')->attempt($credentials)){
            $responseMessage = 'Invalid email or password';
            return $uService->is422Response($responseMessage);
        }
        return $this->respondWithToken($token);
    }

}
