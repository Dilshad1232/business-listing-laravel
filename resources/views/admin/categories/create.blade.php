@extends('admin.layouts.master')

@section('title', 'Add Category')

@section('content')

<div class="container-fluid px-0">

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 fw-bold mb-1">
                Add Category
            </h1>

            <p class="text-muted mb-0">
                Create a new business category for your directory.
            </p>
        </div>

        <a
            href="{{ route('admin.categories.index') }}"
            class="btn btn-light border"
        >
            <i class="bi bi-arrow-left me-1"></i>
            Back to Categories
        </a>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <div class="fw-semibold mb-2">
                Please fix the following errors:
            </div>

            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.categories.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <div class="row g-4">

            {{-- ==========================================
                 LEFT COLUMN
            =========================================== --}}
            <div class="col-lg-8">

                {{-- Basic Information --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <h5 class="mb-1 fw-bold">
                            <i class="bi bi-folder2-open text-primary me-2"></i>
                            Basic Information
                        </h5>

                        <small class="text-muted">
                            Enter the main information for this category.
                        </small>

                    </div>


                    <div class="card-body">

                        <div class="row g-3">

                            {{-- Name --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Category Name
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name') }}"
                                    placeholder="e.g. Restaurants"
                                    required
                                >

                            </div>


                            {{-- Slug --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Slug
                                </label>

                                <input
                                    type="text"
                                    name="slug"
                                    class="form-control"
                                    value="{{ old('slug') }}"
                                    placeholder="restaurants"
                                >

                                <small class="text-muted">
                                    Leave blank to generate automatically.
                                </small>

                            </div>


                      {{-- SVG Icon --}}
<div class="col-md-6">

    <label class="form-label fw-semibold">
        Category SVG Icon
    </label>

    <input
        type="file"
        name="icon"
        class="form-control"
        accept=".svg,image/svg+xml"
    >

    <small class="text-muted">
        Upload SVG icon only. Maximum size: 512 KB.
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
                                    class="form-control"
                                    value="{{ old('sort_order', 0) }}"
                                    min="0"
                                    placeholder="0"
                                >

                                <small class="text-muted">
                                    Lower number appears first.
                                </small>

                            </div>


                            {{-- Short Description --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Short Description
                                </label>

                                <textarea
                                    name="short_description"
                                    class="form-control"
                                    rows="3"
                                    maxlength="500"
                                    placeholder="Write a short description for this category..."
                                >{{ old('short_description') }}</textarea>

                                <small class="text-muted">
                                    Maximum 500 characters.
                                </small>

                            </div>


                            {{-- Full Description --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Full Description
                                </label>

                                <textarea
                                    name="description"
                                    class="form-control"
                                    rows="6"
                                    placeholder="Write detailed information about this category..."
                                >{{ old('description') }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Category Image --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <h5 class="mb-1 fw-bold">
                            <i class="bi bi-image text-primary me-2"></i>
                            Category Image
                        </h5>

                        <small class="text-muted">
                            Upload a clear image representing this category.
                        </small>

                    </div>


                    <div class="card-body">

                        <label class="form-label fw-semibold">
                            Upload Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept="image/jpeg,image/png,image/webp"
                        >

                        <div class="form-text">
                            Recommended format: JPG, PNG or WEBP.
                        </div>

                    </div>

                </div>


                {{-- SEO --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <h5 class="mb-1 fw-bold">
                            <i class="bi bi-search text-primary me-2"></i>
                            SEO Settings
                        </h5>

                        <small class="text-muted">
                            Optimize this category for search engines.
                        </small>

                    </div>


                    <div class="card-body">

                        <div class="row g-3">

                            {{-- Meta Title --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Meta Title
                                </label>

                                <input
                                    type="text"
                                    name="meta_title"
                                    class="form-control"
                                    value="{{ old('meta_title') }}"
                                    maxlength="255"
                                    placeholder="Best Restaurants & Food Places"
                                >

                                <small class="text-muted">
                                    Keep your SEO title clear and relevant.
                                </small>

                            </div>


                            {{-- Meta Description --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Meta Description
                                </label>

                                <textarea
                                    name="meta_description"
                                    class="form-control"
                                    rows="4"
                                    maxlength="500"
                                    placeholder="Discover the best restaurants, cafes and food places in your city..."
                                >{{ old('meta_description') }}</textarea>

                                <small class="text-muted">
                                    Write a useful description for search results.
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ==========================================
                 RIGHT COLUMN
            =========================================== --}}
            <div class="col-lg-4">

                {{-- Publishing --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-bottom py-3">

                        <h5 class="mb-1 fw-bold">
                            <i class="bi bi-sliders text-primary me-2"></i>
                            Publishing
                        </h5>

                        <small class="text-muted">
                            Control category visibility.
                        </small>

                    </div>


                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <div class="fw-semibold">
                                    Active Status
                                </div>

                                <small class="text-muted">
                                    Make this category visible publicly.
                                </small>

                            </div>


                            <div class="form-check form-switch">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="status"
                                    value="1"
                                    id="categoryStatus"
                                    {{ old('status', true) ? 'checked' : '' }}
                                >

                            </div>

                        </div>

                    </div>

                </div>


                {{-- SEO Tips --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-header bg-white border-bottom py-3">

                        <h5 class="mb-1 fw-bold">
                            <i class="bi bi-lightbulb text-warning me-2"></i>
                            SEO Tips
                        </h5>

                    </div>


                    <div class="card-body">

                        <div class="d-flex gap-2 mb-3">

                            <i class="bi bi-check-circle-fill text-success"></i>

                            <small class="text-muted">
                                Use a clear and searchable category name.
                            </small>

                        </div>


                        <div class="d-flex gap-2 mb-3">

                            <i class="bi bi-check-circle-fill text-success"></i>

                            <small class="text-muted">
                                Keep the URL slug short and readable.
                            </small>

                        </div>


                        <div class="d-flex gap-2 mb-3">

                            <i class="bi bi-check-circle-fill text-success"></i>

                            <small class="text-muted">
                                Write unique category descriptions.
                            </small>

                        </div>


                        <div class="d-flex gap-2">

                            <i class="bi bi-check-circle-fill text-success"></i>

                            <small class="text-muted">
                                Add relevant SEO title and description.
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- ==========================================
             ACTION BAR
        =========================================== --}}
        <div class="card border-0 shadow-sm mt-2">

            <div class="card-body d-flex flex-wrap justify-content-end gap-2">

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="btn btn-light border px-4"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn btn-primary px-4"
                >
                    <i class="bi bi-check-lg me-1"></i>
                    Save Category
                </button>

            </div>

        </div>

    </form>

</div>

@endsection

