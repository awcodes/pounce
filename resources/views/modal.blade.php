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
        class="pounce-modal-container fixed flex inset-0 z-50 overflow-y-auto overflow-x-hidden transition"
        style="display: none;"
        x-bind:class="{
            'items-start': modalAlignment?.includes('top'),
            'items-center': modalAlignment?.includes('middle'),
            'items-end': modalAlignment?.includes('bottom'),
            'justify-start': modalAlignment?.includes('start') || (isSlideOver && slideDirection === 'left'),
            'justify-center': modalAlignment?.includes('center'),
            'justify-end': modalAlignment?.includes('end') || (isSlideOver && slideDirection === 'right'),
            'p-6': ! (isSlideOver || (modalWidth === 'screen')),
        }"
    >
        <div
            x-show="show && showActiveComponent"
            x-on:click="closeModalOnClickAway()"
            class="absolute inset-0 z-0 transition inset-0 bg-gray-950/50 dark:bg-gray-950/75"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        ></div>

        <div
            x-show="show && showActiveComponent"
            x-trap.noscroll.inert="show && showActiveComponent"
            aria-modal="true"
            x-transition:enter-start="enter-start"
            x-transition:enter-end="enter-end"
            x-transition:leave-start="leave-start"
            x-transition:leave-end="leave-end"
            class="pounce-modal w-full flex flex-col bg-white ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 overflow-hidden shadow-xl transition pointer-events-auto"
            style="will-change: auto;"
            x-bind:class="{
                'max-w-xs': modalWidth === 'xs',
                'max-w-sm': modalWidth === 'sm',
                'max-w-md': modalWidth === 'md',
                'max-w-lg': modalWidth === 'lg',
                'max-w-xl': modalWidth === 'xl',
                'max-w-2xl': modalWidth === '2xl',
                'max-w-3xl': modalWidth === '3xl',
                'max-w-4xl': modalWidth === '4xl',
                'max-w-5xl': modalWidth === '5xl',
                'max-w-6xl': modalWidth === '6xl',
                'max-w-7xl': modalWidth === '7xl',
                'max-w-full': modalWidth === 'full',
                'max-w-min': modalWidth === 'min',
                'max-w-max': modalWidth === 'max',
                'max-w-fit': modalWidth === 'fit',
                'max-w-prose': modalWidth === 'prose',
                'max-w-screen-sm': modalWidth === 'screen-sm',
                'max-w-screen-md': modalWidth === 'screen-md',
                'max-w-screen-lg': modalWidth === 'screen-lg',
                'max-w-screen-xl': modalWidth === 'screen-xl',
                'max-w-screen-2xl': modalWidth === 'screen-2xl',
                'fixed inset-0 fade': modalWidth === 'screen',
                'overflow-y-auto': isSlideOver,
                'relative': ! isSlideOver,
                'right-0 fixed slide-from-right': slideDirection === 'right',
                'left-0 fixed slide-from-left': slideDirection === 'left',
                'top-0 fixed slide-from-top': slideDirection === 'top',
                'bottom-0 fixed slide-from-bottom': slideDirection === 'bottom',
                'h-dvh': isSlideOver || (modalWidth === 'screen'),
                'pop rounded-xl': ! (isSlideOver || (modalWidth === 'screen')),
            }"
        >
            @forelse($components as $id => $component)
                <div x-show.immediate="activeComponent === '{{ $id }}'" x-ref="{{ $id }}" wire:key="{{ $id }}" class="h-full">
                    @livewire($component['name'], $component['arguments'], key($id))
                </div>
            @empty
            @endforelse
        </div>
    </div>

    <style>
        :root {
            --pounce-enter-duration: 300ms;
            --pounce-leave-duration: 200ms;
        }

        .pounce-modal-container:has(.enter-start),
        .pounce-modal-container:has(.enter-end),
        .pounce-modal-container:has(.leave-start),
        .pounce-modal-container:has(.leave-end){
            overflow: hidden;
        }

        .pounce-modal.fade.enter-start {opacity: 0;}
        .pounce-modal.fade.enter-end {opacity: 1; transition: var(--pounce-enter-duration);}
        .pounce-modal.fade.leave-start {opacity: 1;}
        .pounce-modal.fade.leave-end {opacity: 0; transition: var(--pounce-leave-duration);}

        .pounce-modal.pop.enter-start {opacity: 0; transform: scale(0.95);}
        .pounce-modal.pop.enter-end {opacity: 1; transform: scale(1); transition: var(--pounce-enter-duration);}
        .pounce-modal.pop.leave-start {opacity: 1; transform: scale(1);}
        .pounce-modal.pop.leave-end {opacity: 0; transform: scale(0.95); transition: var(--pounce-leave-duration);}

        .pounce-modal.slide-from-right.enter-start {transform: translateX(100%);}
        .pounce-modal.slide-from-right.enter-end {transform: translateX(0); transition: var(--pounce-enter-duration);}
        .pounce-modal.slide-from-right.leave-start {transform: translateX(0);}
        .pounce-modal.slide-from-right.leave-end {transform: translateX(100%); transition: var(--pounce-leave-duration);}

        .pounce-modal.slide-from-left.enter-start {transform: translateX(-100%);}
        .pounce-modal.slide-from-left.enter-end {transform: translateX(0); transition: var(--pounce-enter-duration);}
        .pounce-modal.slide-from-left.leave-start {transform: translateX(0);}
        .pounce-modal.slide-from-left.leave-end {transform: translateX(-100%); transition: var(--pounce-leave-duration);}

        .pounce-modal.slide-from-top.enter-start {transform: translateY(-100%);}
        .pounce-modal.slide-from-top.enter-end {transform: translateY(0); transition: var(--pounce-enter-duration);}
        .pounce-modal.slide-from-top.leave-start {transform: translateY(0);}
        .pounce-modal.slide-from-top.leave-end {transform: translateY(-100%); transition: var(--pounce-leave-duration);}

        .pounce-modal.slide-from-bottom.enter-start {transform: translateY(100%);}
        .pounce-modal.slide-from-bottom.enter-end {transform: translateY(0); transition: var(--pounce-enter-duration);}
        .pounce-modal.slide-from-bottom.leave-start {transform: translateY(0);}
        .pounce-modal.slide-from-bottom.leave-end {transform: translateY(100%); transition: var(--pounce-leave-duration);}

    </style>
</div>
