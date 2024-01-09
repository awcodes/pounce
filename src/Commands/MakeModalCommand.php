<?php

namespace Awcodes\Pounce\Commands;

use Filament\Support\Commands\Concerns\CanManipulateFiles;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\text;

class MakeModalCommand extends Command
{
    use CanManipulateFiles;

    protected $description = 'Create a new Pounce modal';

    protected $signature = 'make:pounce {name?} {--form} {--F|force}';

    public function handle(): int
    {
        $modal = (string) str(
            $this->argument('name') ??
            text(
                label: 'What is the modal name?',
                placeholder: 'CustomPounceModal',
                required: true,
            ),
        )
            ->trim('/')
            ->trim('\\')
            ->trim(' ')
            ->replace('/', '\\');

        $withForm = $this->option('form') || confirm(
            label: 'Use form template?',
            default: false
        );

        $className = (string) str($modal)->afterLast('\\');
        $classNameSpace = str($modal)->contains('\\')
            ? (string) str($modal)->beforeLast('\\')
            : '';

        $namespace = config('livewire.class_namespace', 'App\\Livewire');

        $path = app_path();

        $path = (string) str($modal)
            ->prepend('/')
            ->prepend($namespace)
            ->replace('App\\', '/')
            ->prepend($path ?? '')
            ->replace('\\', '/')
            ->replace('//', '/')
            ->append('.php');

        $viewName = str($modal)
            ->prepend(
                (string) str("{$namespace}\\")
                    ->replaceFirst('App\\', '')
            )
            ->replace('\\', '/')
            ->explode('/')
            ->map(fn ($segment) => Str::lower(Str::kebab($segment)))
            ->implode('.');

        $viewPath = resource_path(
            (string) str($viewName)
                ->replace('.', '/')
                ->prepend('views/')
                ->append('.blade.php'),
        );

        $files = [
            $path,
            $viewPath,
        ];

        if (! $this->option('force') && $this->checkForCollision($files)) {
            return static::INVALID;
        }

        $component = match($withForm) {
            true => 'ComponentWithForm',
            default => 'Component',
        };

        $componentView = match($withForm) {
            true => 'ViewWithForm',
            default => 'View',
        };

        $this->copyStubToApp($component, $path, [
            'class' => $className,
            'namespace' => str($namespace) . ($classNameSpace !== '' ? "\\{$classNameSpace}" : ""),
            'view' => $viewName,
        ]);

        $this->copyStubToApp($componentView, $viewPath);

        $this->components->info("Pounce Modal Class [{$path}] created successfully.");
        $this->components->info("Pounce Modal View [{$viewPath}] created successfully.");

        return self::SUCCESS;
    }
}
