<?php
/**
 * Created by PhpStorm.
 * Date: 8/16/19
 * Time: 9:44 PM
 */

namespace Bugger\Facades;


use Bugger\Events\ExceptionEvent;

abstract class BaseBugger
{
    abstract protected function getEmail();

    public function send($subject, $html)
    {
        $to = $this->getEmail();

        if($to) {
            $data['subject'] = $subject;
            $data['content'] = $html;
            $data['to'] = $to;

            event(new ExceptionEvent($data));
        }
    }
}