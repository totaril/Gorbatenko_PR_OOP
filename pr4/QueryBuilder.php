<?php

declare(strict_types=1);

class QueryBuilder
{
    private string $tableName = '';
    private array $selects = [];
    private array $wheres = [];
    private array $orders = [];
    private ?int $limitValue = null;

    private function __construct()
    {
    }

    public static function table(string $name): static
    {
        $instance = new static();
        $instance->tableName = $name;
        return $instance;
    }

    public function select(string ...$columns): static
    {
        $this->selects = $columns;
        return $this;
    }

    public function where(string $column, string $operator, string|int $value): static
    {
        $allowedOperators = ['=', '!=', '>', '<', '>=', '<=', 'LIKE'];
        
        if (!in_array($operator, $allowedOperators, true)) {
            throw new InvalidArgumentException("Недопустимый оператор: {$operator}");
        }

        $this->wheres[] = [
            'column' => $column,
            'operator' => $operator,
            'value' => $this->quote($value)
        ];

        return $this;
    }

    public function orderBy(string $column, string $direction = 'ASC'): static
    {
        $direction = strtoupper($direction);
        
        if (!in_array($direction, ['ASC', 'DESC'], true)) {
            throw new InvalidArgumentException("Направление сортировки может быть только ASC или DESC");
        }

        $this->orders[] = "{$column} {$direction}";
        return $this;
    }

    public function limit(int $count): static
    {
        if ($count <= 0) {
            throw new InvalidArgumentException("Лимит должен быть больше 0");
        }

        $this->limitValue = $count;
        return $this;
    }

    private function quote(string|int $value): string
    {
        if (is_string($value)) {
            $escaped = str_replace("'", "''", $value);
            return "'{$escaped}'";
        }

        return (string) $value;
    }

    public function toSql(): string
    {
        $sql = "SELECT ";

        if (empty($this->selects)) {
            $sql .= "*";
        } else {
            $sql .= implode(', ', $this->selects);
        }

        $sql .= " FROM {$this->tableName}";

        if (!empty($this->wheres)) {
            $sql .= " WHERE ";
            $conditions = [];
            foreach ($this->wheres as $where) {
                $conditions[] = "{$where['column']} {$where['operator']} {$where['value']}";
            }
            $sql .= implode(' AND ', $conditions);
        }

        if (!empty($this->orders)) {
            $sql .= " ORDER BY " . implode(', ', $this->orders);
        }

        if ($this->limitValue !== null) {
            $sql .= " LIMIT {$this->limitValue}";
        }

        return $sql;
    }

    public function __toString(): string
    {
        return $this->toSql();
    }

    // Дополнительное задание
    public function __call(string $name, array $arguments): static
    {
        if (str_starts_with($name, 'where')) {
            $column = substr($name, 5);
            $column = lcfirst($column);

            if (empty($column) || count($arguments) !== 1) {
                throw new BadMethodCallException("Неверный вызов динамического метода: {$name}");
            }

            return $this->where($column, '=', $arguments[0]);
        }

        throw new BadMethodCallException("Метод {$name} не существует");
    }
}