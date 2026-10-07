@extends('admin.layouts.master')

@section('title', 'Business Details')

@section('content')

<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Business Details</h4>

            <p class="text-muted mb-0">
                View complete business information.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.businesses.edit', $business) }}"
                class="btn btn-warning"
            >
                <i class="bi bi-pencil me-1"></i>
                Edit
            </a>

            <a
                href="{{ route('admin.businesses.index') }}"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

    </div>


 {{-- Business Header --}}
<div class="card border-0 shadow-sm mb-4 overflow-hidden">

    {{-- Cover Image --}}
    <div
        style="
            height: 260px;
            background: #f1f3f5;
            position: relative;
            overflow: hidden;
        "
    >

        @if($business->cover_image)

            <img
                src="{{ asset('storage/' . $business->cover_image) }}"
                alt="{{ $business->name }} Cover"
                class="w-100 h-100"
                style="object-fit: cover;"
            >

        @else

            <div
                class="w-100 h-100 d-flex align-items-center justify-content-center bg-light"
            >

                <div class="text-center text-muted">

                    <i class="bi bi-image fs-1 d-block mb-2"></i>

                    <span>
                        No cover image
                    </span>

                </div>

            </div>

        @endif


        {{-- Overlay --}}
        <div
            style="
                position: absolute;
                inset: 0;
                background: linear-gradient(
                    to bottom,
                    rgba(0,0,0,0.05),
                    rgba(0,0,0,0.45)
                );
            "
        ></div>

    </div>


    {{-- Business Information --}}
    <div class="card-body">

        <div class="row align-items-center">

            {{-- Logo --}}
            <div class="col-md-auto">

                @if($business->logo)

                    <div
                        class="bg-white rounded-4 shadow border p-2"
                        style="
                            width: 110px;
                            height: 110px;
                            margin-top: -65px;
                            position: relative;
                            z-index: 2;
                        "
                    >

                        <img
                            src="{{ asset('storage/' . $business->logo) }}"
                            alt="{{ $business->name }}"
                            class="w-100 h-100 rounded-3"
                            style="object-fit: contain;"
                        >

                    </div>

                @else

                    <div
                        class="bg-white rounded-4 shadow border d-flex align-items-center justify-content-center"
                        style="
                            width: 110px;
                            height: 110px;
                            margin-top: -65px;
                            position: relative;
                            z-index: 2;
                        "
                    >

                        <i class="bi bi-building text-muted fs-1"></i>

                    </div>

                @endif

            </div>


            {{-- Name + Status --}}
            <div class="col-md mt-3 mt-md-0">

                <h3 class="mb-1">
                    {{ $business->name }}
                </h3>


                @if($business->tagline)

                    <p class="text-muted mb-2">
                        {{ $business->tagline }}
                    </p>

                @endif


                <div>

                    @if($business->status === 'approved')

                        <span class="badge bg-success">
                            Approved
                        </span>

                    @elseif($business->status === 'rejected')

                        <span class="badge bg-danger">
                            Rejected
                        </span>

                    @else

                        <span class="badge bg-warning text-dark">
                            Pending
                        </span>

                    @endif


                    @if($business->is_featured)

                        <span class="badge bg-primary">

                            <i class="bi bi-star-fill me-1"></i>

                            Featured

                        </span>

                    @endif

                </div>

            </div>


            {{-- Rating --}}
            <div class="col-md-auto text-md-end mt-3 mt-md-0">

                <div class="text-warning fs-5">

                    @for($i = 1; $i <= 5; $i++)

                        @if($i <= floor($business->rating))

                            <i class="bi bi-star-fill"></i>

                        @else

                            <i class="bi bi-star"></i>

                        @endif

                    @endfor

                </div>


                <small class="text-muted">

                    {{ number_format((float) $business->rating, 1) }}
                    / 5

                    ·

                    {{ $business->reviews_count }}
                    reviews

                </small>

            </div>

        </div>

    </div>

</div>

    <div class="row g-4">


        {{-- Left Column --}}
        <div class="col-lg-8">


            {{-- Basic Information --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white">

                    <strong>
                        <i class="bi bi-building me-2"></i>
                        Basic Information
                    </strong>

                </div>

                <div class="card-body">

                    <div class="row g-4">

                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Business Name
                            </small>

                            <strong>
                                {{ $business->name }}
                            </strong>

                        </div>

                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Slug
                            </small>

                            <strong>
                                {{ $business->slug }}
                            </strong>

                        </div>

                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Category
                            </small>

                            <strong>
                                {{ $business->category?->name ?? 'N/A' }}
                            </strong>

                        </div>

                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Subcategory
                            </small>

                            <strong>
                                {{ $business->subcategory?->name ?? 'N/A' }}
                            </strong>

                        </div>

                        <div class="col-12">

                            <small class="text-muted d-block">
                                Description
                            </small>

                            <div class="mt-1">

                                @if($business->description)

                                    {!! nl2br(e($business->description)) !!}

                                @else

                                    <span class="text-muted">
                                        No description available.
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Location --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white">

                    <strong>
                        <i class="bi bi-geo-alt me-2"></i>
                        Location
                    </strong>

                </div>

                <div class="card-body">

                    <div class="row g-4">

                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Country
                            </small>

                            <strong>
                                {{ $business->country?->name ?? 'N/A' }}
                            </strong>

                        </div>

                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                State
                            </small>

                            <strong>
                                {{ $business->state?->name ?? 'N/A' }}
                            </strong>

                        </div>

                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                City
                            </small>

                            <strong>
                                {{ $business->city?->name ?? 'N/A' }}
                            </strong>

                        </div>

                        <div class="col-md-6">

                            <small class="text-muted d-block">
                                Area
                            </small>

                            <strong>
                                {{ $business->area?->name ?? 'N/A' }}
                            </strong>

                        </div>

                        <div class="col-md-9">

                            <small class="text-muted d-block">
                                Address
                            </small>

                            <strong>
                                {{ $business->address ?? 'N/A' }}
                            </strong>

                        </div>

                        <div class="col-md-3">

                            <small class="text-muted d-block">
                                Pincode
                            </small>

                            <strong>
                                {{ $business->pincode ?? 'N/A' }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Contact --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white">

                    <strong>
                        <i class="bi bi-telephone me-2"></i>
                        Contact Information
                    </strong>

                </div>

                <div class="card-body">

                    <div class="row g-4">

                        <div class="col-md-4">

                            <small class="text-muted d-block">
                                Phone
                            </small>

                            @if($business->phone)

                                <a href="tel:{{ $business->phone }}">
                                    {{ $business->phone }}
                                </a>

                            @else

                                <span>N/A</span>

                            @endif

                        </div>

                        <div class="col-md-4">

                            <small class="text-muted d-block">
                                Email
                            </small>

                            @if($business->email)

                                <a href="mailto:{{ $business->email }}">
                                    {{ $business->email }}
                                </a>

                            @else

                                <span>N/A</span>

                            @endif

                        </div>

                        <div class="col-md-4">

                            <small class="text-muted d-block">
                                Website
                            </small>

                            @if($business->website)

                                <a
                                    href="{{ $business->website }}"
                                    target="_blank"
                                    rel="noopener"
                                >
                                    Visit Website
                                </a>

                            @else

                                <span>N/A</span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

{{-- Business Services --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white py-3">

        <div class="d-flex align-items-center justify-content-between">

            <div>

                <strong class="d-flex align-items-center">
                    <i class="bi bi-briefcase me-2 text-primary"></i>
                    Business Services
                </strong>

                <div class="text-muted small mt-1">
                    Services offered by this business.
                </div>

            </div>

            @if($business->services->count() > 0)

                <span class="badge bg-primary bg-opacity-10 text-primary">
                    {{ $business->services->count() }}
                    {{ Str::plural('Service', $business->services->count()) }}
                </span>

            @endif

        </div>

    </div>


    <div class="card-body">


        @forelse($business->services as $service)

            <div
                class="border rounded-3 p-3 p-md-4 mb-3 bg-light"
            >

                {{-- Service Header --}}
                <div
                    class="d-flex flex-column flex-md-row
                           align-items-md-center
                           justify-content-between
                           gap-3 mb-3"
                >

                    <div class="d-flex align-items-center gap-3">

                        {{-- Icon --}}
                        <div
                            class="d-flex align-items-center justify-content-center
                                   rounded-3 bg-primary bg-opacity-10 text-primary"
                            style="width:48px;height:48px;flex-shrink:0;"
                        >
                            <i class="bi bi-briefcase fs-5"></i>
                        </div>


                        {{-- Name --}}
                        <div>

                            <h6 class="mb-1 fw-bold">
                                {{ $service->name }}
                            </h6>

                            <div class="small text-muted">

                                Service #{{ $loop->iteration }}

                                @if($service->status)

                                    <span class="ms-2 text-success">
                                        <i class="bi bi-check-circle-fill me-1"></i>
                                        Active
                                    </span>

                                @else

                                    <span class="ms-2 text-danger">
                                        <i class="bi bi-x-circle-fill me-1"></i>
                                        Inactive
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>


                    {{-- Price --}}
                    @if(!is_null($service->price))

                        <div class="text-md-end">

                            <div class="small text-muted">
                                Starting Price
                            </div>

                            <div class="fw-bold text-primary fs-5">
                                ₹{{ number_format((float) $service->price, 2) }}
                            </div>

                        </div>

                    @endif

                </div>


                {{-- Short Description --}}
                @if($service->short_description)

                    <div class="mb-3">

                        <div class="small text-muted mb-1">
                            Short Description
                        </div>

                        <div>
                            {{ $service->short_description }}
                        </div>

                    </div>

                @endif


                {{-- Description --}}
                @if($service->description)

                    <div class="mb-3">

                        <div class="small text-muted mb-1">
                            Description
                        </div>

                        <div class="text-muted">
                            {!! nl2br(e($service->description)) !!}
                        </div>

                    </div>

                @endif


                {{-- Service Meta --}}
                <div
                    class="d-flex flex-wrap gap-2 pt-3 border-top"
                >

                    @if($service->duration)

                        <span class="badge bg-white text-dark border">

                            <i class="bi bi-clock me-1 text-primary"></i>

                            {{ $service->duration }}

                        </span>

                    @endif


                    <span class="badge bg-white text-dark border">

                        <i class="bi bi-sort-numeric-down me-1 text-primary"></i>

                        Order: {{ $service->sort_order ?? 0 }}

                    </span>


                    @if($service->slug)

                        <span
                            class="badge bg-white text-muted border text-truncate"
                            style="max-width: 220px;"
                            title="{{ $service->slug }}"
                        >

                            <i class="bi bi-link-45deg me-1"></i>

                            {{ $service->slug }}

                        </span>

                    @endif

                </div>

            </div>

        @empty

            {{-- Empty State --}}
            <div class="text-center py-5">

                <div
                    class="d-flex align-items-center justify-content-center
                           rounded-circle bg-light text-muted mx-auto mb-3"
                    style="width:70px;height:70px;"
                >
                    <i class="bi bi-briefcase fs-2"></i>
                </div>

                <h6 class="fw-bold mb-1">
                    No Services Added
                </h6>

                <p class="text-muted small mb-3">
                    This business does not have any services listed yet.
                </p>

                <a
                    href="{{ route('admin.businesses.edit', $business) }}"
                    class="btn btn-sm btn-outline-primary"
                >
                    <i class="bi bi-plus-lg me-1"></i>
                    Add Service
                </a>

            </div>

        @endforelse


    </div>

</div>

{{-- Business Gallery --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white py-3">

        <div class="d-flex flex-column flex-md-row
                    align-items-md-center
                    justify-content-between gap-2">

            <div>

                <strong class="d-flex align-items-center">
                    <i class="bi bi-images me-2 text-primary"></i>
                    Business Gallery
                </strong>

                <div class="text-muted small mt-1">
                    Photos uploaded for this business.
                </div>

            </div>


            @if($business->photos->count() > 0)

                <span class="badge bg-primary bg-opacity-10 text-primary">

                    <i class="bi bi-image me-1"></i>

                    {{ $business->photos->count() }}
                    {{ Str::plural('Photo', $business->photos->count()) }}

                </span>

            @endif

        </div>

    </div>


    <div class="card-body">


        @if($business->photos->count() > 0)

            <div class="row g-3">

                @foreach($business->photos as $photo)

                    <div class="col-6 col-md-4 col-lg-3">

                        <a
                        href="{{ asset('storage/' . $photo->image) }}"
                        target="_blank"
                        class="text-decoration-none"
                    >
                        <div
                            class="position-relative overflow-hidden rounded-3 border bg-light"
                            style="height:180px;"
                        >

                            <img
                                src="{{ asset('storage/' . $photo->image) }}"
                                alt="{{ $business->name }} Photo {{ $loop->iteration }}"
                                class="w-100 h-100"
                                style="
                                    object-fit: cover;
                                    transition: transform .3s ease;
                                "
                            >

                            <span
                                class="position-absolute bottom-0 end-0
                                       m-2 badge bg-dark bg-opacity-75"
                            >
                                #{{ $loop->iteration }}
                            </span>

                        </div>
                    </a>

                    </div>

                @endforeach

            </div>


            {{-- Gallery Footer --}}

            <div
                class="d-flex align-items-center justify-content-between
                       border-top mt-4 pt-3"
            >

                <small class="text-muted">

                    <i class="bi bi-info-circle me-1"></i>

                    Click any photo to view full size.

                </small>


                <a
                    href="{{ route('admin.businesses.edit', $business) }}"
                    class="btn btn-sm btn-outline-primary"
                >

                    <i class="bi bi-pencil me-1"></i>

                    Manage Gallery

                </a>

            </div>


        @else

            {{-- Empty Gallery --}}

            <div class="text-center py-5">

                <div
                    class="d-flex align-items-center
                           justify-content-center
                           rounded-circle bg-light text-muted
                           mx-auto mb-3"
                    style="
                        width:70px;
                        height:70px;
                    "
                >

                    <i class="bi bi-images fs-2"></i>

                </div>


                <h6 class="fw-bold mb-1">
                    No Photos Available
                </h6>


                <p class="text-muted small mb-3">
                    This business does not have any gallery photos yet.
                </p>


                <a
                    href="{{ route('admin.businesses.edit', $business) }}"
                    class="btn btn-sm btn-outline-primary"
                >

                    <i class="bi bi-plus-lg me-1"></i>

                    Add Photos

                </a>

            </div>

        @endif

    </div>

</div>
{{-- Business Reviews --}}
<div class="card border-0 shadow-sm mb-4">

    {{-- Header --}}
    <div class="card-header bg-white py-3">

        <div class="d-flex flex-column flex-md-row
                    align-items-md-center
                    justify-content-between
                    gap-2">

            <div>

                <strong class="d-flex align-items-center">

                    <i class="bi bi-star-fill me-2 text-warning"></i>

                    Business Reviews

                </strong>

                <div class="text-muted small mt-1">

                    Customer reviews and ratings for this business.

                </div>

            </div>


            @if($business->reviews->count() > 0)

                <span class="badge bg-warning bg-opacity-10 text-warning-emphasis">

                    <i class="bi bi-chat-square-text me-1"></i>

                    {{ $business->reviews->count() }}
                    {{ Str::plural('Review', $business->reviews->count()) }}

                </span>

            @endif

        </div>

    </div>


    <div class="card-body">


        @if($business->reviews->count() > 0)

            {{-- =====================================================
                 RATING SUMMARY
            ====================================================== --}}

            @php

                $approvedReviews = $business->reviews
                    ->where('status', 'approved');

                $totalReviews = $approvedReviews->count();

                $averageRating = $totalReviews > 0
                    ? round($approvedReviews->avg('rating'), 1)
                    : 0;

            @endphp


            <div class="row g-4 mb-4">


                {{-- Overall Rating --}}
                <div class="col-md-4">

                    <div
                        class="h-100 rounded-4 border bg-light
                               d-flex flex-column
                               align-items-center
                               justify-content-center
                               text-center p-4"
                    >

                        <div class="display-4 fw-bold text-dark">

                            {{ number_format($averageRating, 1) }}

                        </div>


                        <div class="text-warning fs-5 mb-2">

                            @for($i = 1; $i <= 5; $i++)

                                @if($i <= floor($averageRating))

                                    <i class="bi bi-star-fill"></i>

                                @elseif($i - $averageRating < 1)

                                    <i class="bi bi-star-half"></i>

                                @else

                                    <i class="bi bi-star"></i>

                                @endif

                            @endfor

                        </div>


                        <div class="small text-muted">

                            Based on {{ $totalReviews }}
                            {{ Str::plural('approved review', $totalReviews) }}

                        </div>

                    </div>

                </div>


                {{-- Rating Distribution --}}
                <div class="col-md-8">

                    <div class="h-100 rounded-4 border p-4">

                        <h6 class="fw-bold mb-3">

                            Rating Distribution

                        </h6>


                        @for($star = 5; $star >= 1; $star++)

                            @php

                                $starCount = $approvedReviews
                                    ->where('rating', $star)
                                    ->count();

                                $percentage = $totalReviews > 0
                                    ? ($starCount / $totalReviews) * 100
                                    : 0;

                            @endphp


                            <div
                                class="d-flex align-items-center gap-2 mb-2"
                            >

                                <div
                                    class="small text-muted"
                                    style="width:42px;"
                                >

                                    {{ $star }}

                                    <i class="bi bi-star-fill text-warning"></i>

                                </div>


                                <div
                                    class="progress flex-grow-1"
                                    style="height:8px;"
                                >

                                    <div
                                        class="progress-bar bg-warning"
                                        role="progressbar"
                                        style="width: {{ $percentage }}%;"
                                    ></div>

                                </div>


                                <div
                                    class="small text-muted text-end"
                                    style="width:35px;"
                                >

                                    {{ $starCount }}

                                </div>

                            </div>

                        @endfor

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 REVIEWS LIST
            ====================================================== --}}

            <div class="reviews-list">

                @foreach($business->reviews->sortByDesc('created_at') as $review)

                    <div
                        class="border rounded-4 p-3 p-md-4 mb-3
                               {{ $review->is_featured ? 'border-warning' : '' }}"
                    >

                        {{-- Review Header --}}
                        <div
                            class="d-flex flex-column flex-md-row
                                   justify-content-between
                                   gap-3 mb-3"
                        >

                            <div class="d-flex align-items-center gap-3">


                                {{-- Avatar --}}
                                <div
                                    class="rounded-circle bg-primary
                                           text-white
                                           d-flex align-items-center
                                           justify-content-center
                                           fw-bold"
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


                                {{-- Reviewer --}}
                                <div>

                                    <div class="fw-bold">

                                        {{ $review->reviewer_name
                                            ?: $review->user?->name
                                            ?: 'Guest Reviewer'
                                        }}

                                        @if($review->is_featured)

                                            <span
                                                class="badge bg-warning text-dark ms-1"
                                            >

                                                <i class="bi bi-star-fill me-1"></i>

                                                Featured

                                            </span>

                                        @endif

                                    </div>


                                    <div class="small text-muted">

                                        {{ $review->created_at?->format('d M Y, h:i A') }}

                                    </div>

                                </div>

                            </div>


                            {{-- Status --}}
                            <div>

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

                            </div>

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


                            <span class="small text-muted ms-2">

                                {{ $review->rating }}/5

                            </span>

                        </div>


                        {{-- Title --}}
                        @if($review->title)

                            <h6 class="fw-bold mb-2">

                                {{ $review->title }}

                            </h6>

                        @endif


                        {{-- Comment --}}
                        <div class="text-muted">

                            {!! nl2br(e($review->comment)) !!}

                        </div>


                        {{-- Helpful --}}
                        @if($review->helpful_count > 0)

                            <div class="small text-muted mt-3">

                                <i class="bi bi-hand-thumbs-up me-1"></i>

                                {{ $review->helpful_count }}
                                {{ Str::plural('person', $review->helpful_count) }}
                                found this helpful.

                            </div>

                        @endif


                        {{-- Admin Reply --}}
                        @if($review->admin_reply)

                            <div
                                class="mt-4 ms-md-4 p-3 rounded-3 bg-light border-start border-primary border-3"
                            >

                                <div class="fw-bold mb-1">

                                    <i class="bi bi-reply me-1 text-primary"></i>

                                    Admin Response

                                </div>


                                <div class="text-muted small">

                                    {!! nl2br(e($review->admin_reply)) !!}

                                </div>


                                @if($review->admin_replied_at)

                                    <div class="small text-muted mt-2">

                                        {{ $review->admin_replied_at->format('d M Y, h:i A') }}

                                    </div>

                                @endif

                            </div>

                        @endif

                    </div>

                @endforeach

            </div>


        @else

            {{-- Empty State --}}
            <div class="text-center py-5">

                <div
                    class="d-flex align-items-center
                           justify-content-center
                           rounded-circle
                           bg-warning bg-opacity-10
                           text-warning
                           mx-auto mb-3"
                    style="
                        width:76px;
                        height:76px;
                    "
                >

                    <i class="bi bi-star fs-2"></i>

                </div>


                <h6 class="fw-bold mb-1">

                    No Reviews Yet

                </h6>


                <p class="text-muted small mb-0">

                    This business has not received any customer reviews yet.

                </p>

            </div>

        @endif

    </div>

</div>
            {{-- SEO --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white">

                    <strong>
                        <i class="bi bi-search me-2"></i>
                        SEO Information
                    </strong>

                </div>

                <div class="card-body">

                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Meta Title
                        </small>

                        <div>
                            {{ $business->meta_title ?? 'N/A' }}
                        </div>

                    </div>

                    <div>

                        <small class="text-muted d-block">
                            Meta Description
                        </small>

                        <div>
                            {{ $business->meta_description ?? 'N/A' }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Right Column --}}
        <div class="col-lg-4">


            {{-- Owner --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white">

                    <strong>
                        <i class="bi bi-person me-2"></i>
                        Business Owner
                    </strong>

                </div>

                <div class="card-body">

                    <h6 class="mb-1">
                        {{ $business->user?->name ?? 'N/A' }}
                    </h6>

                    @if($business->user?->email)

                        <div class="text-muted small">
                            {{ $business->user->email }}
                        </div>

                    @endif

                </div>

            </div>


            {{-- Listing Status --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white">

                    <strong>
                        <i class="bi bi-check-circle me-2"></i>
                        Listing Status
                    </strong>

                </div>

                <div class="card-body">

                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Current Status
                        </small>

                        @if($business->status === 'approved')

                            <span class="badge bg-success">
                                Approved
                            </span>

                        @elseif($business->status === 'rejected')

                            <span class="badge bg-danger">
                                Rejected
                            </span>

                        @else

                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>

                        @endif

                    </div>

                    <div class="mb-3">

                        <small class="text-muted d-block">
                            Featured
                        </small>

                        @if($business->is_featured)

                            <span class="text-success">
                                <i class="bi bi-check-circle-fill"></i>
                                Yes
                            </span>

                        @else

                            <span class="text-muted">
                                No
                            </span>

                        @endif

                    </div>

                    <div>

                        <small class="text-muted d-block">
                            Created
                        </small>

                        <span>
                            {{ $business->created_at?->format('d M Y, h:i A') }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- =========================================================
     BUSINESS REVIEW
========================================================= --}}
@if($business->status === 'pending')

<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white border-bottom">
        <h6 class="mb-0 fw-bold">
            <i class="bi bi-shield-check me-2"></i>
            Business Review
        </h6>
    </div>

    <div class="card-body">

        <div class="alert alert-warning d-flex align-items-start gap-2 mb-3">
            <i class="bi bi-hourglass-split mt-1"></i>

            <div>
                <strong>Pending Approval</strong>
                <div class="small mt-1">
                    This business is waiting for admin review.
                </div>
            </div>
        </div>

        <div class="d-flex flex-wrap gap-2">

            {{-- Approve --}}
            <form action="{{ route('admin.businesses.approve', $business) }}"
                  method="POST"
                  class="d-inline">

                @csrf

                <button type="submit"
                        class="btn btn-success"
                        onclick="return confirm('Are you sure you want to approve this business?')">

                    <i class="bi bi-check-circle me-1"></i>
                    Approve Business

                </button>

            </form>


            {{-- Reject --}}
            <button type="button"
                    class="btn btn-danger"
                    data-bs-toggle="modal"
                    data-bs-target="#rejectBusinessModal">

                <i class="bi bi-x-circle me-1"></i>
                Reject Business

            </button>

        </div>

    </div>

</div>

@endif

            {{-- Admin Notes --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white">

                    <strong>
                        <i class="bi bi-sticky me-2"></i>
                        Admin Notes
                    </strong>

                </div>

                <div class="card-body">

                    @if($business->admin_notes)

                        {!! nl2br(e($business->admin_notes)) !!}

                    @else

                        <span class="text-muted">
                            No admin notes.
                        </span>

                    @endif

                </div>

            </div>


            {{-- Delete --}}
            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <form
                        action="{{ route('admin.businesses.destroy', $business) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this business?');"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn btn-outline-danger w-100"
                        >
                            <i class="bi bi-trash me-1"></i>
                            Delete Business
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
{{-- =========================================================
     REJECT BUSINESS MODAL
========================================================= --}}
@if($business->status === 'pending')

    <div class="modal fade"
         id="rejectBusinessModal"
         tabindex="-1"
         aria-labelledby="rejectBusinessModalLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow">

                <div class="modal-header">

                    <h5 class="modal-title fw-bold"
                        id="rejectBusinessModalLabel">

                        <i class="bi bi-x-circle text-danger me-2"></i>
                        Reject Business

                    </h5>

                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>

                </div>


                <form action="{{ route('admin.businesses.reject', $business) }}"
                      method="POST">

                    @csrf

                    <div class="modal-body">

                        <div class="alert alert-danger small">

                            <i class="bi bi-exclamation-triangle me-1"></i>

                            Please provide a reason for rejecting this business.
                            The business owner will be able to see this feedback.

                        </div>


                        <div class="mb-3">

                            <label for="admin_notes"
                                   class="form-label fw-semibold">

                                Rejection Reason
                                <span class="text-danger">*</span>

                            </label>

                            <textarea
                                name="admin_notes"
                                id="admin_notes"
                                rows="5"
                                class="form-control @error('admin_notes') is-invalid @enderror"
                                placeholder="Enter the reason for rejecting this business..."
                                required>{{ old('admin_notes') }}</textarea>


                            @error('admin_notes')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                            <div class="form-text">
                                This message will be visible to the business owner.
                            </div>

                        </div>

                    </div>


                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-light border"
                                data-bs-dismiss="modal">

                            Cancel

                        </button>


                        <button type="submit"
                                class="btn btn-danger">

                            <i class="bi bi-x-circle me-1"></i>
                            Reject Business

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endif
@endsection
