<?php

namespace Models;

trait DeleteTrait
{
    use WhereTrait;
    private function deleteSQL(): string
    {
        $deleteQuery = "DELETE FROM $this->table ";
        $deleteQuery .= $this->getWhereQuery();
        return $deleteQuery;
    }

    public function delete(): int
    {
        $stmt = $this->dbConnection->prepare($this->deleteSQL());
        $stmt->execute($this->getBindings());
        return $stmt->rowCount();
    }

}