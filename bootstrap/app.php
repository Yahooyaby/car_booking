<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $throwable) {
            if ($throwable instanceof NotFoundHttpException) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Model not found',
                ], 404);
            }
            if ($throwable instanceof ValidationException) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $throwable->errors(),
                ]);
            }
        });
    })->create();
