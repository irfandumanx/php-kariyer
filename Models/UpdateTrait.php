<?php

namespace Models;

trait UpdateTrait
{
    use WhereTrait;

    private function updateSQL($data): string
    {
        $query = "UPDATE $this->table SET ";

        if (array_key_exists($this->primaryKey, $data)) {
            unset($data[$this->primaryKey]);
        }

        foreach ($data as $column => $value) {
            $query .= "$column = '$value', ";
        }
        $query = substr($query, 0, -2);
        $query .= " {$this->getWhereQuery()}";

        return $query;
    }

    public function update($data): int
    {
        $stat = $this->dbConnection->query($this->updateSQL($data));
        return $stat->rowCount();
    }


}