@props([
    'align' => 'start',
])

<div
    {{ $attributes->class([
        'fi-modal-footer p-4 flex items-center',
        match($align) {
            'start' => 'justify-start',
            'center' => 'justify-center',
            'end' => 'justify-end',
        }
    ]) }}
>
    {{ $slot }}
</div>
