<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Services\UtilityService;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Requests\AdminLoginRequest;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    protected $admin;
    protected $utilityService;

    public function __constructor()
    {

        $this->middleware('auth:admin', ['except' => ['login', 'register']]);
        $this->admin = new Admin;
        $this->utilityService = new UtilityService;
    }

    public function register(AdminRegisterRequest $request, UtilityService $uService, Admin $admin)
    {
        $password_hash = $uService->hash_password($request->password);
        $admin->createUser($request, $password_hash);
        $success_message = "registration completed success";
        return $uService->is200Response($success_message);
    }

    public function login(AdminLoginRequest $request, UtilityService $uService)
    {
        $credentials = $request->only(['email', 'password']);
        if (!$token = Auth::guard('admin')->attempt($credentials)) {
            $responseMessage = 'Invalid email or password';
            return $uService->is422Response($responseMessage);
        }
        return $this->respondWithToken($token);
    }

    public function viewProfile(UtilityService $uService)
    {
        if (Auth::guard('admin')->user() == null) {
            return $uService->is401Response('Unauthorized');
        }

        $responseMessage = 'admin profile';
        $data = Auth::guard('admin')->user();
        return $uService->is200ResponseWithData($responseMessage, $data);
    }

    public function logout(UtilityService $uService)
    {
        $responseMessage = "Successfully logged out";
        try{
            Auth::guard('admin')->logout();
        } catch (TokenExpiredException $e){
            $responseMessage = "Token has already been invalidated";
            return $uService->is422Response($responseMessage);
        }
        return $uService->is200Response($responseMessage);
    }
}
