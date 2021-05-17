<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function respondWithToken($token){
        return response()->json([
            'success'=>true,
            'token'=>$token,
            'token_type'=>'bearer',
            'expires_in'=>Auth::factory()->getTTL(),
        ]);
    }


}
