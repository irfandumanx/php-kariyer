<?php

enum Env
{
    case MYSQL_HOST;
    case MYSQL_PORT;
    case MYSQL_DB;
    case MYSQL_USER;
    case MYSQL_PASS;
    case LOGIN_PAGE;

    function getEnvValue()
    {
        return $_ENV[$this->name];
    }

}