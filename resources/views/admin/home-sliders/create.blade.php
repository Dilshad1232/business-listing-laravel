@extends('admin.layouts.master')

@section('title', 'Add Home Slider')

@section('content')

<div class="container-fluid py-4">

{{-- Page Header --}}
<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <h1 class="h3 fw-bold mb-1">Add Home Slider</h1>
        <p class="text-muted mb-0">
            Create a new homepage hero slider.
        </p>
    </div>

    <a href="{{ route('admin.home-sliders.index') }}"
       class="btn btn-light border d-inline-flex align-items-center gap-2">
        <i class="bi bi-arrow-left"></i>
        Back to Sliders
    </a>
</div>

{{-- Validation Errors --}}
@if($errors->any())
    <div class="alert alert-danger">
        <div class="fw-semibold mb-2">
            Please fix the following errors:
        </div>

        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.home-sliders.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf

    <div class="row g-4">

        {{-- Main Content --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-0 py-3 px-4">
                    <h5 class="fw-bold mb-1">
                        <i class="bi bi-type me-2 text-primary"></i>
                        Slider Content
                    </h5>

                    <p class="text-muted small mb-0">
                        Add the text that will appear on this hero slide.
                    </p>
                </div>

                <div class="card-body p-4">

                    {{-- Badge --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Badge
                        </label>

                        <input type="text"
                               name="badge"
                               value="{{ old('badge') }}"
                               class="form-control"
                               placeholder="Discover your next adventure">

                        <div class="form-text">
                            Small text displayed above the main heading.
                        </div>
                    </div>

                    {{-- Title --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Title <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               name="title"
                               value="{{ old('title') }}"
                               class="form-control @error('title') is-invalid @enderror"
                               placeholder="Let's Explore your"
                               required>

                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Highlight --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Highlight
                        </label>

                        <input type="text"
                               name="highlight"
                               value="{{ old('highlight') }}"
                               class="form-control"
                               placeholder="amazing">

                        <div class="form-text">
                            Highlighted word shown with the gradient style.
                        </div>
                    </div>

                    {{-- Typed Words --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Typed Words
                        </label>

                        <input type="text"
                               name="typed_words"
                               value="{{ old('typed_words', 'city,destination,places,world') }}"
                               class="form-control"
                               placeholder="city,destination,places,world">

                        <div class="form-text">
                            Separate multiple words with commas.
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Description
                        </label>

                        <textarea name="description"
                                  rows="4"
                                  class="form-control"
                                  placeholder="Find great places to stay, eat, shop, or visit from local experts around the world">{{ old('description') }}</textarea>
                    </div>

                </div>
            </div>

            {{-- Background Image --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-0 py-3 px-4">
                    <h5 class="fw-bold mb-1">
                        <i class="bi bi-image me-2 text-primary"></i>
                        Background Image
                    </h5>

                    <p class="text-muted small mb-0">
                        Upload the background image for this slider.
                    </p>
                </div>

                <div class="card-body p-4">

                    <label class="form-label fw-semibold">
                        Slider Image
                    </label>

                    <input type="file"
                           name="background_image"
                           accept=".jpg,.jpeg,.png,.webp"
                           class="form-control @error('background_image') is-invalid @enderror">

                    <div class="form-text">
                        JPG, JPEG, PNG or WEBP. Maximum size: 5MB.
                        Recommended size: 1920×1080px.
                    </div>

                    @error('background_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
            </div>

            {{-- Button --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 py-3 px-4">
                    <h5 class="fw-bold mb-1">
                        <i class="bi bi-link-45deg me-2 text-primary"></i>
                        Button
                    </h5>

                    <p class="text-muted small mb-0">
                        Optional call-to-action button.
                    </p>
                </div>

                <div class="card-body p-4">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Button Text
                            </label>

                            <input type="text"
                                   name="button_text"
                                   value="{{ old('button_text') }}"
                                   class="form-control"
                                   placeholder="Explore Now">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Button URL
                            </label>

                            <input type="text"
                                   name="button_url"
                                   value="{{ old('button_url') }}"
                                   class="form-control"
                                   placeholder="/businesses">
                        </div>

                    </div>

                </div>
            </div>

        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">

            {{-- Publish --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-0 py-3 px-4">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-sliders me-2 text-primary"></i>
                        Slider Settings
                    </h5>
                </div>

                <div class="card-body p-4">

                    {{-- Sort Order --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Sort Order
                        </label>

                        <input type="number"
                               name="sort_order"
                               value="{{ old('sort_order', 0) }}"
                               min="0"
                               class="form-control">

                        <div class="form-text">
                            Lower numbers appear first.
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="form-check form-switch">
                        <input class="form-check-input"
                               type="checkbox"
                               role="switch"
                               id="status"
                               name="status"
                               value="1"
                               {{ old('status', true) ? 'checked' : '' }}>

                        <label class="form-check-label fw-semibold"
                               for="status">
                            Active Slider
                        </label>
                    </div>

                    <div class="form-text mt-2">
                        Only active sliders will appear on the homepage.
                    </div>

                </div>
            </div>

            {{-- Info --}}
            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <div class="d-flex align-items-start gap-3">
                        <div class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center flex-shrink-0"
                             style="width:44px;height:44px;">
                            <i class="bi bi-info-circle fs-5"></i>
                        </div>

                        <div>
                            <h6 class="fw-bold mb-1">
                                Homepage Slider
                            </h6>

                            <p class="text-muted small mb-0">
                                Create up to 3 homepage sliders with
                                different background images and content.
                                The homepage will rotate them automatically.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

    {{-- Actions --}}
    <div class="d-flex justify-content-end gap-2 mt-4">

        <a href="{{ route('admin.home-sliders.index') }}"
           class="btn btn-light border px-4">
            Cancel
        </a>

        <button type="submit"
                class="btn btn-primary px-4">
            <i class="bi bi-check-lg me-1"></i>
            Create Slider
        </button>

    </div>

</form>


</div>

@endsection
