<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use Illuminate\Support\Arr;
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

            // send email


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

}
