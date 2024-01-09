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
        class="fixed inset-0 z-50 overflow-y-auto"
        style="display: none;"
    >
        <div class="min-h-dvh px-4 pt-4 pb-10">
            <div
                x-show="show"
                x-on:click="closeModalOnClickAway()"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-all transform z-0"
            >
                <div class="absolute inset-0 bg-gray-950/50 dark:bg-gray-950/75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                x-show="show && showActiveComponent"
                class="absolute inset-0 pointer-events-none z-1"
                x-trap.noscroll.inert="show && showActiveComponent"
                aria-modal="true"
            >
                @forelse($components as $id => $component)
                    <div
                        x-show.immediate="activeComponent === '{{ $id }}'"
                        x-ref="{{ $id }}"
                        wire:key="{{ $id }}"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        @class([
                            'absolute inset-0 flex transform transition-all pointer-events-none',
                            'p-6' => $component['modalAttributes']['maxWidth'] !== MaxWidth::Screen,
                            match($component['modalAttributes']['alignment']) {
                                 Alignment::TopStart => 'items-start justify-start',
                                 Alignment::TopCenter => 'items-start justify-center',
                                 Alignment::TopEnd => 'items-start justify-end',
                                 Alignment::MiddleStart => 'items-center justify-start',
                                 Alignment::MiddleCenter => 'items-center justify-center',
                                 Alignment::MiddleEnd => 'items-center justify-end',
                                 Alignment::BottomStart => 'items-end justify-start',
                                 Alignment::BottomCenter => 'items-end justify-center',
                                 Alignment::BottomEnd => 'items-end justify-end',
                            }
                        ])
                    >
                        <div
                            @class([
                                'w-full bg-white ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 rounded-lg overflow-hidden shadow-xl pointer-events-auto',
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
                                },
                            ])
                        >
                            @livewire($component['name'], $component['arguments'], key($id))
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
</div>
