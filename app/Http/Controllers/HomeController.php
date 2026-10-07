<?php
namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Category;
use App\Models\HomeSlider;
use App\Models\Offer;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     */
    public function index(): View
    {
        /*
|--------------------------------------------------------------------------
| HOME SLIDERS
|--------------------------------------------------------------------------
*/

        $homeSliders = HomeSlider::where('status', true)
            ->orderBy('sort_order')
            ->get();
        /*
        |--------------------------------------------------------------------------
        | CATEGORIES
        |--------------------------------------------------------------------------
        */

        $categories = Category::withCount([
            'businesses as approved_businesses_count' => function ($query) {
                $query->where('status', 'approved');
            },
        ])
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $searchLocations = Business::with('city')
            ->where('status', 'approved')
            ->whereNotNull('city_id')
            ->get()
            ->pluck('city')
            ->filter()
            ->unique('id')
            ->sortBy('name')
            ->values();
        /*
        |--------------------------------------------------------------------------
        | LOCATIONS
        |--------------------------------------------------------------------------
        | Businesses have location IDs instead of direct city/country columns.
        |--------------------------------------------------------------------------
        */

        $locations = Business::with([
            'country',
            'state',
            'city',
            'area',
        ])
            ->where('status', 'approved')
            ->whereNotNull('city_id')
            ->get()
            ->unique('city_id')
            ->sortBy(function ($business) {
                return $business->city?->name ?? '';
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | POPULAR PLACES
        |--------------------------------------------------------------------------
        */

        $popularPlaces = Business::with([
            'country',
            'state',
            'city',
            'area',
        ])
            ->where('status', 'approved')
            ->whereNotNull('city_id')
            ->get()
            ->groupBy('city_id')
            ->map(function ($businesses) {

                $firstBusiness = $businesses->first();

                return (object) [
                    'city'           => $firstBusiness->city?->name,
                    'country'        => $firstBusiness->country?->name,
                    'city_id'        => $firstBusiness->city_id,
                    'country_id'     => $firstBusiness->country_id,
                    'listings_count' => $businesses->count(),
                    'image'          => $businesses
                        ->whereNotNull('cover_image')
                        ->where('cover_image', '!=', '')
                        ->first()?->cover_image,
                ];
            })
            ->sortByDesc('listings_count')
            ->take(5)
            ->values();

        /*
        |--------------------------------------------------------------------------
        | WEEKLY PICKS
        |--------------------------------------------------------------------------
        */

        $weeklyPicks = Business::with([
            'category',
            'subcategory',
            'country',
            'state',
            'city',
            'area',
        ])
            ->where('status', 'approved')
            ->where('is_featured', true)
            ->orderByDesc('rating')
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | LATEST LISTINGS
        |--------------------------------------------------------------------------
        */

        $latestListings = Business::with([
            'category',
            'subcategory',
            'country',
            'state',
            'city',
            'area',
        ])
            ->where('status', 'approved')
            ->latest()
            ->take(3)
            ->get();

/*
|--------------------------------------------------------------------------
| OFFERS
|--------------------------------------------------------------------------
*/

        $offers = Offer::with([
            'business',
        ])
            ->where('status', true)
            ->whereHas('business', function ($query) {
                $query->where('status', 'approved');
            })
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | STATS
        |--------------------------------------------------------------------------
        */

        $stats = [
            'total_listings'   => Business::where(
                'status',
                'approved'
            )->count(),

            'total_categories' => Category::where(
                'status',
                true
            )->count(),

            'total_places'     => Business::where(
                'status',
                'approved'
            )
                ->whereNotNull('city_id')
                ->distinct('city_id')
                ->count('city_id'),

            'total_countries'  => Business::where(
                'status',
                'approved'
            )
                ->whereNotNull('country_id')
                ->distinct('country_id')
                ->count('country_id'),
        ];

        /*
        |--------------------------------------------------------------------------
        | RETURN HOME VIEW
        |--------------------------------------------------------------------------
        */

        return view('home', compact(
            'categories',
            'searchLocations',
            'locations',
            'popularPlaces',
            'weeklyPicks',
            'latestListings',
            'offers',
            'stats',
            'homeSliders',
        ));
    }

    /**
     * About page.
     */
    public function about(): View
    {
        return view('about');
    }

    public function howItWorks()
    {
        return view('how-it-works');
    }

    public function faq()
    {
        return view('faq');
    }

    public function privacyPolicy()
    {
        return view('privacy-policy');
    }

    public function termsConditions()
    {
        return view('terms-conditions');
    }

    public function disclaimer()
    {
        return view('disclaimer');
    }

    public function advertiseWithUs()
    {
        return view('advertise');
    }

    public function blog()
    {
        return view('blog');
    }
    public function blogDetail()
    {
        return view('blog-detail');
    }

    public function blogCategories()
    {
        return view('blog.categories');
    }

}
