<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function index() {
        try{
            $users = User::all();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'users' => $users
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
    public function show($id) {
        try{
            $user = User::find($id);
            if (!isset($user)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'User Does Not Exist'
                ], 404);
            }
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'user' => $user
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

    public function store(Request $request) {
        try{
            $validateUser = Validator::make($request->all(),
            [
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'errors' => $validateUser->errors()
                ], 405);
            }
            $user = User::create([
                "firstname"=>$request->firstname,
                "lastname"=>$request->lastname,
                "email"=>$request->email,
                "password"=>Hash::make($request->password)
            ]);
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'user' => $user,
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

    public function edit(Request $request, $id) {
        try{
            $user = User::find($id);
            if (!isset($user)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'User Does Not Exist'
                ], 404);
            }
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'user' => $user
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


    public function destroy(Request $request, $id) {
        try{
            $user = User::find($id);
            if (!isset($user)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'User Does Not Exist'
                ], 404);
            }
            $user->delete();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'user' => $user
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