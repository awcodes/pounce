@props([
    'align' => 'start',
])

<div
    @class([
        'p-4 flex items-center',
        match($align) {
            'start' => 'justify-start',
            'center' => 'justify-center',
            'end' => 'justify-end',
        }
    ])
>
    {{ $slot }}
</div>
