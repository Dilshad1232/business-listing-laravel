@extends('admin.layouts.master')

@section('title', 'Bookings')

@section('content')

<div class="container-fluid py-3">


{{-- Page Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h4 class="mb-1">Bookings</h4>

        <p class="text-muted mb-0">
            Manage all appointment bookings from your directory.
        </p>
    </div>

</div>


{{-- Success Message --}}
@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


{{-- Validation Errors --}}
@if($errors->any())

    <div class="alert alert-danger">

        <ul class="mb-0">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif


{{-- Statistics --}}
<div class="row g-3 mb-4">

    <div class="col-md-6 col-xl">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <small class="text-muted">
                            Total Bookings
                        </small>

                        <h4 class="mb-0 mt-1">
                            {{ $stats['total'] }}
                        </h4>
                    </div>

                    <div class="rounded-3 bg-primary bg-opacity-10
                                text-primary d-flex align-items-center
                                justify-content-center"
                         style="width:45px;height:45px;">

                        <i class="bi bi-calendar-check fs-5"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-xl">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <small class="text-muted">
                            Pending
                        </small>

                        <h4 class="mb-0 mt-1">
                            {{ $stats['pending'] }}
                        </h4>
                    </div>

                    <div class="rounded-3 bg-warning bg-opacity-10
                                text-warning d-flex align-items-center
                                justify-content-center"
                         style="width:45px;height:45px;">

                        <i class="bi bi-hourglass-split fs-5"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-xl">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <small class="text-muted">
                            Confirmed
                        </small>

                        <h4 class="mb-0 mt-1">
                            {{ $stats['confirmed'] }}
                        </h4>
                    </div>

                    <div class="rounded-3 bg-info bg-opacity-10
                                text-info d-flex align-items-center
                                justify-content-center"
                         style="width:45px;height:45px;">

                        <i class="bi bi-check-circle fs-5"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-xl">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <small class="text-muted">
                            Completed
                        </small>

                        <h4 class="mb-0 mt-1">
                            {{ $stats['completed'] }}
                        </h4>
                    </div>

                    <div class="rounded-3 bg-success bg-opacity-10
                                text-success d-flex align-items-center
                                justify-content-center"
                         style="width:45px;height:45px;">

                        <i class="bi bi-check2-all fs-5"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-md-6 col-xl">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <small class="text-muted">
                            Cancelled
                        </small>

                        <h4 class="mb-0 mt-1">
                            {{ $stats['cancelled'] }}
                        </h4>
                    </div>

                    <div class="rounded-3 bg-danger bg-opacity-10
                                text-danger d-flex align-items-center
                                justify-content-center"
                         style="width:45px;height:45px;">

                        <i class="bi bi-x-circle fs-5"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- Filters --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white border-bottom">

        <strong>
            Filter Bookings
        </strong>

    </div>


    <div class="card-body">

        <form
            action="{{ route('admin.bookings.index') }}"
            method="GET"
        >

            <div class="row g-3">


                {{-- Search --}}
                <div class="col-md-4">

                    <label class="form-label">
                        Search
                    </label>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Customer, phone, email or business..."
                    >

                </div>


                {{-- Status --}}
                <div class="col-md-2">

                    <label class="form-label">
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
                            value="confirmed"
                            @selected(request('status') === 'confirmed')
                        >
                            Confirmed
                        </option>

                        <option
                            value="completed"
                            @selected(request('status') === 'completed')
                        >
                            Completed
                        </option>

                        <option
                            value="cancelled"
                            @selected(request('status') === 'cancelled')
                        >
                            Cancelled
                        </option>

                    </select>

                </div>


                {{-- Booking Date --}}
                <div class="col-md-2">

                    <label class="form-label">
                        Booking Date
                    </label>

                    <input
                        type="date"
                        name="booking_date"
                        value="{{ request('booking_date') }}"
                        class="form-control"
                    >

                </div>


                {{-- Sort --}}
                <div class="col-md-2">

                    <label class="form-label">
                        Sort
                    </label>

                    <select
                        name="sort"
                        class="form-select"
                    >

                        <option value="">
                            Latest
                        </option>

                        <option
                            value="oldest"
                            @selected(request('sort') === 'oldest')
                        >
                            Oldest
                        </option>

                        <option
                            value="date_asc"
                            @selected(request('sort') === 'date_asc')
                        >
                            Date: Oldest
                        </option>

                        <option
                            value="date_desc"
                            @selected(request('sort') === 'date_desc')
                        >
                            Date: Newest
                        </option>

                        <option
                            value="amount_high"
                            @selected(request('sort') === 'amount_high')
                        >
                            Amount: High to Low
                        </option>

                        <option
                            value="amount_low"
                            @selected(request('sort') === 'amount_low')
                        >
                            Amount: Low to High
                        </option>

                    </select>

                </div>


                {{-- Buttons --}}
                <div class="col-md-2 d-flex align-items-end gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-funnel me-1"></i>

                        Filter

                    </button>


                    <a
                        href="{{ route('admin.bookings.index') }}"
                        class="btn btn-outline-secondary"
                        title="Reset"
                    >

                        <i class="bi bi-arrow-counterclockwise"></i>

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>


{{-- Booking Table --}}
<div class="card border-0 shadow-sm">

    <div class="card-header bg-white border-bottom">

        <div class="d-flex justify-content-between align-items-center">

            <strong>
                All Bookings
            </strong>

            <span class="text-muted small">
                {{ $bookings->total() }} booking(s)
            </span>

        </div>

    </div>


    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>Sr.</th>

                        <th>Customer</th>

                        <th>Business</th>

                        <th>Service</th>

                        <th>Booking Date</th>

                        <th>Amount</th>

                        <th>Offer</th>

                        <th>Status</th>

                        <th width="100">Actions</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($bookings as $booking)

                        <tr>

                            {{-- Sr --}}
                            <td>
                                {{ $bookings->firstItem() + $loop->index }}
                            </td>


                            {{-- Customer --}}
                            <td>

                                <div class="fw-semibold">
                                    {{ $booking->customer_name }}
                                </div>

                                @if($booking->customer_email)

                                    <small class="text-muted d-block">
                                        {{ $booking->customer_email }}
                                    </small>

                                @endif

                                <small class="text-muted">
                                    {{ $booking->customer_phone }}
                                </small>

                            </td>


                            {{-- Business --}}
                            <td>

                                <div class="fw-semibold">
                                    {{ $booking->business?->name ?? 'N/A' }}
                                </div>

                                @if($booking->business?->city)

                                    <small class="text-muted">
                                        {{ $booking->business->city->name }}
                                    </small>

                                @endif

                            </td>


                            {{-- Service --}}
                            <td>

                                {{ $booking->businessService?->name ?? 'N/A' }}

                            </td>


                            {{-- Booking Date --}}
                            <td>

                                <div class="fw-semibold">

                                    {{ $booking->booking_date?->format('d M Y') }}

                                </div>

                                <small class="text-muted">

                                    {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}

                                </small>

                            </td>


                            {{-- Amount --}}
                            <td>

                                @if($booking->discount_amount > 0)

                                    <small class="text-muted text-decoration-line-through d-block">

                                        ₹{{ number_format((float) $booking->original_amount, 2) }}

                                    </small>

                                @endif

                                <span class="fw-semibold">

                                    ₹{{ number_format((float) $booking->final_amount, 2) }}

                                </span>

                            </td>


                            {{-- Offer --}}
                            <td>

                                @if($booking->offer)

                                    <div class="fw-semibold">

                                        {{ $booking->offer->title }}

                                    </div>

                                    @if($booking->offer->coupon_code)

                                        <small class="text-primary">

                                            {{ $booking->offer->coupon_code }}

                                        </small>

                                    @endif

                                @else

                                    <span class="text-muted">
                                        No Offer
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td>

                                @if($booking->status === 'pending')

                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>

                                @elseif($booking->status === 'confirmed')

                                    <span class="badge bg-primary">
                                        Confirmed
                                    </span>

                                @elseif($booking->status === 'completed')

                                    <span class="badge bg-success">
                                        Completed
                                    </span>

                                @elseif($booking->status === 'cancelled')

                                    <span class="badge bg-danger">
                                        Cancelled
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        {{ ucfirst($booking->status) }}
                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td>

                                <div class="d-flex gap-1">

                                    <a
                                        href="{{ route('admin.bookings.show', $booking) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="View"
                                    >

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    <form
                                        action="{{ route('admin.bookings.destroy', $booking) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this booking?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Delete"
                                        >

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="9"
                                class="text-center py-5"
                            >

                                <div class="text-muted">

                                    <i class="bi bi-calendar-x fs-1 d-block mb-2"></i>

                                    <div class="fw-semibold">
                                        No bookings found
                                    </div>

                                    <small>
                                        Booking requests will appear here.
                                    </small>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Pagination --}}
    @if($bookings->hasPages())

        <div class="card-footer bg-white">

            {{ $bookings->links() }}

        </div>

    @endif

</div>

</div>

@endsection
