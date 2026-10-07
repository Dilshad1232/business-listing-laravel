@extends('layouts.main')

@section('title', 'All Categories | Lokora')

@section('description', 'Explore all categories on Lokora and discover businesses, services, and places around the world.')

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

            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/10 backdrop-blur-sm text-white/80 text-sm font-medium rounded-full border border-white/10 mb-5">

                <span class="w-2 h-2 bg-primary rounded-full animate-pulse"></span>

                Explore Lokora

            </span>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                Browse Categories
            </h1>

            <p class="text-dark-300 max-w-2xl mx-auto mb-6">
                Explore businesses, services, restaurants, hotels, shops and more across different categories.
            </p>

            <nav class="flex items-center justify-center gap-2 text-sm">

                <a
                    href="{{ url('/') }}"
                    class="text-dark-300 hover:text-primary transition-colors"
                >
                    Home
                </a>

                <i class="fas fa-chevron-right text-xs text-dark-500"></i>

                <span class="text-primary">
                    Categories
                </span>

            </nav>

        </div>

    </div>

</section>


{{-- =========================================================
    CATEGORIES SECTION
========================================================= --}}
<section class="py-16 lg:py-20 bg-dark-50 relative overflow-hidden">

    <div class="bg-grid absolute inset-0"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">


        {{-- SECTION TOP --}}
        <div
            class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-10"
            data-aos="fade-up"
        >

            <div>

                <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
                    Categories
                </span>

                <h2 class="text-3xl sm:text-4xl font-bold text-dark-900">
                    Explore All Categories
                </h2>

                <p class="text-dark-400 mt-3 max-w-xl">
                    Find the right category and discover businesses and services that match what you are looking for.
                </p>

            </div>


            {{-- CATEGORY COUNT --}}
            <div class="flex items-center gap-2 text-sm text-dark-400">

                <span class="w-9 h-9 rounded-xl bg-primary/10 flex items-center justify-center">
                    <i class="fas fa-layer-group text-primary text-sm"></i>
                </span>

                <span>
                    <strong class="text-dark-900">
                        {{ $categories->total() }}
                    </strong>
                    Categories
                </span>

            </div>

        </div>


        {{-- =====================================================
            CATEGORY GRID
        ====================================================== --}}
        @if($categories->count())

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 lg:gap-6">

                @foreach($categories as $category)

                    <div
                        class="group bg-white rounded-2xl border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-primary/20"
                        data-aos="fade-up"
                        data-aos-delay="{{ ($loop->index % 4) * 80 }}"
                    >

                        <div class="p-6">


                            {{-- ICON --}}
                            <div class="flex items-start justify-between mb-6">

                                <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center group-hover:bg-primary transition-all duration-300">

                                    <i
                                        class="{{ $category->icon ?: 'fas fa-layer-group' }} text-xl text-primary group-hover:text-white transition-colors duration-300"
                                    ></i>

                                </div>


                                {{-- NUMBER --}}
                                <span class="text-xs font-semibold text-dark-300 bg-dark-50 px-2.5 py-1 rounded-lg">
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>

                            </div>


                            {{-- CATEGORY NAME --}}
                            <h3 class="text-lg font-semibold text-dark-900 group-hover:text-primary transition-colors">

                                <a href="{{ route('categories.show', $category->slug) }}">

                                    {{ $category->name }}

                                </a>

                            </h3>


                            {{-- DESCRIPTION --}}
                            <p class="text-sm text-dark-400 mt-2 line-clamp-2 min-h-[40px]">

                                {{ $category->short_description ?: 'Discover businesses and services in this category.' }}

                            </p>


                            {{-- BOTTOM --}}
                            <div class="flex items-center justify-between mt-6 pt-5 border-t border-gray-100">

                                <span class="flex items-center gap-2 text-xs text-dark-400">

                                    <span class="w-7 h-7 rounded-lg bg-primary/5 flex items-center justify-center">

                                        <i class="fas fa-list text-primary text-xs"></i>

                                    </span>

                                    <span>

                                        {{ $category->subcategories_count }}

                                        {{ $category->subcategories_count == 1 ? 'Subcategory' : 'Subcategories' }}

                                    </span>

                                </span>


                                <a
                                    href="{{ route('categories.show', $category->slug) }}"
                                    class="w-9 h-9 rounded-full border border-gray-200 flex items-center justify-center text-dark-300 group-hover:bg-primary group-hover:border-primary group-hover:text-white transition-all"
                                    aria-label="Explore {{ $category->name }}"
                                >

                                    <i class="fas fa-arrow-right text-xs"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>


            {{-- =================================================
                PAGINATION
            ================================================== --}}
            @if($categories->lastPage() > 1)

                <div
                    class="flex flex-wrap items-center justify-center gap-2 mt-12"
                    data-aos="fade-up"
                >

                    {{-- PREVIOUS --}}
                    @if($categories->onFirstPage())

                        <span class="w-10 h-10 rounded-xl bg-white border border-gray-100 text-dark-200 flex items-center justify-center cursor-not-allowed">

                            <i class="fas fa-chevron-left text-xs"></i>

                        </span>

                    @else

                        <a
                            href="{{ $categories->previousPageUrl() }}"
                            class="w-10 h-10 rounded-xl bg-white border border-gray-200 text-dark-400 hover:bg-primary hover:border-primary hover:text-white flex items-center justify-center transition-all"
                        >

                            <i class="fas fa-chevron-left text-xs"></i>

                        </a>

                    @endif


                    {{-- PAGE NUMBERS --}}
                    @for($page = 1; $page <= $categories->lastPage(); $page++)

                        @if($page == $categories->currentPage())

                            <span class="w-10 h-10 rounded-xl bg-primary text-white flex items-center justify-center text-sm font-semibold shadow-lg shadow-primary/20">

                                {{ $page }}

                            </span>

                        @else

                            <a
                                href="{{ $categories->url($page) }}"
                                class="w-10 h-10 rounded-xl bg-white border border-gray-200 text-dark-400 hover:bg-primary hover:border-primary hover:text-white flex items-center justify-center text-sm transition-all"
                            >

                                {{ $page }}

                            </a>

                        @endif

                    @endfor


                    {{-- NEXT --}}
                    @if($categories->hasMorePages())

                        <a
                            href="{{ $categories->nextPageUrl() }}"
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

                    <i class="fas fa-layer-group text-2xl text-primary"></i>

                </div>

                <h3 class="text-xl font-semibold text-dark-900 mb-2">
                    No Categories Found
                </h3>

                <p class="text-dark-400 max-w-md mx-auto">
                    Categories will appear here once they are added to Lokora.
                </p>

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

                Discover More

            </span>

            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-5">
                Find the Right Business for You
            </h2>

            <p class="text-white/60 max-w-2xl mx-auto mb-8">
                Explore categories, discover local businesses and connect with the services you need.
            </p>

            <a
                href="{{ url('/') }}"
                class="inline-flex items-center gap-2 px-7 py-3.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition-all shadow-lg shadow-primary/25"
            >

                <i class="fas fa-search"></i>

                Start Exploring

            </a>

        </div>

    </div>

</section>

@endsection

