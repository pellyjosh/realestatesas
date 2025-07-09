<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Coming Soon Routes
    |--------------------------------------------------------------------------
    |
    | This configuration defines the routes that should redirect to the "Coming Soon" page.
    | Add the route names (as defined in web.php) to the 'routes' array to flag them.
    |
    */

    'routes' => [
        // Client Routes
        // 'client.home',
        'client.compare',
        // 'client.events',
        // 'client.contact',
        
        // General User Routes
        // 'dashboard',
        // 'profile.edit',
        // 'profile.update',
        // 'profile.destroy',
        
        // Admin Routes
        // 'admin.dashboard',
        'add-admin',
        'edit-admin',
        'all-admins',
        'add-admin-wizard',
        // 'admin-invoice',
        'admin.add-property',
        'admin.edit-property',
        'admin.listing',
        'admin.favourites',
        'user-profile',
        'admin.add-user',
        'admin.add-user-wizard',
        'edit-user',
        'all-users',
        'admin.realtor-profile',
        'add-realtor',
        'add-realtor-wizard',
        'edit-realtor',
        'all-realtors',
        'realtor-invoice',
        'admin.map',
        'admin.family-house',
        'admin.reports',
        'admin.payments',
        'admin.events',
        'admin.withdrawal',
        // 'admin.transactions',
        'admin.login',
        'admin.signup',
        'admin.not-found',
        
        // Realtor Routes
        // 'realtor.dashboard',
        'realtor.add-property',
        'realtor.edit-property',
        'realtor.listing',
        'realtor.favourites',
        'realtor-user-profile',
        'realtor-add-user',
        'realtor-add-user-wizard',
        'realtor-edit-user',
        'realtor-all-users',
        'realtor-agent-profile',
        'realtor-add-agent',
        'realtor-add-agent-wizard',
        'realtor-edit-agent',
        'realtor-all-agents',
        'realtor-agent-invoice',
        'realtor.map',
        'realtor.family-house',
        'realtor.reports',
        'realtor.payments',
        'realtor.profile',
        'realtor.landing-page-list',
        'realtor.landing-page',
        'realtor.referrals',
        'realtor.earnings',
        'realtor.sales-request',
        'realtor.events',
        'realtor.login',
        'realtor.signup',
        'realtor.not-found',
        
        // Catch-all Route
        'coming-soon',
        // Add more route names here if new routes are defined in web.php
    ],
];
