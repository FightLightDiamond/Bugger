<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 6/27/19
 * Time: 11:06 PM
 */

namespace Bugger;


use Bugger\Events\ExceptionEvent;

class Bugger
{
    public static function sendMailErrorSever($subject, $html, $to)
    {
        $data['subject'] = $subject;
        $data['content'] = $html;
        $data['to'] = $to;

        event(new ExceptionEvent($data));
    }
}