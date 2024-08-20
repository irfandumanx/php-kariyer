<?php

namespace Models;

use Logger;
use LogLevel;
use PDOException;
use Reflections;

trait InsertTrait
{

    protected string $columns = "({0})";
    protected string $values = "VALUES ({0})";

    private function insertSQL(array|object $data): string
    {
        if(is_object($data))
            $data = Reflections::toArray($data);

        if (array_key_exists($this->primaryKey, $data))
            unset($data[$this->primaryKey]);

        foreach ($data as $name => $value) {
            if(!is_numeric($value)) $data[$name] = "'$value'";
        }

        $columns = str_replace("{0}", implode(", ", array_keys($data)), $this->columns);
        $values = str_replace("{0}", implode(", ", array_values($data)), $this->values);
        return "INSERT INTO $this->table $columns $values";
    }

    public function insert(array|object $data): string
    {
        try {
            $this->dbConnection->query($this->insertSQL($data));
        }catch (PDOException $e) { Logger::log(LogLevel::ERROR, print_r($e, true)); return -1; }
        return $this->dbConnection->lastInsertId();
    }
}