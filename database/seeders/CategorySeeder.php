<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Shoes',
                'description' => "Our selection of shoes offers both style and comfort, with options for every occasion. From casual sneakers to dressy heels, our footwear is designed to protect and support your feet while keeping you looking your best.",
                'image' => 'storage/images/categories/shoes.jpg'
            ],
            [
                'name' => 'Hoodies',
                'description' => "Stay cozy and comfortable with our selection of hoodies. Perfect for lounging around the house or running errands, our hoodies come in a variety of colors and styles to suit any taste. With a soft, warm material and a convenient hood, you'll never want to take it off.",
                'image' => 'storage/images/categories/hoodies.jpg'
            ],
            [
                'name' => 'Watches',
                'description' => "Add a touch of sophistication to your look with our collection of watches. Our timepieces are both functional and stylish, with options for both men and women. Whether you prefer a classic leather strap or a trendy metal band, our watches are sure to impress.",
                'image' => 'storage/images/categories/watches.jpg'
            ]
        ];

        foreach($categories as $category) {
            Category::create($category);
        }
    }
}
