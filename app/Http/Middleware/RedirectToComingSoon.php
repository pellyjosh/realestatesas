<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route as RouteFacade;

class RedirectToComingSoon
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = RouteFacade::currentRouteName();
        $comingSoonRoutes = config('coming-soon.routes', []);
        
        // Check if the route name is in the coming soon list
        if ($routeName && in_array($routeName, $comingSoonRoutes)) {
            return response()->view('coming-soon');
        }

        // Fallback to check the request path if route name is not set
        $path = $request->path();
        $comingSoonPaths = [];
        foreach ($comingSoonRoutes as $routeName) {
            $route = RouteFacade::getRoutes()->getByName($routeName);
            if ($route) {
                $comingSoonPaths[] = $route->uri();
            }
        }

        if (is_array($comingSoonPaths) && in_array($path, $comingSoonPaths)) {
            return response()->view('coming-soon');
        }

        return $next($request);
    }
}
