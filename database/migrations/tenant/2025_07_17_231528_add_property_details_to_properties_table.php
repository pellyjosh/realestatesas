<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            // Property details
            $table->string('property_type')->default('house')->after('name'); // house, land
            $table->string('listing_type')->default('sale')->after('property_type'); // sale, rent, lease
            $table->string('status')->default('available')->after('listing_type'); // available, sold, rented, pending

            // Description and slug
            $table->text('description')->nullable()->after('status');
            $table->string('slug')->unique()->nullable()->after('description');

            // Location details
            $table->string('address')->nullable()->after('slug');
            $table->string('city')->nullable()->after('address');
            $table->string('state')->nullable()->after('city');
            $table->string('postal_code')->nullable()->after('state');
            $table->string('country')->default('Nigeria')->after('postal_code');
            $table->decimal('latitude', 10, 8)->nullable()->after('country');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');

            // Property specifications
            $table->integer('bedrooms')->nullable()->after('longitude');
            $table->integer('bathrooms')->nullable()->after('bedrooms');
            $table->integer('parking_spaces')->nullable()->after('bathrooms');
            $table->decimal('land_size', 10, 2)->nullable()->after('parking_spaces'); // in square meters
            $table->decimal('built_area', 10, 2)->nullable()->after('land_size'); // in square meters
            $table->integer('year_built')->nullable()->after('built_area');

            // Pricing
            $table->decimal('price', 15, 2)->nullable()->after('year_built');
            $table->decimal('price_per_sqm', 10, 2)->nullable()->after('price');

            // Features and amenities (JSON field)
            $table->json('features')->nullable()->after('price_per_sqm');
            $table->json('amenities')->nullable()->after('features');

            // Media
            $table->json('images')->nullable()->after('amenities'); // Array of image paths
            $table->json('videos')->nullable()->after('images'); // Array of video paths
            $table->string('virtual_tour_url')->nullable()->after('videos');
            $table->string('floor_plan')->nullable()->after('virtual_tour_url');

            // SEO and metadata
            $table->text('meta_description')->nullable()->after('floor_plan');
            $table->string('meta_keywords')->nullable()->after('meta_description');

            // Timestamps for listing
            $table->timestamp('listed_at')->nullable()->after('meta_keywords');
            $table->timestamp('expires_at')->nullable()->after('listed_at');

            // Soft delete
            $table->softDeletes()->after('expires_at');

            // Indexes
            $table->index(['status', 'listing_type']);
            $table->index(['city', 'state']);
            $table->index(['property_type', 'status']);
            $table->index(['price']);
            $table->index(['bedrooms', 'bathrooms']);
            $table->index(['listed_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropIndex(['status', 'listing_type']);
            $table->dropIndex(['city', 'state']);
            $table->dropIndex(['property_type', 'status']);
            $table->dropIndex(['price']);
            $table->dropIndex(['bedrooms', 'bathrooms']);
            $table->dropIndex(['listed_at']);

            $table->dropColumn([
                'property_type',
                'listing_type',
                'status',
                'description',
                'slug',
                'address',
                'city',
                'state',
                'postal_code',
                'country',
                'latitude',
                'longitude',
                'bedrooms',
                'bathrooms',
                'parking_spaces',
                'land_size',
                'built_area',
                'year_built',
                'price',
                'price_per_sqm',
                'features',
                'amenities',
                'images',
                'videos',
                'virtual_tour_url',
                'floor_plan',
                'meta_description',
                'meta_keywords',
                'listed_at',
                'expires_at',
                'deleted_at'
            ]);
        });
    }
};
