@extends('admin.layouts.master')

@section('title', 'Edit Offer')

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
                    Edit Offer
                </h1>

            </div>

            <p class="text-muted mb-0">
                Update offer details, discount and validity settings.
            </p>

        </div>


        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.offers.show', $offer) }}"
                class="btn btn-light border"
            >
                <i class="bi bi-eye me-1"></i>
                View
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
        VALIDATION ERRORS
    ========================================================== --}}
    @if($errors->any())

        <div class="alert alert-danger border-0 shadow-sm">

            <div class="d-flex align-items-start gap-2">

                <i class="bi bi-exclamation-triangle-fill mt-1"></i>

                <div>

                    <div class="fw-semibold mb-1">
                        Please fix the following errors:
                    </div>

                    <ul class="mb-0 ps-3">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    <form
        action="{{ route('admin.offers.update', $offer) }}"
        method="POST"
    >

        @csrf

        @method('PUT')


        {{-- =====================================================
            BASIC INFORMATION
        ====================================================== --}}
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
                            Basic Information
                        </h5>

                        <small class="text-muted">
                            Update the business and offer information.
                        </small>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-4">

                    {{-- BUSINESS --}}
                    <div class="col-lg-6">

                        <label class="form-label fw-semibold">
                            Business <span class="text-danger">*</span>
                        </label>

                        <select
                            name="business_id"
                            class="form-select @error('business_id') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                Select Business
                            </option>

                            @foreach($businesses as $business)

                                <option
                                    value="{{ $business->id }}"
                                    @selected(old('business_id', $offer->business_id) == $business->id)
                                >
                                    {{ $business->name }}
                                </option>

                            @endforeach

                        </select>

                        @error('business_id')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- TITLE --}}
                    <div class="col-lg-6">

                        <label class="form-label fw-semibold">
                            Offer Title <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $offer->title) }}"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="e.g. 20% Off on Web Development"
                            required
                        >

                        @error('title')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- SLUG --}}
                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Slug
                        </label>

                        <input
                            type="text"
                            name="slug"
                            value="{{ old('slug', $offer->slug) }}"
                            class="form-control @error('slug') is-invalid @enderror"
                            placeholder="20-off-on-web-development"
                        >

                        <div class="form-text">
                            Keep the existing slug or update it if required.
                        </div>

                        @error('slug')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- SHORT DESCRIPTION --}}
                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Short Description
                        </label>

                        <textarea
                            name="short_description"
                            rows="3"
                            class="form-control @error('short_description') is-invalid @enderror"
                            placeholder="Write a short summary of this offer..."
                        >{{ old('short_description', $offer->short_description) }}</textarea>

                        @error('short_description')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- DESCRIPTION --}}
                    <div class="col-12">

                        <label class="form-label fw-semibold">
                            Full Description
                        </label>

                        <textarea
                            name="description"
                            rows="6"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Describe the offer in detail..."
                        >{{ old('description', $offer->description) }}</textarea>

                        @error('description')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            DISCOUNT DETAILS
        ====================================================== --}}
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
                            Update the discount and coupon settings.
                        </small>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-4">

                    {{-- DISCOUNT TYPE --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Discount Type <span class="text-danger">*</span>
                        </label>

                        <select
                            name="discount_type"
                            id="offerDiscountType"
                            class="form-select @error('discount_type') is-invalid @enderror"
                            required
                        >

                            <option
                                value="percentage"
                                @selected(old('discount_type', $offer->discount_type) === 'percentage')
                            >
                                Percentage (%)
                            </option>

                            <option
                                value="fixed"
                                @selected(old('discount_type', $offer->discount_type) === 'fixed')
                            >
                                Fixed Amount
                            </option>

                            <option
                                value="none"
                                @selected(old('discount_type', $offer->discount_type) === 'none')
                            >
                                No Discount
                            </option>

                        </select>

                        @error('discount_type')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- DISCOUNT VALUE --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Discount Value
                        </label>

                        <div class="input-group">

                            <span
                                class="input-group-text"
                                id="offerDiscountPrefix"
                            >
                                %
                            </span>

                            <input
                                type="number"
                                name="discount_value"
                                id="offerDiscountValue"
                                value="{{ old('discount_value', $offer->discount_value) }}"
                                min="0"
                                step="0.01"
                                class="form-control @error('discount_value') is-invalid @enderror"
                                placeholder="20"
                            >

                        </div>

                        @error('discount_value')

                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- MINIMUM PURCHASE --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Minimum Purchase
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                ₹
                            </span>

                            <input
                                type="number"
                                name="minimum_purchase"
                                value="{{ old('minimum_purchase', $offer->minimum_purchase) }}"
                                min="0"
                                step="0.01"
                                class="form-control @error('minimum_purchase') is-invalid @enderror"
                                placeholder="1000"
                            >

                        </div>

                        @error('minimum_purchase')

                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- MAXIMUM DISCOUNT --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Maximum Discount
                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                ₹
                            </span>

                            <input
                                type="number"
                                name="maximum_discount"
                                value="{{ old('maximum_discount', $offer->maximum_discount) }}"
                                min="0"
                                step="0.01"
                                class="form-control @error('maximum_discount') is-invalid @enderror"
                                placeholder="5000"
                            >

                        </div>

                        <div class="form-text">
                            Useful for percentage-based offers.
                        </div>

                        @error('maximum_discount')

                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- COUPON --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Coupon Code
                        </label>

                        <input
                            type="text"
                            name="coupon_code"
                            value="{{ old('coupon_code', $offer->coupon_code) }}"
                            class="form-control text-uppercase @error('coupon_code') is-invalid @enderror"
                            placeholder="SAVE20"
                        >

                        <div class="form-text">
                            Coupon codes are automatically stored in uppercase.
                        </div>

                        @error('coupon_code')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            VALIDITY
        ====================================================== --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-0 px-4 py-3">

                <div class="d-flex align-items-center gap-2">

                    <div
                        class="rounded-3 bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center"
                        style="width:42px;height:42px;"
                    >
                        <i class="bi bi-calendar-event fs-5"></i>
                    </div>

                    <div>

                        <h5 class="fw-bold mb-0">
                            Offer Validity
                        </h5>

                        <small class="text-muted">
                            Set the start and expiry date of the offer.
                        </small>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-4">

                    {{-- START --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Starts At
                        </label>

                        <input
                            type="datetime-local"
                            name="starts_at"
                            value="{{ old(
                                'starts_at',
                                $offer->starts_at
                                    ? $offer->starts_at->format('Y-m-d\TH:i')
                                    : ''
                            ) }}"
                            class="form-control @error('starts_at') is-invalid @enderror"
                        >

                        @error('starts_at')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- END --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Ends At
                        </label>

                        <input
                            type="datetime-local"
                            name="ends_at"
                            value="{{ old(
                                'ends_at',
                                $offer->ends_at
                                    ? $offer->ends_at->format('Y-m-d\TH:i')
                                    : ''
                            ) }}"
                            class="form-control @error('ends_at') is-invalid @enderror"
                        >

                        @error('ends_at')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            TERMS & CONDITIONS
        ====================================================== --}}
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

                        <small class="text-muted">
                            Update the rules and conditions for this offer.
                        </small>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <textarea
                    name="terms_conditions"
                    rows="6"
                    class="form-control @error('terms_conditions') is-invalid @enderror"
                    placeholder="Enter offer terms and conditions..."
                >{{ old('terms_conditions', $offer->terms_conditions) }}</textarea>

                @error('terms_conditions')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>

        </div>


        {{-- =====================================================
            DISPLAY SETTINGS
        ====================================================== --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-0 px-4 py-3">

                <div class="d-flex align-items-center gap-2">

                    <div
                        class="rounded-3 bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center"
                        style="width:42px;height:42px;"
                    >
                        <i class="bi bi-sliders fs-5"></i>
                    </div>

                    <div>

                        <h5 class="fw-bold mb-0">
                            Display Settings
                        </h5>

                        <small class="text-muted">
                            Control visibility and ordering.
                        </small>

                    </div>

                </div>

            </div>


            <div class="card-body p-4">

                <div class="row g-4">

                    {{-- SORT ORDER --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold">
                            Sort Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            value="{{ old('sort_order', $offer->sort_order ?? 0) }}"
                            min="0"
                            class="form-control @error('sort_order') is-invalid @enderror"
                            placeholder="0"
                        >

                        <div class="form-text">
                            Lower numbers appear first.
                        </div>

                        @error('sort_order')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- FEATURED --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold d-block">
                            Featured Offer
                        </label>

                        <div class="form-check form-switch mt-2">

                            <input
                                type="hidden"
                                name="is_featured"
                                value="0"
                            >

                            <input
                                class="form-check-input"
                                type="checkbox"
                                role="switch"
                                name="is_featured"
                                value="1"
                                id="isFeatured"
                                @checked(old('is_featured', $offer->is_featured))
                            >

                            <label
                                class="form-check-label"
                                for="isFeatured"
                            >
                                Show as featured
                            </label>

                        </div>

                    </div>


                    {{-- STATUS --}}
                    <div class="col-md-4">

                        <label class="form-label fw-semibold d-block">
                            Status
                        </label>

                        <div class="form-check form-switch mt-2">

                            <input
                                type="hidden"
                                name="status"
                                value="0"
                            >

                            <input
                                class="form-check-input"
                                type="checkbox"
                                role="switch"
                                name="status"
                                value="1"
                                id="offerStatus"
                                @checked(old('status', $offer->status))
                            >

                            <label
                                class="form-check-label"
                                for="offerStatus"
                            >
                                Active
                            </label>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            UPDATE BAR
        ====================================================== --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">

                    <div class="text-muted small">

                        <i class="bi bi-clock-history me-1"></i>

                        Last updated:
                        {{ $offer->updated_at?->format('d M Y, h:i A') ?? '—' }}

                    </div>


                    <div class="d-flex gap-2">

                        <a
                            href="{{ route('admin.offers.index') }}"
                            class="btn btn-light border px-4"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary px-4"
                        >

                            <i class="bi bi-check-lg me-1"></i>

                            Update Offer

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>


{{-- =============================================================
    DISCOUNT TYPE SCRIPT
============================================================= --}}
@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    const discountType = document.getElementById('offerDiscountType');
    const discountValue = document.getElementById('offerDiscountValue');
    const discountPrefix = document.getElementById('offerDiscountPrefix');

    function updateDiscountField() {

        if (!discountType || !discountValue || !discountPrefix) {
            return;
        }

        if (discountType.value === 'percentage') {

            discountPrefix.textContent = '%';

            discountValue.placeholder = '20';

            discountValue.disabled = false;

        } else if (discountType.value === 'fixed') {

            discountPrefix.textContent = '₹';

            discountValue.placeholder = '500';

            discountValue.disabled = false;

        } else {

            discountPrefix.textContent = '—';

            discountValue.value = '';

            discountValue.placeholder = 'Not applicable';

            discountValue.disabled = true;

        }

    }

    discountType.addEventListener(
        'change',
        updateDiscountField
    );

    updateDiscountField();

});

</script>

@endpush

@endsection
