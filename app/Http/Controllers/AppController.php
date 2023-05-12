<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Category;
use App\Models\SizeType;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index() {
        $sizes = SizeType::with('sizes')->get();
        $colors = Color::all();
        // $categories = Category::with(['products' => [ 'images', 'variations' => [ 'size', 'color' ] ]])->get();
        $featured = Category::has('products')->with(['products' => [ 'images', 'category', 'variations' ]])->get();

        return response()->json([
            'code' => 'SUCCESS',
            'data' => [
                'sizes' => $sizes,
                'colors' => $colors,
                // 'categories' => $categories,
                'featured' => $featured
            ]
            ]);
    }
}
