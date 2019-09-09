<?php
/**
 * Created by PhpStorm.
 * Date: 8/16/19
 * Time: 9:25 PM
 */

namespace Bugger\Facades;


use Illuminate\Support\Facades\Facade;

class DeBuggerFa extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'DeBuggerFa';
    }
}