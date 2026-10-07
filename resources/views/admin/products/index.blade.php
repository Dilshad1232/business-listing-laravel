@extends('admin.layouts.master')

@section('content')

<div class="container-fluid py-4">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1 fw-bold">
                Products
            </h3>

            <p class="text-muted mb-0">
                Manage all business products
            </p>
        </div>

        <a href="{{ route('admin.products.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-lg me-1"></i>
            Add Product

        </a>

    </div>


    {{-- =========================================================
        FILTER CARD
    ========================================================== --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('admin.products.index') }}">

                <div class="row g-3 align-items-end">

                    {{-- SEARCH --}}
                    <div class="col-lg-4 col-md-6">

                        <label class="form-label fw-semibold">
                            Search
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-search"></i>
                            </span>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control"
                                placeholder="Product, SKU or business..."
                            >

                        </div>

                    </div>


                    {{-- CATEGORY --}}
                    <div class="col-lg-2 col-md-6">

                        <label class="form-label fw-semibold">
                            Category
                        </label>

                        <select name="category"
                                class="form-select">

                            <option value="">
                                All Categories
                            </option>

                            @foreach(\App\Models\Category::where('status', true)->orderBy('name')->get() as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ request('category') == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- SUBCATEGORY --}}
                    <div class="col-lg-2 col-md-6">

                        <label class="form-label fw-semibold">
                            Subcategory
                        </label>

                        <select name="subcategory"
                                class="form-select">

                            <option value="">
                                All Subcategories
                            </option>

                            @foreach(\App\Models\Subcategory::where('status', true)->orderBy('name')->get() as $subcategory)

                                <option
                                    value="{{ $subcategory->id }}"
                                    {{ request('subcategory') == $subcategory->id ? 'selected' : '' }}
                                >
                                    {{ $subcategory->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- STATUS --}}
                    <div class="col-lg-2 col-md-6">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select name="status"
                                class="form-select">

                            <option value="">
                                All Status
                            </option>

                            <option value="1"
                                {{ request('status') === '1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ request('status') === '0' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>


                    {{-- SORT --}}
                    <div class="col-lg-2 col-md-6">

                        <label class="form-label fw-semibold">
                            Sort By
                        </label>

                        <select name="sort"
                                class="form-select">

                            <option value="">
                                Latest
                            </option>

                            <option value="name_az"
                                {{ request('sort') === 'name_az' ? 'selected' : '' }}>
                                Name A-Z
                            </option>

                            <option value="name_za"
                                {{ request('sort') === 'name_za' ? 'selected' : '' }}>
                                Name Z-A
                            </option>

                            <option value="price_low"
                                {{ request('sort') === 'price_low' ? 'selected' : '' }}>
                                Price Low → High
                            </option>

                            <option value="price_high"
                                {{ request('sort') === 'price_high' ? 'selected' : '' }}>
                                Price High → Low
                            </option>

                            <option value="oldest"
                                {{ request('sort') === 'oldest' ? 'selected' : '' }}>
                                Oldest
                            </option>

                        </select>

                    </div>


                    {{-- FEATURED --}}
                    <div class="col-lg-2 col-md-6">

                        <div class="form-check mt-4 pt-2">

                            <input
                                type="checkbox"
                                name="featured"
                                value="1"
                                id="featuredFilter"
                                class="form-check-input"
                                {{ request('featured') ? 'checked' : '' }}
                            >

                            <label for="featuredFilter"
                                   class="form-check-label fw-semibold">

                                Featured Only

                            </label>

                        </div>

                    </div>


                    {{-- BUTTONS --}}
                    <div class="col-lg-3 col-md-6">

                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn btn-primary">

                                <i class="bi bi-funnel me-1"></i>
                                Filter

                            </button>

                            <a href="{{ route('admin.products.index') }}"
                               class="btn btn-light">

                                <i class="bi bi-arrow-counterclockwise me-1"></i>
                                Reset

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
        PRODUCTS CARD
    ========================================================== --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th class="px-4">
                                #
                            </th>

                            <th>
                                Product
                            </th>

                            <th>
                                Business
                            </th>

                            <th>
                                Category
                            </th>

                            <th>
                                Price
                            </th>

                            <th>
                                Stock
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Featured
                            </th>

                            <th class="text-end px-4">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($products as $product)

                            <tr>

                                {{-- =================================================
                                    ID
                                ================================================== --}}
                                <td class="px-4">

                                    {{ $product->id }}

                                </td>


                                {{-- =================================================
                                    PRODUCT
                                ================================================== --}}
                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        @php
                                            $primaryImage = $product->images
                                                ->where('is_primary', true)
                                                ->first()
                                                ?? $product->images->first();
                                        @endphp


                                        @if($primaryImage)

                                            <img
                                                src="{{ asset('storage/' . $primaryImage->image) }}"
                                                width="52"
                                                height="52"
                                                class="rounded-3 object-fit-cover"
                                                alt="{{ $product->name }}"
                                                style="object-fit: cover;"
                                            >

                                        @else

                                            <div
                                                class="bg-light rounded-3 d-flex align-items-center justify-content-center"
                                                style="width:52px;height:52px;"
                                            >

                                                <i class="bi bi-box-seam fs-5 text-muted"></i>

                                            </div>

                                        @endif


                                        <div>

                                            <div class="fw-semibold">

                                                {{ $product->name }}

                                            </div>


                                            @if($product->sku)

                                                <small class="text-muted">

                                                    SKU:
                                                    {{ $product->sku }}

                                                </small>

                                            @else

                                                <small class="text-muted">

                                                    {{ $product->slug }}

                                                </small>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- =================================================
                                    BUSINESS
                                ================================================== --}}
                                <td>

                                    @if($product->business)

                                        <div class="fw-semibold">

                                            {{ $product->business->name }}

                                        </div>

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                    CATEGORY
                                ================================================== --}}
                                <td>

                                    @if($product->category)

                                        <div>

                                            {{ $product->category->name }}

                                        </div>

                                    @endif


                                    @if($product->subcategory)

                                        <small class="text-muted">

                                            {{ $product->subcategory->name }}

                                        </small>

                                    @endif


                                    @if(!$product->category && !$product->subcategory)

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                    PRICE
                                ================================================== --}}
                                <td>

                                    @if($product->discount_price !== null)

                                        <div class="fw-semibold text-success">

                                            ₹{{ number_format((float) $product->discount_price, 2) }}

                                        </div>

                                        @if($product->price !== null)

                                            <small class="text-muted text-decoration-line-through">

                                                ₹{{ number_format((float) $product->price, 2) }}

                                            </small>

                                        @endif

                                    @elseif($product->price !== null)

                                        <span class="fw-semibold">

                                            ₹{{ number_format((float) $product->price, 2) }}

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                    STOCK
                                ================================================== --}}
                                <td>

                                    @if($product->stock > 0)

                                        <span class="fw-semibold">

                                            {{ number_format($product->stock) }}

                                        </span>

                                    @else

                                        <span class="badge bg-danger-subtle text-danger">

                                            Out of Stock

                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                    STATUS
                                ================================================== --}}
                                <td>

                                    @if($product->status)

                                        <span class="badge bg-success">

                                            Active

                                        </span>

                                    @else

                                        <span class="badge bg-secondary">

                                            Inactive

                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                    FEATURED
                                ================================================== --}}
                                <td>

                                    @if($product->is_featured)

                                        <span class="badge bg-warning text-dark">

                                            <i class="bi bi-star-fill me-1"></i>

                                            Featured

                                        </span>

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- =================================================
                                    ACTIONS
                                ================================================== --}}
                                <td class="text-end px-4">

                                    <div class="d-inline-flex gap-1">

                                        {{-- VIEW --}}
                                        <a
                                            href="{{ route('admin.products.show', $product) }}"
                                            class="btn btn-sm btn-light"
                                            title="View"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.products.edit', $product) }}"
                                            class="btn btn-sm btn-light"
                                            title="Edit"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        {{-- DELETE --}}
                                        <form
                                            action="{{ route('admin.products.destroy', $product) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this product?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-light text-danger"
                                                title="Delete"
                                            >

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9"
                                    class="text-center py-5">

                                    <div class="mb-2">

                                        <i class="bi bi-box-seam fs-1 text-muted"></i>

                                    </div>


                                    <h6 class="mb-1">

                                        No Products Found

                                    </h6>


                                    <p class="text-muted mb-3">

                                        Start by adding your first product.

                                    </p>


                                    <a
                                        href="{{ route('admin.products.create') }}"
                                        class="btn btn-primary btn-sm"
                                    >

                                        <i class="bi bi-plus-lg me-1"></i>

                                        Add Product

                                    </a>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- =========================================================
            PAGINATION
        ========================================================== --}}
        @if($products->hasPages())

            <div class="card-footer bg-white border-0 py-3">

                {{ $products->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
