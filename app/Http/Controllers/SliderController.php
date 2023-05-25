<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        try{
            $slider = new Slider();
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
            if($slider->delete()){
                $sliders = Slider::with('active', true);
                return response()->json([
                    'status' => true,
                    'code' => 'SUCCESS',
                    'data' => [
                        'sliders' => $sliders,
                        ]
                ], 200);
            }else {
                throw new Exception("Error Processing Request", 1);
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
}
