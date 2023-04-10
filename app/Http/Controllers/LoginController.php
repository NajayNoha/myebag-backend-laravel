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
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        
        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'status' => false,
                'message' => 'Email & Password does not exist.',
            ], 401);
        }

        $user = User::where('email', $request->email)->first();
        // $is_admin = User::select('is_admin')->where('email', $request->email)->get();

        return response()->json([
            'status' => true,
            'message' => 'Logged In Successfully',
            'user' => $user,
            'token' => $user->createToken("API_TOKEN")->plainTextToken
        ], 200);

    } catch (\Throwable $e) {
        return response()->json([
            'status' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}

}