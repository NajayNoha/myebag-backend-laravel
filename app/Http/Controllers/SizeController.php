<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\SizeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // $sizes = DB::table('sizes')->join('size_types','sizes.size_type_id', 'size_types.id')
            // ->select('sizes.*', 'size_types.name')->get();
            $sizes = SizeType::with('sizes')->get();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'sizes' => $sizes
                ],
            ], 200);
        } catch (\PDOException $th) {
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // {
        // id: int,
        // name: string,
        // sizes: [
        //     {
        //     id: int,
        //     name: string
        //     }
        // ]
        // }
        try {
            $size_type = new SizeType();
            $size_type->name = $request->name;
            $size_type->save();
            if ($request->has('sizes')) {
                foreach ($request->sizes as $size) {
                    $s = new Size();
                    $s->value = $size['name'];
                    $s->size_type_id = $size_type->id;
                    $s->save();
                }
            }

            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'size' => $size_type->with('sizes')
                ],
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $size = SizeType::find($id);
            if (!isset($size)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'Size Does Not Exist'
                ], 404);
            }
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'size' => $size
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
        }    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,  $id)
    {
        try{
            $size_type = SizeType::find($id);
            if (!isset($size_type)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'size type Does Not Exist'
                ], 404);
            }
            $size_type->name = $request->name;
            $size_type->save();
            if ($request->has('sizes')) {
                foreach ($request->sizes as $size) {
                    if(Size::find($size->id)->where('size_type_id', $size_type->id)){
                        $s = Size::find($size->id)->where('size_type_id', $size_type->id);
                    }else {
                        $s = new Size();
                    }
                    $s->value = $size->name;
                    $s->size_type_id = $size_type->id;
                    $s->save();
                }
            }
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'sizes' => $size_type
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $size_type = SizeType::find($id);
            if (!isset($size_type)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'size type Does Not Exist'
                ], 404);
            }

            $size_type->sizes()->delete();
            $size_type->delete();
            // $sizes = Size::find($id)->where('size_type_id', $size_type->id);
            // foreach ($sizes as $size) {
            //     $size->delete();
            // }
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'sizes' => $size_type
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
