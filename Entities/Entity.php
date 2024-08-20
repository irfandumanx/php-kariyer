<?php

namespace Entities;

use Reflections;

abstract class Entity
{

    public function __construct()
    {
        Reflections::fillFieldsWithDefaultValues($this);
    }

}