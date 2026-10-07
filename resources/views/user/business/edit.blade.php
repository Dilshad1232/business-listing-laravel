@extends('layouts.user.master')

@section('title', 'Edit Business')

@section('content')

<div class="section-header mt-0">

    <div>
        <h4>Edit Business</h4>

        <div class="business-location mt-1">
            Update your business information
        </div>
    </div>

    <a href="{{ route('user.businesses.index') }}"
       class="btn btn-sm btn-light border">

        <i class="bi bi-arrow-left me-1"></i>
        My Businesses

    </a>

</div>


<form method="POST"
      action="{{ route('user.businesses.update', $business) }}"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')


    {{-- =========================================================
        BUSINESS INFORMATION
    ========================================================== --}}

    <div class="content-card mb-4">

        <div class="p-3 border-bottom">

            <div class="d-flex align-items-center gap-2">

                <div class="stat-icon icon-orange">
                    <i class="bi bi-buildings"></i>
                </div>

                <div>

                    <div class="business-name">
                        Business Information
                    </div>

                    <div class="business-location">
                        Basic details about your business
                    </div>

                </div>

            </div>

        </div>


        <div class="p-4">

            <div class="row g-4">

                {{-- Business Name --}}

                <div class="col-md-8">

                    <label class="form-label fw-semibold">
                        Business Name <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $business->name) }}"
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


                {{-- Tagline --}}

                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Tagline
                    </label>

                    <input
                        type="text"
                        name="tagline"
                        value="{{ old('tagline', $business->tagline) }}"
                        class="form-control @error('tagline') is-invalid @enderror"
                        placeholder="Short tagline"
                    >

                    @error('tagline')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Slug --}}

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Slug
                    </label>

                    <input
                        type="text"
                        name="slug"
                        value="{{ old('slug', $business->slug) }}"
                        class="form-control @error('slug') is-invalid @enderror"
                        placeholder="business-slug"
                    >

                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Category --}}

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Category <span class="text-danger">*</span>
                    </label>

                    <select
                        name="category_id"
                        id="category_id"
                        class="form-select @error('category_id') is-invalid @enderror"
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

                    @error('category_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Subcategory --}}

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Subcategory
                    </label>

                    <select
                        name="subcategory_id"
                        id="subcategory_id"
                        class="form-select @error('subcategory_id') is-invalid @enderror"
                    >

                        <option value="">
                            Loading Subcategories...
                        </option>

                    </select>

                    @error('subcategory_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Description --}}

                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Describe your business..."
                    >{{ old('description', $business->description) }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Logo --}}

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Business Logo
                    </label>

                    @if($business->logo)

                        <div class="mb-2">

                            <img
                                src="{{ asset('storage/' . $business->logo) }}"
                                alt="Business Logo"
                                style="width:90px;height:90px;object-fit:cover;border-radius:10px;border:1px solid #dee2e6;"
                            >

                        </div>

                    @endif

                    <input
                        type="file"
                        name="logo"
                        class="form-control @error('logo') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small class="text-muted">
                        JPG, PNG or WebP. Leave empty to keep current logo.
                    </small>

                    @error('logo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Cover --}}

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Cover Image
                    </label>

                    @if($business->cover_image)

                        <div class="mb-2">

                            <img
                                src="{{ asset('storage/' . $business->cover_image) }}"
                                alt="Cover Image"
                                style="width:180px;height:90px;object-fit:cover;border-radius:10px;border:1px solid #dee2e6;"
                            >

                        </div>

                    @endif

                    <input
                        type="file"
                        name="cover_image"
                        class="form-control @error('cover_image') is-invalid @enderror"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small class="text-muted">
                        JPG, PNG or WebP. Leave empty to keep current cover.
                    </small>

                    @error('cover_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        LOCATION
    ========================================================== --}}

    <div class="content-card mb-4">

        <div class="p-3 border-bottom">

            <div class="d-flex align-items-center gap-2">

                <div class="stat-icon icon-orange">
                    <i class="bi bi-geo-alt"></i>
                </div>

                <div>

                    <div class="business-name">
                        Business Location
                    </div>

                    <div class="business-location">
                        Select the location of your business
                    </div>

                </div>

            </div>

        </div>


        <div class="p-4">

            <div class="row g-4">

                {{-- Country --}}

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Country <span class="text-danger">*</span>
                    </label>

                    <select
                        name="country_id"
                        id="country_id"
                        class="form-select @error('country_id') is-invalid @enderror"
                        required
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

                    @error('country_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- State --}}

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        State <span class="text-danger">*</span>
                    </label>

                    <select
                        name="state_id"
                        id="state_id"
                        class="form-select @error('state_id') is-invalid @enderror"
                        required
                    >

                        <option value="">
                            Loading States...
                        </option>

                    </select>

                    @error('state_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- City --}}

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        City <span class="text-danger">*</span>
                    </label>

                    <select
                        name="city_id"
                        id="city_id"
                        class="form-select @error('city_id') is-invalid @enderror"
                        required
                    >

                        <option value="">
                            Loading Cities...
                        </option>

                    </select>

                    @error('city_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Area --}}

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Area
                    </label>

                    <select
                        name="area_id"
                        id="area_id"
                        class="form-select @error('area_id') is-invalid @enderror"
                    >

                        <option value="">
                            Loading Areas...
                        </option>

                    </select>

                    @error('area_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Address --}}

                <div class="col-md-8">

                    <label class="form-label fw-semibold">
                        Full Address
                    </label>

                    <textarea
                        name="address"
                        rows="3"
                        class="form-control @error('address') is-invalid @enderror"
                        placeholder="Enter complete business address"
                    >{{ old('address', $business->address) }}</textarea>

                    @error('address')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Pincode --}}

                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Pincode
                    </label>

                    <input
                        type="text"
                        name="pincode"
                        value="{{ old('pincode', $business->pincode) }}"
                        class="form-control @error('pincode') is-invalid @enderror"
                        placeholder="250001"
                    >

                    @error('pincode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        BUSINESS HOURS
    ========================================================== --}}

    <div class="content-card mb-4">

        <div class="p-3 border-bottom">

            <div class="d-flex align-items-center gap-2">

                <div class="stat-icon icon-blue">
                    <i class="bi bi-clock"></i>
                </div>

                <div>

                    <div class="business-name">
                        Business Hours
                    </div>

                    <div class="business-location">
                        Set the regular opening hours for your business
                    </div>

                </div>

            </div>

        </div>


        <div class="p-4">

            @php

                $days = [
                    1 => 'Monday',
                    2 => 'Tuesday',
                    3 => 'Wednesday',
                    4 => 'Thursday',
                    5 => 'Friday',
                    6 => 'Saturday',
                    0 => 'Sunday',
                ];

                $hoursByDay = $business->businessHours->keyBy('day_of_week');

            @endphp


            @foreach($days as $dayNumber => $dayName)

                @php
                    $hour = $hoursByDay->get($dayNumber);
                @endphp

                <div class="border rounded-3 p-3 mb-3">

                    <div class="row g-3 align-items-end">

                        <div class="col-lg-2">

                            <div class="fw-semibold">
                                {{ $dayName }}
                            </div>

                        </div>


                        {{-- Closed --}}

                        <div class="col-lg-2">

                            <div class="form-check">

                                <input
                                    type="checkbox"
                                    class="form-check-input hour-closed"
                                    name="business_hours[{{ $dayNumber }}][is_closed]"
                                    value="1"
                                    data-day="{{ $dayNumber }}"
                                    {{ old("business_hours.$dayNumber.is_closed", $hour?->is_closed) ? 'checked' : '' }}
                                >

                                <label class="form-check-label">
                                    Closed
                                </label>

                            </div>

                        </div>


                        {{-- 24 Hours --}}

                        <div class="col-lg-2">

                            <div class="form-check">

                                <input
                                    type="checkbox"
                                    class="form-check-input hour-24"
                                    name="business_hours[{{ $dayNumber }}][is_24_hours]"
                                    value="1"
                                    data-day="{{ $dayNumber }}"
                                    {{ old("business_hours.$dayNumber.is_24_hours", $hour?->is_24_hours) ? 'checked' : '' }}
                                >

                                <label class="form-check-label">
                                    24 Hours
                                </label>

                            </div>

                        </div>


                        {{-- Opening --}}

                        <div class="col-lg-2">

                            <label class="form-label small mb-1">
                                Opening
                            </label>

                            <input
                                type="time"
                                name="business_hours[{{ $dayNumber }}][opening_time]"
                                class="form-control hour-input hour-opening-{{ $dayNumber }}"
                                value="{{ old("business_hours.$dayNumber.opening_time", $hour?->opening_time ? substr($hour->opening_time, 0, 5) : '') }}"
                            >

                        </div>


                        {{-- Closing --}}

                        <div class="col-lg-2">

                            <label class="form-label small mb-1">
                                Closing
                            </label>

                            <input
                                type="time"
                                name="business_hours[{{ $dayNumber }}][closing_time]"
                                class="form-control hour-input hour-closing-{{ $dayNumber }}"
                                value="{{ old("business_hours.$dayNumber.closing_time", $hour?->closing_time ? substr($hour->closing_time, 0, 5) : '') }}"
                            >

                        </div>


                        {{-- Slot 2 --}}

                        <div class="col-lg-2">

                            <label class="form-label small mb-1">
                                Slot 2 Open
                            </label>

                            <input
                                type="time"
                                name="business_hours[{{ $dayNumber }}][opening_time_2]"
                                class="form-control hour-input hour-opening2-{{ $dayNumber }}"
                                value="{{ old("business_hours.$dayNumber.opening_time_2", $hour?->opening_time_2 ? substr($hour->opening_time_2, 0, 5) : '') }}"
                            >

                        </div>


                        <div class="col-lg-2">

                            <label class="form-label small mb-1">
                                Slot 2 Close
                            </label>

                            <input
                                type="time"
                                name="business_hours[{{ $dayNumber }}][closing_time_2]"
                                class="form-control hour-input hour-closing2-{{ $dayNumber }}"
                                value="{{ old("business_hours.$dayNumber.closing_time_2", $hour?->closing_time_2 ? substr($hour->closing_time_2, 0, 5) : '') }}"
                            >

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>


    {{-- =========================================================
        GALLERY
    ========================================================== --}}

    <div class="content-card mb-4">

        <div class="p-3 border-bottom">

            <div class="d-flex align-items-center gap-2">

                <div class="stat-icon icon-orange">
                    <i class="bi bi-images"></i>
                </div>

                <div>

                    <div class="business-name">
                        Business Photos & Gallery
                    </div>

                    <div class="business-location">
                        Upload new photos to showcase your business
                    </div>

                </div>

            </div>

        </div>


        <div class="p-4">

            {{-- Existing Photos --}}

            @if($business->photos->count())

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Existing Photos
                    </label>

                    <div class="row g-3">

                        @foreach($business->photos as $photo)

                            <div class="col-6 col-md-3">

                                <div class="border rounded-3 p-2">

                                    <img
                                        src="{{ asset('storage/' . $photo->image) }}"
                                        alt="Business Photo"
                                        class="w-100 rounded-2"
                                        style="height:140px;object-fit:cover;"
                                    >

                                    @if($photo->is_featured)

                                        <div class="small text-success fw-semibold mt-2">
                                            <i class="bi bi-star-fill me-1"></i>
                                            Featured Photo
                                        </div>

                                    @endif

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif


            {{-- New Photos --}}

            <label class="form-label fw-semibold">
                Upload New Photos
            </label>

            <input
                type="file"
                name="photos[]"
                id="photos"
                class="form-control @error('photos.*') is-invalid @enderror"
                accept=".jpg,.jpeg,.png,.webp"
                multiple
            >

            <div class="form-text">
                JPG, JPEG, PNG or WEBP · Maximum 5MB per image · Up to 20 images
            </div>

            <div
                id="photoPreview"
                class="row g-3 mt-2"
            ></div>

            @error('photos.*')
                <div class="text-danger small mt-2">
                    {{ $message }}
                </div>
            @enderror

        </div>

    </div>


    {{-- =========================================================
        SERVICES
    ========================================================== --}}

    <div class="content-card mb-4">

        <div class="p-3 border-bottom">

            <div class="d-flex align-items-center gap-2">

                <div class="stat-icon icon-blue">
                    <i class="bi bi-briefcase"></i>
                </div>

                <div>

                    <div class="business-name">
                        Business Services
                    </div>

                    <div class="business-location">
                        Add the services offered by this business
                    </div>

                </div>

            </div>

        </div>


        <div class="p-4">

            <div id="servicesContainer">

                @php
                    $existingServices = $business->services()->get();
                @endphp

                @forelse($existingServices as $index => $service)

                    <div class="service-item border rounded-3 p-3 mb-3">

                        <input
                            type="hidden"
                            name="services[{{ $index }}][id]"
                            value="{{ $service->id }}"
                        >

                        <div class="row g-3">

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Service Name
                                </label>

                                <input
                                    type="text"
                                    name="services[{{ $index }}][name]"
                                    value="{{ old("services.$index.name", $service->name) }}"
                                    class="form-control"
                                    placeholder="Website Development"
                                >

                            </div>


                            <div class="col-md-3">

                                <label class="form-label fw-semibold">
                                    Price
                                </label>

                                <input
                                    type="number"
                                    step="0.01"
                                    name="services[{{ $index }}][price]"
                                    value="{{ old("services.$index.price", $service->price) }}"
                                    class="form-control"
                                    placeholder="4999"
                                >

                            </div>


                            <div class="col-md-3">

                                <label class="form-label fw-semibold">
                                    Duration
                                </label>

                                <input
                                    type="text"
                                    name="services[{{ $index }}][duration]"
                                    value="{{ old("services.$index.duration", $service->duration) }}"
                                    class="form-control"
                                    placeholder="7 Days"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Short Description
                                </label>

                                <input
                                    type="text"
                                    name="services[{{ $index }}][short_description]"
                                    value="{{ old("services.$index.short_description", $service->short_description) }}"
                                    class="form-control"
                                    placeholder="Short service description"
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Description
                                </label>

                                <textarea
                                    name="services[{{ $index }}][description]"
                                    rows="2"
                                    class="form-control"
                                    placeholder="Service description"
                                >{{ old("services.$index.description", $service->description) }}</textarea>

                            </div>


                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Sort Order
                                </label>

                                <input
                                    type="number"
                                    name="services[{{ $index }}][sort_order]"
                                    value="{{ old("services.$index.sort_order", $service->sort_order ?? $index) }}"
                                    class="form-control"
                                    min="0"
                                >

                            </div>


                            <div class="col-md-3 d-flex align-items-end">

                                <div class="form-check mb-2">

                                    <input
                                        type="checkbox"
                                        name="services[{{ $index }}][status]"
                                        value="1"
                                        class="form-check-input"
                                        {{ old("services.$index.status", $service->status) ? 'checked' : '' }}
                                    >

                                    <label class="form-check-label">
                                        Active
                                    </label>

                                </div>

                            </div>


                            <div class="col-md-3 d-flex align-items-end justify-content-end">

                                <button
                                    type="button"
                                    class="btn btn-outline-danger btn-sm remove-service"
                                >
                                    <i class="bi bi-trash me-1"></i>
                                    Remove
                                </button>

                            </div>

                        </div>

                    </div>

                @empty

                    <div
                        id="noServicesMessage"
                        class="text-center text-muted py-4"
                    >

                        <i class="bi bi-briefcase fs-3 d-block mb-2"></i>

                        No services added yet

                    </div>

                @endforelse

            </div>


            <button
                type="button"
                id="addService"
                class="btn btn-outline-primary btn-sm"
            >
                <i class="bi bi-plus-circle me-1"></i>
                Add Service
            </button>

        </div>

    </div>


    {{-- =========================================================
        CONTACT
    ========================================================== --}}

    <div class="content-card mb-4">

        <div class="p-3 border-bottom">

            <div class="d-flex align-items-center gap-2">

                <div class="stat-icon icon-blue">
                    <i class="bi bi-telephone"></i>
                </div>

                <div>

                    <div class="business-name">
                        Contact Information
                    </div>

                    <div class="business-location">
                        Contact details customers can use
                    </div>

                </div>

            </div>

        </div>


        <div class="p-4">

            <div class="row g-4">

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Phone Number
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $business->phone) }}"
                        class="form-control @error('phone') is-invalid @enderror"
                        placeholder="+91 98765 43210"
                    >

                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $business->email) }}"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="business@example.com"
                    >

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Website
                    </label>

                    <input
                        type="url"
                        name="website"
                        value="{{ old('website', $business->website) }}"
                        class="form-control @error('website') is-invalid @enderror"
                        placeholder="https://example.com"
                    >

                    @error('website')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

        </div>


        <div class="p-3 border-top d-flex justify-content-end gap-2">

            <a
                href="{{ route('user.businesses.index') }}"
                class="btn btn-light border btn-sm"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="btn btn-primary btn-sm"
            >
                <i class="bi bi-check2-circle me-1"></i>
                Update Business
            </button>

        </div>

    </div>

</form>


@push('scripts')

<script>

document.addEventListener('DOMContentLoaded', function () {

    /* =========================================================
       LOCATION DROPDOWNS
    ========================================================== */

    const category = document.getElementById('category_id');
    const subcategory = document.getElementById('subcategory_id');

    const country = document.getElementById('country_id');
    const state = document.getElementById('state_id');
    const city = document.getElementById('city_id');
    const area = document.getElementById('area_id');


    const selectedSubcategory =
        @json(old('subcategory_id', $business->subcategory_id));

    const selectedState =
        @json(old('state_id', $business->state_id));

    const selectedCity =
        @json(old('city_id', $business->city_id));

    const selectedArea =
        @json(old('area_id', $business->area_id));


    function resetSelect(select, placeholder) {

        select.innerHTML =
            `<option value="">${placeholder}</option>`;

        select.disabled = true;
    }


    async function loadSelect(
        url,
        select,
        placeholder,
        selectedValue = null
    ) {

        resetSelect(select, 'Loading...');

        try {

            const response = await fetch(url);

            if (!response.ok) {
                throw new Error('Request failed');
            }

            const data = await response.json();

            select.innerHTML =
                `<option value="">${placeholder}</option>`;

            data.forEach(item => {

                const option =
                    document.createElement('option');

                option.value = item.id;
                option.textContent = item.name;

                if (
                    selectedValue !== null &&
                    String(selectedValue) === String(item.id)
                ) {
                    option.selected = true;
                }

                select.appendChild(option);

            });

            select.disabled = false;

        } catch (error) {

            console.error(error);

            select.innerHTML =
                `<option value="">${placeholder}</option>`;

            select.disabled = true;
        }
    }


    /* Category → Subcategory */

    category.addEventListener('change', async function () {

        resetSelect(
            subcategory,
            'Select Subcategory'
        );

        if (!this.value) {
            return;
        }

        const url =
            "{{ route('user.businesses.subcategories', ['category' => '__ID__']) }}"
            .replace('__ID__', this.value);

        await loadSelect(
            url,
            subcategory,
            'Select Subcategory'
        );
    });


    /* Country → State */

    country.addEventListener('change', async function () {

        resetSelect(state, 'Select State');
        resetSelect(city, 'Select City');
        resetSelect(area, 'Select Area');

        if (!this.value) {
            return;
        }

        const url =
            "{{ route('user.businesses.states', ['country' => '__ID__']) }}"
            .replace('__ID__', this.value);

        await loadSelect(
            url,
            state,
            'Select State'
        );
    });


    /* State → City */

    state.addEventListener('change', async function () {

        resetSelect(city, 'Select City');
        resetSelect(area, 'Select Area');

        if (!this.value) {
            return;
        }

        const url =
            "{{ route('user.businesses.cities', ['state' => '__ID__']) }}"
            .replace('__ID__', this.value);

        await loadSelect(
            url,
            city,
            'Select City'
        );
    });


    /* City → Area */

    city.addEventListener('change', async function () {

        resetSelect(area, 'Select Area');

        if (!this.value) {
            return;
        }

        const url =
            "{{ route('user.businesses.areas', ['city' => '__ID__']) }}"
            .replace('__ID__', this.value);

        await loadSelect(
            url,
            area,
            'Select Area'
        );
    });


    /* Existing Subcategory */

    if (category.value) {

        const url =
            "{{ route('user.businesses.subcategories', ['category' => '__ID__']) }}"
            .replace('__ID__', category.value);

        loadSelect(
            url,
            subcategory,
            'Select Subcategory',
            selectedSubcategory
        );
    }


    /* Existing State → City → Area */

    if (country.value) {

        const stateUrl =
            "{{ route('user.businesses.states', ['country' => '__ID__']) }}"
            .replace('__ID__', country.value);

        loadSelect(
            stateUrl,
            state,
            'Select State',
            selectedState
        ).then(async function () {

            if (!state.value) {
                return;
            }

            const cityUrl =
                "{{ route('user.businesses.cities', ['state' => '__ID__']) }}"
                .replace('__ID__', state.value);

            await loadSelect(
                cityUrl,
                city,
                'Select City',
                selectedCity
            );


            if (!city.value) {
                return;
            }

            const areaUrl =
                "{{ route('user.businesses.areas', ['city' => '__ID__']) }}"
                .replace('__ID__', city.value);

            await loadSelect(
                areaUrl,
                area,
                'Select Area',
                selectedArea
            );

        });
    }


    /* =========================================================
       BUSINESS HOURS
    ========================================================== */

    function updateHourState(day) {

        const closed =
            document.querySelector(
                `.hour-closed[data-day="${day}"]`
            );

        const fullDay =
            document.querySelector(
                `.hour-24[data-day="${day}"]`
            );

        const inputs =
            document.querySelectorAll(
                `[class*="hour-opening-${day}"],
                 [class*="hour-closing-${day}"],
                 [class*="hour-opening2-${day}"],
                 [class*="hour-closing2-${day}"]`
            );

        if (!closed || !fullDay) {
            return;
        }

        if (closed.checked || fullDay.checked) {

            inputs.forEach(input => {
                input.disabled = true;
            });

        } else {

            inputs.forEach(input => {
                input.disabled = false;
            });

        }
    }


    document.querySelectorAll('.hour-closed').forEach(input => {

        input.addEventListener('change', function () {

            const day = this.dataset.day;

            const fullDay =
                document.querySelector(
                    `.hour-24[data-day="${day}"]`
                );

            if (this.checked && fullDay) {
                fullDay.checked = false;
            }

            updateHourState(day);
        });

    });


    document.querySelectorAll('.hour-24').forEach(input => {

        input.addEventListener('change', function () {

            const day = this.dataset.day;

            const closed =
                document.querySelector(
                    `.hour-closed[data-day="${day}"]`
                );

            if (this.checked && closed) {
                closed.checked = false;
            }

            updateHourState(day);
        });

    });


    document.querySelectorAll('.hour-closed').forEach(input => {
        updateHourState(input.dataset.day);
    });


    /* =========================================================
       GALLERY PREVIEW
    ========================================================== */

    const photosInput =
        document.getElementById('photos');

    const photoPreview =
        document.getElementById('photoPreview');


    if (photosInput && photoPreview) {

        photosInput.addEventListener('change', function () {

            photoPreview.innerHTML = '';

            Array.from(this.files).forEach(file => {

                if (!file.type.startsWith('image/')) {
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (event) {

                    const col =
                        document.createElement('div');

                    col.className =
                        'col-6 col-md-3';

                    col.innerHTML = `
                        <div class="border rounded-3 p-2">
                            <img
                                src="${event.target.result}"
                                class="w-100 rounded-2"
                                style="height:140px;object-fit:cover;"
                            >
                        </div>
                    `;

                    photoPreview.appendChild(col);

                };

                reader.readAsDataURL(file);

            });

        });

    }


    /* =========================================================
       SERVICES
    ========================================================== */

    const servicesContainer =
        document.getElementById('servicesContainer');

    const addService =
        document.getElementById('addService');


    let serviceIndex =
        {{ $business->services()->count() }};


    function serviceTemplate(index) {

        return `
            <div class="service-item border rounded-3 p-3 mb-3">

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Service Name
                        </label>

                        <input
                            type="text"
                            name="services[${index}][name]"
                            class="form-control"
                            placeholder="Website Development"
                        >

                    </div>


                    <div class="col-md-3">

                        <label class="form-label fw-semibold">
                            Price
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="services[${index}][price]"
                            class="form-control"
                            placeholder="4999"
                        >

                    </div>


                    <div class="col-md-3">

                        <label class="form-label fw-semibold">
                            Duration
                        </label>

                        <input
                            type="text"
                            name="services[${index}][duration]"
                            class="form-control"
                            placeholder="7 Days"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Short Description
                        </label>

                        <input
                            type="text"
                            name="services[${index}][short_description]"
                            class="form-control"
                            placeholder="Short service description"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Description
                        </label>

                        <textarea
                            name="services[${index}][description]"
                            rows="2"
                            class="form-control"
                            placeholder="Service description"
                        ></textarea>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Sort Order
                        </label>

                        <input
                            type="number"
                            name="services[${index}][sort_order]"
                            value="${index}"
                            class="form-control"
                            min="0"
                        >

                    </div>


                    <div class="col-md-3 d-flex align-items-end">

                        <div class="form-check mb-2">

                            <input
                                type="checkbox"
                                name="services[${index}][status]"
                                value="1"
                                class="form-check-input"
                                checked
                            >

                            <label class="form-check-label">
                                Active
                            </label>

                        </div>

                    </div>


                    <div class="col-md-3 d-flex align-items-end justify-content-end">

                        <button
                            type="button"
                            class="btn btn-outline-danger btn-sm remove-service"
                        >
                            <i class="bi bi-trash me-1"></i>
                            Remove
                        </button>

                    </div>

                </div>

            </div>
        `;
    }


    if (addService) {

        addService.addEventListener('click', function () {

            const noServices =
                document.getElementById('noServicesMessage');

            if (noServices) {
                noServices.remove();
            }

            servicesContainer.insertAdjacentHTML(
                'beforeend',
                serviceTemplate(serviceIndex)
            );

            serviceIndex++;

        });

    }


    document.addEventListener('click', function (event) {

        const button =
            event.target.closest('.remove-service');

        if (!button) {
            return;
        }

        const service =
            button.closest('.service-item');

        if (service) {
            service.remove();
        }

    });

});

</script>

@endpush

@endsection
