<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Http\Services\UtilityService;
use App\Http\Requests\SellerRegisterRequest;
use App\Http\Requests\SellerLoginRequest;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    //
    protected $seller;
    protected $utilityService;

    public function __constructor(){

        $this->middleware('auth:seller', ['except'=>['login', 'register']]);
        $this->seller = new Seller;
        $this->utilityService = new UtilityService;

    }

    // public function register(UserRegisterRequest $request){
    //     $password_hash = $this->utilityService->hash_password($request->password);
    //     $this->user->createUser($request, $password_hash);
    //     $success_message = 'Registration completed';
    //     return $this->utilityService->is200Response($success_message);
    // }

    public function register(SellerRegisterRequest $request, UtilityService $uService, Seller $seller){
        $password_hash = $uService->hash_password($request->password);
        $seller->createUser($request, $password_hash);
        $success_message = "registration completed success";
        return $uService->is200Response($success_message);
    }

    public function login(SellerLoginRequest $request, UtilityService $uService){
        $credentials = $request->only(['email', 'password']);
        if(!$token = Auth::guard('seller')->attempt($credentials)){
            $responseMessage = 'Invalid email or password';
            return $uService->is422Response($responseMessage);
        }
        return $this->respondWithToken($token);
    }
}
