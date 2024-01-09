<div>
    @php
        use Awcodes\Pounce\Enums\Alignment;
        use Filament\Support\Enums\MaxWidth;
    @endphp

    <div
        x-data="pounceComponent()"
        x-on:close.stop="setShowPropertyTo(false)"
        x-on:keydown.escape.window="closeModalOnEscape()"
        x-show="show"
        class="fixed inset-0 z-50 overflow-y-auto transition"
        style="display: none;"
        x-transition:enter="ease-out duration-500"
        x-transition:leave="ease-in duration-500"
    >
        <div
            x-show="show && showActiveComponent"
            x-on:click="closeModalOnClickAway()"
            class="fixed inset-0 z-0 absolute transition inset-0 bg-gray-950/50 dark:bg-gray-950/75"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        ></div>

        @forelse($components as $id => $component)
            @php
                $slideOver = $component['modalAttributes']['slideOver'];
                $width = $component['modalAttributes']['maxWidth'];
                $alignment = $component['modalAttributes']['alignment'];
                $slideFrom = 'right';

                if ($slideOver && (
                    $alignment === Alignment::TopStart
                    || $alignment === Alignment::MiddleStart
                    || $alignment === Alignment::BottomStart
                )) {
                    $slideFrom = 'left';
                }
            @endphp
            <div
                x-ref="{{ $id }}"
                wire:key="{{ $id }}"
                @class([
                    'absolute inset-0 flex transition overflow-hidden pointer-events-none',
                    'p-6' => ! ($slideOver || ($width === MaxWidth::Screen)),
                    match($alignment) {
                         Alignment::TopStart => 'items-start justify-start',
                         Alignment::TopCenter => 'items-start justify-center',
                         Alignment::TopEnd => 'items-start justify-end',
                         Alignment::MiddleStart => 'items-center justify-start',
                         Alignment::MiddleEnd => 'items-center justify-end',
                         Alignment::BottomStart => 'items-end justify-start',
                         Alignment::BottomCenter => 'items-end justify-center',
                         Alignment::BottomEnd => 'items-end justify-end',
                         default => 'items-center justify-center',
                    }
                ])
            >
                <div
                    x-data="{ isShown: false }"
                    x-init="
                        $nextTick(() => {
                            isShown = show && showActiveComponent && activeComponent === '{{ $id }}'
                            $watch('show', () => (isShown = show && showActiveComponent && activeComponent === '{{ $id }}'))
                        })
                    "
                    x-show="isShown"
                    x-trap.noscroll.inert="show && showActiveComponent"
                    x-transition:enter="ease-out duration-300"
                    x-transition:leave="ease-in duration-200"
                    @if ($width === MaxWidth::Screen)
                        x-transition:enter-start="ease-out opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave-start="ease-in opacity-100"
                        x-transition:leave-end="opacity-0"
                    @elseif ($slideOver && $slideFrom === 'right')
                        x-transition:enter-start="translate-x-full rtl:-translate-x-full"
                        x-transition:enter-end="translate-x-0"
                        x-transition:leave-start="translate-x-0"
                        x-transition:leave-end="translate-x-full rtl:-translate-x-full"
                    @elseif ($slideOver && $slideFrom === 'left')
                        x-transition:enter-start="-translate-x-full rtl:translate-x-full"
                        x-transition:enter-end="translate-x-0"
                        x-transition:leave-start="translate-x-0"
                        x-transition:leave-end="-translate-x-full rtl:translate-x-full"
                    @else
                        x-transition:enter-start="scale-95"
                        x-transition:enter-end="scale-100"
                        x-transition:leave-start="scale-100"
                        x-transition:leave-end="scale-95"
                    @endif
                    @class([
                        'w-full flex relative flex-col bg-white ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 overflow-hidden shadow-xl transition pointer-events-auto',
                        'overflow-y-auto' => $slideOver,
                        'ms-auto' => $slideOver && $slideFrom === 'right',
                        'me-auto' => $slideOver && $slideFrom === 'left',
                        'h-dvh' => $slideOver || ($width === MaxWidth::Screen),
                        'mx-auto rounded-xl' => ! ($slideOver || ($width === MaxWidth::Screen)),
                        match($component['modalAttributes']['maxWidth']) {
                            MaxWidth::ExtraSmall => 'max-w-xs',
                            MaxWidth::Small => 'max-w-sm',
                            MaxWidth::Medium => 'max-w-md',
                            MaxWidth::Large => 'max-w-lg',
                            MaxWidth::ExtraLarge => 'max-w-xl',
                            MaxWidth::TwoExtraLarge => 'max-w-2xl',
                            MaxWidth::ThreeExtraLarge => 'max-w-3xl',
                            MaxWidth::FourExtraLarge => 'max-w-4xl',
                            MaxWidth::FiveExtraLarge => 'max-w-5xl',
                            MaxWidth::SixExtraLarge => 'max-w-6xl',
                            MaxWidth::SevenExtraLarge => 'max-w-7xl',
                            MaxWidth::Full => 'max-w-full',
                            MaxWidth::MinContent => 'max-w-min',
                            MaxWidth::MaxContent => 'max-w-max',
                            MaxWidth::FitContent => 'max-w-fit',
                            MaxWidth::Prose => 'max-w-prose',
                            MaxWidth::ScreenSmall => 'max-w-screen-sm',
                            MaxWidth::ScreenMedium => 'max-w-screen-md',
                            MaxWidth::ScreenLarge => 'max-w-screen-lg',
                            MaxWidth::ScreenExtraLarge => 'max-w-screen-xl',
                            MaxWidth::ScreenTwoExtraLarge => 'max-w-screen-2xl',
                            MaxWidth::Screen => 'fixed inset-0',
                            default => $width
                        },
                    ])
                >
                    @livewire($component['name'], $component['arguments'], key($id))
                </div>
            @empty
            @endforelse
        </div>
    </div>
</div>
