<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'name' => 'NEW',
                'mark_as_paid' => false,
                'send_notification' => false,
                'text_color' => '#000000',
                'background_color' => '#24ff99'
            ],
            [
                'name' => 'PROCESSING',
                'mark_as_paid' => false,
                'send_notification' => false,
                'text_color' => '#FFFFFF',
                'background_color' => '#636363'
            ],
            [
                'name' => 'DELIVERED',
                'mark_as_paid' => true,
                'send_notification' => false,
                'text_color' => '#FFFFFF',
                'background_color' => '#0091ff'
            ],
            [
                'name' => 'AWAITING COD',
                'mark_as_paid' => false,
                'send_notification' => false,
                'text_color' => '#000000',
                'background_color' => '#ff8800'
            ],
            [
                'name' => 'PROCESSING',
                'mark_as_paid' => false,
                'send_notification' => false,
                'text_color' => '#ffffff',
                'background_color' => '#0055ff',
                'type' => 'user'
            ],
            [
                'name' => 'SHIPPED',
                'mark_as_paid' => false,
                'send_notification' => false,
                'text_color' => '#ffffff',
                'background_color' => '#bb29ff',
                'type' => 'user'
            ],
            [
                'name' => 'COMPLETED',
                'mark_as_paid' => true,
                'send_notification' => false,
                'text_color' => '#ffffff',
                'background_color' => '#00bd65',
                'type' => 'user'
            ]
        ];

        foreach($statuses as $status) {
            OrderStatus::create($status);
        }
    }
}
