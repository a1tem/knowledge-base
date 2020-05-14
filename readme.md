# KnowledgeBase

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

## Knowledge base management system.

It's a laravel package that allows you to install the knowledge base management system into your site:

#### Key features

- Categories
- Categories can have additional fields (text, textarea, number, select, date, checkbox)
- When user creates the article, he should also fill all the additional fields that belong to the category
- Search by article title and content and also by additional fields
- Validation on additional fields
- Pagination

## Demo

-- todo

## Installation

Via Composer

``` bash
$ composer require a1tem/knowledge-base
$ php artisan migrate
```

``` bash
$ npm add babel-plugin-syntax-dynamic-import babel-plugin-syntax-jsx babel-plugin-transform-vue-jsx eslint eslint-loader eslint-plugin-vue laravel-mix-eslint vue-template-compiler --save-dev
$ npm add element-ui axios vue2-editor
$ npm install
```

## Passport installation
We use Passport in order to perform the API calls, if you already use passport, just skip this part.

The full installation process can be found in the [Passport Docs][link-passport-installation]

After that just add to the **Http/Middleware/EncryptCookies.php** file:
```php
protected static $serialize = true;
```
And add to the $except array **'knowledge-base/'** of the Http/Middleware/VerifyCsrfToken.php file:

```php

    protected $except = [
        'knowledge-base/*'
    ];

```

Add this to your main blade file or to the views/layout/app.blade.php if it's not included yet.

```html
<meta name="csrf-token" content="{{ csrf_token() }}">
```

## Usage
First of all we should publish all the package assets, to do so run this command in the console

``` bash
$ artisan vendor:publish --provider="A1tem\KnowledgeBase\KnowledgeBaseServiceProvider"
```

The published components will be placed in your resources/js directory. Once the components have been published, you should register them in your resources/js/app.js file somewhere at the top section add:

``` js
require('./knowledge-base/knowledge-base');
```

After that run:
``` bash
$ npm run dev
```

## Use it with blade files

By default the module will work in NON_SPA mode, it means that you can use it directly by typing the url address:

* To view all categories 

**/knowledge-base/view/categories**

* To view all articles

**/knowledge-base/view/articles**

You can find all the published view files in the resources/views/vendor/a1tem/knowledge-base folder and modify the style as you want.

Also you are able to modify the VUE files as well, to find them navigate to resources/js/knowledge-base/views folder.

Don't forget to rebuild the assets by running npm run dev after modifying the vue files.
## Use it in the SPA applications

* If you want to use this package in the SPA mode, you have to change in the knowledge-base/config.js file:

```js
MODE: MODE_SPA
```

* Then you have to include in your router file:
```js
import { KNOWLEDGE_BASE_ROUTER } from './knowledge-base/knowledge-base-router';

export default new VueRouter({
  mode: 'history',
  linkActiveClass: 'active',
  routes: [
    {
      path: '/',
      component: Vue.component('Layout', require('./Layout.vue').default),
      children: [
        // Your routes here
      ].concat(KNOWLEDGE_BASE_ROUTER),
    },
  ],
});
```

You can examine the 'knowledge-base/knowledge-base-router.js' file and change it in the way that the best suited for your application.
## Configuration

You can configure different aspects of the package, check config/knowledge-base.php file.

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

[Vue2Editor][link-vue2-editor] - Vue.js editor for rich text editing built with Vue.js and Quill.js

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
[link-vue2-editor]: https://www.vue2editor.com/
[link-passport-installation]: https://laravel.com/docs/7.x/passport#installation
