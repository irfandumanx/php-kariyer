<?php

namespace Controllers;

use Attributes\LoginRequiredAttribute;
use Attributes\RoleRequiredAttribute;
use Models\AdvertModel;
use Role;

#[LoginRequiredAttribute]
#[RoleRequiredAttribute(Role::ADMIN)]
class AdminController extends BaseController
{

    public function __construct(
    ){}

    public function index(): void
    {
        //logm("selam");
    }
}