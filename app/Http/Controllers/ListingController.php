<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display public listings.
     */
    public function index(Request $request)
    {
        $query = Business::with([
            'category',
            'subcategory',
            'country',
            'state',
            'city',
            'area',
        ])->where('status', 'approved');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('city', function ($cityQuery) use ($search) {
                        $cityQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Category Filter
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // City Filter
        if ($request->filled('city')) {
            $query->whereHas('city', function ($q) use ($request) {
                $q->where('slug', $request->city)
                    ->orWhere('name', $request->city);
            });
        }

        // Price Filter
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');

        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;

            case 'rating_high':
                $query->orderByDesc('rating');
                break;

            case 'price_low':
                $query->orderBy('price', 'asc');
                break;

            case 'price_high':
                $query->orderBy('price', 'desc');
                break;

            default:
                $query->latest();
                break;
        }

        // Listings
        $listings = $query
            ->paginate(6)
            ->withQueryString();

        // Featured Businesses
        $featuredListings = Business::with([
            'category',
            'subcategory',
            'country',
            'state',
            'city',
            'area',
        ])
            ->where('status', 'approved')
            ->where('is_featured', true)
            ->latest()
            ->take(3)
            ->get();

        // Categories
        $categories = Category::where('status', true)
            ->withCount([
                'businesses' => function ($query) {
                    $query->where('status', 'approved');
                }
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Locations
        $locations = Business::with('city')
            ->where('status', 'approved')
            ->whereNotNull('city_id')
            ->get()
            ->filter(function ($business) {
                return $business->city;
            })
            ->unique('city_id')
            ->sortBy(function ($business) {
                return $business->city->name;
            })
            ->take(50)
            ->map(function ($business) {
                return $business->city->name;
            })
            ->values();

        // Price Range
        $priceMin = Business::where('status', 'approved')
            ->whereNotNull('price')
            ->min('price');

        $priceMax = Business::where('status', 'approved')
            ->whereNotNull('price')
            ->max('price');

        return view(
            'listings.index',
            compact(
                'listings',
                'categories',
                'locations',
                'priceMin',
                'priceMax',
                'featuredListings'
            )
        );
    }

    /**
     * Display listings on map.
     */
    public function map(Request $request)
    {
        $query = Business::with([
            'category',
            'subcategory',
            'country',
            'state',
            'city',
            'area',
        ])->where('status', 'approved');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('city', function ($cityQuery) use ($search) {
                        $cityQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Category
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // City
        if ($request->filled('city')) {
            $query->whereHas('city', function ($q) use ($request) {
                $q->where('slug', $request->city)
                    ->orWhere('name', $request->city);
            });
        }

        // Minimum price
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // Maximum price
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $listings = $query
            ->latest()
            ->get();

        // Categories
        $categories = Category::where('status', true)
            ->withCount([
                'businesses' => function ($query) {
                    $query->where('status', 'approved');
                }
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Locations
        $locations = Business::with('city')
            ->where('status', 'approved')
            ->whereNotNull('city_id')
            ->get()
            ->filter(function ($business) {
                return $business->city;
            })
            ->unique('city_id')
            ->sortBy(function ($business) {
                return $business->city->name;
            })
            ->take(50)
            ->map(function ($business) {
                return $business->city->name;
            })
            ->values();

        // Price Range
        $priceMin = Business::where('status', 'approved')
            ->whereNotNull('price')
            ->min('price');

        $priceMax = Business::where('status', 'approved')
            ->whereNotNull('price')
            ->max('price');

        return view(
            'listings.map',
            compact(
                'listings',
                'categories',
                'locations',
                'priceMin',
                'priceMax'
            )
        );
    }

    /**
     * Display business details.
     */
    public function details(string $slug)
    {
        $listing = Business::with([
            'category',
            'subcategory',
            'country',
            'state',
            'city',
            'area',
        ])
            ->where('slug', $slug)
            ->where('status', 'approved')
            ->firstOrFail();

        $relatedListings = Business::with([
            'category',
            'subcategory',
            'country',
            'state',
            'city',
            'area',
        ])
            ->where('status', 'approved')
            ->where('id', '!=', $listing->id)
            ->where('category_id', $listing->category_id)
            ->latest()
            ->take(3)
            ->get();

        return view(
            'listings.details',
            compact(
                'listing',
                'relatedListings'
            )
        );
    }

    /**
     * Display listings in list view.
     */
    public function list(Request $request)
    {
        $query = Business::with([
            'category',
            'subcategory',
            'country',
            'state',
            'city',
            'area',
        ])->where('status', 'approved');

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('short_description', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('city', function ($cityQuery) use ($search) {
                        $cityQuery->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // Category
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // City
        if ($request->filled('city')) {
            $query->whereHas('city', function ($q) use ($request) {
                $q->where('slug', $request->city)
                    ->orWhere('name', $request->city);
            });
        }

        // Minimum price
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // Maximum price
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');

        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;

            case 'rating_high':
                $query->orderByDesc('rating');
                break;

            case 'price_low':
                $query->orderBy('price', 'asc');
                break;

            case 'price_high':
                $query->orderBy('price', 'desc');
                break;

            default:
                $query->latest();
                break;
        }

        // Pagination
        $listings = $query
            ->paginate(6)
            ->withQueryString();

        // Categories
        $categories = Category::where('status', true)
            ->withCount([
                'businesses' => function ($query) {
                    $query->where('status', 'approved');
                }
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Locations
        $locations = Business::with('city')
            ->where('status', 'approved')
            ->whereNotNull('city_id')
            ->get()
            ->filter(function ($business) {
                return $business->city;
            })
            ->unique('city_id')
            ->sortBy(function ($business) {
                return $business->city->name;
            })
            ->take(50)
            ->map(function ($business) {
                return $business->city->name;
            })
            ->values();

        // Price Range
        $priceMin = Business::where('status', 'approved')
            ->whereNotNull('price')
            ->min('price');

        $priceMax = Business::where('status', 'approved')
            ->whereNotNull('price')
            ->max('price');

        return view(
            'listings.list',
            compact(
                'listings',
                'categories',
                'locations',
                'priceMin',
                'priceMax'
            )
        );
    }
}
