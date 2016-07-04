# Robots.txt Generator

[![Build Status](https://travis-ci.org/cybercog/robots-txt.svg)](https://travis-ci.org/cybercog/robots-txt)
[![StyleCI](https://styleci.io/repos/62556773/shield)](https://styleci.io/repos/62556773)
[![Total Downloads](https://poser.pugx.org/cybercog/robots-txt/d/total.svg)](https://packagist.org/packages/cybercog/robots-txt)
[![Latest Stable Version](https://poser.pugx.org/cybercog/robots-txt/version)](https://packagist.org/packages/cybercog/robots-txt)
[![License](https://poser.pugx.org/cybercog/robots-txt/license)](https://github.com/cybercog/robots-txt/blob/master/LICENSE)

RobotsTxt is a package to dynamically create robots.txt files. It's made to work with Laravel and native PHP.

Checkout the `RobotsTxt.php` class for a full understanding of the functionality.

[This is fork of Robots package](https://github.com/jayhealey/Robots)

## Installation

### Downloading

As usual with Composer packages, there are two ways to install:

You can install via Composer. Pick the "master" as the version of the package.

```sh
composer require cybercog/robots-txt
```

Or add the following to your `composer.json` in the `require` section and then run `composer update` to install it.

```js
{
    "require": {
        "cybercog/robots-txt": "^1.0"
    }
}
```

### Usage

#### Laravel

Once installed via Composer you need to add the service provider. Do this by adding the following to the 'providers' section of the application config (usually `app/config/app.php`):

```php
Cog\RobotsTxt\Providers\RobotsTxtServiceProvider::class,
```

The quickest way to use Robots is to just setup a callback-style route for `robots.txt` in your `/app/routes.php` file.

```php
<?php

Route::get('robots.txt', function() {

    // If on the live server, serve a nice, welcoming robots.txt.
    if (App::environment() == 'production')
    {
        RobotsTxt::addUserAgent('*');
        RobotsTxt::addSitemap('sitemap.xml');
    } else {
        // If you're on any other server, tell everyone to go away.
        RobotsTxt::addDisallow('*');
    }

    return Response::make(RobotsTxt::generate(), 200, array('Content-Type' => 'text/plain'));
});
```

#### Native PHP

Add a rule in your `.htaccess` for `robots.txt` that points to a new script/template/controller/route/etc.

The code would look something like:

```php
<?php
use Cog\RobotsTxt\RobotsTxt;

$robotsTxt = new RobotsTxt();
$robotsTxt->addUserAgent('*');
$robotsTxt->addSitemap('sitemap.xml');

header("HTTP/1.1 200 OK");
echo $robotsTxt->generate();
```

And that's it! You can show different `robots.txt` files depending on how simple or complicated you want it to be.

## Contributing

Please refer to [CONTRIBUTING.md](https://github.com/cybercog/robots-txt/blob/master/CONTRIBUTING.md) for information on how to contribute to RobotsTxt and its related projects.

## License

The RobotsTxt library is an open-sourced software licensed under the [MIT](https://opensource.org/licenses/MIT).
