# Pounce

[![Latest Version on Packagist](https://img.shields.io/packagist/v/awcodes/pounce.svg?style=flat-square)](https://packagist.org/packages/awcodes/pounce)
[![Total Downloads](https://img.shields.io/packagist/dt/awcodes/pounce.svg?style=flat-square)](https://packagist.org/packages/awcodes/pounce)

> [!CAUTION]
> This package is in development and not intended for production yet.

This plugin adds a global modal for usage in Filament and is a port of [Wire Elements Modal](https://github.com/wire-elements/modal). 

***Please star the original repo if you like this plugin.***

## Installation

You can install the package via composer:

```bash
composer require awcodes/pounce
```

> [!IMPORTANT]
> If you have not set up a custom theme and are using a Panel follow the instructions in the [Filament Docs](https://filamentphp.com/docs/3.x/panels/themes#creating-a-custom-theme) first. The following applies to both the Panels Package and the standalone Forms package. 

After setting up your theme, add the plugin's views to your `tailwind.config.js` file and run `npm run dev` or `npm run build` to add the plugin styles to your theme.

```js
content: [
    ...
    './vendor/awcodes/pounce/resources/**/*.blade.php',
]
```

### For Panels

If you are using Filament Panels you need to add the plugin to the panels you wish to use the plugin with. This will add the necessary livewire component to the panel's layout.

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            PouncePlugin::make(),
        ]);
}
```

### Stand-alone usage

If you are using standalone filament packages you will need to manually add the plugin to any layouts where you intend to use it. This should go before the closing `body` tag and you should only have one instance per page.

```html
@livewire('pounce')
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="pounce-config"
```

Optionally (not recommended), you can publish the views using

```bash
php artisan vendor:publish --tag="pounce-views"
```

This is the contents of the published config file:

```php
return [
    'modal_max_width' => 'md',
    'close_modal_on_click_away' => true,
    'close_modal_on_escape' => true,
    'close_modal_on_escape_is_forceful' => true,
    'dispatch_close_event' => false,
    'destroy_on_close' => false,
];
```

## Usage

### Creating a modal

#### With the command line

#### Manually

### Opening a modal

### Closing a modal

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
