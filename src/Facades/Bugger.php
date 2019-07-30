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

class Bugger
{
	public function notification($exception, $exceptionHtml)
	{
		try {
			if ($this->isSend($exception)) {
				$this->sendMailErrorSever($exception->getMessage(), $exceptionHtml);
			}
		} catch (\Exception $exception) {
			Cache::put('disable_exception_mail', 'yes', config('bugger.disable_time'));
		}
	}

	protected function isSend($exception)
	{
		return config('app.env') === config('bugger.env')
			&& Cache::get('disable_exception_mail') !== 'yes'
			&& !$exception instanceof HttpResponseException
			&& !$exception instanceof AuthenticationException
			&& !$exception instanceof AuthorizationException
			&& !$exception instanceof TokenMismatchException
			&& !$exception instanceof ValidationException;
	}

	protected function getEmail()
	{
		return config('bugger.mail_default');
	}

	public function sendMailErrorSever($subject, $html)
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