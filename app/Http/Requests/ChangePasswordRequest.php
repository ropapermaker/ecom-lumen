<?php

namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Http;

class ChangePasswordRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'password'=>'required|min:8',
            'password_new'=>'required|min:8'
        ];
    }

    public function messages(){
        return [
            'password.required'=>'Password field is required',
            'password_new.required'=>'New password field is required',
            'password.min'=>'Password must be 8 characters long or longer',
            'password_new.min'=>'Password must be 8 characters long or longer'
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success'=>false,
            'error'=>$validator->errors(),
            'message'=>'One or more fields are required or not entered properly'
        ], 422));
    }


}