@extends('admin.layouts.master')

@section('title', 'View Home Slider')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1 fw-bold">Home Slider Preview</h4>
            <p class="text-muted mb-0">
                View complete slider information.
            </p>
        </div>

        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.home-sliders.edit', $homeSlider) }}"
                class="btn btn-primary"
            >
                <i class="bi bi-pencil me-1"></i>
                Edit
            </a>

            <a
                href="{{ route('admin.home-sliders.index') }}"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

    </div>


    <div class="row g-4">

        {{-- Image Preview --}}
        <div class="col-lg-7">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-3">

                    @if ($homeSlider->background_image)

                        <img
                            src="{{ asset('storage/' . $homeSlider->background_image) }}"
                            alt="{{ $homeSlider->title }}"
                            class="w-100 rounded-3"
                            style="height: 420px; object-fit: cover;"
                        >

                    @else

                        <div
                            class="d-flex align-items-center justify-content-center bg-light rounded-3"
                            style="height: 420px;"
                        >
                            <span class="text-muted">
                                No background image.
                            </span>
                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- Details --}}
        <div class="col-lg-5">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <div class="mb-4">

                        <span class="badge bg-light text-dark border">
                            Slider #{{ $homeSlider->id }}
                        </span>

                        @if ($homeSlider->status)
                            <span class="badge bg-success ms-1">
                                Active
                            </span>
                        @else
                            <span class="badge bg-secondary ms-1">
                                Inactive
                            </span>
                        @endif

                    </div>


                    {{-- Badge --}}
                    <div class="mb-4">

                        <small class="text-muted d-block mb-1">
                            Badge
                        </small>

                        <div class="fw-semibold">
                            {{ $homeSlider->badge ?: '—' }}
                        </div>

                    </div>


                    {{-- Title --}}
                    <div class="mb-4">

                        <small class="text-muted d-block mb-1">
                            Title
                        </small>

                        <h4 class="fw-bold mb-0">
                            {{ $homeSlider->title }}
                        </h4>

                    </div>


                    {{-- Highlight --}}
                    <div class="mb-4">

                        <small class="text-muted d-block mb-1">
                            Highlight
                        </small>

                        <div class="text-primary fw-semibold">
                            {{ $homeSlider->highlight ?: '—' }}
                        </div>

                    </div>


                    {{-- Typed Words --}}
                    <div class="mb-4">

                        <small class="text-muted d-block mb-1">
                            Typed Words
                        </small>

                        <div>
                            @if ($homeSlider->typed_words)

                                @foreach (explode(',', $homeSlider->typed_words) as $word)
                                    <span class="badge bg-light text-dark border me-1 mb-1">
                                        {{ trim($word) }}
                                    </span>
                                @endforeach

                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </div>

                    </div>


                    {{-- Description --}}
                    <div class="mb-4">

                        <small class="text-muted d-block mb-1">
                            Description
                        </small>

                        <p class="mb-0 text-muted">
                            {{ $homeSlider->description ?: '—' }}
                        </p>

                    </div>


                    {{-- Sort Order --}}
                    <div>

                        <small class="text-muted d-block mb-1">
                            Sort Order
                        </small>

                        <span class="fw-semibold">
                            {{ $homeSlider->sort_order }}
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
