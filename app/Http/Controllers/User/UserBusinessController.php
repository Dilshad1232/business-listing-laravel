<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Business;
use App\Models\BusinessHour;
use App\Models\BusinessPhoto;
use App\Models\BusinessService;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Notification;
use App\Models\State;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserBusinessController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | My Businesses
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $businesses = Business::with([
            'category',
            'subcategory',
            'country',
            'state',
            'city',
            'area',
        ])
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('user.business.index', compact('businesses'));
    }


    /*
    |--------------------------------------------------------------------------
    | Add Business
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $categories = Category::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $countries = Country::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('user.business.create', compact(
            'categories',
            'countries'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | Store Business
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Category
            |--------------------------------------------------------------------------
            */

            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
                    ->where(fn ($query) =>
                        $query->where('status', true)
                    ),
            ],

            'subcategory_id' => [
                'nullable',
                Rule::exists('subcategories', 'id')
                    ->where(fn ($query) =>
                        $query
                            ->where('category_id', $request->category_id)
                            ->where('status', true)
                    ),
            ],


            /*
            |--------------------------------------------------------------------------
            | Location
            |--------------------------------------------------------------------------
            */

            'country_id' => [
                'required',
                Rule::exists('countries', 'id')
                    ->where(fn ($query) =>
                        $query->where('status', true)
                    ),
            ],

            'state_id' => [
                'required',
                Rule::exists('states', 'id')
                    ->where(fn ($query) =>
                        $query
                            ->where('country_id', $request->country_id)
                            ->where('status', true)
                    ),
            ],

            'city_id' => [
                'required',
                Rule::exists('cities', 'id')
                    ->where(fn ($query) =>
                        $query
                            ->where('country_id', $request->country_id)
                            ->where('state_id', $request->state_id)
                            ->where('status', true)
                    ),
            ],

            'area_id' => [
                'nullable',
                Rule::exists('areas', 'id')
                    ->where(fn ($query) =>
                        $query
                            ->where('country_id', $request->country_id)
                            ->where('state_id', $request->state_id)
                            ->where('city_id', $request->city_id)
                            ->where('status', true)
                    ),
            ],


            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:businesses,slug',
            ],

            'tagline' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],


            /*
            |--------------------------------------------------------------------------
            | Contact
            |--------------------------------------------------------------------------
            */

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'website' => [
                'nullable',
                'url',
                'max:255',
            ],


            /*
            |--------------------------------------------------------------------------
            | Address
            |--------------------------------------------------------------------------
            */

            'address' => [
                'nullable',
                'string',
                'max:500',
            ],

            'pincode' => [
                'nullable',
                'string',
                'max:20',
            ],


            /*
            |--------------------------------------------------------------------------
            | Logo
            |--------------------------------------------------------------------------
            */

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'cover_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],


            /*
            |--------------------------------------------------------------------------
            | Gallery
            |--------------------------------------------------------------------------
            */

            'photos' => [
                'nullable',
                'array',
                'max:20',
            ],

            'photos.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],


            /*
            |--------------------------------------------------------------------------
            | Business Hours
            |--------------------------------------------------------------------------
            */

            'business_hours' => [
                'nullable',
                'array',
            ],

            'business_hours.*.is_closed' => [
                'nullable',
                'boolean',
            ],

            'business_hours.*.is_24_hours' => [
                'nullable',
                'boolean',
            ],

            'business_hours.*.opening_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'business_hours.*.closing_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'business_hours.*.opening_time_2' => [
                'nullable',
                'date_format:H:i',
            ],

            'business_hours.*.closing_time_2' => [
                'nullable',
                'date_format:H:i',
            ],


            /*
            |--------------------------------------------------------------------------
            | Business Services
            |--------------------------------------------------------------------------
            */

            'services' => [
                'nullable',
                'array',
                'max:50',
            ],

            'services.*.name' => [
                'required',
                'string',
                'max:255',
            ],

            'services.*.short_description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'services.*.description' => [
                'nullable',
                'string',
            ],

            'services.*.price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'services.*.duration' => [
                'nullable',
                'string',
                'max:100',
            ],

            'services.*.status' => [
                'nullable',
                'boolean',
            ],

            'services.*.sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['slug'])) {

            $slug = Str::slug($validated['slug']);

        } else {

            $slug = Str::slug($validated['name']);
        }


        $originalSlug = $slug;
        $counter = 1;

        while (Business::where('slug', $slug)->exists()) {

            $slug = $originalSlug . '-' . $counter;

            $counter++;
        }


        /*
        |--------------------------------------------------------------------------
        | Upload Logo
        |--------------------------------------------------------------------------
        */

        $logoPath = null;

        if ($request->hasFile('logo')) {

            $logoPath = $request
                ->file('logo')
                ->store('businesses/logos', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Upload Cover
        |--------------------------------------------------------------------------
        */

        $coverPath = null;

        if ($request->hasFile('cover_image')) {

            $coverPath = $request
                ->file('cover_image')
                ->store('businesses/covers', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Extra Data
        |--------------------------------------------------------------------------
        */

        $businessHours = $validated['business_hours'] ?? [];

        $businessServices = $validated['services'] ?? [];

        $galleryPhotos = $request->file('photos', []);


        /*
        |--------------------------------------------------------------------------
        | Create Business
        |--------------------------------------------------------------------------
        */

        $business = DB::transaction(function () use (
            $request,
            $validated,
            $slug,
            $logoPath,
            $coverPath,
            $businessHours,
            $businessServices,
            $galleryPhotos
        ) {

            $business = Business::create([

                'user_id' => $request->user()->id,

                'category_id' =>
                    $validated['category_id'],

                'subcategory_id' =>
                    $validated['subcategory_id'] ?? null,

                'country_id' =>
                    $validated['country_id'],

                'state_id' =>
                    $validated['state_id'],

                'city_id' =>
                    $validated['city_id'],

                'area_id' =>
                    $validated['area_id'] ?? null,

                'name' =>
                    $validated['name'],

                'slug' =>
                    $slug,

                'tagline' =>
                    $validated['tagline'] ?? null,

                'description' =>
                    $validated['description'] ?? null,

                'phone' =>
                    $validated['phone'] ?? null,

                'email' =>
                    $validated['email'] ?? null,

                'website' =>
                    $validated['website'] ?? null,

                'address' =>
                    $validated['address'] ?? null,

                'pincode' =>
                    $validated['pincode'] ?? null,

                'logo' =>
                    $logoPath,

                'cover_image' =>
                    $coverPath,

                /*
                | User submitted business
                */

                'status' =>
                    'pending',

                'is_featured' =>
                    false,

                'rating' =>
                    0,

                'reviews_count' =>
                    0,
            ]);


            /*
            |--------------------------------------------------------------------------
            | Business Hours
            |--------------------------------------------------------------------------
            */

            foreach ($businessHours as $day => $data) {

                $isClosed =
                    isset($data['is_closed'])
                    && (bool) $data['is_closed'];

                $is24Hours =
                    isset($data['is_24_hours'])
                    && (bool) $data['is_24_hours'];


                BusinessHour::create([

                    'business_id' =>
                        $business->id,

                    'day_of_week' =>
                        (int) $day,

                    'is_closed' =>
                        $isClosed,

                    'is_24_hours' =>
                        $is24Hours,

                    'opening_time' =>
                        ($isClosed || $is24Hours)
                            ? null
                            : ($data['opening_time'] ?? null),

                    'closing_time' =>
                        ($isClosed || $is24Hours)
                            ? null
                            : ($data['closing_time'] ?? null),

                    'opening_time_2' =>
                        ($isClosed || $is24Hours)
                            ? null
                            : ($data['opening_time_2'] ?? null),

                    'closing_time_2' =>
                        ($isClosed || $is24Hours)
                            ? null
                            : ($data['closing_time_2'] ?? null),
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | Business Services
            |--------------------------------------------------------------------------
            */

            foreach ($businessServices as $index => $serviceData) {

                if (empty($serviceData['name'])) {
                    continue;
                }


                $serviceName =
                    trim($serviceData['name']);

                $serviceSlug =
                    Str::slug($serviceName);


                if (empty($serviceSlug)) {

                    $serviceSlug =
                        'service-' . ($index + 1);
                }


                $originalServiceSlug =
                    $serviceSlug;

                $serviceCounter = 2;


                while (
                    BusinessService::where(
                        'business_id',
                        $business->id
                    )
                        ->where(
                            'slug',
                            $serviceSlug
                        )
                        ->exists()
                ) {

                    $serviceSlug =
                        $originalServiceSlug
                        . '-' .
                        $serviceCounter;

                    $serviceCounter++;
                }


                BusinessService::create([

                    'business_id' =>
                        $business->id,

                    'name' =>
                        $serviceName,

                    'slug' =>
                        $serviceSlug,

                    'short_description' =>
                        $serviceData['short_description'] ?? null,

                    'description' =>
                        $serviceData['description'] ?? null,

                    'price' =>
                        $serviceData['price'] ?? null,

                    'duration' =>
                        $serviceData['duration'] ?? null,

                    'status' =>
                        isset($serviceData['status'])
                            ? (bool) $serviceData['status']
                            : true,

                    'sort_order' =>
                        $serviceData['sort_order']
                        ?? ($index + 1),
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | Gallery Photos
            |--------------------------------------------------------------------------
            */

            foreach ($galleryPhotos as $index => $photo) {

                $path = $photo->store(
                    'businesses/' .
                    $business->id .
                    '/gallery',
                    'public'
                );


                BusinessPhoto::create([

                    'business_id' =>
                        $business->id,

                    'image' =>
                        $path,

                    'caption' =>
                        null,

                    'sort_order' =>
                        $index + 1,

                    'is_featured' =>
                        $index === 0,
                ]);
            }


            return $business;
        });


        /*
        |--------------------------------------------------------------------------
        | Notify Admins
        |--------------------------------------------------------------------------
        */

        $admins = User::where(
            'role',
            'admin'
        )->get();


        foreach ($admins as $admin) {

            Notification::create([

                'user_id' =>
                    $admin->id,

                'title' =>
                    'New Business Submitted',

                'message' =>
                    $business->name .
                    ' has been submitted for approval.',

                'type' =>
                    'business',

                'action_url' =>
                    route(
                        'admin.businesses.show',
                        $business
                    ),

                'is_read' =>
                    false,

                'read_at' =>
                    null,
            ]);
        }


        return redirect()
            ->route('user.businesses.index')
            ->with(
                'success',
                'Business added successfully and is pending approval.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Show Business
    |--------------------------------------------------------------------------
    */

    public function show(
        Request $request,
        Business $business
    ) {
        abort_unless(
            $business->user_id === $request->user()->id,
            403
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
        ]);


        return view(
            'user.business.show',
            compact('business')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Edit Business
    |--------------------------------------------------------------------------
    */

    public function edit(
        Request $request,
        Business $business
    ) {
        abort_unless(
            $business->user_id === $request->user()->id,
            403
        );


        $categories = Category::where(
            'status',
            true
        )
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();


        $countries = Country::where(
            'status',
            true
        )
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();


        $business->load([
            'businessHours',
            'photos',
            'services',
        ]);


        return view(
            'user.business.edit',
            compact(
                'business',
                'categories',
                'countries'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Business
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Business $business
    ) {
        /*
        | User can update only own business
        */

        abort_unless(
            $business->user_id === $request->user()->id,
            403
        );


        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Category
            |--------------------------------------------------------------------------
            */

            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
                    ->where(fn ($query) =>
                        $query->where('status', true)
                    ),
            ],

            'subcategory_id' => [
                'nullable',
                Rule::exists('subcategories', 'id')
                    ->where(fn ($query) =>
                        $query
                            ->where(
                                'category_id',
                                $request->category_id
                            )
                            ->where('status', true)
                    ),
            ],


            /*
            |--------------------------------------------------------------------------
            | Location
            |--------------------------------------------------------------------------
            */

            'country_id' => [
                'required',
                Rule::exists('countries', 'id')
                    ->where(fn ($query) =>
                        $query->where('status', true)
                    ),
            ],

            'state_id' => [
                'required',
                Rule::exists('states', 'id')
                    ->where(fn ($query) =>
                        $query
                            ->where(
                                'country_id',
                                $request->country_id
                            )
                            ->where('status', true)
                    ),
            ],

            'city_id' => [
                'required',
                Rule::exists('cities', 'id')
                    ->where(fn ($query) =>
                        $query
                            ->where(
                                'country_id',
                                $request->country_id
                            )
                            ->where(
                                'state_id',
                                $request->state_id
                            )
                            ->where('status', true)
                    ),
            ],

            'area_id' => [
                'nullable',
                Rule::exists('areas', 'id')
                    ->where(fn ($query) =>
                        $query
                            ->where(
                                'country_id',
                                $request->country_id
                            )
                            ->where(
                                'state_id',
                                $request->state_id
                            )
                            ->where(
                                'city_id',
                                $request->city_id
                            )
                            ->where('status', true)
                    ),
            ],


            /*
            |--------------------------------------------------------------------------
            | Basic
            |--------------------------------------------------------------------------
            */

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:businesses,slug,' . $business->id,
            ],

            'tagline' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],


            /*
            |--------------------------------------------------------------------------
            | Contact
            |--------------------------------------------------------------------------
            */

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            'website' => [
                'nullable',
                'url',
                'max:255',
            ],

            'address' => [
                'nullable',
                'string',
                'max:500',
            ],

            'pincode' => [
                'nullable',
                'string',
                'max:20',
            ],


            /*
            |--------------------------------------------------------------------------
            | Images
            |--------------------------------------------------------------------------
            */

            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'cover_image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],


            /*
            |--------------------------------------------------------------------------
            | Gallery
            |--------------------------------------------------------------------------
            */

            'photos' => [
                'nullable',
                'array',
                'max:20',
            ],

            'photos.*' => [
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],


            /*
            |--------------------------------------------------------------------------
            | Services
            |--------------------------------------------------------------------------
            */

            'services' => [
                'nullable',
                'array',
                'max:50',
            ],

            'services.*.id' => [
                'nullable',
                'integer',
                'exists:business_services,id',
            ],

            'services.*.name' => [
                'required',
                'string',
                'max:255',
            ],

            'services.*.short_description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'services.*.description' => [
                'nullable',
                'string',
            ],

            'services.*.price' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'services.*.duration' => [
                'nullable',
                'string',
                'max:100',
            ],

            'services.*.status' => [
                'nullable',
                'boolean',
            ],

            'services.*.sort_order' => [
                'nullable',
                'integer',
                'min:0',
            ],


            /*
            |--------------------------------------------------------------------------
            | Business Hours
            |--------------------------------------------------------------------------
            */

            'business_hours' => [
                'nullable',
                'array',
            ],

            'business_hours.*.is_closed' => [
                'nullable',
                'boolean',
            ],

            'business_hours.*.is_24_hours' => [
                'nullable',
                'boolean',
            ],

            'business_hours.*.opening_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'business_hours.*.closing_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'business_hours.*.opening_time_2' => [
                'nullable',
                'date_format:H:i',
            ],

            'business_hours.*.closing_time_2' => [
                'nullable',
                'date_format:H:i',
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        if (!empty($validated['slug'])) {

            $slug = Str::slug(
                $validated['slug']
            );

        } else {

            $slug = Str::slug(
                $validated['name']
            );
        }


        $originalSlug = $slug;
        $counter = 1;


        while (
            Business::where('slug', $slug)
                ->where('id', '!=', $business->id)
                ->exists()
        ) {

            $slug =
                $originalSlug .
                '-' .
                $counter;

            $counter++;
        }


        /*
        |--------------------------------------------------------------------------
        | Business Hours
        |--------------------------------------------------------------------------
        */

        $businessHours =
            $validated['business_hours'] ?? [];


        /*
        |--------------------------------------------------------------------------
        | Business Services
        |--------------------------------------------------------------------------
        */

        $businessServices =
            $validated['services'] ?? [];


        /*
        |--------------------------------------------------------------------------
        | Gallery
        |--------------------------------------------------------------------------
        */

        $galleryPhotos =
            $request->file('photos', []);


        /*
        |--------------------------------------------------------------------------
        | Update Business
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $request,
            $business,
            $validated,
            $slug,
            $businessHours,
            $businessServices,
            $galleryPhotos
        ) {

            /*
            |--------------------------------------------------------------------------
            | Basic Business Data
            |--------------------------------------------------------------------------
            */

            $business->category_id =
                $validated['category_id'];

            $business->subcategory_id =
                $validated['subcategory_id'] ?? null;

            $business->country_id =
                $validated['country_id'];

            $business->state_id =
                $validated['state_id'];

            $business->city_id =
                $validated['city_id'];

            $business->area_id =
                $validated['area_id'] ?? null;

            $business->name =
                $validated['name'];

            $business->slug =
                $slug;

            $business->tagline =
                $validated['tagline'] ?? null;

            $business->description =
                $validated['description'] ?? null;

            $business->phone =
                $validated['phone'] ?? null;

            $business->email =
                $validated['email'] ?? null;

            $business->website =
                $validated['website'] ?? null;

            $business->address =
                $validated['address'] ?? null;

            $business->pincode =
                $validated['pincode'] ?? null;


            /*
            |--------------------------------------------------------------------------
            | Logo
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('logo')) {

                if ($business->logo) {

                    Storage::disk('public')
                        ->delete($business->logo);
                }


                $business->logo =
                    $request
                        ->file('logo')
                        ->store(
                            'businesses/logos',
                            'public'
                        );
            }


            /*
            |--------------------------------------------------------------------------
            | Cover Image
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('cover_image')) {

                if ($business->cover_image) {

                    Storage::disk('public')
                        ->delete(
                            $business->cover_image
                        );
                }


                $business->cover_image =
                    $request
                        ->file('cover_image')
                        ->store(
                            'businesses/covers',
                            'public'
                        );
            }


            /*
            |--------------------------------------------------------------------------
            | Re-submit for Approval
            |--------------------------------------------------------------------------
            */

            $business->status =
                'pending';


            $business->save();


            /*
            |--------------------------------------------------------------------------
            | Business Hours
            |--------------------------------------------------------------------------
            */

            foreach ([
                1 => 'Monday',
                2 => 'Tuesday',
                3 => 'Wednesday',
                4 => 'Thursday',
                5 => 'Friday',
                6 => 'Saturday',
                0 => 'Sunday',
            ] as $day => $dayName) {

                $data =
                    $businessHours[$day] ?? [];


                $isClosed =
                    isset($data['is_closed'])
                    && (bool) $data['is_closed'];


                $is24Hours =
                    isset($data['is_24_hours'])
                    && (bool) $data['is_24_hours'];


                BusinessHour::updateOrCreate(

                    [
                        'business_id' =>
                            $business->id,

                        'day_of_week' =>
                            $day,
                    ],

                    [
                        'is_closed' =>
                            $isClosed,

                        'is_24_hours' =>
                            $is24Hours,

                        'opening_time' =>
                            ($isClosed || $is24Hours)
                                ? null
                                : ($data['opening_time'] ?? null),

                        'closing_time' =>
                            ($isClosed || $is24Hours)
                                ? null
                                : ($data['closing_time'] ?? null),

                        'opening_time_2' =>
                            ($isClosed || $is24Hours)
                                ? null
                                : ($data['opening_time_2'] ?? null),

                        'closing_time_2' =>
                            ($isClosed || $is24Hours)
                                ? null
                                : ($data['closing_time_2'] ?? null),
                    ]
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Business Services
            |--------------------------------------------------------------------------
            */

            $submittedServiceIds = [];


            foreach (
                $businessServices
                as $index => $serviceData
            ) {

                if (empty($serviceData['name'])) {
                    continue;
                }


                $serviceName =
                    trim($serviceData['name']);


                $serviceSlug =
                    Str::slug($serviceName);


                if (empty($serviceSlug)) {

                    $serviceSlug =
                        'service-' . ($index + 1);
                }


                /*
                | Existing service
                */

                if (!empty($serviceData['id'])) {

                    $service =
                        BusinessService::where(
                            'business_id',
                            $business->id
                        )
                            ->where(
                                'id',
                                $serviceData['id']
                            )
                            ->first();


                    if ($service) {

                        $submittedServiceIds[] =
                            $service->id;


                        $originalServiceSlug =
                            $serviceSlug;

                        $serviceCounter = 2;


                        while (
                            BusinessService::where(
                                'business_id',
                                $business->id
                            )
                                ->where(
                                    'slug',
                                    $serviceSlug
                                )
                                ->where(
                                    'id',
                                    '!=',
                                    $service->id
                                )
                                ->exists()
                        ) {

                            $serviceSlug =
                                $originalServiceSlug .
                                '-' .
                                $serviceCounter;

                            $serviceCounter++;
                        }


                        $service->update([

                            'name' =>
                                $serviceName,

                            'slug' =>
                                $serviceSlug,

                            'short_description' =>
                                $serviceData[
                                    'short_description'
                                ] ?? null,

                            'description' =>
                                $serviceData[
                                    'description'
                                ] ?? null,

                            'price' =>
                                $serviceData[
                                    'price'
                                ] ?? null,

                            'duration' =>
                                $serviceData[
                                    'duration'
                                ] ?? null,

                            'status' =>
                                isset(
                                    $serviceData['status']
                                )
                                    ? (bool)
                                        $serviceData['status']
                                    : false,

                            'sort_order' =>
                                $serviceData[
                                    'sort_order'
                                ] ?? ($index + 1),
                        ]);


                        continue;
                    }
                }


                /*
                | New service
                */

                $originalServiceSlug =
                    $serviceSlug;

                $serviceCounter = 2;


                while (
                    BusinessService::where(
                        'business_id',
                        $business->id
                    )
                        ->where(
                            'slug',
                            $serviceSlug
                        )
                        ->exists()
                ) {

                    $serviceSlug =
                        $originalServiceSlug .
                        '-' .
                        $serviceCounter;

                    $serviceCounter++;
                }


                $service =
                    BusinessService::create([

                        'business_id' =>
                            $business->id,

                        'name' =>
                            $serviceName,

                        'slug' =>
                            $serviceSlug,

                        'short_description' =>
                            $serviceData[
                                'short_description'
                            ] ?? null,

                        'description' =>
                            $serviceData[
                                'description'
                            ] ?? null,

                        'price' =>
                            $serviceData[
                                'price'
                            ] ?? null,

                        'duration' =>
                            $serviceData[
                                'duration'
                            ] ?? null,

                        'status' =>
                            isset(
                                $serviceData['status']
                            )
                                ? (bool)
                                    $serviceData['status']
                                : true,

                        'sort_order' =>
                            $serviceData[
                                'sort_order'
                            ] ?? ($index + 1),
                    ]);


                $submittedServiceIds[] =
                    $service->id;
            }


            /*
            |--------------------------------------------------------------------------
            | Delete Services Removed From Edit Form
            |--------------------------------------------------------------------------
            */

            if (
                !empty($businessServices)
            ) {

                BusinessService::where(
                    'business_id',
                    $business->id
                )
                    ->whereNotIn(
                        'id',
                        $submittedServiceIds
                    )
                    ->delete();
            }


            /*
            |--------------------------------------------------------------------------
            | Gallery Photos
            |--------------------------------------------------------------------------
            */

            if (!empty($galleryPhotos)) {

                $lastOrder =
                    $business->photos()
                        ->max('sort_order') ?? 0;


                foreach (
                    $galleryPhotos
                    as $photo
                ) {

                    $lastOrder++;


                    $path =
                        $photo->store(
                            'businesses/' .
                            $business->id .
                            '/gallery',
                            'public'
                        );


                    BusinessPhoto::create([

                        'business_id' =>
                            $business->id,

                        'image' =>
                            $path,

                        'caption' =>
                            null,

                        'sort_order' =>
                            $lastOrder,

                        'is_featured' =>
                            false,
                    ]);
                }
            }
        });


        /*
        |--------------------------------------------------------------------------
        | Notify Admins About Re-submission
        |--------------------------------------------------------------------------
        */

        $admins = User::where(
            'role',
            'admin'
        )->get();


        foreach ($admins as $admin) {

            Notification::create([

                'user_id' =>
                    $admin->id,

                'title' =>
                    'Business Updated',

                'message' =>
                    $business->name .
                    ' has been updated and submitted for approval again.',

                'type' =>
                    'business',

                'action_url' =>
                    route(
                        'admin.businesses.show',
                        $business
                    ),

                'is_read' =>
                    false,

                'read_at' =>
                    null,
            ]);
        }


        return redirect()
            ->route('user.businesses.index')
            ->with(
                'success',
                'Business updated successfully and is pending approval.'
            );
    }

    public function destroy(Business $business)
    {
        // Only owner can delete their own business
        abort_unless($business->user_id === auth()->id(), 403);

        DB::transaction(function () use ($business) {

            // Delete logo
            if ($business->logo) {
                Storage::disk('public')->delete($business->logo);
            }

            // Delete cover
            if ($business->cover_image) {
                Storage::disk('public')->delete($business->cover_image);
            }

            // Delete gallery images
            foreach ($business->photos as $photo) {

                if ($photo->image) {
                    Storage::disk('public')->delete($photo->image);
                }

                $photo->delete();
            }

            // Delete business hours
            $business->businessHours()->delete();

            // Delete services
            BusinessService::where('business_id', $business->id)->delete();

            // Delete business
            $business->delete();
        });

        return redirect()
            ->route('user.businesses.index')
            ->with('success', 'Business deleted successfully.');
    }
    /*
    |--------------------------------------------------------------------------
    | Dynamic Dropdowns
    |--------------------------------------------------------------------------
    */

    public function subcategories($category)
    {
        return Subcategory::where(
            'category_id',
            $category
        )
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);
    }


    public function states($country)
    {
        return State::where(
            'country_id',
            $country
        )
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);
    }


    public function cities($state)
    {
        return City::where(
            'state_id',
            $state
        )
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);
    }


    public function areas($city)
    {
        return Area::where(
            'city_id',
            $city
        )
            ->where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get([
                'id',
                'name',
            ]);
    }
}
