<?php

declare(strict_types=1);

class Employee
{
    private array $salaryHistory = [];

    public function __construct(
        public string $name,
        protected float $baseSalary,
        private string $passport
    ) {
    }

    public function getSalary(): float
    {
        return $this->baseSalary;
    }

    public function raiseSalary(float $percent): void
    {
        $this->validatePercent($percent);

        $raiseAmount = $this->baseSalary * ($percent / 100);
        $this->baseSalary += $raiseAmount;

        $this->salaryHistory[] = "Повышение на {$percent}%. Новый оклад: " 
            . number_format($this->baseSalary, 2, '.', ' ') . " руб.";
    }

    public function getMaskedPassport(): string
    {
        $lastFour = substr($this->passport, -4);
        return "**** **" . $lastFour;
    }

    public function getSalaryHistory(): array
    {
        return $this->salaryHistory;
    }

    protected function calculateTax(float $amount): float
    {
        return $amount * 0.13;
    }

    private function validatePercent(float $percent): void
    {
        if ($percent < 1 || $percent > 50) {
            throw new InvalidArgumentException(
                "Процент повышения должен быть от 1 до 50. Передано: {$percent}"
            );
        }
    }
}