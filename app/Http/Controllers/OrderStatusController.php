<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    public function index() {
        try{
            $order_status = OrderStatus::all();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'order_status' => $order_status
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
            $order_status = OrderStatus::find($id);
            if (!isset($order_status)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'Order status Does Not Exist'
                ], 404);
            }
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'Order Status' => $order_status
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
            $validateOrderStatus = Validator::make($request->all(),
            [
                'name' => 'required',
                'send_notification' => 'required',
                'mark_as_paid' => 'required',
                'text_color' => 'required',
                'background_color' => 'required',
            ]);

            if ($validateOrderStatus->fails()){
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'errors' => $validateOrderStatus->errors()
                ], 405);
            }
            $order_status = OrderStatus::create([
                "name"=>$request->name,
                "send_notification"=>$request->send_notification,
                "mark_as_paid"=>$request->mark_as_paid,
                "text_color"=>$request->text_color,
                "background_color"=>$request->background_color,
            ]);
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'Order Status' => $order_status,
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
            $order_status = OrderStatus::find($id);
            if (!isset($order_status)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'Order status Does Not Exist'
                ], 404);
            }
            $order_status->name = $request->name;
            $order_status->send_notification = $request->send_notification;
            $order_status->mark_as_paid = $request->mark_as_paid;
            $order_status->text_color = $request->text_color;
            $order_status->background_color = $request->background_color;
            $order_status->save();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'order status' => $order_status
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
            $order_status = OrderStatus::find($id);
            if (!isset($order_status)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'Order status Does Not Exist'
                ], 404);
            }
            $order_status->delete();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'order_status' => $order_status
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