@extends('layouts.main')

@section('title', $listing->name . ' — Listing Details')

@section('content')


<style>
    /* =========================================================
   BUSINESS DETAILS NAVIGATION
========================================================= */

.business-detail-tab {
    position: relative;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    min-height: 56px;

    padding: 15px 24px;

    color: #6b7280;
    background: transparent;

    font-size: 14px;
    font-weight: 600;

    white-space: nowrap;

    border: 0;
    outline: none;

    cursor: pointer;

    transition:
        color .25s ease,
        background .25s ease;
}


/* HOVER */
.business-detail-tab:hover {
    color: var(--color-primary, #fc3c3c);

    background: rgba(252, 60, 60, 0.04);
}


/* ICON */
.business-detail-tab i {
    font-size: 14px;

    transition:
        transform .25s ease,
        color .25s ease;
}


/* ICON HOVER */
.business-detail-tab:hover i {
    transform: translateY(-1px);
}


/* ACTIVE */
.business-detail-tab.active {
    color: var(--color-primary, #fc3c3c);

    background: rgba(252, 60, 60, 0.05);
}


/* ACTIVE UNDERLINE */
.business-detail-tab.active::after {
    content: "";

    position: absolute;

    left: 20px;
    right: 20px;
    bottom: 0;

    height: 3px;

    background: var(--color-primary, #fc3c3c);

    border-radius: 999px 999px 0 0;
}


/* =========================================================
   HORIZONTAL SCROLL
========================================================= */

.scrollbar-hide {
    scrollbar-width: none;

    -ms-overflow-style: none;
}

.scrollbar-hide::-webkit-scrollbar {
    display: none;
}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 640px) {

    .business-detail-tab {

        min-height: 52px;

        padding: 13px 17px;

        gap: 7px;

        font-size: 13px;
    }


    .business-detail-tab i {
        font-size: 13px;
    }


    .business-detail-tab.active::after {

        left: 15px;
        right: 15px;

        height: 2px;
    }

}


/* =========================================================
   VERY SMALL DEVICES
========================================================= */

@media (max-width: 380px) {

    .business-detail-tab {

        padding-left: 14px;
        padding-right: 14px;

        font-size: 12px;
    }


    .business-detail-tab.active::after {

        left: 12px;
        right: 12px;
    }

}
</style>

{{-- =========================================================
PAGE HEADER
========================================================= --}}

<section class="bg-dark-900 relative overflow-hidden py-14 lg:py-16">

```
<div class="bg-grid-dark absolute inset-0"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

    <div class="text-center">

        <p class="text-primary text-sm font-semibold mb-2">
            {{ $listing->category?->name ?? 'Business Listing' }}
        </p>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
            {{ $listing->name }}
        </h1>

        <nav class="flex items-center justify-center gap-2 text-sm flex-wrap">

            <a href="{{ route('home') }}"
               class="text-dark-300 hover:text-primary">
                Home
            </a>

            <i class="fas fa-chevron-right text-xs text-dark-500"></i>

            <a href="{{ route('listings.index') }}"
               class="text-dark-300 hover:text-primary">
                Listings
            </a>

            @if($listing->category)

                <i class="fas fa-chevron-right text-xs text-dark-500"></i>

                <a href="{{ route('listings.index', ['category' => $listing->category->slug]) }}"
                   class="text-dark-300 hover:text-primary">
                    {{ $listing->category->name }}
                </a>

            @endif

            <i class="fas fa-chevron-right text-xs text-dark-500"></i>

            <span class="text-primary">
                {{ $listing->name }}
            </span>

        </nav>

    </div>

</div>
```

</section>

{{-- =========================================================
MAIN DETAILS
========================================================= --}}

<section class="py-12 lg:py-16 bg-dark-50">

```
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- TOP BUSINESS CARD --}}
    <div class="bg-white rounded-3xl border border-gray-100
                overflow-hidden shadow-sm mb-8">

        <div class="grid lg:grid-cols-5">

            {{-- IMAGE --}}
            <div class="lg:col-span-2">

                <div class="relative h-full min-h-[320px] lg:min-h-[390px]">

                    @if($listing->cover_image)

    <img
        src="{{ asset('storage/' . $listing->cover_image) }}"
        alt="{{ $listing->name }}"
        class="absolute inset-0 w-full h-full object-cover"
    >

@elseif($listing->logo)

    <img
        src="{{ asset('storage/' . $listing->logo) }}"
        alt="{{ $listing->name }}"
        class="absolute inset-0 w-full h-full object-cover"
    >

@else

                        <div class="absolute inset-0 bg-dark-100
                                    flex items-center justify-center">

                            <i class="fas fa-store text-6xl text-dark-300"></i>

                        </div>

                    @endif


                    {{-- STATUS --}}
                    <div class="absolute top-5 left-5">

                        @if($listing->status === 'approved')

                            <span class="inline-flex items-center gap-2
                                         px-3 py-1.5 bg-green-500
                                         text-white text-xs font-semibold
                                         rounded-lg shadow-lg">

                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span>

                                Open

                            </span>

                        @else

                            <span class="inline-flex items-center gap-2
                                         px-3 py-1.5 bg-red-500
                                         text-white text-xs font-semibold
                                         rounded-lg shadow-lg">

                                <span class="w-1.5 h-1.5 bg-white rounded-full"></span>

                                Closed

                            </span>

                        @endif

                    </div>


                    {{-- FEATURED --}}
                    @if($listing->is_featured)

                        <div class="absolute top-5 right-5">

                            <span class="inline-flex items-center gap-2
                                         px-3 py-1.5 bg-primary
                                         text-white text-xs font-semibold
                                         rounded-lg shadow-lg">

                                <i class="fas fa-star"></i>

                                Featured

                            </span>

                        </div>

                    @endif

                </div>

            </div>


            {{-- BUSINESS INFORMATION --}}
            <div class="lg:col-span-3 p-6 lg:p-10">

                {{-- CATEGORY --}}
                <div class="flex items-center gap-2 mb-4">

                    <span class="w-9 h-9 rounded-lg bg-primary/10
                                 flex items-center justify-center">

                        <i class="{{ $listing->category?->icon ?? 'fas fa-store' }}
                                  text-primary"></i>

                    </span>

                    <div>

                        <p class="text-xs text-dark-400">
                            Category
                        </p>

                        <p class="text-sm font-semibold text-dark-900">
                            {{ $listing->category?->name ?? 'Business' }}
                        </p>

                    </div>

                </div>


                {{-- NAME --}}
                <h2 class="text-2xl lg:text-3xl font-bold text-dark-900 mb-3">
                    {{ $listing->name }}
                </h2>


                {{-- SUBCATEGORY --}}
                @if($listing->subcategory)

                    <p class="text-sm text-primary font-medium mb-4">

                        <i class="fas fa-layer-group mr-1"></i>

                        {{ $listing->subcategory->name }}

                    </p>

                @endif


                {{-- SHORT DESCRIPTION --}}
                @if($listing->description)

                <p class="text-dark-500 leading-7 mb-6">
                    {{ $listing->description }}
                </p>

            @endif


                {{-- RATING --}}
                <div class="flex items-center gap-3 mb-7">

                    <div class="flex items-center gap-1">

                        @for($i = 1; $i <= 5; $i++)

                            @if($listing->rating >= $i)

                                <i class="fas fa-star text-amber-400"></i>

                            @elseif($listing->rating >= ($i - 0.5))

                                <i class="fas fa-star-half-alt text-amber-400"></i>

                            @else

                                <i class="far fa-star text-gray-300"></i>

                            @endif

                        @endfor

                    </div>

                    <span class="font-semibold text-dark-900">
                        {{ number_format((float) $listing->rating, 1) }}
                    </span>

                    <span class="text-sm text-dark-400">
                        Rating
                    </span>

                </div>


                {{-- QUICK INFORMATION --}}
                <div class="grid sm:grid-cols-2 gap-4">

                    @if($listing->city || $listing->state)

                        <div class="flex items-start gap-3">

                            <span class="w-10 h-10 flex-shrink-0
                                         rounded-xl bg-primary/10
                                         flex items-center justify-center">

                                <i class="fas fa-map-marker-alt text-primary"></i>

                            </span>

                            <div>

                                <p class="text-xs text-dark-400">
                                    Location
                                </p>

                                <p class="text-sm font-medium text-dark-900">
                                    {{ $listing->city?->name }}
                                    @if($listing->state)
                                        , {{ $listing->state?->name }}
                                    @endif
                                </p>

                            </div>

                        </div>

                    @endif


                    @if($listing->phone)

                        <div class="flex items-start gap-3">

                            <span class="w-10 h-10 flex-shrink-0
                                         rounded-xl bg-primary/10
                                         flex items-center justify-center">

                                <i class="fas fa-phone text-primary"></i>

                            </span>

                            <div>

                                <p class="text-xs text-dark-400">
                                    Phone
                                </p>

                                <a href="tel:{{ $listing->phone }}"
                                   class="text-sm font-medium text-dark-900
                                          hover:text-primary">

                                    {{ $listing->phone }}

                                </a>

                            </div>

                        </div>

                    @endif

                </div>


                {{-- ACTIONS --}}
                <div class="flex flex-wrap gap-3 mt-8">

                    @if($listing->phone)

                        <a href="tel:{{ $listing->phone }}"
                           class="inline-flex items-center justify-center
                                  gap-2 px-5 py-3 bg-primary
                                  hover:bg-primary-dark text-white
                                  rounded-xl text-sm font-semibold
                                  transition-all hover:-translate-y-0.5">

                            <i class="fas fa-phone"></i>

                            Call Now

                        </a>

                    @endif


                    @if($listing->email)

                        <a href="mailto:{{ $listing->email }}"
                           class="inline-flex items-center justify-center
                                  gap-2 px-5 py-3 bg-primary/10
                                  hover:bg-primary/15 text-primary
                                  rounded-xl text-sm font-semibold">

                            <i class="fas fa-envelope"></i>

                            Email

                        </a>

                    @endif


                    @if($listing->website)

                        <a href="{{ $listing->website }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center justify-center
                                  gap-2 px-5 py-3 border border-gray-200
                                  hover:border-primary hover:text-primary
                                  text-dark-700 rounded-xl text-sm
                                  font-semibold">

                            <i class="fas fa-globe"></i>

                            Website

                        </a>

                    @endif

                </div>

            </div>

        </div>

    </div>


   {{-- =========================================================
    CONTENT + SIDEBAR
========================================================= --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5 sm:gap-6 lg:gap-8">

    {{-- =====================================================
        LEFT CONTENT
    ====================================================== --}}
    <div class="lg:col-span-2 min-w-0 space-y-5 sm:space-y-6 lg:space-y-8">

        {{-- =================================================
            PREMIUM DETAILS NAVIGATION
        ================================================== --}}
        <div class="bg-white rounded-2xl border border-gray-100
                    shadow-sm overflow-hidden sticky top-20 sm:top-24 z-20">

            <div class="overflow-x-auto scrollbar-hide">

                <div class="flex min-w-max w-full">

                    {{-- ABOUT --}}
                    <button
                        type="button"
                        class="business-detail-tab active"
                        data-target="business-about">

                        <i class="fas fa-info-circle"></i>

                        <span>About</span>

                    </button>


                    {{-- FEATURES --}}
                    <button
                        type="button"
                        class="business-detail-tab"
                        data-target="business-features">

                        <i class="fas fa-check-circle"></i>

                        <span>Features & Services</span>

                    </button>


                    {{-- REVIEWS --}}
                    <button
                        type="button"
                        class="business-detail-tab"
                        data-target="business-reviews">

                        <i class="fas fa-star"></i>

                        <span>Reviews</span>

                    </button>


                    {{-- LOCATION --}}
                    <button
                        type="button"
                        class="business-detail-tab"
                        data-target="business-location">

                        <i class="fas fa-map-marker-alt"></i>

                        <span>Location</span>

                    </button>

                </div>

            </div>

        </div>


        {{-- =================================================
            ABOUT
        ================================================== --}}
        <div
            id="business-about"
            class="business-detail-content bg-white rounded-2xl
                   border border-gray-100 p-5 sm:p-6 lg:p-8">

            <div class="flex items-center gap-3 mb-5">

                <span
                    class="w-11 h-11 flex-shrink-0 rounded-xl
                           bg-primary/10 flex items-center justify-center">

                    <i class="fas fa-info-circle text-primary"></i>

                </span>

                <div class="min-w-0">

                    <p class="text-xs text-dark-400">
                        Business Information
                    </p>

                    <h2 class="text-xl sm:text-2xl font-bold text-dark-900">
                        About {{ $listing->name }}
                    </h2>

                </div>

            </div>


            @if($listing->description)

                <div class="text-dark-500 leading-7 sm:leading-8
                            text-sm sm:text-base break-words">

                    {!! nl2br(e($listing->description)) !!}

                </div>

                @if($listing->description)

                <div class="text-dark-500 leading-7 sm:leading-8
                            text-sm sm:text-base break-words">

                    {!! nl2br(e($listing->description)) !!}

                </div>

            @else

                <p class="text-dark-400 text-sm">
                    No description available.
                </p>

            @endif

                <p class="text-dark-400 text-sm">
                    No description available.
                </p>

            @endif

        </div>


        {{-- =================================================
            FEATURES & SERVICES
        ================================================== --}}
        <div
            id="business-features"
            class="business-detail-content bg-white rounded-2xl
                   border border-gray-100 p-5 sm:p-6 lg:p-8 hidden">

            <div class="flex items-center gap-3 mb-6">

                <span
                    class="w-11 h-11 flex-shrink-0 rounded-xl
                           bg-primary/10 flex items-center justify-center">

                    <i class="fas fa-check-circle text-primary"></i>

                </span>

                <div>

                    <p class="text-xs text-dark-400">
                        What We Offer
                    </p>

                    <h2 class="text-xl sm:text-2xl font-bold text-dark-900">
                        Features & Services
                    </h2>

                </div>

            </div>


            {{-- FEATURES GRID --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                {{-- FEATURE 1 --}}
                <div
                    class="group p-4 sm:p-5 rounded-2xl
                           border border-gray-100
                           hover:border-primary/20
                           hover:bg-primary/5
                           transition-all">

                    <div class="flex items-start gap-3">

                        <span
                            class="w-10 h-10 flex-shrink-0 rounded-xl
                                   bg-primary/10
                                   flex items-center justify-center
                                   group-hover:bg-primary
                                   transition-all">

                            <i
                                class="fas fa-briefcase text-primary
                                       group-hover:text-white transition-colors">
                            </i>

                        </span>

                        <div class="min-w-0">

                            <h3 class="font-semibold text-dark-900 text-sm sm:text-base">
                                Professional Service
                            </h3>

                            <p class="text-xs sm:text-sm text-dark-400 mt-1 leading-5">
                                Professional and reliable services for customers.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- FEATURE 2 --}}
                <div
                    class="group p-4 sm:p-5 rounded-2xl
                           border border-gray-100
                           hover:border-primary/20
                           hover:bg-primary/5
                           transition-all">

                    <div class="flex items-start gap-3">

                        <span
                            class="w-10 h-10 flex-shrink-0 rounded-xl
                                   bg-primary/10
                                   flex items-center justify-center
                                   group-hover:bg-primary
                                   transition-all">

                            <i
                                class="fas fa-shield-alt text-primary
                                       group-hover:text-white transition-colors">
                            </i>

                        </span>

                        <div class="min-w-0">

                            <h3 class="font-semibold text-dark-900 text-sm sm:text-base">
                                Trusted Business
                            </h3>

                            <p class="text-xs sm:text-sm text-dark-400 mt-1 leading-5">
                                A trusted business focused on quality and satisfaction.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- FEATURE 3 --}}
                <div
                    class="group p-4 sm:p-5 rounded-2xl
                           border border-gray-100
                           hover:border-primary/20
                           hover:bg-primary/5
                           transition-all">

                    <div class="flex items-start gap-3">

                        <span
                            class="w-10 h-10 flex-shrink-0 rounded-xl
                                   bg-primary/10
                                   flex items-center justify-center
                                   group-hover:bg-primary
                                   transition-all">

                            <i
                                class="fas fa-headset text-primary
                                       group-hover:text-white transition-colors">
                            </i>

                        </span>

                        <div class="min-w-0">

                            <h3 class="font-semibold text-dark-900 text-sm sm:text-base">
                                Quality Support
                            </h3>

                            <p class="text-xs sm:text-sm text-dark-400 mt-1 leading-5">
                                Helpful support whenever customers need assistance.
                            </p>

                        </div>

                    </div>

                </div>


                {{-- FEATURE 4 --}}
                <div
                    class="group p-4 sm:p-5 rounded-2xl
                           border border-gray-100
                           hover:border-primary/20
                           hover:bg-primary/5
                           transition-all">

                    <div class="flex items-start gap-3">

                        <span
                            class="w-10 h-10 flex-shrink-0 rounded-xl
                                   bg-primary/10
                                   flex items-center justify-center
                                   group-hover:bg-primary
                                   transition-all">

                            <i
                                class="fas fa-users text-primary
                                       group-hover:text-white transition-colors">
                            </i>

                        </span>

                        <div class="min-w-0">

                            <h3 class="font-semibold text-dark-900 text-sm sm:text-base">
                                Customer Friendly
                            </h3>

                            <p class="text-xs sm:text-sm text-dark-400 mt-1 leading-5">
                                Customer-focused approach with friendly service.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
            REVIEWS
        ================================================== --}}
        <div
            id="business-reviews"
            class="business-detail-content bg-white rounded-2xl
                   border border-gray-100 p-5 sm:p-6 lg:p-8 hidden">

            <div
                class="flex flex-col sm:flex-row
                       sm:items-center sm:justify-between
                       gap-4 mb-6">

                <div class="flex items-center gap-3">

                    <span
                        class="w-11 h-11 flex-shrink-0 rounded-xl
                               bg-primary/10 flex items-center justify-center">

                        <i class="fas fa-star text-primary"></i>

                    </span>

                    <div>

                        <p class="text-xs text-dark-400">
                            Customer Feedback
                        </p>

                        <h2 class="text-xl sm:text-2xl font-bold text-dark-900">
                            Reviews
                        </h2>

                    </div>

                </div>


                {{-- RATING --}}
                <div class="text-left sm:text-right">

                    <div class="flex items-center sm:justify-end gap-1">

                        <i class="fas fa-star text-yellow-400"></i>

                        <span class="text-xl font-bold text-dark-900">
                            {{ number_format((float) $listing->rating, 1) }}
                        </span>

                    </div>

                    <p class="text-xs text-dark-400 mt-1">
                        Overall Rating
                    </p>

                </div>

            </div>


            {{-- NO REVIEWS --}}
            <div
                class="rounded-2xl border border-dashed border-gray-200
                       p-8 sm:p-10 text-center">

                <div
                    class="w-14 h-14 mx-auto rounded-full
                           bg-primary/10 flex items-center justify-center mb-4">

                    <i class="fas fa-star text-primary text-xl"></i>

                </div>

                <h3 class="font-semibold text-dark-900 mb-1">
                    No reviews yet
                </h3>

                <p class="text-sm text-dark-400">
                    Be the first person to review this business.
                </p>

            </div>

        </div>


{{-- =================================================
    LOCATION
================================================== --}}
<div
    id="business-location"
    class="business-detail-content bg-white rounded-2xl
           border border-gray-100 overflow-hidden hidden">

    @if($listing->address || $listing->city || $listing->state || $listing->country)

        {{-- LOCATION HEADER --}}
        <div class="p-5 sm:p-6 border-b border-gray-100">

            <div class="flex items-center gap-3">

                <span
                    class="w-11 h-11 flex-shrink-0 rounded-xl
                           bg-primary/10 flex items-center justify-center">

                    <i class="fas fa-map-marker-alt text-primary"></i>

                </span>

                <div>

                    <p class="text-xs text-dark-400">
                        Find Us
                    </p>

                    <h2 class="text-xl sm:text-2xl font-bold text-dark-900">
                        Location
                    </h2>

                </div>

            </div>

        </div>


        {{-- GOOGLE MAP --}}
        <div class="h-56 sm:h-64 md:h-72 lg:h-80">

            <iframe
                class="w-full h-full border-0"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps?q={{ urlencode(
                    trim(
                        collect([
                            $listing->address,
                            $listing->city?->name,
                            $listing->state?->name,
                            $listing->country?->name
                        ])->filter()->implode(', ')
                    )
                ) }}&output=embed">
            </iframe>

        </div>


        {{-- BUSINESS ADDRESS --}}
        <div class="p-5 sm:p-6 border-t border-gray-100">

            <div class="flex items-start gap-3">

                <span
                    class="w-10 h-10 flex-shrink-0 rounded-xl
                           bg-primary/10 flex items-center justify-center">

                    <i class="fas fa-location-dot text-primary"></i>

                </span>

                <div class="min-w-0">

                    <p class="text-xs text-dark-400 mb-1">
                        Business Address
                    </p>

                    <p
                        class="text-sm font-medium text-dark-900
                               leading-6 break-words">

                        {{ collect([
                            $listing->address,
                            $listing->city?->name,
                            $listing->state?->name,
                            $listing->country?->name
                        ])->filter()->implode(', ') }}

                    </p>

                </div>

            </div>

        </div>

    @else

        {{-- LOCATION NOT AVAILABLE --}}
        <div class="py-12 sm:py-16 px-5 text-center">

            <div
                class="w-14 h-14 mx-auto rounded-full
                       bg-primary/10 flex items-center justify-center mb-4">

                <i class="fas fa-map-marker-alt text-primary text-xl"></i>

            </div>

            <h3 class="font-semibold text-dark-900 mb-1">
                Location Not Available
            </h3>

            <p class="text-sm text-dark-400">
                Business location details are not available.
            </p>

        </div>

    @endif

</div>


        {{-- =================================================
            SHARE LISTING
            NOT A TAB
        ================================================== --}}
        <div
            class="bg-white rounded-2xl border border-gray-100
                   p-5 sm:p-6">

            <div class="flex items-center gap-3 mb-4">

                <span
                    class="w-10 h-10 flex-shrink-0 rounded-xl
                           bg-primary/10 flex items-center justify-center">

                    <i class="fas fa-share-alt text-primary"></i>

                </span>

                <div>

                    <p class="text-xs text-dark-400">
                        Spread the Word
                    </p>

                    <h3 class="font-bold text-dark-900">
                        Share Listing
                    </h3>

                </div>

            </div>


            <button
                type="button"
                onclick="openShareModal()"
                class="w-full py-3.5 px-4
                       border border-gray-200
                       hover:border-primary
                       hover:text-primary
                       hover:bg-primary/5
                       text-dark-700 rounded-xl
                       font-semibold text-sm
                       transition-all">

                <i class="fas fa-share-alt mr-2"></i>

                Share This Business

            </button>

        </div>

    </div>


    {{-- =====================================================
        RIGHT SIDEBAR
    ====================================================== --}}
    <div class="space-y-6">

        {{-- =================================================
            CONTACT BUSINESS
        ================================================== --}}
        <div
            class="bg-white rounded-2xl border border-gray-100
                   p-5 sm:p-6
                   lg:sticky lg:top-28">

            <h3 class="text-lg font-bold text-dark-900 mb-5">
                Contact Business
            </h3>


            {{-- PHONE --}}
            @if($listing->phone)

                <a
                    href="tel:{{ $listing->phone }}"
                    class="flex items-center gap-3 p-3 rounded-xl
                           hover:bg-primary/5 transition-colors">

                    <span
                        class="w-10 h-10 flex-shrink-0 rounded-xl
                               bg-primary/10 flex items-center justify-center">

                        <i class="fas fa-phone text-primary"></i>

                    </span>

                    <div class="min-w-0">

                        <p class="text-xs text-dark-400">
                            Phone
                        </p>

                        <p class="text-sm font-semibold text-dark-900 break-words">
                            {{ $listing->phone }}
                        </p>

                    </div>

                </a>

            @endif


            {{-- EMAIL --}}
            @if($listing->email)

                <a
                    href="mailto:{{ $listing->email }}"
                    class="flex items-center gap-3 p-3 rounded-xl
                           hover:bg-primary/5 transition-colors">

                    <span
                        class="w-10 h-10 flex-shrink-0 rounded-xl
                               bg-primary/10 flex items-center justify-center">

                        <i class="fas fa-envelope text-primary"></i>

                    </span>

                    <div class="min-w-0">

                        <p class="text-xs text-dark-400">
                            Email
                        </p>

                        <p
                            class="text-sm font-semibold text-dark-900
                                   break-all">

                            {{ $listing->email }}

                        </p>

                    </div>

                </a>

            @endif


            {{-- WEBSITE --}}
            @if($listing->website)

                <a
                    href="{{ $listing->website }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="flex items-center gap-3 p-3 rounded-xl
                           hover:bg-primary/5 transition-colors">

                    <span
                        class="w-10 h-10 flex-shrink-0 rounded-xl
                               bg-primary/10 flex items-center justify-center">

                        <i class="fas fa-globe text-primary"></i>

                    </span>

                    <div>

                        <p class="text-xs text-dark-400">
                            Website
                        </p>

                        <p class="text-sm font-semibold text-primary">
                            Visit Website
                        </p>

                    </div>

                </a>

            @endif


            {{-- ADDRESS --}}
            @if($listing->address || $listing->city || $listing->state || $listing->country)

            <div class="flex items-start gap-3 p-3">

                <span
                    class="w-10 h-10 flex-shrink-0 rounded-xl
                           bg-primary/10 flex items-center justify-center">

                    <i class="fas fa-map-marker-alt text-primary"></i>

                </span>

                <div class="min-w-0">

                    <p class="text-xs text-dark-400">
                        Address
                    </p>

                    <p
                        class="text-sm font-medium text-dark-900
                               leading-6 break-words">

                        {{ collect([
                            $listing->address,
                            $listing->city?->name,
                            $listing->state?->name,
                            $listing->country?->name
                        ])->filter()->implode(', ') }}

                    </p>

                </div>

            </div>

        @endif


            {{-- SEND MESSAGE --}}
            <div class="mt-5 pt-5 border-t border-gray-100">

                <button
                    type="button"
                    onclick="document.getElementById('contactBusinessModal').classList.remove('hidden')"
                    class="w-full py-3.5 px-4
                           bg-primary text-white
                           hover:bg-primary-dark
                           rounded-xl font-semibold text-sm
                           transition-all">

                    <i class="fas fa-paper-plane mr-2"></i>

                    Send a Message

                </button>

            </div>

        </div>

    </div>

</div>

    {{-- =====================================================
         RELATED LISTINGS
    ====================================================== --}}
    @if($relatedListings->count())

        <div class="mt-12 lg:mt-16">

            <div class="flex items-end justify-between gap-4 mb-6">

                <div>

                    <p class="text-sm font-semibold text-primary mb-1">
                        Explore More
                    </p>

                    <h2 class="text-2xl lg:text-3xl font-bold text-dark-900">
                        Related Businesses
                    </h2>

                    <p class="text-sm text-dark-400 mt-2">
                        More businesses from the same category.
                    </p>

                </div>


                <a href="{{ route('listings.index', [
                    'category' => $listing->category?->slug
                ]) }}"
                   class="hidden sm:inline-flex items-center gap-2
                          text-sm font-semibold text-primary
                          hover:gap-3 transition-all">

                    View All

                    <i class="fas fa-arrow-right text-xs"></i>

                </a>

            </div>


            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">

                @foreach($relatedListings as $related)

                    <a href="{{ route('listings.details', [
                        'listing' => $related->slug
                    ]) }}"
                       class="group bg-white rounded-2xl overflow-hidden
                              border border-gray-100
                              hover:border-primary/20
                              hover:shadow-xl transition-all duration-300">

                        {{-- IMAGE --}}
                        <div class="relative h-48 overflow-hidden">

                            @if($related->cover_image)

                            <img
                                src="{{ asset('storage/' . $related->cover_image) }}"
                                alt="{{ $related->name }}"
                                class="w-full h-full object-cover
                                       group-hover:scale-105
                                       transition-transform duration-500"
                            >

                        @elseif($related->logo)

                            <img
                                src="{{ asset('storage/' . $related->logo) }}"
                                alt="{{ $related->name }}"
                                class="w-full h-full object-cover
                                       group-hover:scale-105
                                       transition-transform duration-500"
                            >

                        @else

                                <div class="w-full h-full bg-dark-100
                                            flex items-center justify-center">

                                    <i class="fas fa-store text-4xl text-dark-300"></i>

                                </div>

                            @endif


                            @if($related->is_featured)

                                <span class="absolute top-3 left-3
                                             px-2.5 py-1 bg-primary
                                             text-white text-[11px]
                                             font-semibold rounded-lg">

                                    <i class="fas fa-star mr-1"></i>

                                    Featured

                                </span>

                            @endif

                        </div>


                        {{-- CONTENT --}}
                        <div class="p-5">

                            <div class="flex items-center gap-2 mb-2">

                                <i class="{{ $related->category?->icon ?? 'fas fa-store' }}
                                          text-primary text-xs"></i>

                                <span class="text-xs text-dark-400">
                                    {{ $related->category?->name ?? 'Business' }}
                                </span>

                            </div>


                            <h3 class="text-base font-bold text-dark-900
                                       group-hover:text-primary
                                       transition-colors line-clamp-1">

                                {{ $related->name }}

                            </h3>


                            @if($related->description)

                            <p class="text-sm text-dark-400 mt-2
                                      line-clamp-2 leading-6">

                                {{ $related->description }}

                            </p>

                        @endif


                            <div class="flex items-center justify-between
                                        mt-4 pt-4 border-t border-gray-100">

                                <div class="flex items-center gap-1">

                                    <i class="fas fa-star text-amber-400 text-xs"></i>

                                    <span class="text-sm font-semibold text-dark-900">

                                        {{ number_format((float) $related->rating, 1) }}

                                    </span>

                                </div>


                                @if($related->city)

                                <span class="text-xs text-dark-400
                                             flex items-center gap-1">

                                    <i class="fas fa-map-marker-alt"></i>

                                    {{ $related->city?->name }}

                                </span>

                            @endif

                            </div>

                        </div>

                    </a>

                @endforeach

            </div>


            <div class="mt-5 sm:hidden">

                <a href="{{ route('listings.index', [
                    'category' => $listing->category?->slug
                ]) }}"
                   class="w-full py-3 rounded-xl border border-gray-200
                          flex items-center justify-center gap-2
                          text-sm font-semibold text-dark-700
                          hover:border-primary hover:text-primary">

                    View All Businesses

                    <i class="fas fa-arrow-right text-xs"></i>

                </a>

            </div>

        </div>

    @endif

</div>


</section>

{{-- =========================================================
CONTACT MODAL
========================================================= --}}

<div id="contactBusinessModal"
     class="hidden fixed inset-0 z-[9999]
            bg-black/60 backdrop-blur-sm
            flex items-center justify-center p-4">


<div class="bg-white rounded-2xl w-full max-w-lg
            shadow-2xl overflow-hidden">

    <div class="flex items-center justify-between
                px-6 py-5 border-b border-gray-100">

        <div>

            <h3 class="text-lg font-bold text-dark-900">
                Send a Message
            </h3>

            <p class="text-xs text-dark-400 mt-1">
                Contact {{ $listing->name }}
            </p>

        </div>

        <button
            type="button"
            onclick="document.getElementById('contactBusinessModal').classList.add('hidden')"
            class="w-9 h-9 rounded-lg hover:bg-gray-100
                   flex items-center justify-center">

            <i class="fas fa-times text-dark-400"></i>

        </button>

    </div>


    <form onsubmit="submitBusinessMessage(event)"
          class="p-6 space-y-4">

        <div>

            <label class="block text-sm font-medium text-dark-700 mb-2">
                Your Name
            </label>

            <input
                type="text"
                required
                class="w-full px-4 py-3 rounded-xl border
                       border-gray-200 focus:border-primary
                       focus:ring-2 focus:ring-primary/10
                       outline-none"
                placeholder="Enter your name">

        </div>


        <div>

            <label class="block text-sm font-medium text-dark-700 mb-2">
                Email Address
            </label>

            <input
                type="email"
                required
                class="w-full px-4 py-3 rounded-xl border
                       border-gray-200 focus:border-primary
                       focus:ring-2 focus:ring-primary/10
                       outline-none"
                placeholder="Enter your email">

        </div>


        <div>

            <label class="block text-sm font-medium text-dark-700 mb-2">
                Message
            </label>

            <textarea
                required
                rows="4"
                class="w-full px-4 py-3 rounded-xl border
                       border-gray-200 focus:border-primary
                       focus:ring-2 focus:ring-primary/10
                       outline-none resize-none"
                placeholder="Write your message"></textarea>

        </div>


        <button
            type="submit"
            class="w-full py-3.5 bg-primary text-white
                   hover:bg-primary-dark rounded-xl
                   font-semibold">

            <i class="fas fa-paper-plane mr-2"></i>

            Send Message

        </button>

    </form>

</div>
```

</div>

{{-- =========================================================
SHARE MODAL
========================================================= --}}

<div id="shareModal"
     class="hidden fixed inset-0 z-[9999]
            bg-black/60 backdrop-blur-sm
            flex items-center justify-center p-4">

```
<div class="bg-white rounded-2xl w-full max-w-sm
            shadow-2xl overflow-hidden">

    <div class="flex items-center justify-between
                px-6 py-5 border-b border-gray-100">

        <h3 class="font-bold text-dark-900">
            Share Business
        </h3>

        <button
            type="button"
            onclick="closeShareModal()"
            class="w-9 h-9 rounded-lg hover:bg-gray-100
                   flex items-center justify-center">

            <i class="fas fa-times text-dark-400"></i>

        </button>

    </div>


    <div class="p-6">

        <p class="text-sm text-dark-400 mb-4">
            Share this business listing with others.
        </p>


        <div class="grid grid-cols-2 gap-3">

            <button
                type="button"
                onclick="shareFacebook()"
                class="py-3 rounded-xl border border-gray-200
                       hover:border-primary hover:text-primary
                       font-semibold text-sm">

                <i class="fab fa-facebook-f mr-2"></i>

                Facebook

            </button>


            <button
                type="button"
                onclick="shareWhatsApp()"
                class="py-3 rounded-xl border border-gray-200
                       hover:border-primary hover:text-primary
                       font-semibold text-sm">

                <i class="fab fa-whatsapp mr-2"></i>

                WhatsApp

            </button>


            <button
                type="button"
                onclick="copyListingLink()"
                class="py-3 rounded-xl border border-gray-200
                       hover:border-primary hover:text-primary
                       font-semibold text-sm">

                <i class="fas fa-link mr-2"></i>

                Copy Link

            </button>


            <button
                type="button"
                onclick="nativeShare()"
                class="py-3 rounded-xl border border-gray-200
                       hover:border-primary hover:text-primary
                       font-semibold text-sm">

                <i class="fas fa-share-alt mr-2"></i>

                More

            </button>

        </div>

    </div>

</div>
```

</div>

{{-- =========================================================
JAVASCRIPT
========================================================= --}}

<script>

function submitBusinessMessage(event)
{
    event.preventDefault();

    alert('Message form is ready. Enquiry system will be connected next.');

    document
        .getElementById('contactBusinessModal')
        .classList.add('hidden');
}


function openShareModal()
{
    document
        .getElementById('shareModal')
        .classList.remove('hidden');
}


function closeShareModal()
{
    document
        .getElementById('shareModal')
        .classList.add('hidden');
}


function shareFacebook()
{
    const url = encodeURIComponent(window.location.href);

    window.open(
        'https://www.facebook.com/sharer/sharer.php?u=' + url,
        '_blank',
        'width=700,height=500'
    );
}


function shareWhatsApp()
{
    const url = encodeURIComponent(window.location.href);

    window.open(
        'https://wa.me/?text=' +
        encodeURIComponent(
            '{{ $listing->name }} - ' + window.location.href
        ),
        '_blank'
    );
}


function copyListingLink()
{
    navigator.clipboard.writeText(window.location.href)
        .then(function () {

            alert('Listing link copied successfully.');

        })
        .catch(function () {

            alert('Unable to copy the link.');

        });
}


function nativeShare()
{
    if (navigator.share) {

        navigator.share({
            title: @json($listing->name),
            text: @json(
                $listing->short_description
                ?? 'Check this business listing'
            ),
            url: window.location.href
        );

    } else {

        copyListingLink();

    }
}


/* Close modal when clicking outside */
document.addEventListener('click', function(event)
{
    const shareModal =
        document.getElementById('shareModal');

    const contactModal =
        document.getElementById('contactBusinessModal');

    if (event.target === shareModal) {

        closeShareModal();

    }

    if (event.target === contactModal) {

        contactModal.classList.add('hidden');

    }
});

</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const tabs = document.querySelectorAll('.business-detail-tab');
    const contents = document.querySelectorAll('.business-detail-content');

    tabs.forEach(tab => {

        tab.addEventListener('click', function () {

            const targetId = this.getAttribute('data-target');

            /* Remove active from all tabs */
            tabs.forEach(item => {
                item.classList.remove('active');
            });

            /* Hide all content */
            contents.forEach(content => {
                content.classList.add('hidden');
            });

            /* Activate clicked tab */
            this.classList.add('active');

            /* Show selected content */
            const target = document.getElementById(targetId);

            if (target) {
                target.classList.remove('hidden');
            }

        });

    });

});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const tabs = document.querySelectorAll('.business-detail-tab');

    const contents = document.querySelectorAll(
        '.business-detail-content'
    );


    tabs.forEach(tab => {

        tab.addEventListener('click', function () {

            const targetId = this.getAttribute('data-target');


            /* Remove active from all tabs */
            tabs.forEach(item => {

                item.classList.remove('active');

            });


            /* Hide all sections */
            contents.forEach(content => {

                content.classList.add('hidden');

            });


            /* Activate clicked tab */
            this.classList.add('active');


            /* Show selected section */
            const target = document.getElementById(targetId);

            if (target) {

                target.classList.remove('hidden');

            }

        });

    });

});
</script>
@endsection
