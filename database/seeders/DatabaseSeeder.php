<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            SizeSeeder::class,
            ColorSeeder::class,
            OrderStatusSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            OptionSeeder::class,
            SliderSeeder::class
        ]);
    }
}
