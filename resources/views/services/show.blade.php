@extends('layouts.main')

@section('title', $service->name . ' | ' . $service->business->name . ' | Lokora')

@section('description', $service->short_description ?: Str::limit($service->description ?? 'Explore this service on Lokora.', 160))

@section('content')

{{-- =========================================================
SERVICE HERO
========================================================= --}}

<section class="bg-dark-900 relative overflow-hidden py-16 lg:py-20">

```
<div class="bg-grid-dark absolute inset-0"></div>

<div class="absolute top-0 right-1/4 w-80 h-80 bg-primary/10 rounded-full blur-3xl"></div>
<div class="absolute bottom-0 left-1/4 w-72 h-72 bg-primary/5 rounded-full blur-3xl"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

    <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">

        {{-- ICON --}}
        <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-primary/10 border border-primary/20 flex items-center justify-center">
            <i class="fas fa-screwdriver-wrench text-2xl text-primary"></i>
        </div>

        <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-primary/10 text-primary text-sm font-semibold rounded-full mb-4">
            <i class="fas fa-layer-group text-xs"></i>
            Service
        </span>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-5">
            {{ $service->name }}
        </h1>

        @if($service->short_description)

            <p class="text-dark-300 max-w-2xl mx-auto leading-relaxed">
                {{ $service->short_description }}
            </p>

        @else

            <p class="text-dark-300 max-w-2xl mx-auto leading-relaxed">
                Explore this service offered by {{ $service->business->name }}.
            </p>

        @endif

        {{-- BREADCRUMB --}}
        <nav class="flex flex-wrap items-center justify-center gap-2 text-sm mt-7">

            <a href="{{ url('/') }}"
               class="text-dark-300 hover:text-primary transition-colors">
                Home
            </a>

            <i class="fas fa-chevron-right text-xs text-dark-500"></i>

            <a href="{{ route('businesses.index') }}"
               class="text-dark-300 hover:text-primary transition-colors">
                Businesses
            </a>

            <i class="fas fa-chevron-right text-xs text-dark-500"></i>

            <a href="{{ route('businesses.show', $service->business) }}"
               class="text-dark-300 hover:text-primary transition-colors">
                {{ $service->business->name }}
            </a>

            <i class="fas fa-chevron-right text-xs text-dark-500"></i>

            <span class="text-primary">
                {{ $service->name }}
            </span>

        </nav>

    </div>

</div>
```

</section>

{{-- =========================================================
SERVICE CONTENT
========================================================= --}}

<section class="py-12 lg:py-16 bg-dark-50 relative overflow-hidden">

```
<div class="bg-grid absolute inset-0"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

    <div class="grid lg:grid-cols-3 gap-6 lg:gap-8">

        {{-- =================================================
            MAIN
        ================================================== --}}
        <div class="lg:col-span-2">

            {{-- =================================================
                TAB NAVIGATION
            ================================================== --}}
            <div
                class="bg-white rounded-2xl border border-gray-100 shadow-sm p-2 mb-6 sticky top-4 z-20"
                data-aos="fade-up"
            >

                <div class="grid grid-cols-3 gap-1">

                    <button
                        type="button"
                        onclick="showServiceTab('overview')"
                        id="service-tab-overview"
                        class="service-tab active flex items-center justify-center gap-2 px-3 py-3.5 rounded-xl text-sm font-semibold transition-all"
                    >
                        <i class="fas fa-circle-info"></i>

                        <span class="hidden sm:inline">
                            Service Overview
                        </span>

                        <span class="sm:hidden">
                            Overview
                        </span>
                    </button>


                    <button
                        type="button"
                        onclick="showServiceTab('information')"
                        id="service-tab-information"
                        class="service-tab flex items-center justify-center gap-2 px-3 py-3.5 rounded-xl text-sm font-semibold transition-all"
                    >
                        <i class="fas fa-list-check"></i>

                        <span class="hidden sm:inline">
                            Key Information
                        </span>

                        <span class="sm:hidden">
                            Information
                        </span>
                    </button>


                    <button
                        type="button"
                        onclick="showServiceTab('choose')"
                        id="service-tab-choose"
                        class="service-tab flex items-center justify-center gap-2 px-3 py-3.5 rounded-xl text-sm font-semibold transition-all"
                    >
                        <i class="fas fa-shield-halved"></i>

                        <span class="hidden sm:inline">
                            Before You Choose
                        </span>

                        <span class="sm:hidden">
                            Before You Choose
                        </span>
                    </button>

                </div>

            </div>


            {{-- =================================================
                TAB 1 — SERVICE OVERVIEW
            ================================================== --}}
            <div
                id="service-panel-overview"
                class="service-panel"
                data-aos="fade-up"
            >

                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">

                    <div class="p-6 sm:p-8 lg:p-10">

                        <div class="flex items-start gap-4 mb-7">

                            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                                <i class="fas fa-circle-info text-primary text-lg"></i>
                            </div>

                            <div>

                                <span class="text-xs font-semibold text-primary uppercase tracking-wider">
                                    Service Overview
                                </span>

                                <h2 class="text-2xl sm:text-3xl font-bold text-dark-900 mt-1">
                                    What You Get
                                </h2>

                            </div>

                        </div>


                        @if($service->description)

                            <div class="text-dark-400 leading-8 whitespace-pre-line">
                                {{ $service->description }}
                            </div>

                        @elseif($service->short_description)

                            <p class="text-dark-400 leading-8">
                                {{ $service->short_description }}
                            </p>

                        @else

                            <p class="text-dark-400 leading-8">
                                Contact the business to learn more about this service.
                            </p>

                        @endif


                        {{-- QUICK HIGHLIGHTS --}}
                        <div class="grid sm:grid-cols-2 gap-4 mt-8 pt-8 border-t border-gray-100">

                            @if($service->price !== null)

                                <div class="flex items-center gap-3 p-4 rounded-2xl bg-dark-50">

                                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                                        <i class="fas fa-indian-rupee-sign text-primary"></i>
                                    </div>

                                    <div>
                                        <p class="text-xs text-dark-400">
                                            Starting Price
                                        </p>

                                        <p class="font-bold text-dark-900">
                                            ₹{{ number_format((float) $service->price, 2) }}
                                        </p>
                                    </div>

                                </div>

                            @endif


                            @if($service->duration)

                                <div class="flex items-center gap-3 p-4 rounded-2xl bg-dark-50">

                                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                                        <i class="far fa-clock text-primary"></i>
                                    </div>

                                    <div>
                                        <p class="text-xs text-dark-400">
                                            Duration
                                        </p>

                                        <p class="font-bold text-dark-900">
                                            {{ $service->duration }}
                                        </p>
                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                TAB 2 — KEY INFORMATION
            ================================================== --}}
            <div
                id="service-panel-information"
                class="service-panel hidden"
            >

                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">

                    <div class="p-6 sm:p-8">

                        <div class="flex items-start gap-4 mb-7">

                            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                                <i class="fas fa-list-check text-primary text-lg"></i>
                            </div>

                            <div>

                                <span class="text-xs font-semibold text-primary uppercase tracking-wider">
                                    Key Information
                                </span>

                                <h2 class="text-2xl sm:text-3xl font-bold text-dark-900 mt-1">
                                    Service Details
                                </h2>

                            </div>

                        </div>


                        <div class="grid sm:grid-cols-2 gap-4">


                            {{-- PRICE --}}
                            @if($service->price !== null)

                                <div class="group border border-gray-100 rounded-2xl p-5 hover:border-primary/30 hover:shadow-md transition-all">

                                    <div class="flex items-center gap-4">

                                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0 group-hover:bg-primary transition-all">
                                            <i class="fas fa-indian-rupee-sign text-primary group-hover:text-white"></i>
                                        </div>

                                        <div>

                                            <p class="text-xs font-semibold text-dark-400 uppercase tracking-wide">
                                                Price
                                            </p>

                                            <p class="text-xl font-bold text-dark-900 mt-1">
                                                ₹{{ number_format((float) $service->price, 2) }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            @endif


                            {{-- DURATION --}}
                            @if($service->duration)

                                <div class="group border border-gray-100 rounded-2xl p-5 hover:border-primary/30 hover:shadow-md transition-all">

                                    <div class="flex items-center gap-4">

                                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0 group-hover:bg-primary transition-all">
                                            <i class="far fa-clock text-primary group-hover:text-white"></i>
                                        </div>

                                        <div>

                                            <p class="text-xs font-semibold text-dark-400 uppercase tracking-wide">
                                                Duration
                                            </p>

                                            <p class="text-xl font-bold text-dark-900 mt-1">
                                                {{ $service->duration }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            @endif


                            {{-- CATEGORY --}}
                            @if($service->business->category)

                                <div class="group border border-gray-100 rounded-2xl p-5 hover:border-primary/30 hover:shadow-md transition-all">

                                    <div class="flex items-center gap-4">

                                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0 group-hover:bg-primary transition-all">
                                            <i class="fas fa-layer-group text-primary group-hover:text-white"></i>
                                        </div>

                                        <div>

                                            <p class="text-xs font-semibold text-dark-400 uppercase tracking-wide">
                                                Category
                                            </p>

                                            <p class="font-bold text-dark-900 mt-1">
                                                {{ $service->business->category->name }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            @endif


                            {{-- SUBCATEGORY --}}
                            @if($service->business->subcategory)

                                <div class="group border border-gray-100 rounded-2xl p-5 hover:border-primary/30 hover:shadow-md transition-all">

                                    <div class="flex items-center gap-4">

                                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0 group-hover:bg-primary transition-all">
                                            <i class="fas fa-tags text-primary group-hover:text-white"></i>
                                        </div>

                                        <div>

                                            <p class="text-xs font-semibold text-dark-400 uppercase tracking-wide">
                                                Subcategory
                                            </p>

                                            <p class="font-bold text-dark-900 mt-1">
                                                {{ $service->business->subcategory->name }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            @endif


                            {{-- LOCATION --}}
                            @if($service->business->city)

                                <div class="group border border-gray-100 rounded-2xl p-5 hover:border-primary/30 hover:shadow-md transition-all">

                                    <div class="flex items-center gap-4">

                                        <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0 group-hover:bg-primary transition-all">
                                            <i class="fas fa-location-dot text-primary group-hover:text-white"></i>
                                        </div>

                                        <div>

                                            <p class="text-xs font-semibold text-dark-400 uppercase tracking-wide">
                                                Location
                                            </p>

                                            <p class="font-bold text-dark-900 mt-1">
                                                {{ $service->business->city->name }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                TAB 3 — BEFORE YOU CHOOSE
            ================================================== --}}
            <div
                id="service-panel-choose"
                class="service-panel hidden"
            >

                <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">

                    <div class="p-6 sm:p-8">

                        <div class="flex items-start gap-4 mb-7">

                            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                                <i class="fas fa-shield-halved text-primary text-lg"></i>
                            </div>

                            <div>

                                <span class="text-xs font-semibold text-primary uppercase tracking-wider">
                                    Before You Choose
                                </span>

                                <h2 class="text-2xl sm:text-3xl font-bold text-dark-900 mt-1">
                                    Things to Know
                                </h2>

                            </div>

                        </div>


                        <div class="grid sm:grid-cols-2 gap-4">


                            <div class="flex gap-3 p-5 rounded-2xl bg-dark-50 border border-gray-100">

                                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                    <i class="fas fa-circle-check"></i>
                                </div>

                                <div>

                                    <h3 class="font-semibold text-dark-900">
                                        Clear Service Details
                                    </h3>

                                    <p class="text-sm text-dark-400 mt-1 leading-6">
                                        Understand what the business offers before contacting them.
                                    </p>

                                </div>

                            </div>


                            <div class="flex gap-3 p-5 rounded-2xl bg-dark-50 border border-gray-100">

                                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                    <i class="fas fa-indian-rupee-sign"></i>
                                </div>

                                <div>

                                    <h3 class="font-semibold text-dark-900">
                                        Check Pricing
                                    </h3>

                                    <p class="text-sm text-dark-400 mt-1 leading-6">
                                        See the listed price and confirm final pricing with the business.
                                    </p>

                                </div>

                            </div>


                            <div class="flex gap-3 p-5 rounded-2xl bg-dark-50 border border-gray-100">

                                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                    <i class="far fa-clock"></i>
                                </div>

                                <div>

                                    <h3 class="font-semibold text-dark-900">
                                        Know the Duration
                                    </h3>

                                    <p class="text-sm text-dark-400 mt-1 leading-6">
                                        Check the expected service duration when provided.
                                    </p>

                                </div>

                            </div>


                            <div class="flex gap-3 p-5 rounded-2xl bg-dark-50 border border-gray-100">

                                <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center shrink-0">
                                    <i class="fas fa-building"></i>
                                </div>

                                <div>

                                    <h3 class="font-semibold text-dark-900">
                                        Explore the Business
                                    </h3>

                                    <p class="text-sm text-dark-400 mt-1 leading-6">
                                        View the complete business profile before making a decision.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- BACK --}}
            <div class="mt-6">

                <a
                    href="{{ route('businesses.show', $service->business) }}"
                    class="inline-flex items-center gap-2 px-5 py-3 bg-white border border-gray-200 hover:border-primary hover:text-primary text-dark-700 font-semibold rounded-xl transition-all"
                >
                    <i class="fas fa-arrow-left text-sm"></i>
                    Back to Business
                </a>

            </div>

        </div>


        {{-- =================================================
            SIDEBAR
        ================================================== --}}
        <div class="space-y-6">

            {{-- BUSINESS CARD --}}
            <div
                class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 sm:p-7"
                data-aos="fade-up"
            >

                <span class="inline-flex items-center gap-2 px-3 py-1 bg-primary/5 text-primary text-xs font-semibold rounded-full mb-4">
                    <i class="fas fa-building"></i>
                    Offered By
                </span>

                <h2 class="text-2xl font-bold text-dark-900">
                    {{ $service->business->name }}
                </h2>

                @if($service->business->tagline)

                    <p class="text-dark-400 mt-2 leading-relaxed">
                        {{ $service->business->tagline }}
                    </p>

                @endif


                {{-- LOCATION --}}
                @if(
                    $service->business->area ||
                    $service->business->city ||
                    $service->business->state
                )

                    <div class="flex items-start gap-3 mt-6 pt-6 border-t border-gray-100">

                        <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                            <i class="fas fa-location-dot text-primary"></i>
                        </div>

                        <div class="text-sm text-dark-400 leading-6">

                            @if($service->business->area)
                                {{ $service->business->area->name }},
                            @endif

                            @if($service->business->city)
                                {{ $service->business->city->name }},
                            @endif

                            @if($service->business->state)
                                {{ $service->business->state->name }}
                            @endif

                            @if($service->business->country)
                                {{ $service->business->country->name }}
                            @endif

                        </div>

                    </div>

                @endif


                <a
                    href="{{ route('businesses.show', $service->business) }}"
                    class="mt-6 w-full inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition-all shadow-lg shadow-primary/20"
                >
                    View Business
                    <i class="fas fa-arrow-right text-sm"></i>
                </a>

            </div>


            {{-- CONTACT --}}
            @if(
                $service->business->phone ||
                $service->business->email ||
                $service->business->website
            )

                <div
                    class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 sm:p-7"
                    data-aos="fade-up"
                >

                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-primary/5 text-primary text-xs font-semibold rounded-full mb-4">
                        <i class="fas fa-headset"></i>
                        Contact
                    </span>

                    <h2 class="text-2xl font-bold text-dark-900">
                        Get in Touch
                    </h2>


                    @if($service->business->phone)

                        <a
                            href="tel:{{ $service->business->phone }}"
                            class="flex items-center gap-3 mt-5 text-dark-400 hover:text-primary transition-colors"
                        >

                            <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                                <i class="fas fa-phone text-primary"></i>
                            </div>

                            <span class="text-sm">
                                {{ $service->business->phone }}
                            </span>

                        </a>

                    @endif


                    @if($service->business->email)

                        <a
                            href="mailto:{{ $service->business->email }}"
                            class="flex items-center gap-3 mt-3 text-dark-400 hover:text-primary transition-colors"
                        >

                            <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                                <i class="fas fa-envelope text-primary"></i>
                            </div>

                            <span class="text-sm break-all">
                                {{ $service->business->email }}
                            </span>

                        </a>

                    @endif


                    @if($service->business->website)

                        <a
                            href="{{ $service->business->website }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex items-center gap-3 mt-3 text-dark-400 hover:text-primary transition-colors"
                        >

                            <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                                <i class="fas fa-globe text-primary"></i>
                            </div>

                            <span class="text-sm">
                                Visit Website
                            </span>

                        </a>

                    @endif

                </div>

            @endif

        </div>

    </div>


    {{-- =================================================
        ACTION CARD
    ================================================== --}}
    <div
        class="mt-8 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden"
        data-aos="fade-up"
    >

        <div class="p-6 sm:p-8">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                {{-- LEFT --}}
                <div>

                    <div class="flex items-center gap-2 text-primary text-sm font-semibold mb-2">

                        <i class="fas fa-paper-plane"></i>

                        <span>
                            Interested in this service?
                        </span>

                    </div>

                    <h2 class="text-2xl sm:text-3xl font-bold text-dark-900">
                        Ready to Get Started?
                    </h2>

                    <p class="text-sm text-dark-500 mt-2 max-w-2xl leading-6">
                        Contact
                        <span class="font-semibold text-dark-700">
                            {{ $service->business->name }}
                        </span>
                        to discuss this service, pricing and availability.
                    </p>

                </div>


                {{-- ACTIONS --}}
                <div class="flex flex-col sm:flex-row gap-3 shrink-0">

                    {{-- BOOK --}}
                    <a
                        href="{{ route('bookings.create', $service->business) }}"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-primary text-white font-semibold hover:bg-primary-dark transition-all shadow-lg shadow-primary/20"
                    >
                        <i class="fas fa-calendar-check"></i>
                        Book Appointment
                    </a>


                    {{-- ENQUIRY / EMAIL --}}
                    @if($service->business->email)

                        <a
                            href="mailto:{{ $service->business->email }}?subject={{ urlencode('Enquiry about ' . $service->name) }}"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl border border-gray-200 text-dark-700 font-semibold hover:border-primary hover:text-primary transition-all"
                        >
                            <i class="fas fa-envelope"></i>
                            Send Enquiry
                        </a>

                    @elseif($service->business->phone)

                        <a
                            href="tel:{{ $service->business->phone }}"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl border border-gray-200 text-dark-700 font-semibold hover:border-primary hover:text-primary transition-all"
                        >
                            <i class="fas fa-phone"></i>
                            Contact Business
                        </a>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>
```

</section>

{{-- =========================================================
TAB SCRIPT + STYLE
========================================================= --}}
@push('scripts')

<script>
function showServiceTab(tab) {

    const panels = [
        'overview',
        'information',
        'choose'
    ];

    panels.forEach(function(item) {

        const panel = document.getElementById(
            'service-panel-' + item
        );

        const button = document.getElementById(
            'service-tab-' + item
        );

        if (!panel || !button) {
            return;
        }

        if (item === tab) {

            panel.classList.remove('hidden');

            button.classList.add(
                'bg-primary',
                'text-white',
                'shadow-md'
            );

            button.classList.remove(
                'text-dark-500',
                'hover:bg-dark-50'
            );

        } else {

            panel.classList.add('hidden');

            button.classList.remove(
                'bg-primary',
                'text-white',
                'shadow-md'
            );

            button.classList.add(
                'text-dark-500',
                'hover:bg-dark-50'
            );

        }

    });

}
</script>

@endpush

@endsection
