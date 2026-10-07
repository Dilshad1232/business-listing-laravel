@extends('layouts.user.master')

@section('content')

<!-- =================================================
     WELCOME
================================================== -->

<div class="welcome-card">

    <div class="welcome-content">

        <h2>
            Welcome back, {{ auth()->user()->name }} 👋
        </h2>

        <p>
            Manage your businesses, products and services
            from one powerful dashboard.
        </p>

        <a href="{{ route('user.businesses.create') }}" class="welcome-btn">
            <i class="bi bi-plus-lg"></i>
            Add Your Business
        </a>

    </div>

</div>


<!-- =================================================
     STATISTICS
================================================== -->

<div class="row g-4">

    <!-- MY BUSINESSES -->

    <div class="col-xl-3 col-md-6">

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon icon-orange">
                    <i class="bi bi-buildings-fill"></i>
                </div>

                <span class="stat-label">
                    My Businesses
                </span>

            </div>

            <h3 class="stat-number">
                {{ $myBusinesses }}
            </h3>

            <div class="stat-change">
                Total businesses added
            </div>

        </div>

    </div>


    <!-- APPROVED -->

    <div class="col-xl-3 col-md-6">

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon icon-green">
                    <i class="bi bi-check-circle-fill"></i>
                </div>

                <span class="stat-label">
                    Approved
                </span>

            </div>

            <h3 class="stat-number">
                {{ $approvedBusinesses }}
            </h3>

            <div class="stat-change">
                Live businesses
            </div>

        </div>

    </div>


    <!-- PENDING -->

    <div class="col-xl-3 col-md-6">

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon icon-blue">
                    <i class="bi bi-hourglass-split"></i>
                </div>

                <span class="stat-label">
                    Pending
                </span>

            </div>

            <h3 class="stat-number">
                {{ $pendingBusinesses }}
            </h3>

            <div class="stat-change">
                Awaiting approval
            </div>

        </div>

    </div>


    <!-- REJECTED -->

    <div class="col-xl-3 col-md-6">

        <div class="stat-card">

            <div class="stat-top">

                <div class="stat-icon icon-red">
                    <i class="bi bi-x-circle-fill"></i>
                </div>

                <span class="stat-label">
                    Rejected
                </span>

            </div>

            <h3 class="stat-number">
                {{ $rejectedBusinesses }}
            </h3>

            <div class="stat-change">
                Requires attention
            </div>

        </div>

    </div>

</div>


<!-- =================================================
     RECENT BUSINESSES
================================================== -->

<div class="section-header">

    <h4>
        Recent Businesses
    </h4>

    <a href="{{ route('user.businesses.index') }}">
        View All
        <i class="bi bi-arrow-right"></i>
    </a>

</div>


<div class="content-card">

    <div class="table-wrapper">

        <table class="custom-table">

            <thead>

                <tr>

                    <th>
                        Business
                    </th>

                    <th>
                        Category
                    </th>

                    <th>
                        Location
                    </th>

                    <th>
                        Status
                    </th>

                    <th>
                        Date
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($recentBusinesses as $business)

                    <tr>

                        <!-- BUSINESS -->

                        <td>

                            <div class="d-flex align-items-center gap-3">

                                <div
                                    class="rounded"
                                    style="
                                        width:42px;
                                        height:42px;
                                        overflow:hidden;
                                        background:#f3f4f6;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                    "
                                >

                                    @if($business->logo)

                                        <img
                                            src="{{ asset('storage/' . $business->logo) }}"
                                            alt="{{ $business->name }}"
                                            style="
                                                width:100%;
                                                height:100%;
                                                object-fit:cover;
                                            "
                                        >

                                    @else

                                        <i class="bi bi-shop text-muted"></i>

                                    @endif

                                </div>

                                <div>

                                    <strong class="d-block">
                                        {{ $business->name }}
                                    </strong>

                                    @if($business->tagline)

                                        <small class="text-muted">
                                            {{ \Illuminate\Support\Str::limit($business->tagline, 40) }}
                                        </small>

                                    @endif

                                </div>

                            </div>

                        </td>


                        <!-- CATEGORY -->

                        <td>

                            {{ $business->category->name ?? '—' }}

                        </td>


                        <!-- LOCATION -->

                        <td>

                            {{ $business->city->name ?? '—' }}

                        </td>


                   <!-- STATUS -->

<td>

    @if($business->status === 'approved')

        <span class="badge bg-success-subtle text-success">
            Approved
        </span>

    @elseif($business->status === 'pending')

        <span class="badge bg-warning-subtle text-warning-emphasis">
            Pending
        </span>

    @elseif($business->status === 'rejected')

        <span class="badge bg-danger-subtle text-danger">
            Rejected
        </span>

        @if($business->admin_notes)

            <div class="small text-danger mt-1">
                {{ \Illuminate\Support\Str::limit($business->admin_notes, 60) }}
            </div>

        @endif

    @else

        <span class="badge bg-secondary-subtle text-secondary">
            {{ ucfirst($business->status) }}
        </span>

    @endif

</td>

                        <!-- DATE -->

                        <td>

                            {{ $business->created_at->format('d M Y') }}

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5">

                            <div class="empty-state">

                                <i class="bi bi-buildings"></i>

                                <h6>
                                    No businesses yet
                                </h6>

                                <p>
                                    Add your first business to
                                    start building your online presence.
                                </p>

                                <a
                                    href="{{ route('user.businesses.create') }}"
                                    class="welcome-btn"
                                >
                                    <i class="bi bi-plus-lg"></i>
                                    Add Your Business
                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>
<!-- =================================================
     RECENT ACTIVITY
================================================== -->

<div class="row g-4">

    <!-- RECENT REVIEWS -->

    <div class="col-xl-7">

        <div class="section-header">

            <h4>
                Recent Reviews
            </h4>

            <span class="text-muted small">
                {{ $myReviewsCount }} total
            </span>

        </div>


        <div class="content-card">

            @forelse($myReviews as $review)

                <div class="d-flex align-items-start gap-3 p-3 border-bottom">

                    <div
                        class="rounded-circle d-flex align-items-center justify-content-center"
                        style="
                            width:42px;
                            height:42px;
                            background:#fff7ed;
                            flex-shrink:0;
                        "
                    >
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>


                    <div class="flex-grow-1">

                        <div class="d-flex justify-content-between gap-3">

                            <strong>
                                {{ $review->business->name ?? 'Business' }}
                            </strong>

                            <small class="text-muted">
                                {{ $review->created_at->format('d M Y') }}
                            </small>

                        </div>


                        <div class="mt-1">

                            @for($i = 1; $i <= 5; $i++)

                                <i
                                    class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }} text-warning"
                                ></i>

                            @endfor

                        </div>


                        @if($review->title)

                            <div class="mt-1 fw-semibold">
                                {{ $review->title }}
                            </div>

                        @endif


                        @if($review->comment)

                            <p class="text-muted small mb-0 mt-1">
                                {{ \Illuminate\Support\Str::limit($review->comment, 100) }}
                            </p>

                        @endif

                    </div>

                </div>

            @empty

                <div class="empty-state">

                    <i class="bi bi-star"></i>

                    <h6>
                        No reviews yet
                    </h6>

                    <p>
                        Reviews for your businesses will appear here.
                    </p>

                </div>

            @endforelse

        </div>

    </div>


    <!-- NOTIFICATIONS -->

    <div class="col-xl-5">

        <div class="section-header">

            <h4>
                Notifications
            </h4>

            @if($unreadNotifications > 0)

                <span class="badge bg-primary">
                    {{ $unreadNotifications }} unread
                </span>

            @endif

        </div>


        <div class="content-card">

            @forelse($recentNotifications as $notification)

                <div class="d-flex align-items-start gap-3 p-3 border-bottom">

                    <div
                        class="rounded-circle d-flex align-items-center justify-content-center"
                        style="
                            width:42px;
                            height:42px;
                            background:#eff6ff;
                            flex-shrink:0;
                        "
                    >
                        <i class="bi bi-bell text-primary"></i>
                    </div>


                    <div class="flex-grow-1">

                        <div class="d-flex justify-content-between gap-2">

                            <strong>
                                {{ $notification->title }}
                            </strong>

                            @if(!$notification->is_read)

                                <span
                                    class="badge bg-primary-subtle text-primary"
                                >
                                    New
                                </span>

                            @endif

                        </div>


                        <p class="text-muted small mb-1 mt-1">
                            {{ \Illuminate\Support\Str::limit($notification->message, 100) }}
                        </p>


                        <small class="text-muted">
                            {{ $notification->created_at->diffForHumans() }}
                        </small>

                    </div>

                </div>

            @empty

                <div class="empty-state">

                    <i class="bi bi-bell"></i>

                    <h6>
                        No notifications
                    </h6>

                    <p>
                        Your latest notifications will appear here.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>
<!-- =================================================
     QUICK ACTIONS
================================================== -->

<div class="section-header">

    <h4>
        Quick Actions
    </h4>

</div>


<div class="row g-3">

    <!-- ADD BUSINESS -->

    <div class="col-xl-3 col-md-6">

        <a
            href="{{ route('user.businesses.create') }}"
            class="quick-action"
        >

            <div class="quick-icon">
                <i class="bi bi-building-add"></i>
            </div>

            <div>

                <strong>
                    Add Business
                </strong>

                <span>
                    Create a new listing
                </span>

            </div>

        </a>

    </div>


    <!-- MY BUSINESSES -->

    <div class="col-xl-3 col-md-6">

        <a
            href="{{ route('user.businesses.index') }}"
            class="quick-action"
        >

            <div class="quick-icon">
                <i class="bi bi-buildings"></i>
            </div>

            <div>

                <strong>
                    My Businesses
                </strong>

                <span>
                    Manage your listings
                </span>

            </div>

        </a>

    </div>


    <!-- NOTIFICATIONS -->

    <div class="col-xl-3 col-md-6">

        <a
            href="{{ route('user.notifications.index') }}"
            class="quick-action"
        >

            <div class="quick-icon">
                <i class="bi bi-bell"></i>
            </div>

            <div>

                <strong>
                    Notifications
                </strong>

                <span>
                    View your latest updates
                </span>

            </div>

        </a>

    </div>


   <!-- BROWSE LISTINGS -->

<div class="col-xl-3 col-md-6">

    <a
        href="{{ route('businesses.index') }}"
        class="quick-action"
    >

        <div class="quick-icon">
            <i class="bi bi-search"></i>
        </div>

        <div>

            <strong>
                Browse Listings
            </strong>

            <span>
                Explore businesses
            </span>

        </div>

    </a>

</div>
</div>

@endsection
