<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        try{
            $sliders = Slider::with('active', true);
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'sliders' => $sliders,
                    ]
            ], 200);
        }
        catch(\Throwable $th)
        {
            return response()
                ->json([
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
            $slider = Slider::find($id);
            if(!$slider) {
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND'
                ]);
            }

            $slider->active = $request->active == 'true' ? 1 : 0;
            $slider->save();

            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'slider' => $slider,
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


    public function store(Request $request)
    {
        try{

            DB::beginTransaction();
            $slider = new Slider();
            $slider->name = $request->name;
            $slider->link = $request->link;


            // image file
            $desktopFile = $request->file('desktop');
            $desktopExtension = $desktopFile->getClientOriginalExtension();

            $mobileFile = $request->file('mobile');
            $mobileExtension = $mobileFile->getClientOriginalExtension();

            $slider->save();
            // set image name
            $desktop_image_name = 'slider-img-' .$slider->id . '.' . $desktopExtension;
            $mobile_image_name = 'slider-img-' .$slider->id .'-mobile.' . $mobileExtension;

            // path where image should be saved | add product id to it.
            $path_to_save = 'images/sliders';

            $desktop_path = Storage::disk('public')->putFileAs($path_to_save, $desktopFile, $desktop_image_name);
            $mobile_path = Storage::disk('public')->putFileAs($path_to_save, $mobileFile, $mobile_image_name);

            $slider->desktop_image_path = 'storage/' . $desktop_path;
            $slider->mobile_image_path = 'storage/' . $mobile_path;

            $slider->save();

            DB::commit();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'slider' => $slider,
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
    public function show($id)
    {
        try{
            $slider = Slider::find($id);
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'slider' => $slider,
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

    public function update(Request $request, $id)
    {
        try{
            $slider = Slider::find($id);
            $slider->title = $request->title;
            $slider->subtitle = $request->subtitle;
            $slider->button_text = $request->button_text;
            $slider->button_link = $request->button_link;
            $slider->path = $request->path;
            $slider->active = $request->active;
            $slider->save();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS',
                'data' => [
                    'slider' => $slider,
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


    public function destroy($id)
    {
        try{
            $slider = Slider::find($id);
            if (!isset($slider)){
                return response()->json([
                    'status' => false,
                    'code' => 'NOT_FOUND',
                    'message' => 'slider Does Not Exist'
                ], 404);
            }

            $slider->delete();
            return response()->json([
                'status' => true,
                'code' => 'SUCCESS'
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
