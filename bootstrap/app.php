<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
        
        // Add bot request handling middleware to web routes
        $middleware->web(append: [
            \App\Http\Middleware\HandleBotRequests::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Custom exception handling
        $exceptions->render(function (\Throwable $e, \Illuminate\Http\Request $request) {
            // Log all exceptions
            \Illuminate\Support\Facades\Log::error('Exception occurred: ' . $e->getMessage(), [
                'exception' => $e,
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
            ]);
            
            // Return custom error pages in production
            if (app()->environment('production')) {
                if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                    return response()->view('errors.404', [], 404);
                }
                
                if ($request->expectsJson()) {
                    return response()->json([
                        'error' => 'Server error occurred',
                        'message' => 'Please try again later'
                    ], 500);
                }
                
                return response()->view('errors.500', [], 500);
            }
            
            // Let Laravel handle in development
            return null;
        });
    })->create();
