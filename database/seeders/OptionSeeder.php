<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            [
                'id' => 1,
                'option_name' => 'name',
                'option_value' => 'My Ebag',
            ],
            [
                'id' => 2,
                'option_name' => 'description',
                'option_value' => 'My Ebag is an e-commerce website',
            ],
            [
                'id' => 3,
                'option_name' => 'pay_with_stripe',
                'option_value' => true,
            ],
            [
                'id' => 4,
                'option_name' => 'pay_with_paypal',
                'option_value' => true,
            ],
            [
                'id' => 5,
                'option_name' => 'pay_with_cod',
                'option_value' => true,
            ],
            [
                'id' => 6,
                'option_name' => 'stripe_live_secret_key',
                'option_value' => '',
            ],
            [
                'id' => 7,
                'option_name' => 'stripe_live_public_key',
                'option_value' => '',
            ],
            [
                'id' => 8,
                'option_name' => 'stripe_test_secret_key',
                'option_value' => env('STRIPE_TEST_SECRET_KEY', null),
            ],
            [
                'id' => 9,
                'option_name' => 'stripe_test_public_key',
                'option_value' => env('STRIPE_TEST_PUBLIC_KEY', null),
            ],
            [
                'id' => 10,
                'option_name' => 'stripe_mode_test',
                'option_value' => true,
            ],
            [
                'id' => 11,
                'option_name' => 'paypal_live_client_id',
                'option_value' => '',
            ],
            [
                'id' => 12,
                'option_name' => 'paypal_test_client_id',
                'option_value' => '',
            ],
            [
                'id' => 13,
                'option_name' => 'paypal_live_secret_key',
                'option_value' => '',
            ],
            [
                'id' => 14,
                'option_name' => 'paypal_test_secret_key',
                'option_value' => '',
            ],
            [
                'id' => 15,
                'option_name' => 'paypal_mode_test',
                'option_value' => true,
            ],
            [
                'id' => 16,
                'option_name' => 'logo_dark',
                'option_value' => '',
            ],
            [
                'id' => 17,
                'option_name' => 'logo_light',
                'option_value' => '',
            ],
            [
                'id' => 18,
                'option_name' => 'primary_color_name',
                'option_value' => "violet",
            ],
            [
                'id' => 19,
                'option_name' => 'primary_color_main',
                'option_value' => "#8b5cf6",
            ],
            [
                'id' => 20,
                'option_name' => 'primary_color_light',
                'option_value' => "#8b5cf6",
            ],
            [
                'id' => 21,
                'option_name' => 'primary_color_dark',
                'option_value' => "#a78bfa",
            ],
            [
                'id' => 22,
                'option_name' => 'secondary_color_name',
                'option_value' => "emerald",
            ],
            [
                'id' => 23,
                'option_name' => 'secondary_color_main',
                'option_value' => "#10b981",
            ],
            [
                'id' => 24,
                'option_name' => 'secondary_color_light',
                'option_value' => "#10b981",
            ],
            [
                'id' => 25,
                'option_name' => 'secondary_color_dark',
                'option_value' => "#34d399",
            ],
            [
                'id' => 26,
                'option_name' => 'logo_width',
                'option_value' => 28,
            ],
        ];

        foreach($options as $option) {
            Option::create($option);
        }
    }
}
