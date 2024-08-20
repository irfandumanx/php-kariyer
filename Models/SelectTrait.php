<?php

namespace Models;

use PDO;

trait SelectTrait
{
    use WhereTrait;
    protected array $orderBy = [];

    public function orderBy(string $column, string $direction = "ASC")
    {
        $this->orderBy[] = [$column, $direction];
        return $this;
    }

    private function selectSQL(): string
    {
        $query = "SELECT * FROM $this->table ";
        $query .= $this->getWhereQuery() . $this->order();
        return $query;
    }

    public function limit(int $limit, int $offset = 0)
    {
        $i = 1;
        $query = $this->selectSQL() . "LIMIT ? OFFSET ?";
        $query = $this->dbConnection->prepare($query);
        for (; $i <= count($this->bindings); $i++)
            $query->bindValue($i, $this->bindings[$i - 1]);

        $query->bindValue($i, $limit, PDO::PARAM_INT);
        $query->bindValue($i + 1, $offset, PDO::PARAM_INT);
        $query->execute();
        $this->clearDatas();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!$data) return null;
        if ($this->entity === "") return $data;
        return array_map(function ($arr) {
            return cast(new $this->entity, $arr);
        }, $data);
    }

    public function count($removeBindings = true): int
    {
        $query = "SELECT COUNT(*) FROM $this->table {$this->getWhereQuery()}";
        $query = $this->dbConnection->prepare($query);
        $query->execute($this->getBindings());
        if ($removeBindings)
            $this->clearDatas();
        return $query->fetch()[0];
    }

    private function order(): string
    {
        $orderStat = "";
        $orderByCount = count($this->orderBy);
        if ($orderByCount !== 0) {
            $orderStat = "ORDER BY ";
            for ($i = 0; $i < $orderByCount; $i++) {
                $values = $this->orderBy[$i];
                $orderStat .= "{$values["0"]} {$values["1"]} ";
            }
        }
        return $orderStat;
    }

    public function find() {

        $stmt = $this->dbConnection->prepare($this->selectSQL());
        $stmt->execute($this->getBindings());
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->clearDatas();
        if (!$data) return null;
        if ($this->entity === "") return $data;
        else return cast(new $this->entity, $data);
    }

    public function findAll(): ?array
    {
        $stmt = $this->dbConnection->prepare($this->selectSQL());
        $stmt->execute($this->getBindings());
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->clearDatas();
        if (!$data) return null;
        if ($this->entity === "") return $data;
        return array_map(function ($arr) {
            return cast(new $this->entity, $arr);
        }, $data);
    }

    private function clearDatas(): void
    {
        $this->orderBy = [];
        $this->where = [];
        $this->bindings = [];
    }

    public function paginate($perPageData = 10): Pagination
    {
        return new Pagination($this, $perPageData);
    }

}