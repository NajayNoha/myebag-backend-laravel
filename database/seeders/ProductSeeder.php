<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shoes = [
            [
                "name" => "Nike Off-White x Air Jordan 1 Retro High OG 'UNC'",
                "description" => "Virgil Abloh team up with Nike deconstructed the Air Jordan 1 High that featured the iconic UNC colour. The Nike x OffWhite Air Jordan 1 series attracts a massive amount of attention and sell out instantly.",
                "sku" => "air-jordan-1-retro-high-og",
                "gender" => "mix",
                "category_id" => 1,
                "stock_alert" => 15,
                "size_type_id" => 1,
                "discount_id" => null,
                "variations" => [
                    'sizes' => [ 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17 ],
                    'color' => 1,
                    'quantity' => 10
                ],
                "images" => [
                    [
                        'path' => "storage/images/products/1/product_1_image_1.webp",
                        'order' => 1
                    ],
                    [
                        'path' => "storage/images/products/1/product_1_image_2.webp",
                        'order' => 2
                    ],
                    [
                        'path' => "storage/images/products/1/product_1_image_3.webp",
                        'order' => 3
                    ]
                ]
            ],
            [
                "name" => "Air Jordan 5 Retro 'Racer Blue'",
                "description" => "Signature mesh profile windows and reflective tops of tongues deviate from their stealthy surroundings in shades of silver, with the latter components also featuring detailing in the titular “Racer Blue” tone.",
                "sku" => "air-jordan-2-retro-racer-blue",
                "gender" => "mix",
                "category_id" => 1,
                "stock_alert" => 15,
                "size_type_id" => 1,
                "discount_id" => null,
                "variations" => [
                    'sizes' => [ 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17 ],
                    'color' => 4,
                    'quantity' => 10
                ],
                "images" => [
                    [
                        'path' => "storage/images/products/2/product_2_image_1.webp",
                        'order' => 1
                    ],
                    [
                        'path' => "storage/images/products/2/product_2_image_2.webp",
                        'order' => 2
                    ],
                    [
                        'path' => "storage/images/products/2/product_2_image_3.webp",
                        'order' => 3
                    ]
                ]
            ],
            [
                "name" => "Air Jordan 1 Zoom Air CMFT Womens Light Violet",
                "description" => "This Air Jordan 1 Zoom Comfort 'Easter' has been constructed in a pastel color hue that is inspired by the Easter eggs themselves. It features a cream-colored tumbled leather serving as the base of the upper while purple and pink leather overlays appear at the forefoot and light green accents appear on the heel counter and ankle collar. The Swoosh is made of mesh. The Jumpman logo is embossed, the black laces and tongue add further contrast, while the white covers the opaque sole edged with a beautiful semi-translucent rubber completes the design.",
                "sku" => "air-jordan-1-zoom-air-cmft-light-violet",
                "gender" => "mix",
                "category_id" => 1,
                "stock_alert" => 15,
                "size_type_id" => 1,
                "discount_id" => null,
                "variations" => [
                    'sizes' => [ 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17 ],
                    'color' => 6,
                    'quantity' => 10
                ],
                "images" => [
                    [
                        'path' => "storage/images/products/3/product_3_image_1.webp",
                        'order' => 1
                    ],
                    [
                        'path' => "storage/images/products/3/product_3_image_2.webp",
                        'order' => 2
                    ],
                    [
                        'path' => "storage/images/products/3/product_3_image_3.webp",
                        'order' => 3
                    ]
                ]
            ],
            [
                "name" => "Air Jordan 5 Retro 'Raging Bull' 2021",
                "description" => "This Nike Air Jordan 5 Retro 'Raging Bull' features a plush Varsity Red suede upper, equipped with black eyelets and a Jumpman-branded reflective silver tongue. The black midsoles and insignia dress atop, icy blue soles hit the underside of the tooling, and the signature “23” stamps near the heel complete the design.",
                "sku" => "air-jordan-5-retro-raging-bull-2021",
                "gender" => "mix",
                "category_id" => 1,
                "stock_alert" => 15,
                "size_type_id" => 1,
                "discount_id" => null,
                "variations" => [
                    'sizes' => [ 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17 ],
                    'color' => 3,
                    'quantity' => 10
                ],
                "images" => [
                    [
                        'path' => "storage/images/products/4/product_4_image_1.webp",
                        'order' => 1
                    ],
                    [
                        'path' => "storage/images/products/4/product_4_image_2.webp",
                        'order' => 2
                    ],
                    [
                        'path' => "storage/images/products/4/product_4_image_3.webp",
                        'order' => 3
                    ]
                ]
            ],
            // [
            //     "name" => "",
            //     "description" => "",
            //     "sku" => "",
            //     "gender" => "mix",
            //     "category_id" => 1,
            //     "stock_alert" => 15,
            //     "size_type_id" => 1,
            //     "discount_id" => null,
            //     "variations" => [
            //         'sizes' => [ 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17 ],
            //         'color' => 4,
            //         'quantity' => 10
            //     ]
            // ],
        ];

        $hoodies = [

        ];

        foreach($shoes as $shoe) {
            $product = Product::create([
                'name' => $shoe['name'],
                'description' => $shoe['description'],
                'sku' => $shoe['sku'],
                'gender' => $shoe['gender'],
                'category_id' => $shoe['category_id'],
                'stock_alert' => $shoe['stock_alert'],
                'size_type_id' => $shoe['size_type_id'],
                'discount_id' => $shoe['discount_id'],
            ]);

            foreach($shoe['variations']['sizes'] as $size) {
                ProductVariation::create([
                    'product_id' => $product->id,
                    'size_id' => $size,
                    'color_id' => $shoe['variations']['color'],
                    'quantity' => 30,
                    'price' => 150
                ]);
            }

            foreach($shoe['images'] as $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $image['path'],
                    'order' => $image['order']
                ]);
            }
        }
    }
}
