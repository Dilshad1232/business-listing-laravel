@extends('admin.layouts.master')

@section('title', 'Booking Details')

@section('content')

<div class="container-fluid py-3">


{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">
            Booking Details
        </h4>

        <p class="text-muted mb-0">
            View and manage booking information.
        </p>

    </div>

    <a
        href="{{ route('admin.bookings.index') }}"
        class="btn btn-outline-secondary"
    >

        <i class="bi bi-arrow-left me-1"></i>

        Back to Bookings

    </a>

</div>


{{-- Success --}}
@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


{{-- Errors --}}
@if($errors->any())

    <div class="alert alert-danger">

        <ul class="mb-0">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif


<div class="row g-4">


    {{-- Left --}}
    <div class="col-lg-8">


        {{-- Booking Information --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-bottom">

                <div class="d-flex justify-content-between align-items-center">

                    <strong>
                        Booking Information
                    </strong>

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

                </div>

            </div>


            <div class="card-body">

                <div class="row g-4">


                    {{-- Customer --}}
                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Customer Name
                        </small>

                        <div class="fw-semibold">
                            {{ $booking->customer_name }}
                        </div>

                    </div>


                    {{-- Phone --}}
                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Phone
                        </small>

                        <div class="fw-semibold">

                            <a
                                href="tel:{{ $booking->customer_phone }}"
                                class="text-decoration-none"
                            >
                                {{ $booking->customer_phone }}
                            </a>

                        </div>

                    </div>


                    {{-- Email --}}
                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Email
                        </small>

                        @if($booking->customer_email)

                            <a
                                href="mailto:{{ $booking->customer_email }}"
                                class="text-decoration-none"
                            >
                                {{ $booking->customer_email }}
                            </a>

                        @else

                            <span class="text-muted">
                                Not provided
                            </span>

                        @endif

                    </div>


                    {{-- Booking Date --}}
                    <div class="col-md-3">

                        <small class="text-muted d-block mb-1">
                            Booking Date
                        </small>

                        <div class="fw-semibold">

                            {{ $booking->booking_date?->format('d M Y') }}

                        </div>

                    </div>


                    {{-- Booking Time --}}
                    <div class="col-md-3">

                        <small class="text-muted d-block mb-1">
                            Booking Time
                        </small>

                        <div class="fw-semibold">

                            {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}

                        </div>

                    </div>


                    {{-- Notes --}}
                    <div class="col-12">

                        <small class="text-muted d-block mb-1">
                            Customer Notes
                        </small>

                        @if($booking->notes)

                            <div class="bg-light rounded-3 p-3">
                                {{ $booking->notes }}
                            </div>

                        @else

                            <span class="text-muted">
                                No customer notes.
                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- Business & Service --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-bottom">

                <strong>
                    Business & Service
                </strong>

            </div>


            <div class="card-body">

                <div class="row g-4">


                    {{-- Business --}}
                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Business
                        </small>

                        <div class="fw-semibold fs-6">

                            {{ $booking->business?->name ?? 'N/A' }}

                        </div>

                        @if($booking->business?->city)

                            <small class="text-muted">

                                {{ $booking->business->city->name }}

                                @if($booking->business->state)
                                    , {{ $booking->business->state->name }}
                                @endif

                            </small>

                        @endif

                    </div>


                    {{-- Service --}}
                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Service
                        </small>

                        <div class="fw-semibold">

                            {{ $booking->businessService?->name ?? 'N/A' }}

                        </div>

                    </div>


                    {{-- Service Price --}}
                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Service Price
                        </small>

                        <div class="fw-semibold">

                            ₹{{ number_format((float) $booking->original_amount, 2) }}

                        </div>

                    </div>


                    {{-- Offer --}}
                    <div class="col-md-6">

                        <small class="text-muted d-block mb-1">
                            Applied Offer
                        </small>

                        @if($booking->offer)

                            <div class="fw-semibold">

                                {{ $booking->offer->title }}

                            </div>

                            @if($booking->offer->coupon_code)

                                <small class="text-primary">

                                    Coupon:
                                    {{ $booking->offer->coupon_code }}

                                </small>

                            @endif

                        @else

                            <span class="text-muted">
                                No offer applied
                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- Pricing --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-bottom">

                <strong>
                    Payment Summary
                </strong>

            </div>


            <div class="card-body">

                <div class="d-flex justify-content-between mb-3">

                    <span class="text-muted">
                        Original Amount
                    </span>

                    <span>
                        ₹{{ number_format((float) $booking->original_amount, 2) }}
                    </span>

                </div>


                <div class="d-flex justify-content-between mb-3">

                    <span class="text-muted">
                        Discount
                    </span>

                    <span class="text-success fw-semibold">

                        - ₹{{ number_format((float) $booking->discount_amount, 2) }}

                    </span>

                </div>


                <hr>


                <div class="d-flex justify-content-between">

                    <span class="fw-semibold">
                        Final Amount
                    </span>

                    <span class="fw-bold fs-5">

                        ₹{{ number_format((float) $booking->final_amount, 2) }}

                    </span>

                </div>

            </div>

        </div>


    {{-- Booking Update --}}

<div class="card border-0 shadow-sm">

    ```
    <div class="card-header bg-white border-bottom">

        <strong>
            Update Booking
        </strong>

    </div>


    <div class="card-body">

        <form
            action="{{ route('admin.bookings.update', $booking) }}"
            method="POST"
        >

            @csrf

            @method('PATCH')


            {{-- Status --}}
            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Booking Status
                </label>

                <select
                    name="status"
                    class="form-select"
                >

                    <option
                        value="pending"
                        @selected($booking->status === 'pending')
                    >
                        Pending
                    </option>

                    <option
                        value="confirmed"
                        @selected($booking->status === 'confirmed')
                    >
                        Confirmed
                    </option>

                    <option
                        value="completed"
                        @selected($booking->status === 'completed')
                    >
                        Completed
                    </option>

                    <option
                        value="cancelled"
                        @selected($booking->status === 'cancelled')
                    >
                        Cancelled
                    </option>

                </select>

            </div>


            {{-- Admin Notes --}}
            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Admin Notes
                </label>

                <textarea
                    name="admin_notes"
                    rows="5"
                    class="form-control"
                    placeholder="Add internal notes about this booking..."
                >{{ old('admin_notes', $booking->admin_notes) }}</textarea>

            </div>


            {{-- Submit --}}
            <button
                type="submit"
                class="btn btn-primary"
            >

                <i class="bi bi-save me-1"></i>

                Update Booking

            </button>

        </form>

    </div>


    </div>


    </div>


    {{-- Right --}}
    <div class="col-lg-4">


        

        {{-- Booking Meta --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-bottom">

                <strong>
                    Booking Details
                </strong>

            </div>


            <div class="card-body">

                <div class="mb-3">

                    <small class="text-muted d-block">
                        Booking ID
                    </small>

                    <span class="fw-semibold">
                        #{{ $booking->id }}
                    </span>

                </div>


                <div class="mb-3">

                    <small class="text-muted d-block">
                        Created At
                    </small>

                    <span class="fw-semibold">

                        {{ $booking->created_at?->format('d M Y, h:i A') }}

                    </span>

                </div>


                <div>

                    <small class="text-muted d-block">
                        Last Updated
                    </small>

                    <span class="fw-semibold">

                        {{ $booking->updated_at?->format('d M Y, h:i A') }}

                    </span>

                </div>

            </div>

        </div>


        {{-- Delete --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h6 class="fw-semibold mb-2">
                    Delete Booking
                </h6>

                <p class="text-muted small">
                    This action cannot be undone.
                </p>


                <form
                    action="{{ route('admin.bookings.destroy', $booking) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to permanently delete this booking?');"
                >

                    @csrf

                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-outline-danger w-100"
                    >

                        <i class="bi bi-trash me-1"></i>

                        Delete Booking

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>


</div>

@endsection
