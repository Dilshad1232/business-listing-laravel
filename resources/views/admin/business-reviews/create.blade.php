@extends('admin.layouts.master')

@section('title', 'Add Review')

@section('content')

<div class="container-fluid py-3">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="d-flex flex-column flex-md-row
                align-items-md-center
                justify-content-between
                gap-3 mb-4">

        <div>

            <div class="d-flex align-items-center gap-2 mb-1">

                <a
                    href="{{ route('admin.reviews.index') }}"
                    class="text-muted text-decoration-none"
                >
                    <i class="bi bi-arrow-left"></i>
                </a>

                <h4 class="mb-0 fw-bold">
                    Add Review
                </h4>

            </div>

            <p class="text-muted mb-0">
                Add a customer review for a business.
            </p>

        </div>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger border-0 shadow-sm">

            <div class="fw-bold mb-2">

                <i class="bi bi-exclamation-triangle-fill me-1"></i>

                Please fix the following errors:

            </div>

            <ul class="mb-0 ps-3">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.reviews.store') }}"
        method="POST"
    >

        @csrf


        <div class="row g-4">


            {{-- =================================================
                LEFT COLUMN
            ================================================== --}}

            <div class="col-xl-8">


                {{-- BUSINESS & REVIEWER --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <strong>

                            <i class="bi bi-building me-2 text-primary"></i>

                            Business & Reviewer

                        </strong>

                    </div>


                    <div class="card-body">

                        <div class="row g-4">


                            {{-- Business --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">

                                    Business
                                    <span class="text-danger">*</span>

                                </label>

                                <select
                                    name="business_id"
                                    class="form-select @error('business_id') is-invalid @enderror"
                                    required
                                >

                                    <option value="">
                                        Select Business
                                    </option>

                                    @foreach($businesses as $business)

                                        <option
                                            value="{{ $business->id }}"
                                            @selected(old('business_id') == $business->id)
                                        >
                                            {{ $business->name }}
                                        </option>

                                    @endforeach

                                </select>


                                @error('business_id')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Reviewer Name --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Reviewer Name

                                </label>

                                <input
                                    type="text"
                                    name="reviewer_name"
                                    value="{{ old('reviewer_name') }}"
                                    class="form-control @error('reviewer_name') is-invalid @enderror"
                                    placeholder="e.g. Rahul Sharma"
                                >

                                @error('reviewer_name')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Reviewer Email --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Reviewer Email

                                </label>

                                <input
                                    type="email"
                                    name="reviewer_email"
                                    value="{{ old('reviewer_email') }}"
                                    class="form-control @error('reviewer_email') is-invalid @enderror"
                                    placeholder="customer@example.com"
                                >

                                @error('reviewer_email')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- User ID --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">

                                    User ID
                                    <span class="text-muted fw-normal">
                                        (Optional)
                                    </span>

                                </label>

                                <input
                                    type="number"
                                    name="user_id"
                                    value="{{ old('user_id') }}"
                                    class="form-control @error('user_id') is-invalid @enderror"
                                    placeholder="Registered user's ID"
                                >

                                <div class="form-text">

                                    Leave empty for a guest reviewer.

                                </div>

                                @error('user_id')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- REVIEW CONTENT --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <strong>

                            <i class="bi bi-chat-square-text me-2 text-primary"></i>

                            Review Content

                        </strong>

                    </div>


                    <div class="card-body">

                        {{-- Rating --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Rating
                                <span class="text-danger">*</span>

                            </label>


                            <div
                                class="review-rating-selector
                                       d-flex flex-wrap gap-2"
                            >

                                @for($rating = 1; $rating <= 5; $rating++)

                                    <label
                                        class="rating-option"
                                        style="cursor:pointer;"
                                    >

                                        <input
                                            type="radio"
                                            name="rating"
                                            value="{{ $rating }}"
                                            class="d-none rating-input"
                                            @checked(old('rating') == $rating)
                                            required
                                        >

                                        <span
                                            class="rating-button
                                                   border rounded-3
                                                   px-3 py-2
                                                   d-inline-flex
                                                   align-items-center
                                                   gap-1"
                                        >

                                            <i class="bi bi-star-fill text-warning"></i>

                                            <span>
                                                {{ $rating }}
                                            </span>

                                        </span>

                                    </label>

                                @endfor

                            </div>


                            @error('rating')

                                <div class="text-danger small mt-2">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Title --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Review Title

                            </label>

                            <input
                                type="text"
                                name="title"
                                value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror"
                                placeholder="e.g. Excellent service and support"
                            >

                            @error('title')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Comment --}}
                        <div>

                            <label class="form-label fw-semibold">

                                Review Comment
                                <span class="text-danger">*</span>

                            </label>

                            <textarea
                                name="comment"
                                rows="7"
                                class="form-control @error('comment') is-invalid @enderror"
                                placeholder="Write the customer's review..."
                                required
                            >{{ old('comment') }}</textarea>

                            @error('comment')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- ADMIN RESPONSE --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <strong>

                            <i class="bi bi-reply me-2 text-primary"></i>

                            Admin Response

                        </strong>

                    </div>


                    <div class="card-body">

                        <label class="form-label fw-semibold">

                            Response

                        </label>

                        <textarea
                            name="admin_reply"
                            rows="5"
                            class="form-control @error('admin_reply') is-invalid @enderror"
                            placeholder="Optional response from the business administrator..."
                        >{{ old('admin_reply') }}</textarea>

                        @error('admin_reply')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                        <div class="form-text">

                            You can leave this empty and add a response later.

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                RIGHT COLUMN
            ================================================== --}}

            <div class="col-xl-4">


                {{-- STATUS --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <strong>

                            <i class="bi bi-shield-check me-2 text-primary"></i>

                            Review Status

                        </strong>

                    </div>


                    <div class="card-body">

                        <label class="form-label fw-semibold">

                            Status

                        </label>

                        <select
                            name="status"
                            class="form-select @error('status') is-invalid @enderror"
                        >

                            <option
                                value="pending"
                                @selected(old('status', 'pending') === 'pending')
                            >
                                Pending
                            </option>

                            <option
                                value="approved"
                                @selected(old('status') === 'approved')
                            >
                                Approved
                            </option>

                            <option
                                value="rejected"
                                @selected(old('status') === 'rejected')
                            >
                                Rejected
                            </option>

                        </select>

                        @error('status')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror


                        <div class="mt-4">

                            <div
                                class="form-check form-switch"
                            >

                                <input
                                    type="checkbox"
                                    name="is_featured"
                                    value="1"
                                    class="form-check-input"
                                    id="isFeatured"
                                    @checked(old('is_featured'))
                                >

                                <label
                                    class="form-check-label fw-semibold"
                                    for="isFeatured"
                                >

                                    Featured Review

                                </label>

                            </div>

                            <div class="small text-muted mt-1">

                                Highlight this review as a featured review.

                            </div>

                        </div>

                    </div>

                </div>


                {{-- HELPFUL COUNT --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <strong>

                            <i class="bi bi-hand-thumbs-up me-2 text-primary"></i>

                            Review Engagement

                        </strong>

                    </div>


                    <div class="card-body">

                        <label class="form-label fw-semibold">

                            Helpful Count

                        </label>

                        <input
                            type="number"
                            name="helpful_count"
                            value="{{ old('helpful_count', 0) }}"
                            min="0"
                            class="form-control @error('helpful_count') is-invalid @enderror"
                        >

                        <div class="form-text">

                            Number of people who found this review helpful.

                        </div>

                        @error('helpful_count')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                {{-- INFO --}}
                <div
                    class="card border-0 shadow-sm mb-4"
                >

                    <div class="card-body">

                        <div class="d-flex gap-3">

                            <div
                                class="rounded-3 bg-primary bg-opacity-10
                                       text-primary d-flex align-items-center
                                       justify-content-center"
                                style="
                                    width:44px;
                                    height:44px;
                                    flex-shrink:0;
                                "
                            >

                                <i class="bi bi-info-circle fs-5"></i>

                            </div>


                            <div>

                                <div class="fw-semibold mb-1">
                                    Review Moderation
                                </div>

                                <div class="small text-muted">

                                    Pending reviews can be reviewed
                                    and approved before appearing publicly.

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- ACTIONS --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-body">

                        <button
                            type="submit"
                            class="btn btn-primary w-100 mb-2"
                        >

                            <i class="bi bi-check-lg me-1"></i>

                            Create Review

                        </button>


                        <a
                            href="{{ route('admin.reviews.index') }}"
                            class="btn btn-outline-secondary w-100"
                        >

                            Cancel

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>


{{-- =============================================================
     RATING UI
============================================================== --}}

<style>

    .rating-button {
        background: #fff;
        transition: all .2s ease;
    }

    .rating-button:hover {
        border-color: #4f46e5 !important;
        transform: translateY(-1px);
    }

    .rating-input:checked + .rating-button {
        background: rgba(79, 70, 229, .08);
        border-color: #4f46e5 !important;
        color: #4f46e5;
        box-shadow: 0 0 0 2px rgba(79, 70, 229, .08);
    }

</style>

@endsection
