@extends('admin.layouts.master')

@section('title', 'Business Reviews')

@section('content')

<div class="container-fluid py-3">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}

    <div class="d-flex flex-column flex-md-row
                align-items-md-center
                justify-content-between
                gap-3 mb-4">

        <div>
            <h4 class="mb-1 fw-bold">
                Business Reviews
            </h4>

            <p class="text-muted mb-0">
                Manage customer reviews, ratings and business feedback.
            </p>
        </div>

        <a
            href="{{ route('admin.reviews.create') }}"
            class="btn btn-primary"
        >
            <i class="bi bi-plus-lg me-1"></i>
            Add Review
        </a>

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show border-0 shadow-sm"
            role="alert"
        >

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================================================
        STATISTICS
    ========================================================== --}}

    <div class="row g-3 mb-4">

        {{-- Total --}}
        <div class="col-xl col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <div class="text-muted small mb-1">
                                Total Reviews
                            </div>

                            <h3 class="mb-0 fw-bold">
                                {{ number_format($totalReviews) }}
                            </h3>

                        </div>

                        <div
                            class="rounded-3 bg-primary bg-opacity-10
                                   text-primary d-flex align-items-center
                                   justify-content-center"
                            style="width:48px;height:48px;"
                        >
                            <i class="bi bi-chat-square-text fs-5"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Pending --}}
        <div class="col-xl col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <div class="text-muted small mb-1">
                                Pending
                            </div>

                            <h3 class="mb-0 fw-bold">
                                {{ number_format($pendingReviews) }}
                            </h3>

                        </div>

                        <div
                            class="rounded-3 bg-warning bg-opacity-10
                                   text-warning d-flex align-items-center
                                   justify-content-center"
                            style="width:48px;height:48px;"
                        >
                            <i class="bi bi-clock-history fs-5"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Approved --}}
        <div class="col-xl col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <div class="text-muted small mb-1">
                                Approved
                            </div>

                            <h3 class="mb-0 fw-bold">
                                {{ number_format($approvedReviews) }}
                            </h3>

                        </div>

                        <div
                            class="rounded-3 bg-success bg-opacity-10
                                   text-success d-flex align-items-center
                                   justify-content-center"
                            style="width:48px;height:48px;"
                        >
                            <i class="bi bi-check-circle fs-5"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Rejected --}}
        <div class="col-xl col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <div class="text-muted small mb-1">
                                Rejected
                            </div>

                            <h3 class="mb-0 fw-bold">
                                {{ number_format($rejectedReviews) }}
                            </h3>

                        </div>

                        <div
                            class="rounded-3 bg-danger bg-opacity-10
                                   text-danger d-flex align-items-center
                                   justify-content-center"
                            style="width:48px;height:48px;"
                        >
                            <i class="bi bi-x-circle fs-5"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Featured --}}
        <div class="col-xl col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <div class="text-muted small mb-1">
                                Featured
                            </div>

                            <h3 class="mb-0 fw-bold">
                                {{ number_format($featuredReviews) }}
                            </h3>

                        </div>

                        <div
                            class="rounded-3 bg-info bg-opacity-10
                                   text-info d-flex align-items-center
                                   justify-content-center"
                            style="width:48px;height:48px;"
                        >
                            <i class="bi bi-star-fill fs-5"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        FILTER CARD
    ========================================================== --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form
                action="{{ route('admin.reviews.index') }}"
                method="GET"
            >

                <div class="row g-3 align-items-end">

                    {{-- Search --}}
                    <div class="col-lg-5">

                        <label class="form-label fw-semibold">
                            Search Reviews
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-search"></i>
                            </span>

                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                value="{{ request('search') }}"
                                placeholder="Business, reviewer, title or comment..."
                            >

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="col-md-4 col-lg-2">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                        >

                            <option value="">
                                All Status
                            </option>

                            <option
                                value="pending"
                                @selected(request('status') === 'pending')
                            >
                                Pending
                            </option>

                            <option
                                value="approved"
                                @selected(request('status') === 'approved')
                            >
                                Approved
                            </option>

                            <option
                                value="rejected"
                                @selected(request('status') === 'rejected')
                            >
                                Rejected
                            </option>

                        </select>

                    </div>


                    {{-- Rating --}}
                    <div class="col-md-4 col-lg-2">

                        <label class="form-label fw-semibold">
                            Rating
                        </label>

                        <select
                            name="rating"
                            class="form-select"
                        >

                            <option value="">
                                All Ratings
                            </option>

                            @for($rating = 5; $rating >= 1; $rating--)

                                <option
                                    value="{{ $rating }}"
                                    @selected((string) request('rating') === (string) $rating)
                                >
                                    {{ $rating }} Star
                                </option>

                            @endfor

                        </select>

                    </div>


                    {{-- Buttons --}}
                    <div class="col-md-4 col-lg-3">

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-primary flex-grow-1"
                            >
                                <i class="bi bi-funnel me-1"></i>
                                Filter
                            </button>

                            <a
                                href="{{ route('admin.reviews.index') }}"
                                class="btn btn-outline-secondary"
                                title="Reset Filters"
                            >
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
        REVIEWS LIST
    ========================================================== --}}

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <div class="d-flex align-items-center justify-content-between">

                <div>

                    <strong>
                        <i class="bi bi-chat-square-heart me-2 text-primary"></i>
                        Reviews
                    </strong>

                    <div class="small text-muted mt-1">
                        Manage and moderate business reviews.
                    </div>

                </div>

                <span class="text-muted small">

                    {{ $reviews->total() }}
                    {{ Str::plural('review', $reviews->total()) }}

                </span>

            </div>

        </div>


        <div class="card-body p-0">

            @forelse($reviews as $review)

                <div class="review-item p-3 p-md-4 border-bottom">

                    <div class="row g-4">


                        {{-- Reviewer --}}
                        <div class="col-lg-3">

                            <div class="d-flex align-items-center gap-3">

                                <div
                                    class="rounded-circle bg-primary text-white
                                           d-flex align-items-center
                                           justify-content-center fw-bold"
                                    style="
                                        width:48px;
                                        height:48px;
                                        flex-shrink:0;
                                    "
                                >

                                    {{ strtoupper(
                                        substr(
                                            $review->reviewer_name
                                                ?: $review->user?->name
                                                ?: 'G',
                                            0,
                                            1
                                        )
                                    ) }}

                                </div>


                                <div class="min-w-0">

                                    <div class="fw-bold text-truncate">

                                        {{ $review->reviewer_name
                                            ?: $review->user?->name
                                            ?: 'Guest Reviewer'
                                        }}

                                    </div>


                                    @if($review->reviewer_email ?: $review->user?->email)

                                        <div
                                            class="small text-muted text-truncate"
                                        >

                                            {{ $review->reviewer_email
                                                ?: $review->user?->email
                                            }}

                                        </div>

                                    @endif

                                </div>

                            </div>


                            {{-- Date --}}
                            <div class="small text-muted mt-3">

                                <i class="bi bi-calendar3 me-1"></i>

                                {{ $review->created_at?->format('d M Y, h:i A') }}

                            </div>

                        </div>


                        {{-- Review --}}
                        <div class="col-lg-5">

                            {{-- Business --}}
                            <div class="mb-2">

                                @if($review->business)

                                    <a
                                        href="{{ route(
                                            'admin.businesses.show',
                                            $review->business
                                        ) }}"
                                        class="text-decoration-none fw-semibold"
                                    >

                                        <i class="bi bi-building me-1"></i>

                                        {{ $review->business->name }}

                                    </a>

                                @else

                                    <span class="text-muted">
                                        Business unavailable
                                    </span>

                                @endif

                            </div>


                            {{-- Rating --}}
                            <div class="mb-2">

                                <span class="text-warning">

                                    @for($i = 1; $i <= 5; $i++)

                                        @if($i <= $review->rating)

                                            <i class="bi bi-star-fill"></i>

                                        @else

                                            <i class="bi bi-star"></i>

                                        @endif

                                    @endfor

                                </span>

                                <span class="small text-muted ms-1">
                                    {{ $review->rating }}/5
                                </span>

                            </div>


                            {{-- Title --}}
                            @if($review->title)

                                <h6 class="fw-bold mb-1">
                                    {{ $review->title }}
                                </h6>

                            @endif


                            {{-- Comment --}}
                            <p
                                class="text-muted mb-0"
                                style="
                                    display:-webkit-box;
                                    -webkit-line-clamp:3;
                                    -webkit-box-orient:vertical;
                                    overflow:hidden;
                                "
                            >
                                {{ $review->comment }}
                            </p>


                            {{-- Featured --}}
                            @if($review->is_featured)

                                <div class="mt-2">

                                    <span class="badge bg-warning text-dark">

                                        <i class="bi bi-star-fill me-1"></i>

                                        Featured Review

                                    </span>

                                </div>

                            @endif

                        </div>


                        {{-- Status --}}
                        <div class="col-lg-2">

                            <div class="small text-muted mb-1">
                                Status
                            </div>

                            @if($review->status === 'approved')

                                <span class="badge bg-success">

                                    <i class="bi bi-check-circle me-1"></i>

                                    Approved

                                </span>

                            @elseif($review->status === 'rejected')

                                <span class="badge bg-danger">

                                    <i class="bi bi-x-circle me-1"></i>

                                    Rejected

                                </span>

                            @else

                                <span class="badge bg-warning text-dark">

                                    <i class="bi bi-clock me-1"></i>

                                    Pending

                                </span>

                            @endif


                            @if($review->admin_reply)

                                <div class="mt-3 small text-success">

                                    <i class="bi bi-reply me-1"></i>

                                    Admin replied

                                </div>

                            @endif

                        </div>


                      {{-- Actions --}}
<div class="col-lg-2">

    <div class="small text-muted mb-1">
        Actions
    </div>

    <div class="d-flex flex-wrap gap-2">

        {{-- View --}}
        <a
            href="{{ route('admin.reviews.show', $review) }}"
            class="btn btn-sm btn-outline-primary"
            title="View Review"
        >
            <i class="bi bi-eye"></i>
        </a>


        {{-- Edit --}}
        <a
            href="{{ route('admin.reviews.edit', $review) }}"
            class="btn btn-sm btn-outline-warning"
            title="Edit Review"
        >
            <i class="bi bi-pencil"></i>
        </a>


        {{-- Approve --}}
        @if($review->status !== 'approved')

            <form
                action="{{ route('admin.reviews.approve', $review) }}"
                method="POST"
                class="d-inline"
            >
                @csrf

                <button
                    type="submit"
                    class="btn btn-sm btn-outline-success"
                    title="Approve Review"
                >
                    <i class="bi bi-check-lg"></i>
                </button>
            </form>

        @endif


        {{-- Reject --}}
        @if($review->status !== 'rejected')

            <form
                action="{{ route('admin.reviews.reject', $review) }}"
                method="POST"
                class="d-inline"
                onsubmit="return confirm(
                    'Are you sure you want to reject this review?'
                );"
            >
                @csrf

                <button
                    type="submit"
                    class="btn btn-sm btn-outline-danger"
                    title="Reject Review"
                >
                    <i class="bi bi-x-lg"></i>
                </button>
            </form>

        @endif


        {{-- Delete --}}
        <form
            action="{{ route('admin.reviews.destroy', $review) }}"
            method="POST"
            class="d-inline"
            onsubmit="return confirm(
                'Are you sure you want to delete this review?'
            );"
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="btn btn-sm btn-outline-danger"
                title="Delete Review"
            >
                <i class="bi bi-trash"></i>
            </button>

        </form>

    </div>

</div>

                    </div>

                </div>

            @empty

                {{-- Empty State --}}
                <div class="text-center py-5 px-3">

                    <div
                        class="rounded-circle bg-light
                               d-flex align-items-center
                               justify-content-center
                               mx-auto mb-3"
                        style="
                            width:80px;
                            height:80px;
                        "
                    >

                        <i class="bi bi-chat-square-text fs-2 text-muted"></i>

                    </div>


                    <h6 class="fw-bold mb-1">
                        No Reviews Found
                    </h6>


                    <p class="text-muted small mb-3">
                        No reviews match your current filters.
                    </p>


                    <a
                        href="{{ route('admin.reviews.create') }}"
                        class="btn btn-sm btn-primary"
                    >

                        <i class="bi bi-plus-lg me-1"></i>

                        Add First Review

                    </a>

                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        @if($reviews->hasPages())

            <div class="card-footer bg-white border-0 py-3">

                {{ $reviews->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
