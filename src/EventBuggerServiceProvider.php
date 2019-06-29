<?php
/**
 * Created by PhpStorm.
 * User: JK
 * Date: 3/3/2018
 * Time: 7:41 PM
 */

namespace Bugger;

use Bugger\Events\ExceptionEvent;
use Bugger\Listeners\ExceptionListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class EventBuggerServiceProvider extends EventServiceProvider
{
    protected $listen = [
        ExceptionEvent::class => [
            ExceptionListener::class
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}