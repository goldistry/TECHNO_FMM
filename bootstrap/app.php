<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
// HAPUS use statement untuk App\Http\Middleware jika file-nya tidak ada:
// use App\Http\Middleware\Authenticate;
// use App\Http\Middleware\RedirectIfAuthenticated;

// EnsureEmailIsVerified biasanya selalu dari Illuminate kecuali Anda mem-publish-nya secara spesifik
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            // Arahkan langsung ke kelas middleware dari Illuminate
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
            'guest' => \Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
            'verified' => EnsureEmailIsVerified::class, // Ini sudah benar

            // Anda bisa menambahkan alias lain di sini jika diperlukan, contoh:
            // 'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
            // 'can' => \Illuminate\Auth\Middleware\Authorize::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();