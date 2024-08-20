<?php

namespace Models;

use Entities\AdvertEntity;

class AdvertModel extends BaseModel
{
    protected string $table = "adverts";
    protected string $entity = AdvertEntity::class;

}