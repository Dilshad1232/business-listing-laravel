@extends('admin.layouts.master')

@section('title', 'Offers & Deals')

@section('content')

<div class="container-fluid py-4">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">

        <div>
            <h1 class="h3 fw-bold mb-1">
                Offers & Deals
            </h1>

            <p class="text-muted mb-0">
                Manage business offers, discounts and promotional deals.
            </p>
        </div>

        <a
            href="{{ route('admin.offers.create') }}"
            class="btn btn-primary d-inline-flex align-items-center gap-2"
        >
            <i class="bi bi-plus-lg"></i>
            Add Offer
        </a>

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}
    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2"
            role="alert"
        >

            <i class="bi bi-check-circle-fill"></i>

            <span>{{ session('success') }}</span>

            <button
                type="button"
                class="btn-close ms-auto"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- =========================================================
        FILTER CARD
    ========================================================== --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body p-4">

            <form
                action="{{ route('admin.offers.index') }}"
                method="GET"
            >

                <div class="row g-3">

                    {{-- SEARCH --}}
                    <div class="col-lg-4">

                        <label class="form-label fw-semibold">
                            Search
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-search"></i>
                            </span>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control"
                                placeholder="Offer, coupon or business..."
                            >

                        </div>

                    </div>


                    {{-- BUSINESS --}}
                    <div class="col-lg-3">

                        <label class="form-label fw-semibold">
                            Business
                        </label>

                        <select
                            name="business_id"
                            class="form-select"
                        >

                            <option value="">
                                All Businesses
                            </option>

                            @foreach($businesses as $business)

                                <option
                                    value="{{ $business->id }}"
                                    @selected(request('business_id') == $business->id)
                                >
                                    {{ $business->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- STATUS --}}
                    <div class="col-lg-2">

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
                                value="active"
                                @selected(request('status') === 'active')
                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                @selected(request('status') === 'inactive')
                            >
                                Inactive
                            </option>

                        </select>

                    </div>


                    {{-- FEATURED --}}
                    <div class="col-lg-2">

                        <label class="form-label fw-semibold">
                            Featured
                        </label>

                        <select
                            name="featured"
                            class="form-select"
                        >

                            <option value="">
                                All
                            </option>

                            <option
                                value="1"
                                @selected(request('featured') === '1')
                            >
                                Featured
                            </option>

                            <option
                                value="0"
                                @selected(request('featured') === '0')
                            >
                                Normal
                            </option>

                        </select>

                    </div>


                    {{-- BUTTONS --}}
                    <div class="col-lg-1 d-flex align-items-end gap-2">

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                            title="Apply Filters"
                        >
                            <i class="bi bi-funnel"></i>
                        </button>

                    </div>

                </div>


                {{-- CLEAR --}}
                @if(
                    request('search') ||
                    request('business_id') ||
                    request('status') ||
                    request('featured')
                )

                    <div class="mt-3">

                        <a
                            href="{{ route('admin.offers.index') }}"
                            class="btn btn-sm btn-light border"
                        >
                            <i class="bi bi-x-lg me-1"></i>
                            Clear Filters
                        </a>

                    </div>

                @endif

            </form>

        </div>

    </div>


    {{-- =========================================================
        SUMMARY
    ========================================================== --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body d-flex align-items-center gap-3">

                    <div
                        class="rounded-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary"
                        style="width:48px;height:48px;"
                    >
                        <i class="bi bi-ticket-perforated fs-4"></i>
                    </div>

                    <div>

                        <div class="text-muted small">
                            Total Offers
                        </div>

                        <div class="fs-4 fw-bold">
                            {{ $offers->total() }}
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body d-flex align-items-center gap-3">

                    <div
                        class="rounded-3 d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success"
                        style="width:48px;height:48px;"
                    >
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>

                    <div>

                        <div class="text-muted small">
                            Active Offers
                        </div>

                        <div class="fs-4 fw-bold">

                            {{ $offers->where('status', true)->count() }}

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body d-flex align-items-center gap-3">

                    <div
                        class="rounded-3 d-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning"
                        style="width:48px;height:48px;"
                    >
                        <i class="bi bi-star fs-4"></i>
                    </div>

                    <div>

                        <div class="text-muted small">
                            Featured Offers
                        </div>

                        <div class="fs-4 fw-bold">

                            {{ $offers->where('is_featured', true)->count() }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        OFFERS TABLE
    ========================================================== --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3 px-4">

            <div class="d-flex align-items-center justify-content-between">

                <div>

                    <h5 class="mb-1 fw-bold">
                        All Offers
                    </h5>

                    <p class="text-muted small mb-0">
                        Manage promotional offers and discounts.
                    </p>

                </div>

                <span class="badge text-bg-light border">
                    {{ $offers->total() }} Records
                </span>

            </div>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th class="px-4">
                            Offer
                        </th>

                        <th>
                            Business
                        </th>

                        <th>
                            Discount
                        </th>

                        <th>
                            Coupon
                        </th>

                        <th>
                            Validity
                        </th>

                        <th>
                            Status
                        </th>

                        <th class="text-end px-4">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($offers as $offer)

                        <tr>

                            {{-- OFFER --}}
                            <td class="px-4">

                                <div class="d-flex align-items-start gap-3">

                                    <div
                                        class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:46px;height:46px;"
                                    >

                                        <i class="bi bi-percent fs-5"></i>

                                    </div>

                                    <div>

                                        <div class="fw-semibold">

                                            {{ $offer->title }}

                                            @if($offer->is_featured)

                                                <span
                                                    class="badge bg-warning text-dark ms-1"
                                                    title="Featured"
                                                >
                                                    <i class="bi bi-star-fill"></i>
                                                </span>

                                            @endif

                                        </div>

                                        @if($offer->short_description)

                                            <div class="small text-muted mt-1">

                                                {{ \Illuminate\Support\Str::limit(
                                                    $offer->short_description,
                                                    65
                                                ) }}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- BUSINESS --}}
                            <td>

                                @if($offer->business)

                                    <a
                                        href="{{ route('businesses.show', $offer->business->slug) }}"
                                        target="_blank"
                                        class="text-decoration-none fw-medium"
                                    >
                                        {{ $offer->business->name }}
                                    </a>

                                @else

                                    <span class="text-muted">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- DISCOUNT --}}
                            <td>

                                @if($offer->discount_type === 'percentage')

                                    <span class="fw-bold text-primary">

                                        {{ rtrim(rtrim(number_format((float) $offer->discount_value, 2), '0'), '.') }}%

                                    </span>

                                @elseif($offer->discount_type === 'fixed')

                                    <span class="fw-bold text-primary">

                                        {{ number_format((float) $offer->discount_value, 2) }}

                                    </span>

                                @else

                                    <span class="text-muted">
                                        No Discount
                                    </span>

                                @endif

                            </td>


                            {{-- COUPON --}}
                            <td>

                                @if($offer->coupon_code)

                                    <span
                                        class="badge bg-light text-dark border font-monospace"
                                    >
                                        {{ $offer->coupon_code }}
                                    </span>

                                @else

                                    <span class="text-muted">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- VALIDITY --}}
                            <td>

                                <div class="small">

                                    @if($offer->starts_at)

                                        <div>
                                            <i class="bi bi-calendar-event me-1 text-muted"></i>

                                            {{ $offer->starts_at->format('d M Y') }}
                                        </div>

                                    @endif


                                    @if($offer->ends_at)

                                        <div class="text-muted mt-1">

                                            <i class="bi bi-calendar-check me-1"></i>

                                            {{ $offer->ends_at->format('d M Y') }}

                                        </div>

                                    @else

                                        <div class="text-muted">
                                            No expiry
                                        </div>

                                    @endif

                                </div>

                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if($offer->status)

                                    <span class="badge bg-success-subtle text-success border border-success-subtle">
                                        Active
                                    </span>

                                @else

                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            {{-- ACTIONS --}}
                            <td class="text-end px-4">

                                <div class="dropdown">

                                    <button
                                        type="button"
                                        class="btn btn-sm btn-light border"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                    >

                                        <i class="bi bi-three-dots-vertical"></i>

                                    </button>


                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">

                                        {{-- VIEW --}}
                                        <li>

                                            <a
                                                href="{{ route('admin.offers.show', $offer) }}"
                                                class="dropdown-item"
                                            >

                                                <i class="bi bi-eye me-2"></i>

                                                View

                                            </a>

                                        </li>


                                        {{-- EDIT --}}
                                        <li>

                                            <a
                                                href="{{ route('admin.offers.edit', $offer) }}"
                                                class="dropdown-item"
                                            >

                                                <i class="bi bi-pencil me-2"></i>

                                                Edit

                                            </a>

                                        </li>


                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>


                                        {{-- DELETE --}}
                                        <li>

                                            <form
                                                action="{{ route('admin.offers.destroy', $offer) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this offer?');"
                                            >

                                                @csrf

                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="dropdown-item text-danger"
                                                >

                                                    <i class="bi bi-trash me-2"></i>

                                                    Delete

                                                </button>

                                            </form>

                                        </li>

                                    </ul>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="text-center py-5"
                            >

                                <div
                                    class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center mx-auto mb-3"
                                    style="width:64px;height:64px;"
                                >

                                    <i class="bi bi-ticket-perforated fs-3"></i>

                                </div>


                                <h5 class="fw-bold mb-2">
                                    No Offers Found
                                </h5>


                                <p class="text-muted mb-3">
                                    No offers match your current filters.
                                </p>


                                <a
                                    href="{{ route('admin.offers.create') }}"
                                    class="btn btn-primary"
                                >

                                    <i class="bi bi-plus-lg me-1"></i>

                                    Create First Offer

                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =====================================================
            PAGINATION
        ====================================================== --}}
        @if($offers->hasPages())

            <div class="card-footer bg-white border-0 px-4 py-4">

                {{ $offers->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
