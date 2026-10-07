@extends('layouts.main')

@section('title', $product->name . ' | ' . ($product->business->name ?? 'Lokora'))

@section('description')
    {{ $product->short_description ?: Str::limit(strip_tags($product->description ?? ''), 160) }}
@endsection

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | PRODUCT DATA
    |--------------------------------------------------------------------------
    */

    $images = $product->images ?? collect();

    $primaryImage = $images->firstWhere('is_primary', true)
        ?: $images->first();

    $hasDiscount =
        !is_null($product->price) &&
        !is_null($product->discount_price) &&
        (float) $product->discount_price < (float) $product->price;

    $discountPercent = $hasDiscount
        ? round(
            (
                ((float) $product->price - (float) $product->discount_price)
                / (float) $product->price
            ) * 100
        )
        : 0;

    $business = $product->business;
@endphp


{{-- =========================================================
    PREMIUM PRODUCT HERO
========================================================= --}}

<section class="relative overflow-hidden bg-slate-950">

    {{-- Background --}}
    <div class="absolute inset-0 pointer-events-none">

        <div class="absolute -top-40 -right-40 w-96 h-96
                    rounded-full bg-primary/20 blur-3xl">
        </div>

        <div class="absolute -bottom-40 -left-40 w-96 h-96
                    rounded-full bg-primary/10 blur-3xl">
        </div>

        <div
            class="absolute inset-0 opacity-[0.035]"
            style="
                background-image:
                linear-gradient(rgba(255,255,255,.7) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.7) 1px, transparent 1px);
                background-size: 45px 45px;
            "
        ></div>

    </div>


    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <div
            class="pt-7 pb-5"
            style="margin-top: 70px;"
        >

            <nav class="flex flex-wrap items-center gap-2
                        text-sm text-white/50">

                <a
                    href="{{ url('/') }}"
                    class="hover:text-white transition"
                >
                    Home
                </a>

                <i class="fas fa-chevron-right text-[9px]"></i>

                <a
                    href="{{ route('businesses.show', $business->slug) }}"
                    class="hover:text-white transition"
                >
                    {{ $business->name }}
                </a>

                <i class="fas fa-chevron-right text-[9px]"></i>

                <span class="text-white/80">
                    {{ $product->name }}
                </span>

            </nav>

        </div>


        {{-- Product Header --}}
        <div
            class="grid lg:grid-cols-12 gap-8 lg:gap-12 pb-12"
            style="margin-top: 20px;"
        >

            {{-- =================================================
                LEFT - PRODUCT IMAGE
            ================================================== --}}

            <div class="lg:col-span-7">

                <div
                    class="relative rounded-[28px] overflow-hidden
                           border border-white/10 bg-white/5
                           shadow-2xl"
                >

                    {{-- Main Image --}}
                    <div
                        id="productMainImage"
                        class="relative aspect-[16/11] sm:aspect-[16/10]
                               bg-slate-900 overflow-hidden"
                    >

                        @if($primaryImage)

                            <img
                                id="mainProductImage"
                                src="{{ asset('storage/' . $primaryImage->image) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover"
                            >

                        @else

                            <div
                                class="w-full h-full flex items-center
                                       justify-center"
                            >

                                <div class="text-center">

                                    <div
                                        class="w-24 h-24 mx-auto rounded-3xl
                                               bg-white/10 flex items-center
                                               justify-center mb-4"
                                    >

                                        <i class="fas fa-box-open
                                                  text-4xl text-white/30">
                                        </i>

                                    </div>

                                    <p class="text-white/40">
                                        No product image available
                                    </p>

                                </div>

                            </div>

                        @endif


                        {{-- Image Overlay --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-t
                                   from-black/30 via-transparent
                                   to-transparent pointer-events-none"
                        ></div>


                        {{-- Featured --}}
                        @if($product->is_featured)

                            <div
                                class="absolute top-5 left-5
                                       inline-flex items-center gap-2
                                       px-3.5 py-2 rounded-xl
                                       bg-primary text-white
                                       text-xs font-bold shadow-xl"
                            >

                                <i class="fas fa-star"></i>

                                Featured Product

                            </div>

                        @endif


                        {{-- Discount --}}
                        @if($hasDiscount)

                            <div
                                class="absolute top-5 right-5
                                       px-3.5 py-2 rounded-xl
                                       bg-red-500 text-white
                                       text-sm font-bold shadow-xl"
                            >

                                Save {{ $discountPercent }}%

                            </div>

                        @endif

                    </div>


                    {{-- Thumbnail Gallery --}}
                    @if($images->count() > 1)

                        <div
                            class="p-3 sm:p-4 bg-black/20
                                   border-t border-white/10"
                        >

                            <div
                                class="flex gap-3 overflow-x-auto
                                       scrollbar-hide"
                            >

                                @foreach($images as $image)

                                    <button
                                        type="button"
                                        onclick="changeProductImage(
                                            '{{ asset('storage/' . $image->image) }}',
                                            this
                                        )"
                                        class="product-thumb shrink-0
                                               w-20 h-16 sm:w-24 sm:h-20
                                               rounded-xl overflow-hidden
                                               border-2
                                               {{ $image->id === $primaryImage?->id
                                                    ? 'border-primary'
                                                    : 'border-transparent' }}
                                               bg-white/10
                                               hover:border-primary/70
                                               transition"
                                    >

                                        <img
                                            src="{{ asset('storage/' . $image->image) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-cover"
                                            loading="lazy"
                                        >

                                    </button>

                                @endforeach

                            </div>

                        </div>

                    @endif

                </div>

            </div>


            {{-- =================================================
                RIGHT - PRODUCT INFORMATION
            ================================================== --}}

            <div class="lg:col-span-5 flex flex-col justify-center">

                {{-- Category --}}
                <div class="flex flex-wrap items-center gap-2 mb-4">

                    @if($product->category)

                        <a
                            href="{{ route(
                                'categories.show',
                                $product->category->slug
                            ) }}"
                            class="inline-flex items-center gap-2
                                   px-3 py-1.5 rounded-lg
                                   bg-primary/10 text-primary
                                   text-xs font-bold uppercase
                                   tracking-wider"
                        >

                            <i class="fas fa-layer-group"></i>

                            {{ $product->category->name }}

                        </a>

                    @endif


                    @if($product->subcategory)

                        <span class="text-white/20">•</span>

                        <span class="text-sm text-white/50">
                            {{ $product->subcategory->name }}
                        </span>

                    @endif

                </div>


                {{-- Product Name --}}
                <h1
                    class="text-3xl sm:text-4xl lg:text-5xl
                           font-extrabold tracking-tight
                           text-white leading-tight"
                >

                    {{ $product->name }}

                </h1>


                {{-- Short Description --}}
                @if($product->short_description)

                    <p
                        class="mt-5 text-base sm:text-lg
                               leading-7 text-white/60"
                    >
                        {{ $product->short_description }}
                    </p>

                @elseif($product->description)

                    <p
                        class="mt-5 text-base sm:text-lg
                               leading-7 text-white/60"
                    >
                        {{ Str::limit(strip_tags($product->description), 220) }}
                    </p>

                @endif


                {{-- Price --}}
                <div
                    class="mt-7 flex flex-wrap items-end gap-x-4 gap-y-2"
                >

                    @if($hasDiscount)

                        <span
                            class="text-3xl sm:text-4xl
                                   font-extrabold text-white"
                        >

                            ₹{{ number_format(
                                (float) $product->discount_price,
                                2
                            ) }}

                        </span>

                        <span
                            class="text-lg text-white/35
                                   line-through pb-1"
                        >

                            ₹{{ number_format(
                                (float) $product->price,
                                2
                            ) }}

                        </span>

                        <span
                            class="mb-1 px-2.5 py-1 rounded-lg
                                   bg-green-500/15 text-green-400
                                   text-xs font-bold"
                        >

                            {{ $discountPercent }}% OFF

                        </span>

                    @elseif(!is_null($product->price))

                        <span
                            class="text-3xl sm:text-4xl
                                   font-extrabold text-white"
                        >

                            ₹{{ number_format(
                                (float) $product->price,
                                2
                            ) }}

                        </span>

                    @else

                        <span
                            class="text-xl font-semibold
                                   text-white/60"
                        >
                            Price on request
                        </span>

                    @endif

                </div>


                {{-- Product Meta --}}
                <div
                    class="grid sm:grid-cols-2 gap-3 mt-7"
                >

                    @if($product->sku)

                        <div
                            class="rounded-xl border border-white/10
                                   bg-white/5 p-4"
                        >

                            <div class="flex items-center gap-3">

                                <div
                                    class="w-9 h-9 rounded-lg
                                           bg-white/10
                                           flex items-center justify-center"
                                >

                                    <i class="fas fa-barcode
                                              text-white/60">
                                    </i>

                                </div>

                                <div>

                                    <p class="text-[11px]
                                              uppercase tracking-wider
                                              text-white/35">
                                        SKU
                                    </p>

                                    <p class="text-sm font-semibold
                                              text-white mt-0.5">
                                        {{ $product->sku }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    @endif


                    <div
                        class="rounded-xl border border-white/10
                               bg-white/5 p-4"
                    >

                        <div class="flex items-center gap-3">

                            <div
                                class="w-9 h-9 rounded-lg
                                       bg-white/10
                                       flex items-center justify-center"
                            >

                                <i
                                    class="fas fa-circle-check
                                           {{ $product->stock > 0
                                                ? 'text-green-400'
                                                : 'text-red-400' }}"
                                ></i>

                            </div>

                            <div>

                                <p class="text-[11px]
                                          uppercase tracking-wider
                                          text-white/35">
                                    Availability
                                </p>

                                @if($product->stock > 0)

                                    <p
                                        class="text-sm font-semibold
                                               text-green-400 mt-0.5"
                                    >
                                        In Stock
                                    </p>

                                @else

                                    <p
                                        class="text-sm font-semibold
                                               text-red-400 mt-0.5"
                                    >
                                        Currently Unavailable
                                    </p>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Actions --}}
                <div
                    class="flex flex-col sm:flex-row gap-3 mt-7"
                >

                    @if($business->phone)

                        <a
                            href="tel:{{ $business->phone }}"
                            class="flex-1 inline-flex items-center
                                   justify-center gap-2
                                   px-5 py-3.5 rounded-xl
                                   bg-primary text-white
                                   font-bold shadow-lg
                                   shadow-primary/20
                                   hover:opacity-90
                                   transition"
                        >

                            <i class="fas fa-phone"></i>

                            Contact Business

                        </a>

                    @endif


                    @if($business->email)

                        <a
                            href="mailto:{{ $business->email }}"
                            class="inline-flex items-center
                                   justify-center gap-2
                                   px-5 py-3.5 rounded-xl
                                   border border-white/15
                                   bg-white/5 text-white
                                   font-semibold
                                   hover:bg-white/10
                                   transition"
                        >

                            <i class="fas fa-envelope"></i>

                            Email

                        </a>

                    @endif

                </div>


                {{-- Business Mini Info --}}
                <a
                    href="{{ route('businesses.show', $business->slug) }}"
                    class="group mt-7 flex items-center gap-4
                           p-4 rounded-2xl
                           border border-white/10
                           bg-white/[0.04]
                           hover:bg-white/[0.07]
                           transition"
                >

                    {{-- Business Logo --}}
                    <div
                        class="w-12 h-12 rounded-xl overflow-hidden
                               bg-white/10 shrink-0"
                    >

                        @if($business->logo)

                            <img
                                src="{{ asset('storage/' . $business->logo) }}"
                                alt="{{ $business->name }}"
                                class="w-full h-full object-cover"
                            >

                        @else

                            <div
                                class="w-full h-full flex items-center
                                       justify-center"
                            >

                                <i class="fas fa-store
                                          text-white/40">
                                </i>

                            </div>

                        @endif

                    </div>


                    <div class="min-w-0 flex-1">

                        <p class="text-[11px] uppercase
                                  tracking-wider text-white/35">
                            Sold / Listed by
                        </p>

                        <h3
                            class="text-sm sm:text-base
                                   font-bold text-white
                                   truncate group-hover:text-primary
                                   transition"
                        >
                            {{ $business->name }}
                        </h3>

                        @if($business->city)

                            <p
                                class="text-xs text-white/40 mt-0.5
                                       flex items-center gap-1"
                            >

                                <i class="fas fa-location-dot"></i>

                                {{ $business->city->name }}

                                @if($business->state)
                                    , {{ $business->state->name }}
                                @endif

                            </p>

                        @endif

                    </div>


                    <i
                        class="fas fa-arrow-right text-white/30
                               group-hover:text-primary
                               group-hover:translate-x-1
                               transition"
                    ></i>

                </a>

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
    PRODUCT NAVIGATION
========================================================= --}}

<section
    class="bg-white border-b border-gray-200
           sticky top-0 z-30 shadow-sm"
>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div
            class="product-navigation flex items-center
                   gap-1 overflow-x-auto scrollbar-hide"
        >

            <button
                type="button"
                class="product-tab active"
                data-tab="overview"
                onclick="showProductTab('overview')"
            >
                <i class="fas fa-box-open"></i>
                <span>Overview</span>
            </button>


            <button
                type="button"
                class="product-tab"
                data-tab="description"
                onclick="showProductTab('description')"
            >
                <i class="fas fa-align-left"></i>
                <span>Description</span>
            </button>


            <button
                type="button"
                class="product-tab"
                data-tab="highlights"
                onclick="showProductTab('highlights')"
            >
                <i class="fas fa-star"></i>
                <span>Highlights</span>
            </button>


            <button
                type="button"
                class="product-tab"
                data-tab="gallery"
                onclick="showProductTab('gallery')"
            >
                <i class="fas fa-images"></i>
                <span>Gallery</span>

                @if($images->count())
                    <span class="product-tab-count">
                        {{ $images->count() }}
                    </span>
                @endif
            </button>


            <button
                type="button"
                class="product-tab"
                data-tab="enquiry"
                onclick="showProductTab('enquiry')"
            >
                <i class="fas fa-paper-plane"></i>
                <span>Enquiry</span>
            </button>


            <button
                type="button"
                class="product-tab"
                data-tab="business"
                onclick="showProductTab('business')"
            >
                <i class="fas fa-store"></i>
                <span>Business</span>
            </button>


            <button
                type="button"
                class="product-tab"
                data-tab="contact"
                onclick="showProductTab('contact')"
            >
                <i class="fas fa-comments"></i>
                <span>Contact</span>
            </button>

        </div>

    </div>

</section>



{{-- =========================================================
    MAIN PRODUCT TABS CONTENT
========================================================= --}}

<section class="py-12 sm:py-16 bg-gray-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


        {{-- =====================================================
            OVERVIEW PANEL
        ====================================================== --}}

        <div
            class="product-tab-panel"
            data-panel="overview"
        >

            <div class="grid lg:grid-cols-12 gap-8">

                {{-- LEFT --}}
                <div class="lg:col-span-8 space-y-8">

                    {{-- Product Overview --}}
                    <div
                        class="bg-white rounded-3xl
                               border border-gray-100
                               shadow-sm p-6 sm:p-8"
                    >

                        <div class="flex items-center gap-3 mb-6">

                            <div
                                class="w-11 h-11 rounded-xl
                                       bg-primary/10
                                       flex items-center justify-center"
                            >

                                <i class="fas fa-box-open
                                          text-primary">
                                </i>

                            </div>

                            <div>

                                <span
                                    class="text-xs font-bold
                                           uppercase tracking-wider
                                           text-primary"
                                >
                                    Product Overview
                                </span>

                                <h2
                                    class="text-2xl font-bold
                                           text-dark-900 mt-0.5"
                                >
                                    {{ $product->name }}
                                </h2>

                            </div>

                        </div>


                        @if($product->short_description)

                            <p
                                class="text-gray-600 leading-7"
                            >
                                {{ $product->short_description }}
                            </p>

                        @elseif($product->description)

                            <p
                                class="text-gray-600 leading-7"
                            >
                                {{ Str::limit(
                                    strip_tags($product->description),
                                    500
                                ) }}
                            </p>

                        @else

                            <p class="text-gray-500 leading-7">
                                Contact the business directly for
                                complete product information.
                            </p>

                        @endif


                        {{-- Quick Product Details --}}
                        <div
                            class="grid sm:grid-cols-2
                                   gap-4 mt-7 pt-7
                                   border-t border-gray-100"
                        >

                            @if($product->category)

                                <div
                                    class="flex items-center gap-3
                                           p-4 rounded-2xl
                                           bg-gray-50 border
                                           border-gray-100"
                                >

                                    <div
                                        class="w-10 h-10 rounded-xl
                                               bg-primary/10
                                               flex items-center
                                               justify-center"
                                    >

                                        <i
                                            class="fas fa-layer-group
                                                   text-primary"
                                        ></i>

                                    </div>

                                    <div>

                                        <p class="text-xs text-gray-400">
                                            Category
                                        </p>

                                        <p
                                            class="text-sm font-bold
                                                   text-gray-800 mt-0.5"
                                        >
                                            {{ $product->category->name }}
                                        </p>

                                    </div>

                                </div>

                            @endif


                            @if($product->subcategory)

                                <div
                                    class="flex items-center gap-3
                                           p-4 rounded-2xl
                                           bg-gray-50 border
                                           border-gray-100"
                                >

                                    <div
                                        class="w-10 h-10 rounded-xl
                                               bg-blue-50
                                               flex items-center
                                               justify-center"
                                    >

                                        <i
                                            class="fas fa-tags
                                                   text-blue-600"
                                        ></i>

                                    </div>

                                    <div>

                                        <p class="text-xs text-gray-400">
                                            Subcategory
                                        </p>

                                        <p
                                            class="text-sm font-bold
                                                   text-gray-800 mt-0.5"
                                        >
                                            {{ $product->subcategory->name }}
                                        </p>

                                    </div>

                                </div>

                            @endif


                            @if($product->sku)

                                <div
                                    class="flex items-center gap-3
                                           p-4 rounded-2xl
                                           bg-gray-50 border
                                           border-gray-100"
                                >

                                    <div
                                        class="w-10 h-10 rounded-xl
                                               bg-purple-50
                                               flex items-center
                                               justify-center"
                                    >

                                        <i
                                            class="fas fa-barcode
                                                   text-purple-600"
                                        ></i>

                                    </div>

                                    <div>

                                        <p class="text-xs text-gray-400">
                                            SKU
                                        </p>

                                        <p
                                            class="text-sm font-bold
                                                   text-gray-800 mt-0.5"
                                        >
                                            {{ $product->sku }}
                                        </p>

                                    </div>

                                </div>

                            @endif


                            <div
                                class="flex items-center gap-3
                                       p-4 rounded-2xl
                                       bg-gray-50 border
                                       border-gray-100"
                            >

                                <div
                                    class="w-10 h-10 rounded-xl
                                           {{ $product->stock > 0
                                                ? 'bg-green-50'
                                                : 'bg-red-50' }}
                                           flex items-center
                                           justify-center"
                                >

                                    <i
                                        class="fas fa-circle-check
                                               {{ $product->stock > 0
                                                    ? 'text-green-600'
                                                    : 'text-red-600' }}"
                                    ></i>

                                </div>

                                <div>

                                    <p class="text-xs text-gray-400">
                                        Availability
                                    </p>

                                    @if($product->stock > 0)

                                        <p
                                            class="text-sm font-bold
                                                   text-green-600 mt-0.5"
                                        >
                                            In Stock
                                        </p>

                                    @else

                                        <p
                                            class="text-sm font-bold
                                                   text-red-600 mt-0.5"
                                        >
                                            Currently Unavailable
                                        </p>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Share --}}
                    <div
                        class="bg-gray-900 rounded-3xl p-6 sm:p-8
                               text-white overflow-hidden relative"
                    >

                        <div
                            class="absolute -right-10 -top-10
                                   w-40 h-40 rounded-full
                                   bg-primary/20 blur-3xl"
                        ></div>

                        <div class="relative">

                            <div
                                class="flex flex-col sm:flex-row
                                       sm:items-center
                                       justify-between gap-5"
                            >

                                <div class="flex items-center gap-4">

                                    <div
                                        class="w-12 h-12 rounded-xl
                                               bg-white/10
                                               flex items-center justify-center"
                                    >

                                        <i class="fas fa-share-nodes"></i>

                                    </div>

                                    <div>

                                        <h3 class="font-bold text-lg">
                                            Share this product
                                        </h3>

                                        <p class="text-sm text-white/45 mt-1">
                                            Help others discover it
                                        </p>

                                    </div>

                                </div>


                                <button
                                    type="button"
                                    onclick="shareProduct()"
                                    class="inline-flex items-center
                                           justify-center gap-2
                                           px-5 py-3 rounded-xl
                                           bg-white text-gray-900
                                           font-bold text-sm
                                           hover:bg-primary
                                           hover:text-white
                                           transition"
                                >

                                    <i class="fas fa-share-nodes"></i>

                                    Share Product

                                </button>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- RIGHT --}}
                <aside class="lg:col-span-4">

                    <div class="lg:sticky lg:top-24">

                        <div
                            class="bg-white rounded-3xl
                                   border border-gray-100
                                   shadow-sm overflow-hidden"
                        >

                            <div class="h-2 bg-primary"></div>

                            <div class="p-6">

                                <p
                                    class="text-xs font-bold
                                           uppercase tracking-wider
                                           text-primary mb-4"
                                >
                                    Listed By
                                </p>

                                <div
                                    class="flex items-center gap-4"
                                >

                                    <div
                                        class="w-16 h-16 rounded-2xl
                                               overflow-hidden
                                               bg-gray-100 shrink-0"
                                    >

                                        @if($business->logo)

                                            <img
                                                src="{{ asset(
                                                    'storage/' . $business->logo
                                                ) }}"
                                                alt="{{ $business->name }}"
                                                class="w-full h-full object-cover"
                                            >

                                        @else

                                            <div
                                                class="w-full h-full
                                                       flex items-center
                                                       justify-center"
                                            >

                                                <i
                                                    class="fas fa-store
                                                           text-gray-300
                                                           text-2xl"
                                                ></i>

                                            </div>

                                        @endif

                                    </div>


                                    <div class="min-w-0">

                                        <h3
                                            class="font-bold text-gray-900
                                                   text-lg truncate"
                                        >
                                            {{ $business->name }}
                                        </h3>

                                        @if($business->rating)

                                            <div
                                                class="flex items-center
                                                       gap-2 mt-1"
                                            >

                                                <span
                                                    class="text-amber-500
                                                           text-sm"
                                                >
                                                    <i class="fas fa-star"></i>
                                                </span>

                                                <span
                                                    class="text-sm font-semibold
                                                           text-gray-700"
                                                >
                                                    {{ number_format(
                                                        (float) $business->rating,
                                                        1
                                                    ) }}
                                                </span>

                                            </div>

                                        @endif

                                    </div>

                                </div>


                                @if($business->city)

                                    <div
                                        class="flex items-start gap-3
                                               mt-5 pt-5
                                               border-t border-gray-100"
                                    >

                                        <div
                                            class="w-9 h-9 rounded-lg
                                                   bg-gray-50
                                                   flex items-center
                                                   justify-center"
                                        >

                                            <i
                                                class="fas fa-location-dot
                                                       text-primary text-sm"
                                            ></i>

                                        </div>

                                        <div>

                                            <p
                                                class="text-xs text-gray-400
                                                       uppercase tracking-wide"
                                            >
                                                Location
                                            </p>

                                            <p
                                                class="text-sm text-gray-600
                                                       leading-6 mt-1"
                                            >
                                                {{ $business->city->name }}

                                                @if($business->state)
                                                    , {{ $business->state->name }}
                                                @endif
                                            </p>

                                        </div>

                                    </div>

                                @endif


                                <a
                                    href="{{ route(
                                        'businesses.show',
                                        $business->slug
                                    ) }}"
                                    class="mt-5 w-full
                                           inline-flex items-center
                                           justify-center gap-2
                                           px-5 py-3 rounded-xl
                                           bg-gray-900 text-white
                                           font-semibold text-sm
                                           hover:bg-primary
                                           transition"
                                >

                                    View Business Profile

                                    <i class="fas fa-arrow-right text-xs"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                </aside>

            </div>

        </div>



        {{-- =====================================================
            DESCRIPTION PANEL
        ====================================================== --}}

        <div
            class="product-tab-panel hidden"
            data-panel="description"
        >

            @if($product->description)

                <div
                    class="max-w-4xl mx-auto bg-white rounded-3xl
                           border border-gray-100
                           shadow-sm p-6 sm:p-8"
                >

                    <div class="flex items-center gap-3 mb-7">

                        <div
                            class="w-11 h-11 rounded-xl
                                   bg-primary/10
                                   flex items-center justify-center"
                        >

                            <i class="fas fa-align-left
                                      text-primary">
                            </i>

                        </div>

                        <div>

                            <span
                                class="text-xs font-bold
                                       uppercase tracking-wider
                                       text-primary"
                            >
                                Product Information
                            </span>

                            <h2
                                class="text-2xl sm:text-3xl
                                       font-bold text-dark-900 mt-0.5"
                            >
                                About This Product
                            </h2>

                        </div>

                    </div>


                    <div
                        class="prose prose-gray max-w-none
                               text-gray-600 leading-7"
                    >

                        {!! nl2br(e($product->description)) !!}

                    </div>

                </div>

            @else

                <div
                    class="max-w-4xl mx-auto bg-white rounded-3xl
                           border border-gray-100
                           shadow-sm p-10 text-center"
                >

                    <div
                        class="w-16 h-16 mx-auto rounded-2xl
                               bg-gray-50
                               flex items-center justify-center mb-4"
                    >

                        <i class="fas fa-align-left
                                  text-gray-300 text-2xl">
                        </i>

                    </div>

                    <h2 class="text-xl font-bold text-gray-900">
                        Product Description
                    </h2>

                    <p class="text-gray-500 mt-2">
                        No detailed description has been added for this product.
                    </p>

                </div>

            @endif

        </div>



        {{-- =====================================================
            HIGHLIGHTS PANEL
        ====================================================== --}}

        <div
            class="product-tab-panel hidden"
            data-panel="highlights"
        >

            <div class="max-w-5xl mx-auto">

                <div
                    class="text-center mb-8"
                >

                    <span
                        class="text-xs font-bold
                               uppercase tracking-wider
                               text-primary"
                    >
                        Why Choose
                    </span>

                    <h2
                        class="text-2xl sm:text-3xl
                               font-bold text-dark-900 mt-1"
                    >
                        Product Highlights
                    </h2>

                    <p
                        class="text-gray-500 mt-2
                               max-w-2xl mx-auto"
                    >
                        Important reasons to explore this product
                        and connect with the listed business.
                    </p>

                </div>


                <div
                    class="grid sm:grid-cols-2
                           gap-5"
                >

                    {{-- Highlight 1 --}}
                    <div
                        class="flex items-start gap-4 p-6
                               bg-white rounded-3xl
                               border border-gray-100
                               shadow-sm"
                    >

                        <div
                            class="w-12 h-12 rounded-2xl
                                   bg-green-50
                                   flex items-center justify-center
                                   shrink-0"
                        >

                            <i class="fas fa-circle-check
                                      text-green-600 text-lg">
                            </i>

                        </div>

                        <div>

                            <h3
                                class="font-bold text-gray-900 text-lg"
                            >
                                Verified Listing
                            </h3>

                            <p
                                class="text-sm text-gray-500
                                       leading-6 mt-1"
                            >
                                Listed by a verified business
                                on Lokora.
                            </p>

                        </div>

                    </div>


                    {{-- Highlight 2 --}}
                    <div
                        class="flex items-start gap-4 p-6
                               bg-white rounded-3xl
                               border border-gray-100
                               shadow-sm"
                    >

                        <div
                            class="w-12 h-12 rounded-2xl
                                   bg-blue-50
                                   flex items-center justify-center
                                   shrink-0"
                        >

                            <i class="fas fa-store
                                      text-blue-600 text-lg">
                            </i>

                        </div>

                        <div>

                            <h3
                                class="font-bold text-gray-900 text-lg"
                            >
                                Trusted Business
                            </h3>

                            <p
                                class="text-sm text-gray-500
                                       leading-6 mt-1"
                            >
                                Connect directly with the
                                business owner.
                            </p>

                        </div>

                    </div>


                    {{-- Highlight 3 --}}
                    <div
                        class="flex items-start gap-4 p-6
                               bg-white rounded-3xl
                               border border-gray-100
                               shadow-sm"
                    >

                        <div
                            class="w-12 h-12 rounded-2xl
                                   bg-purple-50
                                   flex items-center justify-center
                                   shrink-0"
                        >

                            <i class="fas fa-images
                                      text-purple-600 text-lg">
                            </i>

                        </div>

                        <div>

                            <h3
                                class="font-bold text-gray-900 text-lg"
                            >
                                Product Gallery
                            </h3>

                            <p
                                class="text-sm text-gray-500
                                       leading-6 mt-1"
                            >
                                Explore multiple product images
                                before contacting the business.
                            </p>

                        </div>

                    </div>


                    {{-- Highlight 4 --}}
                    <div
                        class="flex items-start gap-4 p-6
                               bg-white rounded-3xl
                               border border-gray-100
                               shadow-sm"
                    >

                        <div
                            class="w-12 h-12 rounded-2xl
                                   bg-orange-50
                                   flex items-center justify-center
                                   shrink-0"
                        >

                            <i class="fas fa-headset
                                      text-orange-600 text-lg">
                            </i>

                        </div>

                        <div>

                            <h3
                                class="font-bold text-gray-900 text-lg"
                            >
                                Direct Contact
                            </h3>

                            <p
                                class="text-sm text-gray-500
                                       leading-6 mt-1"
                            >
                                Contact the listed business
                                directly for details.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- =====================================================
            GALLERY PANEL
        ====================================================== --}}

        <div
            class="product-tab-panel hidden"
            data-panel="gallery"
        >

            <div class="max-w-6xl mx-auto">

                <div class="text-center mb-8">

                    <span
                        class="text-xs font-bold
                               uppercase tracking-wider
                               text-primary"
                    >
                        Product Gallery
                    </span>

                    <h2
                        class="text-2xl sm:text-3xl
                               font-bold text-dark-900 mt-1"
                    >
                        Explore Product Images
                    </h2>

                    <p
                        class="text-gray-500 mt-2"
                    >
                        Browse all available images of
                        {{ $product->name }}.
                    </p>

                </div>


                @if($images->count())

                    <div
                        class="grid grid-cols-2
                               md:grid-cols-3
                               lg:grid-cols-4 gap-5"
                    >

                        @foreach($images as $image)

                            <button
                                type="button"
                                onclick="openGalleryImage(
                                    '{{ asset('storage/' . $image->image) }}'
                                )"
                                class="group relative
                                       aspect-square overflow-hidden
                                       rounded-3xl bg-white
                                       border border-gray-100
                                       shadow-sm text-left"
                            >

                                <img
                                    src="{{ asset(
                                        'storage/' . $image->image
                                    ) }}"
                                    alt="{{ $product->name }}"
                                    class="w-full h-full object-cover
                                           group-hover:scale-105
                                           transition duration-500"
                                    loading="lazy"
                                >

                                <div
                                    class="absolute inset-0
                                           bg-black/0
                                           group-hover:bg-black/20
                                           transition"
                                ></div>

                                <div
                                    class="absolute bottom-3 right-3
                                           w-9 h-9 rounded-xl
                                           bg-white/90
                                           flex items-center justify-center
                                           opacity-0
                                           group-hover:opacity-100
                                           transition"
                                >

                                    <i
                                        class="fas fa-expand
                                               text-gray-800 text-sm"
                                    ></i>

                                </div>

                            </button>

                        @endforeach

                    </div>

                @else

                    <div
                        class="bg-white rounded-3xl
                               border border-gray-100
                               shadow-sm p-12 text-center"
                    >

                        <div
                            class="w-16 h-16 mx-auto rounded-2xl
                                   bg-gray-50
                                   flex items-center justify-center mb-4"
                        >

                            <i
                                class="fas fa-images
                                       text-gray-300 text-2xl"
                            ></i>

                        </div>

                        <h3
                            class="font-bold text-gray-900 text-lg"
                        >
                            No Gallery Images
                        </h3>

                        <p
                            class="text-gray-500 text-sm mt-1"
                        >
                            No additional product images are available.
                        </p>

                    </div>

                @endif

            </div>

        </div>



        {{-- =====================================================
            ENQUIRY PANEL
        ====================================================== --}}

        <div
            class="product-tab-panel hidden"
            data-panel="enquiry"
        >

            <div class="max-w-3xl mx-auto">

                <div
                    id="product-enquiry"
                    class="bg-white rounded-3xl
                           border border-gray-100
                           shadow-sm overflow-hidden"
                >

                    {{-- Top Accent --}}
                    <div class="h-1.5 bg-primary"></div>

                    <div class="p-6 sm:p-8">

                        {{-- Header --}}
                        <div
                            class="flex items-center gap-3 mb-5"
                        >

                            <div
                                class="w-11 h-11 rounded-xl
                                       bg-primary/10
                                       flex items-center justify-center
                                       shrink-0"
                            >

                                <i
                                    class="fas fa-paper-plane
                                           text-primary"
                                ></i>

                            </div>

                            <div>

                                <p
                                    class="text-xs text-primary
                                           font-bold uppercase
                                           tracking-wider"
                                >
                                    Product Enquiry
                                </p>

                                <h3
                                    class="font-bold text-gray-900
                                           text-xl"
                                >
                                    Ask About This Product
                                </h3>

                            </div>

                        </div>


                        {{-- Description --}}
                        <p
                            class="text-sm text-gray-500
                                   leading-6 mb-6"
                        >
                            Have a question about
                            <strong class="text-gray-700">
                                {{ $product->name }}
                            </strong>?
                            Send your enquiry directly to
                            <strong class="text-gray-700">
                                {{ $business->name }}
                            </strong>.
                        </p>


                        {{-- Success --}}
                        @if(session()->has('enquiry_success'))

                            <div
                                class="mb-5 flex items-start gap-3
                                       rounded-2xl border border-green-200
                                       bg-green-50 p-4"
                            >

                                <div
                                    class="w-10 h-10 rounded-xl
                                           bg-green-100
                                           flex items-center justify-center
                                           shrink-0"
                                >

                                    <i
                                        class="fas fa-check-circle
                                               text-green-600 text-lg"
                                    ></i>

                                </div>

                                <div class="min-w-0">

                                    <p
                                        class="text-sm font-bold
                                               text-green-800"
                                    >
                                        Enquiry Sent Successfully
                                    </p>

                                    <p
                                        class="text-sm text-green-700
                                               mt-1 leading-6"
                                    >
                                        {{ session('enquiry_success') }}
                                    </p>

                                </div>

                            </div>

                        @endif


                        {{-- Validation Errors --}}
                        @if($errors->any())

                            <div
                                class="mb-5 rounded-2xl
                                       border border-red-200
                                       bg-red-50 p-4"
                            >

                                <div
                                    class="flex items-center
                                           gap-2 mb-2"
                                >

                                    <i
                                        class="fas fa-circle-exclamation
                                               text-red-500"
                                    ></i>

                                    <p
                                        class="text-sm font-bold
                                               text-red-800"
                                    >
                                        Please check the following:
                                    </p>

                                </div>

                                <ul
                                    class="text-xs text-red-700
                                           space-y-1 pl-5 list-disc"
                                >

                                    @foreach($errors->all() as $error)

                                        <li>
                                            {{ $error }}
                                        </li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        {{-- Enquiry Form --}}
                        <form
                            action="{{ route(
                                'products.enquiry.store',
                                $product->slug
                            ) }}"
                            method="POST"
                            class="space-y-4"
                        >

                            @csrf


                            {{-- Name --}}
                            <div>

                                <label
                                    for="enquiry_name"
                                    class="block text-xs
                                           font-bold text-gray-700
                                           mb-2"
                                >
                                    Your Name
                                    <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">

                                    <span
                                        class="absolute left-3.5 top-1/2
                                               -translate-y-1/2
                                               text-gray-400"
                                    >

                                        <i
                                            class="fas fa-user text-sm"
                                        ></i>

                                    </span>

                                    <input
                                        id="enquiry_name"
                                        type="text"
                                        name="name"
                                        value="{{ old('name') }}"
                                        required
                                        maxlength="100"
                                        placeholder="Enter your name"
                                        class="w-full rounded-xl
                                               border border-gray-200
                                               bg-gray-50
                                               pl-10 pr-4 py-3
                                               text-sm text-gray-900
                                               placeholder-gray-400
                                               outline-none
                                               focus:border-primary
                                               focus:ring-4
                                               focus:ring-primary/10
                                               transition"
                                    >

                                </div>

                            </div>


                            {{-- Email --}}
                            <div>

                                <label
                                    for="enquiry_email"
                                    class="block text-xs
                                           font-bold text-gray-700
                                           mb-2"
                                >
                                    Email Address
                                    <span class="text-red-500">*</span>
                                </label>

                                <div class="relative">

                                    <span
                                        class="absolute left-3.5 top-1/2
                                               -translate-y-1/2
                                               text-gray-400"
                                    >

                                        <i
                                            class="fas fa-envelope text-sm"
                                        ></i>

                                    </span>

                                    <input
                                        id="enquiry_email"
                                        type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        required
                                        maxlength="150"
                                        placeholder="you@example.com"
                                        class="w-full rounded-xl
                                               border border-gray-200
                                               bg-gray-50
                                               pl-10 pr-4 py-3
                                               text-sm text-gray-900
                                               placeholder-gray-400
                                               outline-none
                                               focus:border-primary
                                               focus:ring-4
                                               focus:ring-primary/10
                                               transition"
                                    >

                                </div>

                            </div>


                            {{-- Phone --}}
                            <div>

                                <label
                                    for="enquiry_phone"
                                    class="block text-xs
                                           font-bold text-gray-700
                                           mb-2"
                                >
                                    Phone Number
                                    <span class="text-gray-400 font-normal">
                                        (Optional)
                                    </span>
                                </label>

                                <div class="relative">

                                    <span
                                        class="absolute left-3.5 top-1/2
                                               -translate-y-1/2
                                               text-gray-400"
                                    >

                                        <i
                                            class="fas fa-phone text-sm"
                                        ></i>

                                    </span>

                                    <input
                                        id="enquiry_phone"
                                        type="tel"
                                        name="phone"
                                        value="{{ old('phone') }}"
                                        maxlength="30"
                                        placeholder="Enter phone number"
                                        class="w-full rounded-xl
                                               border border-gray-200
                                               bg-gray-50
                                               pl-10 pr-4 py-3
                                               text-sm text-gray-900
                                               placeholder-gray-400
                                               outline-none
                                               focus:border-primary
                                               focus:ring-4
                                               focus:ring-primary/10
                                               transition"
                                    >

                                </div>

                            </div>


                            {{-- Message --}}
                            <div>

                                <div
                                    class="flex items-center
                                           justify-between mb-2"
                                >

                                    <label
                                        for="enquiry_message"
                                        class="block text-xs
                                               font-bold text-gray-700"
                                    >
                                        Your Message
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <span
                                        id="enquiryMessageCount"
                                        class="text-[11px]
                                               text-gray-400"
                                    >
                                        0 / 2000
                                    </span>

                                </div>

                                <textarea
                                    id="enquiry_message"
                                    name="message"
                                    rows="6"
                                    required
                                    maxlength="2000"
                                    placeholder="Ask about price, availability, specifications, delivery, customization or anything else..."
                                    class="w-full rounded-xl
                                           border border-gray-200
                                           bg-gray-50
                                           px-4 py-3
                                           text-sm text-gray-900
                                           placeholder-gray-400
                                           outline-none resize-none
                                           focus:border-primary
                                           focus:ring-4
                                           focus:ring-primary/10
                                           transition"
                                >{{ old('message') }}</textarea>

                            </div>


                            {{-- Submit --}}
                            <button
                                type="submit"
                                class="w-full inline-flex
                                       items-center justify-center
                                       gap-2 px-5 py-3.5
                                       rounded-xl
                                       bg-primary text-white
                                       font-bold text-sm
                                       shadow-lg shadow-primary/20
                                       hover:opacity-90
                                       active:scale-[.98]
                                       transition"
                            >

                                <i class="fas fa-paper-plane"></i>

                                Send Product Enquiry

                            </button>


                            {{-- Privacy Note --}}
                            <div
                                class="flex items-start gap-2
                                       pt-1 text-[11px]
                                       text-gray-400 leading-5"
                            >

                                <i class="fas fa-lock mt-0.5"></i>

                                <span>
                                    Your information will be shared with the listed
                                    business only for responding to your enquiry.
                                </span>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>



        {{-- =====================================================
            BUSINESS PANEL
        ====================================================== --}}

        <div
            class="product-tab-panel hidden"
            data-panel="business"
        >

            <div class="max-w-4xl mx-auto">

                <div
                    class="bg-white rounded-3xl
                           border border-gray-100
                           shadow-sm overflow-hidden"
                >

                    <div class="h-2 bg-primary"></div>

                    <div class="p-6 sm:p-8">

                        <div
                            class="flex flex-col sm:flex-row
                                   sm:items-center gap-5"
                        >

                            {{-- Logo --}}
                            <div
                                class="w-24 h-24 rounded-3xl
                                       overflow-hidden
                                       bg-gray-100 shrink-0"
                            >

                                @if($business->logo)

                                    <img
                                        src="{{ asset(
                                            'storage/' . $business->logo
                                        ) }}"
                                        alt="{{ $business->name }}"
                                        class="w-full h-full object-cover"
                                    >

                                @else

                                    <div
                                        class="w-full h-full
                                               flex items-center
                                               justify-center"
                                    >

                                        <i
                                            class="fas fa-store
                                                   text-gray-300
                                                   text-3xl"
                                        ></i>

                                    </div>

                                @endif

                            </div>


                            <div class="flex-1 min-w-0">

                                <p
                                    class="text-xs font-bold
                                           uppercase tracking-wider
                                           text-primary mb-1"
                                >
                                    Listed Business
                                </p>

                                <h2
                                    class="text-2xl sm:text-3xl
                                           font-extrabold
                                           text-gray-900"
                                >
                                    {{ $business->name }}
                                </h2>


                                @if($business->rating)

                                    <div
                                        class="flex items-center gap-2
                                               mt-2"
                                    >

                                        <span class="text-amber-500">
                                            <i class="fas fa-star"></i>
                                        </span>

                                        <span
                                            class="font-semibold
                                                   text-gray-700"
                                        >
                                            {{ number_format(
                                                (float) $business->rating,
                                                1
                                            ) }}
                                        </span>

                                        @if($business->reviews_count)

                                            <span
                                                class="text-sm
                                                       text-gray-400"
                                            >
                                                ({{ $business->reviews_count }})
                                            </span>

                                        @endif

                                    </div>

                                @endif

                            </div>

                        </div>


                        {{-- Location --}}
                        @if($business->address || $business->city)

                            <div
                                class="mt-7 pt-7
                                       border-t border-gray-100"
                            >

                                <div class="flex items-start gap-4">

                                    <div
                                        class="w-11 h-11 rounded-xl
                                               bg-primary/10
                                               flex items-center
                                               justify-center
                                               shrink-0"
                                    >

                                        <i
                                            class="fas fa-location-dot
                                                   text-primary"
                                        ></i>

                                    </div>

                                    <div>

                                        <p
                                            class="text-xs text-gray-400
                                                   uppercase tracking-wider"
                                        >
                                            Business Location
                                        </p>

                                        <p
                                            class="text-sm text-gray-600
                                                   leading-6 mt-1"
                                        >

                                            @if($business->address)
                                                {{ $business->address }}
                                            @endif

                                            @if($business->city)
                                                {{ $business->city->name }}
                                            @endif

                                            @if($business->state)
                                                , {{ $business->state->name }}
                                            @endif

                                        </p>

                                    </div>

                                </div>

                            </div>

                        @endif


                        <a
                            href="{{ route(
                                'businesses.show',
                                $business->slug
                            ) }}"
                            class="mt-7 w-full
                                   inline-flex items-center
                                   justify-center gap-2
                                   px-6 py-3.5 rounded-xl
                                   bg-gray-900 text-white
                                   font-bold
                                   hover:bg-primary
                                   transition"
                        >

                            View Full Business Profile

                            <i class="fas fa-arrow-right"></i>

                        </a>

                    </div>

                </div>

            </div>

        </div>



        {{-- =====================================================
            CONTACT PANEL
        ====================================================== --}}

        <div
            class="product-tab-panel hidden"
            data-panel="contact"
        >

            <div class="max-w-3xl mx-auto">

                <div
                    class="bg-white rounded-3xl
                           border border-gray-100
                           shadow-sm p-6 sm:p-8"
                >

                    <div
                        class="flex items-center gap-3 mb-6"
                    >

                        <div
                            class="w-11 h-11 rounded-xl
                                   bg-primary/10
                                   flex items-center justify-center"
                        >

                            <i
                                class="fas fa-comments
                                       text-primary"
                            ></i>

                        </div>

                        <div>

                            <p
                                class="text-xs text-primary
                                       font-bold uppercase
                                       tracking-wider"
                            >
                                Interested?
                            </p>

                            <h2
                                class="font-bold text-gray-900
                                       text-2xl"
                            >
                                Contact Business
                            </h2>

                        </div>

                    </div>


                    <p
                        class="text-sm text-gray-500
                               leading-6 mb-6"
                    >
                        Contact the business directly to ask about
                        pricing, availability, specifications or
                        other product details.
                    </p>


                    <div class="grid sm:grid-cols-2 gap-4">

                        @if($business->phone)

                            <a
                                href="tel:{{ $business->phone }}"
                                class="group flex items-center gap-3
                                       p-4 rounded-2xl
                                       border border-gray-100
                                       hover:border-primary/30
                                       hover:bg-primary/5
                                       transition"
                            >

                                <span
                                    class="w-11 h-11 rounded-xl
                                           bg-green-50
                                           flex items-center
                                           justify-center"
                                >

                                    <i
                                        class="fas fa-phone
                                               text-green-600"
                                    ></i>

                                </span>

                                <span>

                                    <span
                                        class="block text-xs
                                               text-gray-400"
                                    >
                                        Phone
                                    </span>

                                    <span
                                        class="block text-sm
                                               font-bold text-gray-700
                                               mt-0.5"
                                    >
                                        Call Business
                                    </span>

                                </span>

                                <i
                                    class="fas fa-chevron-right
                                           ml-auto text-xs
                                           text-gray-300
                                           group-hover:text-primary"
                                ></i>

                            </a>

                        @endif


                        @if($business->email)

                            <a
                                href="mailto:{{ $business->email }}"
                                class="group flex items-center gap-3
                                       p-4 rounded-2xl
                                       border border-gray-100
                                       hover:border-primary/30
                                       hover:bg-primary/5
                                       transition"
                            >

                                <span
                                    class="w-11 h-11 rounded-xl
                                           bg-blue-50
                                           flex items-center
                                           justify-center"
                                >

                                    <i
                                        class="fas fa-envelope
                                               text-blue-600"
                                    ></i>

                                </span>

                                <span>

                                    <span
                                        class="block text-xs
                                               text-gray-400"
                                    >
                                        Email
                                    </span>

                                    <span
                                        class="block text-sm
                                               font-bold text-gray-700
                                               mt-0.5"
                                    >
                                        Send Email
                                    </span>

                                </span>

                                <i
                                    class="fas fa-chevron-right
                                           ml-auto text-xs
                                           text-gray-300
                                           group-hover:text-primary"
                                ></i>

                            </a>

                        @endif


                        @if($business->website)

                            <a
                                href="{{ $business->website }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="group flex items-center gap-3
                                       p-4 rounded-2xl
                                       border border-gray-100
                                       hover:border-primary/30
                                       hover:bg-primary/5
                                       transition"
                            >

                                <span
                                    class="w-11 h-11 rounded-xl
                                           bg-purple-50
                                           flex items-center
                                           justify-center"
                                >

                                    <i
                                        class="fas fa-globe
                                               text-purple-600"
                                    ></i>

                                </span>

                                <span>

                                    <span
                                        class="block text-xs
                                               text-gray-400"
                                    >
                                        Website
                                    </span>

                                    <span
                                        class="block text-sm
                                               font-bold text-gray-700
                                               mt-0.5"
                                    >
                                        Visit Website
                                    </span>

                                </span>

                                <i
                                    class="fas fa-external-link-alt
                                           ml-auto text-xs
                                           text-gray-300
                                           group-hover:text-primary"
                                ></i>

                            </a>

                        @endif


                        <button
                            type="button"
                            onclick="shareProduct()"
                            class="group flex items-center gap-3
                                   p-4 rounded-2xl
                                   border border-gray-100
                                   hover:border-primary/30
                                   hover:bg-primary/5
                                   transition text-left"
                        >

                            <span
                                class="w-11 h-11 rounded-xl
                                       bg-orange-50
                                       flex items-center
                                       justify-center"
                            >

                                <i
                                    class="fas fa-share-nodes
                                           text-orange-600"
                                ></i>

                            </span>

                            <span>

                                <span
                                    class="block text-xs
                                           text-gray-400"
                                >
                                    Product
                                </span>

                                <span
                                    class="block text-sm
                                           font-bold text-gray-700
                                           mt-0.5"
                                >
                                    Share Product
                                </span>

                            </span>

                            <i
                                class="fas fa-chevron-right
                                       ml-auto text-xs
                                       text-gray-300
                                       group-hover:text-primary"
                            ></i>

                        </button>

                    </div>


                    {{-- Enquiry Shortcut --}}
                    <div
                        class="mt-7 p-5 rounded-2xl
                               bg-primary/5
                               border border-primary/10"
                    >

                        <div
                            class="flex flex-col sm:flex-row
                                   sm:items-center
                                   justify-between gap-4"
                        >

                            <div>

                                <h3
                                    class="font-bold text-gray-900"
                                >
                                    Have a product question?
                                </h3>

                                <p
                                    class="text-sm text-gray-500
                                           mt-1"
                                >
                                    Send a detailed enquiry to
                                    {{ $business->name }}.
                                </p>

                            </div>


                            <button
                                type="button"
                                onclick="showProductTab('enquiry')"
                                class="shrink-0 inline-flex
                                       items-center justify-center
                                       gap-2 px-5 py-3 rounded-xl
                                       bg-primary text-white
                                       font-bold text-sm
                                       hover:opacity-90
                                       transition"
                            >

                                <i class="fas fa-paper-plane"></i>

                                Send Enquiry

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
    GALLERY LIGHTBOX
========================================================= --}}

<div
    id="productGalleryModal"
    class="fixed inset-0 z-[100]
           hidden items-center justify-center
           bg-black/90 p-4"
    onclick="closeGalleryImage()"
>

    <button
        type="button"
        onclick="closeGalleryImage()"
        class="absolute top-5 right-5
               w-11 h-11 rounded-xl
               bg-white/10 text-white
               hover:bg-white/20
               flex items-center justify-center
               transition"
    >

        <i class="fas fa-times"></i>

    </button>


    <img
        id="galleryPreviewImage"
        src=""
        alt="{{ $product->name }}"
        class="max-w-full max-h-[90vh]
               object-contain rounded-2xl shadow-2xl"
        onclick="event.stopPropagation()"
    >

</div>



{{-- =========================================================
    BOTTOM CTA
========================================================= --}}

<section class="relative overflow-hidden bg-primary">

    <div
        class="absolute inset-0 opacity-10"
        style="
            background-image:
            radial-gradient(circle at 20% 20%, white 1px, transparent 1px);
            background-size: 24px 24px;
        "
    ></div>

    <div
        class="relative max-w-5xl mx-auto px-4 sm:px-6
               lg:px-8 py-14 text-center"
    >

        <span
            class="inline-flex items-center gap-2
                   px-3 py-1.5 rounded-full
                   bg-white/10 text-white
                   text-xs font-bold uppercase
                   tracking-wider"
        >

            <i class="fas fa-store"></i>

            {{ $business->name }}

        </span>


        <h2
            class="mt-5 text-3xl sm:text-4xl
                   font-extrabold text-white"
        >
            Interested in this product?
        </h2>


        <p
            class="mt-3 text-white/75 max-w-2xl
                   mx-auto leading-7"
        >
            Get in touch with
            <strong>{{ $business->name }}</strong>
            for pricing, availability and more information.
        </p>


        <div
            class="flex flex-col sm:flex-row
                   justify-center gap-3 mt-7"
        >

            @if($business->phone)

                <a
                    href="tel:{{ $business->phone }}"
                    class="inline-flex items-center
                           justify-center gap-2
                           px-6 py-3.5 rounded-xl
                           bg-white text-primary
                           font-bold hover:bg-gray-100
                           transition shadow-lg"
                >

                    <i class="fas fa-phone"></i>

                    Call Now

                </a>

            @endif


            <a
                href="{{ route(
                    'businesses.show',
                    $business->slug
                ) }}"
                class="inline-flex items-center
                       justify-center gap-2
                       px-6 py-3.5 rounded-xl
                       border border-white/30
                       bg-white/10 text-white
                       font-bold hover:bg-white/20
                       transition"
            >

                View Business

                <i class="fas fa-arrow-right"></i>

            </a>

        </div>

    </div>

</section>



{{-- =========================================================
    PRODUCT NAVIGATION + IMAGE + SHARE JAVASCRIPT
========================================================= --}}

<script>

    /*
    |--------------------------------------------------------------------------
    | PRODUCT TABS
    |--------------------------------------------------------------------------
    */

    function showProductTab(tabName) {

        const panels =
            document.querySelectorAll('.product-tab-panel');

        const tabs =
            document.querySelectorAll('.product-tab');


        panels.forEach(function(panel) {

            panel.classList.add('hidden');

        });


        tabs.forEach(function(tab) {

            tab.classList.remove('active');

        });


        const activePanel =
            document.querySelector(
                '.product-tab-panel[data-panel="' + tabName + '"]'
            );


        const activeTab =
            document.querySelector(
                '.product-tab[data-tab="' + tabName + '"]'
            );


        if (activePanel) {

            activePanel.classList.remove('hidden');

        }


        if (activeTab) {

            activeTab.classList.add('active');

        }

    }



    /*
    |--------------------------------------------------------------------------
    | PRODUCT IMAGE
    |--------------------------------------------------------------------------
    */

    function changeProductImage(imageUrl, button) {

        const mainImage =
            document.getElementById('mainProductImage');


        if (!mainImage) {
            return;
        }


        mainImage.style.opacity = '0.35';


        setTimeout(() => {

            mainImage.src = imageUrl;


            mainImage.onload = () => {

                mainImage.style.opacity = '1';

            };


        }, 120);


        document
            .querySelectorAll('.product-thumb')
            .forEach((thumb) => {

                thumb.classList.remove('border-primary');

                thumb.classList.add('border-transparent');

            });


        if (button) {

            button.classList.remove('border-transparent');

            button.classList.add('border-primary');

        }

    }



    /*
    |--------------------------------------------------------------------------
    | GALLERY LIGHTBOX
    |--------------------------------------------------------------------------
    */

    function openGalleryImage(imageUrl) {

        const modal =
            document.getElementById('productGalleryModal');

        const image =
            document.getElementById('galleryPreviewImage');


        if (!modal || !image) {
            return;
        }


        image.src = imageUrl;

        modal.classList.remove('hidden');

        modal.classList.add('flex');


        document.body.classList.add('overflow-hidden');

    }



    function closeGalleryImage() {

        const modal =
            document.getElementById('productGalleryModal');


        if (!modal) {
            return;
        }


        modal.classList.add('hidden');

        modal.classList.remove('flex');


        document.body.classList.remove('overflow-hidden');

    }



    /*
    |--------------------------------------------------------------------------
    | SHARE PRODUCT
    |--------------------------------------------------------------------------
    */

    function shareProduct() {

        const shareData = {

            title: @json($product->name),

            text: @json(
                'Check out ' . $product->name .
                ' from ' . $business->name
            ),

            url: window.location.href

        };


        if (navigator.share) {

            navigator.share(shareData)
                .catch(() => {});

            return;

        }


        if (navigator.clipboard) {

            navigator.clipboard
                .writeText(window.location.href)
                .then(() => {

                    alert(
                        'Product link copied successfully.'
                    );

                })
                .catch(() => {

                    alert(
                        'Unable to copy product link.'
                    );

                });

            return;

        }


        alert(window.location.href);

    }



    /*
    |--------------------------------------------------------------------------
    | MESSAGE COUNTER
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const messageField =
                document.getElementById(
                    'enquiry_message'
                );


            const messageCount =
                document.getElementById(
                    'enquiryMessageCount'
                );


            if (!messageField || !messageCount) {
                return;
            }


            function updateMessageCount() {

                messageCount.textContent =
                    messageField.value.length +
                    ' / 2000';

            }


            messageField.addEventListener(
                'input',
                updateMessageCount
            );


            updateMessageCount();


            /*
            |--------------------------------------------------------------------------
            | Default Product Tab
            |--------------------------------------------------------------------------
            */

            showProductTab('overview');

        }
    );



    /*
    |--------------------------------------------------------------------------
    | ESC KEY - CLOSE GALLERY
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key === 'Escape') {

                closeGalleryImage();

            }

        }
    );

</script>



{{-- =========================================================
    PREMIUM RESPONSIVE CSS
========================================================= --}}

<style>

    /*
    |--------------------------------------------------------------------------
    | Main Product Image
    |--------------------------------------------------------------------------
    */

    #mainProductImage {

        transition: opacity .2s ease;

    }


    /*
    |--------------------------------------------------------------------------
    | Hide Scrollbar
    |--------------------------------------------------------------------------
    */

    .scrollbar-hide {

        scrollbar-width: none;
        -ms-overflow-style: none;

    }


    .scrollbar-hide::-webkit-scrollbar {

        display: none;

    }


    /*
    |--------------------------------------------------------------------------
    | Product Navigation
    |--------------------------------------------------------------------------
    */

    .product-navigation {

        min-height: 70px;

    }


    .product-tab {

        position: relative;

        flex-shrink: 0;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 9px;

        min-height: 70px;

        padding: 0 17px;

        color: #6b7280;

        font-size: 14px;

        font-weight: 600;

        white-space: nowrap;

        border: 0;

        background: transparent;

        cursor: pointer;

        transition:
            color .2s ease,
            background-color .2s ease;

    }


    .product-tab i {

        font-size: 13px;

        transition: color .2s ease;

    }


    .product-tab:hover {

        color: #111827;

        background: rgba(249, 250, 251, .8);

    }


    .product-tab.active {

        color: var(--primary-color, #fc3c3c);

    }


    .product-tab.active::after {

        content: "";

        position: absolute;

        left: 12px;

        right: 12px;

        bottom: 0;

        height: 3px;

        border-radius: 999px 999px 0 0;

        background: var(
            --primary-color,
            #fc3c3c
        );

    }


    .product-tab-count {

        display: inline-flex;

        align-items: center;

        justify-content: center;

        min-width: 23px;

        height: 22px;

        padding: 0 6px;

        border-radius: 999px;

        background: #fef2f2;

        color: #fc3c3c;

        font-size: 11px;

        font-weight: 700;

    }


    /*
    |--------------------------------------------------------------------------
    | Tab Panel
    |--------------------------------------------------------------------------
    */

    .product-tab-panel {

        animation: productPanelFade .18s ease;

    }


    @keyframes productPanelFade {

        from {

            opacity: 0;

            transform: translateY(3px);

        }

        to {

            opacity: 1;

            transform: translateY(0);

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Mobile
    |--------------------------------------------------------------------------
    */

    @media (max-width: 640px) {

        #productMainImage {

            border-radius: 0;

        }


        .product-navigation {

            min-height: 62px;

        }


        .product-tab {

            min-height: 62px;

            padding: 0 13px;

            font-size: 13px;

            gap: 7px;

        }


        .product-tab.active::after {

            left: 8px;

            right: 8px;

        }

    }

</style>

@endsection