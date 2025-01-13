# PHPStan Symfony Framework extensions and rules

[![Latest Stable Version](https://poser.pugx.org/dadadev/phpstan-symfony-routing/v/stable)](https://packagist.org/packages/dadadev/phpstan-symfony-routing)
[![License](https://poser.pugx.org/dadadev/phpstan-symfony-routing/license)](https://packagist.org/packages/dadadev/phpstan-symfony-routing)

* [PHPStan](https://phpstan.org/)

This extension provides following features:

* Notifies you when you try to generate a URL for a non-existing route name.


## Installation

To use this extension, require it in [Composer](https://getcomposer.org/):

```
composer require --dev dadadev/phpstan-symfony-routing
```

If you also install [phpstan/extension-installer](https://github.com/phpstan/extension-installer) then you're all set!

<details>
  <summary>Manual installation</summary>

If you don't want to use `phpstan/extension-installer`, include extension.neon in your project's PHPStan config:

```
includes:
    - vendor/dadadev/phpstan-symfony-routing/extension.neon
```

To perform framework-specific checks, include also this file:

```
includes:
    - vendor/dadadev/phpstan-symfony-routing/rules.neon
```
</details>

# Analysis of generating URLs

You have to provide a path to `url_generating_routes.php` for the url generating analysis to work.

```yaml
parameters:
    dadadev:
      urlGeneratingRulesFile: var/cache/dev/url_generating_routes.php
```
