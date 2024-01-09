<?php

namespace Awcodes\Pounce;

use Awcodes\Pounce\Testing\TestsPounce;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class PounceServiceProvider extends PackageServiceProvider
{
    public static string $name = 'pounce';

    public static string $assetPackageName = 'awcodes/pounce';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasViews();
    }

    public function packageBooted(): void
    {
        FilamentAsset::register([
            Js::make('pounce', __DIR__ . '/../resources/dist/pounce.js'),
        ], package: static::$assetPackageName);

        if (app()->runningInConsole()) {
            foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
                $this->publishes([
                    $file->getRealPath() => base_path("stubs/pounce/{$file->getFilename()}"),
                ], 'pounce-stubs');
            }
        }

        // Testing
        Testable::mixin(new TestsPounce());

        Livewire::component('pounce', Pounce::class);
    }
}
