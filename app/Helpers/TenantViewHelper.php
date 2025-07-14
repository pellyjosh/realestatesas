<?php

if (! function_exists('tenant_view')) {
    /**
     * Get the tenant view.
     *
     * @param  string  $viewName
     * @param  array  $data
     * @return \Illuminate\Contracts\View\View
     */
    function tenant_view(string $viewPath, array $data = [])
    {
        $theme = tenant()->theme ?? 'classic';
        $viewPath = "themes.{$theme}.{$viewPath}";

        if (view()->exists($viewPath)) {
            return view($viewPath, $data);
        }

        $fallbackViewPath = "themes.classic.{$viewPath}";

        if (view()->exists($fallbackViewPath)) {
            return view($fallbackViewPath, $data);
        }

        abort(404, "View [{$viewPath}] not found.");
    }
}
