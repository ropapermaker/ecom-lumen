<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Services\UtilityService;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\ChangePasswordRequest;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    protected $user;
    protected $utilityService;

    public function __constructor()
    {
        $this->middleware('auth:user', ['except' => ['login', 'register']]);
        $this->user = new User;
        $this->utilityService = new UtilityService;
    }

    public function register(UserRegisterRequest $request, UtilityService $uService, User $user)
    {
        $password_hash = $uService->hash_password($request->password);
        $user->createUser($request, $password_hash);
        $success_message = "registration completed success";
        return $uService->is200Response($success_message);
    }

    public function login(UserLoginRequest $request, UtilityService $uService)
    {
        $credentials = $request->only(['email', 'password']);
        if (!$token = Auth::guard('user')->attempt($credentials)) {
            $responseMessage = 'Invalid email or password';
            return $uService->is422Response($responseMessage);
        }
        return $this->respondWithToken($token);
    }

    public function viewProfile(UtilityService $uService)
    {
        if (Auth::guard('user')->user() == null) {
            return $uService->is401Response('Unauthorized');
        }

        $responseMessage = 'user profile';
        $data = Auth::guard('user')->user();
        return $uService->is200ResponseWithData($responseMessage, $data);
    }

    public function logout(UtilityService $uService)
    {
        $responseMessage = "Successfully logged out";
        try {
            Auth::guard('user')->logout();
        } catch (TokenExpiredException $e) {
            $responseMessage = "Token has already been invalidated";
            return $uService->is422Response($responseMessage);
        }
        return $uService->is200Response($responseMessage);
    }

    public function changePassword(ChangePasswordRequest $request, UtilityService $uService)
    {
        $responseMessage = "Password changed successfully";

        $data = Auth::guard('user')->user();

        if ($uService->hash_check($request->password_old, $data->password)) {
            User::where('email', $data->email)
                ->update(['password' => $uService->hash_password($request->password_new)]);
            
            return $uService->is200Response($responseMessage);
        }

        $responseMessage = "Passwords don't match";
        return $uService->is422Response($responseMessage);
    }
}
