<?php
/**
 * Created by PhpStorm.
 * Date: 7/30/19
 * Time: 9:45 AM
 */

namespace Bugger\Facades;


use Illuminate\Support\Facades\Facade;

class BuggerFa extends Facade
{
	public static function getFacadeAccessor()
	{
		return 'BuggerFa';
	}
}