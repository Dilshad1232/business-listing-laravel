@extends('admin.layouts.master')

@section('title', 'Edit Business')

@section('content')

<div class="container-fluid py-3">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Edit Business</h4>

            <p class="text-muted mb-0">
                Update business information and listing settings.
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

    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif

    <form
        action="{{ route('admin.businesses.update', $business) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        {{-- =========================================================
            BASIC INFORMATION
        ========================================================== --}}
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
                            class="form-select"
                            required
                        >

                            <option value="">
                                Select Owner
                            </option>

                            @foreach($users as $user)

                                <option
                                    value="{{ $user->id }}"
                                    {{ old('user_id', $business->user_id) == $user->id ? 'selected' : '' }}
                                >
                                    {{ $user->name }} — {{ $user->email }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Business Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $business->name) }}"
                            class="form-control"
                            required
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Tagline
                        </label>

                        <input
                            type="text"
                            name="tagline"
                            value="{{ old('tagline', $business->tagline) }}"
                            class="form-control"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Slug
                        </label>

                        <input
                            type="text"
                            name="slug"
                            value="{{ old('slug', $business->slug) }}"
                            class="form-control"
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
                        >{{ old('description', $business->description) }}</textarea>

                    </div>


                    {{-- Business Images --}}
                    <div class="row g-4 mt-2">

                        {{-- Logo --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Business Logo
                            </label>

                            @if($business->logo)

                                <div class="mb-2">

                                    <img
                                        src="{{ asset('storage/' . $business->logo) }}"
                                        alt="{{ $business->name }}"
                                        style="
                                            width: 100px;
                                            height: 100px;
                                            object-fit: cover;
                                            border-radius: 12px;
                                        "
                                    >

                                </div>

                            @endif

                            <input
                                type="file"
                                name="logo"
                                class="form-control"
                                accept="image/jpeg,image/png,image/webp"
                            >

                            <div class="form-text">
                                JPG, PNG or WebP. Maximum 2MB.
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

                            @if($business->cover_image)

                                <div class="mb-2">

                                    <img
                                        src="{{ asset('storage/' . $business->cover_image) }}"
                                        alt="{{ $business->name }}"
                                        style="
                                            width: 220px;
                                            height: 100px;
                                            object-fit: cover;
                                            border-radius: 12px;
                                        "
                                    >

                                </div>

                            @endif

                            <input
                                type="file"
                                name="cover_image"
                                class="form-control"
                                accept="image/jpeg,image/png,image/webp"
                            >

                            <div class="form-text">
                                JPG, PNG or WebP. Maximum 4MB.
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


        {{-- =========================================================
            CATEGORY
        ========================================================== --}}
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
                                    {{ old('category_id', $business->category_id) == $category->id ? 'selected' : '' }}
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
                                    {{ old('subcategory_id', $business->subcategory_id) == $subcategory->id ? 'selected' : '' }}
                                >
                                    {{ $subcategory->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            LOCATION
        ========================================================== --}}
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
                                    {{ old('country_id', $business->country_id) == $country->id ? 'selected' : '' }}
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
                                    {{ old('state_id', $business->state_id) == $state->id ? 'selected' : '' }}
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
                                    {{ old('city_id', $business->city_id) == $city->id ? 'selected' : '' }}
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
                                    {{ old('area_id', $business->area_id) == $area->id ? 'selected' : '' }}
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
                        >{{ old('address', $business->address) }}</textarea>

                    </div>


                    <div class="col-md-3">

                        <label class="form-label">
                            Pincode
                        </label>

                        <input
                            type="text"
                            name="pincode"
                            value="{{ old('pincode', $business->pincode) }}"
                            class="form-control"
                        >

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            BUSINESS HOURS
        ========================================================== --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white">

                <div class="d-flex justify-content-between align-items-center">

                    <strong>
                        <i class="bi bi-clock me-2"></i>
                        Business Hours
                    </strong>

                    <span class="badge bg-light text-dark border">
                        Weekly Schedule
                    </span>

                </div>

            </div>

            <div class="card-body">

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


                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead>

                            <tr>

                                <th style="min-width: 130px;">
                                    Day
                                </th>

                                <th style="width: 100px;">
                                    Closed
                                </th>

                                <th style="width: 110px;">
                                    24 Hours
                                </th>

                                <th>
                                    Opening
                                </th>

                                <th>
                                    Closing
                                </th>

                                <th>
                                    Opening 2
                                </th>

                                <th>
                                    Closing 2
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($businessDays as $dayNumber => $dayName)

                                @php

                                    $hour = $businessHours[$dayNumber] ?? null;

                                    $isClosed = old(
                                        "business_hours.$dayNumber.is_closed",
                                        $hour?->is_closed ?? false
                                    );

                                    $is24Hours = old(
                                        "business_hours.$dayNumber.is_24_hours",
                                        $hour?->is_24_hours ?? false
                                    );

                                    $openingTime = old(
                                        "business_hours.$dayNumber.opening_time",
                                        $hour?->opening_time
                                            ? \Carbon\Carbon::parse($hour->opening_time)->format('H:i')
                                            : ''
                                    );

                                    $closingTime = old(
                                        "business_hours.$dayNumber.closing_time",
                                        $hour?->closing_time
                                            ? \Carbon\Carbon::parse($hour->closing_time)->format('H:i')
                                            : ''
                                    );

                                    $openingTime2 = old(
                                        "business_hours.$dayNumber.opening_time_2",
                                        $hour?->opening_time_2
                                            ? \Carbon\Carbon::parse($hour->opening_time_2)->format('H:i')
                                            : ''
                                    );

                                    $closingTime2 = old(
                                        "business_hours.$dayNumber.closing_time_2",
                                        $hour?->closing_time_2
                                            ? \Carbon\Carbon::parse($hour->closing_time_2)->format('H:i')
                                            : ''
                                    );

                                @endphp


                                <tr>

                                    {{-- Day --}}
                                    <td>

                                        <div class="fw-semibold">
                                            {{ $dayName }}
                                        </div>

                                    </td>


                                    {{-- Closed --}}
                                    <td>

                                        <div class="form-check">

                                            <input
                                                type="checkbox"
                                                name="business_hours[{{ $dayNumber }}][is_closed]"
                                                value="1"
                                                class="form-check-input edit-closed-checkbox"
                                                id="editClosed{{ $dayNumber }}"
                                                {{ $isClosed ? 'checked' : '' }}
                                            >

                                            <label
                                                class="form-check-label"
                                                for="editClosed{{ $dayNumber }}"
                                            >
                                                Closed
                                            </label>

                                        </div>

                                    </td>


                                    {{-- 24 Hours --}}
                                    <td>

                                        <div class="form-check">

                                            <input
                                                type="checkbox"
                                                name="business_hours[{{ $dayNumber }}][is_24_hours]"
                                                value="1"
                                                class="form-check-input edit-24-checkbox"
                                                id="edit24{{ $dayNumber }}"
                                                {{ $is24Hours ? 'checked' : '' }}
                                            >

                                            <label
                                                class="form-check-label"
                                                for="edit24{{ $dayNumber }}"
                                            >
                                                24 Hrs
                                            </label>

                                        </div>

                                    </td>


                                    {{-- Opening --}}
                                    <td>

                                        <input
                                            type="time"
                                            name="business_hours[{{ $dayNumber }}][opening_time]"
                                            value="{{ $openingTime }}"
                                            class="form-control edit-time-input"
                                            {{ ($isClosed || $is24Hours) ? 'disabled' : '' }}
                                        >

                                    </td>


                                    {{-- Closing --}}
                                    <td>

                                        <input
                                            type="time"
                                            name="business_hours[{{ $dayNumber }}][closing_time]"
                                            value="{{ $closingTime }}"
                                            class="form-control edit-time-input"
                                            {{ ($isClosed || $is24Hours) ? 'disabled' : '' }}
                                        >

                                    </td>


                                    {{-- Opening 2 --}}
                                    <td>

                                        <input
                                            type="time"
                                            name="business_hours[{{ $dayNumber }}][opening_time_2]"
                                            value="{{ $openingTime2 }}"
                                            class="form-control edit-time-input"
                                            {{ ($isClosed || $is24Hours) ? 'disabled' : '' }}
                                        >

                                    </td>


                                    {{-- Closing 2 --}}
                                    <td>

                                        <input
                                            type="time"
                                            name="business_hours[{{ $dayNumber }}][closing_time_2]"
                                            value="{{ $closingTime2 }}"
                                            class="form-control edit-time-input"
                                            {{ ($isClosed || $is24Hours) ? 'disabled' : '' }}
                                        >

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>


                <div class="mt-3">

                    <small class="text-muted">
                        <i class="bi bi-info-circle me-1"></i>
                        Use the second opening and closing fields when the business
                        closes temporarily during the day.
                    </small>

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
                    Add multiple high-quality photos to showcase this business.
                </p>
            </div>

            <span class="badge bg-light text-dark border">
                {{ $business->photos->count() }} Photos
            </span>

        </div>
    </div>

    <div class="card-body">

        {{-- Upload New Photos --}}
        <div class="mb-4">

            <label class="form-label fw-semibold">
                Upload New Photos
            </label>

            <input
                type="file"
                name="photos[]"
                id="businessGalleryPhotos"
                class="form-control"
                accept="image/jpeg,image/png,image/webp"
                multiple
            >

            <div class="form-text">
                JPG, JPEG, PNG or WEBP · Maximum 5MB per image · Up to 20 images
            </div>

            {{-- New Image Preview --}}
            <div
                id="galleryPreview"
                class="row g-3 mt-2"
            ></div>

        </div>


        {{-- Existing Gallery --}}
        @if($business->photos->count())

            <div class="border-top pt-4">

                <div class="d-flex align-items-center justify-content-between mb-3">

                    <div>
                        <h6 class="fw-bold mb-1">
                            Existing Gallery
                        </h6>

                        <small class="text-muted">
                            Select a photo as featured or mark photos for deletion.
                        </small>
                    </div>

                </div>


                <div class="row g-4">

                    @foreach($business->photos as $photo)

                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3">

                            <div
                                class="border rounded-4 overflow-hidden h-100 bg-white shadow-sm"
                            >

                                {{-- Image --}}
                                <div
                                    class="position-relative"
                                    style="height:190px;"
                                >

                                    <img
                                        src="{{ asset('storage/' . $photo->image) }}"
                                        alt="{{ $business->name }}"
                                        class="w-100 h-100"
                                        style="object-fit:cover;"
                                    >


                                    {{-- Featured --}}
                                    @if($photo->is_featured)

                                        <span
                                            class="position-absolute top-0 start-0 m-2 badge bg-warning text-dark"
                                        >
                                            <i class="bi bi-star-fill me-1"></i>
                                            Featured
                                        </span>

                                    @endif

                                </div>


                                {{-- Controls --}}
                                <div class="p-3">

                                    <div class="form-check mb-2">

                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="featured_photo"
                                            value="{{ $photo->id }}"
                                            id="featuredPhoto{{ $photo->id }}"
                                            {{ $photo->is_featured ? 'checked' : '' }}
                                        >

                                        <label
                                            class="form-check-label small fw-semibold"
                                            for="featuredPhoto{{ $photo->id }}"
                                        >
                                            Set as featured photo
                                        </label>

                                    </div>


                                    <div class="form-check">

                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            name="delete_photos[]"
                                            value="{{ $photo->id }}"
                                            id="deletePhoto{{ $photo->id }}"
                                        >

                                        <label
                                            class="form-check-label small text-danger"
                                            for="deletePhoto{{ $photo->id }}"
                                        >
                                            Delete this photo
                                        </label>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        @else

            <div class="text-center border-top pt-5 mt-4">

                <div
                    class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle bg-light"
                    style="width:80px;height:80px;"
                >
                    <i class="bi bi-images fs-1 text-muted"></i>
                </div>

                <h6 class="fw-bold">
                    No Gallery Photos
                </h6>

                <p class="text-muted small mb-0">
                    Upload some photos to showcase this business.
                </p>

            </div>

        @endif

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
                    Manage the services offered by this business.
                </p>

            </div>

            <button
            type="button"
            class="btn btn-primary"
            id="editAddBusinessService"
        >
            <i class="bi bi-plus-lg me-1"></i>
            Add Service
        </button>

        </div>

    </div>

    <div class="card-body">

        <div
            id="editBusinessServicesContainer"
            class="d-flex flex-column gap-3"
        >

            @forelse($business->services as $index => $service)

                <div
                    class="business-service-item border rounded-3 p-3 p-md-4 bg-light"
                    data-service-id="{{ $service->id }}"
                >

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
                                        {{ $index + 1 }}
                                    </span>

                                </div>

                                <div class="small text-muted">
                                    Edit service information
                                </div>

                            </div>

                        </div>

                        <button
                            type="button"
                            class="btn btn-sm btn-outline-danger
                                   remove-existing-business-service"
                            title="Remove Service"
                        >
                            <i class="bi bi-trash"></i>
                        </button>

                    </div>

                    <input
                        type="hidden"
                        name="services[{{ $index }}][id]"
                        value="{{ $service->id }}"
                        class="service-id-input"
                    >

                    <div class="row g-3">

                        {{-- Service Name --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Service Name
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="services[{{ $index }}][name]"
                                value="{{ old(
                                    'services.' . $index . '.name',
                                    $service->name
                                ) }}"
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
                                    name="services[{{ $index }}][price]"
                                    value="{{ old(
                                        'services.' . $index . '.price',
                                        $service->price
                                    ) }}"
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
                                name="services[{{ $index }}][duration]"
                                value="{{ old(
                                    'services.' . $index . '.duration',
                                    $service->duration
                                ) }}"
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
                                name="services[{{ $index }}][short_description]"
                                value="{{ old(
                                    'services.' . $index . '.short_description',
                                    $service->short_description
                                ) }}"
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
                                name="services[{{ $index }}][description]"
                                rows="3"
                                class="form-control"
                                placeholder="Describe this service in detail..."
                            >{{ old(
                                'services.' . $index . '.description',
                                $service->description
                            ) }}</textarea>

                        </div>

                        {{-- Status --}}
                        <div class="col-md-6">

                            <div class="form-check form-switch mt-md-2">

                                <input
                                    type="checkbox"
                                    name="services[{{ $index }}][status]"
                                    value="1"
                                    class="form-check-input"
                                    id="editServiceStatus{{ $service->id }}"
                                    {{ old(
                                        'services.' . $index . '.status',
                                        $service->status
                                    ) ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label fw-semibold"
                                    for="editServiceStatus{{ $service->id }}"
                                >
                                    Active Service
                                </label>

                            </div>

                            <div class="form-text">
                                Active services will appear on the public business profile.
                            </div>

                        </div>

                        {{-- Display Order --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Display Order
                            </label>

                            <input
                                type="number"
                                name="services[{{ $index }}][sort_order]"
                                value="{{ old(
                                    'services.' . $index . '.sort_order',
                                    $service->sort_order
                                ) }}"
                                class="form-control"
                                min="0"
                            >

                        </div>

                    </div>

                </div>

            @empty

                {{-- Empty state will be handled by JavaScript --}}

            @endforelse

        </div>

        <div
            id="editBusinessServicesEmpty"
            class="text-center py-5
            {{ $business->services->count() > 0 ? 'd-none' : '' }}"
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
                id="editAddFirstBusinessService"
            >
                <i class="bi bi-plus-lg me-1"></i>
                Add First Service
            </button>

        </div>

    </div>

</div>
        {{-- =========================================================
            CONTACT
        ========================================================== --}}
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
                            value="{{ old('phone', $business->phone) }}"
                            class="form-control"
                        >

                    </div>


                    <div class="col-md-4">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $business->email) }}"
                            class="form-control"
                        >

                    </div>


                    <div class="col-md-4">

                        <label class="form-label">
                            Website
                        </label>

                        <input
                            type="url"
                            name="website"
                            value="{{ old('website', $business->website) }}"
                            class="form-control"
                        >

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            LISTING SETTINGS
        ========================================================== --}}
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
                                {{ old('status', $business->status) === 'pending' ? 'selected' : '' }}
                            >
                                Pending
                            </option>

                            <option
                                value="approved"
                                {{ old('status', $business->status) === 'approved' ? 'selected' : '' }}
                            >
                                Approved
                            </option>

                            <option
                                value="rejected"
                                {{ old('status', $business->status) === 'rejected' ? 'selected' : '' }}
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
                            value="{{ old('rating', $business->rating) }}"
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
                            value="{{ old('reviews_count', $business->reviews_count) }}"
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
                                {{ old('is_featured', $business->is_featured) ? 'checked' : '' }}
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
                        >{{ old('admin_notes', $business->admin_notes) }}</textarea>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            SEO
        ========================================================== --}}
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
                        value="{{ old('meta_title', $business->meta_title) }}"
                        class="form-control"
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
                    >{{ old('meta_description', $business->meta_description) }}</textarea>

                </div>

            </div>

        </div>


        {{-- =========================================================
            SUBMIT
        ========================================================== --}}
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
                Update Business
            </button>

        </div>

    </form>

</div>


{{-- =========================================================
    BUSINESS HOURS JAVASCRIPT
========================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const closedCheckboxes = document.querySelectorAll(
        '.edit-closed-checkbox'
    );

    const hours24Checkboxes = document.querySelectorAll(
        '.edit-24-checkbox'
    );


    function updateDayState(row) {

        const closedCheckbox = row.querySelector(
            '.edit-closed-checkbox'
        );

        const hours24Checkbox = row.querySelector(
            '.edit-24-checkbox'
        );

        const timeInputs = row.querySelectorAll(
            '.edit-time-input'
        );


        const disabled =
            closedCheckbox.checked ||
            hours24Checkbox.checked;


        timeInputs.forEach(function (input) {

            input.disabled = disabled;

            if (disabled) {
                input.value = '';
            }

        });

    }


    closedCheckboxes.forEach(function (checkbox) {

        checkbox.addEventListener('change', function () {

            const row = this.closest('tr');

            const hours24Checkbox = row.querySelector(
                '.edit-24-checkbox'
            );


            if (this.checked) {
                hours24Checkbox.checked = false;
            }


            updateDayState(row);

        });

    });


    hours24Checkboxes.forEach(function (checkbox) {

        checkbox.addEventListener('change', function () {

            const row = this.closest('tr');

            const closedCheckbox = row.querySelector(
                '.edit-closed-checkbox'
            );


            if (this.checked) {
                closedCheckbox.checked = false;
            }


            updateDayState(row);

        });

    });


    document
        .querySelectorAll('tbody tr')
        .forEach(function (row) {

            if (
                row.querySelector('.edit-closed-checkbox') &&
                row.querySelector('.edit-24-checkbox')
            ) {

                updateDayState(row);

            }

        });

});

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const input = document.getElementById('businessGalleryPhotos');
        const preview = document.getElementById('galleryPreview');

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

        console.log('Business Services JS Loaded');

        const container = document.getElementById(
            'editBusinessServicesContainer'
        );

        const emptyState = document.getElementById(
            'editBusinessServicesEmpty'
        );

        const addButton = document.getElementById(
            'editAddBusinessService'
        );

        const addFirstButton = document.getElementById(
            'editAddFirstBusinessService'
        );

        console.log('Container:', container);
        console.log('Add Button:', addButton);

        if (!container || !addButton) {
            console.error('Business Services elements not found.');
            return;
        }

        let serviceIndex =
            container.querySelectorAll(
                '.business-service-item'
            ).length;


        /* =====================================================
           EMPTY STATE
        ====================================================== */

        function updateEmptyState() {

            const count =
                container.querySelectorAll(
                    '.business-service-item'
                ).length;

            if (count === 0) {

                emptyState?.classList.remove('d-none');

            } else {

                emptyState?.classList.add('d-none');

            }
        }


        /* =====================================================
           SERVICE NUMBER
        ====================================================== */

        function updateNumbers() {

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


        /* =====================================================
           ADD SERVICE
        ====================================================== */

        function addService() {

            console.log('Add Service clicked');

            const index = serviceIndex++;

            const card = document.createElement('div');

            card.className =
                'business-service-item border rounded-3 p-3 p-md-4 bg-light';

            card.innerHTML = `

                <div class="d-flex align-items-center justify-content-between mb-3">

                    <div class="d-flex align-items-center gap-2">

                        <div
                            class="d-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10"
                            style="width:40px;height:40px;"
                        >
                            <i class="bi bi-briefcase text-primary"></i>
                        </div>

                        <div>

                            <div class="fw-semibold">
                                Service
                                <span class="service-number">
                                    1
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


                    <!-- Service Name -->

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


                    <!-- Price -->

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


                    <!-- Duration -->

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


                    <!-- Short Description -->

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


                    <!-- Description -->

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


                    <!-- Status -->

                    <div class="col-md-6">

                        <div class="form-check form-switch mt-md-2">

                            <input
                                type="checkbox"
                                name="services[${index}][status]"
                                value="1"
                                class="form-check-input"
                                id="newServiceStatus${index}"
                                checked
                            >

                            <label
                                class="form-check-label fw-semibold"
                                for="newServiceStatus${index}"
                            >
                                Active Service
                            </label>

                        </div>

                        <div class="form-text">
                            Active services will appear on the public business profile.
                        </div>

                    </div>


                    <!-- Display Order -->

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


            /* =================================================
               ADD CARD
            ================================================== */

            container.appendChild(card);

            updateNumbers();
            updateEmptyState();


            /* =================================================
               SCROLL TO NEW SERVICE
            ================================================== */

            setTimeout(function () {

                card.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });

                const nameInput =
                    card.querySelector(
                        'input[name*="[name]"]'
                    );

                if (nameInput) {
                    nameInput.focus();
                }

            }, 100);


            /* =================================================
               REMOVE NEW SERVICE
            ================================================== */

            const removeButton =
                card.querySelector(
                    '.remove-business-service'
                );

            if (removeButton) {

                removeButton.addEventListener(
                    'click',
                    function () {

                        card.remove();

                        updateNumbers();
                        updateEmptyState();

                    }
                );

            }

        }


        /* =====================================================
           ADD SERVICE BUTTON
        ====================================================== */

        addButton.addEventListener(
            'click',
            function (event) {

                event.preventDefault();
                event.stopPropagation();

                addService();

            }
        );


        /* =====================================================
           ADD FIRST SERVICE
        ====================================================== */

        if (addFirstButton) {

            addFirstButton.addEventListener(
                'click',
                function (event) {

                    event.preventDefault();
                    event.stopPropagation();

                    addService();

                }
            );

        }


        /* =====================================================
           EXISTING SERVICE DELETE
        ====================================================== */

        container
            .querySelectorAll(
                '.remove-existing-business-service'
            )
            .forEach(function (button) {

                button.addEventListener(
                    'click',
                    function (event) {

                        event.preventDefault();
                        event.stopPropagation();

                        const card =
                            button.closest(
                                '.business-service-item'
                            );

                        if (!card) {
                            return;
                        }

                        const idInput =
                            card.querySelector(
                                '.service-id-input'
                            );

                        if (idInput) {

                            const form =
                                container.closest('form');

                            if (form) {

                                const deleteInput =
                                    document.createElement(
                                        'input'
                                    );

                                deleteInput.type =
                                    'hidden';

                                deleteInput.name =
                                    'delete_services[]';

                                deleteInput.value =
                                    idInput.value;

                                form.appendChild(
                                    deleteInput
                                );

                            }

                        }

                        card.remove();

                        updateNumbers();
                        updateEmptyState();

                    }
                );

            });


        /* =====================================================
           INITIAL
        ====================================================== */

        updateNumbers();
        updateEmptyState();

    });
    </script>
@endsection
