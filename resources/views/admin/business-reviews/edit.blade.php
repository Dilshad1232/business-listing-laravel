@extends('admin.layouts.master')

@section('title', 'Edit Review')

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
                    href="{{ route('admin.reviews.show', $review) }}"
                    class="text-muted text-decoration-none"
                >
                    <i class="bi bi-arrow-left"></i>
                </a>

                <h4 class="mb-0 fw-bold">
                    Edit Review
                </h4>

            </div>

            <p class="text-muted mb-0">
                Update review details, status and admin response.
            </p>

        </div>


        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.reviews.show', $review) }}"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-eye me-1"></i>
                View Review
            </a>

            <a
                href="{{ route('admin.reviews.index') }}"
                class="btn btn-outline-secondary"
            >
                <i class="bi bi-arrow-left me-1"></i>
                Back
            </a>

        </div>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="alert alert-danger border-0 shadow-sm">

            <div class="fw-semibold mb-2">

                <i class="bi bi-exclamation-triangle me-1"></i>

                Please fix the following errors:

            </div>

            <ul class="mb-0 ps-3">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        FORM
    ========================================================== --}}

    <form
        action="{{ route('admin.reviews.update', $review) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <div class="row g-4">


            {{-- =================================================
                LEFT COLUMN
            ================================================== --}}

            <div class="col-lg-8">


                {{-- Review Information --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <div class="d-flex align-items-center gap-2">

                            <div
                                class="rounded-3 bg-primary bg-opacity-10
                                       text-primary
                                       d-flex align-items-center
                                       justify-content-center"
                                style="width:38px;height:38px;"
                            >

                                <i class="bi bi-chat-square-text"></i>

                            </div>

                            <div>

                                <h6 class="mb-0 fw-bold">
                                    Review Information
                                </h6>

                                <small class="text-muted">
                                    Update the customer review details.
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        {{-- Business --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Business
                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="business_id"
                                class="form-select"
                                required
                            >

                                <option value="">
                                    Select Business
                                </option>

                                @if(isset($businesses))

                                    @foreach($businesses as $business)

                                        <option
                                            value="{{ $business->id }}"
                                            @selected(
                                                old(
                                                    'business_id',
                                                    $review->business_id
                                                ) == $business->id
                                            )
                                        >

                                            {{ $business->name }}

                                        </option>

                                    @endforeach

                                @else

                                    @if($review->business)

                                        <option
                                            value="{{ $review->business_id }}"
                                            selected
                                        >

                                            {{ $review->business->name }}

                                        </option>

                                    @endif

                                @endif

                            </select>

                            @error('business_id')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <div class="row g-3">


                            {{-- Reviewer Name --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Reviewer Name
                                </label>

                                <input
                                    type="text"
                                    name="reviewer_name"
                                    class="form-control"
                                    value="{{ old(
                                        'reviewer_name',
                                        $review->reviewer_name
                                    ) }}"
                                    placeholder="Enter reviewer name"
                                >

                                @error('reviewer_name')

                                    <div class="text-danger small mt-1">
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
                                    class="form-control"
                                    value="{{ old(
                                        'reviewer_email',
                                        $review->reviewer_email
                                    ) }}"
                                    placeholder="reviewer@example.com"
                                >

                                @error('reviewer_email')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- User ID --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    User ID

                                    <span class="text-muted fw-normal">
                                        (Optional)
                                    </span>

                                </label>

                                <input
                                    type="number"
                                    name="user_id"
                                    class="form-control"
                                    value="{{ old(
                                        'user_id',
                                        $review->user_id
                                    ) }}"
                                    placeholder="Enter user ID"
                                >

                                <div class="form-text">
                                    Leave empty for a guest review.
                                </div>

                                @error('user_id')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Rating --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Rating

                                    <span class="text-danger">*</span>

                                </label>

                                <div
                                    class="border rounded-3 p-2"
                                    style="min-height:42px;"
                                >

                                    <div class="d-flex flex-wrap gap-3">

                                        @for($i = 1; $i <= 5; $i++)

                                            <label
                                                class="d-flex align-items-center
                                                       gap-1 mb-0"
                                                style="cursor:pointer;"
                                            >

                                                <input
                                                    type="radio"
                                                    name="rating"
                                                    value="{{ $i }}"
                                                    class="form-check-input mt-0"
                                                    @checked(
                                                        old(
                                                            'rating',
                                                            $review->rating
                                                        ) == $i
                                                    )
                                                    required
                                                >

                                                <span class="text-warning">

                                                    {{ $i }}

                                                    <i class="bi bi-star-fill"></i>

                                                </span>

                                            </label>

                                        @endfor

                                    </div>

                                </div>

                                @error('rating')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Title --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Review Title
                                </label>

                                <input
                                    type="text"
                                    name="title"
                                    class="form-control"
                                    value="{{ old(
                                        'title',
                                        $review->title
                                    ) }}"
                                    placeholder="Enter review title"
                                >

                                @error('title')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Comment --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">

                                    Review Comment

                                    <span class="text-danger">*</span>

                                </label>

                                <textarea
                                    name="comment"
                                    rows="7"
                                    class="form-control"
                                    placeholder="Write review comment..."
                                    required
                                >{{ old('comment', $review->comment) }}</textarea>

                                @error('comment')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Admin Response --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <div class="d-flex align-items-center gap-2">

                            <div
                                class="rounded-3 bg-primary bg-opacity-10
                                       text-primary
                                       d-flex align-items-center
                                       justify-content-center"
                                style="width:38px;height:38px;"
                            >

                                <i class="bi bi-reply"></i>

                            </div>

                            <div>

                                <h6 class="mb-0 fw-bold">
                                    Admin Response
                                </h6>

                                <small class="text-muted">
                                    Add or update the official response.
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body">

                        <label class="form-label fw-semibold">
                            Response
                        </label>

                        <textarea
                            name="admin_reply"
                            rows="6"
                            class="form-control"
                            placeholder="Write an official response..."
                        >{{ old(
                            'admin_reply',
                            $review->admin_reply
                        ) }}</textarea>

                        @error('admin_reply')

                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>

                        @enderror


                        <div class="mt-3">

                            <label class="form-label fw-semibold">
                                Response Date
                            </label>

                            <input
                                type="datetime-local"
                                name="admin_replied_at"
                                class="form-control"
                                value="{{ old(
                                    'admin_replied_at',
                                    $review->admin_replied_at
                                        ? $review->admin_replied_at->format(
                                            'Y-m-d\TH:i'
                                        )
                                        : ''
                                ) }}"
                            >

                            @error('admin_replied_at')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    ACTIONS
                ================================================== --}}

                <div
                    class="card border-0 shadow-sm"
                >

                    <div class="card-body">

                        <div
                            class="d-flex flex-column flex-sm-row
                                   justify-content-between
                                   align-items-sm-center
                                   gap-3"
                        >

                            <a
                                href="{{ route(
                                    'admin.reviews.show',
                                    $review
                                ) }}"
                                class="btn btn-outline-secondary"
                            >

                                <i class="bi bi-x-lg me-1"></i>

                                Cancel

                            </a>


                            <button
                                type="submit"
                                class="btn btn-primary px-4"
                            >

                                <i class="bi bi-check2-circle me-1"></i>

                                Update Review

                            </button>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                RIGHT COLUMN
            ================================================== --}}

            <div class="col-lg-4">


                {{-- Publishing --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <strong>

                            <i class="bi bi-shield-check me-2 text-primary"></i>

                            Publishing

                        </strong>

                    </div>


                    <div class="card-body">


                        {{-- Status --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Review Status
                            </label>

                            <select
                                name="status"
                                class="form-select"
                                required
                            >

                                <option
                                    value="pending"
                                    @selected(
                                        old(
                                            'status',
                                            $review->status
                                        ) === 'pending'
                                    )
                                >
                                    Pending
                                </option>

                                <option
                                    value="approved"
                                    @selected(
                                        old(
                                            'status',
                                            $review->status
                                        ) === 'approved'
                                    )
                                >
                                    Approved
                                </option>

                                <option
                                    value="rejected"
                                    @selected(
                                        old(
                                            'status',
                                            $review->status
                                        ) === 'rejected'
                                    )
                                >
                                    Rejected
                                </option>

                            </select>

                            @error('status')

                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        {{-- Featured --}}
                        <div
                            class="border rounded-3 p-3"
                        >

                            <div
                                class="form-check form-switch"
                            >

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    role="switch"
                                    name="is_featured"
                                    value="1"
                                    id="isFeatured"
                                    @checked(
                                        old(
                                            'is_featured',
                                            $review->is_featured
                                        )
                                    )
                                >

                                <label
                                    class="form-check-label fw-semibold"
                                    for="isFeatured"
                                >

                                    <i class="bi bi-star-fill text-warning me-1"></i>

                                    Featured Review

                                </label>

                            </div>


                            <small class="text-muted d-block mt-2">

                                Featured reviews can be highlighted
                                across the directory.

                            </small>

                        </div>

                    </div>

                </div>


                {{-- Helpful Count --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <strong>

                            <i class="bi bi-hand-thumbs-up me-2 text-primary"></i>

                            Engagement

                        </strong>

                    </div>


                    <div class="card-body">

                        <label class="form-label fw-semibold">
                            Helpful Count
                        </label>

                        <input
                            type="number"
                            name="helpful_count"
                            min="0"
                            class="form-control"
                            value="{{ old(
                                'helpful_count',
                                $review->helpful_count
                            ) }}"
                        >

                        <div class="form-text">

                            Number of users who found this review helpful.

                        </div>

                        @error('helpful_count')

                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                {{-- Review Summary --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <strong>

                            <i class="bi bi-info-circle me-2 text-primary"></i>

                            Review Summary

                        </strong>

                    </div>


                    <div class="card-body">


                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Review ID
                            </span>

                            <strong>
                                #{{ $review->id }}
                            </strong>

                        </div>


                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Rating
                            </span>

                            <span class="text-warning fw-semibold">

                                {{ $review->rating }}/5

                                <i class="bi bi-star-fill"></i>

                            </span>

                        </div>


                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Created
                            </span>

                            <span class="text-end">

                                {{ $review->created_at?->format(
                                    'd M Y'
                                ) }}

                            </span>

                        </div>


                        <div class="d-flex justify-content-between">

                            <span class="text-muted">
                                Last Updated
                            </span>

                            <span class="text-end">

                                {{ $review->updated_at?->format(
                                    'd M Y'
                                ) }}

                            </span>

                        </div>

                    </div>

                </div>


                {{-- Danger Zone --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white py-3">

                        <strong class="text-danger">

                            <i class="bi bi-exclamation-triangle me-2"></i>

                            Danger Zone

                        </strong>

                    </div>


                    <div class="card-body">

                        <p class="text-muted small">

                            Deleting this review is permanent and
                            cannot be undone.

                        </p>


                        <button
                            type="button"
                            class="btn btn-outline-danger w-100"
                            onclick="deleteReview()"
                        >

                            <i class="bi bi-trash me-1"></i>

                            Delete Review

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>


    {{-- Hidden Delete Form --}}
    <form
        id="deleteReviewForm"
        action="{{ route(
            'admin.reviews.destroy',
            $review
        ) }}"
        method="POST"
        class="d-none"
    >

        @csrf
        @method('DELETE')

    </form>

</div>


{{-- =============================================================
    DELETE SCRIPT
============================================================= --}}

<script>

function deleteReview()
{
    const confirmed = confirm(
        'Are you sure you want to permanently delete this review?'
    );

    if (confirmed) {
        document.getElementById('deleteReviewForm').submit();
    }
}

</script>

@endsection
