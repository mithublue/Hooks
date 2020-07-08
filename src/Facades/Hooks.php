<?php

namespace mithublue\Hooks\Facades;

use Illuminate\Support\Facades\Facade;

class Hooks extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'hooks';
    }
}
