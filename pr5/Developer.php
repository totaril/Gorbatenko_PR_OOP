<?php

declare(strict_types=1);

class Developer extends Employee
{
    public function __construct(
        string $name,
        float $baseSalary,
        string $passport,
        private string $level
    ) {
        parent::__construct($name, $baseSalary, $passport);
    }

    public function getSalary(): float
    {
        $coefficient = match ($this->level) {
            'junior' => 1.0,
            'middle' => 1.5,
            'senior' => 2.0,
            default => throw new InvalidArgumentException("Неизвестный уровень: {$this->level}")
        };

        return $this->baseSalary * $coefficient;
    }
}