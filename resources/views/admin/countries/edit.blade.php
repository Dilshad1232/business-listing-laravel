@extends('admin.layouts.master')

@section('title', 'Edit Country')

@section('content')

<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Edit Country</h4>

            <p class="text-muted mb-0">
                Update country information.
            </p>
        </div>

        <a
            href="{{ route('admin.countries.index') }}"
            class="btn btn-light"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Back
        </a>

    </div>


    {{-- Validation Errors --}}
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


    {{-- Form --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-bottom">

            <strong>
                Country Information
            </strong>

        </div>


        <div class="card-body">

            <form
                action="{{ route('admin.countries.update', $country) }}"
                method="POST"
            >

                @csrf
                @method('PUT')


                <div class="row g-3">

                    {{-- Country Name --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Country Name
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $country->name) }}"
                            required
                        >

                    </div>


                    {{-- Slug --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Slug
                        </label>

                        <input
                            type="text"
                            name="slug"
                            class="form-control"
                            value="{{ old('slug', $country->slug) }}"
                        >

                        <small class="text-muted">
                            Example: india
                        </small>

                    </div>


                    {{-- Country Code --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Country Code
                        </label>

                        <input
                            type="text"
                            name="code"
                            class="form-control"
                            value="{{ old('code', $country->code) }}"
                            placeholder="e.g. IN"
                        >

                    </div>


                    {{-- Phone Code --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Phone Code
                        </label>

                        <input
                            type="text"
                            name="phone_code"
                            class="form-control"
                            value="{{ old('phone_code', $country->phone_code) }}"
                            placeholder="e.g. +91"
                        >

                    </div>


                    {{-- Sort Order --}}
                    <div class="col-md-4">

                        <label class="form-label">
                            Sort Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            class="form-control"
                            value="{{ old('sort_order', $country->sort_order) }}"
                            min="0"
                        >

                    </div>


                    {{-- Description --}}
                    <div class="col-12">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            class="form-control"
                            rows="4"
                            placeholder="Enter country description..."
                        >{{ old('description', $country->description) }}</textarea>

                    </div>


                    {{-- Status --}}
                    <div class="col-12">

                        <input
                            type="hidden"
                            name="status"
                            value="0"
                        >

                        <div class="form-check">

                            <input
                                type="checkbox"
                                name="status"
                                value="1"
                                class="form-check-input"
                                id="countryStatus"
                                {{ old('status', $country->status) ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label"
                                for="countryStatus"
                            >
                                Active Country
                            </label>

                        </div>

                    </div>

                </div>


                {{-- Buttons --}}
                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-check-lg me-1"></i>
                        Update Country
                    </button>

                    <a
                        href="{{ route('admin.countries.index') }}"
                        class="btn btn-light ms-2"
                    >
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
