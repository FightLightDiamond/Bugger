<?php
/**
 * Created by PhpStorm.
 * User: JK
 * Date: 3/2/2018
 * Time: 11:41 PM
 */

namespace Bugger;


use Illuminate\Support\ServiceProvider;

class BuggerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'bug');
    }

    public function register()
    {
        $this->app->register(EventBuggerServiceProvider::class);
    }
}