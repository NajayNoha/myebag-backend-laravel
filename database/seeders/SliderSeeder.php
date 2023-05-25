<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sliders = [
            [
                'name' => "Slider 1",
                'desktop_image_path' => "storage/images/sliders/slider-img-1.webp",
                'mobile_image_path' => "storage/images/sliders/slider-img-1-mobile.webp",
                'link' => "/",
                'active' => true
            ],
            [
                'name' => "Slider 2",
                'desktop_image_path' => "storage/images/sliders/slider-img-2.webp",
                'mobile_image_path' => "storage/images/sliders/slider-img-2-mobile.webp",
                'link' => "/",
                'active' => true
            ],
            [
                'name' => "Slider 3",
                'desktop_image_path' => "storage/images/sliders/slider-img-3.webp",
                'mobile_image_path' => "storage/images/sliders/slider-img-3-mobile.webp",
                'link' => "/",
                'active' => true
            ],
        ];

        foreach($sliders as $slider) {
            Slider::create($slider);
        }
    }
}
