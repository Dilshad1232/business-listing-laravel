@extends('layouts.main')

@section('title', $subcategory->meta_title ?: $subcategory->name . ' | Lokora')

@section('description', $subcategory->meta_description ?: ($subcategory->short_description ?: 'Explore ' . $subcategory->name . ' on Lokora.'))

@section('content')

{{-- =========================================================
    PAGE HEADER
========================================================= --}}
<section class="bg-dark-900 relative overflow-hidden py-16 lg:py-20">

    <div class="bg-grid-dark absolute inset-0"></div>

    <div class="absolute top-0 right-1/4 w-80 h-80 bg-primary/10 rounded-full blur-3xl"></div>

    <div class="absolute bottom-0 left-1/4 w-72 h-72 bg-primary/5 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        <div class="text-center" data-aos="fade-up">

            {{-- SUBCATEGORY ICON --}}
            <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-primary/10 border border-primary/20 flex items-center justify-center">

                <i
                    class="{{ $subcategory->icon ?: 'fas fa-tags' }} text-2xl text-primary"
                ></i>

            </div>

            {{-- SUBCATEGORY NAME --}}
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                {{ $subcategory->name }}
            </h1>

            {{-- DESCRIPTION --}}
            @if($subcategory->short_description)

                <p class="text-dark-300 max-w-2xl mx-auto mb-6">
                    {{ $subcategory->short_description }}
                </p>

            @else

                <p class="text-dark-300 max-w-2xl mx-auto mb-6">
                    Discover businesses and services in {{ $subcategory->name }}.
                </p>

            @endif

            {{-- BREADCRUMB --}}
            <nav class="flex flex-wrap items-center justify-center gap-2 text-sm">

                <a
                    href="{{ url('/') }}"
                    class="text-dark-300 hover:text-primary transition-colors"
                >
                    Home
                </a>

                <i class="fas fa-chevron-right text-xs text-dark-500"></i>

                <a
                    href="{{ route('categories.index') }}"
                    class="text-dark-300 hover:text-primary transition-colors"
                >
                    Categories
                </a>

                <i class="fas fa-chevron-right text-xs text-dark-500"></i>

                <a
                    href="{{ route('categories.show', $category->slug) }}"
                    class="text-dark-300 hover:text-primary transition-colors"
                >
                    {{ $category->name }}
                </a>

                <i class="fas fa-chevron-right text-xs text-dark-500"></i>

                <span class="text-primary">
                    {{ $subcategory->name }}
                </span>

            </nav>

        </div>

    </div>

</section>


{{-- =========================================================
    SUBCATEGORY INTRO
========================================================= --}}
<section class="py-16 lg:py-20 bg-dark-50 relative overflow-hidden">

    <div class="bg-grid absolute inset-0"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        {{-- INTRO CARD --}}
        <div
            class="bg-white rounded-3xl border border-gray-100 p-6 sm:p-8 lg:p-10 mb-12"
            data-aos="fade-up"
        >

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">

                <div class="max-w-3xl">

                    <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
                        {{ $category->name }}
                    </span>

                    <h2 class="text-2xl sm:text-3xl font-bold text-dark-900 mb-4">
                        Explore {{ $subcategory->name }}
                    </h2>

                    @if($subcategory->description)

                        <p class="text-dark-400 leading-relaxed">
                            {{ $subcategory->description }}
                        </p>

                    @else

                        <p class="text-dark-400 leading-relaxed">
                            Find trusted businesses and services related to
                            {{ $subcategory->name }}. Explore available listings,
                            compare options and discover the right place for you.
                        </p>

                    @endif

                </div>

                {{-- CATEGORY LINK --}}
                <div class="flex-shrink-0">

                    <a
                        href="{{ route('categories.show', $category->slug) }}"
                        class="inline-flex items-center gap-2 px-5 py-3 bg-dark-900 hover:bg-primary text-white font-medium rounded-xl transition-all"
                    >

                        <i class="fas fa-arrow-left text-xs"></i>

                        Back to {{ $category->name }}

                    </a>

                </div>

            </div>

        </div>


        {{-- =====================================================
            BUSINESS LISTINGS HEADING
        ====================================================== --}}
        <div
            class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-8"
            data-aos="fade-up"
        >

            <div>

                <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
                    Business Listings
                </span>

                <h2 class="text-3xl sm:text-4xl font-bold text-dark-900">
                    Find Businesses
                </h2>

                <p class="text-dark-400 mt-3 max-w-xl">
                    Discover businesses and services available under
                    {{ $subcategory->name }}.
                </p>

            </div>

            {{-- RESULT COUNT --}}
            <div class="flex items-center gap-2 text-sm text-dark-400">

                <span class="w-9 h-9 rounded-xl bg-primary/10 flex items-center justify-center">

                    <i class="fas fa-store text-primary text-sm"></i>

                </span>

                <span>
                    Explore Listings
                </span>

            </div>

        </div>


        {{-- =====================================================
            BUSINESS LISTINGS
        ====================================================== --}}

        @if($listings->count())

            <div
                class="grid md:grid-cols-2 lg:grid-cols-3 gap-6"
                data-aos="fade-up"
            >

                @foreach($listings as $listing)

                    <div
                        class="group bg-white rounded-2xl border border-gray-100
                        overflow-hidden hover:shadow-xl hover:-translate-y-1
                        transition-all duration-300"
                    >

                    {{-- IMAGE --}}
<div class="relative h-56 overflow-hidden bg-dark-100">

    {{-- COVER IMAGE --}}
    @if($listing->cover_image)

        <img
            src="{{ asset('storage/' . $listing->cover_image) }}"
            alt="{{ $listing->name }}"
            class="w-full h-full object-cover
            group-hover:scale-105 transition-transform duration-500"
        >

    @else

        <div
            class="w-full h-full flex items-center justify-center"
        >

            <i class="fas fa-store text-5xl text-dark-300"></i>

        </div>

    @endif


    {{-- STATUS --}}
    <div class="absolute top-4 left-4">

        @if($listing->status === 'approved')

            <span
                class="inline-flex items-center gap-1.5
                px-3 py-1.5 bg-green-500 text-white
                text-xs font-semibold rounded-lg shadow-sm"
            >

                <i class="fas fa-circle text-[6px]"></i>

                Open

            </span>

        @else

            <span
                class="inline-flex items-center gap-1.5
                px-3 py-1.5 bg-red-500 text-white
                text-xs font-semibold rounded-lg shadow-sm"
            >

                <i class="fas fa-circle text-[6px]"></i>

                Closed

            </span>

        @endif

    </div>


    {{-- FEATURED --}}
    @if($listing->is_featured)

        <div class="absolute top-4 right-4">

            <span
                class="inline-flex items-center gap-1
                px-3 py-1.5 bg-primary text-white
                text-xs font-semibold rounded-lg shadow-sm"
            >

                <i class="fas fa-star text-[10px]"></i>

                Featured

            </span>

        </div>

    @endif


    {{-- LOGO --}}
    <div class="absolute left-5 bottom-0 translate-y-1/2 z-10">

        @if($listing->logo)

            <div
                class="w-16 h-16 bg-white rounded-xl p-1.5
                shadow-lg border border-gray-100"
            >

                <img
                    src="{{ asset('storage/' . $listing->logo) }}"
                    alt="{{ $listing->name }} Logo"
                    class="w-full h-full object-contain rounded-lg"
                >

            </div>

        @else

            <div
                class="w-16 h-16 bg-white rounded-xl
                shadow-lg border border-gray-100
                flex items-center justify-center"
            >

                <i class="fas fa-building text-xl text-dark-300"></i>

            </div>

        @endif

    </div>

</div>


                        {{-- CONTENT --}}
                        <div class="p-5">

                            {{-- CATEGORY --}}
                            <div class="flex items-center gap-2 mb-2">

                                <span
                                    class="w-8 h-8 rounded-lg bg-primary/10
                                    flex items-center justify-center"
                                >

                                    <i
                                        class="{{ $listing->category?->icon ?? 'fas fa-store' }}
                                        text-primary text-xs"
                                    ></i>

                                </span>

                                <span class="text-xs font-medium text-dark-400">

                                    {{ $listing->category?->name ?? 'Business' }}

                                </span>

                            </div>


                            {{-- BUSINESS NAME --}}
                            <h3
                                class="text-lg font-bold text-dark-900
                                group-hover:text-primary transition-colors
                                line-clamp-1"
                            >

                                {{ $listing->name }}

                            </h3>


                            {{-- SUBCATEGORY --}}
                            @if($listing->subcategory)

                                <p class="text-xs text-primary mt-1">

                                    {{ $listing->subcategory->name }}

                                </p>

                            @endif


                            {{-- DESCRIPTION --}}
                            @if($listing->short_description)

                                <p
                                    class="text-sm text-dark-400
                                    mt-3 line-clamp-2 leading-6"
                                >

                                    {{ $listing->short_description }}

                                </p>

                            @endif


                            {{-- RATING + LOCATION --}}
                            <div
                                class="flex items-center justify-between
                                mt-4 pt-4 border-t border-gray-100"
                            >

                                {{-- RATING --}}
                                <div class="flex items-center gap-1.5">

                                    <i class="fas fa-star text-amber-400 text-xs"></i>

                                    <span class="text-sm font-semibold text-dark-900">

                                        {{ number_format((float) $listing->rating, 1) }}

                                    </span>

                                </div>


                                {{-- LOCATION --}}
                                @if($listing->city)

                                    <span
                                        class="text-xs text-dark-400
                                        flex items-center gap-1"
                                    >

                                        <i class="fas fa-map-marker-alt text-primary"></i>

                                        {{ $listing->city?->name }}

                                    </span>

                                @endif

                            </div>


                            {{-- VIEW BUTTON --}}
                            <div class="mt-5">

                                <a
                                    href="{{ route('businesses.show', [
                                        'business' => $listing->slug
                                    ]) }}"
                                    class="w-full inline-flex items-center
                                    justify-center gap-2 px-5 py-3
                                    bg-dark-900 hover:bg-primary text-white
                                    text-sm font-semibold rounded-xl
                                    transition-all"
                                >

                                    View Business

                                    <i class="fas fa-arrow-right text-xs"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- PAGINATION --}}
            @if($listings->hasPages())

                <div class="mt-10">

                    {{ $listings->links() }}

                </div>

            @endif

        @else

            {{-- =====================================================
                EMPTY STATE
            ====================================================== --}}

            <div
                class="bg-white rounded-3xl border border-gray-100
                p-10 sm:p-16 text-center"
                data-aos="fade-up"
            >

                <div
                    class="w-20 h-20 mx-auto rounded-2xl bg-primary/10
                    flex items-center justify-center mb-6"
                >

                    <i class="fas fa-store text-2xl text-primary"></i>

                </div>


                <h3 class="text-xl sm:text-2xl font-semibold text-dark-900 mb-3">

                    Businesses Coming Soon

                </h3>


                <p class="text-dark-400 max-w-lg mx-auto mb-8">

                    We are preparing business listings for

                    <strong class="text-dark-900">
                        {{ $subcategory->name }}
                    </strong>.

                    Check back soon to discover businesses, services and places.

                </p>


                <div
                    class="flex flex-col sm:flex-row items-center
                    justify-center gap-3"
                >

                    <a
                        href="{{ route('categories.show', $category->slug) }}"
                        class="inline-flex items-center gap-2 px-6 py-3
                        bg-primary hover:bg-primary-dark text-white
                        font-semibold rounded-xl transition-all
                        shadow-lg shadow-primary/20"
                    >

                        <i class="fas fa-layer-group text-sm"></i>

                        Browse Category

                    </a>


                    <a
                        href="{{ route('categories.index') }}"
                        class="inline-flex items-center gap-2 px-6 py-3
                        bg-white hover:bg-dark-50 text-dark-700
                        font-semibold rounded-xl border border-gray-200
                        transition-all"
                    >

                        <i class="fas fa-th-large text-sm"></i>

                        All Categories

                    </a>

                </div>

            </div>

        @endif

    </div>

</section>


{{-- =========================================================
    HOW IT WORKS
========================================================= --}}
<section class="py-16 lg:py-20 bg-white relative overflow-hidden">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div
            class="text-center mb-12"
            data-aos="fade-up"
        >

            <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
                Simple & Easy
            </span>

            <h2 class="text-3xl sm:text-4xl font-bold text-dark-900">
                Find What You Need
            </h2>

            <p class="text-dark-400 mt-3 max-w-xl mx-auto">
                Lokora makes discovering the right business simple.
            </p>

        </div>


        <div class="grid md:grid-cols-3 gap-6">

            {{-- STEP 1 --}}
            <div
                class="group bg-dark-50 rounded-2xl border border-gray-100 p-7 text-center hover:-translate-y-1 hover:shadow-xl transition-all duration-300"
                data-aos="fade-up"
            >

                <div class="w-14 h-14 mx-auto rounded-2xl bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary transition-all">

                    <i class="fas fa-search text-xl text-primary group-hover:text-white transition-colors"></i>

                </div>

                <span class="text-xs font-semibold text-primary uppercase tracking-wider">
                    Step 01
                </span>

                <h3 class="text-lg font-semibold text-dark-900 mt-2 mb-2">
                    Search
                </h3>

                <p class="text-sm text-dark-400">
                    Search for businesses and services based on what you need.
                </p>

            </div>


            {{-- STEP 2 --}}
            <div
                class="group bg-dark-50 rounded-2xl border border-gray-100 p-7 text-center hover:-translate-y-1 hover:shadow-xl transition-all duration-300"
                data-aos="fade-up"
                data-aos-delay="100"
            >

                <div class="w-14 h-14 mx-auto rounded-2xl bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary transition-all">

                    <i class="fas fa-filter text-xl text-primary group-hover:text-white transition-colors"></i>

                </div>

                <span class="text-xs font-semibold text-primary uppercase tracking-wider">
                    Step 02
                </span>

                <h3 class="text-lg font-semibold text-dark-900 mt-2 mb-2">
                    Compare
                </h3>

                <p class="text-sm text-dark-400">
                    Explore different listings and compare the available options.
                </p>

            </div>


            {{-- STEP 3 --}}
            <div
                class="group bg-dark-50 rounded-2xl border border-gray-100 p-7 text-center hover:-translate-y-1 hover:shadow-xl transition-all duration-300"
                data-aos="fade-up"
                data-aos-delay="200"
            >

                <div class="w-14 h-14 mx-auto rounded-2xl bg-primary/10 flex items-center justify-center mb-5 group-hover:bg-primary transition-all">

                    <i class="fas fa-check-circle text-xl text-primary group-hover:text-white transition-colors"></i>

                </div>

                <span class="text-xs font-semibold text-primary uppercase tracking-wider">
                    Step 03
                </span>

                <h3 class="text-lg font-semibold text-dark-900 mt-2 mb-2">
                    Connect
                </h3>

                <p class="text-sm text-dark-400">
                    Choose the right business and connect with them directly.
                </p>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    CTA
========================================================= --}}
<section
    class="relative py-20 overflow-hidden"
    style="background: linear-gradient(135deg, #161c26 0%, #1f2937 100%)"
>

    <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>

    <div class="absolute bottom-0 left-0 w-80 h-80 bg-primary/5 rounded-full blur-3xl"></div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        <div
            class="text-center"
            data-aos="fade-up"
        >

            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/10 text-white/80 text-sm font-medium rounded-full border border-white/10 mb-6">

                <i class="fas fa-compass text-primary"></i>

                Keep Exploring

            </span>


            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-5">
                Discover More on Lokora
            </h2>


            <p class="text-white/60 max-w-2xl mx-auto mb-8">
                Explore more categories and discover businesses, services and places around the world.
            </p>


            <a
                href="{{ route('categories.index') }}"
                class="inline-flex items-center gap-2 px-7 py-3.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition-all shadow-lg shadow-primary/25"
            >

                <i class="fas fa-layer-group"></i>

                Explore Categories

            </a>

        </div>

    </div>

</section>

@endsection
