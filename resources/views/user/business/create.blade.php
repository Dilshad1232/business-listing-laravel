@extends('layouts.user.master')

@section('title', 'Add Business')

@section('content')

<div class="section-header mt-0">

    <div>
        <h4>Add Business</h4>

        <div class="business-location mt-1">
            Create a new business listing
        </div>
    </div>

    <a href="{{ route('user.businesses.index') }}"
       class="btn btn-sm btn-light border">

        <i class="bi bi-arrow-left me-1"></i>
        My Businesses

    </a>

</div>


<form method="POST"
      action="{{ route('user.businesses.store') }}"
      enctype="multipart/form-data">

    @csrf


    {{-- =====================================================
         BUSINESS INFORMATION
    ====================================================== --}}

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
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Business Name <span class="text-danger">*</span>
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


                {{-- Tagline --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Tagline
                    </label>

                    <input
                        type="text"
                        name="tagline"
                        value="{{ old('tagline') }}"
                        class="form-control @error('tagline') is-invalid @enderror"
                        placeholder="Short business tagline"
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
                        value="{{ old('slug') }}"
                        class="form-control @error('slug') is-invalid @enderror"
                        placeholder="Leave blank for auto generate"
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
                                {{ old('category_id') == $category->id ? 'selected' : '' }}
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
                            Select Subcategory
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
                    >{{ old('description') }}</textarea>

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

                    <input
                        type="file"
                        name="logo"
                        class="form-control @error('logo') is-invalid @enderror"
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
                        class="form-control @error('cover_image') is-invalid @enderror"
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


    {{-- =====================================================
         LOCATION
    ====================================================== --}}

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
                                {{ old('country_id') == $country->id ? 'selected' : '' }}
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
                            Select State
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
                            Select City
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
                            Select Area
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
                    >{{ old('address') }}</textarea>

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
                        value="{{ old('pincode') }}"
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


    {{-- =====================================================
         BUSINESS HOURS
    ====================================================== --}}

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

            <p class="text-muted small mb-4">
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
                                                class="form-check-input user-closed-checkbox"
                                                id="user_closed_{{ $dayNumber }}"
                                                name="business_hours[{{ $dayNumber }}][is_closed]"
                                                value="1"
                                            >

                                            <label
                                                class="form-check-label"
                                                for="user_closed_{{ $dayNumber }}"
                                            >
                                                Closed
                                            </label>

                                        </div>


                                        <div class="form-check">

                                            <input
                                                type="checkbox"
                                                class="form-check-input user-24-checkbox"
                                                id="user_24_{{ $dayNumber }}"
                                                name="business_hours[{{ $dayNumber }}][is_24_hours]"
                                                value="1"
                                            >

                                            <label
                                                class="form-check-label"
                                                for="user_24_{{ $dayNumber }}"
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
                                        class="form-control user-time-input"
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
                                        class="form-control user-time-input"
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
                                                class="form-control user-time-input"
                                            >

                                        </div>

                                        <div class="col-6">

                                            <label class="form-label small text-muted mb-1">
                                                Slot 2 Close
                                            </label>

                                            <input
                                                type="time"
                                                name="business_hours[{{ $dayNumber }}][closing_time_2]"
                                                class="form-control user-time-input"
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


    {{-- =====================================================
         BUSINESS PHOTOS / GALLERY
    ====================================================== --}}

    <div class="content-card mb-4">

        <div class="p-3 border-bottom">

            <div class="d-flex align-items-center justify-content-between gap-3">

                <div class="d-flex align-items-center gap-2">

                    <div class="stat-icon icon-orange">
                        <i class="bi bi-images"></i>
                    </div>

                    <div>

                        <div class="business-name">
                            Business Photos & Gallery
                        </div>

                        <div class="business-location">
                            Upload photos to showcase your business
                        </div>

                    </div>

                </div>

                <span class="badge bg-light text-dark border">
                    Multiple Photos
                </span>

            </div>

        </div>


        <div class="p-4">

            <label class="form-label fw-semibold">
                Upload Business Photos
            </label>

            <input
                type="file"
                name="photos[]"
                id="createBusinessGalleryPhotos"
                class="form-control @error('photos.*') is-invalid @enderror"
                accept="image/jpeg,image/png,image/webp"
                multiple
            >

            <div class="form-text">
                JPG, JPEG, PNG or WEBP · Maximum 5MB per image · Up to 20 images
            </div>

            @error('photos.*')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror


            <div
                id="createGalleryPreview"
                class="row g-3 mt-2"
            ></div>

        </div>

    </div>


    {{-- =====================================================
         BUSINESS SERVICES
    ====================================================== --}}

    <div class="content-card mb-4">

        <div class="p-3 border-bottom">

            <div class="d-flex flex-column flex-md-row
                        align-items-md-center justify-content-between gap-3">

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


                <button
                    type="button"
                    class="btn btn-primary btn-sm"
                    id="addBusinessService"
                >

                    <i class="bi bi-plus-lg me-1"></i>
                    Add Service

                </button>

            </div>

        </div>


        <div class="p-4">

            <div
                id="businessServicesContainer"
                class="d-flex flex-column gap-3"
            ></div>


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


    {{-- =====================================================
         CONTACT INFORMATION
    ====================================================== --}}

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

                {{-- Phone --}}
                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Phone Number
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        class="form-control @error('phone') is-invalid @enderror"
                        placeholder="+91 98765 43210"
                    >

                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Email --}}
                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="business@example.com"
                    >

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Website --}}
                <div class="col-md-4">

                    <label class="form-label fw-semibold">
                        Website
                    </label>

                    <input
                        type="url"
                        name="website"
                        value="{{ old('website') }}"
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

    </div>


    {{-- =====================================================
         ACTIONS
    ====================================================== --}}

    <div class="content-card mb-4">

        <div class="p-3 d-flex justify-content-end gap-2">

            <a
                href="{{ route('user.businesses.index') }}"
                class="btn btn-light border"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="btn btn-primary px-4"
            >
                <i class="bi bi-check2-circle me-1"></i>
                Submit Business
            </button>

        </div>

    </div>

</form>


@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const category = document.getElementById('category_id');
    const subcategory = document.getElementById('subcategory_id');

    const country = document.getElementById('country_id');
    const state = document.getElementById('state_id');
    const city = document.getElementById('city_id');
    const area = document.getElementById('area_id');


    const oldSubcategory = @json(old('subcategory_id'));
    const oldState = @json(old('state_id'));
    const oldCity = @json(old('city_id'));
    const oldArea = @json(old('area_id'));


    function resetSelect(select, text) {

        select.innerHTML =
            `<option value="">${text}</option>`;

        select.disabled = true;

    }


    function loadSelect(url, select, placeholder, selected = null) {

        resetSelect(select, 'Loading...');

        fetch(url)

            .then(response => response.json())

            .then(data => {

                select.innerHTML =
                    `<option value="">${placeholder}</option>`;

                data.forEach(item => {

                    const option =
                        document.createElement('option');

                    option.value = item.id;
                    option.textContent = item.name;

                    if (selected && selected == item.id) {
                        option.selected = true;
                    }

                    select.appendChild(option);

                });

                select.disabled = false;

            })

            .catch(error => {

                console.error(error);

                resetSelect(select, placeholder);

            });

    }


    // =====================================================
    // CATEGORY → SUBCATEGORY
    // =====================================================

    category.addEventListener('change', function () {

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

        loadSelect(
            url,
            subcategory,
            'Select Subcategory'
        );

    });


    // =====================================================
    // COUNTRY → STATE
    // =====================================================

    country.addEventListener('change', function () {

        resetSelect(state, 'Select State');
        resetSelect(city, 'Select City');
        resetSelect(area, 'Select Area');

        if (!this.value) {
            return;
        }

        const url =
            "{{ route('user.businesses.states', ['country' => '__ID__']) }}"
                .replace('__ID__', this.value);

        loadSelect(
            url,
            state,
            'Select State'
        );

    });


    // =====================================================
    // STATE → CITY
    // =====================================================

    state.addEventListener('change', function () {

        resetSelect(city, 'Select City');
        resetSelect(area, 'Select Area');

        if (!this.value) {
            return;
        }

        const url =
            "{{ route('user.businesses.cities', ['state' => '__ID__']) }}"
                .replace('__ID__', this.value);

        loadSelect(
            url,
            city,
            'Select City'
        );

    });


    // =====================================================
    // CITY → AREA
    // =====================================================

    city.addEventListener('change', function () {

        resetSelect(area, 'Select Area');

        if (!this.value) {
            return;
        }

        const url =
            "{{ route('user.businesses.areas', ['city' => '__ID__']) }}"
                .replace('__ID__', this.value);

        loadSelect(
            url,
            area,
            'Select Area'
        );

    });


    // =====================================================
    // OLD VALUES
    // =====================================================

    if (category.value) {

        const url =
            "{{ route('user.businesses.subcategories', ['category' => '__ID__']) }}"
                .replace('__ID__', category.value);

        loadSelect(
            url,
            subcategory,
            'Select Subcategory',
            oldSubcategory
        );

    }


    if (country.value) {

        const stateUrl =
            "{{ route('user.businesses.states', ['country' => '__ID__']) }}"
                .replace('__ID__', country.value);

        loadSelect(
            stateUrl,
            state,
            'Select State',
            oldState
        );

    }


    // =====================================================
    // BUSINESS HOURS
    // =====================================================

    document.querySelectorAll('.border.rounded-3.p-3')
        .forEach(function (row) {

            const closedCheckbox =
                row.querySelector('.user-closed-checkbox');

            const hours24Checkbox =
                row.querySelector('.user-24-checkbox');

            const timeInputs =
                row.querySelectorAll('.user-time-input');


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


    // =====================================================
    // GALLERY PREVIEW
    // =====================================================

    const galleryInput =
        document.getElementById('createBusinessGalleryPhotos');

    const galleryPreview =
        document.getElementById('createGalleryPreview');


    if (galleryInput && galleryPreview) {

        galleryInput.addEventListener('change', function () {

            galleryPreview.innerHTML = '';


            Array.from(this.files).forEach(function (file) {

                if (!file.type.startsWith('image/')) {
                    return;
                }


                const reader =
                    new FileReader();


                reader.onload = function (event) {

                    const col =
                        document.createElement('div');

                    col.className =
                        'col-6 col-md-4 col-lg-3';


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


                    galleryPreview.appendChild(col);

                };


                reader.readAsDataURL(file);

            });

        });

    }


    // =====================================================
    // BUSINESS SERVICES
    // =====================================================

    const serviceContainer =
        document.getElementById('businessServicesContainer');

    const serviceEmpty =
        document.getElementById('businessServicesEmpty');

    const addServiceButton =
        document.getElementById('addBusinessService');

    const addFirstServiceButton =
        document.getElementById('addFirstBusinessService');


    let serviceIndex = 0;


    function updateServiceEmptyState() {

        if (!serviceContainer || !serviceEmpty) {
            return;
        }


        if (serviceContainer.children.length === 0) {

            serviceEmpty.classList.remove('d-none');

        } else {

            serviceEmpty.classList.add('d-none');

        }

    }


    function addService() {

        const index =
            serviceIndex++;


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


                <div class="col-md-6">

                    <div class="form-check form-switch mt-md-2">

                        <input
                            type="checkbox"
                            name="services[${index}][status]"
                            value="1"
                            class="form-check-input"
                            id="userServiceStatus${index}"
                            checked
                        >

                        <label
                            class="form-check-label fw-semibold"
                            for="userServiceStatus${index}"
                        >
                            Active Service
                        </label>

                    </div>

                    <div class="form-text">
                        Active services will appear on the public business profile.
                    </div>

                </div>


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


        serviceContainer.appendChild(serviceCard);


        updateServiceEmptyState();


        const removeButton =
            serviceCard.querySelector(
                '.remove-business-service'
            );


        removeButton.addEventListener(
            'click',
            function () {

                serviceCard.remove();

                updateServiceNumbers();
                updateServiceEmptyState();

            }
        );

    }


    function updateServiceNumbers() {

        const items =
            serviceContainer.querySelectorAll(
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


    if (addServiceButton) {

        addServiceButton.addEventListener(
            'click',
            addService
        );

    }


    if (addFirstServiceButton) {

        addFirstServiceButton.addEventListener(
            'click',
            addService
        );

    }


    updateServiceEmptyState();

});
</script>

@endpush

@endsection
