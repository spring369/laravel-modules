<?php

namespace Windmill\Modules\Facade;
use Illuminate\Support\Facades\Facade;

/**
 * Class Facade
 *
 * @package Houdunwang\Module
 */
class WindmillModuleFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Windmill';
    }
}
