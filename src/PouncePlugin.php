<?php

namespace Awcodes\Pounce;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Illuminate\Support\Facades\Blade;

class PouncePlugin implements Plugin
{
    public function getId(): string
    {
        return 'pounce';
    }

    public function register(Panel $panel): void
    {
        //
    }

    public function boot(Panel $panel): void
    {
        $panel->renderHook(
            name: 'panels::body.end',
            hook: fn (): string => Blade::render('<x-livewire::pounce')
        );
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }
}
