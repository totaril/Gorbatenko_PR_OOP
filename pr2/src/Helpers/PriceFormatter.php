<?php

declare(strict_types=1);

namespace Shop\Helpers;

class PriceFormatter
{
    public static function format(float $price): string
    {
        $formatted = number_format($price, 2, ',', ' ');
        
        return $formatted . ' ₽';
    }
}