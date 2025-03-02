<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Report or log an exception.
    */
    // public function report(Throwable $exception): void
    // {
    //     parent::report($exception);
    // }

    // /**
    //  * Render an exception into an HTTP response.
    //  */
    // public function render(Request $request, Throwable $e): JsonResponse
    // {
    //     return parent::render($request, $exception);
    // }

    /**
     * Handle unauthenticated requests.
     */
    public function unauthenticated($request, AuthenticationException $exception): JsonResponse
    {
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
