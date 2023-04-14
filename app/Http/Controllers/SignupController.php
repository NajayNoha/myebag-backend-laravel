<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    public function register(Request $request)
    {
        try{
            $validatedData = Validator::make($request->all(), [
                'firstname' => 'required',
                'lastname' => 'required',
                'password' => 'required',
                'email' => 'required|email|unique:users,email'
            ]);
            if ($validatedData->fails()) {
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'errors' => $validatedData->errors()
                ], 405);
            }
            $user = User::create([
                "firstname"=>$request->firstname,
                "lastname"=>$request->lastname,
                "email"=>$request->email,
                "telephone"=> $request->telephone,                "password"=>Hash::make($request->password)
            ]);
            return response()->json([
                'status' => true,
                'code'=> 'SUCCESS',
                'message' => 'SignedUp In Successfully',
                'data'=> ['user' => $user],
            ], 200);
        }catch(\Throwable $th){
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
