<?php

namespace Factories;

class FactoryBooter
{
    public function booters(): array
    {
        return [
            UserFactory::class,
        ];
    }
}