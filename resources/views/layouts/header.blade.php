  <!-- Preloader -->
  <div class="preloader">
    <div class="w-10 h-10 border-4 border-primary/20 border-t-primary rounded-full animate-spin"></div>
  </div>

  <!-- ===== NAVBAR ===== -->
  <nav class="nav-sticky fixed top-0 inset-x-0 z-50 transition-all" id="mainNav">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex-shrink-0">

            @if($websiteSettings && $websiteSettings->logo)

                <img
                    src="{{ asset('storage/' . $websiteSettings->logo) }}"
                    alt="{{ $websiteSettings->website_name ?? 'Logo' }}"
                    style="height: 40px; width: auto; display: block;"
                >

            @else

                <span class="nav-logo text-2xl font-bold text-white">
                    {{ $websiteSettings->website_name ?? 'Lokora' }}
                </span>

            @endif

        </a>

        <!-- Desktop Nav -->
        <div class="hidden lg:flex items-center gap-1">
          <!-- Home -->
          <div class="relative group">
            <a href="{{ route('home') }}" class="nav-link px-4 py-2 text-sm font-medium text-white/90 hover:text-white rounded-lg hover:bg-white/10 transition-all flex items-center gap-1">Home </a>


          </div>

          <!-- Explore — Mega Menu -->
          <div class="relative group">
            <a href="#" class="nav-link px-4 py-2 text-sm font-medium text-white/90 hover:text-white rounded-lg hover:bg-white/10 transition-all flex items-center gap-1">Explore <i class="fas fa-chevron-down text-[10px] opacity-60"></i></a>
            <div class="absolute top-full -left-60 pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
              <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden" style="width: 840px;">
                <div class="grid grid-cols-3">

                  <!-- Column 1: Popular Destinations -->
<div class="p-6 border-r border-gray-100">

    <h4 class="text-[11px] font-semibold text-dark-300 uppercase tracking-wider mb-4">
        Popular Destinations
    </h4>

    <div class="space-y-0.5">

        @forelse($exploreLocations as $location)

        @php
            $city = $location->city;
        @endphp

        @if($city)

            <a
                href="{{ route('listings.index') }}?city={{ urlencode($city->slug) }}"
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 group transition-colors"
            >

                <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center flex-shrink-0">

                    <i class="fas fa-map-marker-alt text-primary text-sm"></i>

                </div>

                <div class="flex-1">

                    <span class="text-sm font-medium text-dark-900 block">
                        {{ $city->name }}
                    </span>

                    <span class="text-xs text-dark-300">
                        {{ \App\Models\Business::where('status', 'approved')->where('city_id', $city->id)->count() }}
                        businesses
                    </span>

                </div>

                <i class="fas fa-arrow-right text-[10px] text-dark-200 opacity-0 group-hover:opacity-100 transition-opacity"></i>

            </a>

        @endif

    @empty

        <div class="px-3 py-2 text-sm text-dark-400">
            No locations found
        </div>

    @endforelse

    </div>

    <a
        href="{{ route('listings.index') }}"
        class="flex items-center gap-1 mt-3 px-3 text-xs font-medium text-primary hover:text-primary-dark transition-colors"
    >
        View all destinations

        <i class="fas fa-arrow-right text-[10px]"></i>
    </a>

</div>


                  <!-- Column 2: Categories -->
<div class="p-6 border-r border-gray-100">

    <h4 class="text-[11px] font-semibold text-dark-300 uppercase tracking-wider mb-4">
        Top Categories
    </h4>

    <div class="space-y-0.5">

        @forelse($exploreCategories as $category)

            <a
                href="{{ route('categories.show', $category->slug) }}"
                class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-gray-50 group transition-colors"
            >

                <i class="fas fa-store text-xs text-dark-300 w-4 text-center"></i>

                <span class="text-sm text-dark-700 group-hover:text-dark-900">
                    {{ $category->name }}
                </span>

                <span class="text-[10px] text-dark-200 ml-auto">
                    {{ $category->businesses_count }}+
                </span>

            </a>

        @empty

            <div class="px-3 py-2 text-sm text-dark-400">
                No categories found
            </div>

        @endforelse

    </div>

    <a
        href="{{ route('categories.index') }}"
        class="flex items-center gap-1 mt-3 px-3 text-xs font-medium text-primary hover:text-primary-dark transition-colors"
    >
        All categories
        <i class="fas fa-arrow-right text-[10px]"></i>
    </a>

</div>


                  <!-- Column 3: Featured Listing -->
<div class="p-6 bg-gray-50/60">

    <h4 class="text-[11px] font-semibold text-dark-300 uppercase tracking-wider mb-4">
        Featured Listing
    </h4>

    @if($featuredListing)

        <a
            href="{{ route('listings.details', $featuredListing->slug) }}"
            class="block group"
        >

            {{-- Image --}}
            <div class="rounded-xl overflow-hidden aspect-[16/10] mb-3 ring-1 ring-gray-200">

                @if($featuredListing->image)

                    <img
                        src="{{ asset($featuredListing->image) }}"
                        alt="{{ $featuredListing->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                    >

                @else

                    <div class="w-full h-full bg-gray-100 flex items-center justify-center">

                        <i class="fas fa-store text-3xl text-gray-300"></i>

                    </div>

                @endif

            </div>

            {{-- Status + Rating --}}
            <div class="flex items-center gap-2 mb-1.5">

                @if($featuredListing->status === 'approved')

    <span class="px-2 py-0.5 bg-green-100 text-green-700 text-[10px] font-semibold rounded-md uppercase">
        Approved
    </span>

@endif

                @if($featuredListing->rating)

                    <div class="flex items-center gap-0.5">

                        <i class="fas fa-star text-[10px] text-amber-400"></i>

                        <span class="text-[11px] font-medium text-dark-700">
                            {{ number_format($featuredListing->rating, 1) }}
                        </span>

                    </div>

                @endif

            </div>

            {{-- Name --}}
            <h5 class="text-sm font-semibold text-dark-900 group-hover:text-primary transition-colors">
                {{ $featuredListing->name }}
            </h5>

            {{-- Description --}}
            @if($featuredListing->short_description)

                <p class="text-xs text-dark-400 mt-0.5 leading-relaxed">
                    {{ Str::limit($featuredListing->short_description, 90) }}
                </p>

            @endif

            {{-- Location --}}
            @if($featuredListing->city)

            <div class="flex items-center gap-1.5 mt-2 text-xs text-dark-300">

                <i class="fas fa-map-marker-alt text-[10px] text-primary/50"></i>

                {{ $featuredListing->city->name }}

                @if($featuredListing->state)
                    , {{ $featuredListing->state->name }}
                @endif

            </div>

        @endif

        </a>

    @else

        {{-- No Featured Listing --}}
        <div class="rounded-xl border border-dashed border-gray-300 p-6 text-center">

            <i class="fas fa-store text-2xl text-gray-300 mb-2"></i>

            <p class="text-sm font-medium text-dark-700">
                No Featured Listing
            </p>

            <p class="text-xs text-dark-400 mt-1">
                Featured listings will appear here.
            </p>

        </div>

    @endif

</div>

                </div>
              </div>
            </div>
          </div>

       <!-- Pages — Mega Menu -->

<div class="relative group">


    <a href="{{ route('about') }}"
       class="nav-link px-4 py-2 text-sm font-medium text-white/90 hover:text-white rounded-lg hover:bg-white/10 transition-all flex items-center gap-1">
        About

    </a>



    </div>











<!-- Listings -->

<div class="relative group">


    <a href="{{ route('listings.index') }}"
       class="nav-link px-4 py-2 text-sm font-medium text-white/90
              hover:text-white rounded-lg hover:bg-white/10
              transition-all flex items-center gap-1">

        Listings

        <i class="fas fa-chevron-down text-[10px] opacity-60"></i>

    </a>


    <div class="absolute top-full left-0 pt-2
                opacity-0 invisible
                group-hover:opacity-100 group-hover:visible
                transition-all duration-200">

        <div class="bg-white rounded-2xl shadow-xl
                    border border-gray-100 p-2 min-w-[220px]">


            {{-- Grid View --}}
            <a href="{{ route('listings.index') }}"
               class="flex items-center gap-3 px-4 py-2.5
                      text-sm text-dark-900
                      hover:bg-primary/5 hover:text-primary
                      rounded-lg transition-colors">

                <i class="fas fa-th-large text-xs
                          text-dark-300 w-4"></i>

                Grid View

            </a>


            {{-- List View --}}
            <a href="{{ route('listings.list') }}"
               class="flex items-center gap-3 px-4 py-2.5
                      text-sm text-dark-900
                      hover:bg-primary/5 hover:text-primary
                      rounded-lg transition-colors">

                <i class="fas fa-list text-xs
                          text-dark-300 w-4"></i>

                List View

            </a>


            {{-- Map View --}}
            {{-- <a href="{{ route('listings.map') }}"
               class="flex items-center gap-3 px-4 py-2.5
                      text-sm text-dark-900
                      hover:bg-primary/5 hover:text-primary
                      rounded-lg transition-colors">

                <i class="fas fa-map text-xs
                          text-dark-300 w-4"></i>

                Map View

            </a> --}}


            <div class="border-t border-gray-100 my-1"></div>


            {{-- All Listing Details --}}
            {{-- @if(isset($listing))
            <a href="{{ route('listings.details', ['listing' => $listing->slug]) }}"
               class="flex items-center gap-3 px-4 py-2.5 text-sm text-dark-900 hover:bg-primary/5 hover:text-primary rounded-lg transition-colors">

                <i class="fas fa-file-alt text-xs text-dark-300 w-4"></i>
                Listing Detail
            </a>
        @endif --}}

        </div>

    </div>


    </div>



          <!-- Blog -->
          <div class="relative group">
            <a href="{{ route('blog') }}" class="nav-link px-4 py-2 text-sm font-medium text-white/90 hover:text-white rounded-lg hover:bg-white/10 transition-all flex items-center gap-1">Blog </a>

          </div>

          <!-- Contact -->
          <a href="{{ route('contact') }}" class="nav-link px-4 py-2 text-sm font-medium text-white/90 hover:text-white rounded-lg hover:bg-white/10 transition-all">Contact</a>

          {{-- Add business --}}
<a href="{{ route('businesses.index') }}" class="nav-link px-4 py-2 text-sm font-medium text-white/90 hover:text-white rounded-lg hover:bg-white/10 transition-all">Business</a>
        </div>

        <!-- Right Actions -->
        <div class="flex items-center gap-3">
          <button class="search-popup__toggler nav-icon hidden sm:flex w-10 h-10 items-center justify-center text-white/80 hover:text-white hover:bg-white/10 rounded-full transition-all">
            <i class="fas fa-search text-sm"></i>
          </button>
          <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center gap-2 px-5 py-2.5 bg-primary hover:bg-primary-dark text-white text-sm font-medium rounded-full transition-colors shadow-lg shadow-primary/25">
            <i class="fas fa-plus text-xs"></i> Login
          </a>
          <!-- Mobile menu toggle -->
          <button class="side-menu__toggler nav-mobile-toggle lg:hidden w-10 h-10 flex items-center justify-center text-white hover:bg-white/10 rounded-full transition-all">
            <i class="fas fa-bars"></i>
          </button>
        </div>
      </div>
    </div>
  </nav>
