<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index() {
        try{
            $categories = Category::all();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'categories' => $categories
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

    public function show($id) {
        try{
            $category = Category::find($id);
            if (!isset($category)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'Category Does Not Exist'
                ], 404);
            }
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'category' => $category
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
            $validateCategory = Validator::make($request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'image' => 'required|mimes:jpg,png,webp,jpeg|max:5048'
            ]);

            if ($validateCategory->fails()){
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'errors' => $validateCategory->errors()
                ], 405);
            }

            if(!$request->has('image')) {
                return response()->json([
                    'status' => true,
                    'code' => 'VALIDATION_ERROR',
                    'errors' => [
                        'image' => 'Image not uploaded'
                    ]
                ], 405);
            }

            // get extension
            $extention = $request->file('image')->getClientOriginalExtension();
            // generate unique name
            $image_name = substr(Str::slug($request->name), 0, 20) . '-' . uniqid() . '.' . $extention;
            // store file to images/categories/image_name
            $fullPath = '/images/categories/' . $image_name;
            $storePath = '/images/categories/';
            $request->file('image')->move(public_path() . $storePath, $image_name);

            $category = Category::create([
                "name"=>$request->name,
                "description"=>$request->description,
                "image"=>$fullPath
            ]);

            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'category' => $category,
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
            $category = Category::find($id);
            if (!isset($category)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'Category Does Not Exist'
                ], 404);
            }
            $category->name = $request->name;
            $category->description = $request->description;
            $category->image = $request->image;
            $category->save();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'category' => $category
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
            $category = Category::find($id);
            if (!isset($category)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'Category Does Not Exist'
                ], 404);
            }
            $category->delete();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'category' => $category
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
