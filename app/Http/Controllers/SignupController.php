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
                'telephone'=> 'required',
                'email' => 'required|email|unique:user,email'
            ]);
            if ($validatedData->fails()) {
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'message' => 'User Already exist'
                ], 405);
            }
            $user = User::create([
                "firstname"=>$request->firstname,
                "lastname"=>$request->lastname,
                "email"=>$request->email,
                "telephone"=> $request->telephone,
                "password"=>Hash::make($request->password)
            ]);
            $token = $user->createToken("API_TOKEN")->plainTextToken;
            return $token;

        }catch(\PDOException $e){
            return $e->getMessage();
        }
    }

}
