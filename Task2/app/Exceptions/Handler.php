<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException)
            return $this->NotFoundExceptionMessage($request, $e);

        if ($e instanceof MethodNotAllowedHttpException)
            return $this->MethodNotAllowedHttpExceptionMessage($request, $e);


        return parent::render($request, $e);
    }

    public function MethodNotAllowedHttpExceptionMessage(\Illuminate\Http\Request $request, $e)
    {
        return $request->acceptsJson() ? new JsonResponse([
            'data' => [
                'message' => 'method is not supported for this route.',
            ],
            'status' => 'error'
        ], Response::HTTP_METHOD_NOT_ALLOWED) : parent::render($request, $e);
    }

    public function NotFoundExceptionMessage(\Illuminate\Http\Request $request, $e)
    {
        return $request->acceptsJson() ? new JsonResponse([
            'data' => [
                'message' => 'not found',
            ],
            'status' => 'error'
        ], Response::HTTP_NOT_FOUND) : parent::render($request, $e);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->shouldReturnJson($request, $exception)
            ? response()->json([
                'data'=>[
                    'message' => 'unauthorized'
                ],'status'=>'error'], Response::HTTP_UNAUTHORIZED)
            : redirect()->guest($exception->redirectTo() ?? route('login'));
    }
}
