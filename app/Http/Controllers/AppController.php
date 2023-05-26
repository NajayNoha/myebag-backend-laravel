<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Color;
use App\Models\Option;
use App\Models\Product;
use App\Mail\OrdersMail;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\SizeType;
use App\Models\OrderStatus;
use App\Models\ProductImage;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class AppController extends Controller
{
    public function index() {
        $sizes = SizeType::with('sizes')->get();
        $colors = Color::all();
        $options = Option::all();
        $orderStatuses = OrderStatus::all();
        $sliders = Slider::where('active', 1)->get();
        // $categories = Category::with(['products' => [ 'images', 'variations' => [ 'size', 'color' ] ]])->get();
        $featured = Category::has('products')->with(['products' => [ 'images', 'category', 'variations' ]])->get();

        return response()->json([
            'code' => 'SUCCESS',
            'data' => [
                'options' => $options,
                'sizes' => $sizes,
                'colors' => $colors,
                'sliders' => $sliders,
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
        $options = Option::all();
        $sliders = Slider::all();
        // $featured = Category::has('products')->with(['products' => [ 'images', 'category', 'variations' ]])->get();

        return response()->json([
            'code' => 'SUCCESS',
            'data' => [
                'options' => $options,
                'sizes' => $sizes,
                'colors' => $colors,
                'categories' => $categories,
                'products' => $products,
                'users' => $users,
                'sliders' => $sliders,
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
            // Mail::to($user->email)->send(new OrdersMail($user));
            // ->subject('Create Order On MyEbag')->from('MyEbag');
            // Mail::to($user->email)->send(new OrdersMail($email_data))->subject('Create Order On MyEbag')->from('MyEbag')
            // toggle new order event
            // event(new NewOrder($order));
            // $variation = ProductVariation::find(1);
            // $image = ProductImage::where(['product_id'=>1, 'order'=>1])->get();
            $name = Product::where(['id' => 1])->with(['images','variations'])->first();
            // $name = Product::find(1)->images()->limit(1);
            $i = $name->images->where('order', 1)->first();

            // array_push($items, $i);
           echo '<pre>';
           print_r([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => $i->path]);
           echo '</pre>';

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
