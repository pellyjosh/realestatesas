<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register tenant user observer
        \App\Models\Tenant\TenantUser::observe(\App\Observers\TenantUserObserver::class);

        view()->composer('*', function ($view) {
            if (tenant()) {
                $data = tenant()->data ?? [];

                $logo = $data->logo ?? 'default-logo.png';
                $primaryColor = $data->primary_color ?? '#000000';
                $name = $data->name ?? 'Unknown Tenant';

                Log::info('Tenant View Composer', [
                    'id' => tenant()->id,
                    'name' => $name,
                    'logo' => $logo,
                    'primary_color' => $primaryColor,
                ]);

                $view->with('tenantLogo', asset('storage/' . $logo));
                $view->with('tenantPrimaryColor', $primaryColor);
                $view->with('tenantName', $name);
            }
        });
    }
}
