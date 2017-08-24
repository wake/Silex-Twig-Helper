# Silex Twig Helper

Provide a better way to use Twig with Silex, base on [Silex/Application/TwigTrait.php](https://github.com/silexphp/Silex/blob/master/src/Silex/Application/TwigTrait.php) by [Fabien Potencier](https://github.com/fabpot).

## Usage

```php
$app->get('/hello/{name}', function ($name) use ($app) {

  // Original way
  /*
  return $app->render ('hello.twig', [
    'name' => $name,
  ]);
  */

  // A better way
  return $app
    ->assign ('name', $name)
    ->render ('hello.twig');

  // Or

  $app->assign ('name', $name);

  // some code
  // ...

  return $app->render ('hello.twig');
});
```

## Installation

Add in your `composer.json` with following require entry:

```json
{
  "require": {
    "wake/Silex-Twig-Helper": "*"
  }
}
```

or using composer:

```bash
$ composer require wake/Silex-Twig-Helper:*
```

then run `composer install` or `composer update`.

## Trait

```php
class MyApplication extends Silex\Application {
  use Silex\Application\TwigHelperTrait;
}
```

## Feedback

Please feel free to open an issue and let me know if there is any thoughts or questions :smiley:

## License

Released under the MIT license
