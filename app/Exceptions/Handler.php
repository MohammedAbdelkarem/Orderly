<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Response;
use App\Constants\ApiMessages;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    // /**
    //  * Register the exception handling callbacks for the application.
    //  *
    //  * @return void
    //  */
    // public function register()
    // {
    //     $this->reportable(function (Throwable $e) {
    //         //
    //     });

    //     // $this->renderable(function(AyhamException $e){
    //     //     retu
    //     // })
    // }

    public function render($request, Throwable $exception)
    {
        if ($request->is('api/*')) {
            $response = $this->APIhandleException($request, $exception);
            return $response;
        } else {
            $response = $this->WEBhandleException($request, $exception);
            return $response;
        }
    }

    public function APIhandleException($request, Throwable $exception)
    {
        if ($exception instanceof ApiException) {
            $statusCode = $exception->getStatusCode();
            $message    = $exception->getMessage();
            $data       = $exception->getData();
        } elseif ($exception instanceof MethodNotAllowedHttpException) {
            $statusCode = 405;
            $message    = __(ApiMessages::MSG_METHOD_NOT_ALLOWED);
            $data       = null;
        } elseif ($exception instanceof NotFoundHttpException) {
            $statusCode = 404;
            $message    = __(ApiMessages::MSG_URL_NOT_FOUND);
            $data       = null;
        } elseif ($exception instanceof HttpException) {
            $statusCode = $exception->getStatusCode();
            $message    = $exception->getMessage();
            $data       = null;
        } elseif ($exception instanceof ValidationException) {
            $statusCode = $exception->status;
            $message    = $exception->getMessage();
            $data       = $exception->errors();
        } elseif ($exception instanceof AuthenticationException) {
            $statusCode = 401;
            $message    = __(ApiMessages::MSG_NOT_AUTHENTICATED);
            $data       = null;
        } elseif ($exception instanceof ServiceUnavailableHttpException) {
            $statusCode = Response::HTTP_SERVICE_UNAVAILABLE;
            $message    = messageHandler(ApiMessages::MSG_SERVICE_UNAVAILABLE);
            $data       = null;
        }

        else {
            $statusCode = 500;
            $message    = $exception->getMessage();
            $data       = null;
        }

        return new JsonResponse([
            'status_code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public function WEBhandleException($request, Throwable $exception)
    {
        // if ($exception instanceof ValidationException) {
        //     return redirect()->back()->withErrors($exception->errors());
        // }
        return parent::render($request, $exception);
    }
}
