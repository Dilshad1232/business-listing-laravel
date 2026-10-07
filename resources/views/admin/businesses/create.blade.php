@extends('admin.layouts.master')

@section('title', 'Add Business')

@section('content')

<div class="container-fluid py-3">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Add Business</h4>

            <p class="text-muted mb-0">
                Create a new business listing.
            </p>
        </div>

        <a
            href="{{ route('admin.businesses.index') }}"
            class="btn btn-outline-secondary"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Back
        </a>

    </div>

    <form
        action="{{ route('admin.businesses.store') }}"
        method="POST" enctype="multipart/form-data"
    >

        @csrf

        {{-- Basic Information --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">
                <strong>
                    <i class="bi bi-building me-2"></i>
                    Basic Information
                </strong>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Business Owner
                        </label>

                        <select
                            name="user_id"
                            class="form-select @error('user_id') is-invalid @enderror"
                            required
                        >

                            <option value="">
                                Select Owner
                            </option>

                            @foreach($users as $user)

                                <option
                                    value="{{ $user->id }}"
                                    {{ old('user_id') == $user->id ? 'selected' : '' }}
                                >
                                    {{ $user->name }} — {{ $user->email }}
                                </option>

                            @endforeach

                        </select>

                        @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Business Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror"
                            placeholder="Enter business name"
                            required
                        >

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Tagline
                        </label>

                        <input
                            type="text"
                            name="tagline"
                            value="{{ old('tagline') }}"
                            class="form-control"
                            placeholder="Short business tagline"
                        >

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Slug
                        </label>

                        <input
                            type="text"
                            name="slug"
                            value="{{ old('slug') }}"
                            class="form-control"
                            placeholder="Leave blank for auto generate"
                        >

                    </div>

                    <div class="col-12">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            class="form-control"
                            placeholder="Describe the business..."
                        >{{ old('description') }}</textarea>

                    </div>
                    {{-- Business Images --}}
<div class="row g-4 mt-2">

    {{-- Logo --}}
    <div class="col-md-6">

        <label class="form-label fw-semibold">
            Business Logo
        </label>

        <input
            type="file"
            name="logo"
            class="form-control"
            accept="image/jpeg,image/png,image/webp"
        >

        <div class="form-text">
            JPG, PNG or WebP. Recommended: square image.
        </div>

        @error('logo')
            <div class="text-danger small mt-1">
                {{ $message }}
            </div>
        @enderror

    </div>


    {{-- Cover Image --}}
    <div class="col-md-6">

        <label class="form-label fw-semibold">
            Cover Image
        </label>

        <input
            type="file"
            name="cover_image"
            class="form-control"
            accept="image/jpeg,image/png,image/webp"
        >

        <div class="form-text">
            JPG, PNG or WebP. Recommended: wide image.
        </div>

        @error('cover_image')
            <div class="text-danger small mt-1">
                {{ $message }}
            </div>
        @enderror

    </div>

</div>

                </div>

            </div>

        </div>


        {{-- Category --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">
                <strong>
                    <i class="bi bi-grid me-2"></i>
                    Category
                </strong>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Category
                        </label>

                        <select
                            name="category_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Select Category
                            </option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Subcategory
                        </label>

                        <select
                            name="subcategory_id"
                            class="form-select"
                        >

                            <option value="">
                                Select Subcategory
                            </option>

                            @foreach($subcategories as $subcategory)

                                <option
                                    value="{{ $subcategory->id }}"
                                    {{ old('subcategory_id') == $subcategory->id ? 'selected' : '' }}
                                >
                                    {{ $subcategory->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

            </div>

        </div>


        {{-- Location --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">
                <strong>
                    <i class="bi bi-geo-alt me-2"></i>
                    Location
                </strong>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Country
                        </label>

                        <select
                            name="country_id"
                            class="form-select"
                        >

                            <option value="">
                                Select Country
                            </option>

                            @foreach($countries as $country)

                                <option
                                    value="{{ $country->id }}"
                                    {{ old('country_id') == $country->id ? 'selected' : '' }}
                                >
                                    {{ $country->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            State
                        </label>

                        <select
                            name="state_id"
                            class="form-select"
                        >

                            <option value="">
                                Select State
                            </option>

                            @foreach($states as $state)

                                <option
                                    value="{{ $state->id }}"
                                    {{ old('state_id') == $state->id ? 'selected' : '' }}
                                >
                                    {{ $state->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            City
                        </label>

                        <select
                            name="city_id"
                            class="form-select"
                        >

                            <option value="">
                                Select City
                            </option>

                            @foreach($cities as $city)

                                <option
                                    value="{{ $city->id }}"
                                    {{ old('city_id') == $city->id ? 'selected' : '' }}
                                >
                                    {{ $city->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6">

                        <label class="form-label">
                            Area
                        </label>

                        <select
                            name="area_id"
                            class="form-select"
                        >

                            <option value="">
                                Select Area
                            </option>

                            @foreach($areas as $area)

                                <option
                                    value="{{ $area->id }}"
                                    {{ old('area_id') == $area->id ? 'selected' : '' }}
                                >
                                    {{ $area->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-9">

                        <label class="form-label">
                            Address
                        </label>

                        <textarea
                            name="address"
                            rows="3"
                            class="form-control"
                            placeholder="Full business address"
                        >{{ old('address') }}</textarea>

                    </div>

                    <div class="col-md-3">

                        <label class="form-label">
                            Pincode
                        </label>

                        <input
                            type="text"
                            name="pincode"
                            value="{{ old('pincode') }}"
                            class="form-control"
                            placeholder="Pincode"
                        >

                    </div>

                </div>

            </div>

        </div>

{{-- Business Hours --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white">
        <strong>
            <i class="bi bi-clock me-2"></i>
            Business Hours
        </strong>
    </div>

    <div class="card-body">

        <p class="text-muted small mb-4">
            Set the regular opening hours for this business.
            You can keep a day closed or mark it as open 24 hours.
        </p>

        @php
            $businessDays = [
                1 => 'Monday',
                2 => 'Tuesday',
                3 => 'Wednesday',
                4 => 'Thursday',
                5 => 'Friday',
                6 => 'Saturday',
                0 => 'Sunday',
            ];
        @endphp

        <div class="row g-3">

            @foreach($businessDays as $dayNumber => $dayName)

                <div class="col-12">

                    <div class="border rounded-3 p-3">

                        <div class="row align-items-center g-3">

                            {{-- Day --}}
                            <div class="col-lg-2 col-md-3">

                                <div class="fw-semibold">
                                    {{ $dayName }}
                                </div>

                            </div>


                            {{-- Options --}}
                            <div class="col-lg-3 col-md-4">

                                <div class="d-flex flex-wrap gap-3">

                                    <div class="form-check">

                                        <input
                                            type="checkbox"
                                            class="form-check-input create-closed-checkbox"
                                            id="create_closed_{{ $dayNumber }}"
                                            name="business_hours[{{ $dayNumber }}][is_closed]"
                                            value="1"
                                        >

                                        <label
                                            class="form-check-label"
                                            for="create_closed_{{ $dayNumber }}"
                                        >
                                            Closed
                                        </label>

                                    </div>


                                    <div class="form-check">

                                        <input
                                            type="checkbox"
                                            class="form-check-input create-24-checkbox"
                                            id="create_24_{{ $dayNumber }}"
                                            name="business_hours[{{ $dayNumber }}][is_24_hours]"
                                            value="1"
                                        >

                                        <label
                                            class="form-check-label"
                                            for="create_24_{{ $dayNumber }}"
                                        >
                                            24 Hours
                                        </label>

                                    </div>

                                </div>

                            </div>


                            {{-- Opening --}}
                            <div class="col-lg-2 col-md-3">

                                <label class="form-label small text-muted mb-1">
                                    Opening
                                </label>

                                <input
                                    type="time"
                                    name="business_hours[{{ $dayNumber }}][opening_time]"
                                    class="form-control create-time-input"
                                >

                            </div>


                            {{-- Closing --}}
                            <div class="col-lg-2 col-md-3">

                                <label class="form-label small text-muted mb-1">
                                    Closing
                                </label>

                                <input
                                    type="time"
                                    name="business_hours[{{ $dayNumber }}][closing_time]"
                                    class="form-control create-time-input"
                                >

                            </div>


                            {{-- Second Slot --}}
                            <div class="col-lg-3 col-md-6">

                                <div class="row g-2">

                                    <div class="col-6">

                                        <label class="form-label small text-muted mb-1">
                                            Slot 2 Open
                                        </label>

                                        <input
                                            type="time"
                                            name="business_hours[{{ $dayNumber }}][opening_time_2]"
                                            class="form-control create-time-input"
                                        >

                                    </div>

                                    <div class="col-6">

                                        <label class="form-label small text-muted mb-1">
                                            Slot 2 Close
                                        </label>

                                        <input
                                            type="time"
                                            name="business_hours[{{ $dayNumber }}][closing_time_2]"
                                            class="form-control create-time-input"
                                        >

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</div>

{{-- =========================================================
    BUSINESS PHOTOS / GALLERY
========================================================= --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white border-bottom py-3">
        <div class="d-flex align-items-center justify-content-between">

            <div>
                <h5 class="mb-1 fw-bold">
                    <i class="bi bi-images me-2 text-primary"></i>
                    Business Photos & Gallery
                </h5>

                <p class="text-muted small mb-0">
                    Upload high-quality photos to showcase this business.
                </p>
            </div>

            <span class="badge bg-light text-dark border">
                Multiple Photos
            </span>

        </div>
    </div>

    <div class="card-body">

        <label class="form-label fw-semibold">
            Upload Business Photos
        </label>

        <input
            type="file"
            name="photos[]"
            id="createBusinessGalleryPhotos"
            class="form-control"
            accept="image/jpeg,image/png,image/webp"
            multiple
        >

        <div class="form-text">
            JPG, JPEG, PNG or WEBP · Maximum 5MB per image · Up to 20 images
        </div>


        {{-- Preview --}}
        <div
            id="createGalleryPreview"
            class="row g-3 mt-2"
        ></div>

    </div>

</div>

{{-- =========================================================
    BUSINESS SERVICES
========================================================= --}}
<div class="card border-0 shadow-sm mb-4">

    <div class="card-header bg-white border-bottom py-3">

        <div class="d-flex flex-column flex-md-row
                    align-items-md-center justify-content-between gap-3">

            <div>

                <h5 class="mb-1 fw-bold">

                    <i class="bi bi-briefcase me-2 text-primary"></i>

                    Business Services

                </h5>

                <p class="text-muted small mb-0">

                    Add the services offered by this business.

                </p>

            </div>

            <button
                type="button"
                class="btn btn-primary"
                id="addBusinessService"
            >

                <i class="bi bi-plus-lg me-1"></i>

                Add Service

            </button>

        </div>

    </div>


    <div class="card-body">

        <div
            id="businessServicesContainer"
            class="d-flex flex-column gap-3"
        >

            {{-- Service rows will be added here --}}

        </div>


        {{-- Empty State --}}
        <div
            id="businessServicesEmpty"
            class="text-center py-5"
        >

            <div
                class="mx-auto mb-3 d-flex align-items-center
                       justify-content-center rounded-circle
                       bg-primary bg-opacity-10"
                style="width:64px;height:64px;"
            >

                <i class="bi bi-briefcase text-primary fs-4"></i>

            </div>

            <h6 class="fw-semibold mb-1">
                No services added yet
            </h6>

            <p class="text-muted small mb-3">
                Add services to help customers understand what this business offers.
            </p>

            <button
                type="button"
                class="btn btn-outline-primary btn-sm"
                id="addFirstBusinessService"
            >

                <i class="bi bi-plus-lg me-1"></i>

                Add First Service

            </button>

        </div>

    </div>

</div>
        {{-- Contact --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">
                <strong>
                    <i class="bi bi-telephone me-2"></i>
                    Contact Information
                </strong>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-4">

                        <label class="form-label">
                            Phone
                        </label>

                        <input
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            class="form-control"
                            placeholder="Business phone"
                        >

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-control"
                            placeholder="Business email"
                        >

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">
                            Website
                        </label>

                        <input
                            type="url"
                            name="website"
                            value="{{ old('website') }}"
                            class="form-control"
                            placeholder="https://example.com"
                        >

                    </div>

                </div>

            </div>

        </div>


        {{-- Status --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">
                <strong>
                    <i class="bi bi-check-circle me-2"></i>
                    Listing Settings
                </strong>
            </div>

            <div class="card-body">

                <div class="row g-3">

                    <div class="col-md-4">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                            required
                        >

                            <option
                                value="pending"
                                {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}
                            >
                                Pending
                            </option>

                            <option
                                value="approved"
                                {{ old('status') === 'approved' ? 'selected' : '' }}
                            >
                                Approved
                            </option>

                            <option
                                value="rejected"
                                {{ old('status') === 'rejected' ? 'selected' : '' }}
                            >
                                Rejected
                            </option>

                        </select>

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">
                            Rating
                        </label>

                        <input
                            type="number"
                            name="rating"
                            value="{{ old('rating', 0) }}"
                            min="0"
                            max="5"
                            step="0.1"
                            class="form-control"
                        >

                    </div>

                    <div class="col-md-4">

                        <label class="form-label">
                            Reviews Count
                        </label>

                        <input
                            type="number"
                            name="reviews_count"
                            value="{{ old('reviews_count', 0) }}"
                            min="0"
                            class="form-control"
                        >

                    </div>

                    <div class="col-12">

                        <div class="form-check">

                            <input
                                type="checkbox"
                                name="is_featured"
                                value="1"
                                class="form-check-input"
                                id="isFeatured"
                                {{ old('is_featured') ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label"
                                for="isFeatured"
                            >
                                Mark this business as Featured
                            </label>

                        </div>

                    </div>

                    <div class="col-12">

                        <label class="form-label">
                            Admin Notes
                        </label>

                        <textarea
                            name="admin_notes"
                            rows="3"
                            class="form-control"
                            placeholder="Internal admin notes..."
                        >{{ old('admin_notes') }}</textarea>

                    </div>

                </div>

            </div>

        </div>


        {{-- SEO --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">
                <strong>
                    <i class="bi bi-search me-2"></i>
                    SEO Information
                </strong>
            </div>

            <div class="card-body">

                <div class="mb-3">

                    <label class="form-label">
                        Meta Title
                    </label>

                    <input
                        type="text"
                        name="meta_title"
                        value="{{ old('meta_title') }}"
                        class="form-control"
                        placeholder="SEO meta title"
                    >

                </div>

                <div>

                    <label class="form-label">
                        Meta Description
                    </label>

                    <textarea
                        name="meta_description"
                        rows="4"
                        class="form-control"
                        placeholder="SEO meta description"
                    >{{ old('meta_description') }}</textarea>

                </div>

            </div>

        </div>


        {{-- Submit --}}
        <div class="d-flex justify-content-end gap-2 mb-4">

            <a
                href="{{ route('admin.businesses.index') }}"
                class="btn btn-light border"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="btn btn-primary px-4"
            >
                <i class="bi bi-check-lg me-1"></i>
                Create Business
            </button>

        </div>

    </form>

</div>
<script>

    document.addEventListener('DOMContentLoaded', function () {

        document.querySelectorAll('.border.rounded-3.p-3').forEach(function (row) {

            const closedCheckbox =
                row.querySelector('.create-closed-checkbox');

            const hours24Checkbox =
                row.querySelector('.create-24-checkbox');

            const timeInputs =
                row.querySelectorAll('.create-time-input');


            if (!closedCheckbox || !hours24Checkbox) {
                return;
            }


            function updateTimeInputs() {

                const isClosed =
                    closedCheckbox.checked;

                const is24Hours =
                    hours24Checkbox.checked;


                timeInputs.forEach(function (input) {

                    input.disabled =
                        isClosed || is24Hours;

                    if (isClosed || is24Hours) {
                        input.value = '';
                    }

                });

            }


            closedCheckbox.addEventListener('change', function () {

                if (this.checked) {
                    hours24Checkbox.checked = false;
                }

                updateTimeInputs();

            });


            hours24Checkbox.addEventListener('change', function () {

                if (this.checked) {
                    closedCheckbox.checked = false;
                }

                updateTimeInputs();

            });


            updateTimeInputs();

        });

    });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const input = document.getElementById('createBusinessGalleryPhotos');
            const preview = document.getElementById('createGalleryPreview');

            if (!input || !preview) {
                return;
            }

            input.addEventListener('change', function () {

                preview.innerHTML = '';

                Array.from(this.files).forEach(function (file) {

                    if (!file.type.startsWith('image/')) {
                        return;
                    }

                    const reader = new FileReader();

                    reader.onload = function (event) {

                        const col = document.createElement('div');

                        col.className = 'col-6 col-md-4 col-lg-3';

                        col.innerHTML = `
                            <div class="border rounded-3 overflow-hidden bg-white shadow-sm">

                                <img
                                    src="${event.target.result}"
                                    class="w-100"
                                    style="height:140px;object-fit:cover;"
                                    alt="Preview"
                                >

                                <div class="p-2">

                                    <div
                                        class="small text-muted text-truncate"
                                        title="${file.name}"
                                    >
                                        ${file.name}
                                    </div>

                                </div>

                            </div>
                        `;

                        preview.appendChild(col);
                    };

                    reader.readAsDataURL(file);

                });

            });

        });
        </script>
        <script>

            document.addEventListener('DOMContentLoaded', function () {

                const container =
                    document.getElementById('businessServicesContainer');

                const emptyState =
                    document.getElementById('businessServicesEmpty');

                const addButton =
                    document.getElementById('addBusinessService');

                const addFirstButton =
                    document.getElementById('addFirstBusinessService');


                if (!container || !emptyState || !addButton) {
                    return;
                }


                let serviceIndex = 0;


                function updateEmptyState() {

                    if (container.children.length === 0) {

                        emptyState.classList.remove('d-none');

                    } else {

                        emptyState.classList.add('d-none');

                    }

                }


                function addService() {

                    const index = serviceIndex++;

                    const serviceCard =
                        document.createElement('div');

                    serviceCard.className =
                        'business-service-item border rounded-3 p-3 p-md-4 bg-light';


                    serviceCard.innerHTML = `

                        <div class="d-flex align-items-center
                                    justify-content-between mb-3">

                            <div class="d-flex align-items-center gap-2">

                                <div
                                    class="d-flex align-items-center
                                           justify-content-center
                                           rounded-3 bg-primary bg-opacity-10"
                                    style="width:40px;height:40px;"
                                >

                                    <i class="bi bi-briefcase text-primary"></i>

                                </div>

                                <div>

                                    <div class="fw-semibold">
                                        Service
                                        <span class="service-number">
                                            ${index + 1}
                                        </span>
                                    </div>

                                    <div class="small text-muted">
                                        Add service information
                                    </div>

                                </div>

                            </div>


                            <button
                                type="button"
                                class="btn btn-sm btn-outline-danger remove-business-service"
                                title="Remove Service"
                            >

                                <i class="bi bi-trash"></i>

                            </button>

                        </div>


                        <div class="row g-3">

                            {{-- Service Name --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Service Name

                                    <span class="text-danger">*</span>

                                </label>

                                <input
                                    type="text"
                                    name="services[${index}][name]"
                                    class="form-control"
                                    placeholder="e.g. Website Development"
                                    required
                                >

                            </div>


                            {{-- Price --}}
                            <div class="col-md-3">

                                <label class="form-label fw-semibold">

                                    Price

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        ₹
                                    </span>

                                    <input
                                        type="number"
                                        name="services[${index}][price]"
                                        class="form-control"
                                        placeholder="0"
                                        min="0"
                                        step="0.01"
                                    >

                                </div>

                            </div>


                            {{-- Duration --}}
                            <div class="col-md-3">

                                <label class="form-label fw-semibold">

                                    Duration

                                </label>

                                <input
                                    type="text"
                                    name="services[${index}][duration]"
                                    class="form-control"
                                    placeholder="e.g. 2 Hours"
                                >

                            </div>


                            {{-- Short Description --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">

                                    Short Description

                                </label>

                                <input
                                    type="text"
                                    name="services[${index}][short_description]"
                                    class="form-control"
                                    maxlength="500"
                                    placeholder="Brief description of this service"
                                >

                            </div>


                            {{-- Description --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">

                                    Description

                                </label>

                                <textarea
                                    name="services[${index}][description]"
                                    rows="3"
                                    class="form-control"
                                    placeholder="Describe this service in detail..."
                                ></textarea>

                            </div>


                            {{-- Status --}}
                            <div class="col-md-6">

                                <div class="form-check form-switch mt-md-2">

                                    <input
                                        type="checkbox"
                                        name="services[${index}][status]"
                                        value="1"
                                        class="form-check-input"
                                        id="serviceStatus${index}"
                                        checked
                                    >

                                    <label
                                        class="form-check-label fw-semibold"
                                        for="serviceStatus${index}"
                                    >

                                        Active Service

                                    </label>

                                </div>

                                <div class="form-text">
                                    Active services will appear on the public business profile.
                                </div>

                            </div>


                            {{-- Sort Order --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Display Order

                                </label>

                                <input
                                    type="number"
                                    name="services[${index}][sort_order]"
                                    class="form-control"
                                    value="${index + 1}"
                                    min="0"
                                >

                            </div>

                        </div>
                    `;


                    container.appendChild(serviceCard);

                    updateEmptyState();


                    const removeButton =
                        serviceCard.querySelector(
                            '.remove-business-service'
                        );


                    removeButton.addEventListener('click', function () {

                        serviceCard.remove();

                        updateServiceNumbers();

                        updateEmptyState();

                    });

                }


                function updateServiceNumbers() {

                    const items =
                        container.querySelectorAll(
                            '.business-service-item'
                        );


                    items.forEach(function (item, index) {

                        const number =
                            item.querySelector('.service-number');

                        if (number) {
                            number.textContent = index + 1;
                        }

                    });

                }


                addButton.addEventListener('click', function () {

                    addService();

                });


                if (addFirstButton) {

                    addFirstButton.addEventListener(
                        'click',
                        function () {

                            addService();

                        }
                    );

                }


                updateEmptyState();

            });

            </script>
@endsection
