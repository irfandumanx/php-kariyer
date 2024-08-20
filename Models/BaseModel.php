<?php

namespace Models;

use Env;
use PDO;

abstract class BaseModel
{
    use SelectTrait, InsertTrait, UpdateTrait, DeleteTrait;
    protected PDO $dbConnection;
    protected string $primaryKey = "";
    protected string $entity = "";
    protected string $table = "";

    public function __construct()
    {
        $host = Env::MYSQL_HOST->getEnvValue();
        $port = Env::MYSQL_PORT->getEnvValue();
        $db = Env::MYSQL_DB->getEnvValue();
        $user = Env::MYSQL_USER->getEnvValue();
        $pass = Env::MYSQL_PASS->getEnvValue();
        $this->dbConnection = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass);
        $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}