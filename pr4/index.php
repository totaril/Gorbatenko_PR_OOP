<?php

declare(strict_types=1);

require __DIR__ . '/QueryBuilder.php';

echo "1 запрос ". PHP_EOL;
$query1 = QueryBuilder::table('users')
    ->select('id', 'name', 'email')
    ->where('age', '>=', 18)
    ->where('city', '=', 'Москва')
    ->orderBy('name')
    ->limit(10);

echo $query1->toSql();

echo PHP_EOL . "2 запрос" . PHP_EOL;
echo QueryBuilder::table('products')
    ->where('price', '<', 500)
    ->orderBy('price', 'desc');

echo PHP_EOL . "3 запрос" . PHP_EOL;
echo QueryBuilder::table('articles')
    ->select('title')
    ->where('title', 'LIKE', '%PHP%')
    ->where('views', '>', 1000);
echo PHP_EOL;

echo PHP_EOL . "Проверка работы исключений" . PHP_EOL;

try {
    echo QueryBuilder::table('users')->orderBy('name', 'WRONG_DIRECTION');
} catch (InvalidArgumentException $e) {
    echo "Ошибка 1: " . $e->getMessage() . PHP_EOL;
}

try {
    echo QueryBuilder::table('users')->limit(0);
} catch (InvalidArgumentException $e) {
    echo "Ошибка 2: " . $e->getMessage() . PHP_EOL;
}

try {
    echo QueryBuilder::table('users')->where('age', 'LIKE_IT', 5);
} catch (InvalidArgumentException $e) {
    echo "Ошибка 3: " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL . "Дополнительное задание" . PHP_EOL;
echo QueryBuilder::table('users')
    ->whereCity('Санкт-Петербург')
    ->whereAge(25);
echo PHP_EOL;
