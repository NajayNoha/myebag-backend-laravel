<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            //Validated
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 405);
            }


            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => __('auth.failed'),
                    'code' => 'INVALID_CREDENTIALS'
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'message' => 'Logged In Successfully',
                'data' => ['user' => $user]
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

    public function login_google(Request $request) {
        try {
            $google_id = $request->google_id;
            $jwt = $request->google_jwt;

            $user = User::where('google_id', $google_id)->first();

            if(isset($user)) {
                $user->google_jwt = $jwt;
                $user->google_id = $google_id;
                $user->save();

                Auth::loginUsingId($user->id);
                return response()->json([
                    'status' => true,
                    'code' => 'SUCCESS',
                    'message' => 'Logged In Successfully',
                    'data' => ['user' => $user]
                ], 200);
            }

            $new_user = User::create([
                'firstname' => $jwt['given_name'],
                'lastname' => $jwt['family_name'],
                'email' => $jwt['email'],
                'password' => Hash::make('testtest'),
                'telephone' => '',
                'is_admin' => 0,
                'is_active' => 1,
                'google_id' => $jwt['sub'],
                'google_jwt' => json_encode($jwt),
            ]);


            Auth::loginUsingId($new_user->id);
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'message' => 'Logged In Successfully',
                'data' => ['user' => $new_user]
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
