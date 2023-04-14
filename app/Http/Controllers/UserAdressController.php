<?php

namespace App\Http\Controllers;

use App\Models\UserAdress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserAdressController extends Controller
{
    public function index() {
        try{
            $user_adress = UserAdress::all();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'user_adress' => $user_adress
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
            $user_adress = UserAdress::find($id);
            if (!isset($user_adress)){
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
                    'user_adress' => $user_adress
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
            $validateUserAdress = Validator::make($request->all(),
            [
                'user_id' => 'required',
                'adress_line1' => 'required',
                'city' => 'required',
                'postal_code' => 'required',
                'country' => 'required',
                'telephone' => 'required',
            ]);

            if ($validateUserAdress->fails()){
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'errors' => $validateUserAdress->errors()
                ], 405);
            }
            $user_adress = UserAdress::create([
                "user_id"=>$request->user_id,
                "adress_line1"=>$request->adress_line1,
                "adress_line2"=>$request->adress_line2,
                "city"=>$request->city,
                "postal_code"=>$request->postal_code,
                "country"=>$request->country,
                "telephone"=>$request->telephone,
                "mobile"=>$request->mobile,
            ]);
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'user_adress' => $user_adress,
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
            $user_adress = UserAdress::find($id);
            if (!isset($user_adress)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'User Adress Does Not Exist'
                ], 404);
            }
            $user_adress->user_id = $request->user_id;
            $user_adress->adress_line1 = $request->adress_line1;
            $user_adress->adress_line2 = $request->adress_line2;
            $user_adress->city = $request->city;
            $user_adress->postal_code = $request->postal_code;
            $user_adress->country = $request->country;
            $user_adress->telephone = $request->telephone;
            $user_adress->mobile = $request->mobile;
            $user_adress->save();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'user_adress' => $user_adress
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
            $user_adress = UserAdress::find($id);
            if (!isset($user_adress)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'User Adress Does Not Exist'
                ], 404);
            }
            $user_adress->delete();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'user_adress' => $user_adress
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