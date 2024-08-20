<?php

namespace Attributes;
use Attribute;
use Role;

#[Attribute(Attribute::TARGET_CLASS|Attribute::TARGET_METHOD)]
class RoleRequiredAttribute
{
    public function __construct(public Role $role) {}
}