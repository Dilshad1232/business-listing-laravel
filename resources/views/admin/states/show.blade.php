@extends('admin.layouts.master')

@section('title', 'State Details')

@section('content')

<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">State Details</h4>

            <p class="text-muted mb-0">
                View complete state information.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.states.edit', $state) }}"
                class="btn btn-primary"
            >
                <i class="bi bi-pencil me-1"></i>
                Edit
            </a>

            <a
                href="{{ route('admin.states.index') }}"
                class="btn btn-light"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

    </div>


    {{-- State Details --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-bottom">

            <div class="d-flex align-items-center">

                <div class="me-3">
                    <i class="bi bi-map fs-2 text-primary"></i>
                </div>

                <div>

                    <h5 class="mb-1">
                        {{ $state->name }}
                    </h5>

                    <small class="text-muted">
                        {{ $state->slug }}
                    </small>

                </div>

            </div>

        </div>


        <div class="card-body">

            <div class="row g-4">

                {{-- State Name --}}
                <div class="col-md-6">

                    <div class="text-muted small mb-1">
                        State Name
                    </div>

                    <div class="fw-semibold">
                        {{ $state->name }}
                    </div>

                </div>


                {{-- Country --}}
                <div class="col-md-6">

                    <div class="text-muted small mb-1">
                        Country
                    </div>

                    <div class="fw-semibold">

                        @if($state->country)

                            <i class="bi bi-globe2 me-1"></i>
                            {{ $state->country->name }}

                        @else

                            <span class="text-muted">
                                —
                            </span>

                        @endif

                    </div>

                </div>


                {{-- Slug --}}
                <div class="col-md-6">

                    <div class="text-muted small mb-1">
                        Slug
                    </div>

                    <div class="fw-semibold">
                        {{ $state->slug }}
                    </div>

                </div>


                {{-- Code --}}
                <div class="col-md-6">

                    <div class="text-muted small mb-1">
                        State Code
                    </div>

                    @if($state->code)

                        <span class="badge bg-light text-dark">
                            {{ strtoupper($state->code) }}
                        </span>

                    @else

                        <span class="text-muted">
                            —
                        </span>

                    @endif

                </div>


                {{-- Status --}}
                <div class="col-md-6">

                    <div class="text-muted small mb-1">
                        Status
                    </div>

                    @if($state->status)

                        <span class="badge bg-success">
                            <i class="bi bi-check-circle me-1"></i>
                            Active
                        </span>

                    @else

                        <span class="badge bg-secondary">
                            <i class="bi bi-x-circle me-1"></i>
                            Inactive
                        </span>

                    @endif

                </div>


                {{-- Sort Order --}}
                <div class="col-md-6">

                    <div class="text-muted small mb-1">
                        Sort Order
                    </div>

                    <div class="fw-semibold">
                        {{ $state->sort_order }}
                    </div>

                </div>


                {{-- Created --}}
                <div class="col-md-6">

                    <div class="text-muted small mb-1">
                        Created At
                    </div>

                    <div class="fw-semibold">
                        {{ $state->created_at?->format('d M Y, h:i A') }}
                    </div>

                </div>


                {{-- Updated --}}
                <div class="col-md-6">

                    <div class="text-muted small mb-1">
                        Updated At
                    </div>

                    <div class="fw-semibold">
                        {{ $state->updated_at?->format('d M Y, h:i A') }}
                    </div>

                </div>


                {{-- Description --}}
                <div class="col-12">

                    <div class="text-muted small mb-1">
                        Description
                    </div>

                    <div class="border rounded p-3 bg-light">

                        @if($state->description)

                            {{ $state->description }}

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


    {{-- Delete --}}
    <div class="card border-0 shadow-sm mt-4">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h6 class="mb-1 text-danger">
                        Delete State
                    </h6>

                    <p class="text-muted mb-0 small">
                        This action cannot be undone.
                    </p>

                </div>

                <form
                    action="{{ route('admin.states.destroy', $state) }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this state?')"
                >

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-outline-danger"
                    >
                        <i class="bi bi-trash me-1"></i>
                        Delete State
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
