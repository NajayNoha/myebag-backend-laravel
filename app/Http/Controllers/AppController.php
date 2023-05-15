<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Color;
use App\Models\Category;
use App\Models\OrderStatus;
use App\Models\Product;
use App\Models\SizeType;
use Illuminate\Http\Request;

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
                // 'featured' => $featured,
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
}
