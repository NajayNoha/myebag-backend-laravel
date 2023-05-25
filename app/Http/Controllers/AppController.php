<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Color;
use App\Models\Product;
use App\Mail\OrdersMail;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\SizeType;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AppController extends Controller
{
    public function index() {
        $sizes = SizeType::with('sizes')->get();
        $colors = Color::all();
        $orderStatuses = OrderStatus::all();
        // $categories = Category::with(['products' => [ 'images', 'variations' => [ 'size', 'color' ] ]])->get();
        $featured = Category::has('products')->with(['products' => [ 'images', 'category', 'variations' ]])->get();

        return response()->json([
            'code' => 'SUCCESS',
            'data' => [
                'sizes' => $sizes,
                'colors' => $colors,
                // 'categories' => $categories,
                'featured' => $featured,
                'order_statuses' => $orderStatuses
            ]
            ]);
    }

    public function dashboard() {
        $product_relationships = ['variations' => ['size', 'color'], 'images', 'category', 'size_type.sizes'];

        $sizes = SizeType::with('sizes')->get();
        $colors = Color::all();
        $users = User::all();
        $products = Product::with($product_relationships)->latest()->get();
        $orderStatuses = OrderStatus::all();
        $categories = Category::latest()->get();
        // $featured = Category::has('products')->with(['products' => [ 'images', 'category', 'variations' ]])->get();

        return response()->json([
            'code' => 'SUCCESS',
            'data' => [
                'sizes' => $sizes,
                'colors' => $colors,
                'categories' => $categories,
                'products' => $products,
                'users' => $users,
                'order_statuses' => $orderStatuses
            ]
            ]);
    }

    public function user(Request $request) {
        $cart = CartItem::where('user_id', auth()->id());

        return response()->json([
            'code' => 'SUCCESS',
            'data' => [

            ]
            ]);
    }
    public function testEmail(){
        try{
            // $user = User::create([
            //     'firstname'=> 'nohayla2',
            //     'lastname'=> 'najay1',
            //     'email'=> 'nohanajayy@gmail.com',
            //     'telephone'=> 7272753537,
            //     'password'=>'dshiofhfzzzer'
            // ]);
            // Mail::to('najaynohayla@gmail.com')->send(new OrdersMail($user));
            // toggle new order event
            // event(new NewOrder($order));

            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'order_detail' => '$order_detail',
                    ]
            ], 200);
        }
        catch(\Throwable $th) {
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
