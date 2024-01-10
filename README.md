# Pounce

[![Latest Version on Packagist](https://img.shields.io/packagist/v/awcodes/pounce.svg?style=flat-square)](https://packagist.org/packages/awcodes/pounce)
[![Total Downloads](https://img.shields.io/packagist/dt/awcodes/pounce.svg?style=flat-square)](https://packagist.org/packages/awcodes/pounce)

This plugin adds a global modal for usage in Filament and is a port of [Wire Elements Modal](https://github.com/wire-elements/modal). 

***Please star the original repo if you like this plugin.***

## Installation

You can install the package via composer:

```bash
composer require awcodes/pounce
```

> [!IMPORTANT]
> If you have not set up a custom theme and are using Filament Panels follow the instructions in the Filament Docs for [creating a custom theme](https://filamentphp.com/docs/3.x/panels/themes#creating-a-custom-theme) first.

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

If you are using stand-alone Filament packages you will need to manually add the plugin to any layouts where you intend to use it. This should go before the closing `body` tag, and you should only have one instance per page.

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
    'modal_alignment' => 'middle-center',
    'modal_slide_over' => false,
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

For convince, the plugin offers a scaffolding command to create new modals. This will create a class file in `App\Livewire` or your configured Livewire directory. It will also create a view at `resources/views/livewire`.

The `--form` flag will scaffold the modal with some defaults for making a modal that uses Filament's form methods.

```bash
php artisan make:pounce {name?} {--form} {--F|force}
```

#### Manually

To manually create a modal you simply need to run the Livewire make command and extend the `PounceComponent` class.

```bash
php artisan make:livewire CustomModal
```

```php
namespace App\Http\Livewire;

use Awcodes\Pounce\PounceComponent;

class CustomModal extends PounceComponent
{
    public function render()
    {
        return view('livewire.custom-modal');
    }
}
```

### Opening and Closing Modals

> [!NOTE]
> Pounce uses all the same conventions and usage as Wire Elements Modal, the only thing to be aware of is to open a modal Pounce uses the `pounce` event and to close a modal it uses the `unPounce` event.

See [Wire Elements Modal on GitHub](https://github.com/wire-elements/modal/blob/main/README.md#opening-a-modal) for complete usage instructions.

### Modal Alignment

Modals can be aligned to the top, center, or bottom of the screen and to the start, center, or end of the screen. The default alignment is `MiddleCenter`. See [the alignment enum](https://github.com/awcodes/pounce/blob/main/src/Enums/Alignment.php) for all available options. This can also be set globally in the config file.

```php
use Awcodes\Pounce\Enums\Alignment;

public static function getAlignment(): Alignment
{
    return Alignment::MiddleCenter;
}
```

### Modal Width

Modal widths can be set using the enum cases found in Filament's `MaxWidth` enum. See [the MaxWidth enum](https://github.com/filamentphp/filament/blob/3.x/packages/support/src/Enums/MaxWidth.php) fora ll available options. This can also be set globally in the config file.

```php
use Filament\Support\Enums\MaxWidth;

public static function getMaxWidth(): MaxWidth
{
    return MaxWidth::Medium;
}
```

### Slide Overs

By default, all modals are standard pop-up modals. If you wish to use a slide over modal you can set the `isSlideOver` method to return `true`. This can also be set globally in the config file.

```php
public static function isSlideOver(): bool
{
    return true;
}
```

### Blade Views

While you are free to use any blade view you wish, the plugin comes with a few pre-made views to get you started. These views have predefined padding and margins to match Filament's UI.

```blade
<div>
    <x-pounce::header>
        {{-- Modal Header --}}
    </x-pounce::header>

    <x-pounce::close-button />
    
    <x-pounce::heading>
        {{-- Modal Heading --}}
    </x-pounce::heading>
    
    <x-pounce::description>
        {{-- Modal Description --}}
    </x-pounce::description>

    <x-pounce::content>
        {{-- Modal Content --}}
    </x-pounce::content>

    <x-pounce::footer align="start"> // accepts start, center, end
        {{-- Modal Footer --}}
    </x-pounce::footer>
</div>
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
- [Wire Elements Modal](https://github.com/wire-elements/modal)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
