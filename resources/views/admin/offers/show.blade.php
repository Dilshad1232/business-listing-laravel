@extends('admin.layouts.master')

@section('title', 'Offer Details')

@section('content')

<div class="container-fluid py-4">


{{-- =========================================================
    PAGE HEADER
========================================================== --}}
<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">

    <div>

        <div class="d-flex align-items-center gap-2 mb-1">

            <a
                href="{{ route('admin.offers.index') }}"
                class="text-decoration-none text-muted"
            >
                <i class="bi bi-arrow-left"></i>
            </a>

            <h1 class="h3 fw-bold mb-0">
                Offer Details
            </h1>

        </div>

        <p class="text-muted mb-0">
            View complete information about this offer.
        </p>

    </div>


    <div class="d-flex flex-wrap gap-2">

        <a
            href="{{ route('admin.offers.edit', $offer) }}"
            class="btn btn-primary"
        >
            <i class="bi bi-pencil-square me-1"></i>
            Edit Offer
        </a>

        <a
            href="{{ route('admin.offers.index') }}"
            class="btn btn-light border"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Back
        </a>

    </div>

</div>


{{-- =========================================================
    OFFER HERO
========================================================== --}}
<div class="card border-0 shadow-sm overflow-hidden mb-4">

    <div
        class="p-4 p-lg-5 text-white"
        style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);"
    >

        <div class="row align-items-center g-4">

            <div class="col-lg-8">

                <div class="d-flex flex-wrap gap-2 mb-3">

                    @if($offer->is_featured)

                        <span class="badge bg-warning text-dark px-3 py-2">
                            <i class="bi bi-star-fill me-1"></i>
                            Featured
                        </span>

                    @endif


                    @if($offer->status)

                        <span class="badge bg-success px-3 py-2">
                            <i class="bi bi-check-circle-fill me-1"></i>
                            Active
                        </span>

                    @else

                        <span class="badge bg-secondary px-3 py-2">
                            <i class="bi bi-pause-circle-fill me-1"></i>
                            Inactive
                        </span>

                    @endif

                </div>


                <h2 class="fw-bold mb-2">
                    {{ $offer->title }}
                </h2>


                @if($offer->business)

                    <div class="d-flex align-items-center gap-2 opacity-75">

                        <i class="bi bi-building"></i>

                        <span>
                            {{ $offer->business->name }}
                        </span>

                    </div>

                @endif

            </div>


            <div class="col-lg-4 text-lg-end">

                @if($offer->discount_type !== 'none' && $offer->discount_value)

                    <div class="display-5 fw-bold">

                        @if($offer->discount_type === 'percentage')

                            {{ rtrim(rtrim(number_format($offer->discount_value, 2), '0'), '.') }}%

                        @else

                            ₹{{ number_format($offer->discount_value, 2) }}

                        @endif

                    </div>

                    <div class="opacity-75">
                        Discount
                    </div>

                @else

                    <div class="display-6 fw-bold">
                        Special Offer
                    </div>

                @endif

            </div>

        </div>

    </div>

</div>


<div class="row g-4">

    {{-- =====================================================
        LEFT CONTENT
    ====================================================== --}}
    <div class="col-xl-8">


        {{-- =================================================
            BASIC INFORMATION
        ================================================== --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-0 px-4 py-3">

                <div class="d-flex align-items-center gap-2">

                    <div
                        class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                        style="width:42px;height:42px;"
                    >
                        <i class="bi bi-info-circle fs-5"></i>
                    </div>

                    <div>

                        <h5 class="fw-bold mb-0">
                            Offer Information
                        </h5>

                        <small class="text-muted">
                            Basic information about this offer.
                        </small>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                @if($offer->short_description)

                    <div class="mb-4">

                        <label class="text-muted small fw-semibold mb-1 d-block">
                            Short Description
                        </label>

                        <p class="mb-0">
                            {{ $offer->short_description }}
                        </p>

                    </div>

                @endif


                <div>

                    <label class="text-muted small fw-semibold mb-2 d-block">
                        Full Description
                    </label>

                    <div class="text-secondary" style="white-space: pre-line;">
                        {{ $offer->description ?: 'No description available.' }}
                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
            DISCOUNT DETAILS
        ================================================== --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-0 px-4 py-3">

                <div class="d-flex align-items-center gap-2">

                    <div
                        class="rounded-3 bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center"
                        style="width:42px;height:42px;"
                    >
                        <i class="bi bi-percent fs-5"></i>
                    </div>

                    <div>

                        <h5 class="fw-bold mb-0">
                            Discount Details
                        </h5>

                        <small class="text-muted">
                            Pricing and coupon information.
                        </small>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-4">


                    {{-- DISCOUNT TYPE --}}
                    <div class="col-md-4">

                        <div class="text-muted small mb-1">
                            Discount Type
                        </div>

                        <div class="fw-semibold">

                            @if($offer->discount_type === 'percentage')

                                Percentage

                            @elseif($offer->discount_type === 'fixed')

                                Fixed Amount

                            @else

                                No Discount

                            @endif

                        </div>

                    </div>


                    {{-- DISCOUNT VALUE --}}
                    <div class="col-md-4">

                        <div class="text-muted small mb-1">
                            Discount Value
                        </div>

                        <div class="fw-bold text-success">

                            @if($offer->discount_type === 'percentage' && $offer->discount_value)

                                {{ rtrim(rtrim(number_format($offer->discount_value, 2), '0'), '.') }}%

                            @elseif($offer->discount_type === 'fixed' && $offer->discount_value)

                                ₹{{ number_format($offer->discount_value, 2) }}

                            @else

                                —

                            @endif

                        </div>

                    </div>


                    {{-- COUPON --}}
                    <div class="col-md-4">

                        <div class="text-muted small mb-1">
                            Coupon Code
                        </div>

                        @if($offer->coupon_code)

                            <span class="badge bg-dark px-3 py-2">
                                <i class="bi bi-ticket-perforated me-1"></i>
                                {{ $offer->coupon_code }}
                            </span>

                        @else

                            <span class="text-muted">
                                No coupon
                            </span>

                        @endif

                    </div>


                    {{-- MINIMUM PURCHASE --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">
                            Minimum Purchase
                        </div>

                        <div class="fw-semibold">

                            @if($offer->minimum_purchase !== null)

                                ₹{{ number_format($offer->minimum_purchase, 2) }}

                            @else

                                —

                            @endif

                        </div>

                    </div>


                    {{-- MAXIMUM DISCOUNT --}}
                    <div class="col-md-6">

                        <div class="text-muted small mb-1">
                            Maximum Discount
                        </div>

                        <div class="fw-semibold">

                            @if($offer->maximum_discount !== null)

                                ₹{{ number_format($offer->maximum_discount, 2) }}

                            @else

                                —

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
            TERMS
        ================================================== --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-0 px-4 py-3">

                <div class="d-flex align-items-center gap-2">

                    <div
                        class="rounded-3 bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center"
                        style="width:42px;height:42px;"
                    >
                        <i class="bi bi-file-text fs-5"></i>
                    </div>

                    <div>

                        <h5 class="fw-bold mb-0">
                            Terms & Conditions
                        </h5>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                @if($offer->terms_conditions)

                    <div
                        class="text-secondary"
                        style="white-space: pre-line;"
                    >
                        {{ $offer->terms_conditions }}
                    </div>

                @else

                    <div class="text-muted">
                        No terms and conditions have been added.
                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- =====================================================
        RIGHT SIDEBAR
    ====================================================== --}}
    <div class="col-xl-4">


        {{-- =================================================
            BUSINESS
        ================================================== --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-0 px-4 py-3">

                <h5 class="fw-bold mb-0">
                    <i class="bi bi-building me-2 text-primary"></i>
                    Business
                </h5>

            </div>


            <div class="card-body p-4">

                @if($offer->business)

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center flex-shrink-0"
                            style="width:52px;height:52px;"
                        >
                            <i class="bi bi-building fs-5"></i>
                        </div>

                        <div class="min-w-0">

                            <div class="fw-semibold text-truncate">
                                {{ $offer->business->name }}
                            </div>

                            @if($offer->business->city)

                                <div class="text-muted small mt-1">

                                    <i class="bi bi-geo-alt me-1"></i>

                                    {{ $offer->business->city->name }}

                                </div>

                            @endif

                        </div>

                    </div>

                @else

                    <div class="text-muted">
                        Business information unavailable.
                    </div>

                @endif

            </div>

        </div>


        {{-- =================================================
            VALIDITY
        ================================================== --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-0 px-4 py-3">

                <h5 class="fw-bold mb-0">
                    <i class="bi bi-calendar-event me-2 text-warning"></i>
                    Validity
                </h5>

            </div>


            <div class="card-body p-4">

                <div class="mb-3">

                    <div class="text-muted small mb-1">
                        Starts At
                    </div>

                    <div class="fw-semibold">

                        @if($offer->starts_at)

                            <i class="bi bi-calendar-check me-1 text-success"></i>

                            {{ $offer->starts_at->format('d M Y, h:i A') }}

                        @else

                            No start date

                        @endif

                    </div>

                </div>


                <div>

                    <div class="text-muted small mb-1">
                        Ends At
                    </div>

                    <div class="fw-semibold">

                        @if($offer->ends_at)

                            <i class="bi bi-calendar-x me-1 text-danger"></i>

                            {{ $offer->ends_at->format('d M Y, h:i A') }}

                        @else

                            No expiry date

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
            OFFER STATUS
        ================================================== --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-0 px-4 py-3">

                <h5 class="fw-bold mb-0">
                    <i class="bi bi-sliders me-2 text-primary"></i>
                    Offer Status
                </h5>

            </div>


            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <span class="text-muted">
                        Status
                    </span>

                    @if($offer->status)

                        <span class="badge bg-success-subtle text-success px-3 py-2">
                            Active
                        </span>

                    @else

                        <span class="badge bg-secondary-subtle text-secondary px-3 py-2">
                            Inactive
                        </span>

                    @endif

                </div>


                <div class="d-flex justify-content-between align-items-center mb-3">

                    <span class="text-muted">
                        Featured
                    </span>

                    @if($offer->is_featured)

                        <span class="badge bg-warning-subtle text-warning px-3 py-2">
                            <i class="bi bi-star-fill me-1"></i>
                            Yes
                        </span>

                    @else

                        <span class="badge bg-light text-muted border px-3 py-2">
                            No
                        </span>

                    @endif

                </div>


                <div class="d-flex justify-content-between align-items-center">

                    <span class="text-muted">
                        Sort Order
                    </span>

                    <span class="fw-semibold">
                        {{ $offer->sort_order ?? 0 }}
                    </span>

                </div>

            </div>

        </div>


        {{-- =================================================
            RECORD INFORMATION
        ================================================== --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-0 px-4 py-3">

                <h5 class="fw-bold mb-0">
                    <i class="bi bi-clock-history me-2 text-secondary"></i>
                    Record Information
                </h5>

            </div>


            <div class="card-body p-4">

                <div class="mb-3">

                    <div class="text-muted small mb-1">
                        Offer ID
                    </div>

                    <div class="fw-semibold">
                        #{{ $offer->id }}
                    </div>

                </div>


                <div class="mb-3">

                    <div class="text-muted small mb-1">
                        Created
                    </div>

                    <div class="fw-semibold">

                        {{ $offer->created_at?->format('d M Y, h:i A') ?? '—' }}

                    </div>

                </div>


                <div>

                    <div class="text-muted small mb-1">
                        Last Updated
                    </div>

                    <div class="fw-semibold">

                        {{ $offer->updated_at?->format('d M Y, h:i A') ?? '—' }}

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
            DELETE
        ================================================== --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <h6 class="fw-bold mb-2">
                    Delete Offer
                </h6>

                <p class="text-muted small mb-3">
                    Once deleted, this offer cannot be recovered.
                </p>

                <form
                    action="{{ route('admin.offers.destroy', $offer) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this offer?');"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-outline-danger w-100"
                    >

                        <i class="bi bi-trash me-1"></i>

                        Delete Offer

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>


</div>

@endsection
