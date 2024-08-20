<?php

namespace Entities;

class UserEntity extends Entity
{
    public string $id;
    public string $name;
    public string $surname;
    public string $username;
    public string $email;
    public string $password;
    public string $role_name;
}