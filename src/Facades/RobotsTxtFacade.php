<?php

/*
 * This file is part of RobotsTxt.
 *
 * (c) CyberCog <support@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cog\RobotsTxt\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class RobotsTxtFacade.
 * @package Cog\RobotsTxt
 */
class RobotsTxtFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cog.robots-txt';
    }
}
