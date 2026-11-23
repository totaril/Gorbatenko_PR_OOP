<?php

declare(strict_types=1);

class Manager extends Employee
{
    public function __construct(
        string $name,
        float $baseSalary,
        string $passport,
        private int $teamSize
    ) {
        parent::__construct($name, $baseSalary, $passport);
    }

    public function getSalary(): float
    {
        return $this->baseSalary + ($this->teamSize * 5000);
    }
}