<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request): \Illuminate\Http\JsonResponse
{
    try {
        //Validated
        $validateUser = Validator::make($request->all(),
            [
                'email' => 'required',
                'password' => 'required'
            ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'code' => 'VALIDATION_ERROR',
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 405);
        }


        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => false,
                'message' => __('auth.failed'),
                'code' => 'INVALID_CREDENTIALS'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'status' => true,
            'code'=> 'SUCCESS',
            'message' => 'Logged In Successfully',
            'data'=> ['user' => $user]
        ], 200);

    } catch (\Throwable $th) {
        return response()->json(
            [
                'status' => false,
                'message' => $th->getMessage(),
                'code' => 'SERVER_ERROR'
            ],
            500
        );
    }
}

}
