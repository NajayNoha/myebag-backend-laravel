<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            [
                'name' => 'WHITE',
                'hex_code' => '#FFFFFF'
            ],
            [
                'name' => 'BLACK',
                'hex_code' => '#000000'
            ],
            [
                'name' => 'RED',
                'hex_code' => '#FF0000'
            ],
            [
                'name' => 'BLUE',
                'hex_code' => '#0000FF'
            ],
            [
                'name' => 'GREEN',
                'hex_code' => '#00FF00'
            ],
            [
                'name' => 'VIOLET',
                'hex_code' => '#8F00FF'
            ]
        ];

        foreach($colors as $color) {
            Color::create($color);
        }
    }
}
