<?php

namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Http;

class AdminLoginRequest extends FormRequest{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'email'=>'required|email',
            'password'=>'required|min:8'
        ];
    }

    public function messages(){
        return [
            'email.required'=>'Email field is required',
            'email.email'=>'Please enter a valid email',
            'email.unique'=>'This email adress has already been taken',
            'password.required'=>'Password field is required',
            'password.min'=>'Password must be 8 characters long or longer'
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