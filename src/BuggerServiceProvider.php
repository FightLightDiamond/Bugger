<?php
/**
 * Created by PhpStorm.
 * User: JK
 * Date: 3/2/2018
 * Time: 11:41 PM
 */

namespace Bugger;

use Bugger\Facades\Bugger;
use Bugger\Facades\BuggerFa;
use Illuminate\Support\ServiceProvider;

class BuggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'bug');
        $this->mergeConfigFrom(__DIR__ . '/../config/bugger.php', 'bugger');
	    $this->loadViewsFrom(__DIR__ . '/../resources/views', 'bug');
    }

    public function register()
    {
        $this->app->register(EventBuggerServiceProvider::class);
        $this->app->bind('BuggerFa', Bugger::class);

        $this->app->alias(BuggerFa::class, 'Bugger');
    }
}