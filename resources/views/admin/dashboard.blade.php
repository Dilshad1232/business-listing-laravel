@extends('admin.layouts.master')

@section('title', 'Dashboard')

@section('content')
<script>
    const listingGrowth = @json($listingGrowth);
</script>
<!-- =========================
     MAIN
========================= -->



 <!-- TOPBAR -->

{{-- <header class="bd-topbar">

    <!-- LEFT -->
    <div class="d-flex align-items-center gap-3">

        <!-- Mobile Menu -->
        <button
            type="button"
            class="bd-icon-btn bd-mobile-menu"
            id="bdMobileMenu"
            title="Menu"
        >
            <i class="bi bi-list"></i>
        </button>


        <!-- Search -->
        <div class="bd-search">

            <i class="bi bi-search"></i>

            <input
                type="text"
                placeholder="Search businesses, users..."
            >

        </div>

    </div>


    <!-- RIGHT -->
    <div class="bd-top-actions d-flex align-items-center gap-2">

        <!-- Theme -->
        <button
            type="button"
            class="bd-icon-btn"
            id="bdThemeToggle"
            title="Toggle theme"
        >
            <i class="bi bi-moon-stars" id="bdThemeIcon"></i>
        </button>


        <!-- Notifications -->
        <div class="dropdown">

            <button
                type="button"
                class="bd-icon-btn position-relative"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                title="Notifications"
            >

                <i class="bi bi-bell"></i>

                <span class="bd-notification-dot"></span>

            </button>


            <div class="dropdown-menu dropdown-menu-end shadow border-0 p-0">

                <div class="p-3 border-bottom">

                    <div class="d-flex justify-content-between align-items-center">

                        <strong>
                            Notifications
                        </strong>

                        <span class="badge bg-primary">
                            3
                        </span>

                    </div>

                    <small class="text-muted">
                        Latest activity
                    </small>

                </div>


                <div style="width: 320px;">

                    <a
                        href="#"
                        class="dropdown-item py-3"
                    >

                        <div class="d-flex gap-3">

                            <i class="bi bi-buildings text-primary fs-5"></i>

                            <div>

                                <strong class="d-block">
                                    New business submitted
                                </strong>

                                <small class="text-muted">
                                    A business is waiting for approval.
                                </small>

                            </div>

                        </div>

                    </a>


                    <a
                        href="#"
                        class="dropdown-item py-3"
                    >

                        <div class="d-flex gap-3">

                            <i class="bi bi-person-plus text-success fs-5"></i>

                            <div>

                                <strong class="d-block">
                                    New user registered
                                </strong>

                                <small class="text-muted">
                                    A new user joined the platform.
                                </small>

                            </div>

                        </div>

                    </a>


                    <a
                        href="#"
                        class="dropdown-item py-3"
                    >

                        <div class="d-flex gap-3">

                            <i class="bi bi-star text-warning fs-5"></i>

                            <div>

                                <strong class="d-block">
                                    New review received
                                </strong>

                                <small class="text-muted">
                                    A business received a new review.
                                </small>

                            </div>

                        </div>

                    </a>

                </div>


                <div class="p-2 border-top text-center">

                    <a
                        href="#"
                        class="small text-decoration-none"
                    >
                        View all notifications
                    </a>

                </div>

            </div>

        </div>


        <!-- Profile -->
        <div class="dropdown">

            <button
                type="button"
                class="bd-icon-btn"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                title="Admin Profile"
            >
            @if(auth()->user()->profile_photo)
            <img
                src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                alt="{{ auth()->user()->name }}"
                class="bd-avatar"
                style="object-fit: cover;"
            >
        @else
            <div class="bd-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>
        @endif
            </button>


            <div class="dropdown-menu dropdown-menu-end shadow border-0">

                <!-- Admin Info -->

                <div class="px-3 py-3 border-bottom">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                            style="width:45px;height:45px;"
                        >

                        @if(auth()->user()->profile_photo)
                        <img
                            src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                            alt="{{ auth()->user()->name }}"
                            class="bd-avatar"
                            style="object-fit: cover;"
                        >
                    @else
                        <div class="bd-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                    @endif

                        </div>


                        <div>

                            <strong class="d-block">

                                {{ auth()->user()->name ?? 'Administrator' }}

                            </strong>

                            <small class="text-muted">

                                {{ auth()->user()->email ?? '' }}

                            </small>

                        </div>

                    </div>

                </div>


                <!-- Profile -->

                <a
                    href="{{ route('admin.profile.index') }}"
                    class="dropdown-item py-2"
                >

                    <i class="bi bi-person me-2"></i>

                    My Profile

                </a>


                <!-- Settings -->

                <a
                    href="{{ route('admin.settings.edit') }}"
                    class="dropdown-item py-2"
                >

                    <i class="bi bi-gear me-2"></i>

                    Settings

                </a>


                <div class="dropdown-divider"></div>


                <!-- Logout -->

                <form
                    method="POST"
                    action="{{ route('logout') }}"
                >

                    @csrf

                    <button
                        type="submit"
                        class="dropdown-item text-danger py-2"
                    >

                        <i class="bi bi-box-arrow-right me-2"></i>

                        Logout

                    </button>

                </form>

            </div>

        </div>

    </div>

</header> --}}


    <!-- PAGE -->

    <section class="bd-page">


        <!-- PAGE HEADER -->

        <div class="bd-page-heading">

            <div>

                <h1 class="bd-page-title">
                    Dashboard
                </h1>

                <div class="bd-page-subtitle">
                    Here's what's happening with your directory today.
                </div>

            </div>


            <a href="#" class="bd-add-btn">

                <i class="bi bi-plus-lg"></i>

                Add Business

            </a>

        </div>


        <!-- =========================
             STATISTICS
        ========================= -->

        <div class="row g-4 mb-4">


            <!-- Total Businesses -->

            <div class="col-xl-3 col-md-6">

                <div class="bd-stat-card">

                    <div class="bd-stat-top">

                        <div class="bd-stat-icon bd-icon-purple">
                            <i class="bi bi-buildings"></i>
                        </div>

                        <i class="bi bi-three-dots text-muted"></i>

                    </div>

                    <div class="bd-stat-label">
                        Total Businesses
                    </div>

                    <div class="bd-stat-value">
                        {{ number_format($totalBusinesses) }}
                    </div>

                    <div class="bd-stat-footer">

                        <span class="{{ $totalBusinessesChangeType === 'up' ? 'bd-up' : 'text-danger' }}">
                            <i class="bi bi-arrow-{{ $totalBusinessesChangeType }}"></i>
                            {{ abs($totalBusinessesChange) }}%
                        </span>

                        <span class="bd-muted">
                            from last month
                        </span>

                    </div>

                </div>

            </div>


            <!-- Active -->

            <div class="col-xl-3 col-md-6">

                <div class="bd-stat-card">

                    <div class="bd-stat-top">

                        <div class="bd-stat-icon bd-icon-green">
                            <i class="bi bi-check-circle"></i>
                        </div>

                        <i class="bi bi-three-dots text-muted"></i>

                    </div>

                    <div class="bd-stat-label">
                        Active Listings
                    </div>

                    <div class="bd-stat-value">
                        {{ number_format($activeBusinesses) }}
                    </div>

                    <div class="bd-stat-footer">

                        <span class="{{ $activeBusinessesChangeType === 'up' ? 'bd-up' : 'text-danger' }}">
                            <i class="bi bi-arrow-{{ $activeBusinessesChangeType }}"></i>
                            {{ abs($activeBusinessesChange) }}%
                        </span>

                        <span class="bd-muted">
                            from last month
                        </span>

                    </div>

                </div>

            </div>


            <!-- Pending -->

            <div class="col-xl-3 col-md-6">

                <div class="bd-stat-card">

                    <div class="bd-stat-top">

                        <div class="bd-stat-icon bd-icon-orange">
                            <i class="bi bi-hourglass-split"></i>
                        </div>

                        <i class="bi bi-three-dots text-muted"></i>

                    </div>

                    <div class="bd-stat-label">
                        Pending Approval
                    </div>

                    <div class="bd-stat-value">
                        {{ number_format($pendingBusinesses) }}
                    </div>

                    <div class="bd-stat-footer">

                        <span class="{{ $pendingBusinessesChangeType === 'up' ? 'bd-up' : 'text-danger' }}">
                            <i class="bi bi-arrow-{{ $pendingBusinessesChangeType }}"></i>
                            {{ abs($pendingBusinessesChange) }}%
                        </span>

                        <span class="bd-muted">
                            from last month
                        </span>

                    </div>

                </div>

            </div>


            <!-- Users -->

            <div class="col-xl-3 col-md-6">

                <div class="bd-stat-card">

                    <div class="bd-stat-top">

                        <div class="bd-stat-icon bd-icon-blue">
                            <i class="bi bi-people"></i>
                        </div>

                        <i class="bi bi-three-dots text-muted"></i>

                    </div>

                    <div class="bd-stat-label">
                        Total Users
                    </div>

                    <div class="bd-stat-value">
                        {{ number_format($totalUsers) }}
                    </div>

                    <div class="bd-stat-footer">

                        <span class="{{ $totalUsersChangeType === 'up' ? 'bd-up' : 'text-danger' }}">
                            <i class="bi bi-arrow-{{ $totalUsersChangeType }}"></i>
                            {{ abs($totalUsersChange) }}%
                        </span>

                        <span class="bd-muted">
                            from last month
                        </span>

                    </div>

                </div>

            </div>

        </div>


        <!-- =========================
             CHART + LOCATIONS
        ========================= -->

        <div class="row g-4 mb-4">


            <!-- Chart -->

            <div class="col-xl-8">

                <div class="bd-content-card">

                    <div class="bd-card-header">

                        <div>

                            <h5 class="bd-card-title">
                                Listing Growth
                            </h5>

                            <small class="bd-muted">
                                Business listings over the last 7 months
                            </small>

                        </div>

                        <select
                        class="form-select form-select-sm"
                        id="bdListingPeriod"
                        style="width:100px;"
                    >
                        <option value="monthly">7 Months</option>
                        <option value="daily">30 Days</option>
                        <option value="yearly">1 Year</option>
                    </select>

                    </div>

                    <div class="bd-card-body">

                        <canvas id="bdListingChart" height="115"></canvas>

                    </div>

                </div>

            </div>


            <!-- Locations -->

            <div class="col-xl-4">

                <div class="bd-content-card">

                    <div class="bd-card-header">

                        <h5 class="bd-card-title">
                            Top Locations
                        </h5>

                        <a href="#" class="bd-view-all">
                            View All
                        </a>

                    </div>

                    <div class="bd-card-body">

                        @forelse($topLocations as $location)

                            <div class="bd-location">

                                <div>
                                    <div class="bd-location-name">
                                        {{ $location->name }}
                                    </div>

                                    <div class="bd-location-count">
                                        {{ number_format($location->businesses_count) }} businesses
                                    </div>
                                </div>

                                <div class="bd-progress">

                                    <div
                                        class="bd-progress-bar"
                                        style="width: {{ $topLocations->max('businesses_count') > 0
                                            ? round(($location->businesses_count / $topLocations->max('businesses_count')) * 100)
                                            : 0 }}%"
                                    ></div>

                                </div>

                            </div>

                        @empty

                            <div class="text-center py-4">

                                <i class="bi bi-geo-alt fs-2 text-muted"></i>

                                <p class="text-muted mb-0 mt-2">
                                    No location data available.
                                </p>

                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>


        <!-- =========================
             BUSINESSES + REVIEWS
        ========================= -->

        <div class="row g-4">


            <!-- Recent Businesses -->

            <div class="col-xl-8">

                <div class="bd-content-card">

                    <div class="bd-card-header">

                        <h5 class="bd-card-title">
                            Recent Businesses
                        </h5>

                        <a
                        href="{{ route('admin.businesses.index') }}"
                        class="bd-view-all"
                    >
                        View All Businesses
                    </a>

                    </div>

                    <div class="bd-card-body p-0">

                        <div class="table-responsive">

                            <table class="bd-table">

                                <thead>

                                    <tr>

                                        <th>
                                            Business
                                        </th>

                                        <th>
                                            Location
                                        </th>

                                        <th>
                                            Views
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                        <th>
                                            Action
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse($recentBusinesses as $business)

                                        <tr>

                                            <td>

                                                <div class="bd-business">

                                                    <div class="bd-business-img">

                                                        @if($business->logo)
                                                            <img
                                                                src="{{ asset('storage/' . $business->logo) }}"
                                                                alt="{{ $business->name }}"
                                                                style="width:100%;height:100%;object-fit:cover;border-radius:10px;"
                                                            >
                                                        @else
                                                            <i class="bi bi-shop"></i>
                                                        @endif

                                                    </div>

                                                    <div>

                                                        <div class="bd-business-name">
                                                            {{ $business->name }}
                                                        </div>

                                                        <div class="bd-business-cat">
                                                            {{ $business->category->name ?? 'Uncategorized' }}
                                                        </div>

                                                    </div>

                                                </div>

                                            </td>

                                            <td>
                                                {{ $business->city->name ?? '—' }}
                                            </td>

                                            <td>
                                                —
                                            </td>

                                            <td>

                                                @if($business->status === 'approved')

                                                    <span class="bd-status bd-status-active">
                                                        Active
                                                    </span>

                                                @elseif($business->status === 'pending')

                                                    <span class="bd-status bd-status-pending">
                                                        Pending
                                                    </span>

                                                @else

                                                    <span class="bd-status bd-status-rejected">
                                                        Rejected
                                                    </span>

                                                @endif

                                            </td>

                                            <td>

                                                <a
                                                    href="{{ route('admin.businesses.show', $business) }}"
                                                    class="btn btn-sm"
                                                    title="View Business"
                                                >
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="5" class="text-center py-4">

                                                <div class="text-muted">

                                                    <i class="bi bi-buildings fs-3 d-block mb-2"></i>

                                                    No businesses found.

                                                </div>

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Reviews -->

            <div class="col-xl-4">

                <div class="bd-content-card">

                    <div class="bd-card-header">

                        <h5 class="bd-card-title">
                            Recent Reviews
                        </h5>

                        <a
                        href="{{ route('admin.reviews.index') }}"
                        class="bd-view-all"
                    >
                        View All Businesses
                    </a>

                    </div>

                    <div class="bd-card-body">

                        @forelse($recentReviews as $review)

                            <div class="bd-review">

                                <div class="bd-review-avatar">
                                    {{ strtoupper(substr($review->reviewer_name ?? $review->user?->name ?? 'U', 0, 2)) }}
                                </div>

                                <div>

                                    <div class="bd-review-name">
                                        {{ $review->reviewer_name ?? $review->user?->name ?? 'Anonymous' }}
                                    </div>

                                    <div class="bd-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            {{ $i <= $review->rating ? '★' : '☆' }}
                                        @endfor
                                    </div>

                                    <div class="bd-review-text">
                                        {{ \Illuminate\Support\Str::limit($review->comment ?? 'No review comment.', 100) }}
                                    </div>

                                    @if($review->business)
                                        <small class="text-muted">
                                            {{ $review->business->name }}
                                        </small>
                                    @endif

                                </div>

                            </div>

                        @empty

                            <div class="text-center py-4">

                                <i class="bi bi-star fs-3 text-muted"></i>

                                <p class="text-muted mb-0 mt-2">
                                    No reviews found.
                                </p>

                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

        </div>


    </section>





@endsection
