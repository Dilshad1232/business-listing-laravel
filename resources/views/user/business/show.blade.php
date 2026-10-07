@extends('layouts.user.master')

@section('title', $business->name)

@section('content')

{{-- =========================================================
     PAGE HEADER
========================================================= --}}

<div class="section-header mt-0">

    <div>
        <h4>{{ $business->name }}</h4>

        <div class="business-location mt-1">
            Business Details
        </div>
    </div>

    <div class="d-flex gap-2">

        <a href="{{ route('user.businesses.index') }}"
           class="btn btn-sm btn-light border">

            <i class="bi bi-arrow-left me-1"></i>
            Back
        </a>

        <a href="{{ route('user.businesses.edit', $business) }}"
           class="btn btn-sm btn-primary">

            <i class="bi bi-pencil me-1"></i>
            Edit
        </a>

    </div>

</div>


{{-- =========================================================
     BUSINESS HERO
========================================================= --}}

<div class="content-card mb-4 overflow-hidden">

    {{-- Cover Image --}}

    @if($business->cover_image)

        <div style="
            height: 220px;
            background-image: url('{{ asset('storage/' . $business->cover_image) }}');
            background-size: cover;
            background-position: center;
        "></div>

    @else

        <div style="
            height: 180px;
            background: linear-gradient(135deg, #f58220, #ff9f43);
        "></div>

    @endif


    <div class="p-4">

        <div class="d-flex flex-wrap align-items-center gap-3">

            {{-- Logo --}}

            @if($business->logo)

                <img src="{{ asset('storage/' . $business->logo) }}"
                     alt="{{ $business->name }}"
                     style="
                        width:80px;
                        height:80px;
                        object-fit:cover;
                        border-radius:14px;
                        border:4px solid #fff;
                        box-shadow:0 3px 12px rgba(0,0,0,.12);
                        margin-top:-55px;
                     ">

            @else

                <div class="stat-icon icon-orange"
                     style="
                        width:80px;
                        height:80px;
                        font-size:30px;
                        border:4px solid #fff;
                        box-shadow:0 3px 12px rgba(0,0,0,.12);
                        margin-top:-55px;
                     ">

                    <i class="bi bi-buildings"></i>

                </div>

            @endif


            <div class="flex-grow-1">

                <div class="d-flex flex-wrap align-items-center gap-2">

                    <h5 class="mb-0">
                        {{ $business->name }}
                    </h5>


                    @if($business->status === 'approved')

                        <span class="status status-approved">
                            <i class="bi bi-check-circle-fill"></i>
                            Approved
                        </span>

                    @elseif($business->status === 'rejected')

                        <span class="status status-rejected">
                            <i class="bi bi-x-circle-fill"></i>
                            Rejected
                        </span>

                    @else

                        <span class="status status-pending">
                            <i class="bi bi-clock-fill"></i>
                            Pending
                        </span>

                    @endif

                </div>


                @if($business->tagline)

                    <div class="business-location mt-2">
                        {{ $business->tagline }}
                    </div>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     REJECTION / ADMIN NOTES
========================================================= --}}

@if($business->status === 'rejected' && $business->admin_notes)

    <div class="alert alert-danger mb-4">

        <div class="d-flex align-items-start gap-2">

            <i class="bi bi-exclamation-triangle-fill mt-1"></i>

            <div>

                <strong>Admin Feedback</strong>

                <div class="mt-1">
                    {!! nl2br(e($business->admin_notes)) !!}
                </div>

            </div>

        </div>

    </div>

@endif


{{-- =========================================================
     BUSINESS INFORMATION
========================================================= --}}

<div class="content-card mb-4">

    <div class="p-3 border-bottom">

        <div class="business-name">
            <i class="bi bi-info-circle me-2"></i>
            Business Information
        </div>

    </div>


    <div class="p-4">

        <div class="row g-4">

            <div class="col-md-6">

                <div class="business-location">
                    Category
                </div>

                <div class="business-name mt-1">
                    {{ $business->category->name ?? '—' }}
                </div>

            </div>


            <div class="col-md-6">

                <div class="business-location">
                    Subcategory
                </div>

                <div class="business-name mt-1">
                    {{ $business->subcategory->name ?? '—' }}
                </div>

            </div>


            <div class="col-md-6">

                <div class="business-location">
                    Slug
                </div>

                <div class="business-name mt-1">
                    {{ $business->slug ?? '—' }}
                </div>

            </div>


            <div class="col-md-6">

                <div class="business-location">
                    Rating
                </div>

                <div class="business-name mt-1">

                    @if($business->rating)

                        <i class="bi bi-star-fill text-warning"></i>
                        {{ number_format((float) $business->rating, 1) }}

                        <span class="business-location">
                            ({{ $business->reviews_count ?? 0 }} reviews)
                        </span>

                    @else
                        No ratings yet
                    @endif

                </div>

            </div>


            @if($business->description)

                <div class="col-12">

                    <div class="business-location">
                        Description
                    </div>

                    <div class="mt-2">
                        {!! nl2br(e($business->description)) !!}
                    </div>

                </div>

            @endif

        </div>

    </div>

</div>


{{-- =========================================================
     CONTACT INFORMATION
========================================================= --}}

<div class="content-card mb-4">

    <div class="p-3 border-bottom">

        <div class="business-name">
            <i class="bi bi-telephone me-2"></i>
            Contact Information
        </div>

    </div>


    <div class="p-4">

        <div class="row g-4">

            <div class="col-md-6">

                <div class="business-location">
                    Phone
                </div>

                <div class="business-name mt-1">

                    @if($business->phone)

                        <a href="tel:{{ $business->phone }}"
                           class="text-decoration-none">

                            {{ $business->phone }}

                        </a>

                    @else
                        —
                    @endif

                </div>

            </div>


            <div class="col-md-6">

                <div class="business-location">
                    Email
                </div>

                <div class="business-name mt-1">

                    @if($business->email)

                        <a href="mailto:{{ $business->email }}"
                           class="text-decoration-none">

                            {{ $business->email }}

                        </a>

                    @else
                        —
                    @endif

                </div>

            </div>


            <div class="col-12">

                <div class="business-location">
                    Website
                </div>

                <div class="business-name mt-1">

                    @if($business->website)

                        <a href="{{ $business->website }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="text-decoration-none">

                            {{ $business->website }}

                            <i class="bi bi-box-arrow-up-right ms-1"></i>

                        </a>

                    @else
                        —
                    @endif

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     LOCATION
========================================================= --}}

<div class="content-card mb-4">

    <div class="p-3 border-bottom">

        <div class="business-name">
            <i class="bi bi-geo-alt me-2"></i>
            Business Location
        </div>

    </div>


    <div class="p-4">

        <div class="row g-4">

            <div class="col-md-6">

                <div class="business-location">
                    Country
                </div>

                <div class="business-name mt-1">
                    {{ $business->country->name ?? '—' }}
                </div>

            </div>


            <div class="col-md-6">

                <div class="business-location">
                    State
                </div>

                <div class="business-name mt-1">
                    {{ $business->state->name ?? '—' }}
                </div>

            </div>


            <div class="col-md-6">

                <div class="business-location">
                    City
                </div>

                <div class="business-name mt-1">
                    {{ $business->city->name ?? '—' }}
                </div>

            </div>


            <div class="col-md-6">

                <div class="business-location">
                    Area
                </div>

                <div class="business-name mt-1">
                    {{ $business->area->name ?? '—' }}
                </div>

            </div>


            <div class="col-md-8">

                <div class="business-location">
                    Address
                </div>

                <div class="business-name mt-1">
                    {{ $business->address ?? '—' }}
                </div>

            </div>


            <div class="col-md-4">

                <div class="business-location">
                    Pincode
                </div>

                <div class="business-name mt-1">
                    {{ $business->pincode ?? '—' }}
                </div>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     BUSINESS HOURS
========================================================= --}}

@if($business->businessHours && $business->businessHours->count())

<div class="content-card mb-4">

    <div class="p-3 border-bottom">

        <div class="business-name">
            <i class="bi bi-clock me-2"></i>
            Business Hours
        </div>

    </div>


    <div class="p-4">

        <div class="row g-3">

            @foreach($business->businessHours as $hour)

                <div class="col-md-6">

                    <div class="d-flex justify-content-between align-items-center border rounded p-3">

                        <strong>
                            {{ $hour->day_name }}
                        </strong>


                        @if($hour->is_closed)

                            <span class="text-danger">
                                Closed
                            </span>

                        @elseif($hour->is_24_hours)

                            <span class="text-success">
                                Open 24 Hours
                            </span>

                        @else

                            <div class="text-end">

                                @if($hour->opening_time && $hour->closing_time)

                                    <div>
                                        {{ \Carbon\Carbon::parse($hour->opening_time)->format('h:i A') }}
                                        -
                                        {{ \Carbon\Carbon::parse($hour->closing_time)->format('h:i A') }}
                                    </div>

                                @endif


                                @if($hour->opening_time_2 && $hour->closing_time_2)

                                    <div class="business-location mt-1">

                                        {{ \Carbon\Carbon::parse($hour->opening_time_2)->format('h:i A') }}
                                        -
                                        {{ \Carbon\Carbon::parse($hour->closing_time_2)->format('h:i A') }}

                                    </div>

                                @endif

                            </div>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

@endif


{{-- =========================================================
     SERVICES
========================================================= --}}

@if($business->services && $business->services->count())

<div class="content-card mb-4">

    <div class="p-3 border-bottom">

        <div class="business-name">
            <i class="bi bi-briefcase me-2"></i>
            Services
        </div>

    </div>


    <div class="p-4">

        <div class="row g-4">

            @foreach($business->services as $service)

                <div class="col-md-6">

                    <div class="border rounded p-3 h-100">

                        <div class="d-flex justify-content-between gap-2">

                            <h6 class="mb-1">
                                {{ $service->name }}
                            </h6>

                            @if($service->price !== null)

                                <strong class="text-primary">
                                    ₹{{ number_format((float) $service->price, 2) }}
                                </strong>

                            @endif

                        </div>


                        @if($service->duration)

                            <div class="business-location mb-2">

                                <i class="bi bi-clock me-1"></i>
                                {{ $service->duration }}

                            </div>

                        @endif


                        @if($service->short_description)

                            <div class="mb-2">
                                {{ $service->short_description }}
                            </div>

                        @endif


                        @if($service->description)

                            <div class="business-location">

                                {!! nl2br(e($service->description)) !!}

                            </div>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

@endif


{{-- =========================================================
     GALLERY
========================================================= --}}

@if($business->photos && $business->photos->count())

<div class="content-card mb-4">

    <div class="p-3 border-bottom">

        <div class="business-name">
            <i class="bi bi-images me-2"></i>
            Business Gallery
        </div>

    </div>


    <div class="p-4">

        <div class="row g-3">

            @foreach($business->photos as $photo)

                <div class="col-6 col-md-4 col-lg-3">

                    <div class="border rounded overflow-hidden">

                        <img src="{{ asset('storage/' . $photo->image) }}"
                             alt="{{ $photo->caption ?? $business->name }}"
                             class="w-100"
                             style="
                                height:180px;
                                object-fit:cover;
                             ">


                        @if($photo->caption)

                            <div class="p-2 small">
                                {{ $photo->caption }}
                            </div>

                        @endif

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

@endif


{{-- =========================================================
     BOTTOM ACTIONS
========================================================= --}}

<div class="content-card">

    <div class="p-3">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">

            <div class="business-location">

                <i class="bi bi-info-circle me-1"></i>

                Last updated:
                {{ $business->updated_at?->format('d M Y, h:i A') ?? '—' }}

            </div>


            <div class="d-flex gap-2">

                <a href="{{ route('user.businesses.index') }}"
                   class="btn btn-sm btn-light border">

                    <i class="bi bi-arrow-left me-1"></i>
                    Back
                </a>


                <a href="{{ route('user.businesses.edit', $business) }}"
                   class="btn btn-sm btn-primary">

                    <i class="bi bi-pencil me-1"></i>
                    Edit Business

                </a>

            </div>

        </div>

    </div>

</div>


@endsection
