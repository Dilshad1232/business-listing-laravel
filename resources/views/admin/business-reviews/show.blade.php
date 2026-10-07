@extends('admin.layouts.master')

@section('title', 'Review Details')

@section('content')

<div class="container-fluid py-3">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="d-flex flex-column flex-md-row
                align-items-md-center
                justify-content-between
                gap-3 mb-4">

        <div>

            <div class="d-flex align-items-center gap-2 mb-1">

                <a
                    href="{{ route('admin.reviews.index') }}"
                    class="text-muted text-decoration-none"
                >
                    <i class="bi bi-arrow-left"></i>
                </a>

                <h4 class="mb-0 fw-bold">
                    Review Details
                </h4>

            </div>

            <p class="text-muted mb-0">
                View complete customer review information.
            </p>

        </div>


        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.reviews.edit', $review) }}"
                class="btn btn-warning"
            >
                <i class="bi bi-pencil me-1"></i>
                Edit Review
            </a>

            <a
                href="{{ route('admin.reviews.index') }}"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

    </div>


    {{-- =========================================================
        REVIEW HERO
    ========================================================== --}}

    <div class="card border-0 shadow-sm mb-4 overflow-hidden">

        <div
            class="p-4 p-md-5"
            style="
                background:
                    linear-gradient(
                        135deg,
                        rgba(79,70,229,.10),
                        rgba(245,158,11,.08)
                    );
            "
        >

            <div class="row align-items-center g-4">


                {{-- Reviewer --}}
                <div class="col-md-8">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="rounded-circle bg-primary text-white
                                   d-flex align-items-center
                                   justify-content-center
                                   fw-bold shadow-sm"
                            style="
                                width:68px;
                                height:68px;
                                flex-shrink:0;
                                font-size:24px;
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


                        <div>

                            <h4 class="mb-1 fw-bold">

                                {{ $review->reviewer_name
                                    ?: $review->user?->name
                                    ?: 'Guest Reviewer'
                                }}

                            </h4>


                            @if($review->reviewer_email ?: $review->user?->email)

                                <div class="text-muted">

                                    <i class="bi bi-envelope me-1"></i>

                                    {{ $review->reviewer_email
                                        ?: $review->user->email
                                    }}

                                </div>

                            @else

                                <div class="text-muted small">

                                    Guest Reviewer

                                </div>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- Rating --}}
                <div class="col-md-4 text-md-end">

                    <div class="text-warning fs-3">

                        @for($i = 1; $i <= 5; $i++)

                            @if($i <= $review->rating)

                                <i class="bi bi-star-fill"></i>

                            @else

                                <i class="bi bi-star"></i>

                            @endif

                        @endfor

                    </div>


                    <div class="fw-bold fs-5">

                        {{ $review->rating }}/5

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="row g-4">


        {{-- =====================================================
            LEFT COLUMN
        ====================================================== --}}

        <div class="col-lg-8">


            {{-- Review Content --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <strong>

                        <i class="bi bi-chat-square-text me-2 text-primary"></i>

                        Review Content

                    </strong>

                </div>


                <div class="card-body">


                    {{-- Title --}}
                    @if($review->title)

                        <h5 class="fw-bold mb-3">

                            {{ $review->title }}

                        </h5>

                    @endif


                    {{-- Comment --}}
                    <div
                        class="p-4 rounded-4 bg-light border"
                    >

                        <div class="text-muted"
                             style="line-height:1.8;">

                            {!! nl2br(e($review->comment)) !!}

                        </div>

                    </div>


                    {{-- Helpful --}}
                    <div class="mt-3">

                        <span class="badge bg-light text-dark border">

                            <i class="bi bi-hand-thumbs-up me-1 text-primary"></i>

                            {{ number_format($review->helpful_count) }}

                            {{ Str::plural(
                                'person',
                                $review->helpful_count
                            ) }}

                            found this helpful

                        </span>

                    </div>

                </div>

            </div>


            {{-- Admin Response --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <strong>

                        <i class="bi bi-reply me-2 text-primary"></i>

                        Admin Response

                    </strong>

                </div>


                <div class="card-body">

                    @if($review->admin_reply)

                        <div
                            class="p-4 rounded-4 bg-primary bg-opacity-10
                                   border-start border-primary border-4"
                        >

                            <div class="fw-semibold mb-2">

                                <i class="bi bi-shield-check me-1 text-primary"></i>

                                Official Response

                            </div>


                            <div
                                class="text-muted"
                                style="line-height:1.8;"
                            >

                                {!! nl2br(e($review->admin_reply)) !!}

                            </div>


                            @if($review->admin_replied_at)

                                <div class="small text-muted mt-3">

                                    <i class="bi bi-clock me-1"></i>

                                    {{ $review->admin_replied_at->format(
                                        'd M Y, h:i A'
                                    ) }}

                                </div>

                            @endif

                        </div>

                    @else

                        <div class="text-center py-4">

                            <div
                                class="rounded-circle bg-light
                                       d-flex align-items-center
                                       justify-content-center
                                       mx-auto mb-3"
                                style="
                                    width:60px;
                                    height:60px;
                                "
                            >

                                <i class="bi bi-reply fs-4 text-muted"></i>

                            </div>


                            <h6 class="fw-bold">
                                No Admin Response
                            </h6>

                            <p class="text-muted small mb-3">
                                No response has been added to this review yet.
                            </p>


                            <a
                                href="{{ route(
                                    'admin.reviews.edit',
                                    $review
                                ) }}"
                                class="btn btn-sm btn-outline-primary"
                            >

                                <i class="bi bi-plus-lg me-1"></i>

                                Add Response

                            </a>

                        </div>

                    @endif

                </div>

            </div>


            {{-- Business --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <strong>

                        <i class="bi bi-building me-2 text-primary"></i>

                        Business Information

                    </strong>

                </div>


                <div class="card-body">

                    @if($review->business)

                        <div
                            class="d-flex flex-column flex-md-row
                                   align-items-md-center
                                   justify-content-between
                                   gap-3"
                        >

                            <div>

                                <h5 class="fw-bold mb-1">

                                    {{ $review->business->name }}

                                </h5>


                                @if($review->business->tagline)

                                    <div class="text-muted small">

                                        {{ $review->business->tagline }}

                                    </div>

                                @endif

                            </div>


                            <a
                                href="{{ route(
                                    'admin.businesses.show',
                                    $review->business
                                ) }}"
                                class="btn btn-sm btn-outline-primary"
                            >

                                <i class="bi bi-eye me-1"></i>

                                View Business

                            </a>

                        </div>

                    @else

                        <div class="text-muted">

                            Business information is unavailable.

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- =====================================================
            RIGHT COLUMN
        ====================================================== --}}

        <div class="col-lg-4">


            {{-- Status --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <strong>

                        <i class="bi bi-shield-check me-2 text-primary"></i>

                        Review Status

                    </strong>

                </div>


                <div class="card-body">


                    <div class="mb-4">

                        <small class="text-muted d-block mb-2">
                            Current Status
                        </small>


                        @if($review->status === 'approved')

                            <span class="badge bg-success fs-6">

                                <i class="bi bi-check-circle me-1"></i>

                                Approved

                            </span>

                        @elseif($review->status === 'rejected')

                            <span class="badge bg-danger fs-6">

                                <i class="bi bi-x-circle me-1"></i>

                                Rejected

                            </span>

                        @else

                            <span class="badge bg-warning text-dark fs-6">

                                <i class="bi bi-clock me-1"></i>

                                Pending

                            </span>

                        @endif

                    </div>


                    <div class="mb-4">

                        <small class="text-muted d-block mb-2">
                            Featured
                        </small>


                        @if($review->is_featured)

                            <span class="text-warning fw-semibold">

                                <i class="bi bi-star-fill me-1"></i>

                                Featured Review

                            </span>

                        @else

                            <span class="text-muted">

                                <i class="bi bi-star me-1"></i>

                                Not Featured

                            </span>

                        @endif

                    </div>


                    <div class="mb-4">

                        <small class="text-muted d-block">
                            Helpful Count
                        </small>

                        <strong class="fs-5">

                            {{ number_format($review->helpful_count) }}

                        </strong>

                    </div>


                    <div>

                        <small class="text-muted d-block">
                            Review Date
                        </small>

                        <strong>

                            {{ $review->created_at?->format(
                                'd M Y, h:i A'
                            ) }}

                        </strong>

                    </div>

                </div>

            </div>


            {{-- Reviewer Information --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white py-3">

                    <strong>

                        <i class="bi bi-person me-2 text-primary"></i>

                        Reviewer Information

                    </strong>

                </div>


                <div class="card-body">

                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Name
                        </small>

                        <strong>

                            {{ $review->reviewer_name
                                ?: $review->user?->name
                                ?: 'Guest Reviewer'
                            }}

                        </strong>

                    </div>


                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Email
                        </small>

                        @if($review->reviewer_email ?: $review->user?->email)

                            <a
                                href="mailto:{{ $review->reviewer_email ?: $review->user->email }}"
                                class="text-decoration-none"
                            >

                                {{ $review->reviewer_email
                                    ?: $review->user->email
                                }}

                            </a>

                        @else

                            <span class="text-muted">
                                N/A
                            </span>

                        @endif

                    </div>


                    <div>

                        <small class="text-muted d-block">
                            User ID
                        </small>

                        <span>

                            {{ $review->user_id ?? 'Guest User' }}

                        </span>

                    </div>

                </div>

            </div>


            {{-- Actions --}}
            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <a
                        href="{{ route(
                            'admin.reviews.edit',
                            $review
                        ) }}"
                        class="btn btn-warning w-100 mb-2"
                    >

                        <i class="bi bi-pencil me-1"></i>

                        Edit Review

                    </a>


                    <form
                        action="{{ route(
                            'admin.reviews.destroy',
                            $review
                        ) }}"
                        method="POST"
                        onsubmit="return confirm(
                            'Are you sure you want to delete this review?'
                        );"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-outline-danger w-100"
                        >

                            <i class="bi bi-trash me-1"></i>

                            Delete Review

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
