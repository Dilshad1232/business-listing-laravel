@extends('admin.layouts.master')

@section('title', 'City Details')

@section('content')

<div class="container-fluid py-3">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">City Details</h4>

            <p class="text-muted mb-0">
                View complete city information.
            </p>
        </div>

        <div>

            <a
                href="{{ route('admin.cities.edit', $city) }}"
                class="btn btn-primary me-2"
            >
                <i class="bi bi-pencil me-1"></i>
                Edit
            </a>

            <a
                href="{{ route('admin.cities.index') }}"
                class="btn btn-light"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-bottom">
            <strong>City Information</strong>
        </div>

        <div class="card-body">

            <div class="row g-4">

                {{-- City Name --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        City Name
                    </div>

                    <div class="fw-semibold fs-5">
                        {{ $city->name }}
                    </div>

                </div>

                {{-- Slug --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        Slug
                    </div>

                    <div class="fw-semibold">
                        {{ $city->slug }}
                    </div>

                </div>

                {{-- Country --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        Country
                    </div>

                    <div class="fw-semibold">
                        {{ $city->country?->name ?? 'N/A' }}
                    </div>

                </div>

                {{-- State --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        State
                    </div>

                    <div class="fw-semibold">
                        {{ $city->state?->name ?? 'N/A' }}
                    </div>

                </div>

                {{-- City Code --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        City Code
                    </div>

                    <div class="fw-semibold">
                        {{ $city->code ?: 'N/A' }}
                    </div>

                </div>

                {{-- Sort Order --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        Sort Order
                    </div>

                    <div class="fw-semibold">
                        {{ $city->sort_order }}
                    </div>

                </div>

                {{-- Status --}}
                <div class="col-md-6">

                    <div class="text-muted small mb-1">
                        Status
                    </div>

                    @if($city->status)

                        <span class="badge bg-success">
                            Active
                        </span>

                    @else

                        <span class="badge bg-secondary">
                            Inactive
                        </span>

                    @endif

                </div>

                {{-- Created --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        Created At
                    </div>

                    <div class="fw-semibold">
                        {{ $city->created_at?->format('d M Y, h:i A') }}
                    </div>

                </div>

                {{-- Description --}}
                <div class="col-12">

                    <div class="text-muted small">
                        Description
                    </div>

                    <div class="mt-1">
                        {{ $city->description ?: 'No description available.' }}
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
