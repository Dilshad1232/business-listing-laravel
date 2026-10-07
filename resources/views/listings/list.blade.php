@extends('layouts.main')

@section('title', 'Listings List — Lokora Directory')

@section('content')

    {{-- Page Header --}}
    <section class="relative bg-gray-900 py-24">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">

                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Listings List
                </h1>

                <div class="flex items-center justify-center gap-2 text-sm">
                    <a href="{{ route('home') }}" class="hover:text-red-400">
                        Home
                    </a>

                    <span>/</span>

                    <span class="text-gray-300">
                        Listings List
                    </span>
                </div>

            </div>
        </div>
    </section>


    {{-- Listings Section --}}
    <section class="py-16 bg-gray-50">

        <div class="container mx-auto px-4">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                {{-- Sidebar --}}
                <aside class="lg:col-span-3">

                    <div class="bg-white rounded-2xl shadow-sm p-6 sticky top-24">

                        <h3 class="text-xl font-bold mb-6">
                            Search & Filters
                        </h3>

                        <form method="GET" action="{{ route('listings.list') }}">

                            {{-- Search --}}
                            <div class="mb-6">

                                <label class="block text-sm font-semibold mb-2">
                                    Search
                                </label>

                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Search businesses..."
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-400"
                                >

                            </div>


                            {{-- Categories --}}
                            <div class="mb-6">

                                <label class="block text-sm font-semibold mb-3">
                                    Category
                                </label>

                                <div class="space-y-3">

                                    @forelse($categories as $category)

                                        <label class="flex items-center justify-between cursor-pointer">

                                            <span class="flex items-center gap-2">

                                                <input
                                                    type="radio"
                                                    name="category"
                                                    value="{{ $category->slug }}"
                                                    {{ request('category') == $category->slug ? 'checked' : '' }}
                                                    class="accent-red-500"
                                                >

                                                <span class="text-sm text-gray-700">
                                                    {{ $category->name }}
                                                </span>

                                            </span>

                                            <span class="text-xs text-gray-400">
                                                {{ $category->businesses_count ?? 0 }}
                                            </span>

                                        </label>

                                    @empty

                                        <p class="text-sm text-gray-500">
                                            No categories found.
                                        </p>

                                    @endforelse

                                </div>

                            </div>


                            {{-- Location --}}
                            <div class="mb-6">

                                <label class="block text-sm font-semibold mb-2">
                                    Location
                                </label>

                                <select
                                    name="city"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-red-400"
                                >

                                    <option value="">
                                        All Locations
                                    </option>

                                    @foreach($locations as $location)

                                        <option
                                            value="{{ $location }}"
                                            {{ request('city') == $location ? 'selected' : '' }}
                                        >
                                            {{ $location }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- Minimum Price --}}
                            <div class="mb-4">

                                <label class="block text-sm font-semibold mb-2">
                                    Minimum Price
                                </label>

                                <input
                                    type="number"
                                    name="min_price"
                                    value="{{ request('min_price') }}"
                                    placeholder="Minimum price"
                                    min="0"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-400"
                                >

                            </div>


                            {{-- Maximum Price --}}
                            <div class="mb-6">

                                <label class="block text-sm font-semibold mb-2">
                                    Maximum Price
                                </label>

                                <input
                                    type="number"
                                    name="max_price"
                                    value="{{ request('max_price') }}"
                                    placeholder="Maximum price"
                                    min="0"
                                    class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-400"
                                >

                            </div>


                            {{-- Apply --}}
                            <button
                                type="submit"
                                class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 rounded-xl transition"
                            >
                                Apply Filters
                            </button>


                            {{-- Clear --}}
                            @if(request()->hasAny([
                                'search',
                                'category',
                                'city',
                                'min_price',
                                'max_price'
                            ]))

                                <a
                                    href="{{ route('listings.list') }}"
                                    class="block text-center mt-3 text-sm text-gray-500 hover:text-red-500"
                                >
                                    Clear Filters
                                </a>

                            @endif

                        </form>

                    </div>

                </aside>


                {{-- Main Content --}}
                <div class="lg:col-span-9">

                    {{-- Top Bar --}}
                    <div class="bg-white rounded-2xl shadow-sm p-5 mb-6">

                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                            <div>

                                <h2 class="text-xl font-bold">
                                    Listings
                                </h2>

                                <p class="text-sm text-gray-500 mt-1">
                                    Showing
                                    {{ $listings->firstItem() ?? 0 }}
                                    -
                                    {{ $listings->lastItem() ?? 0 }}
                                    of
                                    {{ $listings->total() }}
                                    listings
                                </p>

                            </div>


                            <div class="flex items-center gap-2">

                                {{-- Grid --}}
                                <a
                                    href="{{ route('listings.index') }}"
                                    class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:text-red-500 hover:border-red-500"
                                    title="Grid View"
                                >
                                    <i class="fa-solid fa-grid-2"></i>
                                </a>


                                {{-- List --}}
                                <a
                                    href="{{ route('listings.list') }}"
                                    class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-500 text-white"
                                    title="List View"
                                >
                                    <i class="fa-solid fa-list"></i>
                                </a>


                                {{-- Map --}}
                                <a
                                    href="#"
                                    class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500"
                                    title="Map View"
                                >
                                    <i class="fa-solid fa-map"></i>
                                </a>

                            </div>


                            {{-- Sorting --}}
                            <form method="GET" action="{{ route('listings.list') }}">

                                <input
                                    type="hidden"
                                    name="search"
                                    value="{{ request('search') }}"
                                >

                                <input
                                    type="hidden"
                                    name="category"
                                    value="{{ request('category') }}"
                                >

                                <input
                                    type="hidden"
                                    name="city"
                                    value="{{ request('city') }}"
                                >

                                <input
                                    type="hidden"
                                    name="min_price"
                                    value="{{ request('min_price') }}"
                                >

                                <input
                                    type="hidden"
                                    name="max_price"
                                    value="{{ request('max_price') }}"
                                >

                                <select
                                    name="sort"
                                    onchange="this.form.submit()"
                                    class="border border-gray-200 rounded-xl px-4 py-2.5 bg-white text-sm focus:outline-none"
                                >

                                    <option value="latest"
                                        {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>
                                        Newest
                                    </option>

                                    <option value="rating_high"
                                        {{ request('sort') == 'rating_high' ? 'selected' : '' }}>
                                        Top Rated
                                    </option>

                                    <option value="price_low"
                                        {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                                        Price Low to High
                                    </option>

                                    <option value="price_high"
                                        {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                                        Price High to Low
                                    </option>

                                    <option value="oldest"
                                        {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                                        Oldest
                                    </option>

                                </select>

                            </form>

                        </div>

                    </div>


                    {{-- Listing Cards --}}
                    <div class="space-y-6">

                        @forelse($listings as $listing)

                            <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition">

                                <div class="grid grid-cols-1 md:grid-cols-12">

                                    {{-- Image --}}
                                    <div class="md:col-span-4 relative">

                                        <a href="{{route('listings.details', $listing)}}">

                                            @if($listing->cover_image)

                                            <img
                                                src="{{ asset('storage/' . $listing->cover_image) }}"
                                                alt="{{ $listing->name }}"
                                                class="w-full h-64 md:h-full object-cover"
                                            >

                                        @elseif($listing->logo)

                                            <img
                                                src="{{ asset('storage/' . $listing->logo) }}"
                                                alt="{{ $listing->name }}"
                                                class="w-full h-64 md:h-full object-cover"
                                            >

                                        @else

                                                <div class="w-full h-64 md:h-full bg-gray-100 flex items-center justify-center">

                                                    <i class="fa-solid fa-building text-5xl text-gray-300"></i>

                                                </div>

                                            @endif

                                        </a>


                                        @if($listing->is_featured)

                                            <span class="absolute top-4 left-4 bg-red-500 text-white text-xs font-semibold px-3 py-1.5 rounded-full">
                                                Featured
                                            </span>

                                        @endif

                                    </div>


                                    {{-- Content --}}
                                    <div class="md:col-span-8 p-6">

                                        <div class="flex items-start justify-between gap-4">

                                            <div>

                                                @if($listing->category)

                                                    <span class="text-sm text-red-500 font-medium">
                                                        {{ $listing->category->name }}
                                                    </span>

                                                @endif

                                                <h3 class="text-2xl font-bold mt-1">

                                                    <a
                                                        href="{{ route('listings.details', $listing) }}"
                                                        class="hover:text-red-500 transition"
                                                    >
                                                        {{ $listing->name }}
                                                    </a>

                                                </h3>

                                            </div>


                                            @if($listing->status === 'approved')

                                            <span class="shrink-0 text-xs bg-green-100 text-green-700 px-3 py-1.5 rounded-full">
                                                Live
                                            </span>

                                        @endif

                                        </div>


                                        {{-- Rating --}}
                                        <div class="flex items-center gap-2 mt-3">

                                            <div class="flex text-yellow-400">

                                                @php
                                                    $rating = (float) ($listing->rating ?? 0);
                                                    $fullStars = floor($rating);
                                                @endphp

                                                @for($i = 1; $i <= 5; $i++)

                                                    @if($i <= $fullStars)

                                                        <i class="fa-solid fa-star text-sm"></i>

                                                    @else

                                                        <i class="fa-regular fa-star text-sm"></i>

                                                    @endif

                                                @endfor

                                            </div>

                                            @if($listing->rating)

                                                <span class="text-sm font-semibold">
                                                    {{ number_format($listing->rating, 1) }}
                                                </span>

                                            @else

                                                <span class="text-sm text-gray-400">
                                                    No rating
                                                </span>

                                            @endif

                                        </div>


                                        {{-- Description --}}
                                        <p class="text-gray-500 text-sm leading-6 mt-4">

                                            {{ \Illuminate\Support\Str::limit(
                                                $listing->description ?? $listing->tagline ?? '',
                                                160
                                            ) }}

                                        </p>


                                        {{-- Meta --}}
                                        <div class="flex flex-wrap gap-x-6 gap-y-3 mt-5 text-sm text-gray-500">

                                            @if($listing->city)

                                                <span class="flex items-center gap-2">
                                                    <i class="fa-solid fa-location-dot text-red-500"></i>
                                                    {{ $listing->city?->name }}
                                                </span>

                                            @endif


                                            @if($listing->phone)

                                                <span class="flex items-center gap-2">
                                                    <i class="fa-solid fa-phone text-red-500"></i>
                                                    {{ $listing->phone }}
                                                </span>

                                            @endif

                                        </div>


                                        {{-- Bottom --}}
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-6 pt-5 border-t border-gray-100">

                                            <div>

                                                @if($listing->price)

                                                    <span class="text-xl font-bold text-gray-900">
                                                        ₹{{ number_format($listing->price) }}
                                                    </span>

                                                @else

                                                    <span class="text-sm text-gray-400">
                                                        Contact for price
                                                    </span>

                                                @endif

                                            </div>


                                            <a
                                                href="{{ route('listings.details', $listing) }}"
                                                class="inline-flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-xl font-semibold transition"
                                            >
                                                View Details
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="bg-white rounded-2xl shadow-sm p-12 text-center">

                                <div class="w-20 h-20 mx-auto rounded-full bg-red-50 flex items-center justify-center mb-5">

                                    <i class="fa-solid fa-building text-3xl text-red-400"></i>

                                </div>

                                <h3 class="text-xl font-bold mb-2">
                                    No Listings Found
                                </h3>

                                <p class="text-gray-500 mb-6">
                                    We couldn't find any businesses matching your filters.
                                </p>

                                <a
                                    href="{{ route('listings.list') }}"
                                    class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-5 py-3 rounded-xl font-semibold"
                                >
                                    Clear Filters
                                </a>

                            </div>

                        @endforelse

                    </div>


                    {{-- Pagination --}}
                    @if($listings->hasPages())

                        <div class="mt-8 bg-white rounded-2xl shadow-sm p-5">

                            <div class="flex flex-wrap items-center justify-center gap-2">

                                @if($listings->onFirstPage())

                                    <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-100 text-gray-400">
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </span>

                                @else

                                    <a
                                        href="{{ $listings->previousPageUrl() }}"
                                        class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 hover:bg-red-500 hover:text-white hover:border-red-500"
                                    >
                                        <i class="fa-solid fa-chevron-left"></i>
                                    </a>

                                @endif


                                @foreach($listings->getUrlRange(1, $listings->lastPage()) as $page => $url)

                                    @if($page == $listings->currentPage())

                                        <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-red-500 text-white font-semibold">
                                            {{ $page }}
                                        </span>

                                    @else

                                        <a
                                            href="{{ $url }}"
                                            class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 hover:bg-red-500 hover:text-white hover:border-red-500"
                                        >
                                            {{ $page }}
                                        </a>

                                    @endif

                                @endforeach


                                @if($listings->hasMorePages())

                                    <a
                                        href="{{ $listings->nextPageUrl() }}"
                                        class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 hover:bg-red-500 hover:text-white hover:border-red-500"
                                    >
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </a>

                                @else

                                    <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-100 text-gray-400">
                                        <i class="fa-solid fa-chevron-right"></i>
                                    </span>

                                @endif

                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </section>

@endsection
