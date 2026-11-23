<?php

declare(strict_types=1);

require __DIR__ . '/Employee.php';
require __DIR__ . '/Manager.php';
require __DIR__ . '/Developer.php';

$manager = new Manager('Владимир Горбатенко', 80000, '1234 567890', 3);
$developer = new Developer('Никита Колесов', 100000, '9876 543210', 'senior');

$manager->raiseSalary(10);
$developer->raiseSalary(20);

$employees = [$manager, $developer];

echo "--------------- СПИСОК СОТРУДНИКОВ ---------------" . PHP_EOL;

foreach ($employees as $emp) {
    $type = get_class($emp);
    $salary = $emp->getSalary();
    $tax = $salary * 0.13;
    $salaryAfterTax = $salary - $tax;

    echo "Имя: {$emp->name}" . PHP_EOL;
    echo "Тип: {$type}" . PHP_EOL;
    echo "Паспорт: " . $emp->getMaskedPassport() . PHP_EOL;
    echo "Зарплата до налога: " . number_format($salary, 2, '.', ' ') . " руб." . PHP_EOL;
    echo "Зарплата после налога (13%): " . number_format($salaryAfterTax, 2, '.', ' ') . " руб." . PHP_EOL;
    echo str_repeat('-', 40) . PHP_EOL;
}

echo PHP_EOL . "=== ЭКСПЕРИМЕНТЫ С ДОСТУПОМ ===" . PHP_EOL;

echo "1. Чтение снаружи: " . $manager->name . PHP_EOL;

// Чтобы проверить ошибку чтения protected свойства:
// echo $manager->baseSalary;

// Чтобы проверить ошибку чтения private свойства:
// echo $manager->passport;

// Чтобы проверить ошибку вызова protected метода снаружи:
// $manager->calculateTax(100);

echo PHP_EOL . "-----------------ИСТОРИЯ ОКЛАДОВ МЕНЕДЖЕРА ---------------" . PHP_EOL;
print_r($manager->getSalaryHistory());