<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Events\NewOrder;
use App\Mail\OrdersMail;
use App\Models\OrderItem;
use App\Models\UserAdress;
use App\Models\OrderDetail;
use App\Models\OrderStatus;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\PaymentDetail;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index() {
        try{
            $orders = OrderDetail::with(['user', 'order_items' => ['product_variation' => [ 'product.images', 'size', 'color' ]], 'payment_detail', 'order_status', 'order_status_user', 'shipping_address'])->latest()->get();
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
            $order = OrderDetail::with(['user', 'order_items' => ['product_variation.product.images'], 'payment_detail', 'order_status', 'order_status_user', 'shipping_address'])->where('id', $id)->first();
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

            $address = [
                'user_id' => $request->user()->id,
                'adress_line1' => $request->shipping_address['address_line_1'],
                'adress_line2' => $request->shipping_address['address_line_2'],
                'city' => $request->shipping_address['city'],
                'postal_code' => $request->shipping_address['zip_code'],
                'country' => $request->shipping_address['country']
            ];

            $address = UserAdress::create($address);

            $order_detail = OrderDetail::create([
                "user_id" => $request->user()->id,
                "total" => $request->total,
                "order_status_id" => 1,
                "shipping_address_id" => $address->id
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
            $details = OrderDetail::with(['order_items'=> ['product_variation'], 'order_status', ])->where('id', $order_detail->id)->first();

            // $order = OrderDetail::with(['user', 'order_items' => ['product_variation' => ['product.images']], 'payment_detail', 'order_status', 'order_status_user', 'shipping_address'])->where('id', $order_detail->id)->first();
            // $user = User::find($request->user()->id);
            $email_data = [
                'user' => $request->user(),
                'order_details' => $details,
                'address'=> $address,
                'payment_details'=> $payment_details,
                'order_url' => 'http://localhost:8080/orders'
            ];
            Mail::to($request->user()->email)->send(new OrdersMail($email_data));

            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'user' => $request->user(),
                    'order_detail' => $details,
                    // 'items' =>
                    ]
            ], 200);
        }catch(\Throwable $th){
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

    public function updateOrderStatus(Request $request, $id) {
        try{
            // expecting
            // [
            //     'order_id'=>"",
            //     'order_status_id'=>"",
            //     'mark_as_paid'=>,
            //     'coustumer_id'=>,
            // ]
            // "user_id" => $request->user()->id,
            //     "total" => $request->total,
            //     "order_status_id" => 1,
            //     "shipping_address_id" => $address->id
            $order = OrderDetail::find($id);

            if(!isset($order)) {
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'Order Does Not Exist'
                ], 404);
            }

            if($request->type == 'admin') {
                $order->order_status_id = $request->status;
            }
            if($request->type == 'user') {
                $order->user_status_id = $request->status;
            }

            if($order->save()){
                $order = OrderDetail::with(['user', 'order_items' => ['product_variation.product.images'], 'payment_detail', 'order_status', 'order_status_user', 'shipping_address'])->where('id', $id)->first();

                return response()->json([
                    'status' => true,
                    'code' => 'SUCCESS',
                    'data' => [
                        'order' => $order,
                    ]
                ], 200);
            }
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

    public function confirmPayment(Request $request, $id) {
        try{

            $payment = PaymentDetail::find($id);

            if(!isset($payment)) {
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'Order Does Not Exist'
                ], 404);
            }

            $payment->status = true;

            if($payment->save()){

                return response()->json([
                    'status' => true,
                    'code' => 'SUCCESS',
                ], 200);
            }
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

    public function updateUserStatus(Request $request) {
        try{
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'order' => [],
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
            $orders = OrderDetail::with(['user', 'order_items' => ['product_variation' => [ 'product.images', 'size', 'color' ]], 'payment_detail', 'order_status', 'order_status_user', 'shipping_address'])->where('user_id', $userId)->get();
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
                    'orders' => $orders,
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
