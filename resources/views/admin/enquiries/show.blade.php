@extends('admin.layouts.master')

@section('content')

<div class="container-fluid py-4">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>
            <div class="d-flex align-items-center gap-2 mb-2">
                <a href="{{ route('admin.enquiries.index') }}"
                   class="text-decoration-none text-muted">
                    <i class="bi bi-arrow-left"></i>
                    Enquiries
                </a>

                <span class="text-muted">/</span>

                <span class="text-muted">
                    #{{ $enquiry->id }}
                </span>
            </div>

            <h2 class="fw-bold mb-1">
                Enquiry Details
            </h2>

            <p class="text-muted mb-0">
                View and manage customer enquiry information.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('admin.enquiries.index') }}"
               class="btn btn-light border">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

            <form action="{{ route('admin.enquiries.destroy', $enquiry) }}"
                  method="POST"
                  onsubmit="return confirm('Are you sure you want to delete this enquiry?');">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-outline-danger">
                    <i class="bi bi-trash me-1"></i>
                    Delete
                </button>

            </form>

        </div>

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}
    @if(session('success'))

        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center gap-2 mb-4">
            <i class="bi bi-check-circle-fill"></i>

            <span>
                {{ session('success') }}
            </span>
        </div>

    @endif


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}
    @if($errors->any())

        <div class="alert alert-danger border-0 shadow-sm mb-4">

            <div class="fw-semibold mb-2">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                Please fix the following:
            </div>

            <ul class="mb-0 ps-3">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        MAIN GRID
    ========================================================== --}}
    <div class="row g-4">


        {{-- =====================================================
            LEFT SIDE
        ====================================================== --}}
        <div class="col-xl-8">


            {{-- =================================================
                CUSTOMER INFORMATION
            ================================================== --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-start mb-4">

                        <div>

                            <div class="text-uppercase small fw-semibold text-muted mb-1">
                                Customer
                            </div>

                            <h4 class="fw-bold mb-0">
                                {{ $enquiry->name }}
                            </h4>

                        </div>

                        @php
                            $initials = collect(
                                preg_split('/\s+/', trim($enquiry->name))
                            )
                            ->filter()
                            ->take(2)
                            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                            ->implode('');
                        @endphp

                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold"
                             style="width:52px;height:52px;">

                            {{ $initials ?: 'C' }}

                        </div>

                    </div>


                    <div class="row g-3">

                        {{-- Email --}}
                        <div class="col-md-6">

                            <div class="border rounded-3 p-3 h-100">

                                <div class="small text-muted mb-1">
                                    <i class="bi bi-envelope me-1"></i>
                                    Email
                                </div>

                                <a href="mailto:{{ $enquiry->email }}"
                                   class="text-decoration-none fw-semibold">

                                    {{ $enquiry->email }}

                                </a>

                            </div>

                        </div>


                        {{-- Phone --}}
                        <div class="col-md-6">

                            <div class="border rounded-3 p-3 h-100">

                                <div class="small text-muted mb-1">
                                    <i class="bi bi-telephone me-1"></i>
                                    Phone
                                </div>

                                @if($enquiry->phone)

                                    <a href="tel:{{ $enquiry->phone }}"
                                       class="text-decoration-none fw-semibold">

                                        {{ $enquiry->phone }}

                                    </a>

                                @else

                                    <span class="text-muted">
                                        Not provided
                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                ENQUIRY MESSAGE
            ================================================== --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center gap-2 mb-4">

                        <div class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center"
                             style="width:42px;height:42px;">

                            <i class="bi bi-chat-left-text fs-5"></i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Customer Message
                            </h5>

                            <small class="text-muted">
                                Submitted enquiry message
                            </small>

                        </div>

                    </div>


                    <div class="bg-light rounded-4 p-4">

                        <p class="mb-0"
                           style="white-space: pre-line; line-height:1.8;">

                            {{ $enquiry->message }}

                        </p>

                    </div>


                    <div class="text-muted small mt-3">

                        <i class="bi bi-clock me-1"></i>

                        Received
                        {{ $enquiry->created_at?->format('d M Y, h:i A') }}

                    </div>

                </div>

            </div>


            {{-- =================================================
                PRODUCT INFORMATION
            ================================================== --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center gap-2 mb-4">

                        <div class="rounded-3 bg-warning-subtle text-warning d-flex align-items-center justify-content-center"
                             style="width:42px;height:42px;">

                            <i class="bi bi-box-seam fs-5"></i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Product Information
                            </h5>

                            <small class="text-muted">
                                Product connected with this enquiry
                            </small>

                        </div>

                    </div>


                    @if($enquiry->product)

                        <div class="border rounded-4 p-3">

                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                                <div>

                                    <h5 class="fw-bold mb-1">
                                        {{ $enquiry->product->name }}
                                    </h5>

                                    @if($enquiry->product->sku)

                                        <div class="small text-muted">
                                            SKU: {{ $enquiry->product->sku }}
                                        </div>

                                    @endif

                                </div>


                                <a href="{{ route('products.show', $enquiry->product->slug) }}"
                                   target="_blank"
                                   class="btn btn-outline-primary btn-sm">

                                    <i class="bi bi-box-arrow-up-right me-1"></i>
                                    View Product

                                </a>

                            </div>

                        </div>

                    @else

                        <div class="text-muted">
                            <i class="bi bi-info-circle me-1"></i>
                            This enquiry is not linked to a product.
                        </div>

                    @endif

                </div>

            </div>


            {{-- =================================================
                ADMIN NOTES
            ================================================== --}}
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center gap-2 mb-4">

                        <div class="rounded-3 bg-dark-subtle text-dark d-flex align-items-center justify-content-center"
                             style="width:42px;height:42px;">

                            <i class="bi bi-sticky fs-5"></i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Admin Notes
                            </h5>

                            <small class="text-muted">
                                Internal notes for this enquiry
                            </small>

                        </div>

                    </div>


                    <form action="{{ route('admin.enquiries.update', $enquiry) }}"
                          method="POST">

                        @csrf
                        @method('PUT')


                        {{-- Status --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Enquiry Status
                            </label>

                            <select name="status"
                                    class="form-select form-select-lg">

                                <option value="new"
                                    {{ $enquiry->status === 'new' ? 'selected' : '' }}>
                                    New
                                </option>

                                <option value="contacted"
                                    {{ $enquiry->status === 'contacted' ? 'selected' : '' }}>
                                    Contacted
                                </option>

                                <option value="closed"
                                    {{ $enquiry->status === 'closed' ? 'selected' : '' }}>
                                    Closed
                                </option>

                            </select>

                        </div>


                        {{-- Notes --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Internal Notes
                            </label>

                            <textarea name="admin_notes"
                                      rows="6"
                                      maxlength="5000"
                                      class="form-control"
                                      placeholder="Write internal notes about this enquiry...">{{ old('admin_notes', $enquiry->admin_notes) }}</textarea>

                            <div class="form-text">
                                These notes are visible only to administrators.
                            </div>

                        </div>


                        <div class="d-flex justify-content-end">

                            <button type="submit"
                                    class="btn btn-primary px-4">

                                <i class="bi bi-check2-circle me-1"></i>
                                Update Enquiry

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        {{-- =====================================================
            RIGHT SIDE
        ====================================================== --}}
        <div class="col-xl-4">


            {{-- =================================================
                STATUS CARD
            ================================================== --}}
            @php

                $statusConfig = match($enquiry->status) {

                    'new' => [
                        'label' => 'New',
                        'class' => 'bg-primary-subtle text-primary',
                        'icon' => 'bi-envelope',
                    ],

                    'contacted' => [
                        'label' => 'Contacted',
                        'class' => 'bg-warning-subtle text-warning',
                        'icon' => 'bi-telephone',
                    ],

                    'closed' => [
                        'label' => 'Closed',
                        'class' => 'bg-success-subtle text-success',
                        'icon' => 'bi-check-circle',
                    ],

                    default => [
                        'label' => ucfirst($enquiry->status),
                        'class' => 'bg-secondary-subtle text-secondary',
                        'icon' => 'bi-info-circle',
                    ],

                };

            @endphp


            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">

                <div class="card-body p-4">

                    <div class="text-muted small mb-2">
                        Current Status
                    </div>

                    <div class="d-flex align-items-center gap-3">

                        <div class="rounded-3 {{ $statusConfig['class'] }} d-flex align-items-center justify-content-center"
                             style="width:48px;height:48px;">

                            <i class="bi {{ $statusConfig['icon'] }} fs-5"></i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                {{ $statusConfig['label'] }}
                            </h5>

                            <small class="text-muted">
                                Enquiry #{{ $enquiry->id }}
                            </small>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                BUSINESS CARD
            ================================================== --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center gap-2 mb-4">

                        <div class="rounded-3 bg-danger-subtle text-danger d-flex align-items-center justify-content-center"
                             style="width:42px;height:42px;">

                            <i class="bi bi-building fs-5"></i>

                        </div>

                        <div>

                            <h5 class="fw-bold mb-0">
                                Business
                            </h5>

                            <small class="text-muted">
                                Receiving this enquiry
                            </small>

                        </div>

                    </div>


                    @if($enquiry->business)

                        <h5 class="fw-bold mb-2">
                            {{ $enquiry->business->name }}
                        </h5>

                        @if($enquiry->business->email)

                            <div class="small text-muted mb-2">

                                <i class="bi bi-envelope me-1"></i>

                                {{ $enquiry->business->email }}

                            </div>

                        @endif


                        @if($enquiry->business->phone)

                            <div class="small text-muted mb-3">

                                <i class="bi bi-telephone me-1"></i>

                                {{ $enquiry->business->phone }}

                            </div>

                        @endif


                        @if($enquiry->business->slug)

                            <a href="{{ route('businesses.show', $enquiry->business->slug) }}"
                               target="_blank"
                               class="btn btn-outline-primary btn-sm w-100">

                                <i class="bi bi-box-arrow-up-right me-1"></i>
                                View Business

                            </a>

                        @endif

                    @else

                        <div class="text-muted">
                            Business information unavailable.
                        </div>

                    @endif

                </div>

            </div>


            {{-- =================================================
                ENQUIRY META
            ================================================== --}}
            <div class="card border-0 shadow-sm rounded-4">

                <div class="card-body p-4">

                    <h5 class="fw-bold mb-4">
                        Enquiry Information
                    </h5>


                    <div class="d-flex justify-content-between py-2 border-bottom">

                        <span class="text-muted">
                            Enquiry ID
                        </span>

                        <span class="fw-semibold">
                            #{{ $enquiry->id }}
                        </span>

                    </div>


                    <div class="d-flex justify-content-between py-2 border-bottom">

                        <span class="text-muted">
                            Submitted
                        </span>

                        <span class="fw-semibold text-end">
                            {{ $enquiry->created_at?->format('d M Y') }}
                        </span>

                    </div>


                    <div class="d-flex justify-content-between py-2 border-bottom">

                        <span class="text-muted">
                            Time
                        </span>

                        <span class="fw-semibold text-end">
                            {{ $enquiry->created_at?->format('h:i A') }}
                        </span>

                    </div>


                    <div class="d-flex justify-content-between py-2">

                        <span class="text-muted">
                            User Account
                        </span>

                        <span class="fw-semibold">

                            @if($enquiry->user)

                                Registered

                            @else

                                Guest

                            @endif

                        </span>

                    </div>

                </div>

            </div>


        </div>

    </div>

</div>


{{-- =========================================================
    CUSTOM PAGE POLISH
========================================================== --}}
<style>

    .card {
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .card:hover {
        box-shadow: 0 10px 30px rgba(15, 23, 42, .07) !important;
    }

    .form-control,
    .form-select {
        border-color: #e5e7eb;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 .2rem rgba(79, 70, 229, .10);
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

</style>

@endsection
