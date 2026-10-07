<?php

namespace App\Http\Controllers;

use App\Models\BusinessService;
use App\Models\Business;
use App\Models\Category;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;

use App\Http\Controllers\CategoryController;
class BusinessController extends Controller
{
    public function index(Request $request): View
    {
        /*
        |--------------------------------------------------------------------------
        | BASE QUERY
        |--------------------------------------------------------------------------
        */
        $query = Business::with([
            'category',
            'subcategory',
            'country',
            'state',
            'city',
            'area',
        ])
            ->where('status', 'approved');


        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {
            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                // Business fields
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('tagline', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')

                    // Category
                    ->orWhereHas('category', function ($categoryQuery) use ($search) {
                        $categoryQuery->where('name', 'like', '%' . $search . '%');
                    })

                    // Subcategory
                    ->orWhereHas('subcategory', function ($subcategoryQuery) use ($search) {
                        $subcategoryQuery->where('name', 'like', '%' . $search . '%');
                    })

                    // Country
                    ->orWhereHas('country', function ($countryQuery) use ($search) {
                        $countryQuery->where('name', 'like', '%' . $search . '%');
                    })

                    // State
                    ->orWhereHas('state', function ($stateQuery) use ($search) {
                        $stateQuery->where('name', 'like', '%' . $search . '%');
                    })

                    // City
                    ->orWhereHas('city', function ($cityQuery) use ($search) {
                        $cityQuery->where('name', 'like', '%' . $search . '%');
                    })

                    // Services
                    ->orWhereHas('services', function ($serviceQuery) use ($search) {
                        $serviceQuery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('short_description', 'like', '%' . $search . '%')
                            ->orWhere('description', 'like', '%' . $search . '%');
                    });
            });
        }


        /*
        |--------------------------------------------------------------------------
        | CATEGORY FILTER
        |--------------------------------------------------------------------------
        */
        if ($request->filled('category')) {

            $query->where(
                'category_id',
                $request->category
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SUBCATEGORY FILTER
        |--------------------------------------------------------------------------
        */
        if ($request->filled('subcategory')) {

            $query->where(
                'subcategory_id',
                $request->subcategory
            );
        }


        /*
        |--------------------------------------------------------------------------
        | COUNTRY FILTER
        |--------------------------------------------------------------------------
        */
        if ($request->filled('country')) {

            $query->where(
                'country_id',
                $request->country
            );
        }


        /*
        |--------------------------------------------------------------------------
        | STATE FILTER
        |--------------------------------------------------------------------------
        */
        if ($request->filled('state')) {

            $query->where(
                'state_id',
                $request->state
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CITY FILTER
        |--------------------------------------------------------------------------
        */
        if ($request->filled('city')) {

            $query->where(
                'city_id',
                $request->city
            );
        }


        /*
        |--------------------------------------------------------------------------
        | RATING FILTER
        |--------------------------------------------------------------------------
        */
        if ($request->filled('rating')) {

            $query->where(
                'rating',
                '>=',
                (float) $request->rating
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FEATURED FILTER
        |--------------------------------------------------------------------------
        */
        if ($request->filled('featured')) {

            if ($request->featured == '1') {

                $query->where(
                    'is_featured',
                    true
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | SORTING
        |--------------------------------------------------------------------------
        */

        switch ($request->get('sort')) {

            case 'rating_high':
                $query->orderByDesc('rating');
                break;

            case 'reviews_high':
                $query->orderByDesc('reviews_count');
                break;

            case 'name_az':
                $query->orderBy('name');
                break;

            case 'name_za':
                $query->orderByDesc('name');
                break;

            case 'oldest':
                $query->oldest();
                break;

            case 'featured':
                $query->orderByDesc('is_featured')
                    ->orderByDesc('rating');
                break;

            default:
                $query->latest();
                break;
        }


        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */
        $businesses = $query
            ->paginate(12)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | FILTER DATA
        |--------------------------------------------------------------------------
        */

        $categories = Category::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

            $subcategories = Subcategory::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
            $countries = Country::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $states = State::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $cities = City::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */
        return view('businesses.index', compact(
            'businesses',
            'categories',
            'subcategories',
            'countries',
            'states',
            'cities'
        ));
    }


    public function show(Business $business): View
{
    abort_if(
        $business->status !== 'approved',
        404
    );

    $business->load([
        'category',
        'subcategory',
        'country',
        'state',
        'city',
        'area',

        'businessHours',

        'photos',

        'services',

        'products',
        'offers',

        'reviews' => function ($query) {

            $query->where('status', 'approved')
                ->with('user')
                ->latest();

        },
    ]);

    return view(
        'businesses.show',
        compact('business')
    );
}
public function serviceShow(BusinessService $service): View
{
    abort_if($service->status !== true, 404);

    $service->load([
        'business.category',
        'business.subcategory',
        'business.city',
        'business.state',
        'business.country',
        'business.area',
    ]);

    return view('services.show', compact('service'));
}
    public function suggestions(Request $request)
{
    $search = trim($request->get('q', ''));

    if ($search === '' || strlen($search) < 2) {
        return response()->json([]);
    }

    $businesses = Business::with([
        'category',
        'subcategory',
        'city',
        'state',
    ])
        ->where('status', 'approved')
        ->where(function ($query) use ($search) {

            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('tagline', 'like', '%' . $search . '%')
                ->orWhereHas('category', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('subcategory', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('city', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('state', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                ->orWhereHas('services', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('short_description', 'like', '%' . $search . '%');
                });
        })
        ->latest()
        ->limit(8)
        ->get();

    return response()->json(
        $businesses->map(function ($business) {
            return [
                'id' => $business->id,
                'name' => $business->name,
                'category' => $business->category?->name,
                'subcategory' => $business->subcategory?->name,
                'city' => $business->city?->name,
                'state' => $business->state?->name,
                'url' => route('businesses.show', $business),
            ];
        })
    );
}
public function resolveSlug(string $slug)
{
    /*
    |--------------------------------------------------------------------------
    | 1. CHECK CATEGORY
    |--------------------------------------------------------------------------
    */

    $category = Category::where('slug', $slug)
        ->where('status', true)
        ->first();

    if ($category) {

        /*
        |--------------------------------------------------------------------------
        | SUBCATEGORIES
        |--------------------------------------------------------------------------
        */

        $category->load([
            'subcategories' => function ($query) {
                $query
                    ->where('status', true)
                    ->withCount([
                        'businesses' => function ($businessQuery) {
                            $businessQuery->where('status', 'approved');
                        }
                    ])
                    ->orderBy('sort_order')
                    ->orderBy('name');
            }
        ]);


        /*
        |--------------------------------------------------------------------------
        | BUSINESS COUNT
        |--------------------------------------------------------------------------
        |
        | Count only approved businesses belonging to this category.
        |
        */

        $businessCount = Business::where('category_id', $category->id)
            ->where('status', 'approved')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | FEATURED BUSINESSES
        |--------------------------------------------------------------------------
        |
        | Show featured approved businesses on category page.
        |
        */

        $businesses = Business::query()
            ->where('category_id', $category->id)
            ->where('status', 'approved')
            ->with([
                'category',
                'subcategory',
                'city'
            ])
            ->withCount([
                'products' => function ($query) {
                    $query->where('status', true);
                }
            ])
            ->orderByDesc('is_featured')
            ->orderByDesc('rating')
            ->orderBy('name')
            ->take(12)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PRODUCT COUNT
        |--------------------------------------------------------------------------
        |
        | Count active products under this category.
        |
        */

        $productCount = Product::where('category_id', $category->id)
            ->where('status', true)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | FEATURED PRODUCTS
        |--------------------------------------------------------------------------
        */

        $products = Product::query()
            ->where('category_id', $category->id)
            ->where('status', true)
            ->with([
                'business',
                'category',
                'subcategory',
                'images'
            ])
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->take(12)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | RETURN CATEGORY PAGE
        |--------------------------------------------------------------------------
        */

        return view('categories.show', compact(
            'category',
            'businesses',
            'businessCount',
            'products',
            'productCount'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | 2. CHECK BUSINESS
    |--------------------------------------------------------------------------
    */

    $business = Business::where('slug', $slug)
        ->where('status', 'approved')
        ->first();

    if ($business) {
        return $this->show($business);
    }


    /*
    |--------------------------------------------------------------------------
    | 3. NOTHING FOUND
    |--------------------------------------------------------------------------
    */

    abort(404);
}
}
