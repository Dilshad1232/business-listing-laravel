<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessReview;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Business Statistics
        |--------------------------------------------------------------------------
        */

        $myBusinesses = Business::where('user_id', $user->id)
            ->count();

        $approvedBusinesses = Business::where('user_id', $user->id)
            ->where('status', 'approved')
            ->count();

        $pendingBusinesses = Business::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        $rejectedBusinesses = Business::where('user_id', $user->id)
            ->where('status', 'rejected')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Recent Businesses
        |--------------------------------------------------------------------------
        */

        $recentBusinesses = Business::with([
            'category',
            'city',
        ])
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | My Reviews
        |--------------------------------------------------------------------------
        */

        $myReviews = BusinessReview::with([
            'business',
        ])
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $myReviewsCount = BusinessReview::where('user_id', $user->id)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Notifications
        |--------------------------------------------------------------------------
        */

        $recentNotifications = $user->notifications()
            ->latest()
            ->take(5)
            ->get();

        $unreadNotifications = $user->notifications()
            ->where('is_read', false)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        return view('userdashboard.index', [
            'pageTitle' => 'Dashboard',
            'pageSubtitle' => 'Manage your business presence',

            'myBusinesses' => $myBusinesses,
            'approvedBusinesses' => $approvedBusinesses,
            'pendingBusinesses' => $pendingBusinesses,
            'rejectedBusinesses' => $rejectedBusinesses,

            'recentBusinesses' => $recentBusinesses,

            'myReviews' => $myReviews,
            'myReviewsCount' => $myReviewsCount,

            'recentNotifications' => $recentNotifications,
            'unreadNotifications' => $unreadNotifications,
        ]);
    }
}
