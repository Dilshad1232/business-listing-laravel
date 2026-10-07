@extends('admin.layouts.master')

@section('title', 'Add State')

@section('content')

<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Add State</h4>

            <p class="text-muted mb-0">
                Add a new state to your business directory.
            </p>
        </div>

        <a
            href="{{ route('admin.states.index') }}"
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
                State Information
            </strong>

        </div>


        <div class="card-body">

            <form
                action="{{ route('admin.states.store') }}"
                method="POST"
            >

                @csrf


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
                                    {{ old('country_id') == $country->id ? 'selected' : '' }}
                                >
                                    {{ $country->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- State Name --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            State Name
                            <span class="text-danger">*</span>
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            placeholder="e.g. Uttar Pradesh"
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
                            value="{{ old('slug') }}"
                            placeholder="e.g. uttar-pradesh"
                        >

                        <small class="text-muted">
                            Leave blank to generate automatically.
                        </small>

                    </div>


                    {{-- Code --}}
                    <div class="col-md-6">

                        <label class="form-label">
                            State Code
                        </label>

                        <input
                            type="text"
                            name="code"
                            class="form-control"
                            value="{{ old('code') }}"
                            placeholder="e.g. UP"
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
                            value="{{ old('sort_order', 0) }}"
                            min="0"
                        >

                    </div>


                    {{-- Status --}}
                    <div class="col-md-6 d-flex align-items-end">

                        <div class="form-check mb-2">

                            <input
                                type="hidden"
                                name="status"
                                value="0"
                            >

                            <input
                                type="checkbox"
                                name="status"
                                value="1"
                                class="form-check-input"
                                id="stateStatus"
                                {{ old('status', 1) ? 'checked' : '' }}
                            >

                            <label
                                class="form-check-label"
                                for="stateStatus"
                            >
                                Active State
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
                            placeholder="Enter state description..."
                        >{{ old('description') }}</textarea>

                    </div>

                </div>


                {{-- Buttons --}}
                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-check-lg me-1"></i>
                        Save State
                    </button>

                    <a
                        href="{{ route('admin.states.index') }}"
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
