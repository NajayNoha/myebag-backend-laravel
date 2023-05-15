<?php

namespace App\Http\Controllers;

use App\Events\NewOrder;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index() {
        try{
            $orders = OrderDetail::with(['user', 'order_items' => ['product_variation'], 'payment_detail', 'order_status'])->latest()->get();
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
            $order = OrderDetail::with(['user', 'order_items' => ['product_variation'], 'payment_detail', 'order_status'])->where('id', $id)->first();
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
            ]);

            if ($validateOrder->fails()){
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'errors' => $validateOrder->errors()
                ], 405);
            }
            $order_detail = OrderDetail::create([
                "user_id" => $request->user()->id,
                "total" => $request->total,
                "order_status_id" => 1
            ]);

            $data = $request->all();

            if ($order_detail) {
                foreach ($data['items'] as $item) {
                    $orderItem = new OrderItem();
                    $orderItem->product_variation_id = $item['product_variation_id'];
                    $orderItem->quantity = $item['quantity'];
                    $orderItem->order_detail_id = $order_detail->id;
                    $orderItem->save();
                }
            }
            $payment = $request->payment_details;
            if ($order_detail) {
                $payment_details = new PaymentDetail();
                $payment_details->order_detail_id = $order_detail->id;
                $payment_details->amount = $payment['amount'];
                $payment_details->provider = $payment['provider'];
                $payment_details->status = $payment['status'];
                $payment_details->save();
            }

            $order = OrderDetail::with(['user', 'order_items' => ['product_variation'], 'payment_detail', 'order_status'])->where('id', $order_detail->id)->first();


            event(new NewOrder($order));

            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'order_detail' => $order_detail,
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

    public function showUserOrders(Request $request) {
        try{
            $userId = $request->user()->id;
            $orders = OrderDetail::where('user_id', $userId)->get();
            if (!isset($orders)){
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
                    'user_orders' => $orders,
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
