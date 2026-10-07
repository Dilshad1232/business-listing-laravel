@extends('layouts.main')

@section('title', 'Businesses | Lokora')

@section('description', 'Explore trusted businesses, services and professionals on Lokora.')

@section('content')

{{-- =========================================================
    PAGE HEADER
========================================================= --}}
<section class="bg-dark-900 relative overflow-hidden py-16 lg:py-20">

    <div class="bg-grid-dark absolute inset-0"></div>

    <div class="absolute top-0 right-1/4 w-80 h-80 bg-primary/10 rounded-full blur-3xl"></div>

    <div class="absolute bottom-0 left-1/4 w-72 h-72 bg-primary/5 rounded-full blur-3xl"></div>


    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        <div
            class="text-center"
            data-aos="fade-up"
        >

            {{-- ICON --}}
            <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-primary/10 border border-primary/20 flex items-center justify-center">

                <i class="fas fa-building text-2xl text-primary"></i>

            </div>


            {{-- TITLE --}}
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">

                Explore Businesses

            </h1>


            <p class="text-dark-300 max-w-2xl mx-auto mb-6">

                Discover trusted businesses, professional services and local experts
                from different categories and locations.

            </p>


            {{-- BREADCRUMB --}}
            <nav class="flex flex-wrap items-center justify-center gap-2 text-sm">

                <a
                    href="{{ url('/') }}"
                    class="text-dark-300 hover:text-primary transition-colors"
                >
                    Home
                </a>

                <i class="fas fa-chevron-right text-xs text-dark-500"></i>

                <span class="text-primary">
                    Businesses
                </span>

            </nav>

        </div>

    </div>

</section>


{{-- =========================================================
    BUSINESS SECTION
========================================================= --}}
<section class="py-16 lg:py-20 bg-dark-50 relative overflow-hidden">

    <div class="bg-grid absolute inset-0"></div>


    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">


        {{-- =====================================================
            TOP INTRO
        ====================================================== --}}
        <div
            class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-10"
            data-aos="fade-up"
        >

            <div>

                <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">

                    Discover & Connect

                </span>


                <h2 class="text-3xl sm:text-4xl font-bold text-dark-900">

                    Find the Right Business

                </h2>


                <p class="text-dark-400 mt-3 max-w-xl">

                    Browse verified businesses and services available on Lokora.

                </p>

            </div>


            {{-- COUNT --}}
            <div class="flex items-center gap-2 text-sm text-dark-400">

                <span class="w-9 h-9 rounded-xl bg-primary/10 flex items-center justify-center">

                    <i class="fas fa-building text-primary text-sm"></i>

                </span>

                <span>

                    <strong class="text-dark-900">
                        {{ $businesses->total() }}
                    </strong>

                    {{ $businesses->total() == 1 ? 'Business' : 'Businesses' }}

                </span>

            </div>

        </div>


    {{-- =====================================================
    PREMIUM SEARCH & FILTER
====================================================== --}}
<div
class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-10"
data-aos="fade-up"
>

{{-- FILTER HEADER --}}
<div class="px-5 sm:px-6 py-5 border-b border-gray-100">

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div class="flex items-center gap-3">

            <div class="w-11 h-11 rounded-xl bg-primary/10 flex items-center justify-center">

                <i class="fas fa-sliders-h text-primary"></i>

            </div>

            <div>

                <h3 class="text-base sm:text-lg font-semibold text-dark-900">
                    Find Businesses
                </h3>

                <p class="text-xs sm:text-sm text-dark-400 mt-0.5">
                    Search and filter businesses by your needs
                </p>

            </div>

        </div>


        @if(
            request('search') ||
            request('category') ||
            request('subcategory') ||
            request('country') ||
            request('state') ||
            request('city') ||
            request('rating') ||
            request('featured') ||
            request('sort')
        )

            <a
                href="{{ route('businesses.index') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-dark-50 hover:bg-red-50 text-dark-400 hover:text-red-500 text-sm font-medium transition-all"
            >

                <i class="fas fa-times text-xs"></i>

                Clear Filters

            </a>

        @endif

    </div>

</div>


{{-- FILTER FORM --}}
<form
    action="{{ route('businesses.index') }}"
    method="GET"
    class="p-5 sm:p-6"
>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-4">


   {{-- SEARCH --}}
<div class="sm:col-span-2 lg:col-span-5">

    <label class="block text-sm font-semibold text-dark-900 mb-2">
        Search Business
    </label>

    <div class="relative">

        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-dark-300"></i>

        <input
            id="businessSearchInput"
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Business name, service, keyword..."
            autocomplete="off"
            class="w-full pl-11 pr-4 py-3.5 bg-dark-50 border border-gray-100 rounded-xl text-sm text-dark-900 placeholder-dark-300 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
        >

        <div
            id="businessSearchSuggestions"
            class="absolute left-0 right-0 top-full mt-2 z-50 hidden
                   overflow-hidden rounded-2xl border border-gray-200
                   bg-white shadow-2xl"
        ></div>

    </div>

</div>

        {{-- CATEGORY --}}
        <div class="lg:col-span-3">

            <label class="block text-sm font-semibold text-dark-900 mb-2">
                Category
            </label>

            <select
                name="category"
                id="businessCategory"
                class="w-full px-4 py-3.5 bg-dark-50 border border-gray-100 rounded-xl text-sm text-dark-900 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
            >

                <option value="">
                    All Categories
                </option>

                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        @selected(request('category') == $category->id)
                    >
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>

        </div>


        {{-- SUBCATEGORY --}}
        <div class="lg:col-span-4">

            <label class="block text-sm font-semibold text-dark-900 mb-2">
                Subcategory
            </label>

            <select
                name="subcategory"
                id="businessSubcategory"
                class="w-full px-4 py-3.5 bg-dark-50 border border-gray-100 rounded-xl text-sm text-dark-900 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
            >

                <option value="">
                    All Subcategories
                </option>

                @foreach($subcategories as $subcategory)

                    <option
                        value="{{ $subcategory->id }}"
                        data-category="{{ $subcategory->category_id }}"
                        @selected(request('subcategory') == $subcategory->id)
                    >
                        {{ $subcategory->name }}
                    </option>

                @endforeach

            </select>

        </div>


        {{-- COUNTRY --}}
        <div class="lg:col-span-3">

            <label class="block text-sm font-semibold text-dark-900 mb-2">
                Country
            </label>

            <select
                name="country"
                id="businessCountry"
                class="w-full px-4 py-3.5 bg-dark-50 border border-gray-100 rounded-xl text-sm text-dark-900 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
            >

                <option value="">
                    All Countries
                </option>

                @foreach($countries as $country)

                    <option
                        value="{{ $country->id }}"
                        @selected(request('country') == $country->id)
                    >
                        {{ $country->name }}
                    </option>

                @endforeach

            </select>

        </div>


        {{-- STATE --}}
        <div class="lg:col-span-3">

            <label class="block text-sm font-semibold text-dark-900 mb-2">
                State
            </label>

            <select
                name="state"
                id="businessState"
                class="w-full px-4 py-3.5 bg-dark-50 border border-gray-100 rounded-xl text-sm text-dark-900 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
            >

                <option value="">
                    All States
                </option>

                @foreach($states as $state)

                <option
                    value="{{ $state->id }}"
                    data-country="{{ $state->country_id }}"
                    @selected(request('state') == $state->id)
                >
                    {{ $state->name }}
                </option>

            @endforeach

            </select>

        </div>


        {{-- CITY --}}
        <div class="lg:col-span-3">

            <label class="block text-sm font-semibold text-dark-900 mb-2">
                City
            </label>

            <select
                name="city"
                id="businessCity"
                class="w-full px-4 py-3.5 bg-dark-50 border border-gray-100 rounded-xl text-sm text-dark-900 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
            >

                <option value="">
                    All Cities
                </option>

                @foreach($cities as $city)

                <option
                    value="{{ $city->id }}"
                    data-country="{{ $city->country_id }}"
                    data-state="{{ $city->state_id }}"
                    @selected(request('city') == $city->id)
                >
                    {{ $city->name }}
                </option>

            @endforeach

            </select>

        </div>


        {{-- RATING --}}
        <div class="lg:col-span-3">

            <label class="block text-sm font-semibold text-dark-900 mb-2">
                Minimum Rating
            </label>

            <select
                name="rating"
                class="w-full px-4 py-3.5 bg-dark-50 border border-gray-100 rounded-xl text-sm text-dark-900 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
            >

                <option value="">
                    Any Rating
                </option>

                <option value="4" @selected(request('rating') == '4')>
                    ⭐ 4.0+ Rating
                </option>

                <option value="3" @selected(request('rating') == '3')>
                    ⭐ 3.0+ Rating
                </option>

                <option value="2" @selected(request('rating') == '2')>
                    ⭐ 2.0+ Rating
                </option>

                <option value="1" @selected(request('rating') == '1')>
                    ⭐ 1.0+ Rating
                </option>

            </select>

        </div>


        {{-- SORT --}}
        <div class="lg:col-span-4">

            <label class="block text-sm font-semibold text-dark-900 mb-2">
                Sort By
            </label>

            <select
                name="sort"
                class="w-full px-4 py-3.5 bg-dark-50 border border-gray-100 rounded-xl text-sm text-dark-900 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/10 transition-all"
            >

                <option value="">
                    Newest First
                </option>

                <option
                    value="featured"
                    @selected(request('sort') == 'featured')
                >
                    Featured First
                </option>

                <option
                    value="rating_high"
                    @selected(request('sort') == 'rating_high')
                >
                    Highest Rated
                </option>

                <option
                    value="reviews_high"
                    @selected(request('sort') == 'reviews_high')
                >
                    Most Reviewed
                </option>

                <option
                    value="name_az"
                    @selected(request('sort') == 'name_az')
                >
                    Name A → Z
                </option>

                <option
                    value="name_za"
                    @selected(request('sort') == 'name_za')
                >
                    Name Z → A
                </option>

                <option
                    value="oldest"
                    @selected(request('sort') == 'oldest')
                >
                    Oldest First
                </option>

            </select>

        </div>


        {{-- FEATURED --}}
        <div class="lg:col-span-3 flex items-end">

            <label
                class="w-full min-h-[52px] flex items-center gap-3 px-4 py-3 bg-dark-50 border border-gray-100 rounded-xl cursor-pointer hover:border-primary/30 transition-all"
            >

                <input
                    type="checkbox"
                    name="featured"
                    value="1"
                    @checked(request('featured') == '1')
                    class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary"
                >

                <span class="flex items-center gap-2 text-sm font-medium text-dark-700">

                    <i class="fas fa-star text-yellow-400"></i>

                    Featured Only

                </span>

            </label>

        </div>


        {{-- SEARCH BUTTON --}}
        <div class="lg:col-span-2 flex items-end">

            <button
                type="submit"
                class="w-full min-h-[52px] inline-flex items-center justify-center gap-2 px-5 py-3.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition-all shadow-lg shadow-primary/20"
            >

                <i class="fas fa-search"></i>

                Search

            </button>

        </div>

    </div>


    {{-- ACTIVE FILTERS --}}
    @if(
        request('search') ||
        request('category') ||
        request('subcategory') ||
        request('country') ||
        request('state') ||
        request('city') ||
        request('rating') ||
        request('featured') ||
        request('sort')
    )

        <div class="flex flex-wrap items-center gap-2 mt-6 pt-5 border-t border-gray-100">

            <span class="text-xs sm:text-sm font-medium text-dark-400 mr-1">
                Active filters:
            </span>


            @if(request('search'))

                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary/5 text-primary text-xs font-medium rounded-lg">

                    <i class="fas fa-search"></i>

                    {{ request('search') }}

                </span>

            @endif


            @if(request('category'))

                @php
                    $selectedCategory = $categories->firstWhere(
                        'id',
                        request('category')
                    );
                @endphp

                @if($selectedCategory)

                    <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary/5 text-primary text-xs font-medium rounded-lg">

                        <i class="fas fa-layer-group"></i>

                        {{ $selectedCategory->name }}

                    </span>

                @endif

            @endif


            @if(request('subcategory'))

                @php
                    $selectedSubcategory = $subcategories->firstWhere(
                        'id',
                        request('subcategory')
                    );
                @endphp

                @if($selectedSubcategory)

                    <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary/5 text-primary text-xs font-medium rounded-lg">

                        <i class="fas fa-list"></i>

                        {{ $selectedSubcategory->name }}

                    </span>

                @endif

            @endif


            @if(request('country'))

                @php
                    $selectedCountry = $countries->firstWhere(
                        'id',
                        request('country')
                    );
                @endphp

                @if($selectedCountry)

                    <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary/5 text-primary text-xs font-medium rounded-lg">

                        <i class="fas fa-globe"></i>

                        {{ $selectedCountry->name }}

                    </span>

                @endif

            @endif


            @if(request('state'))

                @php
                    $selectedState = $states->firstWhere(
                        'id',
                        request('state')
                    );
                @endphp

                @if($selectedState)

                    <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary/5 text-primary text-xs font-medium rounded-lg">

                        <i class="fas fa-map"></i>

                        {{ $selectedState->name }}

                    </span>

                @endif

            @endif


            @if(request('city'))

                @php
                    $selectedCity = $cities->firstWhere(
                        'id',
                        request('city')
                    );
                @endphp

                @if($selectedCity)

                    <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-primary/5 text-primary text-xs font-medium rounded-lg">

                        <i class="fas fa-location-dot"></i>

                        {{ $selectedCity->name }}

                    </span>

                @endif

            @endif


            @if(request('rating'))

                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-yellow-50 text-yellow-600 text-xs font-medium rounded-lg">

                    <i class="fas fa-star"></i>

                    {{ request('rating') }}+ Rating

                </span>

            @endif


            @if(request('featured'))

                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-orange-50 text-orange-600 text-xs font-medium rounded-lg">

                    <i class="fas fa-fire"></i>

                    Featured

                </span>

            @endif


            @if(request('sort'))

                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-dark-50 text-dark-500 text-xs font-medium rounded-lg">

                    <i class="fas fa-arrow-down-wide-short"></i>

                    Sorted

                </span>

            @endif

        </div>

    @endif

</form>

</div>


{{-- =====================================================
SUBCATEGORY FILTER SCRIPT
====================================================== --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

const categorySelect = document.getElementById('businessCategory');
const subcategorySelect = document.getElementById('businessSubcategory');

if (!categorySelect || !subcategorySelect) {
    return;
}


const allOptions = Array.from(
    subcategorySelect.querySelectorAll('option[data-category]')
);


function filterSubcategories() {

    const selectedCategory = categorySelect.value;
    const selectedSubcategory = "{{ request('subcategory') }}";


    allOptions.forEach(option => {

        const optionCategory = option.dataset.category;

        const shouldShow =
            !selectedCategory ||
            optionCategory === selectedCategory;


        option.hidden = !shouldShow;

    });


    if (
        selectedSubcategory &&
        allOptions.some(option =>
            option.value === selectedSubcategory &&
            !option.hidden
        )
    ) {

        subcategorySelect.value = selectedSubcategory;

    } else {

        if (
            subcategorySelect.value &&
            allOptions.some(option =>
                option.value === subcategorySelect.value &&
                option.hidden
            )
        ) {

            subcategorySelect.value = '';

        }

    }

}


categorySelect.addEventListener(
    'change',
    filterSubcategories
);


filterSubcategories();

});

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const countrySelect = document.getElementById('businessCountry');
        const stateSelect = document.getElementById('businessState');
        const citySelect = document.getElementById('businessCity');

        if (!countrySelect || !stateSelect || !citySelect) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | STORE ORIGINAL OPTIONS
        |--------------------------------------------------------------------------
        */

        const allStateOptions = Array.from(
            stateSelect.querySelectorAll('option[data-country]')
        );

        const allCityOptions = Array.from(
            citySelect.querySelectorAll('option[data-state]')
        );


        /*
        |--------------------------------------------------------------------------
        | CURRENT FILTER VALUES
        |--------------------------------------------------------------------------
        */

        const selectedCountry = "{{ request('country') }}";
        const selectedState = "{{ request('state') }}";
        const selectedCity = "{{ request('city') }}";


        /*
        |--------------------------------------------------------------------------
        | FILTER STATES
        |--------------------------------------------------------------------------
        */

        function filterStates() {

            const countryId = countrySelect.value;

            stateSelect.value = '';

            allStateOptions.forEach(option => {

                const optionCountry = option.dataset.country;

                option.hidden =
                    countryId &&
                    optionCountry !== countryId;

            });


            if (selectedState) {

                const selectedOption = allStateOptions.find(
                    option =>
                        option.value === selectedState &&
                        !option.hidden
                );

                if (selectedOption) {
                    stateSelect.value = selectedState;
                }

            }


            filterCities();

        }


        /*
        |--------------------------------------------------------------------------
        | FILTER CITIES
        |--------------------------------------------------------------------------
        */

        function filterCities() {

            const stateId = stateSelect.value;
            const countryId = countrySelect.value;

            citySelect.value = '';


            allCityOptions.forEach(option => {

                const optionState = option.dataset.state;
                const optionCountry = option.dataset.country;

                let shouldShow = true;


                if (stateId) {

                    shouldShow =
                        optionState === stateId;

                } else if (countryId) {

                    shouldShow =
                        optionCountry === countryId;

                }


                option.hidden = !shouldShow;

            });


            if (selectedCity) {

                const selectedOption = allCityOptions.find(
                    option =>
                        option.value === selectedCity &&
                        !option.hidden
                );

                if (selectedOption) {
                    citySelect.value = selectedCity;
                }

            }

        }


        /*
        |--------------------------------------------------------------------------
        | EVENTS
        |--------------------------------------------------------------------------
        */

        countrySelect.addEventListener(
            'change',
            function () {

                selectedStateValueReset();

                filterStates();

            }
        );


        stateSelect.addEventListener(
            'change',
            function () {

                filterCities();

            }
        );


        function selectedStateValueReset() {

            stateSelect.value = '';
            citySelect.value = '';

        }


        /*
        |--------------------------------------------------------------------------
        | INITIAL LOAD
        |--------------------------------------------------------------------------
        */

        filterStates();

    });
    </script>

        {{-- =====================================================
            BUSINESS GRID
        ====================================================== --}}
        @if($businesses->count())

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 lg:gap-6">

                @foreach($businesses as $business)

                    <article
                        class="group bg-white rounded-2xl border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-primary/20"
                        data-aos="fade-up"
                        data-aos-delay="{{ ($loop->index % 4) * 80 }}"
                    >

                      {{-- COVER + LOGO --}}
<div class="relative h-48 bg-dark-50 overflow-hidden">

    {{-- Cover Image --}}
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


    {{-- FEATURED --}}
    @if($business->is_featured)

        <span class="absolute top-4 left-4 inline-flex items-center gap-1.5 px-3 py-1.5 bg-primary text-white text-xs font-semibold rounded-lg shadow-lg">

            <i class="fas fa-star"></i>

            Featured

        </span>

    @endif


    {{-- RATING --}}
    <div class="absolute top-4 right-4 flex items-center gap-1 px-2.5 py-1.5 bg-dark-900/80 backdrop-blur-sm text-white text-xs font-semibold rounded-lg">

        <i class="fas fa-star text-yellow-400"></i>

        {{ number_format((float) $business->rating, 1) }}

    </div>


    {{-- LOGO --}}
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

                <i class="fas fa-building text-xl text-dark-300"></i>

            </div>

        @endif

    </div>

</div>

                        {{-- CONTENT --}}
                        <div class="p-5">


                            {{-- CATEGORY --}}
                            @if($business->category)

                                <div class="flex items-center gap-2 text-xs font-semibold text-primary mb-2">

                                    <i class="fas fa-layer-group"></i>

                                    <span>
                                        {{ $business->category->name }}
                                    </span>

                                </div>

                            @endif


                            {{-- NAME --}}
                            <h3 class="text-lg font-semibold text-dark-900 group-hover:text-primary transition-colors">

                                <a
                                    href="{{ route('businesses.show', $business->slug) }}"
                                >

                                    {{ $business->name }}

                                </a>

                            </h3>


                            {{-- SUBCATEGORY --}}
                            @if($business->subcategory)

                                <p class="text-xs text-dark-400 mt-1">

                                    {{ $business->subcategory->name }}

                                </p>

                            @endif


                            {{-- DESCRIPTION --}}
                            <p class="text-sm text-dark-400 mt-3 line-clamp-3 min-h-[60px]">

                                {{ $business->description
                                    ? \Illuminate\Support\Str::limit($business->description, 100)
                                    : 'Discover more information about this business on Lokora.'
                                }}

                            </p>


                            {{-- LOCATION --}}
                            @if($business->city || $business->state)

                                <div class="flex items-center gap-2 mt-4 text-xs text-dark-400">

                                    <i class="fas fa-location-dot text-primary"></i>

                                    <span>

                                        {{ $business->city?->name }}

                                        @if($business->state)
                                            , {{ $business->state->name }}
                                        @endif

                                    </span>

                                </div>

                            @endif


                            {{-- FOOTER --}}
                            <div class="flex items-center justify-between mt-5 pt-4 border-t border-gray-100">

                                <div class="flex items-center gap-2">

                                    <span class="text-yellow-400">

                                        <i class="fas fa-star text-xs"></i>

                                    </span>

                                    <span class="text-sm font-semibold text-dark-900">

                                        {{ number_format((float) $business->rating, 1) }}

                                    </span>

                                    <span class="text-xs text-dark-300">

                                        ({{ $business->reviews_count }})

                                    </span>

                                </div>


                                <a
                                    href="{{ route('businesses.show', $business->slug) }}"
                                    class="w-9 h-9 rounded-full border border-gray-200 flex items-center justify-center text-dark-300 group-hover:bg-primary group-hover:border-primary group-hover:text-white transition-all"
                                    aria-label="View {{ $business->name }}"
                                >

                                    <i class="fas fa-arrow-right text-xs"></i>

                                </a>

                            </div>

                        </div>

                    </article>

                @endforeach

            </div>


            {{-- =================================================
                PAGINATION
            ================================================== --}}
            @if($businesses->lastPage() > 1)

                <div
                    class="flex flex-wrap items-center justify-center gap-2 mt-12"
                    data-aos="fade-up"
                >

                    {{-- PREVIOUS --}}
                    @if($businesses->onFirstPage())

                        <span class="w-10 h-10 rounded-xl bg-white border border-gray-100 text-dark-200 flex items-center justify-center cursor-not-allowed">

                            <i class="fas fa-chevron-left text-xs"></i>

                        </span>

                    @else

                        <a
                            href="{{ $businesses->previousPageUrl() }}"
                            class="w-10 h-10 rounded-xl bg-white border border-gray-200 text-dark-400 hover:bg-primary hover:border-primary hover:text-white flex items-center justify-center transition-all"
                        >

                            <i class="fas fa-chevron-left text-xs"></i>

                        </a>

                    @endif


                    {{-- PAGE NUMBERS --}}
                    @for($page = 1; $page <= $businesses->lastPage(); $page++)

                        @if($page == $businesses->currentPage())

                            <span class="w-10 h-10 rounded-xl bg-primary text-white flex items-center justify-center text-sm font-semibold shadow-lg shadow-primary/20">

                                {{ $page }}

                            </span>

                        @else

                            <a
                                href="{{ $businesses->url($page) }}"
                                class="w-10 h-10 rounded-xl bg-white border border-gray-200 text-dark-400 hover:bg-primary hover:border-primary hover:text-white flex items-center justify-center text-sm transition-all"
                            >

                                {{ $page }}

                            </a>

                        @endif

                    @endfor


                    {{-- NEXT --}}
                    @if($businesses->hasMorePages())

                        <a
                            href="{{ $businesses->nextPageUrl() }}"
                            class="w-10 h-10 rounded-xl bg-white border border-gray-200 text-dark-400 hover:bg-primary hover:border-primary hover:text-white flex items-center justify-center transition-all"
                        >

                            <i class="fas fa-chevron-right text-xs"></i>

                        </a>

                    @else

                        <span class="w-10 h-10 rounded-xl bg-white border border-gray-100 text-dark-200 flex items-center justify-center cursor-not-allowed">

                            <i class="fas fa-chevron-right text-xs"></i>

                        </span>

                    @endif

                </div>

            @endif


        @else

            {{-- =================================================
                EMPTY STATE
            ================================================== --}}
            <div
                class="bg-white rounded-2xl border border-gray-100 p-10 sm:p-16 text-center"
                data-aos="fade-up"
            >

                <div class="w-20 h-20 mx-auto rounded-2xl bg-primary/10 flex items-center justify-center mb-6">

                    <i class="fas fa-building text-2xl text-primary"></i>

                </div>


                <h3 class="text-xl font-semibold text-dark-900 mb-2">

                    No Businesses Found

                </h3>


                <p class="text-dark-400 max-w-md mx-auto mb-6">

                    Try searching with a different business name or category.

                </p>


                <a
                    href="{{ route('businesses.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition-all shadow-lg shadow-primary/20"
                >

                    <i class="fas fa-rotate-left text-sm"></i>

                    View All Businesses

                </a>

            </div>

        @endif

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

                Explore Lokora

            </span>


            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-5">

                Discover Your Next Business

            </h2>


            <p class="text-white/60 max-w-2xl mx-auto mb-8">

                Find trusted businesses, services and professionals
                across different categories and locations.

            </p>


            <a
                href="{{ route('categories.index') }}"
                class="inline-flex items-center gap-2 px-7 py-3.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition-all shadow-lg shadow-primary/25"
            >

                <i class="fas fa-layer-group"></i>

                Browse Categories

            </a>

        </div>

    </div>

</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const searchInput = document.getElementById('businessSearchInput');
        const suggestionsBox = document.getElementById('businessSearchSuggestions');

        if (!searchInput || !suggestionsBox) {
            return;
        }

        let searchTimer = null;

        searchInput.addEventListener('input', function () {

            const query = this.value.trim();

            clearTimeout(searchTimer);

            if (query.length < 2) {
                suggestionsBox.innerHTML = '';
                suggestionsBox.classList.add('hidden');
                return;
            }

            searchTimer = setTimeout(() => {

                fetch(`{{ route('businesses.suggestions') }}?q=${encodeURIComponent(query)}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(results => {

                    if (!results.length) {

                        suggestionsBox.innerHTML = `
                            <div class="px-5 py-4 text-sm text-gray-500">
                                No businesses found for
                                <span class="font-semibold text-gray-700">
                                    "${query}"
                                </span>
                            </div>
                        `;

                        suggestionsBox.classList.remove('hidden');

                        return;
                    }

                    suggestionsBox.innerHTML = results.map(business => {

                        const location = [
                            business.city,
                            business.state
                        ].filter(Boolean).join(', ');

                        const category = [
                            business.category,
                            business.subcategory
                        ].filter(Boolean).join(' • ');

                        return `
                            <a
                                href="${business.url}"
                                class="flex items-center gap-4 px-5 py-4
                                       border-b border-gray-100 last:border-0
                                       hover:bg-gray-50 transition"
                            >

                                <div
                                    class="flex-shrink-0 w-11 h-11 rounded-xl
                                           bg-indigo-50 text-indigo-600
                                           flex items-center justify-center"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 21h18M5 21V7a2 2 0 012-2h10a2 2 0 012 2v14M9 9h1m-1 4h1m4-4h1m-1 4h1M9 21v-4h6v4"
                                        />
                                    </svg>
                                </div>

                                <div class="min-w-0 flex-1">

                                    <div class="font-semibold text-gray-900 truncate">
                                        ${business.name}
                                    </div>

                                    ${
                                        category
                                            ? `
                                                <div class="text-xs text-gray-500 mt-1 truncate">
                                                    ${category}
                                                </div>
                                              `
                                            : ''
                                    }

                                    ${
                                        location
                                            ? `
                                                <div class="text-xs text-gray-400 mt-1 truncate">
                                                    ${location}
                                                </div>
                                              `
                                            : ''
                                    }

                                </div>

                                <div class="text-gray-300">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="w-5 h-5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 5l7 7-7 7"
                                        />
                                    </svg>
                                </div>

                            </a>
                        `;

                    }).join('');

                    suggestionsBox.classList.remove('hidden');

                })
                .catch(error => {

                    console.error('Search suggestion error:', error);

                    suggestionsBox.innerHTML = '';
                    suggestionsBox.classList.add('hidden');

                });

            }, 300);

        });


        // Close suggestions when clicking outside
        document.addEventListener('click', function (event) {

            if (
                !searchInput.contains(event.target) &&
                !suggestionsBox.contains(event.target)
            ) {
                suggestionsBox.classList.add('hidden');
            }

        });


        // Show suggestions again when input gets focus
        searchInput.addEventListener('focus', function () {

            if (
                this.value.trim().length >= 2 &&
                suggestionsBox.innerHTML.trim() !== ''
            ) {
                suggestionsBox.classList.remove('hidden');
            }

        });

    });
    </script>
@endsection
