<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */


    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response | \Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        $handle  = parent::render($request, $exception);
        $message = $exception->getMessage();
        $code    = $handle->getStatusCode();

        if($exception instanceof ModelNotFoundException){
            return response_not_found( __('messages.data_not_found'));
        }

        if ($exception instanceof ValidationException) {
            return $this->handleValidationException($exception);
        }
        if ($request->expectsJson() || Request::is('api/*')) {
            return res_success($message, $code);
        }
        return parent::render($request, $exception);
    }

    /**
     * Handle ValidationException errors
     *
     * @param  ValidationException  $exception
     * @return mixed
     */
    protected function handleValidationException(ValidationException $exception)
    {
        $errors         = $exception->errors();
        $defaultMessage = Arr::first($errors);

        return res_error($defaultMessage[0],422, 422, $errors);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $exception->getMessage()], 401);
        }
        $guard = Arr::first($exception->guards());

        switch ($guard) {
            case 'member':
                $login = 'auth.login';
                break;
            default:
                $login = 'login';
                break;
        }
        return redirect()->guest(route($login));
    }
}
