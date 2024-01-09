<?php

namespace Awcodes\Pounce\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Awcodes\Groundhog\Pounce
 */
class Pounce extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Awcodes\Pounce\Pounce::class;
    }
}
