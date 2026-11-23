<?php

declare(strict_types=1);

namespace Shop\Services;

use Shop\Models\Product;
use Shop\Models\Customer;

class Cart
{
    private array $items = [];

    public function __construct(
        private Customer $customer
    ) {
    }

    public function add(Product $product, int $qty): void
    {
        $this->items[] = [
            'product' => $product,
            'qty'     => $qty,
        ];
    }

    public function getTotal(): float
    {
        $total = 0.0;

        foreach ($this->items as $item) {
            $total += $item['product']->price * $item['qty'];
        }

        return $total;
    }
}