<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ValidationException $e, Request $request) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        });
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return response()->json([
                'message' => 'Resurce Not Found',
            ], 404);
        });
        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) {
            return response()->json([
                'message' => 'Method Not Allowed',
            ], 405);
        });
    })->create();
