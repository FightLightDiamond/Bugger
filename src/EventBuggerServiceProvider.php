<?php
/**
 * Created by PhpStorm.
 * User: JK
 * Date: 3/3/2018
 * Time: 7:41 PM
 */

namespace Bugger;

use Bugger\Events\ExceptionEvent;
use Bugger\Facades\BuggerFa;
use Bugger\Listeners\ExceptionListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Queue;

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

        Queue::failing(function (JobFailed $event) {
            // $event->connectionName
            // $event->job
            // $event->exception

            if(config('bugger.queue')) {
                BuggerFa::notification($event->exception);
            }
        });
    }
}