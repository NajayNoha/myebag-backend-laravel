<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index() {
        try{
            $options = Option::all();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'options' => $options
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
            $option = Option::find($id);
            if (!isset($option)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'Option Does Not Exist'
                ], 404);
            }
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'option' => $option
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
            $validateOption = Validator::make($request->all(),
            [
                'option_name' => 'required',
                // 'option_value' => 'required',
            ]);

            if ($validateOption->fails()){
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'errors' => $validateOption->errors()
                ], 405);
            }
            $option = Option::create([
                "option_name"=>$request->option_name,
                "option_value"=>$request->option_value,
            ]);
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'option' => $option,
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


    public function updateMany(Request $request) {
        try{
            $validateOption = Validator::make($request->all(),
            [
                'options' => 'required',
            ]);

            if ($validateOption->fails()){
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'errors' => $validateOption->errors()
                ], 405);
            }

            $options = $request->options;
            $newOptions = [];
            foreach($options as $o) {
                $option = Option::where('option_name', $o['option_name'])->first();

                if(!$option) continue;

                $option->option_value = $o['option_value'];
                $option->save();
                $newOptions[] = $option;
            }

            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'options' => $newOptions,
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
            $option = Option::find($id);
            if (!isset($option)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'Option Does Not Exist'
                ], 404);
            }
            $option->delete();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'option' => $option
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
