<?php

namespace Factories;

use Models\AdvertModel;
use Models\UserModel;

class AdvertFactory extends AbstractFactory
{

    public function __construct(
        readonly AdvertModel $advertModel = new AdvertModel(),
        readonly UserModel $userModel = new UserModel(),
    ){}

    public function run(): void
    {
        //echoNormal("bir şey eklemicem");
    }

}