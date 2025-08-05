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
            if (!Schema::hasColumn('properties', 'property_type')) {
                $table->string('property_type')->default('house')->after('name'); // house, land
            }
            if (!Schema::hasColumn('properties', 'listing_type')) {
                $table->string('listing_type')->default('sale')->after('property_type'); // sale, rent, lease
            }
            if (!Schema::hasColumn('properties', 'status')) {
                $table->string('status')->default('available')->after('listing_type'); // available, sold, rented, pending
            }

            // Description and slug
            if (!Schema::hasColumn('properties', 'slug')) {
                $table->string('slug')->unique()->nullable()->after('description');
            }

            // Location details
            if (!Schema::hasColumn('properties', 'address')) {
                $table->string('address')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('properties', 'city')) {
                $table->string('city')->nullable()->after('address');
            }
            if (!Schema::hasColumn('properties', 'state')) {
                $table->string('state')->nullable()->after('city');
            }
            if (!Schema::hasColumn('properties', 'postal_code')) {
                $table->string('postal_code')->nullable()->after('state');
            }
            if (!Schema::hasColumn('properties', 'country')) {
                $table->string('country')->default('Nigeria')->after('postal_code');
            }
            if (!Schema::hasColumn('properties', 'latitude')) {
                $table->decimal('latitude', 10, 8)->nullable()->after('country');
            }
            if (!Schema::hasColumn('properties', 'longitude')) {
                $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            }

            // Property specifications
            if (!Schema::hasColumn('properties', 'bedrooms')) {
                $table->integer('bedrooms')->nullable()->after('longitude');
            }
            if (!Schema::hasColumn('properties', 'bathrooms')) {
                $table->integer('bathrooms')->nullable()->after('bedrooms');
            }
            if (!Schema::hasColumn('properties', 'parking_spaces')) {
                $table->integer('parking_spaces')->nullable()->after('bathrooms');
            }
            if (!Schema::hasColumn('properties', 'land_size')) {
                $table->decimal('land_size', 10, 2)->nullable()->after('parking_spaces'); // in square meters
            }
            if (!Schema::hasColumn('properties', 'built_area')) {
                $table->decimal('built_area', 10, 2)->nullable()->after('land_size'); // in square meters
            }
            if (!Schema::hasColumn('properties', 'year_built')) {
                $table->integer('year_built')->nullable()->after('built_area');
            }

            // Pricing
            if (!Schema::hasColumn('properties', 'price')) {
                $table->decimal('price', 15, 2)->nullable()->after('year_built');
            }
            if (!Schema::hasColumn('properties', 'price_per_sqm')) {
                $table->decimal('price_per_sqm', 10, 2)->nullable()->after('price');
            }

            // Features and amenities (JSON field)
            if (!Schema::hasColumn('properties', 'features')) {
                $table->json('features')->nullable()->after('price_per_sqm');
            }
            if (!Schema::hasColumn('properties', 'amenities')) {
                $table->json('amenities')->nullable()->after('features');
            }

            // Media
            if (!Schema::hasColumn('properties', 'images')) {
                $table->json('images')->nullable()->after('amenities'); // Array of image paths
            }
            if (!Schema::hasColumn('properties', 'videos')) {
                $table->json('videos')->nullable()->after('images'); // Array of video paths
            }
            if (!Schema::hasColumn('properties', 'virtual_tour_url')) {
                $table->string('virtual_tour_url')->nullable()->after('videos');
            }
            if (!Schema::hasColumn('properties', 'floor_plan')) {
                $table->string('floor_plan')->nullable()->after('virtual_tour_url');
            }

            // SEO and metadata
            if (!Schema::hasColumn('properties', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('floor_plan');
            }
            if (!Schema::hasColumn('properties', 'meta_keywords')) {
                $table->string('meta_keywords')->nullable()->after('meta_description');
            }

            // Timestamps for listing
            if (!Schema::hasColumn('properties', 'listed_at')) {
                $table->timestamp('listed_at')->nullable()->after('meta_keywords');
            }
            if (!Schema::hasColumn('properties', 'expires_at')) {
                $table->timestamp('expires_at')->nullable()->after('listed_at');
            }

            // Soft delete
            if (!Schema::hasColumn('properties', 'deleted_at')) {
                $table->softDeletes()->after('expires_at');
            }
        });
        
        // Add indexes safely
        Schema::table('properties', function (Blueprint $table) {
            try {
                $table->index(['status', 'listing_type']);
            } catch (Exception $e) {
                // Index might already exist, ignore
            }
            
            try {
                $table->index(['city', 'state']);
            } catch (Exception $e) {
                // Index might already exist, ignore
            }
            
            try {
                $table->index(['property_type', 'status']);
            } catch (Exception $e) {
                // Index might already exist, ignore
            }
            
            try {
                $table->index(['price']);
            } catch (Exception $e) {
                // Index might already exist, ignore
            }
            
            try {
                $table->index(['bedrooms', 'bathrooms']);
            } catch (Exception $e) {
                // Index might already exist, ignore
            }
            
            try {
                $table->index(['listed_at']);
            } catch (Exception $e) {
                // Index might already exist, ignore
            }
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
