<?php

declare(strict_types=1);

require __DIR__ . '/Book.php';
require __DIR__ . '/Library.php';

$library = new Library();

$library->addBook(new Book('Мастер и Маргарита', 'М. Булгаков', 1967, 480));
$library->addBook(new Book('Преступление и наказание', 'Ф. Достоевский', 1866, 671));
$library->addBook(new Book('Война и мир', 'Л. Толстой', 1869, 1225));
$library->addBook(new Book('1984', 'Дж. Оруэлл', 1949, 320));
$library->addBook(new Book('Гарри Поттер и философский камень', 'Дж. Роулинг', 1997, 332));


echo '---------------Все книги--------------' . PHP_EOL;
$library->printAll();

echo PHP_EOL . 'Всего книг: ' . $library->count() . PHP_EOL;



echo PHP_EOL . '--------------Поиск по автору: Дж. Оруэлл--------------' . PHP_EOL;

foreach ($library->findByAuthor('Дж. Оруэлл') as $book) {
    echo $book->getInfo() . PHP_EOL;
}


$oldest = $library->getOldest();

echo PHP_EOL . 'Самая старая книга: '
    . ($oldest?->getInfo() ?? 'библиотека пуста') . PHP_EOL;



echo PHP_EOL . '--------------Присваивание и клонирование--------------' . PHP_EOL;

$b1 = new Book('Оригинал', 'Автор', 2000, 100);
$b2 = $b1;
$b3 = clone $b1;

$b1->title = 'Изменённое название';

echo '$b1: ' . $b1->getInfo() . PHP_EOL;
echo '$b2: ' . $b2->getInfo() . PHP_EOL;
echo '$b3: ' . $b3->getInfo() . PHP_EOL;