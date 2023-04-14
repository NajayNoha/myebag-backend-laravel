<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function index() {
        try{
            $colors = Color::all();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'colors' => $colors
                ],
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
            $validateColor = Validator::make($request->all(),
            [
                'name' => 'required',
                'hex_code'=> 'required',
            ]);

            if ($validateColor->fails()){
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'errors' => $validateColor->errors()
                ], 405);
            }
            $color = Color::create([
                "name"=>$request->name,
                "hex_code"=>$request->hex_code,
            ]);
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'color' => $color,
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
            $color = Color::find($id);
            if (!isset($color)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'color Does Not Exist'
                ], 404);
            }
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'color' => $color
                ],
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
            $color = Color::find($id);
            if (!isset($color)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'Color Does Not Exist'
                ], 404);
            }
            $color->name = $request->name;
            $color->hex_code = $request->hex_code;
            $color->save();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'color' => $color
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
            $color = Color::find($id);
            if (!isset($color)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'color Does Not Exist'
                ], 404);
            }
            $color->delete();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'color' => $color
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
