<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Session\TokenMismatchException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // $middleware->group('universal', []);
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
            // \App\Http\Middleware\RedirectToComingSoon::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle failed authentication
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            $guard = $e->guards()[0] ?? null;

            return match ($guard) {
                'tenant' => redirect()->guest(route('tenant.login')),
                default => redirect()->guest(route('login')),
            };
        });

        // Handle CSRF token mismatch (419)
        $exceptions->renderable(function (\Exception $e) {
            if ($e->getPrevious() instanceof TokenMismatchException) {
                session()->flash('error', 'Your session expired. Please log in again.');
                return redirect()->back();
            };
        });
    })->create();
