<?php

namespace App\Helpers;

class ProductHelper
{
    static public function with_state($product) {
        $quantity = 0;
        foreach ($product->variations as $variation) {
            $quantity += $variation->quantity;
        }

        $product->quantity_total = $quantity;

        return $product;
    }
}
