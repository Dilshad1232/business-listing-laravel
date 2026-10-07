@extends('admin.layouts.master')

@section('content')

<div class="container-fluid">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold mb-1">Add Listing</h2>
            <p class="text-muted mb-0">
                Create a new business listing.
            </p>
        </div>

        <a href="{{ route('admin.listings.index') }}"
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i>
            Back to Listings
        </a>

    </div>


    {{-- Validation Errors --}}
    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Form --}}
    <form
        action="{{ route('admin.listings.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf


        <div class="row g-4">

            {{-- LEFT --}}
            <div class="col-lg-8">

                {{-- Basic Information --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">
                            Basic Information
                        </h5>

                    </div>

                    <div class="card-body">




                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
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


                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Sub Category
                                </label>

                                <select
                                    name="subcategory_id"
                                    class="form-select"
                                >

                                    <option value="">
                                        Select Sub Category
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




                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Description
                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="6"
                                placeholder="Full business description"
                            >{{ old('description') }}</textarea>

                        </div>

                    </div>

                </div>


                {{-- Contact Information --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">
                            Contact Information
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Phone
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    value="{{ old('phone') }}"
                                    placeholder="+91 9876543210"
                                >

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label fw-semibold">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email') }}"
                                    placeholder="business@example.com"
                                >

                            </div>

                        </div>


                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Website
                            </label>

                            <input
                                type="text"
                                name="website"
                                class="form-control"
                                value="{{ old('website') }}"
                                placeholder="https://example.com"
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Address
                            </label>

                            <textarea
                                name="address"
                                class="form-control"
                                rows="3"
                                placeholder="Complete business address"
                            >{{ old('address') }}</textarea>

                        </div>


                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label class="form-label fw-semibold">
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


                            <div class="col-md-4 mb-3">

                                <label class="form-label fw-semibold">
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

                            <div class="col-md-4 mb-3">

                                <label class="form-label fw-semibold">
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
                                            {{ old('country_id', 1) == $country->id ? 'selected' : '' }}
                                        >
                                            {{ $country->name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- RIGHT --}}
            <div class="col-lg-4">

                {{-- Listing Settings --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">
                            Listing Settings
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Price
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                name="price"
                                class="form-control"
                                value="{{ old('price') }}"
                                placeholder="0.00"
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Rating
                            </label>

                            <input
                                type="number"
                                step="0.1"
                                min="0"
                                max="5"
                                name="rating"
                                class="form-control"
                                value="{{ old('rating', '0') }}"
                                placeholder="4.5"
                            >

                        </div>


                       

                        <div class="form-check form-switch mb-3">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="status"
                                value="1"
                                id="status"
                                checked
                            >

                            <label
                                class="form-check-label fw-semibold"
                                for="status"
                            >
                                Active Listing
                            </label>

                        </div>


                        <div class="form-check form-switch">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_featured"
                                value="1"
                                id="is_featured"
                            >

                            <label
                                class="form-check-label fw-semibold"
                                for="is_featured"
                            >
                                Featured Listing
                            </label>

                        </div>

                    </div>

                </div>


                {{-- Image --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">
                            Business Cover Image
                        </h5>

                    </div>

                    <div class="card-body">

                        <input
                        type="file"
                        name="cover_image"
                        class="form-control"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                        <small class="text-muted d-block mt-2">
                            JPG, JPEG, PNG or WEBP. Maximum 2MB.
                        </small>

                    </div>

                </div>


                {{-- SEO --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white py-3">

                        <h5 class="mb-0 fw-bold">
                            SEO
                        </h5>

                    </div>

                    <div class="card-body">

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Meta Title
                            </label>

                            <input
                                type="text"
                                name="meta_title"
                                class="form-control"
                                value="{{ old('meta_title') }}"
                                placeholder="SEO title"
                            >

                        </div>


                        <div>

                            <label class="form-label fw-semibold">
                                Meta Description
                            </label>

                            <textarea
                                name="meta_description"
                                class="form-control"
                                rows="4"
                                placeholder="SEO description"
                            >{{ old('meta_description') }}</textarea>

                        </div>

                    </div>

                </div>


                {{-- Submit --}}
                <button
                    type="submit"
                    class="btn btn-primary w-100 py-2"
                >
                    <i class="bi bi-check-circle me-1"></i>
                    Add Listing
                </button>

            </div>

        </div>

    </form>

</div>

@endsection
