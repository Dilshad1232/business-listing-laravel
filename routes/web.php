<?php

use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\BusinessHourController;
use App\Http\Controllers\BusinessHourController as PublicBusinessHourController;
use App\Http\Controllers\Admin\BusinessReviewController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnquiryController;

use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\SubcategoryController as AdminSubcategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\BusinessController as PublicBusinessController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\User\UserBusinessController;
use App\Http\Controllers\User\UserDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductEnquiryController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\Admin\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\ReviewReportController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;

use App\Http\Controllers\BusinessReviewController as PublicBusinessReviewController;

// =========================
// Public Routes
// =========================

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/about', [HomeController::class, 'about'])
    ->name('about');

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');


    Route::get('/how-it-works', [HomeController::class, 'howItWorks'])->name('how.it.works');

Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy.policy');

Route::get('/terms-conditions', [HomeController::class, 'termsConditions'])->name('terms.conditions');

Route::get('/disclaimer', [HomeController::class, 'disclaimer'])->name('disclaimer');

Route::get('/advertise-with-us', [HomeController::class, 'advertiseWithUs'])->name('advertise.with.us');


//Blog
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');

Route::get('/blog-detail', [HomeController::class, 'blogDetail'])->name('blog.detail');





//product
Route::get(
    '/products/{product:slug}',
    [ProductController::class, 'show']
)->name('products.show');
Route::post(
    '/products/{product:slug}/enquiry',
    [ProductEnquiryController::class, 'store']
)->name('products.enquiry.store');

// =========================
// Categories
// =========================

Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])
    ->name('categories.index');

Route::get('/categories/{category:slug}', [\App\Http\Controllers\CategoryController::class, 'show'])
    ->name('categories.show');

// =========================
// Subcategories
// =========================

Route::get(
    '/categories/{category:slug}/subcategories',
    [SubcategoryController::class, 'index']
)->name('subcategories.index');

Route::get(
    '/categories/{category:slug}/subcategories/{subcategory:slug}',
    [SubcategoryController::class, 'show']
)->name('subcategories.show');


//listing
Route::get('/listings', [ListingController::class, 'index'])
    ->name('listings.index');

Route::get('/listings/list', [ListingController::class, 'list'])
    ->name('listings.list');

Route::get('/listings/map', [ListingController::class, 'map'])
    ->name('listings.map');

// Route::get('/listings/{listing:slug}/show', [ListingController::class, 'show'])
//     ->name('listings.show');

Route::get('/listings/{listing:slug}', [ListingController::class, 'details'])
    ->name('listings.details');



    Route::get('/businesses/suggestions', [PublicBusinessController::class, 'suggestions'])
    ->name('businesses.suggestions');
//business
Route::get('/businesses', [PublicBusinessController::class, 'index'])
    ->name('businesses.index');

Route::get('/businesses/{business:slug}', [PublicBusinessController::class, 'show'])
    ->name('businesses.show');

    // =========================
// Business Booking
// =========================

Route::get(
    '/businesses/{business:slug}/book',
    [BookingController::class, 'create']
)->name('bookings.create');

Route::post(
    '/businesses/{business:slug}/book',
    [BookingController::class, 'store']
)->name('bookings.store');

// Public Business Review
Route::post(
    '/businesses/{business:slug}/reviews',
    [PublicBusinessReviewController::class, 'store']
)->name('businesses.reviews.store');
//Review reort
Route::post(
    '/reviews/{review}/report',
    [ReviewReportController::class, 'store']
)->name('reviews.report');



// ==================== AUTHENTICATION ====================

// Login page
Route::get('/login', function () {

    if (auth()->check()) {

        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    return app(\App\Http\Controllers\Auth\LoginController::class)
        ->showLogin();

})->name('login');

// Guest authentication routes
Route::middleware('guest')->group(function () {

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.submit');

    Route::get('/register', [RegisterController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register.submit');
});

// Logout — Admin + User दोनों के लिए
Route::middleware('auth')->group(function () {

    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');
});
//services show
Route::get('services/{service:slug}', [\App\Http\Controllers\BusinessController::class, 'serviceShow'])
    ->name('businesses.services.show');
// User Dashboard — सिर्फ normal user के लिए
Route::middleware(['auth', 'user'])->group(function () {

    Route::get('/user-dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');

    // User Businesses
    Route::get('/user-businesses', [UserBusinessController::class, 'index'])
        ->name('user.businesses.index');

    Route::get('/user-businesses/create', [UserBusinessController::class, 'create'])
        ->name('user.businesses.create');

    Route::post('/user-businesses', [UserBusinessController::class, 'store'])
        ->name('user.businesses.store');

        //notification

        Route::get('/user-dashboard/notifications', [NotificationController::class, 'index'])
        ->name('user.notifications.index');

    Route::post('/user-dashboard/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('user.notifications.read');

    Route::post('/user-dashboard/notifications/read-all', [NotificationController::class, 'markAllAsRead'])
        ->name('user.notifications.read-all');


        //Profile
        Route::get('/profile', [ProfileController::class, 'index'])
        ->name('user.profile');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('user.profile.update');


        Route::get('/user-businesses/subcategories/{category}', [UserBusinessController::class, 'subcategories'])
    ->name('user.businesses.subcategories');

Route::get('/user-businesses/states/{country}', [UserBusinessController::class, 'states'])
    ->name('user.businesses.states');

Route::get('/user-businesses/cities/{state}', [UserBusinessController::class, 'cities'])
    ->name('user.businesses.cities');

Route::get('/user-businesses/areas/{city}', [UserBusinessController::class, 'areas'])
    ->name('user.businesses.areas');


    Route::get('/user-businesses/{business}/edit', [UserBusinessController::class, 'edit'])
    ->name('user.businesses.edit');

Route::put('/user-businesses/{business}', [UserBusinessController::class, 'update'])
    ->name('user.businesses.update');

    Route::delete('/user-businesses/{business}', [UserBusinessController::class, 'destroy'])
    ->name('user.businesses.destroy');

    Route::get('/user-businesses/{business}', [UserBusinessController::class, 'show'])
    ->name('user.businesses.show');
});
// ==================== ADMIN ====================
// =========================
// Admin Routes
// =========================

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Categories
        Route::resource(
            'categories',
            CategoryController::class
        );

        // Subcategories
        Route::resource(
            'subcategories',
            AdminSubcategoryController::class
        );


        Route::resource('countries', CountryController::class);

        Route::resource('states', StateController::class);

        Route::resource('cities', CityController::class);
        Route::resource('areas', AreaController::class);

        Route::post('businesses/{business}/approve', [BusinessController::class, 'approve'])
        ->name('businesses.approve');

    Route::post('businesses/{business}/reject', [BusinessController::class, 'reject'])
        ->name('businesses.reject');

    Route::resource('businesses', BusinessController::class);


        Route::resource('reviews', BusinessReviewController::class)
        ->names('reviews')
        ->parameters([
            'reviews' => 'review',
        ]);

        Route::post(
            'reviews/{review}/approve',
            [BusinessReviewController::class, 'approve']
        )->name('reviews.approve');

        Route::post(
            'reviews/{review}/reject',
            [BusinessReviewController::class, 'reject']
        )->name('reviews.reject');

        Route::resource('products', AdminProductController::class);

        Route::post(
            'products/{product}/images/{image}/primary',
            [ProductController::class, 'setPrimaryImage']
        )->name('products.images.primary');

        Route::delete(
            'products/{product}/images/{image}',
            [ProductController::class, 'destroyImage']
        )->name('products.images.destroy');

// Enquiries
        Route::get(
            'enquiries',
            [EnquiryController::class, 'index']
        )->name('enquiries.index');

        Route::get(
            'enquiries/{enquiry}',
            [EnquiryController::class, 'show']
        )->name('enquiries.show');

        Route::put(
            'enquiries/{enquiry}',
            [EnquiryController::class, 'update']
        )->name('enquiries.update');

        Route::delete(
            'enquiries/{enquiry}',
            [EnquiryController::class, 'destroy']
        )->name('enquiries.destroy');

        Route::resource('offers', OfferController::class);

        Route::resource('bookings', AdminBookingController::class);



// Notifications
Route::get(
    'notifications',
    [AdminNotificationController::class, 'index']
)->name('notifications.index');

Route::post(
    'notifications/{id}/read',
    [AdminNotificationController::class, 'markAsRead']
)->name('notifications.read');

Route::post(
    'notifications/read-all',
    [AdminNotificationController::class, 'markAllAsRead']
)->name('notifications.read-all');



Route::get('/settings', [WebsiteSettingController::class, 'edit'])
    ->name('settings.edit');

Route::put('/settings', [WebsiteSettingController::class, 'update'])
    ->name('settings.update');


    // =========================
// Admin Profile
// =========================

Route::get('/profile', [AdminProfileController::class, 'index'])
->name('profile.index');

Route::put('/profile', [AdminProfileController::class, 'update'])
->name('profile.update');

Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])
->name('profile.password.update');

Route::resource('home-sliders', HomeSliderController::class);

});
// =========================
// Clean Business + Category URL
// =========================

Route::get('/{slug}', [PublicBusinessController::class, 'resolveSlug'])
    ->name('businesses.clean');
