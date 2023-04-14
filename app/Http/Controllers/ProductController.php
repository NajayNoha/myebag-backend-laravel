<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Discount;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\Size;
use App\Models\SizeType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $products = Product::all()  ;
            foreach ($products as $product) {
                $product_variations = ProductVariation::where('product_id', $product->id);
                $product['product_variations'] = $product_variations;
                $product_images = ProductImage::where('product_id', $product->id);
                $product['images'] = $product_images;
            }
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'products' => $products
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
        try{
            $validateProduct = Validator::make($request->all(),
            [
                'name' => 'required',
                'sku'=> 'required|unique:product,sku',
                'description' => 'required',
                // 'images' => 'required'
                'size_type'=>'required',
                'size_values'=>'required',
                'price'=>'required',
                'quantity'=>'required',
                'category'=>'required',
                'stock_alert' => 'required',
                'discount' => 'required',
            ], [
                'name.required'=>'the product name is required',
                'sku.required'=>'the product sku is required',
                'sku.unique'=> 'the sku must be unique ',
                'category.required'=>'the product must have a category',
                'size_type.required'=>'please set wish size system you are using',
                'size_values.required'=>'the product must have sizes',
                'price.required'=>'the product must have a price',
                'quantity.required'=>'please set the quantity of the product',
                'stock_alert.required'=>'please set a stock alert ',
                'disount.required'=>'the discount is required',
                // 'images.required'=>'the product images are required',
            ]);

            if ($validateProduct->fails()){
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'errors' => $validateProduct->errors(),
                    'messages'=> $validateProduct->messages(),
                ], 405);
            }

            // ];
            $product = new Product();
            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->description = $request->description;
            $product->stock_alert = $request->stock_alert;
            $product->gender = $request->has('gender') ? $request->gender : 'mix';
            $product->category_id = $request->category_id;
            $request->has('discount_id') ? $product->discount_id = $request->category_id : '';
            if ($request->has('product_variations')) {
                foreach ($request->product_variations as $pvr) {
                    $pv = new ProductVariation();
                    $pv->product_id = $product->id;
                    $pv->size_id = $pvr->size_id;
                    $pvr->has('color_id') ? $pv->color_id = $pvr->color_id : '';
                    $pv->quantity = $pvr->quantity;
                    $pv->price = $pvr->price;
                    $pv->save();
                }
            }
            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $img = new ProductImage();
                    $img->id = $image->id;
                    $image->order = $image->order;
                    if ($image->hasFile('image1')) {
                        $file = $image->file('image1');
                        $extension = $file->getClientOriginalExtension();
                        $filename = $image->order . '.' . $extension;
                        $file->storeAs('public/images/products' . $product->sku, $filename);
                        $img->path = $image->path;
                    }
                    $img->save();
                }
            }
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'product' => $product,
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
            $product = Product::find($id);
            if (!isset($product)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'product Does Not Exist'
                ], 404);
            }
            $product_images = ProductImage::where('product_id', $id) ;
            $product_variations = ProductVariation::where('product_id', $id);
            $product['product_variations'] = $product_variations;
            $product['images'] = $product_images;
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'product' => $product
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
        }
    }

    public function edit(Request $request, $id) {
        try{
            $product = Product::find($id);
            if (!isset($product)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'Product Does Not Exist'
                ], 404);
            }
            $validateProduct = Validator::make($request->all(),
            [
                'name' => 'required',
                'sku'=> 'required|unique:product,sku',
                'description' => 'required',
                'images' => 'required',
                'size_type'=>'required',
                'size_values'=>'required',
                'price'=>'required',
                'quantity'=>'required',
                'category'=>'required',
                'stock_alert' => 'required',
                'discount' => 'required',
            ], [
                'name.required'=>'the product name is required',
                'sku.required'=>'the product sku is required',
                'sku.unique'=> 'the sku must be unique ',
                'category.required'=>'the product must have a category',
                'size_type.required'=>'please set wish size system you are using',
                'size_values.required'=>'the product must have sizes',
                'price.required'=>'the product must have a price',
                'quantity.required'=>'please set the quantity of the product',
                'stock_alert.required'=>'please set a stock alert ',
                'disount.required'=>'the discount is required',
                'images.required'=>'the product images are required',
            ]);

            if ($validateProduct->fails()){
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'errors' => $validateProduct->errors(),
                    'messages'=> $validateProduct->messages(),
                ], 405);
            }

            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->description = $request->description;
            $product->stock_alert = $request->stock_alert;
            $product->gender = $request->has('gender') ? $request->gender : 'mix';
            $product->category_id = $request->category_id;
            $request->has('discount_id') ? $product->discount_id = $request->category_id : '';
            if ($request->has('product_variations')) {
                foreach ($request->product_variations as $pvr) {
                    $pv = new ProductVariation();
                    $pv->product_id = $product->id;
                    $pv->size_id = $pvr->size_id;
                    $pvr->has('color_id') ? $pv->color_id = $pvr->color_id : '';
                    $pv->quantity = $pvr->quantity;
                    $pv->price = $pvr->price;
                    $pv->save();
                }
            }
            if ($request->has('images')) {
                foreach ($request->images as $image) {
                    $img = new ProductImage();
                    $img->id = $image->id;
                    $image->order = $image->order;
                    if ($image->hasFile('image1')) {
                        $file = $image->file('image1');
                        $extension = $file->getClientOriginalExtension();
                        $filename = $image->order . '.' . $extension;
                        $file->storeAs('public/images/products' . $product->sku, $filename);
                        $img->path = $image->path;
                    }
                    $img->save();
                }
            }
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'product' => $product,
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
            $product = Product::find($id);
            if (!isset($product)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'product Does Not Exist'
                ], 404);
            }
            $product_variations = ProductVariation::where('product_id', $product->id);
            $product_images = ProductImage::where('product_id', $product->id);
            foreach ($product_variations as $pv) {
                $pv->delete();
            }
            foreach ($product_images as $img) {
                $img->delete();
            }
            $product->delete();
            // you have to delete the orders too Or you better just desactivate it
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'product' => $product
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
