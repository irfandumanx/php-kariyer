## Usage

```shell
# make sure you have installed gearman
# and start gearman
php irfan gearman

# start server
php irfan serve
```

## Libraries

```
fakerphp/faker
```

## Factories

```php
# before using the factory method,
# specify the factory class in the boosters method
# of the FactoryBooster class.
public function booters(): array
{
    return [
        UserFactory::class,
    ];
}

# you can now call php irfan factory
```
**OR**

```php
# if you want to run a single factory,
# you can use php irfan factory -name AdvertFactory
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
        //echoGreen("nothing");
    }
```