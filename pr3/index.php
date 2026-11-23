<?php

declare(strict_types=1);

require __DIR__ . '/Student.php';

$nl = PHP_EOL;

// ----------Создание студентов----------
$s1 = new Student(101, 'Колесов', 'Никита', 2);
$s1->email = 'weelay@yandex.ru';
$s1->grades = [5, 4, 5, 4];

$s2 = new Student(102, 'Ракова', 'Мария', 1);
$s2->email = 'Rakova@gmail.com';
$s2->grades = [5, 5, 5];

$s3 = new Student(103, 'Горбатенко', 'Владимир', 3);
$s3->grades = [3, 4, 3]; 

$s4 = new Student(104, 'Кристофер', 'Светлана', 4);
$s4->email = 'Kristoff@mail.ru';
$s4->grades = [4, 4, 5, 4];

echo $nl . " ----------Таблица студентов ----------" . $nl;

$students = [$s1, $s2, $s3, $s4];

printf(
    "%-6s | %-25s | %-5s | %-22s | %-10s" . $nl,
    'Билет',
    'ФИО',
    'Курс',
    'Почта',
    'Ср. балл'
);

foreach ($students as $student) {
    $email = $student->email ?? 'не указана';
    $avg = number_format($student->getAverageGrade(), 2, '.', '');

    printf(
        "%-6d | %-30s | %-5d | %-22s | %-10s" . $nl,
        $student->id,
        $student->getFullName(),
        $student->course,
        $email,
        $avg
    );
}

echo $nl . "Всего студентов: " . Student::$totalStudents . $nl;
echo "Университет: " . Student::$university . $nl;

echo $nl . "---------------Эксперименты----------------" . $nl;


echo $nl . "1.Эксперимент " . $nl;
try {
    $s1->id = 999;
} catch (Error $e) {
    echo "   Ошибка: " . $e->getMessage() . $nl;
}


echo $nl . "2. Эксперимент" . $nl;
try {
    $s1->course = 'второй';
} catch (TypeError $e) {
    echo "   Ошибка: " . $e->getMessage() . $nl;
}


echo $nl . "3. Эксперимент" . $nl;
try {
    $bad = new Student(105, 'Ошибкин', 'Тест', 7);
} catch (InvalidArgumentException $e) {
    echo "   Ошибка: " . $e->getMessage() . $nl;
}


echo $nl . "4. Эксперимент" . $nl;
Student::$university = 'СПбГУ';
echo "   Стало: " . Student::$university . $nl;
echo "   Значение у объекта \$s1 (через класс): " . Student::$university . $nl;


echo $nl . "5. Эксперимент" . $nl;
var_dump($s1);
echo $nl . "get_object_vars:" . $nl;
print_r(get_object_vars($s1));

echo $nl . "----------Дополнительное задание----------" . $nl;
$s1->someUnknownProperty = 'значение';