<div class="absolute end-4 top-4">
    <x-filament::icon-button
        color="gray"
        icon="heroicon-o-x-mark"
        icon-alias="modal.close-button"
        icon-size="lg"
        label="{{ trans('filament::components/modal.actions.close.label') }}"
        tabindex="-1"
        x-on:click="$wire.$dispatch('unPounce')"
        class="fi-modal-close-btn"
    />
</div>
