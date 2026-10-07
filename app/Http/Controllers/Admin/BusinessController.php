<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Business;
use App\Models\BusinessHour;
use App\Models\BusinessPhoto;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\Subcategory;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Models\BusinessService;
class BusinessController extends Controller
{
    public function index(): View
    {
        $businesses = Business::with([
            'user',
            'category',
            'subcategory',
            'country',
            'state',
            'city',
            'area',
        ])
            ->latest()
            ->paginate(15);

        return view('admin.businesses.index', compact('businesses'));
    }

    public function create(): View
    {
        $users = User::where('role', 'user')
            ->orderBy('name')
            ->get();

        $categories = Category::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $subcategories = Subcategory::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $countries = Country::where('status', true)
            ->orderBy('name')
            ->get();

        $states = State::where('status', true)
            ->orderBy('name')
            ->get();

        $cities = City::where('status', true)
            ->orderBy('name')
            ->get();

        $areas = Area::where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.businesses.create', compact(
            'users',
            'categories',
            'subcategories',
            'countries',
            'states',
            'cities',
            'areas'
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'subcategory_id' => ['nullable', 'exists:subcategories,id'],

            'country_id' => ['nullable', 'exists:countries,id'],
            'state_id' => ['nullable', 'exists:states,id'],
            'city_id' => ['nullable', 'exists:cities,id'],
            'area_id' => ['nullable', 'exists:areas,id'],

            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:businesses,slug'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],

            'address' => ['nullable', 'string'],
            'pincode' => ['nullable', 'string', 'max:20'],

            // Images
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

            // Gallery
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

            'status' => [
                'required',
                'in:pending,approved,rejected',
            ],

            'admin_notes' => ['nullable', 'string'],

            'is_featured' => ['nullable', 'boolean'],

            'rating' => [
                'nullable',
                'numeric',
                'min:0',
                'max:5',
            ],

            'reviews_count' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
// Business Services
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
'delete_services' => [
    'nullable',
    'array',
],

'delete_services.*' => [
    'integer',
    'exists:business_services,id',
],
            // Business Hours
            'business_hours' => ['nullable', 'array'],

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

        $validated['slug'] = $validated['slug']
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $validated['is_featured'] = $request->boolean('is_featured');

        $validated['rating'] = $validated['rating'] ?? 0;

        $validated['reviews_count'] = $validated['reviews_count'] ?? 0;


        /*
        |--------------------------------------------------------------------------
        | Upload Logo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('logo')) {

            $validated['logo'] = $request
                ->file('logo')
                ->store('businesses/logos', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Upload Cover Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('cover_image')) {

            $validated['cover_image'] = $request
                ->file('cover_image')
                ->store('businesses/covers', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Gallery Photos
        |--------------------------------------------------------------------------
        */

        $galleryPhotos = $request->file('photos', []);


        /*
        |--------------------------------------------------------------------------
        | Remove Business Hours From Business Data
        |--------------------------------------------------------------------------
        */

        $businessHours = $validated['business_hours'] ?? [];

        $businessServices = $validated['services'] ?? [];

        unset($validated['business_hours']);

        unset($validated['photos']);

        unset($validated['services']);


        /*
        |--------------------------------------------------------------------------
        | Create Business + Hours + Gallery
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $validated,
            $businessHours,
            $galleryPhotos,
            $businessServices
        ) {

            $business = Business::create($validated);


            /*
            |--------------------------------------------------------------------------
            | Save Business Hours
            |--------------------------------------------------------------------------
            */

            foreach ($businessHours as $day => $data) {

                $isClosed = isset($data['is_closed'])
                    && (bool) $data['is_closed'];

                $is24Hours = isset($data['is_24_hours'])
                    && (bool) $data['is_24_hours'];


                BusinessHour::create([
                    'business_id' => $business->id,

                    'day_of_week' => (int) $day,

                    'is_closed' => $isClosed,

                    'is_24_hours' => $is24Hours,

                    'opening_time' => ($isClosed || $is24Hours)
                        ? null
                        : ($data['opening_time'] ?? null),

                    'closing_time' => ($isClosed || $is24Hours)
                        ? null
                        : ($data['closing_time'] ?? null),

                    'opening_time_2' => ($isClosed || $is24Hours)
                        ? null
                        : ($data['opening_time_2'] ?? null),

                    'closing_time_2' => ($isClosed || $is24Hours)
                        ? null
                        : ($data['closing_time_2'] ?? null),
                ]);
            }

/*
|--------------------------------------------------------------------------
| Save Business Services
|--------------------------------------------------------------------------
*/

foreach ($businessServices as $index => $serviceData) {

    if (empty($serviceData['name'])) {
        continue;
    }

    $serviceName = trim($serviceData['name']);

    $serviceSlug = Str::slug($serviceName);

    if (empty($serviceSlug)) {
        $serviceSlug = 'service-' . ($index + 1);
    }

    $originalSlug = $serviceSlug;

    $counter = 2;

    while (
        BusinessService::where('business_id', $business->id)
            ->where('slug', $serviceSlug)
            ->exists()
    ) {
        $serviceSlug = $originalSlug . '-' . $counter;
        $counter++;
    }

    BusinessService::create([
        'business_id' => $business->id,

        'name' => $serviceName,

        'slug' => $serviceSlug,

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
            $serviceData['sort_order'] ?? ($index + 1),
    ]);
}
            /*
            |--------------------------------------------------------------------------
            | Save Gallery Photos
            |--------------------------------------------------------------------------
            */

            foreach ($galleryPhotos as $index => $photo) {

                $path = $photo->store(
                    'businesses/' . $business->id . '/gallery',
                    'public'
                );

                BusinessPhoto::create([
                    'business_id' => $business->id,
                    'image' => $path,
                    'caption' => null,
                    'sort_order' => $index + 1,
                    'is_featured' => $index === 0,
                ]);
            }
        });


        return redirect()
            ->route('admin.businesses.index')
            ->with('success', 'Business created successfully.');
    }

    public function show(Business $business): View
    {
        $business->load([
            'user',
            'category',
            'subcategory',
            'country',
            'state',
            'city',
            'area',
            'businessHours',
            'photos',
            'services',
            'reviews.user',
        ]);

        return view('admin.businesses.show', compact('business'));
    }

    public function edit(Business $business): View
    {
        $users = User::where('role', 'user')
            ->orderBy('name')
            ->get();

        $categories = Category::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $subcategories = Subcategory::where('status', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $countries = Country::where('status', true)
            ->orderBy('name')
            ->get();

        $states = State::where('status', true)
            ->orderBy('name')
            ->get();

        $cities = City::where('status', true)
            ->orderBy('name')
            ->get();

        $areas = Area::where('status', true)
            ->orderBy('name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Load Business Hours + Gallery
        |--------------------------------------------------------------------------
        */

        $business->load([
            'businessHours',
            'photos',
            'services',
        ]);

        $businessHours = $business->businessHours
            ->keyBy('day_of_week');


        return view('admin.businesses.edit', compact(
            'business',
            'users',
            'categories',
            'subcategories',
            'countries',
            'states',
            'cities',
            'areas',
            'businessHours'
        ));
    }

    public function update(
        Request $request,
        Business $business
    ): RedirectResponse {

        $oldStatus = $business->status;

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'subcategory_id' => ['nullable', 'exists:subcategories,id'],

            'country_id' => ['nullable', 'exists:countries,id'],
            'state_id' => ['nullable', 'exists:states,id'],
            'city_id' => ['nullable', 'exists:cities,id'],
            'area_id' => ['nullable', 'exists:areas,id'],

            'name' => ['required', 'string', 'max:255'],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                'unique:businesses,slug,' . $business->id,
            ],

            'tagline' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],

            'address' => ['nullable', 'string'],
            'pincode' => ['nullable', 'string', 'max:20'],

            // Images
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

            // Gallery
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

            'delete_photos' => [
                'nullable',
                'array',
            ],

            'delete_photos.*' => [
                'integer',
                'exists:business_photos,id',
            ],

            'featured_photo' => [
                'nullable',
                'integer',
                'exists:business_photos,id',
            ],

            'status' => [
                'required',
                'in:pending,approved,rejected',
            ],

            'admin_notes' => ['nullable', 'string'],

            'is_featured' => ['nullable', 'boolean'],

            'rating' => [
                'nullable',
                'numeric',
                'min:0',
                'max:5',
            ],

            'reviews_count' => [
                'nullable',
                'integer',
                'min:0',
            ],

            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],

            // Business Hours
            'business_hours' => ['nullable', 'array'],

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


        $validated['slug'] = $validated['slug']
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $validated['is_featured'] = $request->boolean('is_featured');

        $validated['rating'] = $validated['rating'] ?? 0;

        $validated['reviews_count'] = $validated['reviews_count'] ?? 0;


        /*
        |--------------------------------------------------------------------------
        | Update Logo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('logo')) {

            if ($business->logo) {
                Storage::disk('public')->delete($business->logo);
            }

            $validated['logo'] = $request
                ->file('logo')
                ->store('businesses/logos', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Update Cover Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('cover_image')) {

            if ($business->cover_image) {
                Storage::disk('public')->delete($business->cover_image);
            }

            $validated['cover_image'] = $request
                ->file('cover_image')
                ->store('businesses/covers', 'public');
        }


     /*
|--------------------------------------------------------------------------
| Gallery + Business Hours Data
|--------------------------------------------------------------------------
*/

$galleryPhotos = $request->file('photos', []);

$deletePhotos = $validated['delete_photos'] ?? [];

$featuredPhoto = $validated['featured_photo'] ?? null;

$businessHours = $validated['business_hours'] ?? [];
$businessServices = $validated['services'] ?? [];

$deleteServices = $validated['delete_services'] ?? [];

/*
|--------------------------------------------------------------------------
| Remove Non-Business Fields
|--------------------------------------------------------------------------
*/

unset($validated['business_hours']);

unset($validated['photos']);

unset($validated['delete_photos']);

unset($validated['featured_photo']);
unset($validated['services']);

unset($validated['delete_services']);
        /*
        |--------------------------------------------------------------------------
        | Update Business + Hours + Gallery
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $business,
            $validated,
            $businessHours,
            $galleryPhotos,
            $deletePhotos,
            $featuredPhoto,
            $businessServices,
            $deleteServices
        ) {

            $business->update($validated);


            /*
            |--------------------------------------------------------------------------
            | Update Business Hours
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

                $data = $businessHours[$day] ?? [];

                $isClosed = isset($data['is_closed'])
                    && (bool) $data['is_closed'];

                $is24Hours = isset($data['is_24_hours'])
                    && (bool) $data['is_24_hours'];


                BusinessHour::updateOrCreate(
                    [
                        'business_id' => $business->id,
                        'day_of_week' => $day,
                    ],
                    [
                        'is_closed' => $isClosed,

                        'is_24_hours' => $is24Hours,

                        'opening_time' => ($isClosed || $is24Hours)
                            ? null
                            : ($data['opening_time'] ?? null),

                        'closing_time' => ($isClosed || $is24Hours)
                            ? null
                            : ($data['closing_time'] ?? null),

                        'opening_time_2' => ($isClosed || $is24Hours)
                            ? null
                            : ($data['opening_time_2'] ?? null),

                        'closing_time_2' => ($isClosed || $is24Hours)
                            ? null
                            : ($data['closing_time_2'] ?? null),
                    ]
                );
            }

/*
|--------------------------------------------------------------------------
| Delete Selected Business Services
|--------------------------------------------------------------------------
*/

if (!empty($deleteServices)) {

    BusinessService::where('business_id', $business->id)
        ->whereIn('id', $deleteServices)
        ->delete();
}


/*
|--------------------------------------------------------------------------
| Update + Create Business Services
|--------------------------------------------------------------------------
*/

foreach ($businessServices as $index => $serviceData) {

    if (empty($serviceData['name'])) {
        continue;
    }

    $serviceName = trim($serviceData['name']);

    $serviceSlug = Str::slug($serviceName);

    if (empty($serviceSlug)) {
        $serviceSlug = 'service-' . ($index + 1);
    }


    /*
    |--------------------------------------------------------------------------
    | Existing Service
    |--------------------------------------------------------------------------
    */

    if (!empty($serviceData['id'])) {

        $service = BusinessService::where(
            'business_id',
            $business->id
        )
            ->where('id', $serviceData['id'])
            ->first();

        /*
        | Existing service mil gayi
        */

        if ($service) {

            $originalSlug = $serviceSlug;

            $counter = 2;


            /*
            | Same business me duplicate slug avoid karein
            */

            while (
                BusinessService::where(
                    'business_id',
                    $business->id
                )
                    ->where('slug', $serviceSlug)
                    ->where('id', '!=', $service->id)
                    ->exists()
            ) {

                $serviceSlug =
                    $originalSlug . '-' . $counter;

                $counter++;
            }


            $service->update([

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
                        : false,

                'sort_order' =>
                    $serviceData['sort_order']
                        ?? ($index + 1),
            ]);
        }

    }

    /*
    |--------------------------------------------------------------------------
    | New Service
    |--------------------------------------------------------------------------
    */

    else {

        $originalSlug = $serviceSlug;

        $counter = 2;


        while (
            BusinessService::where(
                'business_id',
                $business->id
            )
                ->where('slug', $serviceSlug)
                ->exists()
        ) {

            $serviceSlug =
                $originalSlug . '-' . $counter;

            $counter++;
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
}
            /*
            |--------------------------------------------------------------------------
            | Delete Selected Gallery Photos
            |--------------------------------------------------------------------------
            */

            if (!empty($deletePhotos)) {

                $photosToDelete = BusinessPhoto::where(
                    'business_id',
                    $business->id
                )
                    ->whereIn('id', $deletePhotos)
                    ->get();

                foreach ($photosToDelete as $photo) {

                    if (
                        $photo->image &&
                        Storage::disk('public')->exists($photo->image)
                    ) {
                        Storage::disk('public')->delete($photo->image);
                    }

                    $photo->delete();
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Upload New Gallery Photos
            |--------------------------------------------------------------------------
            */

            if (!empty($galleryPhotos)) {

                $lastOrder = $business->photos()->max('sort_order') ?? 0;

                foreach ($galleryPhotos as $photo) {

                    $lastOrder++;

                    $path = $photo->store(
                        'businesses/' . $business->id . '/gallery',
                        'public'
                    );

                    BusinessPhoto::create([
                        'business_id' => $business->id,
                        'image' => $path,
                        'caption' => null,
                        'sort_order' => $lastOrder,
                        'is_featured' => false,
                    ]);
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Featured Gallery Photo
            |--------------------------------------------------------------------------
            */

            if ($featuredPhoto) {

                $photoExists = BusinessPhoto::where(
                    'business_id',
                    $business->id
                )
                    ->where('id', $featuredPhoto)
                    ->exists();

                if ($photoExists) {

                    $business->photos()->update([
                        'is_featured' => false,
                    ]);

                    BusinessPhoto::where(
                        'business_id',
                        $business->id
                    )
                        ->where('id', $featuredPhoto)
                        ->update([
                            'is_featured' => true,
                        ]);
                }
            }
        });

        /*
        |--------------------------------------------------------------------------
        | Notify Business Owner on Status Change
        |--------------------------------------------------------------------------
        */

        if (
            $oldStatus !== $business->status &&
            in_array($business->status, ['approved', 'rejected'])
        ) {

            if ($business->status === 'approved') {

                Notification::create([
                    'user_id' => $business->user_id,
                    'title' => 'Business Approved',
                    'message' => 'Your business "' . $business->name . '" has been approved and is now live.',
                    'type' => 'business',
                    'action_url' => route('user.businesses.show', $business),
                    'is_read' => false,
                    'read_at' => null,
                ]);

            } elseif ($business->status === 'rejected') {

                Notification::create([
                    'user_id' => $business->user_id,
                    'title' => 'Business Rejected',
                    'message' => 'Your business "' . $business->name . '" has been rejected. Please check the business details for more information.',
                    'type' => 'business',
                    'action_url' => route('user.businesses.show', $business),
                    'is_read' => false,
                    'read_at' => null,
                ]);
            }
        }
        return redirect()
            ->route('admin.businesses.edit', $business)
            ->with('success', 'Business updated successfully.');
    }

    public function destroy(Business $business): RedirectResponse
    {
        /*
        |--------------------------------------------------------------------------
        | Delete Business Images
        |--------------------------------------------------------------------------
        */

        if ($business->logo) {
            Storage::disk('public')->delete($business->logo);
        }

        if ($business->cover_image) {
            Storage::disk('public')->delete($business->cover_image);
        }


        /*
        |--------------------------------------------------------------------------
        | Delete Gallery Images
        |--------------------------------------------------------------------------
        */

        $business->load('photos');

        foreach ($business->photos as $photo) {

            if (
                $photo->image &&
                Storage::disk('public')->exists($photo->image)
            ) {
                Storage::disk('public')->delete($photo->image);
            }
        }


        $business->delete();

        return redirect()
            ->route('admin.businesses.index')
            ->with('success', 'Business deleted successfully.');
    }

    public function approve(Business $business): RedirectResponse
{
    $oldStatus = $business->status;

    $business->update([
        'status' => 'approved',
        'admin_notes' => null,
    ]);

    if ($oldStatus !== 'approved') {
        Notification::create([
            'user_id' => $business->user_id,
            'title' => 'Business Approved',
            'message' => 'Your business "' . $business->name . '" has been approved and is now live.',
            'type' => 'business',
            'action_url' => route('user.businesses.show', $business),
            'is_read' => false,
            'read_at' => null,
        ]);
    }

    return redirect()
        ->route('admin.businesses.show', $business)
        ->with('success', 'Business approved successfully.');
}


public function reject(Request $request, Business $business): RedirectResponse
{
    $validated = $request->validate([
        'admin_notes' => ['required', 'string', 'max:5000'],
    ]);

    $business->update([
        'status' => 'rejected',
        'admin_notes' => $validated['admin_notes'],
    ]);

    Notification::create([
        'user_id' => $business->user_id,
        'title' => 'Business Rejected',
        'message' => 'Your business "' . $business->name . '" has been rejected. Please check the business details for more information.',
        'type' => 'business',
        'action_url' => route('user.businesses.show', $business),
        'is_read' => false,
        'read_at' => null,
    ]);

    return redirect()
        ->route('admin.businesses.show', $business)
        ->with('success', 'Business rejected successfully.');
}
}
