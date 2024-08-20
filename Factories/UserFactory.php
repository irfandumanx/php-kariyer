<?php

namespace Factories;

use Entities\UserEntity;
use Faker\Factory;
use Models\UserModel;

class UserFactory extends AbstractFactory
{

    public function __construct(
        readonly UserModel $userModel = new UserModel(),
    ){}

    public function run(): void
    {
        $faker = Factory::create("tr_TR");
        $insertionCount = 0;
        $count = 100_000;

        echoNormal("$count kullanıcı ekleme işlemi başlıyor");

        $startTime = microtime(true);
        for ($i = 0; $i < $count; $i++) {
            $userEntity = new UserEntity();
            $userEntity->email = rand(0, 100_000).$faker->email();
            /*
               şifre hashlenmedi çünkü:
                   hashsiz:
                       1000 kullanıcı eklendi
                       İşlem süresi: 0.31533598899841 saniye

                   hashli:
                       1000 kullanıcı eklendi
                       İşlem süresi: 67.57817912102 saniye
            */
            $userEntity->password = '$2y$10$eoIJhGKYXit7zySnalfczuYbnvlaW.bQiLYqToaGsNMBEZMqkkofu'; //12345 şifresi
            $userEntity->name = $faker->name();
            $userEntity->surname = $faker->lastName();
            $userEntity->username = rand(0, 100_000).$faker->userName();
            $result = $this->userModel->insert($userEntity);
            if ($result != -1) $insertionCount++;
        }
        $endTime = microtime(true);
        $diff = $endTime - $startTime;

        echoNormal("$diff saniye sonunda işlem sona erdi");
        echoNormal("$insertionCount kullanıcı eklendi");
    }
}