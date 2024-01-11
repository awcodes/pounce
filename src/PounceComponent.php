<?php

namespace Awcodes\Pounce;

use Awcodes\Pounce\Contracts\PounceComponent as Contract;
use Awcodes\Pounce\Enums\Alignment;
use Awcodes\Pounce\Enums\MaxWidth;
use Awcodes\Pounce\Enums\SlideDirection;
use Livewire\Component;

abstract class PounceComponent extends Component implements Contract
{
    public bool $forceClose = false;

    public int $skipModals = 0;

    public bool $destroySkipped = false;

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
        return config('pounce.close_modal_on_click_away', true);
    }

    public static function closeModalOnEscape(): bool
    {
        return config('pounce.close_modal_on_escape', true);
    }

    public static function closeModalOnEscapeIsForceful(): bool
    {
        return config('pounce.close_modal_on_escape_is_forceful', true);
    }

    public static function dispatchCloseEvent(): bool
    {
        return config('pounce.dispatch_close_event', false);
    }

    public static function destroyOnClose(): bool
    {
        return config('pounce.destroy_on_close', false);
    }

    public static function getAlignment(): Alignment
    {
        return config('pounce.modal_alignment', Alignment::MiddleCenter);
    }

    public static function getMaxWidth(): MaxWidth
    {
        return config('pounce.modal_max_width', MaxWidth::Medium);
    }

    public static function isSlideOver(): bool
    {
        return static::getSlideDirection() != SlideDirection::None;
    }

    public static function getSlideDirection(): SlideDirection
    {
        return config('pounce.modal_slide_over', SlideDirection::None);
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
