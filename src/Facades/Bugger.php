<?php
/**
 * Created by PhpStorm.
 * User: cuongpm
 * Date: 6/27/19
 * Time: 11:06 PM
 */

namespace Bugger\Facades;

use Bugger\Events\ExceptionEvent;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Symfony\Component\Debug\Exception\FlattenException;
use Symfony\Component\Debug\ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Bugger extends BaseBugger
{
    public function notification($exception)
    {
        try {
            $exceptionHtml = (new ExceptionHandler(true))->getHtml(
                FlattenException::create($exception)
            );

            $title = $exception->getMessage();

            if ($this->isSend($exception)) {
                $this->send($title, $exceptionHtml);
            }
        } catch (\Exception $exception) {
            Cache::put('disable_exception_mail', 'yes', config('bugger.disable_time'));
        }
    }

    protected function isSend($exception)
    {
        return config('app.env') === config('bugger.env')
            && Cache::get('disable_exception_mail') !== 'yes'
            && !$exception instanceof HttpException
            && !$exception instanceof MethodNotAllowedHttpException
            && !$exception instanceof HttpResponseException
            && !$exception instanceof AuthenticationException
            && !$exception instanceof AuthorizationException
            && !$exception instanceof TokenMismatchException
            && !$exception instanceof UnauthorizedHttpException
            && !$exception instanceof ValidationException;
    }

    protected function getEmail()
    {
        return explode('|', config('bugger.mail_default'));
    }
}