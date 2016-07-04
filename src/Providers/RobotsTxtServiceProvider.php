<?php

/*
 * This file is part of RobotsTxt.
 *
 * (c) CyberCog <support@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cog\RobotsTxt\Providers;

use Cog\RobotsTxt\RobotsTxt;
use Illuminate\Support\ServiceProvider;

/**
 * Class RobotsTxtServiceProvider.
 * @package Cog\RobotsTxt
 */
class RobotsTxtServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('cog.robots-txt');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('cog.robots-txt', function () {
            return new RobotsTxt;
        });
    }
}
