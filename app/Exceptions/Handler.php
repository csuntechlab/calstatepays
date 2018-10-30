<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        // \Symfony\Component\HttpKernel\Exception\HttpException::class,
        // \Illuminate\Database\Eloquent\ModelNotFoundException::class, // when first or fail happens this occurs
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Generate basic API response array
     *
     * @param string $collection - e.g. classes, membership-classes, etc.
     * @param boolean $success - default true
     * @param int $status_code - default 200
     * @return array
     * @internal param string $data_type - e.g. classes, membership-classes, etc.
     */
    function buildResponseArray($collection, $success = true, $status_code = 200)
    {
        return $response = [
            'collection' => $collection,
            'success' => ($success ? true : false),
            'api' => 'csuMetro',
            'version' => '1.0',
            'code' => $status_code,
        ];
    }

    /**
     * Constructs the response object
     *
     * @param $message
     * @param $status
     * @return 
     */
    public function buildResponse($message, $status)
    {
        $response = $this->buildResponseArray('errors', false, $status);
        $response['message'] = $message;
        return response($response, $status);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof HttpException || $e instanceof ModelNotFoundException) {
            return $this->buildResponse('Resource could not be resolved', 409);
        }
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
