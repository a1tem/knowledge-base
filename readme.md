# KnowledgeBase

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

Knowledge base management system.

## Installation

Via Composer

``` bash
$ composer require a1tem/knowledge-base
```

``` bash
$ npm add babel-plugin-syntax-dynamic-import babel-plugin-syntax-jsx babel-plugin-transform-vue-jsx eslint eslint-loader eslint-plugin-vue laravel-mix-eslint vue-template-compiler --save-dev
$ npm add element-ui axios vue2-editor
$ npm install
```

We use Passport in order to perform the API calls

Don't forget to change the api -> driver to 'passport' in your config/auth.php file
``` bash
'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'passport',
            'provider' => 'users',
            'hash' => false,
        ],
    ],
```

php artisan migrate
php artisan passport:install

Add HasApiTokens trait to the User model.

\Laravel\Passport\Http\Middleware\CreateFreshApiToken::class, to app/Http/Kernel

```php
<?php
    protected $middlewareGroups = [
        'web' => [
            //...
            \Laravel\Passport\Http\Middleware\CreateFreshApiToken::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];
```
```php
EncryptCookies => protected static $serialize = true;
```

VerifyCsrfToken => exclude path 'knowledge-base/*'

Add <meta name="csrf-token" content="{{ csrf_token() }}"> to the main blade file
## Usage
First of all we should publish all the package assets

``` bash
$ artisan vendor:publish
```

The published components will be placed in your resources/js directory. Once the components have been published, you should register them in your resources/js/app.js file somewhere at the top section add:

``` js
require('./knowledge-base/knowledge-base');
```




## Use it with blade files

-- todo
## Use it in the SPA applications

-- todo
## Testing
Tests system is under development.

## Security

If you discover any security related issues, please email artempetrusenko@gmail.com instead of using the issue tracker.

## Credits

- [Artem Petrusenko][link-author]

## Built with
[Laravel][link-laravel] - The PHP Framework For Web Artisans

[VueJS][link-vuejs] - The Progressive JavaScript Framework

[Element][link-element] - A Vue 2.0 based component library for developers, designers and product managers


## License

Knowledge base system is open-sourced software licensed under the MIT license.

[ico-version]: https://img.shields.io/packagist/v/a1tem/knowledge-base.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/a1tem/knowledge-base.svg?style=flat-square
[link-packagist]: https://packagist.org/packages/a1tem/knowledge-base
[link-downloads]: https://packagist.org/packages/a1tem/knowledge-base
[link-author]: https://github.com/a1tem
[link-laravel]: https://laravel.com
[link-vuejs]: https://vuejs.org
[link-element]: https://element.eleme.io/
