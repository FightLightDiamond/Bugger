<?php
/**
 * Created by PhpStorm.
 * Date: 8/16/19
 * Time: 9:25 PM
 */

namespace Bugger\Facades;


class DeBugger extends BaseBugger
{
    protected function getEmail()
    {
        return config('bugger.mail_default');
    }
}