<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index() {
        try{
            $orders = OrderDetail::all();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'orders' => $orders
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

    public function show($id, Request $request) {
        try{
            $order = OrderDetail::find($id);
            if (!isset($order)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'Order Does Not Exist'
                ], 404);
            }
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'order' => $order,
                    'id' => Auth::id()
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
            $validateOrder = Validator::make($request->all(),
            [
                'user_id' => 'required',
                'total' => 'required',
                'variation' => 'required',
                'quantity' => 'required',
            ]);

            if ($validateOrder->fails()){
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'errors' => $validateOrder->errors()
                ], 405);
            }
            $order_detail = OrderDetail::create([
                "user_id"=> $request->user()->id,
                "total"=>$request->total,
            ]);
            if ($order_detail) {
                $order_item = OrderItem::create([
                    "product_variation_id"=>$request->variation,
                    "quantity"=>$request->quantity,
                    "order_detail_id"=>$order_detail->id,
                ]);
            }

            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'order' => $order_item,
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