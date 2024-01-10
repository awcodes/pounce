<?php

/*
|--------------------------------------------------------------------------
| Modal Component Defaults
|--------------------------------------------------------------------------
|
| Configure the default properties for a modal component.
|
| Supported modal_max_width
| see https://github.com/filamentphp/filament/blob/3.x/packages/support/src/Enums/MaxWidth.php
*/
return [
    'modal_max_width' => 'md',
    'modal_alignment' => 'middle-center',
    'modal_slide_over' => false,
    'close_modal_on_click_away' => true,
    'close_modal_on_escape' => true,
    'close_modal_on_escape_is_forceful' => true,
    'dispatch_close_event' => false,
    'destroy_on_close' => false,
];
