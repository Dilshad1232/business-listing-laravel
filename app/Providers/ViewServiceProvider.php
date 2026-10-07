<?php

namespace App\Providers;

use App\Models\Business;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.main', function ($view) {

            /*
            |--------------------------------------------------------------------------
            | Explore Categories
            |--------------------------------------------------------------------------
            */
            $exploreCategories = Category::where('status', true)
                ->withCount([
                    'businesses' => function ($query) {
                        $query->where('status', 'approved');
                    }
                ])
                ->orderBy('sort_order')
                ->orderBy('name')
                ->take(6)
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Explore Locations
            |--------------------------------------------------------------------------
            */
            $exploreLocations = Business::where('status', 'approved')
                ->whereNotNull('city_id')
                ->with('city')
                ->get()
                ->filter(function ($business) {
                    return $business->city;
                })
                ->unique('city_id')
                ->sortBy(function ($business) {
                    return $business->city->name;
                })
                ->take(5);

            /*
            |--------------------------------------------------------------------------
            | Featured Business
            |--------------------------------------------------------------------------
            */
            $featuredListing = Business::with([
                'category',
                'subcategory'
            ])
                ->where('status', 'approved')
                ->where('is_featured', true)
                ->latest()
                ->first();

            /*
            |--------------------------------------------------------------------------
            | Total Approved Businesses
            |--------------------------------------------------------------------------
            */
            $exploreListingCount = Business::where('status', 'approved')
                ->count();

            /*
            |--------------------------------------------------------------------------
            | Total Cities
            |--------------------------------------------------------------------------
            */
            $exploreCityCount = Business::where('status', 'approved')
                ->whereNotNull('city_id')
                ->distinct('city_id')
                ->count('city_id');

            /*
            |--------------------------------------------------------------------------
            | Share Data With Layout
            |--------------------------------------------------------------------------
            */
            $view->with([
                'exploreCategories' => $exploreCategories,
                'exploreLocations' => $exploreLocations,
                'featuredListing' => $featuredListing,
                'exploreListingCount' => $exploreListingCount,
                'exploreCityCount' => $exploreCityCount,
            ]);
        });
    }
}
