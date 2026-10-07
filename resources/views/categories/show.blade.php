@extends('layouts.main')

@section('title', $category->name . ' - Explore Businesses & Products')

@section('meta_description', $category->short_description ?? 'Explore businesses, products and services in ' . $category->name)

@section('content')

<!-- ========================================================= -->
<!-- CATEGORY HERO -->
<!-- ========================================================= -->

<section class="relative overflow-hidden bg-dark-900">

    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-primary blur-3xl"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full bg-primary blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20">

        <!-- Breadcrumb -->

        <div class="flex items-center gap-2 text-sm text-dark-400 mb-8">

            <a
                href="{{ url('/') }}"
                class="hover:text-white transition-colors"
            >
                Home
            </a>

            <i class="fas fa-chevron-right text-[10px]"></i>

            <a
                href="{{ route('categories.index') }}"
                class="hover:text-white transition-colors"
            >
                Categories
            </a>

            <i class="fas fa-chevron-right text-[10px]"></i>

            <span class="text-white">
                {{ $category->name }}
            </span>

        </div>


        <!-- Hero Content -->

        <div class="max-w-4xl">

            <div class="flex flex-col sm:flex-row sm:items-center gap-6">

                <!-- Icon -->

                <div class="w-20 h-20 shrink-0 rounded-3xl bg-primary/10 border border-primary/20 flex items-center justify-center">

                    <i class="{{ $category->icon ?: 'fas fa-layer-group' }} text-3xl text-primary"></i>

                </div>


                <!-- Text -->

                <div>

                    <span class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-primary mb-3">

                        <span class="w-6 h-px bg-primary"></span>

                        Category

                    </span>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight">

                        {{ $category->name }}

                    </h1>

                </div>

            </div>


            @if($category->short_description)

                <p class="mt-6 text-lg text-dark-300 leading-relaxed max-w-3xl">

                    {{ $category->short_description }}

                </p>

            @endif


            <!-- Hero Stats -->

            <div class="flex flex-wrap items-center gap-6 mt-8">

                <div class="flex items-center gap-2 text-sm text-dark-300">

                    <i class="fas fa-layer-group text-primary"></i>

                    <span>
                        {{ $category->subcategories->count() }}
                        Subcategories
                    </span>

                </div>

                <div class="flex items-center gap-2 text-sm text-dark-300">

                    <i class="fas fa-store text-primary"></i>

                    <span>
                        {{ $businessCount }}
                        Businesses
                    </span>

                </div>

                <div class="flex items-center gap-2 text-sm text-dark-300">

                    <i class="fas fa-box-open text-primary"></i>

                    <span>
                        {{ $productCount }}
                        Products
                    </span>

                </div>

            </div>

        </div>

    </div>

</section>



<!-- ========================================================= -->
<!-- CATEGORY CONTENT -->
<!-- ========================================================= -->

<section class="py-14 lg:py-20 bg-gray-50">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">


        <!-- ================================================= -->
        <!-- CATEGORY OVERVIEW -->
        <!-- ================================================= -->

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 sm:p-8 lg:p-10 mb-14">

            <div class="grid lg:grid-cols-[1fr_auto] gap-8 items-center">

                <div>

                    <div class="flex items-center gap-3 mb-4">

                        <span class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center">

                            <i class="fas fa-compass text-primary"></i>

                        </span>

                        <h2 class="text-2xl font-bold text-dark-900">

                            Explore {{ $category->name }}

                        </h2>

                    </div>


                    <p class="text-dark-500 leading-relaxed max-w-3xl">

                        {{ $category->description ?: $category->short_description ?: 'Discover trusted businesses, products and services available in this category.' }}

                    </p>

                </div>


                <div class="grid grid-cols-3 gap-3 lg:min-w-[330px]">

                    <div class="text-center p-4 rounded-2xl bg-gray-50">

                        <div class="text-2xl font-bold text-dark-900">

                            {{ $category->subcategories->count() }}

                        </div>

                        <div class="text-xs text-dark-400 mt-1">

                            Subcategories

                        </div>

                    </div>


                    <div class="text-center p-4 rounded-2xl bg-gray-50">

                        <div class="text-2xl font-bold text-dark-900">

                            {{ $businessCount }}

                        </div>

                        <div class="text-xs text-dark-400 mt-1">

                            Businesses

                        </div>

                    </div>


                    <div class="text-center p-4 rounded-2xl bg-gray-50">

                        <div class="text-2xl font-bold text-dark-900">

                            {{ $productCount }}

                        </div>

                        <div class="text-xs text-dark-400 mt-1">

                            Products

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- ================================================= -->
        <!-- SUBCATEGORIES -->
        <!-- ================================================= -->

        <div class="mb-16">

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">

                <div>

                    <span class="text-xs font-semibold uppercase tracking-wider text-primary">

                        Browse by type

                    </span>

                    <h2 class="text-2xl sm:text-3xl font-bold text-dark-900 mt-2">

                        Explore Subcategories

                    </h2>

                    <p class="text-dark-400 mt-2">

                        Find the exact type of business or service you're looking for.

                    </p>

                </div>

            </div>


            @if($category->subcategories->count())

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 lg:gap-6">

                    @foreach($category->subcategories as $subcategory)

                        <div
                            class="group bg-white rounded-2xl border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-primary/20"
                        >

                            <div class="p-6">

                                <div class="flex items-start justify-between mb-6">

                                    <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center group-hover:bg-primary transition-all duration-300">

                                        <i class="{{ $subcategory->icon ?: 'fas fa-tags' }} text-xl text-primary group-hover:text-white transition-colors duration-300"></i>

                                    </div>


                                    <span class="text-xs font-semibold text-dark-300 bg-dark-50 px-2.5 py-1 rounded-lg">

                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}

                                    </span>

                                </div>


                                <h3 class="text-lg font-semibold text-dark-900 group-hover:text-primary transition-colors">

                                    <a
                                        href="{{ route('subcategories.show', [$category->slug, $subcategory->slug]) }}"
                                    >
                                        {{ $subcategory->name }}
                                    </a>

                                </h3>


                                <p class="text-sm text-dark-400 mt-2 line-clamp-3 min-h-[60px]">

                                    {{ $subcategory->short_description ?: 'Discover businesses and services in this subcategory.' }}

                                </p>


                                <div class="flex items-center justify-between mt-6 pt-5 border-t border-gray-100">

                                    <span class="text-xs text-dark-400">

                                        Explore now

                                    </span>


                                    <a
                                        href="{{ route('subcategories.show', [$category->slug, $subcategory->slug]) }}"
                                        class="w-9 h-9 rounded-xl bg-gray-50 flex items-center justify-center text-dark-400 group-hover:bg-primary group-hover:text-white transition-all"
                                    >

                                        <i class="fas fa-arrow-right text-xs"></i>

                                    </a>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="bg-white rounded-2xl border border-gray-100 p-10 text-center">

                    <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-50 flex items-center justify-center mb-4">

                        <i class="fas fa-layer-group text-2xl text-gray-300"></i>

                    </div>

                    <h3 class="text-lg font-semibold text-dark-900">

                        No subcategories yet

                    </h3>

                    <p class="text-sm text-dark-400 mt-2">

                        More options will be added to this category soon.

                    </p>

                </div>

            @endif

        </div>



        <!-- ================================================= -->
        <!-- BUSINESSES -->
        <!-- ================================================= -->

        <div class="mb-16">

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">

                <div>

                    <span class="text-xs font-semibold uppercase tracking-wider text-primary">

                        Discover local businesses

                    </span>

                    <h2 class="text-2xl sm:text-3xl font-bold text-dark-900 mt-2">

                        Featured & Latest Businesses

                    </h2>

                    <p class="text-dark-400 mt-2">

                        Explore approved businesses available in {{ $category->name }}.

                    </p>

                </div>


                @if($businesses->count())

                    <a
                        href="{{ route('businesses.index', ['category' => $category->slug]) }}"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:gap-3 transition-all"
                    >

                        View all businesses

                        <i class="fas fa-arrow-right text-xs"></i>

                    </a>

                @endif

            </div>


            @if($businesses->count())

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 lg:gap-6">

                    @foreach($businesses as $business)

                        <div
                            class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all duration-300"
                        >

                            <!-- Cover -->

                            <div class="relative h-48 bg-dark-50 overflow-hidden">

                                @if($business->cover_image)

                                    <img
                                        src="{{ asset('storage/' . $business->cover_image) }}"
                                        alt="{{ $business->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    >

                                @else

                                    <div class="w-full h-full flex items-center justify-center">

                                        <i class="fas fa-building text-4xl text-dark-200"></i>

                                    </div>

                                @endif


                                @if($business->is_featured)

                                    <span class="absolute top-4 left-4 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-primary text-white text-[11px] font-semibold shadow-lg">

                                        <i class="fas fa-star text-[9px]"></i>

                                        Featured

                                    </span>

                                @endif


                                @if($business->rating)

                                    <div class="absolute top-4 right-4 inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg bg-white/95 backdrop-blur text-xs font-semibold text-dark-800 shadow">

                                        <i class="fas fa-star text-amber-400"></i>

                                        {{ number_format((float) $business->rating, 1) }}

                                    </div>

                                @endif


                                <!-- Logo -->

                                <div class="absolute left-5 bottom-0 translate-y-1/2 z-10">

                                    @if($business->logo)

                                        <div class="w-16 h-16 bg-white rounded-xl p-1.5 shadow-lg border border-gray-100">

                                            <img
                                                src="{{ asset('storage/' . $business->logo) }}"
                                                alt="{{ $business->name }} Logo"
                                                class="w-full h-full object-contain rounded-lg"
                                            >

                                        </div>

                                    @else

                                        <div class="w-16 h-16 bg-white rounded-xl shadow-lg border border-gray-100 flex items-center justify-center">

                                            <i class="fas fa-building text-xl text-primary"></i>

                                        </div>

                                    @endif

                                </div>

                            </div>


                            <!-- Business Content -->

                            <div class="p-5 pt-10">

                                <div class="flex items-center gap-2 text-xs text-dark-400 mb-2">

                                    <i class="{{ $business->category?->icon ?? 'fas fa-store' }}"></i>

                                    <span>

                                        {{ $business->subcategory?->name ?? $business->category?->name ?? 'Business' }}

                                    </span>

                                </div>


                                <h3 class="text-lg font-bold text-dark-900 line-clamp-1 group-hover:text-primary transition-colors">

                                    {{ $business->name }}

                                </h3>


                                @if($business->tagline)

                                    <p class="text-sm text-dark-400 mt-2 line-clamp-2">

                                        {{ $business->tagline }}

                                    </p>

                                @elseif($business->description)

                                    <p class="text-sm text-dark-400 mt-2 line-clamp-2">

                                        {{ \Illuminate\Support\Str::limit(strip_tags($business->description), 90) }}

                                    </p>

                                @endif


                                <div class="flex items-center gap-2 mt-4 text-xs text-dark-400">

                                    <i class="fas fa-location-dot text-primary"></i>

                                    <span class="line-clamp-1">

                                        {{ $business->city?->name ?? $business->state?->name ?? 'Location available' }}

                                    </span>

                                </div>


                                <div class="flex items-center justify-between mt-5 pt-4 border-t border-gray-100">

                                    <span class="text-xs text-dark-400">

                                        {{ $business->reviews_count ?? 0 }} reviews

                                    </span>


                                    <a
                                        href="{{ route('businesses.show', ['business' => $business->slug]) }}"
                                        class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:gap-3 transition-all"
                                    >

                                        View Business

                                        <i class="fas fa-arrow-right text-xs"></i>

                                    </a>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="bg-white rounded-2xl border border-gray-100 p-10 text-center">

                    <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-50 flex items-center justify-center mb-4">

                        <i class="fas fa-store-slash text-2xl text-gray-300"></i>

                    </div>

                    <h3 class="text-lg font-semibold text-dark-900">

                        No businesses available yet

                    </h3>

                    <p class="text-sm text-dark-400 mt-2">

                        Businesses in this category will appear here once approved.

                    </p>

                </div>

            @endif

        </div>



        <!-- ================================================= -->
        <!-- PRODUCTS -->
        <!-- ================================================= -->

        <div class="mb-16">

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">

                <div>

                    <span class="text-xs font-semibold uppercase tracking-wider text-primary">

                        Products & offerings

                    </span>

                    <h2 class="text-2xl sm:text-3xl font-bold text-dark-900 mt-2">

                        Popular Products

                    </h2>

                    <p class="text-dark-400 mt-2">

                        Explore products offered by businesses in this category.

                    </p>

                </div>

            </div>


            @if($products->count())

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 lg:gap-6">

                    @foreach($products as $product)

                        @php
                            $productImage = $product->images->first();
                        @endphp


                        <div
                            class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:-translate-y-1 hover:shadow-xl transition-all duration-300"
                        >

                            <!-- Product Image -->

                            <div class="relative h-52 bg-gray-50 overflow-hidden">

                                @if($productImage && !empty($productImage->image))

                                    <img
                                        src="{{ asset('storage/' . $productImage->image) }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    >

                                @else

                                    <div class="w-full h-full flex items-center justify-center">

                                        <i class="fas fa-box-open text-4xl text-gray-200"></i>

                                    </div>

                                @endif


                                @if($product->is_featured)

                                    <span class="absolute top-4 left-4 inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-primary text-white text-[11px] font-semibold shadow">

                                        <i class="fas fa-star text-[9px]"></i>

                                        Featured

                                    </span>

                                @endif

                            </div>


                            <!-- Product Content -->

                            <div class="p-5">

                                <div class="flex items-center gap-2 text-xs text-dark-400 mb-2">

                                    <i class="fas fa-store text-primary"></i>

                                    <span class="line-clamp-1">

                                        {{ $product->business?->name ?? 'Business' }}

                                    </span>

                                </div>


                                <h3 class="text-lg font-bold text-dark-900 line-clamp-1 group-hover:text-primary transition-colors">

                                    {{ $product->name }}

                                </h3>


                                @if($product->short_description)

                                    <p class="text-sm text-dark-400 mt-2 line-clamp-2 min-h-[40px]">

                                        {{ $product->short_description }}

                                    </p>

                                @endif


                                <!-- Price -->

                                <div class="flex items-center gap-2 mt-4">

                                    @if($product->discount_price)

                                        <span class="text-lg font-bold text-dark-900">

                                            ₹{{ number_format((float) $product->discount_price, 2) }}

                                        </span>

                                        <span class="text-sm text-dark-400 line-through">

                                            ₹{{ number_format((float) $product->price, 2) }}

                                        </span>

                                    @elseif($product->price)

                                        <span class="text-lg font-bold text-dark-900">

                                            ₹{{ number_format((float) $product->price, 2) }}

                                        </span>

                                    @else

                                        <span class="text-sm font-medium text-dark-400">

                                            Contact for price

                                        </span>

                                    @endif

                                </div>


                                <!-- Footer -->

                                <div class="flex items-center justify-between mt-5 pt-4 border-t border-gray-100">

                                    <span class="text-xs text-dark-400">

                                        @if($product->stock > 0)

                                            In stock

                                        @else

                                            Contact seller

                                        @endif

                                    </span>


                                    <a
                                        href="{{ route('products.show', ['product' => $product->slug]) }}"
                                        class="inline-flex items-center gap-2 text-sm font-semibold text-primary hover:gap-3 transition-all"
                                    >

                                        View Product

                                        <i class="fas fa-arrow-right text-xs"></i>

                                    </a>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="bg-white rounded-2xl border border-gray-100 p-10 text-center">

                    <div class="w-16 h-16 mx-auto rounded-2xl bg-gray-50 flex items-center justify-center mb-4">

                        <i class="fas fa-box-open text-2xl text-gray-300"></i>

                    </div>

                    <h3 class="text-lg font-semibold text-dark-900">

                        No products available yet

                    </h3>

                    <p class="text-sm text-dark-400 mt-2">

                        Products from businesses in this category will appear here.

                    </p>

                </div>

            @endif

        </div>



        <!-- ================================================= -->
        <!-- WHY EXPLORE -->
        <!-- ================================================= -->

        <div class="mb-16">

            <div class="text-center max-w-2xl mx-auto mb-10">

                <span class="text-xs font-semibold uppercase tracking-wider text-primary">

                    Discover with confidence

                </span>

                <h2 class="text-2xl sm:text-3xl font-bold text-dark-900 mt-2">

                    Everything You Need in One Place

                </h2>

                <p class="text-dark-400 mt-3">

                    Browse businesses and products while discovering the right options for your needs.

                </p>

            </div>


            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">

                <!-- Card 1 -->

                <div class="bg-white rounded-2xl border border-gray-100 p-6">

                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-5">

                        <i class="fas fa-store text-primary"></i>

                    </div>

                    <h3 class="text-lg font-semibold text-dark-900">

                        Trusted Businesses

                    </h3>

                    <p class="text-sm text-dark-400 mt-2 leading-relaxed">

                        Discover approved businesses and service providers listed in this category.

                    </p>

                </div>


                <!-- Card 2 -->

                <div class="bg-white rounded-2xl border border-gray-100 p-6">

                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-5">

                        <i class="fas fa-box-open text-primary"></i>

                    </div>

                    <h3 class="text-lg font-semibold text-dark-900">

                        Products & Services

                    </h3>

                    <p class="text-sm text-dark-400 mt-2 leading-relaxed">

                        Explore products and offerings from businesses operating within this category.

                    </p>

                </div>


                <!-- Card 3 -->

                <div class="bg-white rounded-2xl border border-gray-100 p-6">

                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-5">

                        <i class="fas fa-location-dot text-primary"></i>

                    </div>

                    <h3 class="text-lg font-semibold text-dark-900">

                        Find Locally

                    </h3>

                    <p class="text-sm text-dark-400 mt-2 leading-relaxed">

                        Discover businesses and offerings available across different locations.

                    </p>

                </div>

            </div>

        </div>



        <!-- ================================================= -->
        <!-- CTA -->
        <!-- ================================================= -->

        <div class="relative overflow-hidden rounded-3xl bg-dark-900">

            <div class="absolute -top-24 -right-24 w-72 h-72 bg-primary/20 rounded-full blur-3xl"></div>

            <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-primary/10 rounded-full blur-3xl"></div>


            <div class="relative p-8 sm:p-10 lg:p-14 text-center">

                <div class="w-14 h-14 mx-auto rounded-2xl bg-primary/10 flex items-center justify-center mb-5">

                    <i class="fas fa-compass text-primary text-xl"></i>

                </div>


                <h2 class="text-2xl sm:text-3xl font-bold text-white">

                    Looking for something specific?

                </h2>


                <p class="text-dark-300 mt-3 max-w-xl mx-auto">

                    Browse businesses and discover products that match what you're looking for.

                </p>


                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-7">

                    <a
                        href="{{ route('businesses.index') }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-primary text-white font-semibold hover:opacity-90 transition"
                    >

                        Explore Businesses

                        <i class="fas fa-arrow-right text-xs"></i>

                    </a>


                    <a
                        href="{{ route('categories.index') }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-white/10 text-white font-semibold hover:bg-white/15 transition"
                    >

                        Browse Categories

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
