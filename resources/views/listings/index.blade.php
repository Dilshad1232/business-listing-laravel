
@extends('layouts.main')

@section('title', 'Listings Grid — Lokora Directory')

@section('content')

    {{-- PAGE HEADER --}}
    <section class="bg-dark-900 relative overflow-hidden py-16 lg:py-20">
        <div class="bg-grid-dark absolute inset-0"></div>

        <div class="absolute top-0 right-1/4 w-80 h-80 bg-primary/10 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center" data-aos="fade-up">

                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                    Listings Grid
                </h1>

                <nav class="flex items-center justify-center gap-2 text-sm">

                    <a href="{{ route('home') }}"
                       class="text-dark-300 hover:text-primary transition-colors">
                        Home
                    </a>

                    <i class="fas fa-chevron-right text-xs text-dark-500"></i>

                    <span class="text-primary">
                        Listings Grid
                    </span>

                </nav>

            </div>
        </div>
    </section>


    {{-- =========================================================
        FEATURED LISTINGS
    ========================================================= --}}
    @if($featuredListings->count())

        <section class="py-12 lg:py-16 bg-white">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                {{-- SECTION HEADER --}}
                <div
                    class="flex flex-col sm:flex-row
                    items-start sm:items-end
                    justify-between gap-4 mb-8"
                    data-aos="fade-up"
                >

                    <div>

                        <span class="text-xs font-semibold
                            text-primary uppercase tracking-wider">
                            Featured
                        </span>

                        <h2 class="text-2xl lg:text-3xl
                            font-bold text-dark-900 mt-1">
                            Featured Listings
                        </h2>

                        <p class="text-sm text-dark-400 mt-2">
                            Explore our top featured businesses.
                        </p>

                    </div>

                    <a
                        href="{{ route('listings.index') }}"
                        class="text-sm font-medium text-primary
                        hover:text-primary-dark transition-colors"
                    >
                        View All
                        <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>

                </div>


                {{-- FEATURED CARDS --}}
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach($featuredListings as $listing)

                        <div
                            class="card-hover group bg-white rounded-2xl
                            border border-gray-100 overflow-hidden"
                            data-aos="fade-up"
                        >

                            {{-- IMAGE --}}
                            <div class="relative img-zoom aspect-[4/3]">

                                @if($listing->cover_image)

    <img
        src="{{ asset('storage/' . $listing->cover_image) }}"
        alt="{{ $listing->name }}"
        class="w-full h-full object-cover"
        loading="lazy"
    >

@elseif($listing->logo)

    <img
        src="{{ asset('storage/' . $listing->logo) }}"
        alt="{{ $listing->name }}"
        class="w-full h-full object-cover"
        loading="lazy"
    >

@else

                                    <div
                                        class="w-full h-full bg-dark-100
                                        flex items-center justify-center"
                                    >
                                        <i class="fas fa-image
                                            text-4xl text-dark-300"></i>
                                    </div>

                                @endif


                                {{-- FEATURED --}}
                                <div class="absolute top-3 left-3">

                                    <span
                                        class="px-2.5 py-1 bg-primary
                                        text-white text-xs font-medium
                                        rounded-lg"
                                    >
                                        <i class="fas fa-star mr-1"></i>
                                        Featured
                                    </span>

                                </div>


                                {{-- HEART --}}
                                <button
                                    type="button"
                                    class="absolute top-3 right-3
                                    w-9 h-9 bg-white/80
                                    backdrop-blur-sm
                                    hover:bg-primary hover:text-white
                                    text-dark-400 rounded-full
                                    flex items-center justify-center
                                    transition-all"
                                >
                                    <i class="fas fa-heart text-xs"></i>
                                </button>

                            </div>


                            {{-- CARD CONTENT --}}
                            <div class="p-5">

                                {{-- CATEGORY + RATING --}}
                                <div class="flex items-center gap-2 mb-3">

                                    <span
                                        class="w-8 h-8 rounded-full
                                        bg-primary/10 flex items-center
                                        justify-center"
                                    >
                                        <i class="{{ $listing->category?->icon ?? 'fas fa-store' }}
                                            text-xs text-primary"></i>
                                    </span>

                                    <span class="text-xs text-dark-300">
                                        {{ $listing->category?->name ?? 'Uncategorized' }}
                                    </span>

                                    {{-- RATING --}}
                                    <div class="ml-auto flex items-center gap-1">

                                        <i class="fas fa-star
                                            text-xs text-amber-400"></i>

                                        <span
                                            class="text-xs font-semibold
                                            text-dark-900"
                                        >
                                            {{ number_format((float) $listing->rating, 1) }}
                                        </span>

                                    </div>

                                </div>


                                {{-- NAME --}}
                                {{-- DETAILS PAGE LINK --}}
                                <h3
                                    class="font-semibold text-dark-900
                                    group-hover:text-primary
                                    transition-colors"
                                >

                                    <a href="{{ route('listings.details', ['listing' => $listing->slug]) }}">

                                        {{ $listing->name }}

                                    </a>

                                </h3>


                                {{-- DESCRIPTION --}}
                                <p
                                    class="text-sm text-dark-300
                                    mt-1 line-clamp-2"
                                >
                                {{ $listing->description ?? 'No description available.' }}
                                </p>


                                {{-- LOCATION + PHONE --}}
                                <div
                                    class="flex items-center gap-4 mt-4
                                    pt-4 border-t border-gray-50"
                                >

                                    {{-- LOCATION --}}
                                    @if($listing->city || $listing->state)

                                    <span
                                        class="flex items-center gap-1.5
                                        text-xs text-dark-300"
                                    >

                                        <i
                                            class="fas fa-map-marker-alt
                                            text-primary/50"
                                        ></i>

                                        {{ collect([
                                            $listing->city?->name,
                                            $listing->state?->name
                                        ])->filter()->implode(', ') }}

                                    </span>

                                @endif


                                    {{-- PHONE --}}
                                    @if($listing->phone)

                                        <span
                                            class="flex items-center gap-1.5
                                            text-xs text-dark-300"
                                        >

                                            <i
                                                class="fas fa-phone
                                                text-primary/50"
                                            ></i>

                                            {{ $listing->phone }}

                                        </span>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>

    @endif


    {{-- =========================================================
        LISTINGS CONTENT
    ========================================================= --}}
    <section class="py-16 lg:py-20 bg-dark-50 relative">

        <div class="bg-grid absolute inset-0"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

            <div class="flex flex-col lg:flex-row gap-8">


                {{-- =================================================
                    SIDEBAR
                ================================================= --}}
                <aside
                    class="w-full lg:w-80 flex-shrink-0"
                    data-aos="fade-right"
                >

                    <form
                        action="{{ route('listings.index') }}"
                        method="GET"
                        class="bg-white rounded-2xl border border-gray-100
                        p-6 space-y-6 sticky top-28"
                    >

                        {{-- SEARCH --}}
                        <div>

                            <h4 class="text-sm font-semibold text-dark-900 mb-3">
                                Search
                            </h4>

                            <div class="relative">

                                <i
                                    class="fas fa-search absolute left-4 top-1/2
                                    -translate-y-1/2 text-dark-300 text-sm"
                                ></i>

                                <input
                                    type="text"
                                    name="search"
                                    value="{{ request('search') }}"
                                    placeholder="Search listings..."
                                    class="w-full pl-11 pr-4 py-3 bg-dark-50
                                    rounded-xl text-dark-900 text-sm
                                    placeholder:text-dark-300
                                    focus:outline-none focus:ring-2
                                    focus:ring-primary/30
                                    border border-gray-100"
                                >

                            </div>

                        </div>


                        {{-- CATEGORIES --}}
                        <div>

                            <h4 class="text-sm font-semibold text-dark-900 mb-3">
                                Categories
                            </h4>

                            <div class="space-y-2.5">

                                @forelse($categories ?? [] as $category)

                                    <label
                                        class="flex items-center gap-3
                                        cursor-pointer group"
                                    >

                                        <input
                                            type="radio"
                                            name="category"
                                            value="{{ $category->slug }}"
                                            {{ request('category') == $category->slug ? 'checked' : '' }}
                                            class="w-4 h-4 text-primary
                                            bg-dark-50 border-gray-200
                                            focus:ring-primary/30"
                                        >

                                        <span
                                            class="text-sm text-dark-500
                                            group-hover:text-dark-900
                                            transition-colors"
                                        >
                                            {{ $category->name }}
                                        </span>

                                        <span
                                            class="ml-auto text-xs text-dark-300
                                            bg-dark-50 px-2 py-0.5 rounded-full"
                                        >
                                        {{ $category->businesses_count ?? 0 }}
                                        </span>

                                    </label>

                                @empty

                                    <p class="text-sm text-dark-400">
                                        No categories found.
                                    </p>

                                @endforelse

                            </div>

                        </div>


                        {{-- PRICE --}}
                        <div>

                            <h4 class="text-sm font-semibold text-dark-900 mb-3">
                                Price Range
                            </h4>

                            <div id="range-slider-price" class="mb-4"></div>

                            <input
                                type="hidden"
                                name="min_price"
                                id="min-price-input"
                                value="{{ request('min_price', $priceMin ?? 0) }}"
                            >

                            <input
                                type="hidden"
                                name="max_price"
                                id="max-price-input"
                                value="{{ request('max_price', $priceMax ?? 0) }}"
                            >

                            <div class="flex items-center justify-between text-sm">

                                <span class="text-dark-500">
                                    $<span id="min-value-rangeslider">
                                        {{ request('min_price', $priceMin ?? 0) }}
                                    </span>
                                </span>

                                <span class="text-dark-500">
                                    $<span id="max-value-rangeslider">
                                        {{ request('max_price', $priceMax ?? 0) }}
                                    </span>
                                </span>

                            </div>

                        </div>


                        {{-- LOCATION --}}
                        <div>

                            <h4 class="text-sm font-semibold text-dark-900 mb-3">
                                Location
                            </h4>

                            <div class="relative">

                                <i
                                    class="fas fa-map-marker-alt absolute left-4
                                    top-1/2 -translate-y-1/2
                                    text-dark-300 text-sm"
                                ></i>

                                <select
                                    name="city"
                                    class="w-full pl-11 pr-4 py-3 bg-dark-50
                                    rounded-xl text-dark-900 text-sm
                                    appearance-none
                                    focus:outline-none
                                    focus:ring-2 focus:ring-primary/30
                                    border border-gray-100"
                                >

                                    <option value="">
                                        All Locations
                                    </option>

                                    @foreach($locations ?? [] as $location)

                                        <option
                                            value="{{ $location }}"
                                            {{ request('city') == $location ? 'selected' : '' }}
                                        >
                                            {{ $location }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>

                        </div>


                        {{-- APPLY FILTER --}}
                        <button
                            type="submit"
                            class="w-full py-3 bg-primary
                            hover:bg-primary-dark text-white
                            text-sm font-medium rounded-xl
                            transition-colors
                            shadow-lg shadow-primary/25"
                        >

                            <i class="fas fa-filter mr-2"></i>

                            Apply Filters

                        </button>


                        {{-- CLEAR FILTERS --}}
                        @if(request()->hasAny([
                            'search',
                            'category',
                            'city'
                        ]))

                            <a
                                href="{{ route('listings.index') }}"
                                class="block text-center text-sm text-dark-400
                                hover:text-primary transition-colors"
                            >
                                Clear Filters
                            </a>

                        @endif

                    </form>

                </aside>


                {{-- =================================================
                    MAIN CONTENT
                ================================================= --}}
                <div class="flex-1">


                    {{-- TOP BAR --}}
                    <div
                        class="flex flex-col sm:flex-row
                        items-start sm:items-center
                        justify-between mb-6 gap-4"
                        data-aos="fade-up"
                    >

                        <p class="text-sm text-dark-400">

                            Showing

                            <span class="font-semibold text-dark-900">
                                {{ $listings->firstItem() ?? 0 }}
                            </span>

                            -

                            <span class="font-semibold text-dark-900">
                                {{ $listings->lastItem() ?? 0 }}
                            </span>

                            of

                            <span class="font-semibold text-dark-900">
                                {{ $listings->total() }}
                            </span>

                            listings

                        </p>


                        <div class="flex items-center gap-3">


                            {{-- VIEW SWITCH --}}
                            <div
                                class="flex items-center gap-1
                                bg-white rounded-xl
                                border border-gray-100 p-1"
                            >

                                <a
                                    href="{{ route('listings.index') }}"
                                    class="w-9 h-9 flex items-center
                                    justify-center rounded-lg
                                    bg-primary text-white text-sm"
                                >
                                    <i class="fas fa-th-large"></i>
                                </a>

                                <a
                                    href="{{ route('listings.list') }}"
                                    class="w-9 h-9 flex items-center
                                    justify-center rounded-lg
                                    text-dark-400 hover:text-primary
                                    text-sm"
                                >
                                    <i class="fas fa-list"></i>
                                </a>

                                <a
                                    href="{{ route('listings.map') }}"
                                    class="w-9 h-9 flex items-center
                                    justify-center rounded-lg
                                    text-dark-400 hover:text-primary
                                    text-sm"
                                >
                                    <i class="fas fa-map-marked-alt"></i>
                                </a>

                            </div>


                            {{-- SORTING --}}
                            <form
                                action="{{ route('listings.index') }}"
                                method="GET"
                            >

                                {{-- KEEP EXISTING FILTERS --}}
                                @if(request('search'))

                                    <input
                                        type="hidden"
                                        name="search"
                                        value="{{ request('search') }}"
                                    >

                                @endif

                                @if(request('category'))

                                    <input
                                        type="hidden"
                                        name="category"
                                        value="{{ request('category') }}"
                                    >

                                @endif

                                @if(request('city'))

                                    <input
                                        type="hidden"
                                        name="city"
                                        value="{{ request('city') }}"
                                    >

                                @endif

                                @if(request('min_price'))

                                    <input
                                        type="hidden"
                                        name="min_price"
                                        value="{{ request('min_price') }}"
                                    >

                                @endif

                                @if(request('max_price'))

                                    <input
                                        type="hidden"
                                        name="max_price"
                                        value="{{ request('max_price') }}"
                                    >

                                @endif


                                <select
                                    name="sort"
                                    onchange="this.form.submit()"
                                    class="px-4 py-2.5 bg-white
                                    rounded-xl text-dark-900 text-sm
                                    border border-gray-100
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-primary/30
                                    appearance-none"
                                >

                                    <option
                                        value="latest"
                                        {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}
                                    >
                                        Newest First
                                    </option>

                                    <option
                                        value="oldest"
                                        {{ request('sort') == 'oldest' ? 'selected' : '' }}
                                    >
                                        Oldest First
                                    </option>

                                    <option
                                        value="price_low"
                                        {{ request('sort') == 'price_low' ? 'selected' : '' }}
                                    >
                                        Price: Low to High
                                    </option>

                                    <option
                                        value="price_high"
                                        {{ request('sort') == 'price_high' ? 'selected' : '' }}
                                        >
                                        Price: High to Low
                                    </option>

                                    <option
                                        value="rating_high"
                                        {{ request('sort') == 'rating_high' ? 'selected' : '' }}
                                    >
                                        Top Rated
                                    </option>

                                </select>

                            </form>

                        </div>

                    </div>


                    {{-- =================================================
                        LISTING CARDS
                    ================================================= --}}
                    <div class="grid sm:grid-cols-2 gap-6">

                        @forelse($listings as $listing)

                            <div
                                class="card-hover group bg-white rounded-2xl
                                border border-gray-100 overflow-hidden"
                                data-aos="fade-up"
                            >

                                {{-- IMAGE --}}
                                <div class="relative img-zoom aspect-[4/3]">

                                    @if($listing->cover_image)

                                    <img
                                        src="{{ asset('storage/' . $listing->cover_image) }}"
                                        alt="{{ $listing->name }}"
                                        class="w-full h-full object-cover"
                                        loading="lazy"
                                    >

                                @elseif($listing->logo)

                                    <img
                                        src="{{ asset('storage/' . $listing->logo) }}"
                                        alt="{{ $listing->name }}"
                                        class="w-full h-full object-cover"
                                        loading="lazy"
                                    >

                                @else

                                        <div
                                            class="w-full h-full bg-dark-100
                                            flex items-center justify-center"
                                        >
                                            <i class="fas fa-image
                                                text-4xl text-dark-300"></i>
                                        </div>

                                    @endif


                                    {{-- STATUS --}}
                                    <div class="absolute top-3 left-3">

                                        @if($listing->status === 'approved')

                                            <span
                                                class="px-2.5 py-1 bg-green-500
                                                text-white text-xs font-medium
                                                rounded-lg"
                                            >
                                                Open
                                            </span>

                                        @else

                                            <span
                                                class="px-2.5 py-1 bg-red-500
                                                text-white text-xs font-medium
                                                rounded-lg"
                                            >
                                                Closed
                                            </span>

                                        @endif

                                    </div>


                                    {{-- HEART --}}
                                    <button
                                        type="button"
                                        class="absolute top-3 right-3
                                        w-9 h-9 bg-white/80
                                        backdrop-blur-sm
                                        hover:bg-primary hover:text-white
                                        text-dark-400 rounded-full
                                        flex items-center justify-center
                                        transition-all"
                                    >
                                        <i class="fas fa-heart text-xs"></i>
                                    </button>

                                </div>


                                {{-- CARD CONTENT --}}
                                <div class="p-5">

                                    {{-- CATEGORY + RATING --}}
                                    <div class="flex items-center gap-2 mb-3">

                                        <span
                                            class="w-8 h-8 rounded-full
                                            bg-primary/10 flex items-center
                                            justify-center"
                                        >

                                            <i
                                                class="{{ $listing->category?->icon ?? 'fas fa-store' }}
                                                text-xs text-primary"
                                            ></i>

                                        </span>

                                        <span class="text-xs text-dark-300">

                                            {{ $listing->category?->name ?? 'Uncategorized' }}

                                        </span>


                                        {{-- RATING --}}
                                        <div
                                            class="ml-auto flex items-center gap-1"
                                        >

                                            <i
                                                class="fas fa-star
                                                text-xs text-amber-400"
                                            ></i>

                                            <span
                                                class="text-xs font-semibold
                                                text-dark-900"
                                            >
                                                {{ number_format((float) $listing->rating, 1) }}
                                            </span>

                                        </div>

                                    </div>


                                    {{-- NAME --}}
                                    {{-- DETAILS PAGE LINK --}}
                                    <h3
                                        class="font-semibold text-dark-900
                                        group-hover:text-primary
                                        transition-colors"
                                    >

                                        <a
                                            href="{{ route('listings.details', ['listing' => $listing->slug]) }}"
                                        >
                                            {{ $listing->name }}
                                        </a>

                                    </h3>


                                    {{-- DESCRIPTION --}}
                                    <p
                                        class="text-sm text-dark-300
                                        mt-1 line-clamp-2"
                                    >

                                    {{ $listing->description ?? 'No description available.' }}

                                    </p>


                                    {{-- LOCATION + PHONE --}}
                                    <div
                                        class="flex items-center gap-4 mt-4
                                        pt-4 border-t border-gray-50"
                                    >

                                        {{-- LOCATION --}}
                                        @if(
                                            $listing->city ||
                                            $listing->state ||
                                            $listing->country
                                        )

                                            <span
                                                class="flex items-center gap-1.5
                                                text-xs text-dark-300"
                                            >

                                                <i
                                                    class="fas fa-map-marker-alt
                                                    text-primary/50"
                                                ></i>

                                                {{ collect([
                                                    $listing->city?->name,
                                                    $listing->state?->name,
                                                    $listing->country?->name
                                                ])->filter()->implode(', ') }}

                                            </span>

                                        @endif


                                        {{-- PHONE --}}
                                        @if($listing->phone)

                                            <span
                                                class="flex items-center gap-1.5
                                                text-xs text-dark-300"
                                            >

                                                <i
                                                    class="fas fa-phone
                                                    text-primary/50"
                                                ></i>

                                                {{ $listing->phone }}

                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        @empty


                            {{-- EMPTY STATE --}}
                            <div
                                class="sm:col-span-2 bg-white rounded-2xl
                                border border-gray-100 p-12 text-center"
                            >

                                <div
                                    class="w-16 h-16 mx-auto mb-5
                                    rounded-full bg-primary/10
                                    flex items-center justify-center"
                                >

                                    <i
                                        class="fas fa-store
                                        text-2xl text-primary"
                                    ></i>

                                </div>

                                <h3
                                    class="text-lg font-semibold
                                    text-dark-900 mb-2"
                                >
                                    No Listings Found
                                </h3>

                                <p class="text-sm text-dark-400">
                                    There are currently no active listings available.
                                </p>

                            </div>

                        @endforelse

                    </div>


                    {{-- =================================================
                        PAGINATION
                    ================================================= --}}
                    @if($listings->hasPages())

                        <div
                            class="flex items-center justify-center
                            gap-2 mt-12"
                            data-aos="fade-up"
                        >

                            {{-- PREVIOUS --}}
                            @if($listings->onFirstPage())

                                <span
                                    class="w-10 h-10 flex items-center
                                    justify-center rounded-xl bg-white
                                    border border-gray-100 text-dark-200
                                    text-sm cursor-not-allowed"
                                >
                                    <i class="fas fa-chevron-left text-xs"></i>
                                </span>

                            @else

                                <a
                                    href="{{ $listings->previousPageUrl() }}"
                                    class="w-10 h-10 flex items-center
                                    justify-center rounded-xl bg-white
                                    border border-gray-100 text-dark-400
                                    hover:bg-primary hover:text-white
                                    hover:border-primary transition-all text-sm"
                                >
                                    <i class="fas fa-chevron-left text-xs"></i>
                                </a>

                            @endif


                            {{-- PAGE NUMBERS --}}
                            @for(
                                $page = 1;
                                $page <= $listings->lastPage();
                                $page++
                            )

                                @if($page == $listings->currentPage())

                                    <span
                                        class="w-10 h-10 flex items-center
                                        justify-center rounded-xl bg-primary
                                        text-white text-sm font-medium
                                        shadow-lg shadow-primary/25"
                                    >
                                        {{ $page }}
                                    </span>

                                @else

                                    <a
                                        href="{{ $listings->url($page) }}"
                                        class="w-10 h-10 flex items-center
                                        justify-center rounded-xl bg-white
                                        border border-gray-100 text-dark-600
                                        hover:bg-primary hover:text-white
                                        hover:border-primary transition-all
                                        text-sm font-medium"
                                    >
                                        {{ $page }}
                                    </a>

                                @endif

                            @endfor


                            {{-- NEXT --}}
                            @if($listings->hasMorePages())

                                <a
                                    href="{{ $listings->nextPageUrl() }}"
                                    class="w-10 h-10 flex items-center
                                    justify-center rounded-xl bg-white
                                    border border-gray-100 text-dark-400
                                    hover:bg-primary hover:text-white
                                    hover:border-primary transition-all
                                    text-sm"
                                >
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </a>

                            @else

                                <span
                                    class="w-10 h-10 flex items-center
                                    justify-center rounded-xl bg-white
                                    border border-gray-100 text-dark-200
                                    text-sm cursor-not-allowed"
                                >
                                    <i class="fas fa-chevron-right text-xs"></i>
                                </span>

                            @endif

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </section>

@endsection


