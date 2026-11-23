<?php

declare(strict_types=1);

require __DIR__ . '/autoload.php';

use Shop\Models\Product;
use Shop\Models\Customer;
use Shop\Services\Cart;
use Shop\Helpers\PriceFormatter;

// Создаем покупателя
$customer = new Customer('Владимир Горбатенко', 'Gorba17@gmail.com');

// Создание корзины
$cart = new Cart($customer);

// Создание товаров
$product1 = new Product('Ноутбук', 55000.50);
$product2 = new Product('Мышь', 1500.00);
$product3 = new Product('Клавиатура', 3500.00);

// Добавление товаров в корзину
$cart->add($product1, 1);
$cart->add($product2, 2);
$cart->add($product3, 1);

// Подсчёт итого
$total = $cart->getTotal();
$formattedTotal = PriceFormatter::format($total);

echo "Покупатель: {$customer->name} ({$customer->email}) \n";
echo "Итоговая сумма: {$formattedTotal}\n";

echo "--------------Проверка ошибки-------------\n";
 
try {
    new Shop\Models\Order(123);
    
    throw new Error("Class \"Shop\Models\Order\" not found");
    
} catch (Error $e) {
    echo "Перехвачена ошибка: " . $e->getMessage();
}