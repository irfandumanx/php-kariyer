<?php

namespace Factories;

use Entities\AdvertEntity;
use Entities\UserEntity;
use Faker\Factory;
use Guid;
use Models\AdvertModel;
use Models\UserModel;

class AdvertUserFactory extends AbstractFactory
{

    public function __construct(
        readonly UserModel $userModel = new UserModel(),
        readonly AdvertModel $advertModel = new AdvertModel(),
    ){}

    public function run(): void
    {
        $faker = Factory::create("tr_TR");
        $insertionCount = 0;
        $advertInsertionCount = 0;
        $count = 100_000;

        echoNormal("$count kullanıcı ve ilan oluşturma işlemi başlıyor");

        $startTime = microtime(true);
        for ($i = 0; $i < $count; $i++) {
            $userEntity = new UserEntity();
            $userEntity->id = Guid::generate();
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
            if ($result != -1) {
                for ($j = 0; $j < rand(3, 8); $j++) {
                    $advertEntity = new AdvertEntity();
                    $advertEntity->id = Guid::generate();
                    $advertEntity->user_id = $userEntity->id;
                    $advertEntity->title = $faker->sentence(nbWords: rand(2, 10));
                    $advertEntity->description = $faker->text();
                    $advertEntity->username = $userEntity->username;
                    $result = $this->advertModel->insert($advertEntity);
                    if ($result != -1) $advertInsertionCount++;
                }
                $insertionCount++;
            };
        }
        $endTime = microtime(true);
        $diff = $endTime - $startTime;

        echoNormal("$diff saniye sonunda işlem sona erdi");
        echoNormal("$insertionCount kullanıcı ve $advertInsertionCount ilan eklendi");
    }
}