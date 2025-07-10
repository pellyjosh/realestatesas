<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->configureRateLimiting();

        // $this->mapApiRoutes();
        $this->mapWebRoutes();
    }


    protected function mapWebRoutes()
    {
        foreach($this->centralDomains() as $domain) {
            Route::middleware('web')
                ->domain($domain)
                ->group(base_path('routes/web.php'));
        }

    }

    // protected function mapApiRoutes()
    // {
    //     foreach($this->centralDomains() as $domain) {
    //         Route::prefix('api')
    //             ->middleware('api')
    //             ->domain($domain)
    //             ->group(base_path('routes/api.php'));
    //     }
    // }

    protected function centralDomains()
    {
        return config('tenancy.central_domains');
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}

