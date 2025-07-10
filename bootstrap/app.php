<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->validateCsrfTokens(except: [
            'book-event',
            'retrieve-referral',
        ]);

        $middleware->alias([
            'user.type' => \App\Http\Middleware\CheckUserType::class,
            'coming.soon' => \App\Http\Middleware\RedirectToComingSoon::class,
            'tenancy.prevent-central' => PreventAccessFromCentralDomains::class,
            'tenancy.domain' => InitializeTenancyByDomain::class,
        ]);

        $middleware->append([
            // PreventAccessFromCentralDomains::class,
            // InitializeTenancyByDomain::class,
            \App\Http\Middleware\RedirectToComingSoon::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
