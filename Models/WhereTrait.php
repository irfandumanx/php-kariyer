<?php

namespace Models;

trait WhereTrait
{
    protected array $where = [];
    protected array $bindings = [];
    private function wherePure(string $column, string $operator, $value, string $logicalOperator)
    {
        $this->where[] = [$column, $operator, $logicalOperator];
        $this->bindings[] = $value;
        return $this;
    }

    public function where(string $column, $value)
    {
        return $this->wherePure($column, "=", $value, "AND");
    }

    public function whereOr(string $column, $value)
    {
        return $this->wherePure($column, "=", $value, "OR");
    }

    public function like(string $column, $value, $logicalOperator = "OR")
    {
        return $this->wherePure($column, "LIKE", $value, $logicalOperator);
    }

    protected function getWhereQuery(): string
    {
        $whereCount = count($this->where) - 1;
        if ($whereCount !== -1) {
            $whereStat = "WHERE ";
            for ($i = 0; $i < $whereCount; $i++) {
                $values = $this->where[$i];
                $whereStat .= "{$values["0"]} {$values["1"]} ? {$values["2"]} ";
            }
            $values = $this->where[$whereCount];
            $whereStat .= "{$values["0"]} {$values["1"]} ? ";
            return $whereStat;
        }
        return "";
    }

    protected function getBindings(): array
    {
        return $this->bindings;
    }

}