@extends('admin.layouts.master')

@section('content')

<div class="container-fluid py-4">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>

            <div class="d-flex align-items-center gap-2 mb-1">

                <a href="{{ route('admin.products.index') }}"
                   class="btn btn-sm btn-light">

                    <i class="bi bi-arrow-left"></i>

                </a>

                <h3 class="mb-0 fw-bold">
                    Edit Product
                </h3>

            </div>

            <p class="text-muted mb-0">
                Update product information, pricing, images and visibility.
            </p>

        </div>


        <div class="d-flex gap-2">

            <a href="{{ route('admin.products.show', $product) }}"
               class="btn btn-light">

                <i class="bi bi-eye me-1"></i>
                View Product

            </a>

            <a href="{{ route('admin.products.index') }}"
               class="btn btn-light">

                <i class="bi bi-arrow-left me-1"></i>
                Back

            </a>

        </div>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}
    @if($errors->any())

        <div class="alert alert-danger border-0 shadow-sm mb-4">

            <div class="d-flex gap-2">

                <i class="bi bi-exclamation-triangle-fill fs-5"></i>

                <div>

                    <div class="fw-semibold mb-1">
                        Please fix the following errors:
                    </div>

                    <ul class="mb-0 ps-3">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    <form
        action="{{ route('admin.products.update', $product) }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf
        @method('PUT')


        <div class="row g-4">

            {{-- =================================================
                LEFT COLUMN
            ================================================== --}}
            <div class="col-xl-8">


                {{-- =================================================
                    BASIC INFORMATION
                ================================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-0 px-4 pt-4">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                                style="width:44px;height:44px;"
                            >

                                <i class="bi bi-box-seam fs-5"></i>

                            </div>


                            <div>

                                <h5 class="mb-1 fw-bold">
                                    Basic Information
                                </h5>

                                <small class="text-muted">
                                    Update the main product details.
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        <div class="row g-4">


                            {{-- BUSINESS --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Business
                                    <span class="text-danger">*</span>

                                </label>


                                <select
                                    name="business_id"
                                    class="form-select @error('business_id') is-invalid @enderror"
                                    required
                                >

                                    <option value="">
                                        Select Business
                                    </option>


                                    @foreach($businesses as $business)

                                        <option
                                            value="{{ $business->id }}"
                                            {{ old('business_id', $product->business_id) == $business->id ? 'selected' : '' }}
                                        >

                                            {{ $business->name }}

                                        </option>

                                    @endforeach

                                </select>


                                @error('business_id')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- CATEGORY --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Category
                                </label>


                                <select
                                    name="category_id"
                                    id="categorySelect"
                                    class="form-select @error('category_id') is-invalid @enderror"
                                >

                                    <option value="">
                                        Select Category
                                    </option>


                                    @foreach($categories as $category)

                                        <option
                                            value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
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


                            {{-- SUBCATEGORY --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Subcategory
                                </label>


                                <select
                                    name="subcategory_id"
                                    id="subcategorySelect"
                                    class="form-select @error('subcategory_id') is-invalid @enderror"
                                >

                                    <option value="">
                                        Select Subcategory
                                    </option>


                                    @foreach($subcategories as $subcategory)

                                        <option
                                            value="{{ $subcategory->id }}"
                                            data-category="{{ $subcategory->category_id }}"
                                            {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}
                                        >

                                            {{ $subcategory->name }}

                                        </option>

                                    @endforeach

                                </select>


                                @error('subcategory_id')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror


                                <small class="text-muted">
                                    Select a category first.
                                </small>

                            </div>


                            {{-- PRODUCT NAME --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">

                                    Product Name
                                    <span class="text-danger">*</span>

                                </label>


                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $product->name) }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter product name"
                                    required
                                >


                                @error('name')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- SKU --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    SKU
                                </label>


                                <input
                                    type="text"
                                    name="sku"
                                    value="{{ old('sku', $product->sku) }}"
                                    class="form-control @error('sku') is-invalid @enderror"
                                    placeholder="e.g. PROD-1001"
                                >


                                @error('sku')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- SORT ORDER --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Sort Order
                                </label>


                                <input
                                    type="number"
                                    name="sort_order"
                                    value="{{ old('sort_order', $product->sort_order ?? 0) }}"
                                    min="0"
                                    class="form-control @error('sort_order') is-invalid @enderror"
                                    placeholder="0"
                                >


                                @error('sort_order')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- SHORT DESCRIPTION --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Short Description
                                </label>


                                <textarea
                                    name="short_description"
                                    rows="3"
                                    class="form-control @error('short_description') is-invalid @enderror"
                                    placeholder="Write a short description about this product..."
                                >{{ old('short_description', $product->short_description) }}</textarea>


                                @error('short_description')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- FULL DESCRIPTION --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Full Description
                                </label>


                                <textarea
                                    name="description"
                                    rows="7"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Write complete product details..."
                                >{{ old('description', $product->description) }}</textarea>


                                @error('description')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    PRICING & INVENTORY
                ================================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-0 px-4 pt-4">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="rounded-3 bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center"
                                style="width:44px;height:44px;"
                            >

                                <i class="bi bi-currency-rupee fs-5"></i>

                            </div>


                            <div>

                                <h5 class="mb-1 fw-bold">
                                    Pricing & Inventory
                                </h5>

                                <small class="text-muted">
                                    Update pricing and available stock.
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        <div class="row g-4">


                            {{-- REGULAR PRICE --}}
                            <div class="col-md-4">

                                <label class="form-label fw-semibold">
                                    Regular Price
                                </label>


                                <div class="input-group">

                                    <span class="input-group-text">
                                        ₹
                                    </span>


                                    <input
                                        type="number"
                                        name="price"
                                        value="{{ old('price', $product->price) }}"
                                        min="0"
                                        step="0.01"
                                        class="form-control @error('price') is-invalid @enderror"
                                        placeholder="0.00"
                                    >

                                </div>


                                @error('price')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- DISCOUNT PRICE --}}
                            <div class="col-md-4">

                                <label class="form-label fw-semibold">
                                    Discount Price
                                </label>


                                <div class="input-group">

                                    <span class="input-group-text">
                                        ₹
                                    </span>


                                    <input
                                        type="number"
                                        name="discount_price"
                                        value="{{ old('discount_price', $product->discount_price) }}"
                                        min="0"
                                        step="0.01"
                                        class="form-control @error('discount_price') is-invalid @enderror"
                                        placeholder="0.00"
                                    >

                                </div>


                                @error('discount_price')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- STOCK --}}
                            <div class="col-md-4">

                                <label class="form-label fw-semibold">
                                    Stock Quantity
                                </label>


                                <input
                                    type="number"
                                    name="stock"
                                    value="{{ old('stock', $product->stock ?? 0) }}"
                                    min="0"
                                    class="form-control @error('stock') is-invalid @enderror"
                                    placeholder="0"
                                >


                                @error('stock')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    EXISTING IMAGES
                ================================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-0 px-4 pt-4">

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="rounded-3 bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center"
                                style="width:44px;height:44px;"
                            >

                                <i class="bi bi-images fs-5"></i>

                            </div>


                            <div>

                                <h5 class="mb-1 fw-bold">
                                    Product Images
                                </h5>

                                <small class="text-muted">
                                    Manage existing images or upload new ones.
                                </small>

                            </div>

                        </div>

                    </div>


                    <div class="card-body p-4">


                        {{-- EXISTING IMAGES --}}
                        @if($product->images->count())

                            <div class="row g-3 mb-4">

                                @foreach($product->images as $image)

                                    <div class="col-6 col-md-4 col-lg-3">

                                        <div
                                            class="position-relative border rounded-4 overflow-hidden bg-light"
                                        >

                                            <img
                                                src="{{ asset('storage/' . $image->image) }}"
                                                alt="{{ $product->name }}"
                                                class="w-100"
                                                style="height:150px;object-fit:cover;"
                                            >


                                            {{-- PRIMARY --}}
                                            @if($image->is_primary)

                                                <span
                                                    class="position-absolute top-0 start-0 m-2 badge bg-primary"
                                                >

                                                    <i class="bi bi-star-fill me-1"></i>
                                                    Primary

                                                </span>

                                            @endif

                                        </div>

                                    </div>

                                @endforeach

                            </div>

                        @else

                            <div class="text-center py-4 mb-3">

                                <i class="bi bi-images fs-1 text-muted"></i>

                                <p class="text-muted mb-0 mt-2">
                                    No images uploaded yet.
                                </p>

                            </div>

                        @endif


                        {{-- UPLOAD NEW IMAGES --}}
                        <label
                            for="productImages"
                            class="border rounded-4 p-4 text-center d-block"
                            style="cursor:pointer;border-style:dashed !important;"
                        >

                            <div class="mb-3">

                                <div
                                    class="mx-auto rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                                    style="width:64px;height:64px;"
                                >

                                    <i class="bi bi-cloud-arrow-up fs-3"></i>

                                </div>

                            </div>


                            <h6 class="fw-bold mb-1">
                                Upload more product images
                            </h6>


                            <p class="text-muted small mb-2">
                                JPG, JPEG, PNG or WEBP
                            </p>


                            <span class="badge bg-light text-dark border">
                                Maximum 5MB per image
                            </span>

                        </label>


                        <input
                            type="file"
                            name="images[]"
                            id="productImages"
                            class="d-none"
                            accept=".jpg,.jpeg,.png,.webp"
                            multiple
                        >


                        {{-- NEW IMAGE PREVIEW --}}
                        <div
                            id="imagePreview"
                            class="row g-3 mt-2"
                        ></div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                RIGHT COLUMN
            ================================================== --}}
            <div class="col-xl-4">


                {{-- =================================================
                    PUBLISHING
                ================================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-header bg-white border-0 px-4 pt-4">

                        <h5 class="mb-1 fw-bold">
                            Publishing
                        </h5>

                        <small class="text-muted">
                            Control product visibility.
                        </small>

                    </div>


                    <div class="card-body p-4">


                        {{-- STATUS --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <div>

                                <div class="fw-semibold">
                                    Product Status
                                </div>

                                <small class="text-muted">
                                    Show product publicly
                                </small>

                            </div>


                            <div class="form-check form-switch">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="status"
                                    value="1"
                                    id="statusSwitch"
                                    style="width:44px;height:22px;"
                                    {{ old('status', $product->status) ? 'checked' : '' }}
                                >

                            </div>

                        </div>


                        {{-- FEATURED --}}
                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <div class="fw-semibold">
                                    Featured Product
                                </div>

                                <small class="text-muted">
                                    Highlight this product
                                </small>

                            </div>


                            <div class="form-check form-switch">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="is_featured"
                                    value="1"
                                    id="featuredSwitch"
                                    style="width:44px;height:22px;"
                                    {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}
                                >

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    PRODUCT INFORMATION
                ================================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <h6 class="fw-bold mb-3">
                            Product Information
                        </h6>


                        <div class="small">


                            <div class="d-flex justify-content-between py-2 border-bottom">

                                <span class="text-muted">
                                    Product ID
                                </span>

                                <span class="fw-semibold">
                                    #{{ $product->id }}
                                </span>

                            </div>


                            <div class="d-flex justify-content-between py-2 border-bottom">

                                <span class="text-muted">
                                    Slug
                                </span>

                                <span
                                    class="fw-semibold text-truncate ms-3"
                                    style="max-width:180px;"
                                >
                                    {{ $product->slug }}
                                </span>

                            </div>


                            <div class="d-flex justify-content-between py-2">

                                <span class="text-muted">
                                    Images
                                </span>

                                <span class="fw-semibold">
                                    {{ $product->images->count() }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    TIPS
                ================================================== --}}
                <div class="card border-0 shadow-sm mb-4">

                    <div class="card-body p-4">

                        <div class="d-flex gap-3">

                            <div
                                class="rounded-3 bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center flex-shrink-0"
                                style="width:42px;height:42px;"
                            >

                                <i class="bi bi-lightbulb fs-5"></i>

                            </div>


                            <div>

                                <h6 class="fw-bold mb-2">
                                    Update Tips
                                </h6>


                                <ul class="text-muted small mb-0 ps-3">

                                    <li class="mb-2">
                                        Keep product information accurate.
                                    </li>

                                    <li class="mb-2">
                                        Use high-quality product images.
                                    </li>

                                    <li class="mb-2">
                                        Keep pricing and stock updated.
                                    </li>

                                    <li>
                                        Use Featured only for important products.
                                    </li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    ACTIONS
                ================================================== --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        <button
                            type="submit"
                            class="btn btn-primary w-100 py-2 mb-2"
                        >

                            <i class="bi bi-check2-circle me-1"></i>
                            Update Product

                        </button>


                        <a
                            href="{{ route('admin.products.index') }}"
                            class="btn btn-light w-100 py-2"
                        >

                            Cancel

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>


{{-- =============================================================
    JAVASCRIPT
============================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    // =========================================================
    // CATEGORY → SUBCATEGORY
    // =========================================================

    const categorySelect =
        document.getElementById('categorySelect');

    const subcategorySelect =
        document.getElementById('subcategorySelect');


    const allSubcategories =
        Array.from(subcategorySelect.options);


    const initialSubcategory =
        "{{ old('subcategory_id', $product->subcategory_id) }}";


    function filterSubcategories() {

        const categoryId =
            categorySelect.value;


        subcategorySelect.innerHTML = '';


        const defaultOption =
            document.createElement('option');

        defaultOption.value = '';
        defaultOption.textContent =
            'Select Subcategory';

        subcategorySelect.appendChild(
            defaultOption
        );


        allSubcategories.forEach(function (option) {

            if (
                option.value === '' ||
                option.dataset.category === categoryId
            ) {

                const newOption =
                    option.cloneNode(true);

                subcategorySelect.appendChild(
                    newOption
                );

            }

        });


        if (
            Array.from(subcategorySelect.options)
                .some(
                    option =>
                        option.value === initialSubcategory
                )
        ) {

            subcategorySelect.value =
                initialSubcategory;

        }

    }


    categorySelect.addEventListener(
        'change',
        function () {

            subcategorySelect.value = '';

            filterSubcategories();

        }
    );


    filterSubcategories();


    // =========================================================
    // NEW IMAGE PREVIEW
    // =========================================================

    const imageInput =
        document.getElementById('productImages');

    const imagePreview =
        document.getElementById('imagePreview');


    imageInput.addEventListener(
        'change',
        function () {

            imagePreview.innerHTML = '';


            Array.from(this.files).forEach(
                function (file, index) {

                    if (
                        !file.type.startsWith('image/')
                    ) {
                        return;
                    }


                    const reader =
                        new FileReader();


                    reader.onload =
                        function (event) {

                            const col =
                                document.createElement('div');

                            col.className =
                                'col-6 col-md-4';


                            col.innerHTML = `

                                <div
                                    class="position-relative rounded-4 overflow-hidden border bg-light"
                                >

                                    <img
                                        src="${event.target.result}"
                                        class="w-100"
                                        style="height:140px;object-fit:cover;"
                                        alt="New product image"
                                    >

                                    ${
                                        index === 0
                                            ? `
                                                <span
                                                    class="position-absolute top-0 start-0 m-2 badge bg-primary"
                                                >

                                                    <i class="bi bi-star-fill me-1"></i>
                                                    New

                                                </span>
                                              `
                                            : ''
                                    }

                                </div>

                            `;


                            imagePreview.appendChild(col);

                        };


                    reader.readAsDataURL(file);

                }
            );

        }
    );

});

</script>

@endsection
