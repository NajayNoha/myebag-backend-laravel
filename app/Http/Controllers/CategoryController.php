<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function show($id) {
        try{
            // $d = Category::findOrFail($id);
            $d = Category::all();
            return response()->json([
                'status' => true,
                'data' => $d,
            ], 200);
        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }
    
    public function create(Request $request) {
        try{
            $validateCategory = Validator::make($request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'image' => 'required'
            ]);

            if ($validateCategory->fails()){
                return response()->json([
                    'errors' => $validateCategory->errors()
                ], 401);
            }
            $category = Category::create([
                "name"=>$request->name,
                "description"=>$request->description,
                "image"=>$request->image
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Successfully Created',
                'data' => $category,
            ], 200);
        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    public function edit(Request $request, $id) {
        try{
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->image = $request->image;
            $category->save();
            return response()->json([
                'status' => true,
                'message' => 'Successfully Updated',
                'data' => $category,
            ], 200);
        }catch(\Throwable $e){
            return $e->getMessage();
        }
    }

    public function destroy(Request $request, $id) {
        try{
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json([
                'status' => true,
                'message' => 'Successfully Deleted'
            ], 200);
        }catch(\Throwable $e){
            return $e->getMessage();
        }    
    }
}