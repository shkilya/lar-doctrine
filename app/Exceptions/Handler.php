<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, \Throwable $exception): \Illuminate\Http\Response|JsonResponse|Response
    {
        return $this->handleApiException($request, $exception);
    }
    private function handleApiException($request, \Throwable $exception): JsonResponse
    {
        $exception = $this->prepareException($exception);

        if ($exception instanceof \Illuminate\Http\Exceptions\HttpResponseException) {
            $exception = $exception->getResponse();
        }

        if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
            $exception = $this->unauthenticated($request, $exception);
        }

        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $exception = $this->convertValidationExceptionToResponse($exception, $request);
        }
        return $this->customApiResponse($exception);
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        return $this->invalidJson($request, $e);
    }

    private function customApiResponse($exception): JsonResponse
    {
        if (method_exists($exception, 'getStatusCode')) {
            $statusCode = $exception->getStatusCode();
        } else {
            $statusCode = 500;
        }

        $response = [];
        if ($statusCode == 401) {
            $response['message'] = 'Unauthorized';
        } elseif ($statusCode == 403) {
            $response['message'] = 'Forbidden';
        } elseif ($statusCode == 404) {
            $response['message'] = 'Not Found';
        } elseif ($statusCode == 405) {
            $response['message'] = 'Method Not Allowed';
        } elseif ($statusCode == 422) {
            $response['message'] = $exception->original['message'];
            $response['errors'] = $exception->original['errors'];
        } else {
            $response['message'] = !config('app.debug') ? 'Whoops, looks like something went wrong' : $exception->getMessage();
        }

        $response['status'] = $statusCode;

        return response()->json($response, $statusCode);
    }
}
