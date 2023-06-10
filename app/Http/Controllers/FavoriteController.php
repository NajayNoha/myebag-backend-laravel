<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAdress;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $favorites = Favorite::all();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'favorites' => $favorites
                ]
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

    public function show($id)
    {
        try {
            $favorite = Favorite::find($id);
            if (!isset($favorite)) {
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'Favorite Does Not Exist'
                ], 404);
            }
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'favorite' => $favorite,
                ]
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

    public function store(Request $request)
    {
        try {
            $validateFavorite = Validator::make(
                $request->all(),
                [
                    "product_id" => "required|exists:products,id",
                    "user_id" => "required|exists:users,id",
                    "value" => "required"
                ]
            );

            if ($validateFavorite->fails()) {
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'errors' => $validateFavorite->errors()
                ], 405);
            }

            if ($request->value == 'true') {
                $favorite = Favorite::create([
                    "user_id" => $request->user()->id,
                    "product_id" => $request->product_id,
                    "value" => $request->value
                ]);
                return response()->json([
                    'status' => true,
                    'code' => 'SUCCESS',
                    'data' => [
                        'user' => $request->user(),
                        'favorite' => $favorite,
                    ]
                ], 200);
            }
            if ($request->value == 'false') {
                $favoriteDelete = Favorite::where('product_id', '=', $request->product_id)
                    ->where('user_id', '=', $request->user()->id)->get();

                $favoriteDelete->delete();
            }
        } catch (\Throwable $th) {
            $user = User::find(auth()->id());
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


    public function destroy($id)
    {
        try {
            $favorite = Favorite::find($id);
            if (!isset($favorite)) {
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'Favorite Does Not Exist'
                ], 404);
            }
            $favorite->delete();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'favorite' => $favorite
                ]
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
    public function toggel_fav(Request $request, $id)
    {
        try {
            $favorite = Favorite::where('product_id', '=', $id)
            ->where('user_id', '=', $request->user()->id)->first();
            if(!empty($favorite)){
                $favorite = new Favorite();
                $favorite->user_id = $request->user->id;
                $favorite->product_id = $id;
                $favorite->value = true;
                if($favorite->save()){
                    return response()->json([
                        'status' => true,
                        'code' => 'SUCCESS',
                        'data' => [
                            'favorite' => true
                        ]
                    ], 200);
                }else {
                    $favorite->delete();
                    return response()->json([
                        'status' => true,
                        'code' => 'SUCCESS',
                        'data' => [
                            'favorite' => false
                        ]
                    ], 200);
                }
            }

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
