@extends('layouts.main')

@section('title', 'Business Listing')

@section('content')

 <!-- ===== HERO SECTION ===== -->

<section class="relative min-h-[100vh] flex items-center justify-center overflow-hidden" id="heroSection">


    <!-- Vegas BG -->
    <div class="vegas-overlay absolute inset-0 z-10 pointer-events-none"></div>

    <!-- Decorative blobs -->
    <div class="absolute top-20 left-10 w-72 h-72 bg-primary/20 rounded-full blur-3xl animate-blob z-0"></div>

    <div class="absolute bottom-20 right-10 w-96 h-96 bg-primary/10 rounded-full blur-3xl animate-blob z-0"
        style="animation-delay: 4s"></div>

    <div class="relative z-20 w-full min-h-[100vh] flex flex-col items-center justify-center px-4 text-center">

{{-- ================= DYNAMIC HERO CONTENT ================= --}}
@php
    $heroSlider = $homeSliders->first();
@endphp

@if ($heroSlider)

    <!-- Badge -->
    <div data-aos="fade-up" data-aos-duration="800">
        <span
            id="hero-badge"
            class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/10 backdrop-blur-sm text-white/90 text-sm font-medium rounded-full border border-white/10 mb-8">
            <span class="w-2 h-2 bg-primary rounded-full animate-pulse"></span>
            {{ $heroSlider->badge }}
        </span>
    </div>

    <!-- Heading -->
    <h1
        class="text-5xl sm:text-6xl lg:text-7xl font-bold text-white leading-tight mb-6"
        data-aos="fade-up"
        data-aos-delay="100"
    >
        <span id="hero-title">{{ $heroSlider->title }}</span><br>

        <span
            id="hero-highlight"
            class="text-gradient"
        >
            {{ $heroSlider->highlight }}
        </span>

        <span
            id="hero-typed"
            class="hero-typed-sync"
        ></span>
    </h1>

    <!-- Description -->
    <p
        id="hero-description"
        class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto mb-10"
        data-aos="fade-up"
        data-aos-delay="200"
    >
        {{ $heroSlider->description }}
    </p>

@endif


        <!-- ================= SEARCH BAR ================= -->
        <div class="w-full max-w-5xl mx-auto"
            data-aos="fade-up"
            data-aos-delay="300">

            <form action="{{ route('businesses.index') }}"
                method="GET"
                class="bg-white/10 backdrop-blur-md rounded-2xl p-3 sm:p-4 shadow-2xl border border-white/20">

                <div class="flex flex-col sm:flex-row gap-3">

                    <!-- KEYWORD -->
                    <div class="flex-1 relative">

                        <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-dark-300"></i>

                        <input type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="What are you looking for?"
                            class="w-full pl-12 pr-4 py-4 bg-white rounded-xl text-dark-900 placeholder:text-dark-300 focus:outline-none focus:ring-2 focus:ring-primary/30 shadow-sm">

                    </div>


                    <!-- LOCATION -->
                    <div class="flex-1 relative">

                        <i
                            class="fas fa-map-marker-alt absolute left-5 top-1/2 -translate-y-1/2 text-dark-300 z-10"></i>

                        <select name="city_id"
                            class="w-full pl-12 pr-4 py-4 bg-white rounded-xl text-dark-900 appearance-none focus:outline-none focus:ring-2 focus:ring-primary/30 shadow-sm">

                            <option value="">All Locations</option>

                            @foreach ($searchLocations as $city)
                                <option value="{{ $city->id }}"
                                    {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>


                    <!-- CATEGORY -->
                    <div class="flex-1 relative">

                        <i class="fas fa-th-list absolute left-5 top-1/2 -translate-y-1/2 text-dark-300 z-10"></i>

                        <select name="category_id"
                            class="w-full pl-12 pr-4 py-4 bg-white rounded-xl text-dark-900 appearance-none focus:outline-none focus:ring-2 focus:ring-primary/30 shadow-sm">

                            <option value="">All Categories</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>


                    <!-- SEARCH BUTTON -->
                    <button type="submit"
                        class="px-10 py-4 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition-colors shadow-lg shadow-primary/25 whitespace-nowrap text-base">

                        <i class="fas fa-search mr-2"></i>
                        Search

                    </button>

                </div>

            </form>

        </div>


        <!-- ================= QUICK CATEGORIES ================= -->
        <div class="flex flex-wrap items-center justify-center gap-3 mt-10"
            data-aos="fade-up"
            data-aos-delay="400">

            <span class="text-white/70 text-sm font-medium mr-1">
                Popular:
            </span>


            @forelse($categories->take(4) as $category)

                <a href="{{ route('businesses.index', ['category_id' => $category->id]) }}"
                    class="group flex items-center gap-2 px-5 py-2.5 bg-white/15 backdrop-blur-sm hover:bg-white/25 text-white text-sm font-medium rounded-full border border-white/25 hover:border-white/40 transition-all shadow-lg shadow-black/10">

                    @if (!empty($category->icon))

                        <i class="{{ $category->icon }} text-xs text-primary"></i>

                    @else

                        <i class="fas fa-building text-xs text-primary"></i>

                    @endif

                    {{ $category->name }}

                </a>

            @empty

                <span class="text-white/60 text-sm">
                    Explore businesses
                </span>

            @endforelse

        </div>

    </div>


    <!-- Scroll indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-20 animate-bounce">

        <div class="w-6 h-10 border-2 border-white/30 rounded-full flex justify-center pt-2">

            <div class="w-1 h-2 bg-white/60 rounded-full"></div>

        </div>

    </div>


    </section>


    <!-- CATEGORIES CAROUSEL -->
    <section class="py-20 lg:py-28 bg-white relative overflow-hidden">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Heading -->
            <div class="flex flex-col md:flex-row md:items-end md:justify-between mb-12" data-aos="fade-up">

                <div>
                    <span class="inline-block text-primary text-sm font-semibold uppercase tracking-wider mb-3">
                        Explore Categories
                    </span>

                    <h2 class="text-3xl lg:text-4xl font-bold text-dark-900">
                        Browse by Category
                    </h2>

                    <p class="text-dark-400 mt-3 max-w-xl">
                        Discover businesses and services from different categories.
                    </p>
                </div>

                <a href="{{ route('categories.index') }}"
                    class="mt-5 md:mt-0 inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-red-600 transition-colors">
                    View All Categories
                    <i class="fas fa-arrow-right text-xs"></i>
                </a>

            </div>


            <!-- Categories Slider -->
            <div class="categories-swiper swiper" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper-wrapper">

                    @forelse($categories as $category)
                        <div class="swiper-slide">

                            <a href="{{ route('businesses.clean', $category->slug) }}"
                                class="card-hover group block bg-white rounded-2xl border border-gray-100 p-6 text-center cursor-pointer">

                                {{-- //icon --}}
                                <div
                                    class="w-14 h-14 mx-auto mb-4 bg-primary/5 group-hover:bg-primary rounded-2xl flex items-center justify-center transition-colors">

                                    @if (!empty($category->icon))
                                        <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}"
                                            width="32" height="32" style="display:block; object-fit:contain;">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="32"
                                            height="32" fill="none">
                                            <path d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5" stroke="currentColor"
                                                stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    @endif




                                </div>


                                <!-- Category Name -->
                                <h4 class="text-sm font-semibold text-dark-900 group-hover:text-primary transition-colors">
                                    {{ $category->name }}
                                </h4>


                                <!-- Business Count -->
                                <p class="text-xs text-dark-300 mt-1">
                                    {{ $category->businesses()->where('status', 'approved')->count() }} listings
                                </p>

                            </a>

                        </div>

                    @empty

                        <div class="swiper-slide">
                            <div class="text-center py-10">
                                <p class="text-dark-400">
                                    No categories available.
                                </p>
                            </div>
                        </div>
                    @endforelse

                </div>

            </div>

        </div>

    </section>
    <!-- ===== POPULAR PLACES ===== -->
    <section class="py-20 lg:py-28 bg-dark-50 relative overflow-hidden">
        <div class="bg-grid absolute inset-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-12 gap-4">

                <div data-aos="fade-right">
                    <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
                        Around the World
                    </span>

                    <h2 class="text-3xl sm:text-4xl font-bold text-dark-900">
                        Popular Places
                    </h2>
                </div>

                <a href="{{ route('categories.index') }}"
                    class="text-primary hover:text-primary-dark font-medium text-sm transition-colors"
                    data-aos="fade-left">
                    View all places
                    <i class="fas fa-arrow-right ml-1"></i>
                </a>

            </div>


            <!-- Places Carousel -->
            <div class="popular-places-swiper swiper" data-aos="fade-up">

                <div class="swiper-wrapper pb-12">

                    @forelse($popularPlaces as $place)
                        <div class="swiper-slide">

                            <a href="{{ url('/businesses?city_id=' . $place->city_id) }}"
                                class="block card-hover img-zoom group relative rounded-3xl overflow-hidden aspect-[3/4] cursor-pointer">

                                {{-- Place Image --}}
                                @if (!empty($place->image))
                                    <img decoding="async" src="{{ asset('storage/' . $place->image) }}"
                                        alt="{{ $place->city }}" class="w-full h-full object-cover" loading="lazy">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-primary/20 to-dark-900 flex items-center justify-center">
                                        <i class="fas fa-location-dot text-5xl text-white/70"></i>
                                    </div>
                                @endif


                                <!-- Overlay -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-dark-900/80 via-dark-900/20 to-transparent">
                                </div>


                                <!-- Listings Count -->
                                <div class="absolute top-4 right-4">

                                    <span
                                        class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-medium rounded-full">
                                        {{ $place->listings_count }} Listings
                                    </span>

                                </div>


                                <!-- Place Information -->
                                <div class="absolute bottom-0 left-0 right-0 p-6">

                                    <h3 class="text-xl font-bold text-white mb-1">
                                        {{ $place->city ?? 'Unknown City' }}
                                    </h3>

                                    <p class="text-white/70 text-sm">
                                        {{ $place->country ?? 'Unknown Country' }}
                                    </p>


                                    <!-- Explore -->
                                    <div
                                        class="mt-3 flex items-center gap-2 opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all">

                                        <span class="text-primary text-sm font-medium">
                                            Explore
                                        </span>

                                        <i class="fas fa-arrow-right text-primary text-xs"></i>

                                    </div>

                                </div>

                            </a>

                        </div>

                    @empty

                        <div class="swiper-slide">
                            <div class="text-center py-16">
                                <i class="fas fa-location-dot text-4xl text-gray-300 mb-4"></i>

                                <p class="text-dark-400">
                                    No popular places available yet.
                                </p>
                            </div>
                        </div>
                    @endforelse

                </div>

                <div class="swiper-pagination"></div>

            </div>

        </div>
    </section>

    <!-- ===== STATS COUNTER ===== -->
    <section class="py-16 bg-dark-900 relative overflow-hidden">

        <div class="bg-grid-dark absolute inset-0"></div>

        <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">

                <!-- Total Listings -->
                <div data-aos="fade-up" data-aos-delay="0">

                    <div class="text-4xl sm:text-5xl font-bold text-white counter-value counter"
                        data-count="{{ $stats['total_listings'] }}">
                        0
                    </div>

                    <p class="text-dark-300 mt-2 text-sm">
                        Total Listings
                    </p>

                </div>


                <!-- Total Categories -->
                <div data-aos="fade-up" data-aos-delay="100">

                    <div class="text-4xl sm:text-5xl font-bold text-white counter-value counter"
                        data-count="{{ $stats['total_categories'] }}">
                        0
                    </div>

                    <p class="text-dark-300 mt-2 text-sm">
                        Categories
                    </p>

                </div>


                <!-- Total Places -->
                <div data-aos="fade-up" data-aos-delay="200">

                    <div class="text-4xl sm:text-5xl font-bold text-white counter-value counter"
                        data-count="{{ $stats['total_places'] }}">
                        0
                    </div>

                    <p class="text-dark-300 mt-2 text-sm">
                        Places Worldwide
                    </p>

                </div>


                <!-- Total Countries -->
                <div data-aos="fade-up" data-aos-delay="300">

                    <div class="text-4xl sm:text-5xl font-bold text-white counter-value counter"
                        data-count="{{ $stats['total_countries'] }}">
                        0
                    </div>

                    <p class="text-dark-300 mt-2 text-sm">
                        Countries
                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- ===== LATEST LISTINGS ===== -->
    <section class="py-20 lg:py-28 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-12 gap-4">
                <div data-aos="fade-right">
                    <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
                        Handpicked
                    </span>

                    <h2 class="text-3xl sm:text-4xl font-bold text-dark-900">
                        Latest Listings
                    </h2>
                </div>

                <a href="{{ route('businesses.index') }}"
                    class="text-primary hover:text-primary-dark font-medium text-sm transition-colors"
                    data-aos="fade-left">
                    View all listings
                    <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>


            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse($latestListings as $index => $business)

                    <!-- Listing Card -->
                    <a href="{{ route('businesses.show', $business->slug) }}"
                        class="card-hover group bg-white rounded-2xl border border-gray-100 overflow-hidden block"
                        data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">

                        {{-- IMAGE --}}
                        <div class="relative img-zoom aspect-[4/3]">

                            @if ($business->cover_image)
                                <img decoding="async" src="{{ asset('storage/' . $business->cover_image) }}"
                                    alt="{{ $business->name }}" class="w-full h-full object-cover" loading="lazy">
                            @elseif($business->logo)
                                <img decoding="async" src="{{ asset('storage/' . $business->logo) }}"
                                    alt="{{ $business->name }}" class="w-full h-full object-cover" loading="lazy">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <i class="fas fa-building text-4xl text-gray-300"></i>
                                </div>
                            @endif


                            {{-- STATUS --}}
                            <div class="absolute top-3 left-3 flex gap-2">

                                <span class="px-2.5 py-1 bg-green-500 text-white text-xs font-medium rounded-lg">
                                    Open
                                </span>

                            </div>


                            {{-- HEART --}}
                            <span
                                class="absolute top-3 right-3 w-9 h-9 bg-white/80 backdrop-blur-sm text-dark-400 rounded-full flex items-center justify-center transition-all group-hover:bg-primary group-hover:text-white">
                                <i class="fas fa-heart text-xs"></i>
                            </span>

                        </div>


                        {{-- CONTENT --}}
                        <div class="p-5">

                            {{-- CATEGORY + RATING --}}
                            <div class="flex items-center gap-2 mb-3">

                                <span class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center">

                                    <i class="fas fa-building text-xs text-primary"></i>

                                </span>


                                <span class="text-xs text-dark-300">

                                    {{ $business->category?->name ?? 'Business' }}

                                </span>


                                <div class="ml-auto flex items-center gap-1">

                                    <i class="fas fa-star text-xs text-amber-400"></i>

                                    <span class="text-xs font-semibold text-dark-900">

                                        {{ number_format($business->rating ?? 0, 1) }}

                                    </span>

                                </div>

                            </div>


                            {{-- BUSINESS NAME --}}
                            <h3 class="font-semibold text-dark-900 group-hover:text-primary transition-colors">

                                {{ $business->name }}

                            </h3>


                            {{-- DESCRIPTION --}}
                            <p class="text-sm text-dark-300 mt-1 line-clamp-2">

                                {{ $business->short_description ??
                                    ($business->description ?? 'Discover this business and explore its services.') }}

                            </p>


                            {{-- LOCATION + PHONE --}}
                            <div class="flex items-center gap-4 mt-4 pt-4 border-t border-gray-50">

                                @if ($business->city)
                                    <span class="flex items-center gap-1.5 text-xs text-dark-300">

                                        <i class="fas fa-map-marker-alt text-primary/50"></i>

                                        {{ $business->city->name }}

                                        @if ($business->state)
                                            , {{ $business->state->name }}
                                        @endif

                                    </span>
                                @endif


                                @if ($business->phone)
                                    <span class="flex items-center gap-1.5 text-xs text-dark-300">

                                        <i class="fas fa-phone text-primary/50"></i>

                                        {{ $business->phone }}

                                    </span>
                                @endif

                            </div>

                        </div>

                    </a>

                @empty

                    {{-- EMPTY STATE --}}
                    <div class="sm:col-span-2 lg:col-span-3 text-center py-12">

                        <div class="w-16 h-16 mx-auto rounded-full bg-primary/5 flex items-center justify-center mb-4">

                            <i class="fas fa-store text-xl text-primary"></i>

                        </div>

                        <h3 class="text-lg font-semibold text-dark-900">
                            No listings available yet
                        </h3>

                        <p class="text-sm text-dark-300 mt-1">
                            New businesses will appear here once they are approved.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>
    </section>


    <!-- ===== PREMIUM DYNAMIC OFFERS ===== -->
    @if ($offers->count())

        <section class="relative py-16 sm:py-20 overflow-hidden" id="special-offers"
            style="background: linear-gradient(135deg, #161c26 0%, #1f2937 100%)">

            <!-- Background -->
            <div class="bg-grid-dark absolute inset-0"></div>

            <div class="absolute -top-24 -right-24 w-80 h-80 bg-primary/20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-primary/10 rounded-full blur-3xl"></div>


            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

                <!-- Heading -->
                <div class="text-center mb-10 sm:mb-12">

                    <span
                        class="inline-flex items-center gap-2 px-4 py-2 bg-primary/10 border border-primary/20 text-primary text-sm font-semibold rounded-full mb-4">

                        <i class="fas fa-bolt"></i>

                        Special Offers

                    </span>

                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">

                        Exclusive Deals
                        <span class="text-gradient">For You</span>

                    </h2>

                    <p class="text-dark-300 mt-4 max-w-2xl mx-auto">

                        Discover the latest offers and deals from businesses in our directory.

                    </p>

                </div>


                <!-- Offers Slider -->
                <div id="offersSlider" class="relative">

                    <div id="offersViewport" class="overflow-hidden">

                        <div id="offersTrack" class="flex transition-transform duration-700 ease-out">

                            @foreach ($offers as $offer)
                                @php

                                    $offerImage = $offer->image
                                        ? asset('storage/' . $offer->image)
                                        : ($offer->business?->cover_image
                                            ? asset('storage/' . $offer->business->cover_image)
                                            : null);

                                @endphp


                                <div class="offer-slide flex-shrink-0 px-2">

                                    <!-- Offer Card -->
                                    <article
                                        class="group h-full bg-white/5 border border-white/10 rounded-3xl overflow-hidden backdrop-blur-sm hover:bg-white/[0.08] transition-all duration-300">

                                        <!-- Image -->
                                        <div class="relative h-52 sm:h-56 overflow-hidden">

                                            @if ($offerImage)
                                                <img src="{{ $offerImage }}" alt="{{ $offer->title }}"
                                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                                    loading="lazy">
                                            @else
                                                <div class="w-full h-full bg-white/5 flex items-center justify-center">

                                                    <div class="text-center">

                                                        <div
                                                            class="w-16 h-16 mx-auto rounded-2xl bg-primary/10 flex items-center justify-center mb-3">

                                                            <i class="fas fa-tags text-2xl text-primary"></i>

                                                        </div>

                                                        <span class="text-white/70 text-sm">
                                                            Special Offer
                                                        </span>

                                                    </div>

                                                </div>
                                            @endif


                                            <!-- Image Overlay -->
                                            <div
                                                class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent">
                                            </div>


                                            <!-- Discount -->
                                            @if ($offer->discount)
                                                <div class="absolute top-4 right-4">

                                                    <span
                                                        class="inline-flex items-center px-4 py-2 bg-primary text-white text-sm font-bold rounded-xl shadow-lg">

                                                        {{ $offer->discount }} OFF

                                                    </span>

                                                </div>
                                            @endif


                                            <!-- Special Offer Label -->
                                            <div class="absolute bottom-4 left-4">

                                                <span
                                                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-black/50 backdrop-blur-md border border-white/10 text-white text-xs font-semibold rounded-lg">

                                                    <i class="fas fa-bolt text-primary"></i>

                                                    Special Offer

                                                </span>

                                            </div>

                                        </div>


                                        <!-- Content -->
                                        <div class="p-6">

                                            <!-- Business -->
                                            @if ($offer->business)
                                                <a href="{{ route('businesses.clean', $offer->business->slug) }}"
                                                    class="inline-flex items-center gap-2 text-primary hover:text-white text-sm font-medium transition-colors mb-3">

                                                    <i class="fas fa-store"></i>

                                                    {{ $offer->business->name }}

                                                </a>
                                            @endif


                                            <!-- Title -->
                                            <h3 class="text-xl sm:text-2xl font-bold text-white leading-snug mb-3">

                                                {{ $offer->title }}

                                            </h3>


                                            <!-- Description -->
                                            @if ($offer->description)
                                                <p class="text-dark-300 text-sm leading-6 mb-5 line-clamp-3">

                                                    {{ $offer->description }}

                                                </p>
                                            @endif


                                            <!-- Bottom -->
                                            <div
                                                class="flex items-center justify-between gap-4 pt-4 border-t border-white/10">

                                                @if ($offer->discount)
                                                    <div>

                                                        <span class="block text-xs text-dark-400">
                                                            Limited Deal
                                                        </span>

                                                        <span class="text-lg font-extrabold text-primary">
                                                            {{ $offer->discount }} OFF
                                                        </span>

                                                    </div>
                                                @else
                                                    <div>

                                                        <span class="inline-flex items-center gap-2 text-sm text-dark-300">

                                                            <i class="fas fa-check-circle text-primary"></i>

                                                            Available now

                                                        </span>

                                                    </div>
                                                @endif


                                                @if ($offer->business)
                                                    <a href="{{ url('/' . $offer->business->slug) }}"
                                                        class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary hover:bg-primary-dark text-white text-sm font-semibold rounded-xl transition-all shadow-lg shadow-primary/20">

                                                        View Offer

                                                        <i class="fas fa-arrow-right text-xs"></i>

                                                    </a>
                                                @endif

                                            </div>

                                        </div>

                                    </article>

                                </div>
                            @endforeach

                        </div>

                    </div>


                    <!-- Navigation -->
                    @if ($offers->count() > 1)
                        <button type="button" id="offerPrev"
                            class="absolute left-0 sm:-left-4 top-1/2 -translate-y-1/2 z-10 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white/10 hover:bg-primary border border-white/10 text-white flex items-center justify-center backdrop-blur-md transition-all shadow-xl"
                            aria-label="Previous offers">

                            <i class="fas fa-chevron-left"></i>

                        </button>


                        <button type="button" id="offerNext"
                            class="absolute right-0 sm:-right-4 top-1/2 -translate-y-1/2 z-10 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-white/10 hover:bg-primary border border-white/10 text-white flex items-center justify-center backdrop-blur-md transition-all shadow-xl"
                            aria-label="Next offers">

                            <i class="fas fa-chevron-right"></i>

                        </button>
                    @endif

                </div>


                <!-- Dots -->
                @if ($offers->count() > 1)

                    <div id="offerDots" class="flex items-center justify-center gap-2 mt-8">

                        @foreach ($offers as $index => $offer)
                            <button type="button"
                                class="offer-dot h-2.5 rounded-full bg-white/20 transition-all duration-300"
                                data-slide="{{ $index }}" aria-label="Go to offer {{ $index + 1 }}"></button>
                        @endforeach

                    </div>

                @endif

            </div>

        </section>


        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const slider = document.getElementById('offersSlider');

                if (!slider) return;


                const track = document.getElementById('offersTrack');

                const slides = Array.from(
                    slider.querySelectorAll('.offer-slide')
                );

                const dots = Array.from(
                    slider.querySelectorAll('.offer-dot')
                );

                const prev = document.getElementById('offerPrev');

                const next = document.getElementById('offerNext');


                if (!track || !slides.length) return;


                let currentPage = 0;

                let timer = null;


                function getVisibleCount() {

                    const width = window.innerWidth;

                    if (width < 640) {
                        return 1;
                    }

                    if (width < 1024) {
                        return 2;
                    }

                    return Math.min(4, slides.length);

                }


                function getPages() {

                    const visible = getVisibleCount();

                    return Math.ceil(slides.length / visible);

                }


                function updateSlider() {

                    const visible = getVisibleCount();

                    const pages = getPages();

                    if (currentPage >= pages) {
                        currentPage = 0;
                    }


                    const slideWidth = 100 / visible;


                    slides.forEach(function(slide) {

                        slide.style.width = slideWidth + '%';

                    });


                    track.style.transform =
                        'translateX(-' +
                        (currentPage * 100) +
                        '%)';


                    dots.forEach(function(dot, index) {

                        if (index === currentPage) {

                            dot.classList.remove(
                                'bg-white/20',
                                'w-2.5'
                            );

                            dot.classList.add(
                                'bg-primary',
                                'w-8'
                            );

                        } else {

                            dot.classList.remove(
                                'bg-primary',
                                'w-8'
                            );

                            dot.classList.add(
                                'bg-white/20',
                                'w-2.5'
                            );

                        }

                    });

                }


                function nextSlide() {

                    const pages = getPages();

                    currentPage++;

                    if (currentPage >= pages) {
                        currentPage = 0;
                    }

                    updateSlider();

                }


                function prevSlide() {

                    const pages = getPages();

                    currentPage--;

                    if (currentPage < 0) {
                        currentPage = pages - 1;
                    }

                    updateSlider();

                }


                function startAutoSlide() {

                    clearInterval(timer);

                    if (slides.length <= 1) return;

                    timer = setInterval(function() {

                        nextSlide();

                    }, 5000);

                }


                if (next) {

                    next.addEventListener('click', function() {

                        nextSlide();

                        startAutoSlide();

                    });

                }


                if (prev) {

                    prev.addEventListener('click', function() {

                        prevSlide();

                        startAutoSlide();

                    });

                }


                dots.forEach(function(dot) {

                    dot.addEventListener('click', function() {

                        currentPage =
                            parseInt(this.dataset.slide, 10) || 0;

                        updateSlider();

                        startAutoSlide();

                    });

                });


                slider.addEventListener(
                    'mouseenter',
                    function() {

                        clearInterval(timer);

                    }
                );


                slider.addEventListener(
                    'mouseleave',
                    function() {

                        startAutoSlide();

                    }
                );


                window.addEventListener(
                    'resize',
                    function() {

                        updateSlider();

                    }
                );


                updateSlider();

                startAutoSlide();

            });
        </script>

    @endif

    <!-- ===== TESTIMONIALS ===== -->
    <section class="py-20 lg:py-28 bg-dark-50 relative overflow-hidden">
        <div class="bg-dots absolute inset-0 opacity-40"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-14" data-aos="fade-up">
                <span
                    class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">Testimonials</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-dark-900">What Our Users Say</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl p-8 border border-gray-100 card-hover" data-aos="fade-up"
                    data-aos-delay="0">
                    <div class="flex gap-1 mb-4">
                        <i class="fas fa-star text-sm text-amber-400"></i>
                        <i class="fas fa-star text-sm text-amber-400"></i>
                        <i class="fas fa-star text-sm text-amber-400"></i>
                        <i class="fas fa-star text-sm text-amber-400"></i>
                        <i class="fas fa-star text-sm text-amber-400"></i>
                    </div>
                    <p class="text-dark-600 leading-relaxed mb-6">"This platform helped me find the best restaurant in the
                        city. The reviews are honest and the search filters make it so easy to narrow down choices."</p>
                    <div class="flex items-center gap-3">
                        <img decoding="async"
                            src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=80&h=80&fit=crop&q=80"
                            alt="Kevin Martin" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h4 class="text-sm font-semibold text-dark-900">Kevin Martin</h4>
                            <p class="text-xs text-dark-300">Happy Customer</p>
                        </div>
                        <i class="fas fa-quote-right text-3xl text-primary/10 ml-auto"></i>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-8 border border-gray-100 card-hover" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="flex gap-1 mb-4">
                        <i class="fas fa-star text-sm text-amber-400"></i>
                        <i class="fas fa-star text-sm text-amber-400"></i>
                        <i class="fas fa-star text-sm text-amber-400"></i>
                        <i class="fas fa-star text-sm text-amber-400"></i>
                        <i class="fas fa-star text-sm text-amber-400"></i>
                    </div>
                    <p class="text-dark-600 leading-relaxed mb-6">"As a business owner, listing here brought me 3x more
                        customers. The dashboard analytics are incredibly useful and the support team is fantastic."</p>
                    <div class="flex items-center gap-3">
                        <img decoding="async"
                            src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=80&h=80&fit=crop&q=80"
                            alt="Jessica Brown" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <h4 class="text-sm font-semibold text-dark-900">Jessica Brown</h4>
                            <p class="text-xs text-dark-300">Business Owner</p>
                        </div>
                        <i class="fas fa-quote-right text-3xl text-primary/10 ml-auto"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== HOW IT WORKS ===== -->
    <section class="py-20 lg:py-28 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14" data-aos="fade-up">
                <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">Simple
                    Steps</span>
                <h2 class="text-3xl sm:text-4xl font-bold text-dark-900">How It Works</h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="w-16 h-16 mx-auto mb-5 bg-primary/5 rounded-2xl flex items-center justify-center relative">
                        <i class="fas fa-th-large text-2xl text-primary"></i>
                        <span
                            class="absolute -top-2 -right-2 w-7 h-7 bg-primary text-white text-xs font-bold rounded-full flex items-center justify-center">1</span>
                    </div>
                    <h4 class="font-semibold text-dark-900 mb-2">Choose a Category</h4>
                    <p class="text-sm text-dark-400">Browse from hundreds of listing categories available</p>
                </div>
                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 mx-auto mb-5 bg-primary/5 rounded-2xl flex items-center justify-center relative">
                        <i class="fas fa-search text-2xl text-primary"></i>
                        <span
                            class="absolute -top-2 -right-2 w-7 h-7 bg-primary text-white text-xs font-bold rounded-full flex items-center justify-center">2</span>
                    </div>
                    <h4 class="font-semibold text-dark-900 mb-2">Find What You Want</h4>
                    <p class="text-sm text-dark-400">Search and filter listings by location, price, and more</p>
                </div>
                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 mx-auto mb-5 bg-primary/5 rounded-2xl flex items-center justify-center relative">
                        <i class="fas fa-check-circle text-2xl text-primary"></i>
                        <span
                            class="absolute -top-2 -right-2 w-7 h-7 bg-primary text-white text-xs font-bold rounded-full flex items-center justify-center">3</span>
                    </div>
                    <h4 class="font-semibold text-dark-900 mb-2">Select the Best</h4>
                    <p class="text-sm text-dark-400">Compare reviews, ratings, and pick the perfect spot</p>
                </div>
                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 mx-auto mb-5 bg-primary/5 rounded-2xl flex items-center justify-center relative">
                        <i class="fas fa-map-marked-alt text-2xl text-primary"></i>
                        <span
                            class="absolute -top-2 -right-2 w-7 h-7 bg-primary text-white text-xs font-bold rounded-full flex items-center justify-center">4</span>
                    </div>
                    <h4 class="font-semibold text-dark-900 mb-2">Explore Now</h4>
                    <p class="text-sm text-dark-400">Go out and enjoy your handpicked destination</p>
                </div>
            </div>

            <!-- Video CTA -->
            <div class="mt-16 relative rounded-3xl overflow-hidden aspect-video max-w-4xl mx-auto" data-aos="zoom-in">
                <img decoding="async"
                    src="https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?w=1200&h=675&fit=crop&q=80"
                    alt="How It Works" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-dark-900/40 flex items-center justify-center">
                    <a href="https://www.youtube.com/watch?v=i9E_Blai8vk"
                        class="video-popup w-20 h-20 bg-white/90 hover:bg-white rounded-full flex items-center justify-center shadow-2xl transition-all animate-pulse-glow">
                        <i class="fas fa-play text-primary text-xl ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== BLOG ===== -->
    <section class="py-20 lg:py-28 bg-dark-50 relative">
        <div class="bg-grid absolute inset-0"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between mb-12 gap-4">
                <div data-aos="fade-right">
                    <span
                        class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">From
                        the Blog</span>
                    <h2 class="text-3xl sm:text-4xl font-bold text-dark-900">News & Articles</h2>
                </div>
                <a href="blog.html" class="text-primary hover:text-primary-dark font-medium text-sm transition-colors"
                    data-aos="fade-left">
                    Read all posts <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <article class="card-hover bg-white rounded-2xl overflow-hidden border border-gray-100" data-aos="fade-up"
                    data-aos-delay="0">
                    <div class="img-zoom aspect-[16/10]">
                        <img decoding="async"
                            src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=600&h=375&fit=crop&q=80"
                            alt="Blog" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 text-xs text-dark-300 mb-3">
                            <span><i class="far fa-calendar mr-1"></i> Aug 07, 2026</span>
                            <span><i class="far fa-comment mr-1"></i> 3 Comments</span>
                        </div>
                        <h3
                            class="font-semibold text-dark-900 leading-snug mb-2 line-clamp-2 hover:text-primary transition-colors">
                            <a href="blog-detail.html">Top 8 Amazing Places to Stay in Canada This Summer</a>
                        </h3>
                        <p class="text-sm text-dark-400 line-clamp-2">Discover the most beautiful accommodations across
                            Canada's stunning landscapes...</p>
                    </div>
                </article>

                <article class="card-hover bg-white rounded-2xl overflow-hidden border border-gray-100" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="img-zoom aspect-[16/10]">
                        <img decoding="async"
                            src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=600&h=375&fit=crop&q=80"
                            alt="Blog" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 text-xs text-dark-300 mb-3">
                            <span><i class="far fa-calendar mr-1"></i> Aug 05, 2026</span>
                            <span><i class="far fa-comment mr-1"></i> 5 Comments</span>
                        </div>
                        <h3
                            class="font-semibold text-dark-900 leading-snug mb-2 line-clamp-2 hover:text-primary transition-colors">
                            <a href="blog-detail.html">How to Leverage Agile Frameworks for Better Listings</a>
                        </h3>
                        <p class="text-sm text-dark-400 line-clamp-2">Learn strategies to optimize your business listing
                            and attract more customers...</p>
                    </div>
                </article>

                <article class="card-hover bg-white rounded-2xl overflow-hidden border border-gray-100" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="img-zoom aspect-[16/10]">
                        <img decoding="async"
                            src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600&h=375&fit=crop&q=80"
                            alt="Blog" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-3 text-xs text-dark-300 mb-3">
                            <span><i class="far fa-calendar mr-1"></i> Aug 02, 2026</span>
                            <span><i class="far fa-comment mr-1"></i> 2 Comments</span>
                        </div>
                        <h3
                            class="font-semibold text-dark-900 leading-snug mb-2 line-clamp-2 hover:text-primary transition-colors">
                            <a href="blog-detail.html">Win-Win Survival Strategies for the Modern Directory</a>
                        </h3>
                        <p class="text-sm text-dark-400 line-clamp-2">Bring to the table strategies that ensure proactive
                            domination...</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- ===== BRAND PARTNERS ===== -->
    <section class="py-16 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="brand-swiper swiper" data-aos="fade-up">
                <div class="swiper-wrapper items-center">
                    <div
                        class="swiper-slide flex items-center justify-center py-4 opacity-40 hover:opacity-100 transition-opacity">
                        <img decoding="async" src="assets/images/brand/logo-acme.svg" alt="Partner"
                            class="max-h-12 grayscale hover:grayscale-0 transition-all">
                    </div>
                    <div
                        class="swiper-slide flex items-center justify-center py-4 opacity-40 hover:opacity-100 transition-opacity">
                        <img decoding="async" src="assets/images/brand/logo-vertex.svg" alt="Partner"
                            class="max-h-12 grayscale hover:grayscale-0 transition-all">
                    </div>
                    <div
                        class="swiper-slide flex items-center justify-center py-4 opacity-40 hover:opacity-100 transition-opacity">
                        <img decoding="async" src="assets/images/brand/logo-horizon.svg" alt="Partner"
                            class="max-h-12 grayscale hover:grayscale-0 transition-all">
                    </div>
                    <div
                        class="swiper-slide flex items-center justify-center py-4 opacity-40 hover:opacity-100 transition-opacity">
                        <img decoding="async" src="assets/images/brand/logo-pulse.svg" alt="Partner"
                            class="max-h-12 grayscale hover:grayscale-0 transition-all">
                    </div>
                    <div
                        class="swiper-slide flex items-center justify-center py-4 opacity-40 hover:opacity-100 transition-opacity">
                        <img decoding="async" src="assets/images/brand/logo-nexus.svg" alt="Partner"
                            class="max-h-12 grayscale hover:grayscale-0 transition-all">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const slider = document.getElementById('offersSlider');

            if (!slider) return;

            const track = document.getElementById('offersTrack');
            const slides = Array.from(
                slider.querySelectorAll('.offer-slide')
            );

            const dots = Array.from(
                slider.querySelectorAll('.offer-dot')
            );

            const prev = document.getElementById('offerPrev');
            const next = document.getElementById('offerNext');

            if (!track || !slides.length) return;

            let currentPage = 0;
            let timer = null;


            /*
            |--------------------------------------------------------------------------
            | VISIBLE OFFERS
            |--------------------------------------------------------------------------
            */

            function getVisibleCount() {

                const width = window.innerWidth;

                // Mobile
                if (width < 640) {
                    return 1;
                }

                // Tablet
                if (width < 1024) {
                    return 2;
                }

                // Desktop - maximum 3
                return Math.min(3, slides.length);

            }


            /*
            |--------------------------------------------------------------------------
            | TOTAL PAGES
            |--------------------------------------------------------------------------
            */

            function getPages() {

                const visible = getVisibleCount();

                return Math.ceil(slides.length / visible);

            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE SLIDER
            |--------------------------------------------------------------------------
            */

            function updateSlider() {

                const visible = getVisibleCount();

                const pages = getPages();

                if (currentPage >= pages) {
                    currentPage = 0;
                }


                const slideWidth = 100 / visible;


                slides.forEach(function(slide) {

                    slide.style.width = slideWidth + '%';

                });


                /*
                |--------------------------------------------------------------------------
                | Move by complete groups
                |--------------------------------------------------------------------------
                */

                track.style.transform =
                    'translateX(-' +
                    (currentPage * 100) +
                    '%)';


                /*
                |--------------------------------------------------------------------------
                | Dots
                |--------------------------------------------------------------------------
                */

                dots.forEach(function(dot, index) {

                    if (index === currentPage) {

                        dot.classList.remove(
                            'bg-white/20',
                            'w-2.5'
                        );

                        dot.classList.add(
                            'bg-primary',
                            'w-8'
                        );

                    } else {

                        dot.classList.remove(
                            'bg-primary',
                            'w-8'
                        );

                        dot.classList.add(
                            'bg-white/20',
                            'w-2.5'
                        );

                    }

                });

            }


            /*
            |--------------------------------------------------------------------------
            | NEXT
            |--------------------------------------------------------------------------
            */

            function nextSlide() {

                const pages = getPages();

                currentPage++;

                if (currentPage >= pages) {
                    currentPage = 0;
                }

                updateSlider();

            }


            /*
            |--------------------------------------------------------------------------
            | PREVIOUS
            |--------------------------------------------------------------------------
            */

            function prevSlide() {

                const pages = getPages();

                currentPage--;

                if (currentPage < 0) {
                    currentPage = pages - 1;
                }

                updateSlider();

            }


            /*
            |--------------------------------------------------------------------------
            | AUTO SLIDE
            |--------------------------------------------------------------------------
            */

            function startAutoSlide() {

                clearInterval(timer);

                if (slides.length <= 1) {
                    return;
                }

                timer = setInterval(function() {

                    nextSlide();

                }, 5000);

            }


            /*
            |--------------------------------------------------------------------------
            | BUTTONS
            |--------------------------------------------------------------------------
            */

            if (next) {

                next.addEventListener('click', function() {

                    nextSlide();

                    startAutoSlide();

                });

            }


            if (prev) {

                prev.addEventListener('click', function() {

                    prevSlide();

                    startAutoSlide();

                });

            }


            /*
            |--------------------------------------------------------------------------
            | DOTS
            |--------------------------------------------------------------------------
            */

            dots.forEach(function(dot) {

                dot.addEventListener('click', function() {

                    currentPage =
                        parseInt(this.dataset.slide, 10) || 0;

                    updateSlider();

                    startAutoSlide();

                });

            });


            /*
            |--------------------------------------------------------------------------
            | PAUSE ON HOVER
            |--------------------------------------------------------------------------
            */

            slider.addEventListener(
                'mouseenter',
                function() {

                    clearInterval(timer);

                }
            );


            slider.addEventListener(
                'mouseleave',
                function() {

                    startAutoSlide();

                }
            );


            /*
            |--------------------------------------------------------------------------
            | RESIZE
            |--------------------------------------------------------------------------
            */

            window.addEventListener(
                'resize',
                function() {

                    updateSlider();

                }
            );


            /*
            |--------------------------------------------------------------------------
            | INIT
            |--------------------------------------------------------------------------
            */

            updateSlider();

            startAutoSlide();

        });
    </script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const heroSlides = [
            @foreach ($homeSliders as $slider)
                {
                    src: "{{ asset('storage/' . $slider->background_image) }}",
                    badge: @json($slider->badge),
                    title: @json($slider->title),
                    highlight: @json($slider->highlight),
                    typedWords: @json($slider->typed_words),
                    description: @json($slider->description)
                },
            @endforeach
        ];

        if (heroSlides.length > 0) {

            $('#heroSection').vegas({
                slides: heroSlides.map(slide => ({
                    src: slide.src
                })),

                delay: 5000,
                transition: 'fade',
                transitionDuration: 1500,
                animation: 'kenburns',
                animationDuration: 8000,
                timer: true,
                autoplay: true,
                loop: true
            });

            // ==============================
            // HERO CONTENT SYNC
            // ==============================

            let currentHeroIndex = 0;

            function updateHeroContent(index) {

                const slide = heroSlides[index];

                if (!slide) {
                    return;
                }

                const badge = document.getElementById('hero-badge');
                const title = document.getElementById('hero-title');
                const highlight = document.getElementById('hero-highlight');
                const description = document.getElementById('hero-description');
                const typed = document.getElementById('hero-typed');

                if (badge) {
                    badge.lastChild.textContent = ' ' + (slide.badge || '');
                }

                if (title) {
                    title.textContent = slide.title || '';
                }

                if (highlight) {
                    highlight.textContent = slide.highlight || '';
                }

                if (description) {
                    description.textContent = slide.description || '';
                }

                // Typed words
                if (typed) {
                    typed.textContent = '';

                    const words = (slide.typedWords || '')
                        .split(',')
                        .map(word => word.trim())
                        .filter(word => word !== '');

                    if (words.length > 0) {
                        typeHeroWords(words, typed);
                    }
                }
            }


            // ==============================
            // TYPING EFFECT
            // ==============================

            let typingTimeout;

            function typeHeroWords(words, element) {

                clearTimeout(typingTimeout);

                let wordIndex = 0;
                let charIndex = 0;
                let deleting = false;

                function type() {

                    const word = words[wordIndex];

                    if (!word) {
                        return;
                    }

                    if (!deleting) {

                        element.textContent = word.substring(0, charIndex + 1);
                        charIndex++;

                        if (charIndex === word.length) {
                            deleting = true;

                            typingTimeout = setTimeout(type, 1500);
                            return;
                        }

                    } else {

                        element.textContent = word.substring(0, charIndex - 1);
                        charIndex--;

                        if (charIndex === 0) {
                            deleting = false;
                            wordIndex = (wordIndex + 1) % words.length;
                        }
                    }

                    typingTimeout = setTimeout(type, deleting ? 50 : 90);
                }

                type();
            }


            // First slide content
            updateHeroContent(0);


            // Vegas slide change
            $('#heroSection').on('vegaswalk', function (e, index) {

                currentHeroIndex = index;

                updateHeroContent(currentHeroIndex);

            });

        }

    });
</script>
@endsection
