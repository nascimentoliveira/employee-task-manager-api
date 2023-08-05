<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response as HttpResponse;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error_code' => HttpResponse::HTTP_NOT_FOUND,
                'timestamp' => now()->timestamp,
                'message' => class_basename($exception->getModel()) .' not found'
            ], HttpResponse::HTTP_NOT_FOUND);
        }

        if ($exception instanceof \Exception) {
            return response()->json([
                'error_code' => HttpResponse::HTTP_INTERNAL_SERVER_ERROR,
                'timestamp' => now()->timestamp,
                'message' => 'Internal server error'
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return parent::render($request, $exception);
    }
}
