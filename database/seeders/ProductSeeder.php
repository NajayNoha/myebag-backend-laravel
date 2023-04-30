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
                "size_type_id" => 2,
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
                "size_type_id" => 2,
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
                "size_type_id" => 2,
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
                "size_type_id" => 2,
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
            [
                'name' => "Butter Goods Orchard Pullover Hoody - Cream",
                'description' => "Butter Goods' Orchard Hoody is a pullover style piece made from a heavyweight, 100% cotton. It features a seasonal graphic and classic Butter logo printed to the chest, along with drawstring hood, kangaroo pouch and ribbed trims.",
                'sku' => "butter-goods-orchard-pullover-hoody-cream",
                "gender" => "mix",
                "category_id" => 2,
                "stock_alert" => 15,
                "size_type_id" => 1,
                "discount_id" => null,
                "variations" => [
                    'sizes' => [1, 2, 3, 4, 5, 6],
                    'color' => 7,
                    'quantity' => 10
                ],
                "images" => [
                    [
                        'path' => "storage/images/products/5/product_5_image_1.webp",
                        'order' => 1
                    ],
                    [
                        'path' => "storage/images/products/5/product_5_image_2.webp",
                        'order' => 2
                    ],
                ]
            ],
            [
                "name" => "Obey Step Hoody - Black",
                "description" => "Constructed from a cotton/polyester blend fleece, the Step Hoody by Obey features one of their seasonal graphics, embroidered front and centre. Also present is a drawstring hood, ribbed trims and kangaroo pouch.",
                "sku" => "obey-step-hoody-black",
                "gender" => "mix",
                "category_id" => 2,
                "stock_alert" => 15,
                "size_type_id" => 1,
                "discount_id" => null,
                "variations" => [
                    'sizes' => [1, 2, 3, 4, 5, 6],
                    'color' => 2,
                    'quantity' => 10
                ],
                "images" => [
                    [
                        'path' => "storage/images/products/6/product_6_image_1.webp",
                        'order' => 1
                    ],
                    [
                        'path' => "storage/images/products/6/product_6_image_2.webp",
                        'order' => 2
                    ],
                ]
            ],
            [
                "name" => "Pleasures Suffering Hoody - Black",
                "description" => "With oversized embroidery, the Pleasures Suffering Hoody comes in a heavyweight cotton poly blend. Featuring a large scale seasonal embroidered piece to the front alongside the Pleasures logo. The hoody is finished with ribbed cuffs and hem and a kangaroo pocket.",
                "sku" => "pleasures-suffering-hoody-black",
                "gender" => "mix",
                "category_id" => 2,
                "stock_alert" => 15,
                "size_type_id" => 1,
                "discount_id" => null,
                "variations" => [
                    'sizes' => [1, 2, 3, 4, 5, 6],
                    'color' => 2,
                    'quantity' => 10
                ],
                "images" => [
                    [
                        'path' => "storage/images/products/7/product_7_image_1.webp",
                        'order' => 1
                    ],
                    [
                        'path' => "storage/images/products/7/product_7_image_2.webp",
                        'order' => 2
                    ],
                ]
            ],
            [
                "name" => "Pleasures Blurry Hoody - Sand",
                "description" => "The Pleasures Blurry Hoody comes in a heavyweight cotton/poly blend. Featuring a printed logo to the front, the hoody is finished with ribbed cuffs and hem, drawstring hood and a kangaroo pocket.",
                "sku" => "pleasures-blurry-hoody-sand",
                "gender" => "mix",
                "category_id" => 2,
                "stock_alert" => 15,
                "size_type_id" => 1,
                "discount_id" => null,
                "variations" => [
                    'sizes' => [1, 2, 3, 4, 5, 6],
                    'color' => 7,
                    'quantity' => 10
                ],
                "images" => [
                    [
                        'path' => "storage/images/products/8/product_8_image_1.webp",
                        'order' => 1
                    ],
                    [
                        'path' => "storage/images/products/8/product_8_image_2.jpg",
                        'order' => 2
                    ],
                ]
            ],
            // [
            //     "name" => "",
            //     "description" => "",
            //     "sku" => "",
            //     "gender" => "mix",
            //     "category_id" => 2,
            //     "stock_alert" => 15,
            //     "size_type_id" => 1,
            //     "discount_id" => null,
            //     "variations" => [
            //         'sizes' => [1, 2, 3, 4, 5, 6],
            //         'color' => 1,
            //         'quantity' => 10
            //     ]
            // ],
        ];

        $watches = [
            [
                "name" => "Ladies Olivia Burton Mermaid Tail Watch",
                "description" => "If you've always wanted to channel some mermaid vibes, here's how. As you can probably tell, Olivia Burton must have had a lot of fun designing this mermaid-tail inspired timepiece. A shimmery rainbow of scalloped scales adorns the bold Demi dial, all set off by contemporary silver casing and mesh strap. This is guaranteed to bring a smile every time you look down at your wrist.",
                "sku" => "ladies-olivia-burton-mermaid-tail",
                "gender" => "mix",
                "category_id" => 3,
                "stock_alert" => 15,
                "size_type_id" => 2,
                "discount_id" => null,
                "variations" => [
                    'sizes' => [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17],
                    'color' => 9,
                    'quantity' => 10
                ],
                "images" => [
                    [
                        'path' => "storage/images/products/9/product_9_image_1.jpg",
                        'order' => 1
                    ],
                    [
                        'path' => "storage/images/products/9/product_9_image_2.jpg",
                        'order' => 2
                    ],
                    [
                        'path' => "storage/images/products/9/product_9_image_3.jpg",
                        'order' => 3
                    ],
                ]
            ],
            [
                "name" => "Mens Lacoste Watch",
                "description" => "Lacoste 2011050 is an amazing and attractive Gents watch from Heritage collection. Case is made out of Stainless Steel while the dial colour is White. In regards to the water resistance, the watch has got a resistancy up to 50 metres. It means it can be submerged in water for periods, so can be used for swimming and fishing. It is not recommended for high impact water sports. We ship it with an original box and a guarantee from the manufacturer.",
                "sku" => "mens-lacoste-watch",
                "gender" => "mix",
                "category_id" => 3,
                "stock_alert" => 15,
                "size_type_id" => 2,
                "discount_id" => null,
                "variations" => [
                    'sizes' => [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17],
                    'color' => 9,
                    'quantity' => 10
                ],
                "images" => [
                    [
                        'path' => "storage/images/products/10/product_10_image_1.jpg",
                        'order' => 1
                    ],
                    [
                        'path' => "storage/images/products/10/product_10_image_2.jpg",
                        'order' => 2
                    ],
                ]
            ],
            [
                "name" => "Mens Accurist Chronograph Watch",
                "description" => "A versatile and innovative chronograph from Accurist, bringing fun and flavour to a sensible and functional design.

                It's much more than the yellow dial which makes this new offering from the English manufacturers a style leader, although the yellow is hard to ignore! Rather than dominate the look of the watch, it sits beautifully alongside the white hands (which are outlined in black), providing a stark contrast yet achieving a modern look and feel.

                The black stainless steel strap (which we will resize for free) adds the layer of elegance and sophistication which brings together these clashes of style into one cohesive and timeless watch. You wouldn’t normally expect to see such a vibrant and playful watch as a chronograph, but you can here you can enjoy all the benefits that a stopwatch and an independent sweep second hand add to this unique piece.",
                "sku" => "mens-accurist-chronograph-watch",
                "gender" => "mix",
                "category_id" => 3,
                "stock_alert" => 15,
                "size_type_id" => 2,
                "discount_id" => null,
                "variations" => [
                    'sizes' => [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17],
                    'color' => 2,
                    'quantity' => 10
                ],
                "images" => [
                    [
                        'path' => "storage/images/products/11/product_11_image_1.webp",
                        'order' => 1
                    ],
                    [
                        'path' => "storage/images/products/11/product_11_image_2.webp",
                        'order' => 2
                    ],
                    [
                        'path' => "storage/images/products/11/product_11_image_3.jpg",
                        'order' => 3
                    ],
                ]
            ],
            [
                "name" => "Mens HUGO #Seek Watch",
                "description" => "HUGO #Seek 1530151 is an amazing and special Gents watch from #Seek collection. Case material is Stainless Steel, which stands for a high quality of the item while the dial colour is Black. In regards to the water resistance, the watch is marked as water resistant to 30 metres. This means it can be worn in scenarios where it is likely to be splashed but not immersed in water. It can be worn while washing your hands and will be fine in rain. The watch is shipped with an original box and a guarantee from the manufacturer.",
                "sku" => "mens-hugo-seek-watch",
                "gender" => "mix",
                "category_id" => 3,
                "stock_alert" => 15,
                "size_type_id" => 2,
                "discount_id" => null,
                "variations" => [
                    'sizes' => [7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17],
                    'color' => 9,
                    'quantity' => 10
                ],
                "images" => [
                    [
                        'path' => "storage/images/products/12/product_12_image_1.webp",
                        'order' => 1
                    ],
                    [
                        'path' => "storage/images/products/12/product_12_image_2.jpg",
                        'order' => 2
                    ],
                    [
                        'path' => "storage/images/products/12/product_12_image_3.jpg",
                        'order' => 3
                    ],
                ]
            ],
        ];


        $this->insertData($shoes);
        $this->insertData($hoodies);
        $this->insertData($watches);

    }


    public function insertData($items) {
        foreach($items as $item) {
            $product = Product::create([
                'name' => $item['name'],
                'description' => $item['description'],
                'sku' => $item['sku'],
                'gender' => $item['gender'],
                'category_id' => $item['category_id'],
                'stock_alert' => $item['stock_alert'],
                'size_type_id' => $item['size_type_id'],
                'discount_id' => $item['discount_id'],
            ]);

            foreach($item['variations']['sizes'] as $size) {
                ProductVariation::create([
                    'product_id' => $product->id,
                    'size_id' => $size,
                    'color_id' => $item['variations']['color'],
                    'quantity' => 30,
                    'price' => 150
                ]);
            }

            foreach($item['images'] as $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $image['path'],
                    'order' => $image['order']
                ]);
            }
        }
    }
}
