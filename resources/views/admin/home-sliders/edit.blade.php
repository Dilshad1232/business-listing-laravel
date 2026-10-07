@extends('admin.layouts.master')

@section('title', 'Edit Home Slider')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1 fw-bold">Edit Home Slider</h4>
            <p class="text-muted mb-0">
                Update homepage slider content and background image.
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('admin.home-sliders.show', $homeSlider) }}"
               class="btn btn-outline-primary">
                <i class="bi bi-eye me-1"></i>
                Preview
            </a>

            <a href="{{ route('admin.home-sliders.index') }}"
               class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>
        </div>

    </div>


    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <form
                action="{{ route('admin.home-sliders.update', $homeSlider) }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- Badge --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Badge
                        </label>

                        <input
                            type="text"
                            name="badge"
                            class="form-control"
                            value="{{ old('badge', $homeSlider->badge) }}"
                            placeholder="Discover your next adventure"
                        >
                    </div>


                    {{-- Sort Order --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Sort Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            class="form-control"
                            min="0"
                            value="{{ old('sort_order', $homeSlider->sort_order) }}"
                        >
                    </div>


                    {{-- Title --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Title <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            value="{{ old('title', $homeSlider->title) }}"
                            required
                        >
                    </div>


                    {{-- Highlight --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Highlight
                        </label>

                        <input
                            type="text"
                            name="highlight"
                            class="form-control"
                            value="{{ old('highlight', $homeSlider->highlight) }}"
                            placeholder="amazing"
                        >
                    </div>


                    {{-- Typed Words --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            Typed Words
                        </label>

                        <input
                            type="text"
                            name="typed_words"
                            class="form-control"
                            value="{{ old('typed_words', $homeSlider->typed_words) }}"
                            placeholder="city,destination,places,world"
                        >

                        <small class="text-muted">
                            Separate multiple words with commas.
                        </small>
                    </div>


                    {{-- Description --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="form-control"
                            placeholder="Enter slider description..."
                        >{{ old('description', $homeSlider->description) }}</textarea>
                    </div>


                    {{-- Current Image --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Current Background Image
                        </label>

                        <div>
                            @if ($homeSlider->background_image)
                                <img
                                    src="{{ asset('storage/' . $homeSlider->background_image) }}"
                                    alt="{{ $homeSlider->title }}"
                                    class="rounded-3 border"
                                    style="width: 100%; max-width: 420px; height: 220px; object-fit: cover;"
                                >
                            @else
                                <div class="text-muted">
                                    No image uploaded.
                                </div>
                            @endif
                        </div>

                    </div>


                    {{-- New Image --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Replace Background Image
                        </label>

                        <input
                            type="file"
                            name="background_image"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        <small class="text-muted">
                            Leave empty to keep the current image.
                            Max 5MB.
                        </small>

                    </div>


                    {{-- Button fields intentionally omitted --}}
                    {{-- Current hero design does not use CTA buttons --}}


                    {{-- Status --}}
                    <div class="col-12">

                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="status"
                                value="1"
                                id="status"
                                {{ old('status', $homeSlider->status) ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label fw-semibold"
                                for="status"
                            >
                                Active Slider
                            </label>

                        </div>

                    </div>


                    {{-- Submit --}}
                    <div class="col-12">

                        <hr>

                        <div class="d-flex justify-content-end gap-2">

                            <a
                                href="{{ route('admin.home-sliders.index') }}"
                                class="btn btn-light"
                            >
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                <i class="bi bi-check2-circle me-1"></i>
                                Update Slider
                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection
