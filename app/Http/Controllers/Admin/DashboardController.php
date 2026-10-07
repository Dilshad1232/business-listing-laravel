<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessReview;
use App\Models\City;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Dashboard Statistics
        |--------------------------------------------------------------------------
        */

        $totalBusinesses = Business::count();

        $currentMonthBusinesses = Business::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $previousMonthBusinesses = Business::whereMonth(
            'created_at',
            now()->subMonth()->month
        )
            ->whereYear(
                'created_at',
                now()->subMonth()->year
            )
            ->count();

        $totalBusinessesChange = $previousMonthBusinesses > 0
            ? round((($currentMonthBusinesses - $previousMonthBusinesses) / $previousMonthBusinesses) * 100, 1)
            : ($currentMonthBusinesses > 0 ? 100 : 0);

        $totalBusinessesChangeType = $totalBusinessesChange >= 0
            ? 'up'
            : 'down';

        $activeBusinesses = Business::where('status', 'approved')
            ->count();
            $currentMonthActiveBusinesses = Business::where('status', 'approved')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $previousMonthActiveBusinesses = Business::where('status', 'approved')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $activeBusinessesChange = $previousMonthActiveBusinesses > 0
            ? round((($currentMonthActiveBusinesses - $previousMonthActiveBusinesses) / $previousMonthActiveBusinesses) * 100, 1)
            : ($currentMonthActiveBusinesses > 0 ? 100 : 0);

        $activeBusinessesChangeType = $activeBusinessesChange >= 0
            ? 'up'
            : 'down';
        $pendingBusinesses = Business::where('status', 'pending')
            ->count();
            $currentMonthPendingBusinesses = Business::where('status', 'pending')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $previousMonthPendingBusinesses = Business::where('status', 'pending')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year)
            ->count();

        $pendingBusinessesChange = $previousMonthPendingBusinesses > 0
            ? round((($currentMonthPendingBusinesses - $previousMonthPendingBusinesses) / $previousMonthPendingBusinesses) * 100, 1)
            : ($currentMonthPendingBusinesses > 0 ? 100 : 0);

        $pendingBusinessesChangeType = $pendingBusinessesChange >= 0
            ? 'up'
            : 'down';
        $totalUsers = User::where('role', 'user')
            ->count();
            $currentMonthUsers = User::where('role', 'user')
    ->whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->count();

$previousMonthUsers = User::where('role', 'user')
    ->whereMonth('created_at', now()->subMonth()->month)
    ->whereYear('created_at', now()->subMonth()->year)
    ->count();

$totalUsersChange = $previousMonthUsers > 0
    ? round((($currentMonthUsers - $previousMonthUsers) / $previousMonthUsers) * 100, 1)
    : ($currentMonthUsers > 0 ? 100 : 0);

$totalUsersChangeType = $totalUsersChange >= 0
    ? 'up'
    : 'down';


            /*
        |--------------------------------------------------------------------------
        | Listing Growth Chart Data
        |--------------------------------------------------------------------------
        */

        $listingGrowth = [];

        // Last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);

            $listingGrowth['yearly']['labels'][] = $date->format('M Y');

            $listingGrowth['yearly']['data'][] = Business::whereYear(
                'created_at',
                $date->year
            )
                ->whereMonth(
                    'created_at',
                    $date->month
                )
                ->count();
        }

        // Last 30 days
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);

            $listingGrowth['daily']['labels'][] = $date->format('d M');

            $listingGrowth['daily']['data'][] = Business::whereDate(
                'created_at',
                $date->toDateString()
            )->count();
        }

        // Last 7 months
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subMonths($i);

            $listingGrowth['monthly']['labels'][] = $date->format('M');

            $listingGrowth['monthly']['data'][] = Business::whereYear(
                'created_at',
                $date->year
            )
                ->whereMonth(
                    'created_at',
                    $date->month
                )
                ->count();
        }
        /*
        |--------------------------------------------------------------------------
        | Recent Businesses
        |--------------------------------------------------------------------------
        */

        $recentBusinesses = Business::with([
            'category',
            'city',
        ])
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recent Reviews
        |--------------------------------------------------------------------------
        */

        $recentReviews = BusinessReview::with([
            'business',
            'user',
        ])
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Top Locations
        |--------------------------------------------------------------------------
        */

        $topLocations = City::withCount([
            'businesses as businesses_count',
        ])
            ->orderByDesc('businesses_count')
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Recent Notifications
        |--------------------------------------------------------------------------
        */

        $recentNotifications = auth()->user()
            ->notifications()
            ->latest()
            ->take(5)
            ->get();

        $unreadNotifications = auth()->user()
            ->notifications()
            ->where('is_read', false)
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', compact(
            'totalBusinesses',
            'activeBusinesses',
            'pendingBusinesses',
            'totalUsers',
            'recentBusinesses',
            'totalBusinessesChange',
            'totalBusinessesChangeType',
            'recentReviews',
            'topLocations',
            'recentNotifications',
            'unreadNotifications',
            'activeBusinessesChange',
'activeBusinessesChangeType',
'pendingBusinessesChange',
'pendingBusinessesChangeType',
'totalUsersChange',
'totalUsersChangeType',
'listingGrowth',
        ));
    }
}
