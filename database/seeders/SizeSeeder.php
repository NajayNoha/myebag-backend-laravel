<?php

namespace Database\Seeders;

use App\Models\Size;
use App\Models\SizeType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            [
                "name" => "UK",
                "sizes" => [
                    "XS", "S", "M", "L", "XL", "XXL"
                ]
                ],
                [
                    "name" => "EU",
                    "sizes" => [
                        30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40
                    ]
                ]
        ];

        foreach($sizes as $size) {

            $created = SizeType::create(
                [
                    'name' => $size['name']
                ]
                );

            foreach($size['sizes'] as $s) {

                Size::create([
                    'value' => $s,
                    'size_type_id' => $created->id
                ]);
            }
        }
    }
}
