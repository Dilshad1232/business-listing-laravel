@extends('layouts.main')

@section('title', 'Blog')

@section('content')

{{-- =========================================================
     BLOG PAGE HEADER
========================================================= --}}
<section class="relative overflow-hidden bg-dark-900 py-20 lg:py-24">
    <div class="absolute inset-0 bg-grid-dark opacity-30"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">

            <span class="mb-4 inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-semibold text-primary">
                <i class="fa-solid fa-newspaper mr-2"></i>
                Our Blog
            </span>

            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Discover Stories,
                <span class="text-primary">Ideas & Insights</span>
            </h1>

            <p class="mt-6 text-lg leading-8 text-white/70">
                Explore useful guides, business tips, travel inspiration and
                insights to help you discover more from your city.
            </p>

        </div>
    </div>
</section>


{{-- =========================================================
     FEATURED POST
========================================================= --}}
<section class="py-16 lg:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="mb-10 flex items-end justify-between gap-6">
            <div>
                <span class="text-sm font-semibold uppercase tracking-wider text-primary">
                    Featured
                </span>

                <h2 class="mt-2 text-3xl font-bold text-dark-900 sm:text-4xl">
                    Featured Article
                </h2>
            </div>

            <a href="{{ url('/blog') }}"
               class="hidden items-center gap-2 text-sm font-semibold text-primary transition hover:gap-3 sm:flex">
                View All Articles
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>


        <article class="card-hover overflow-hidden rounded-2xl border border-dark-100 bg-white shadow-sm">

            <div class="grid lg:grid-cols-2">

                {{-- Image --}}
                <a href="{{ url('/blog/ultimate-guide-finding-hidden-gems-city') }}"
                   class="group relative block min-h-[320px] overflow-hidden lg:min-h-[460px]">

                    <img
                        src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=1200&h=800&fit=crop&q=80"
                        alt="The Ultimate Guide to Finding Hidden Gems in Your City"
                        class="img-zoom absolute inset-0 h-full w-full object-cover"
                    >

                    <div class="absolute left-5 top-5">
                        <span class="rounded-full bg-primary px-4 py-2 text-xs font-bold text-white shadow-lg">
                            Featured
                        </span>
                    </div>

                </a>


                {{-- Content --}}
                <div class="flex flex-col justify-center p-7 sm:p-10 lg:p-12">

                    <div class="mb-4 flex flex-wrap items-center gap-4 text-sm text-dark-400">

                        <span class="inline-flex items-center gap-2">
                            <i class="fa-regular fa-calendar text-primary"></i>
                            Aug 10, 2026
                        </span>

                        <span class="inline-flex items-center gap-2">
                            <i class="fa-regular fa-user text-primary"></i>
                            Admin
                        </span>

                        <span class="inline-flex items-center gap-2">
                            <i class="fa-regular fa-comment text-primary"></i>
                            12 Comments
                        </span>

                    </div>

                    <h3 class="text-2xl font-bold leading-tight text-dark-900 sm:text-3xl lg:text-4xl">
                        <a href="{{ url('/blog/ultimate-guide-finding-hidden-gems-city') }}"
                           class="transition hover:text-primary">
                            The Ultimate Guide to Finding Hidden Gems in Your City
                        </a>
                    </h3>

                    <p class="mt-5 text-base leading-7 text-dark-400">
                        Discover unique places, hidden attractions, local favorites
                        and unforgettable experiences that you may never find in
                        the usual travel guides.
                    </p>

                    <div class="mt-7">
                        <a href="{{ url('/blog/ultimate-guide-finding-hidden-gems-city') }}"
                           class="inline-flex items-center gap-2 font-semibold text-primary transition hover:gap-3">
                            Read Article
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>

                </div>

            </div>

        </article>

    </div>
</section>


{{-- =========================================================
     BLOG GRID
========================================================= --}}
<section class="bg-dark-50 py-16 lg:py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="mb-10">
            <span class="text-sm font-semibold uppercase tracking-wider text-primary">
                Latest Articles
            </span>

            <h2 class="mt-2 text-3xl font-bold text-dark-900 sm:text-4xl">
                Latest From Our Blog
            </h2>

            <p class="mt-3 max-w-2xl text-dark-400">
                Helpful articles, practical tips and interesting stories
                curated for our community.
            </p>
        </div>


        <div class="grid gap-7 md:grid-cols-2 lg:grid-cols-3">


            {{-- =====================================================
                 BLOG CARD 1
            ====================================================== --}}
            <article class="card-hover group overflow-hidden rounded-2xl border border-dark-100 bg-white shadow-sm">

                <a href="{{ url('/blog/top-amazing-places-stay-canada-summer') }}"
                   class="block overflow-hidden">

                    <img
                        src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=800&h=500&fit=crop&q=80"
                        alt="Top 8 Amazing Places to Stay in Canada This Summer"
                        class="img-zoom h-60 w-full object-cover"
                    >

                </a>

                <div class="p-6">

                    <div class="mb-3 flex items-center gap-3 text-xs text-dark-400">
                        <span>
                            <i class="fa-regular fa-calendar mr-1 text-primary"></i>
                            Aug 07, 2026
                        </span>

                        <span>
                            <i class="fa-regular fa-comment mr-1 text-primary"></i>
                            3 Comments
                        </span>
                    </div>

                    <h3 class="text-xl font-bold leading-snug text-dark-900">
                        <a href="{{ url('/blog/top-amazing-places-stay-canada-summer') }}"
                           class="transition hover:text-primary">
                            Top 8 Amazing Places to Stay in Canada This Summer
                        </a>
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-dark-400">
                        Explore some of the most memorable places to stay
                        during your next Canadian adventure.
                    </p>

                    <a href="{{ url('/blog/top-amazing-places-stay-canada-summer') }}"
                       class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-primary">
                        Read More
                        <i class="fa-solid fa-arrow-right transition group-hover:translate-x-1"></i>
                    </a>

                </div>
            </article>


            {{-- =====================================================
                 BLOG CARD 2
            ====================================================== --}}
            <article class="card-hover group overflow-hidden rounded-2xl border border-dark-100 bg-white shadow-sm">

                <a href="{{ url('/blog/leverage-agile-frameworks-better-listings') }}"
                   class="block overflow-hidden">

                    <img
                        src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=800&h=500&fit=crop&q=80"
                        alt="How to Leverage Agile Frameworks for Better Listings"
                        class="img-zoom h-60 w-full object-cover"
                    >

                </a>

                <div class="p-6">

                    <div class="mb-3 flex items-center gap-3 text-xs text-dark-400">
                        <span>
                            <i class="fa-regular fa-calendar mr-1 text-primary"></i>
                            Aug 05, 2026
                        </span>

                        <span>
                            <i class="fa-regular fa-comment mr-1 text-primary"></i>
                            5 Comments
                        </span>
                    </div>

                    <h3 class="text-xl font-bold leading-snug text-dark-900">
                        <a href="{{ url('/blog/leverage-agile-frameworks-better-listings') }}"
                           class="transition hover:text-primary">
                            How to Leverage Agile Frameworks for Better Listings
                        </a>
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-dark-400">
                        Learn how modern teams can use agile thinking to
                        improve business listings and workflows.
                    </p>

                    <a href="{{ url('/blog/leverage-agile-frameworks-better-listings') }}"
                       class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-primary">
                        Read More
                        <i class="fa-solid fa-arrow-right transition group-hover:translate-x-1"></i>
                    </a>

                </div>
            </article>


            {{-- =====================================================
                 BLOG CARD 3
            ====================================================== --}}
            <article class="card-hover group overflow-hidden rounded-2xl border border-dark-100 bg-white shadow-sm">

                <a href="{{ url('/blog/win-win-survival-strategies-modern-directory') }}"
                   class="block overflow-hidden">

                    <img
                        src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=500&fit=crop&q=80"
                        alt="Win-Win Survival Strategies for the Modern Directory"
                        class="img-zoom h-60 w-full object-cover"
                    >

                </a>

                <div class="p-6">

                    <div class="mb-3 flex items-center gap-3 text-xs text-dark-400">
                        <span>
                            <i class="fa-regular fa-calendar mr-1 text-primary"></i>
                            Aug 02, 2026
                        </span>

                        <span>
                            <i class="fa-regular fa-comment mr-1 text-primary"></i>
                            2 Comments
                        </span>
                    </div>

                    <h3 class="text-xl font-bold leading-snug text-dark-900">
                        <a href="{{ url('/blog/win-win-survival-strategies-modern-directory') }}"
                           class="transition hover:text-primary">
                            Win-Win Survival Strategies for the Modern Directory
                        </a>
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-dark-400">
                        Practical strategies for businesses looking to
                        succeed in today's competitive directory ecosystem.
                    </p>

                    <a href="{{ url('/blog/win-win-survival-strategies-modern-directory') }}"
                       class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-primary">
                        Read More
                        <i class="fa-solid fa-arrow-right transition group-hover:translate-x-1"></i>
                    </a>

                </div>
            </article>


            {{-- =====================================================
                 BLOG CARD 4
            ====================================================== --}}
            <article class="card-hover group overflow-hidden rounded-2xl border border-dark-100 bg-white shadow-sm">

                <a href="{{ url('/blog/tips-growing-business-online-directories') }}"
                   class="block overflow-hidden">

                    <img
                        src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=800&h=500&fit=crop&q=80"
                        alt="10 Tips for Growing Your Business With Online Directories"
                        class="img-zoom h-60 w-full object-cover"
                    >

                </a>

                <div class="p-6">

                    <div class="mb-3 flex items-center gap-3 text-xs text-dark-400">
                        <span>
                            <i class="fa-regular fa-calendar mr-1 text-primary"></i>
                            Jul 28, 2026
                        </span>

                        <span>
                            <i class="fa-regular fa-comment mr-1 text-primary"></i>
                            7 Comments
                        </span>
                    </div>

                    <h3 class="text-xl font-bold leading-snug text-dark-900">
                        <a href="{{ url('/blog/tips-growing-business-online-directories') }}"
                           class="transition hover:text-primary">
                            10 Tips for Growing Your Business With Online Directories
                        </a>
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-dark-400">
                        Simple and practical ways to improve your business
                        visibility through online directories.
                    </p>

                    <a href="{{ url('/blog/tips-growing-business-online-directories') }}"
                       class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-primary">
                        Read More
                        <i class="fa-solid fa-arrow-right transition group-hover:translate-x-1"></i>
                    </a>

                </div>
            </article>


            {{-- =====================================================
                 BLOG CARD 5
            ====================================================== --}}
            <article class="card-hover group overflow-hidden rounded-2xl border border-dark-100 bg-white shadow-sm">

                <a href="{{ url('/blog/hidden-cafes-downtown-brooklyn') }}"
                   class="block overflow-hidden">

                    <img
                        src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=800&h=500&fit=crop&q=80"
                        alt="Exploring the Hidden Cafes of Downtown Brooklyn"
                        class="img-zoom h-60 w-full object-cover"
                    >

                </a>

                <div class="p-6">

                    <div class="mb-3 flex items-center gap-3 text-xs text-dark-400">
                        <span>
                            <i class="fa-regular fa-calendar mr-1 text-primary"></i>
                            Jul 22, 2026
                        </span>

                        <span>
                            <i class="fa-regular fa-comment mr-1 text-primary"></i>
                            4 Comments
                        </span>
                    </div>

                    <h3 class="text-xl font-bold leading-snug text-dark-900">
                        <a href="{{ url('/blog/hidden-cafes-downtown-brooklyn') }}"
                           class="transition hover:text-primary">
                            Exploring the Hidden Cafes of Downtown Brooklyn
                        </a>
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-dark-400">
                        Discover charming local cafes and unique places
                        hidden away from the busiest streets.
                    </p>

                    <a href="{{ url('/blog/hidden-cafes-downtown-brooklyn') }}"
                       class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-primary">
                        Read More
                        <i class="fa-solid fa-arrow-right transition group-hover:translate-x-1"></i>
                    </a>

                </div>
            </article>


            {{-- =====================================================
                 BLOG CARD 6
            ====================================================== --}}
            <article class="card-hover group overflow-hidden rounded-2xl border border-dark-100 bg-white shadow-sm">

                <a href="{{ url('/blog/future-local-business-discovery-platforms') }}"
                   class="block overflow-hidden">

                    <img
                        src="https://images.unsplash.com/photo-1528127269322-539801943592?w=800&h=500&fit=crop&q=80"
                        alt="The Future of Local Business Discovery Platforms"
                        class="img-zoom h-60 w-full object-cover"
                    >

                </a>

                <div class="p-6">

                    <div class="mb-3 flex items-center gap-3 text-xs text-dark-400">
                        <span>
                            <i class="fa-regular fa-calendar mr-1 text-primary"></i>
                            Jul 18, 2026
                        </span>

                        <span>
                            <i class="fa-regular fa-comment mr-1 text-primary"></i>
                            6 Comments
                        </span>
                    </div>

                    <h3 class="text-xl font-bold leading-snug text-dark-900">
                        <a href="{{ url('/blog/future-local-business-discovery-platforms') }}"
                           class="transition hover:text-primary">
                            The Future of Local Business Discovery Platforms
                        </a>
                    </h3>

                    <p class="mt-3 text-sm leading-6 text-dark-400">
                        See how technology is changing the way people discover
                        and connect with local businesses.
                    </p>

                    <a href="{{ url('/blog/future-local-business-discovery-platforms') }}"
                       class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-primary">
                        Read More
                        <i class="fa-solid fa-arrow-right transition group-hover:translate-x-1"></i>
                    </a>

                </div>
            </article>

        </div>

    </div>
</section>


{{-- =========================================================
     BLOG + SIDEBAR
========================================================= --}}
<section class="py-16 lg:py-20">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="grid gap-10 lg:grid-cols-3">

            {{-- =================================================
                 MAIN BLOG AREA
            ================================================== --}}
            <div class="lg:col-span-2">

                <div class="mb-8">
                    <span class="text-sm font-semibold uppercase tracking-wider text-primary">
                        Explore More
                    </span>

                    <h2 class="mt-2 text-3xl font-bold text-dark-900">
                        More From Our Blog
                    </h2>
                </div>


                <div class="space-y-6">


                    {{-- Horizontal Post 1 --}}
                    <article class="card-hover overflow-hidden rounded-2xl border border-dark-100 bg-white shadow-sm">

                        <div class="grid sm:grid-cols-5">

                            <a href="{{ url('/blog/top-amazing-places-stay-canada-summer') }}"
                               class="block overflow-hidden sm:col-span-2">

                                <img
                                    src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=800&h=500&fit=crop&q=80"
                                    alt="Canada Travel"
                                    class="img-zoom h-full min-h-[220px] w-full object-cover"
                                >

                            </a>

                            <div class="p-6 sm:col-span-3">

                                <span class="text-xs font-semibold text-primary">
                                    Travel
                                </span>

                                <h3 class="mt-2 text-xl font-bold leading-snug text-dark-900">
                                    <a href="{{ url('/blog/top-amazing-places-stay-canada-summer') }}"
                                       class="hover:text-primary">
                                        Top 8 Amazing Places to Stay in Canada This Summer
                                    </a>
                                </h3>

                                <p class="mt-3 text-sm leading-6 text-dark-400">
                                    Explore beautiful destinations and discover
                                    unforgettable places for your next trip.
                                </p>

                                <div class="mt-4 text-xs text-dark-400">
                                    Aug 07, 2026
                                </div>

                            </div>

                        </div>

                    </article>


                    {{-- Horizontal Post 2 --}}
                    <article class="card-hover overflow-hidden rounded-2xl border border-dark-100 bg-white shadow-sm">

                        <div class="grid sm:grid-cols-5">

                            <a href="{{ url('/blog/leverage-agile-frameworks-better-listings') }}"
                               class="block overflow-hidden sm:col-span-2">

                                <img
                                    src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=800&h=500&fit=crop&q=80"
                                    alt="Agile Frameworks"
                                    class="img-zoom h-full min-h-[220px] w-full object-cover"
                                >

                            </a>

                            <div class="p-6 sm:col-span-3">

                                <span class="text-xs font-semibold text-primary">
                                    Business
                                </span>

                                <h3 class="mt-2 text-xl font-bold leading-snug text-dark-900">
                                    <a href="{{ url('/blog/leverage-agile-frameworks-better-listings') }}"
                                       class="hover:text-primary">
                                        How to Leverage Agile Frameworks for Better Listings
                                    </a>
                                </h3>

                                <p class="mt-3 text-sm leading-6 text-dark-400">
                                    Learn practical ways to improve business
                                    listings using modern workflows.
                                </p>

                                <div class="mt-4 text-xs text-dark-400">
                                    Aug 05, 2026
                                </div>

                            </div>

                        </div>

                    </article>


                    {{-- Horizontal Post 3 --}}
                    <article class="card-hover overflow-hidden rounded-2xl border border-dark-100 bg-white shadow-sm">

                        <div class="grid sm:grid-cols-5">

                            <a href="{{ url('/blog/tips-growing-business-online-directories') }}"
                               class="block overflow-hidden sm:col-span-2">

                                <img
                                    src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=800&h=500&fit=crop&q=80"
                                    alt="Business Growth"
                                    class="img-zoom h-full min-h-[220px] w-full object-cover"
                                >

                            </a>

                            <div class="p-6 sm:col-span-3">

                                <span class="text-xs font-semibold text-primary">
                                    Business
                                </span>

                                <h3 class="mt-2 text-xl font-bold leading-snug text-dark-900">
                                    <a href="{{ url('/blog/tips-growing-business-online-directories') }}"
                                       class="hover:text-primary">
                                        10 Tips for Growing Your Business With Online Directories
                                    </a>
                                </h3>

                                <p class="mt-3 text-sm leading-6 text-dark-400">
                                    Improve visibility and attract more customers
                                    through online business directories.
                                </p>

                                <div class="mt-4 text-xs text-dark-400">
                                    Jul 28, 2026
                                </div>

                            </div>

                        </div>

                    </article>

                </div>


                {{-- Pagination --}}
                <div class="mt-10 flex items-center justify-center gap-2">

                    <a href="#"
                       class="flex h-10 w-10 items-center justify-center rounded-lg border border-dark-100 text-dark-400 transition hover:border-primary hover:bg-primary hover:text-white">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </a>

                    <a href="#"
                       class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary font-semibold text-white">
                        1
                    </a>

                    <a href="#"
                       class="flex h-10 w-10 items-center justify-center rounded-lg border border-dark-100 font-semibold text-dark-700 transition hover:border-primary hover:bg-primary hover:text-white">
                        2
                    </a>

                    <a href="#"
                       class="flex h-10 w-10 items-center justify-center rounded-lg border border-dark-100 font-semibold text-dark-700 transition hover:border-primary hover:bg-primary hover:text-white">
                        3
                    </a>

                    <a href="#"
                       class="flex h-10 w-10 items-center justify-center rounded-lg border border-dark-100 text-dark-400 transition hover:border-primary hover:bg-primary hover:text-white">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </a>

                </div>

            </div>


            {{-- =================================================
                 SIDEBAR
            ================================================== --}}
            <aside class="space-y-7">


                {{-- Search --}}
                <div class="rounded-2xl border border-dark-100 bg-white p-6 shadow-sm">

                    <h3 class="text-lg font-bold text-dark-900">
                        Search Blog
                    </h3>

                    <form action="{{ url('/blog') }}" method="GET" class="mt-4">

                        <div class="relative">

                            <input
                                type="text"
                                name="search"
                                placeholder="Search articles..."
                                class="w-full rounded-xl border border-dark-100 bg-dark-50 py-3 pl-4 pr-12 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/10"
                            >

                            <button
                                type="submit"
                                class="absolute right-1 top-1 flex h-10 w-10 items-center justify-center rounded-lg bg-primary text-white transition hover:opacity-90"
                            >
                                <i class="fa-solid fa-search"></i>
                            </button>

                        </div>

                    </form>

                </div>


                {{-- Categories --}}
                <div class="rounded-2xl border border-dark-100 bg-white p-6 shadow-sm">

                    <h3 class="text-lg font-bold text-dark-900">
                        Categories
                    </h3>

                    <div class="mt-5 space-y-3">

                        <a href="#"
                           class="flex items-center justify-between rounded-lg px-3 py-2 text-sm text-dark-600 transition hover:bg-primary/5 hover:text-primary">
                            <span>Restaurant</span>
                            <span class="rounded-full bg-dark-50 px-2 py-1 text-xs">24</span>
                        </a>

                        <a href="#"
                           class="flex items-center justify-between rounded-lg px-3 py-2 text-sm text-dark-600 transition hover:bg-primary/5 hover:text-primary">
                            <span>Hotels</span>
                            <span class="rounded-full bg-dark-50 px-2 py-1 text-xs">18</span>
                        </a>

                        <a href="#"
                           class="flex items-center justify-between rounded-lg px-3 py-2 text-sm text-dark-600 transition hover:bg-primary/5 hover:text-primary">
                            <span>Shopping</span>
                            <span class="rounded-full bg-dark-50 px-2 py-1 text-xs">15</span>
                        </a>

                        <a href="#"
                           class="flex items-center justify-between rounded-lg px-3 py-2 text-sm text-dark-600 transition hover:bg-primary/5 hover:text-primary">
                            <span>Travel</span>
                            <span class="rounded-full bg-dark-50 px-2 py-1 text-xs">32</span>
                        </a>

                        <a href="#"
                           class="flex items-center justify-between rounded-lg px-3 py-2 text-sm text-dark-600 transition hover:bg-primary/5 hover:text-primary">
                            <span>Nightlife</span>
                            <span class="rounded-full bg-dark-50 px-2 py-1 text-xs">9</span>
                        </a>

                        <a href="#"
                           class="flex items-center justify-between rounded-lg px-3 py-2 text-sm text-dark-600 transition hover:bg-primary/5 hover:text-primary">
                            <span>Business</span>
                            <span class="rounded-full bg-dark-50 px-2 py-1 text-xs">21</span>
                        </a>

                    </div>

                </div>


                {{-- Recent Posts --}}
                <div class="rounded-2xl border border-dark-100 bg-white p-6 shadow-sm">

                    <h3 class="text-lg font-bold text-dark-900">
                        Recent Posts
                    </h3>

                    <div class="mt-5 space-y-5">

                        <a href="{{ url('/blog/ultimate-guide-finding-hidden-gems-city') }}"
                           class="group flex gap-4">

                            <img
                                src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=200&h=150&fit=crop&q=80"
                                alt="Hidden Gems"
                                class="h-16 w-20 rounded-lg object-cover"
                            >

                            <div>
                                <h4 class="line-clamp-2 text-sm font-semibold leading-5 text-dark-900 transition group-hover:text-primary">
                                    The Ultimate Guide to Finding Hidden Gems in Your City
                                </h4>

                                <span class="mt-1 block text-xs text-dark-400">
                                    Aug 10, 2026
                                </span>
                            </div>

                        </a>


                        <a href="{{ url('/blog/top-amazing-places-stay-canada-summer') }}"
                           class="group flex gap-4">

                            <img
                                src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=200&h=150&fit=crop&q=80"
                                alt="Canada"
                                class="h-16 w-20 rounded-lg object-cover"
                            >

                            <div>
                                <h4 class="line-clamp-2 text-sm font-semibold leading-5 text-dark-900 transition group-hover:text-primary">
                                    Top 8 Amazing Places to Stay in Canada This Summer
                                </h4>

                                <span class="mt-1 block text-xs text-dark-400">
                                    Aug 07, 2026
                                </span>
                            </div>

                        </a>


                        <a href="{{ url('/blog/leverage-agile-frameworks-better-listings') }}"
                           class="group flex gap-4">

                            <img
                                src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=200&h=150&fit=crop&q=80"
                                alt="Agile"
                                class="h-16 w-20 rounded-lg object-cover"
                            >

                            <div>
                                <h4 class="line-clamp-2 text-sm font-semibold leading-5 text-dark-900 transition group-hover:text-primary">
                                    How to Leverage Agile Frameworks for Better Listings
                                </h4>

                                <span class="mt-1 block text-xs text-dark-400">
                                    Aug 05, 2026
                                </span>
                            </div>

                        </a>

                    </div>

                </div>


                {{-- Popular Tags --}}
                <div class="rounded-2xl border border-dark-100 bg-white p-6 shadow-sm">

                    <h3 class="text-lg font-bold text-dark-900">
                        Popular Tags
                    </h3>

                    <div class="mt-5 flex flex-wrap gap-2">

                        @foreach([
                            'Restaurant',
                            'Hotels',
                            'Travel',
                            'Business',
                            'Nightlife',
                            'Shopping',
                            'City Guide',
                            'Tips'
                        ] as $tag)

                            <a href="#"
                               class="rounded-lg border border-dark-100 px-3 py-2 text-xs font-medium text-dark-500 transition hover:border-primary hover:bg-primary hover:text-white">
                                #{{ $tag }}
                            </a>

                        @endforeach

                    </div>

                </div>


                {{-- CTA --}}
                <div class="relative overflow-hidden rounded-2xl bg-dark-900 p-7">

                    <div class="absolute inset-0 bg-grid-dark opacity-30"></div>

                    <div class="relative">

                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                            <i class="fa-solid fa-plus"></i>
                        </div>

                        <h3 class="text-xl font-bold text-white">
                            List Your Business
                        </h3>

                        <p class="mt-3 text-sm leading-6 text-white/60">
                            Get discovered by more customers and grow
                            your business with our directory.
                        </p>

                        <a href="{{ url('/add-listing') }}"
                           class="mt-6 inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-3 text-sm font-semibold text-white transition hover:opacity-90">
                            Add Your Business
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>

                    </div>

                </div>

            </aside>

        </div>

    </div>

</section>


{{-- =========================================================
     NEWSLETTER CTA
========================================================= --}}
<section class="relative overflow-hidden bg-dark-900 py-16 lg:py-20">

    <div class="absolute inset-0 bg-grid-dark opacity-30"></div>

    <div class="relative mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">

        <span class="inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-semibold text-primary">
            <i class="fa-regular fa-envelope mr-2"></i>
            Stay Updated
        </span>

        <h2 class="mt-5 text-3xl font-bold text-white sm:text-4xl">
            Get the Latest Stories in Your Inbox
        </h2>

        <p class="mx-auto mt-4 max-w-2xl text-white/60">
            Subscribe to receive useful guides, business insights,
            travel inspiration and the latest articles.
        </p>

        <form action="#" method="POST"
              class="mx-auto mt-8 flex max-w-xl flex-col gap-3 sm:flex-row">

            @csrf

            <input
                type="email"
                name="email"
                placeholder="Enter your email address"
                required
                class="min-h-[52px] flex-1 rounded-xl border border-white/10 bg-white/5 px-5 text-sm text-white outline-none placeholder:text-white/40 focus:border-primary focus:ring-2 focus:ring-primary/20"
            >

            <button
                type="submit"
                class="min-h-[52px] rounded-xl bg-primary px-7 text-sm font-semibold text-white transition hover:opacity-90"
            >
                Subscribe
            </button>

        </form>

    </div>

</section>


@endsection

