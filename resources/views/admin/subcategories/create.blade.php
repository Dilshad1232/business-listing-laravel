@extends('admin.layouts.master')

@section('title', 'Add Subcategory')

@section('content')

<div class="bd-page-heading">
    <div>
        <h1 class="bd-page-title">Add Subcategory</h1>
        <div class="bd-page-subtitle">
            Create a new subcategory under a business category.
        </div>
    </div>

    <a href="{{ route('admin.subcategories.index') }}" class="bd-add-btn">
        <i class="bi bi-arrow-left"></i>
        Back to Subcategories
    </a>
</div>


@if($errors->any())
    <div class="alert alert-danger mb-4">
        <strong>Please fix the following errors:</strong>

        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="bd-content-card">

    <div class="bd-card-header">
        <div>
            <h5 class="bd-card-title">Subcategory Information</h5>

            <small class="bd-muted">
                Fill in the details below.
            </small>
        </div>
    </div>


    <div class="bd-card-body">

        <form
            action="{{ route('admin.subcategories.store') }}"
            enctype="multipart/form-data"
            method="POST"
        >

            @csrf


            <div class="row g-4">


                {{-- Category --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Category <span class="text-danger">*</span>
                    </label>

                    <select
                        name="category_id"
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


                {{-- Name --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Subcategory Name <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="e.g. Fast Food"
                        required
                    >

                    @error('name')
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
                        placeholder="e.g. fast-food"
                    >

                    <small class="text-muted">
                        Leave blank to generate automatically.
                    </small>

                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Icon --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Icon Class
                    </label>

                    <input
                        type="text"
                        name="icon"
                        value="{{ old('icon') }}"
                        class="form-control @error('icon') is-invalid @enderror"
                        placeholder="e.g. bi bi-shop"
                    >

                    @error('icon')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Sort Order --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Sort Order
                    </label>

                    <input
                        type="number"
                        name="sort_order"
                        value="{{ old('sort_order', 0) }}"
                        min="0"
                        class="form-control @error('sort_order') is-invalid @enderror"
                    >

                    @error('sort_order')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Image --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        class="form-control"
                        accept="image/jpeg,image/png,image/webp"
                    >

                    <small class="text-muted">
                        JPG, PNG or WEBP.
                    </small>

                </div>


                {{-- Short Description --}}
                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Short Description
                    </label>

                    <textarea
                        name="short_description"
                        rows="3"
                        class="form-control @error('short_description') is-invalid @enderror"
                        placeholder="Short description of this subcategory..."
                    >{{ old('short_description') }}</textarea>

                    @error('short_description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Description --}}
                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Full Description
                    </label>

                    <textarea
                        name="description"
                        rows="6"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Write complete subcategory description..."
                    >{{ old('description') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Meta Title --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Meta Title
                    </label>

                    <input
                        type="text"
                        name="meta_title"
                        value="{{ old('meta_title') }}"
                        class="form-control @error('meta_title') is-invalid @enderror"
                        placeholder="SEO meta title"
                    >

                    @error('meta_title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Meta Description --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Meta Description
                    </label>

                    <textarea
                        name="meta_description"
                        rows="3"
                        class="form-control @error('meta_description') is-invalid @enderror"
                        placeholder="SEO meta description..."
                    >{{ old('meta_description') }}</textarea>

                    @error('meta_description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- Status --}}
                <div class="col-12">

                    <div class="form-check form-switch">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="status"
                            value="1"
                            id="status"
                            {{ old('status', true) ? 'checked' : '' }}
                        >

                        <label
                            class="form-check-label fw-semibold"
                            for="status"
                        >
                            Active Subcategory
                        </label>

                    </div>

                </div>


            </div>


            {{-- Buttons --}}
            <div class="d-flex gap-2 mt-4 pt-4 border-top">

                <button
                    type="submit"
                    class="btn btn-primary px-4"
                >
                    <i class="bi bi-check-lg me-1"></i>
                    Save Subcategory
                </button>

                <a
                    href="{{ route('admin.subcategories.index') }}"
                    class="btn btn-light border px-4"
                >
                    Cancel
                </a>

            </div>


        </form>

    </div>

</div>

@endsection
