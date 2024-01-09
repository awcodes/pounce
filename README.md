# Pounce

[![Latest Version on Packagist](https://img.shields.io/packagist/v/awcodes/pounce.svg?style=flat-square)](https://packagist.org/packages/awcodes/pounce)
[![Total Downloads](https://img.shields.io/packagist/dt/awcodes/pounce.svg?style=flat-square)](https://packagist.org/packages/awcodes/pounce)

Port of LivewireUI/modal for Filament

> [!CAUTION]
> This package is in development and not intended for production yet.

## Installation

You can install the package via composer:

```bash
composer require awcodes/pounce
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="pounce-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="pounce-views"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$pounce = new Awcodes\Groundhog();
echo $pounce->echoPhrase('Hello, Awcodes!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Adam Weston](https://github.com/awcodes)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
