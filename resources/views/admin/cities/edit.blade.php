@extends('admin.layouts.master')

@section('title', 'Edit City')

@section('content')

<div class="container-fluid py-3">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Edit City</h4>

            <p class="text-muted mb-0">
                Update city information.
            </p>
        </div>

        <a
            href="{{ route('admin.cities.index') }}"
            class="btn btn-light"
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

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-bottom">
            <strong>City Information</strong>
        </div>

        <div class="card-body">

            <form
                action="{{ route('admin.cities.update', $city) }}"
                method="POST"
            >

                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- Country --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Country
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="country_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Select Country
                            </option>

                            @foreach($countries as $country)

                                <option
                                    value="{{ $country->id }}"
                                    {{ old('country_id', $city->country_id) == $country->id ? 'selected' : '' }}
                                >
                                    {{ $country->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- State --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            State
                            <span class="text-danger">*</span>
                        </label>

                        <select
                            name="state_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Select State
                            </option>

                            @foreach($states as $state)

                                <option
                                    value="{{ $state->id }}"
                                    {{ old('state_id', $city->state_id) == $state->id ? 'selected' : '' }}
                                >
                                    {{ $state->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>

                    {{-- City Name --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            City Name
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name', $city->name) }}"
                            placeholder="e.g. Meerut"
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
                            value="{{ old('slug', $city->slug) }}"
                            placeholder="e.g. meerut"
                        >

                        <small class="text-muted">
                            Leave blank to generate automatically.
                        </small>

                    </div>

                    {{-- City Code --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            City Code
                        </label>

                        <input
                            type="text"
                            name="code"
                            class="form-control"
                            value="{{ old('code', $city->code) }}"
                            placeholder="e.g. MEE"
                        >

                    </div>

                    {{-- Sort Order --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            Sort Order
                        </label>

                        <input
                            type="number"
                            name="sort_order"
                            class="form-control"
                            value="{{ old('sort_order', $city->sort_order) }}"
                            min="0"
                        >

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
                                id="cityStatus"
                                {{ old('status', $city->status) ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label"
                                for="cityStatus"
                            >
                                Active City
                            </label>

                        </div>

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
                            placeholder="Enter city description..."
                        >{{ old('description', $city->description) }}</textarea>

                    </div>

                </div>

                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-check-lg me-1"></i>
                        Update City
                    </button>

                    <a
                        href="{{ route('admin.cities.index') }}"
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
