<?php

namespace App\Http\Controllers;

use App\Mail\VerificationMail;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class ResetPasswordController extends Controller
{
    public function index() {

    }

    public function requestResetPassword(Request $request) {
        try{
            $email = $request->email;

            $user = User::where('email', $email)->first();

            if(!isset($user)) {
                return response()->json([
                    'status' => false,
                    'code' => 'USER_NOT_FOUND',
                    'message' => 'User Does Not Exist'
                ], 200);
            }
            // generate the token
            $token = Str::random(30);
            $url = env('FRONTEND_URL', "http://localhost:8080");
            $data = [
                'url'=> $url . "/reset-password/". $token
            ];
            // update user to insert token into the data base
            $user->verification_token = $token;
            $user->save();
            // send email
            Mail::to($email)->send(new VerificationMail($data));


            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [

                    ]
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

    public function VerifyResetPassword(Request $request)
    {
        try {$token = $request->token ;
        $user = User::where('verification_token', $token)->first();
        if($user){
            return response()->json(
                [
                    'status' => true,
                    'message' => 'user exist',
                    'code' => 'VALID_TOKEN'
                ],
                200
            );
        }else {
            return response()->json(
                [
                    'status' => true,
                    'message' => 'user doesnt exist',
                    'code' => 'NOT_VALID_TOKEN'
                ],
                200
            );
        }
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
    public function UpdatePassword(Request $request)
    {
        try {
            $token = $request->token ;
            $password = $request->password;
            $user = User::where('verification_token', $token)->first();
            if($user){
                $user->password = Hash::make($password);
                $user->verification_token = null;
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'Password has been reset',
                        'code' => 'SUCCESS'
                    ],
                    200
                );
            }else {
                return response()->json(
                    [
                        'status' => true,
                        'message' => 'user doesnt exist',
                        'code' => 'NOT_VALID_TOKEN'
                    ],
                    200
                );
            }
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
