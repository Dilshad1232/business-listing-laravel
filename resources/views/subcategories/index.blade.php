@extends('layouts.main')

@section('title', 'Subcategories of ' . $category->name . ' | Lokora')

@section('description', 'Explore all subcategories under ' . $category->name . ' on Lokora.')

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

            {{-- CATEGORY ICON --}}
            <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-primary/10 border border-primary/20 flex items-center justify-center">

                <i
                    class="{{ $category->icon ?: 'fas fa-layer-group' }} text-2xl text-primary"
                ></i>

            </div>


            {{-- TITLE --}}
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                {{ $category->name }} Subcategories
            </h1>


            <p class="text-dark-300 max-w-2xl mx-auto mb-6">
                Explore specific categories and discover businesses and services that match your needs.
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
                    Subcategories
                </span>

            </nav>

        </div>

    </div>

</section>


{{-- =========================================================
    SUBCATEGORY SECTION
========================================================= --}}
<section class="py-16 lg:py-20 bg-dark-50 relative overflow-hidden">

    <div class="bg-grid absolute inset-0"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">


        {{-- TOP INTRO --}}
        <div
            class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-5 mb-10"
            data-aos="fade-up"
        >

            <div>

                <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
                    {{ $category->name }}
                </span>

                <h2 class="text-3xl sm:text-4xl font-bold text-dark-900">
                    Explore Subcategories
                </h2>

                <p class="text-dark-400 mt-3 max-w-xl">
                    Choose a subcategory to explore more specific businesses and services.
                </p>

            </div>


            {{-- COUNT --}}
            <div class="flex items-center gap-2 text-sm text-dark-400">

                <span class="w-9 h-9 rounded-xl bg-primary/10 flex items-center justify-center">

                    <i class="fas fa-list text-primary text-sm"></i>

                </span>

                <span>

                    <strong class="text-dark-900">
                        {{ $subcategories->total() }}
                    </strong>

                    {{ $subcategories->total() == 1 ? 'Subcategory' : 'Subcategories' }}

                </span>

            </div>

        </div>


        {{-- =====================================================
            SUBCATEGORY GRID
        ====================================================== --}}
        @if($subcategories->count())

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 lg:gap-6">

                @foreach($subcategories as $subcategory)

                    <div
                        class="group bg-white rounded-2xl border border-gray-100 overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-primary/20"
                        data-aos="fade-up"
                        data-aos-delay="{{ ($loop->index % 4) * 80 }}"
                    >

                        <div class="p-6">


                            {{-- TOP --}}
                            <div class="flex items-start justify-between mb-6">

                                <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center group-hover:bg-primary transition-all duration-300">

                                    <i
                                        class="{{ $subcategory->icon ?: 'fas fa-tags' }} text-xl text-primary group-hover:text-white transition-colors duration-300"
                                    ></i>

                                </div>


                                <span class="text-xs font-semibold text-dark-300 bg-dark-50 px-2.5 py-1 rounded-lg">

                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}

                                </span>

                            </div>


                            {{-- NAME --}}
                            <h3 class="text-lg font-semibold text-dark-900 group-hover:text-primary transition-colors">

                                <a
                                    href="{{ route('subcategories.show', [$category->slug, $subcategory->slug]) }}"
                                >
                                    {{ $subcategory->name }}
                                </a>

                            </h3>


                            {{-- DESCRIPTION --}}
                            <p class="text-sm text-dark-400 mt-2 line-clamp-3 min-h-[60px]">

                                {{ $subcategory->short_description ?: 'Discover businesses and services in this subcategory.' }}

                            </p>


                            {{-- FOOTER --}}
                            <div class="flex items-center justify-between mt-6 pt-5 border-t border-gray-100">

                                <span class="text-xs text-dark-400">
                                    Explore now
                                </span>


                                <a
                                    href="{{ route('subcategories.show', [$category->slug, $subcategory->slug]) }}"
                                    class="w-9 h-9 rounded-full border border-gray-200 flex items-center justify-center text-dark-300 group-hover:bg-primary group-hover:border-primary group-hover:text-white transition-all"
                                    aria-label="Explore {{ $subcategory->name }}"
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
            @if($subcategories->lastPage() > 1)

                <div
                    class="flex flex-wrap items-center justify-center gap-2 mt-12"
                    data-aos="fade-up"
                >

                    {{-- PREVIOUS --}}
                    @if($subcategories->onFirstPage())

                        <span class="w-10 h-10 rounded-xl bg-white border border-gray-100 text-dark-200 flex items-center justify-center cursor-not-allowed">

                            <i class="fas fa-chevron-left text-xs"></i>

                        </span>

                    @else

                        <a
                            href="{{ $subcategories->previousPageUrl() }}"
                            class="w-10 h-10 rounded-xl bg-white border border-gray-200 text-dark-400 hover:bg-primary hover:border-primary hover:text-white flex items-center justify-center transition-all"
                        >

                            <i class="fas fa-chevron-left text-xs"></i>

                        </a>

                    @endif


                    {{-- PAGE NUMBERS --}}
                    @for($page = 1; $page <= $subcategories->lastPage(); $page++)

                        @if($page == $subcategories->currentPage())

                            <span class="w-10 h-10 rounded-xl bg-primary text-white flex items-center justify-center text-sm font-semibold shadow-lg shadow-primary/20">

                                {{ $page }}

                            </span>

                        @else

                            <a
                                href="{{ $subcategories->url($page) }}"
                                class="w-10 h-10 rounded-xl bg-white border border-gray-200 text-dark-400 hover:bg-primary hover:border-primary hover:text-white flex items-center justify-center text-sm transition-all"
                            >

                                {{ $page }}

                            </a>

                        @endif

                    @endfor


                    {{-- NEXT --}}
                    @if($subcategories->hasMorePages())

                        <a
                            href="{{ $subcategories->nextPageUrl() }}"
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

                    <i class="fas fa-tags text-2xl text-primary"></i>

                </div>


                <h3 class="text-xl font-semibold text-dark-900 mb-2">
                    No Subcategories Found
                </h3>


                <p class="text-dark-400 max-w-md mx-auto mb-6">
                    There are currently no active subcategories available under
                    {{ $category->name }}.
                </p>


                <a
                    href="{{ route('categories.show', $category->slug) }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition-all shadow-lg shadow-primary/20"
                >

                    <i class="fas fa-arrow-left text-sm"></i>

                    Back to {{ $category->name }}

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
                Discover More Businesses
            </h2>


            <p class="text-white/60 max-w-2xl mx-auto mb-8">
                Explore different categories and subcategories to find exactly what you are looking for.
            </p>


            <a
                href="{{ route('categories.index') }}"
                class="inline-flex items-center gap-2 px-7 py-3.5 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition-all shadow-lg shadow-primary/25"
            >

                <i class="fas fa-layer-group"></i>

                View All Categories

            </a>

        </div>

    </div>

</section>

@endsection

