<?php

namespace Awcodes\Pounce;

use Awcodes\Pounce\Contracts\PounceComponent as Contract;
use Awcodes\Pounce\Enums\Alignment;
use Filament\Support\Enums\MaxWidth;
use Livewire\Component;

abstract class PounceComponent extends Component implements Contract
{
    public bool $forceClose = false;

    public int $skipModals = 0;

    public bool $destroySkipped = false;

    public static function getAlignment(): Alignment
    {
        return Alignment::MiddleCenter;
    }

    public static function isSlideOver(): bool
    {
        return false;
    }

    public static function getMaxWidth(): MaxWidth
    {
        return MaxWidth::Medium;
    }

    public function destroySkippedModals(): self
    {
        $this->destroySkipped = true;

        return $this;
    }

    public function skipPreviousModals($count = 1, $destroy = false): self
    {
        $this->skipPreviousModal($count, $destroy);

        return $this;
    }

    public function skipPreviousModal($count = 1, $destroy = false): self
    {
        $this->skipModals = $count;
        $this->destroySkipped = $destroy;

        return $this;
    }

    public function forceClose(): self
    {
        $this->forceClose = true;

        return $this;
    }

    public function unPounce(): void
    {
        $this->dispatch(
            event: 'unPounce',
            force: $this->forceClose,
            skipPreviousModals: $this->skipModals,
            destroySkipped: $this->destroySkipped
        );
    }

    public function closeModalWithEvents(array $events): void
    {
        $this->emitModalEvents($events);
        $this->unPounce();
    }

    public static function closeModalOnClickAway(): bool
    {
        return true;
    }

    public static function closeModalOnEscape(): bool
    {
        return true;
    }

    public static function closeModalOnEscapeIsForceful(): bool
    {
        return true;
    }

    public static function dispatchCloseEvent(): bool
    {
        return true;
    }

    public static function destroyOnClose(): bool
    {
        return false;
    }

    private function emitModalEvents(array $events): void
    {
        foreach ($events as $component => $event) {
            if (is_array($event)) {
                [$event, $params] = $event;
            }

            if (is_numeric($component)) {
                $this->dispatch($event, ...$params ?? []);
            } else {
                $this->dispatch($event, ...$params ?? [])->to($component);
            }
        }
    }
}
