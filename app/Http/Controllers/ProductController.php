<?php

namespace App\Http\Controllers;

use App\Helpers\ProductHelper;
use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;
use App\Models\SizeType;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
            $relationships = ['variations' => ['size', 'color'], 'images', 'category', 'size_type.sizes'];

            // $products = Product::latest()->orderBy('id', 'DESC')->with($relationships)->get()
            $products = Product::with($relationships)->get()
            ->map(fn($p) => ProductHelper::with_state($p));

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

    public function all_active()
    {
        try{
            $relationships = ['variations' => ['size', 'color'], 'images', 'category', 'size_type.sizes'];

            // $products = Product::latest()->orderBy('id', 'DESC')->with($relationships)->get()
            $products = Product::with($relationships)->where('active', 1)->get()
            ->map(fn($p) => ProductHelper::with_state($p));

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

    public function storeImages(Request $request) {
        try {

            $images = [];

            foreach ($request->input('images') as $key => $image) {

                // Image order
                $order = $image['order'];

                // image file
                $file = $request->file('images')[$key]['image'];
                $extension = $file->getClientOriginalExtension();

                // set image name
                $image_name = 'product_' .$order .'_' . time().'.' . $extension;

                // path where image should be saved | add product id to it.
                $path_to_save = 'images/products';

                $path = Storage::disk('public')->putFileAs($path_to_save, $file, $image_name);

                $images[$order] = $path;
            }

            return response()->json($images);

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

    public function store(Request $request)
    {
        try{
            $validateProduct = Validator::make($request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'size_type_id'=>'required',
                'category_id'=>'required',
                'stock_alert' => 'required',
            ], [
                'name.required'=>'the product name is required',
                'name.description'=>'the product name is required',
                'category.required'=>'the product must have a category',
                'size_type_id.required'=>'please set wish size system you are using',
                'stock_alert.required'=>'please set a stock alert ',
            ]);

            if ($validateProduct->fails()){
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'errors' => $validateProduct->errors(),
                    'messages'=> $validateProduct->messages(),
                ], 405);
            }

            DB::beginTransaction();

            $product = new Product();
            $product->name = $request->name;
            $product->sku = Str::slug($product->name);
            $product->size_type_id = $request->size_type_id;
            $product->description = $request->description;
            $product->stock_alert = $request->stock_alert;
            $product->gender = $request->has('gender') ? $request->gender : 'mix';
            $product->category_id = $request->category_id;
            $product->has_colors = $request->has_colors ? 1 : 0;
            $product->same_price = $request->same_price ? 1 : 0;
            $product->discount_id = $request->has('discount_id') ? $request->discount_id : '';
            $product->discount_percentage = $request->discount_percentage;
            $product->is_discount_active = $request->is_discount_active;
            $product->save();
            if ($request->has('product_variations')) {
                foreach ($request->product_variations as $pvr) {
                    $pv = new ProductVariation();
                    $pv->product_id = $product->id;
                    $pv->size_id = $pvr['size_id'];
                    $pv->color_id = $pvr['color_id'];
                    $pv->quantity = $pvr['quantity'];
                    $pv->price = $pvr['price'];
                    $pv->buying_price = $pvr['buying_price'];
                    $pv->save();
                }
            }
            if ($request->has('images')) {

                foreach ($request->input('images') as $key => $image) {

                    // Image order
                    $order = $image['order'];

                    // image file
                    $file = $request->file('images')[$key]['image'];
                    $extension = $file->getClientOriginalExtension();

                    // set image name
                    $image_name = 'product_' . $product->id . '_' .$order .'.' . $extension;

                    // path where image should be saved | add product id to it.
                    $path_to_save = 'images/products/' . $product->id;

                    $path = Storage::disk('public')->putFileAs($path_to_save, $file, $image_name);

                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => 'storage/' . $path,
                        'order' => $order
                    ]);
                }
            }

            DB::commit();

            $product = Product::where('id', $product->id)->with(['images', 'variations' => ['size', 'color'], 'size_type.sizes'])->first();

            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'product' => $product,
                    ]
            ], 200);
        }catch(\Throwable $th){
            DB::rollBack();
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

    public function setActive(Request $request, $id)
    {
        try{
            $product = Product::find($id);
            if(!$product) {
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND'
                ]);
            }

            $product->active = $request->active == 'true' ? 1 : 0;
            $product->save();

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
            $product = Product::where([['id', $id]])->first();
            if (!isset($product)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'product Does Not Exist'
                ], 404);
            }
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'product' => Product::where('id', $id)->with(['category', 'variations' => [ 'size', 'color' ], 'images'])->first()
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

    public function show_active($id) {
        try{
            $product = Product::where([['id', $id], ['active', 1]])->first();
            if (!isset($product)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'product Does Not Exist'
                ], 404);
            }
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'product' => Product::where('id', $id)->with(['category', 'variations' => [ 'size', 'color' ], 'images'])->first()
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
                'description' => 'required',
                'size_type_id'=>'required',
                'category_id'=>'required',
                'stock_alert' => 'required',
            ], [
                'name.required'=>'the product name is required',
                'name.description'=>'the product name is required',
                'category.required'=>'the product must have a category',
                'size_type_id.required'=>'please set wish size system you are using',
                'stock_alert.required'=>'please set a stock alert ',
            ]);

            if ($validateProduct->fails()){
                return response()->json([
                    'status' => false,
                    'code' => 'VALIDATION_ERROR',
                    'errors' => $validateProduct->errors(),
                    'messages'=> $validateProduct->messages(),
                ], 405);
            }

            DB::beginTransaction();

            $product->name = $request->name;
            $product->description = $request->description;
            $product->stock_alert = $request->stock_alert;
            $product->gender = $request->has('gender') ? $request->gender : 'mix';
            $product->category_id = $request->category_id;
            $product->has_colors = $request->has_colors ? 1 : 0;
            $product->same_price = $request->same_price ? 1 : 0;
            $product->discount_percentage = $request->discount_percentage;
            $product->is_discount_active = $request->is_discount_active == 'true' ? 1 : 0;


            // return $request->deleted_variations;
            if($request->has('deleted_variations')) {
                foreach($request->deleted_variations as $d) {
                    $p = ProductVariation::where([['id', $d], ['product_id', $product->id]])->delete();
                }
            }

            if($request->has('new_variations')) {
                foreach($request->new_variations as $pvr) {
                    $pv = new ProductVariation();
                    $pv->product_id = $product->id;
                    $pv->size_id = $pvr['size_id'];
                    $pv->color_id = $pvr['color_id'];
                    $pv->quantity = $pvr['quantity'];
                    $pv->price = $pvr['price'];
                    $pv->buying_price = $pvr['buying_price'];
                    $pv->save();
                }
            }


            if($request->is_images_dirty == 'true') {

                if ($request->has('images')) {

                    $product->images()->delete();

                    foreach ($request->input('images') as $key => $image) {

                        // Image order
                        $order = $image['order'];

                        // image file
                        $file = $request->file('images')[$key]['image'];
                        $extension = $file->getClientOriginalExtension();

                        // set image name
                        $image_name = 'product_' . $product->id . '_' .$order .'.' . $extension;

                        // path where image should be saved | add product id to it.
                        $path_to_save = 'images/products/' . $product->id;

                        $path = Storage::disk('public')->putFileAs($path_to_save, $file, $image_name);

                        ProductImage::create([
                            'product_id' => $product->id,
                            'path' => 'storage/' . $path,
                            'order' => $order
                        ]);
                    }
                }
            }



            $product->save();
            DB::commit();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'product' => $product,
                    ]
            ], 200);

        }catch(\Throwable $th){
            DB::rollBack();
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
            $product_variations = ProductVariation::where('product_id', $product->id)->delete();
            $product_images = ProductImage::where('product_id', $product->id)->delete();
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
