@extends('admin.layouts.master')

@section('title', 'Edit Category')

@section('content')

<div class="bd-page-heading">

    <div>
        <h1 class="bd-page-title">
            Edit Category
        </h1>

        <div class="bd-page-subtitle">
            Update category information.
        </div>
    </div>

    <a href="{{ route('admin.categories.index') }}"
       class="bd-add-btn">

        <i class="bi bi-arrow-left"></i>

        Back to Categories

    </a>

</div>


{{-- Validation Errors --}}
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

            <h5 class="bd-card-title">
                Category Information
            </h5>

            <small class="bd-muted">
                Update the details below.
            </small>

        </div>

    </div>


    <div class="bd-card-body">

        <form
            action="{{ route('admin.categories.update', $category) }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @method('PUT')


            <div class="row g-4">


                {{-- Category Name --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Category Name <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="e.g. Restaurants"
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
                        value="{{ old('slug', $category->slug) }}"
                        class="form-control @error('slug') is-invalid @enderror"
                        placeholder="e.g. restaurants"
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


           {{-- SVG Icon --}}
<div class="col-md-6">

    <label class="form-label fw-semibold">
        Category SVG Icon
    </label>

    @if(!empty($category->icon))
        <div class="mb-3">
            <div class="border rounded p-3 d-inline-flex align-items-center justify-content-center bg-light"
                 style="width: 80px; height: 80px;">

                <img
                    src="{{ asset('storage/' . $category->icon) }}"
                    alt="{{ $category->name }}"
                    style="width: 45px; height: 45px; object-fit: contain;"
                >

            </div>
        </div>
    @endif

    <input
        type="file"
        name="icon"
        class="form-control"
        accept=".svg,image/svg+xml"
    >

    <small class="text-muted">
        Upload a new SVG icon only if you want to replace the current icon.
        Maximum size: 512 KB.
    </small>

</div>

                {{-- Sort Order --}}
                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Sort Order
                    </label>

                    <input
                        type="number"
                        name="sort_order"
                        value="{{ old('sort_order', $category->sort_order ?? 0) }}"
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
                        Category Image
                    </label>


                    @if($category->image)

                        <div class="mb-3">

                            <img
                                src="{{ asset('storage/' . $category->image) }}"
                                alt="{{ $category->name }}"
                                style="
                                    width:100px;
                                    height:75px;
                                    object-fit:cover;
                                    border-radius:10px;
                                    border:1px solid #dee2e6;
                                "
                            >

                        </div>

                    @endif


                    <input
                        type="file"
                        name="image"
                        class="form-control @error('image') is-invalid @enderror"
                        accept="image/jpeg,image/png,image/webp"
                    >

                    <small class="text-muted">
                        Leave empty to keep the current image.
                        JPG, PNG or WEBP.
                    </small>

                    @error('image')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

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
                        placeholder="Short description of this category..."
                    >{{ old('short_description', $category->short_description) }}</textarea>

                    @error('short_description')

                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                {{-- Full Description --}}
                <div class="col-12">

                    <label class="form-label fw-semibold">
                        Full Description
                    </label>

                    <textarea
                        name="description"
                        rows="6"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Write complete category description..."
                    >{{ old('description', $category->description) }}</textarea>

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
                        value="{{ old('meta_title', $category->meta_title) }}"
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
                    >{{ old('meta_description', $category->meta_description) }}</textarea>

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
                            {{ old('status', $category->status) ? 'checked' : '' }}
                        >

                        <label
                            class="form-check-label fw-semibold"
                            for="status"
                        >
                            Active Category
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

                    Update Category

                </button>


                <a
                    href="{{ route('admin.categories.index') }}"
                    class="btn btn-light border px-4"
                >

                    Cancel

                </a>

            </div>


        </form>

    </div>

</div>

@endsection

