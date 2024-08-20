<?php

namespace Models;

use Entities\UserEntity;

class UserModel extends BaseModel
{
    protected string $table = "users";
    protected string $entity = UserEntity::class;

}