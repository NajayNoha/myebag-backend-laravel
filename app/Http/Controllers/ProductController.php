<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function createProduct(Request $request)
    {
        $validateProduct = Validator::make($request, [
            'name'=>'required',
            'sku'=>'required|unique:products,sku',
            'description'=>'required',
            'category_id'=> 'required',
            // ''=>,
            // ''=>,
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->des = $request->des;
        $product->sku = $request->sku;
        $product->categpry_id = $request->categpry_id;
        $product->invetory_id = $request->invetory_id;
        $product->price = $request->price;
        $product->discount_id = $request->discount_id;
    }
}
