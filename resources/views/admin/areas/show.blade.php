@extends('admin.layouts.master')

@section('title', 'Area Details')

@section('content')

<div class="container-fluid py-3">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Area Details</h4>

            <p class="text-muted mb-0">
                View complete area information.
            </p>
        </div>

        <div>

            <a
                href="{{ route('admin.areas.edit', $area) }}"
                class="btn btn-primary me-2"
            >
                <i class="bi bi-pencil me-1"></i>
                Edit
            </a>

            <a
                href="{{ route('admin.areas.index') }}"
                class="btn btn-light"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

    </div>

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-bottom">
            <strong>Area Information</strong>
        </div>

        <div class="card-body">

            <div class="row g-4">

                {{-- Area Name --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        Area Name
                    </div>

                    <div class="fw-semibold fs-5">
                        {{ $area->name }}
                    </div>

                </div>

                {{-- Slug --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        Slug
                    </div>

                    <div class="fw-semibold">
                        {{ $area->slug }}
                    </div>

                </div>

                {{-- Country --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        Country
                    </div>

                    <div class="fw-semibold">
                        {{ $area->country?->name ?? 'N/A' }}
                    </div>

                </div>

                {{-- State --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        State
                    </div>

                    <div class="fw-semibold">
                        {{ $area->state?->name ?? 'N/A' }}
                    </div>

                </div>

                {{-- City --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        City
                    </div>

                    <div class="fw-semibold">
                        {{ $area->city?->name ?? 'N/A' }}
                    </div>

                </div>

                {{-- Area Code --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        Area Code
                    </div>

                    <div class="fw-semibold">
                        {{ $area->code ?: 'N/A' }}
                    </div>

                </div>

                {{-- Sort Order --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        Sort Order
                    </div>

                    <div class="fw-semibold">
                        {{ $area->sort_order }}
                    </div>

                </div>

                {{-- Status --}}
                <div class="col-md-6">

                    <div class="text-muted small mb-1">
                        Status
                    </div>

                    @if($area->status)

                        <span class="badge bg-success">
                            Active
                        </span>

                    @else

                        <span class="badge bg-secondary">
                            Inactive
                        </span>

                    @endif

                </div>

                {{-- Created At --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        Created At
                    </div>

                    <div class="fw-semibold">
                        {{ $area->created_at?->format('d M Y, h:i A') }}
                    </div>

                </div>

                {{-- Updated At --}}
                <div class="col-md-6">

                    <div class="text-muted small">
                        Updated At
                    </div>

                    <div class="fw-semibold">
                        {{ $area->updated_at?->format('d M Y, h:i A') }}
                    </div>

                </div>

                {{-- Description --}}
                <div class="col-12">

                    <div class="text-muted small">
                        Description
                    </div>

                    <div class="mt-1">
                        {{ $area->description ?: 'No description available.' }}
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
