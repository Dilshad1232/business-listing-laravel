
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
                    Product Details
                </h3>

            </div>

            <p class="text-muted mb-0">
                View complete product information and media.
            </p>

        </div>


        <div class="d-flex gap-2">

            <a
                href="{{ route('admin.products.edit', $product) }}"
                class="btn btn-primary"
            >

                <i class="bi bi-pencil me-1"></i>
                Edit Product

            </a>


            <a
                href="{{ route('admin.products.index') }}"
                class="btn btn-light"
            >

                <i class="bi bi-box-seam me-1"></i>
                All Products

            </a>

        </div>

    </div>


    <div class="row g-4">


        {{-- =====================================================
            LEFT COLUMN
        ====================================================== --}}
        <div class="col-xl-8">


            {{-- =================================================
                PRODUCT GALLERY
            ================================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body p-4">

                    @php

                        $primaryImage =
                            $product->images
                                ->where('is_primary', true)
                                ->first()
                            ??
                            $product->images->first();

                    @endphp


                    {{-- MAIN IMAGE --}}
                    <div
                        class="rounded-4 overflow-hidden bg-light border mb-3"
                        style="height:430px;"
                    >

                        @if($primaryImage)

                            <img
                                id="mainProductImage"
                                src="{{ asset('storage/' . $primaryImage->image) }}"
                                alt="{{ $product->name }}"
                                class="w-100 h-100"
                                style="object-fit:contain;"
                            >

                        @else

                            <div
                                class="w-100 h-100 d-flex flex-column align-items-center justify-content-center"
                            >

                                <i class="bi bi-box-seam fs-1 text-muted"></i>

                                <span class="text-muted mt-2">
                                    No Product Image
                                </span>

                            </div>

                        @endif

                    </div>


                 {{-- =========================================================
    PRODUCT IMAGE MANAGEMENT
========================================================= --}}
@if($product->images->count())

<div class="mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>

            <h6 class="fw-bold mb-1">
                Product Images
            </h6>

            <small class="text-muted">
                Manage product gallery images.
            </small>

        </div>

        <span class="badge bg-light text-dark border">
            {{ $product->images->count() }}
            {{ $product->images->count() == 1 ? 'Image' : 'Images' }}
        </span>

    </div>


    <div class="row g-3">

        @foreach($product->images as $image)

            <div class="col-6 col-sm-4 col-md-3">

                <div class="border rounded-4 overflow-hidden bg-white h-100">

                    {{-- IMAGE --}}
                    <div
                        class="position-relative bg-light"
                        style="height:150px;"
                    >

                        <img
                            src="{{ asset('storage/' . $image->image) }}"
                            alt="{{ $product->name }}"
                            class="w-100 h-100"
                            style="object-fit:cover;"
                        >


                        {{-- PRIMARY BADGE --}}
                        @if($image->is_primary)

                            <span
                                class="position-absolute top-0 start-0 m-2 badge bg-warning text-dark"
                            >

                                <i class="bi bi-star-fill me-1"></i>
                                Primary

                            </span>

                        @endif

                    </div>


                    {{-- ACTIONS --}}
                    <div class="p-2">

                        @if(!$image->is_primary)

                            <form
                                action="{{ route('admin.products.images.primary', [$product, $image]) }}"
                                method="POST"
                                class="mb-2"
                            >

                                @csrf

                                <button
                                    type="submit"
                                    class="btn btn-sm btn-light border w-100"
                                >

                                    <i class="bi bi-star me-1"></i>
                                    Set Primary

                                </button>

                            </form>

                        @else

                            <button
                                type="button"
                                class="btn btn-sm btn-warning w-100 mb-2"
                                disabled
                            >

                                <i class="bi bi-star-fill me-1"></i>
                                Primary Image

                            </button>

                        @endif


                        {{-- DELETE --}}
                        <form
                            action="{{ route('admin.products.images.destroy', [$product, $image]) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this image?');"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-sm btn-outline-danger w-100"
                            >

                                <i class="bi bi-trash me-1"></i>
                                Delete

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>

@endif

                </div>

            </div>


            {{-- =================================================
                PRODUCT DESCRIPTION
            ================================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-0 px-4 pt-4">

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                            style="width:44px;height:44px;"
                        >

                            <i class="bi bi-file-text fs-5"></i>

                        </div>


                        <div>

                            <h5 class="mb-1 fw-bold">
                                Product Description
                            </h5>

                            <small class="text-muted">
                                Product information and details.
                            </small>

                        </div>

                    </div>

                </div>


                <div class="card-body p-4">

                    @if($product->short_description)

                        <div class="mb-4">

                            <h6 class="fw-bold mb-2">
                                Short Description
                            </h6>

                            <p class="text-muted mb-0">
                                {{ $product->short_description }}
                            </p>

                        </div>

                    @endif


                    @if($product->description)

                        <div>

                            <h6 class="fw-bold mb-2">
                                Full Description
                            </h6>

                            <div
                                class="text-muted"
                                style="line-height:1.8; white-space:pre-line;"
                            >
                                {{ $product->description }}
                            </div>

                        </div>

                    @else

                        <div class="text-center py-4">

                            <i class="bi bi-file-text fs-1 text-muted"></i>

                            <p class="text-muted mb-0 mt-2">
                                No detailed description available.
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- =================================================
                PRODUCT INFORMATION
            ================================================== --}}
            <div class="card border-0 shadow-sm">

                <div class="card-header bg-white border-0 px-4 pt-4">

                    <h5 class="fw-bold mb-0">
                        Product Information
                    </h5>

                </div>


                <div class="card-body p-4">

                    <div class="row g-0">


                        {{-- ID --}}
                        <div class="col-md-6 border-bottom p-3">

                            <small class="text-muted d-block mb-1">
                                Product ID
                            </small>

                            <span class="fw-semibold">
                                #{{ $product->id }}
                            </span>

                        </div>


                        {{-- SKU --}}
                        <div class="col-md-6 border-bottom p-3">

                            <small class="text-muted d-block mb-1">
                                SKU
                            </small>

                            <span class="fw-semibold">

                                {{ $product->sku ?: '—' }}

                            </span>

                        </div>


                        {{-- SLUG --}}
                        <div class="col-md-6 border-bottom p-3">

                            <small class="text-muted d-block mb-1">
                                Slug
                            </small>

                            <span
                                class="fw-semibold text-break"
                            >
                                {{ $product->slug }}
                            </span>

                        </div>


                        {{-- SORT ORDER --}}
                        <div class="col-md-6 border-bottom p-3">

                            <small class="text-muted d-block mb-1">
                                Sort Order
                            </small>

                            <span class="fw-semibold">
                                {{ $product->sort_order }}
                            </span>

                        </div>


                        {{-- CREATED --}}
                        <div class="col-md-6 p-3">

                            <small class="text-muted d-block mb-1">
                                Created
                            </small>

                            <span class="fw-semibold">

                                {{ $product->created_at?->format('d M Y, h:i A') }}

                            </span>

                        </div>


                        {{-- UPDATED --}}
                        <div class="col-md-6 p-3">

                            <small class="text-muted d-block mb-1">
                                Last Updated
                            </small>

                            <span class="fw-semibold">

                                {{ $product->updated_at?->format('d M Y, h:i A') }}

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            RIGHT COLUMN
        ====================================================== --}}
        <div class="col-xl-4">


            {{-- =================================================
                PRODUCT SUMMARY
            ================================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-body p-4">


                    {{-- PRODUCT TITLE --}}
                    <div class="mb-4">

                        <div class="d-flex gap-2 flex-wrap mb-2">

                            @if($product->is_featured)

                                <span class="badge bg-warning text-dark">

                                    <i class="bi bi-star-fill me-1"></i>
                                    Featured

                                </span>

                            @endif


                            @if($product->status)

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Inactive
                                </span>

                            @endif

                        </div>


                        <h3 class="fw-bold mb-2">

                            {{ $product->name }}

                        </h3>


                        @if($product->sku)

                            <div class="text-muted small">

                                SKU:
                                <span class="fw-semibold">
                                    {{ $product->sku }}
                                </span>

                            </div>

                        @endif

                    </div>


                    {{-- PRICE --}}
                    <div
                        class="rounded-4 bg-light p-4 mb-4"
                    >

                        <small class="text-muted d-block mb-1">
                            Product Price
                        </small>


                        @if($product->discount_price !== null)

                            <div class="d-flex align-items-center gap-2 flex-wrap">

                                <span class="fs-3 fw-bold text-success">

                                    ₹{{ number_format((float) $product->discount_price, 2) }}

                                </span>


                                @if($product->price !== null)

                                    <span
                                        class="text-muted text-decoration-line-through"
                                    >

                                        ₹{{ number_format((float) $product->price, 2) }}

                                    </span>

                                @endif

                            </div>


                            @if($product->price && $product->discount_price < $product->price)

                                @php

                                    $discount =
                                        (($product->price - $product->discount_price)
                                        / $product->price) * 100;

                                @endphp

                                <small class="text-success fw-semibold">

                                    {{ round($discount) }}% OFF

                                </small>

                            @endif

                        @elseif($product->price !== null)

                            <span class="fs-3 fw-bold">

                                ₹{{ number_format((float) $product->price, 2) }}

                            </span>

                        @else

                            <span class="text-muted">
                                Price not available
                            </span>

                        @endif

                    </div>


                    {{-- STOCK --}}
                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <div>

                            <small class="text-muted d-block">
                                Stock
                            </small>

                            <span class="fw-bold">

                                {{ number_format($product->stock) }}

                            </span>

                        </div>


                        @if($product->stock > 0)

                            <span class="badge bg-success-subtle text-success">

                                In Stock

                            </span>

                        @else

                            <span class="badge bg-danger-subtle text-danger">

                                Out of Stock

                            </span>

                        @endif

                    </div>


                    <hr>


                    {{-- CATEGORY --}}
                    <div class="py-2">

                        <small class="text-muted d-block mb-1">
                            Category
                        </small>

                        <span class="fw-semibold">

                            {{ $product->category?->name ?? '—' }}

                        </span>

                    </div>


                    {{-- SUBCATEGORY --}}
                    <div class="py-2">

                        <small class="text-muted d-block mb-1">
                            Subcategory
                        </small>

                        <span class="fw-semibold">

                            {{ $product->subcategory?->name ?? '—' }}

                        </span>

                    </div>

                </div>

            </div>


            {{-- =================================================
                BUSINESS CARD
            ================================================== --}}
            <div class="card border-0 shadow-sm mb-4">

                <div class="card-header bg-white border-0 px-4 pt-4">

                    <h5 class="fw-bold mb-0">
                        Business
                    </h5>

                </div>


                <div class="card-body p-4">

                    @if($product->business)

                    <div class="d-flex align-items-center gap-3">

                        <div
                            class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                            style="width:52px;height:52px;"
                        >
                            <i class="bi bi-shop fs-4"></i>
                        </div>

                        <div>

                            <div class="fw-bold">
                                {{ $product->business->name }}
                            </div>

                            @if($product->business->city)

                                <small class="text-muted">

                                    <i class="bi bi-geo-alt me-1"></i>

                                    {{ $product->business->city?->name ?? '—' }}

                                </small>

                            @endif

                        </div>

                    </div>

                @else

                    <p class="text-muted mb-0">
                        No business assigned.
                    </p>

                @endif

                </div>

            </div>


            {{-- =================================================
                ACTIONS
            ================================================== --}}
            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <a
                        href="{{ route('admin.products.edit', $product) }}"
                        class="btn btn-primary w-100 py-2 mb-2"
                    >

                        <i class="bi bi-pencil me-1"></i>
                        Edit Product

                    </a>


                    <form
                        action="{{ route('admin.products.destroy', $product) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this product?');"
                    >

                        @csrf
                        @method('DELETE')


                        <button
                            type="submit"
                            class="btn btn-light text-danger w-100 py-2"
                        >

                            <i class="bi bi-trash me-1"></i>
                            Delete Product

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- =============================================================
    GALLERY SCRIPT
============================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const mainImage =
        document.getElementById('mainProductImage');

    const thumbnails =
        document.querySelectorAll('.product-thumb');


    thumbnails.forEach(function (thumbnail) {

        thumbnail.addEventListener('click', function () {

            if (!mainImage) {
                return;
            }


            mainImage.src =
                this.dataset.image;


            thumbnails.forEach(function (item) {

                item.classList.remove(
                    'border-primary'
                );

            });


            this.classList.add(
                'border-primary'
            );

        });

    });

});

</script>

@endsection
