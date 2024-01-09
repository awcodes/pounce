<?php

namespace Awcodes\Pounce\Actions;

use Exception;
use Filament\Actions\StaticAction;
use Illuminate\Support\Js;
use JsonException;

class PounceAction extends StaticAction
{
    protected ?string $component = null;

    protected ?array $arguments = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->livewireClickHandlerEnabled(false);
    }

    /**
     * @throws JsonException
     * @throws Exception
     */
    public function getAlpineClickHandler(): ?string
    {
        return Js::from('$wire.$dispatch(\'pounce\', { component: \'' . $this->getComponent() . '\', arguments: ' . $this->getOptions() . '})');
    }

    public function arguments(array $arguments): static
    {
        $this->arguments = $arguments;

        return $this;
    }

    public function component(string $component): static
    {
        $this->component = $component;

        return $this;
    }

    /**
     * @throws JsonException
     */
    public function getOptions(): string
    {
        return $this->arguments ? json_encode($this->arguments, JSON_THROW_ON_ERROR) : '{}';
    }

    /**
     * @throws Exception
     */
    public function getComponent(): string
    {
        return $this->component ?? $this->getName();
    }
}
