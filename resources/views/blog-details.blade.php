
@extends('layouts.main')

@section('title', 'Top 8 Amazing Places to Stay in Canada This Summer')

@section('content')

{{-- =========================================================
     BLOG DETAIL PAGE HEADER
========================================================= --}}
<section
    class="relative overflow-hidden py-20"
    style="background: linear-gradient(135deg, #161c26 0%, #1f2937 100%)"
>
    <div class="bg-grid-dark absolute inset-0"></div>

    <div class="absolute -right-20 -top-20 h-80 w-80 rounded-full bg-primary/20 blur-3xl"></div>
    <div class="absolute -bottom-20 -left-20 h-60 w-60 rounded-full bg-primary/10 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-4 text-center sm:px-6 lg:px-8">

        <h1
            class="mx-auto mb-4 max-w-4xl text-3xl font-bold leading-snug text-white sm:text-4xl lg:text-5xl"
            data-aos="fade-up"
        >
            Top 8 Amazing Places to Stay in Canada This Summer
        </h1>

        <nav
            class="flex items-center justify-center gap-2 text-sm"
            data-aos="fade-up"
            data-aos-delay="100"
        >
            <a
                href="{{ url('/') }}"
                class="text-white/70 transition-colors hover:text-white"
            >
                Home
            </a>

            <i class="fas fa-chevron-right text-xs text-white/30"></i>

            <a
                href="{{ url('/blog') }}"
                class="text-white/70 transition-colors hover:text-white"
            >
                Blog
            </a>

            <i class="fas fa-chevron-right text-xs text-white/30"></i>

            <span class="text-primary">
                Blog Detail
            </span>
        </nav>

    </div>
</section>


{{-- =========================================================
     BLOG DETAIL + SIDEBAR
========================================================= --}}
<section class="relative bg-dark-50 py-16">

    <div class="bg-grid absolute inset-0"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="grid gap-8 lg:grid-cols-3">


            {{-- =================================================
                 ARTICLE CONTENT
            ================================================== --}}
            <div class="lg:col-span-2">

                <article
                    class="overflow-hidden rounded-3xl border border-gray-100 bg-white"
                    data-aos="fade-up"
                >

                    {{-- Featured Image --}}
                    <div class="img-zoom aspect-[16/9] overflow-hidden">

                        <img
                            decoding="async"
                            src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=1200&h=675&fit=crop&q=80"
                            alt="Top 8 Amazing Places to Stay in Canada This Summer"
                            class="h-full w-full object-cover"
                            loading="lazy"
                        >

                    </div>


                    {{-- Article Body --}}
                    <div class="p-8 lg:p-10">


                        {{-- Meta --}}
                        <div class="mb-6 flex flex-wrap items-center gap-4 border-b border-gray-100 pb-6 text-sm text-dark-300">

                            <span class="flex items-center gap-2">

                                <img
                                    decoding="async"
                                    src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=60&h=60&fit=crop&q=80"
                                    alt="Kevin Martin"
                                    class="h-8 w-8 rounded-full object-cover"
                                >

                                <span class="font-medium text-dark-900">
                                    Kevin Martin
                                </span>

                            </span>

                            <span>
                                <i class="far fa-calendar mr-1"></i>
                                Aug 07, 2026
                            </span>

                            <span>
                                <i class="far fa-comment mr-1"></i>
                                3 Comments
                            </span>

                            <span>
                                <i class="far fa-folder mr-1"></i>
                                Travel
                            </span>

                        </div>


                        {{-- Article Title --}}
                        <h2 class="mb-6 text-2xl font-bold leading-snug text-dark-900 sm:text-3xl">
                            Top 8 Amazing Places to Stay in Canada This Summer
                        </h2>


                        {{-- Article Content --}}
                        <div class="space-y-5 leading-relaxed text-dark-600">

                            <p>
                                Canada, the land of breathtaking landscapes and warm hospitality,
                                offers some of the most stunning accommodations in the world.
                                Whether you're looking for a cozy mountain lodge or a beachfront
                                cottage, this guide will help you discover the perfect place to
                                stay this summer.
                            </p>

                            <p>
                                From the rugged coastlines of British Columbia to the charming
                                villages of Quebec, every province has something unique to offer.
                                The key is knowing where to look and what to expect. We've spent
                                weeks researching and visiting these locations to bring you the
                                most authentic recommendations.
                            </p>


                            {{-- Quote --}}
                            <blockquote class="my-8 rounded-r-2xl border-l-4 border-primary bg-primary/5 py-2 pl-6">

                                <p class="text-lg font-medium italic text-dark-900">
                                    "The world is a book and those who do not travel read only one page."
                                </p>

                                <cite class="mt-2 block text-sm text-dark-400">
                                    - Saint Augustine
                                </cite>

                            </blockquote>


                            <p>
                                Our top picks include the stunning Fairmont Chateau Lake Louise
                                in Alberta, where you can wake up to views of turquoise glacial
                                waters surrounded by towering peaks. For those seeking a more
                                rustic experience, the Fogo Island Inn in Newfoundland offers
                                an architectural masterpiece perched on the edge of the North Atlantic.
                            </p>


                            {{-- Article Images --}}
                            <div class="my-8 grid gap-4 sm:grid-cols-2">

                                <div class="img-zoom overflow-hidden rounded-2xl">
                                    <img
                                        decoding="async"
                                        src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=600&h=400&fit=crop&q=80"
                                        alt="Canada scenery"
                                        class="h-full w-full object-cover"
                                        loading="lazy"
                                    >
                                </div>

                                <div class="img-zoom overflow-hidden rounded-2xl">
                                    <img
                                        decoding="async"
                                        src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=600&h=400&fit=crop&q=80"
                                        alt="Canada hotel"
                                        class="h-full w-full object-cover"
                                        loading="lazy"
                                    >
                                </div>

                            </div>


                            {{-- Heading --}}
                            <h3 class="mb-4 mt-8 text-xl font-bold text-dark-900">
                                What Makes These Places Special?
                            </h3>


                            <p>
                                Each destination on our list has been carefully curated based
                                on several factors: location, uniqueness, guest reviews, and
                                value for money. We believe that the best travel experiences
                                come from staying in places that offer more than just a bed —
                                they provide memories that last a lifetime.
                            </p>

                            <p>
                                Whether you're planning a romantic getaway, a family vacation,
                                or a solo adventure, these Canadian destinations will exceed
                                your expectations. Book early to secure the best rates,
                                especially during the peak summer months of July and August
                                when availability tends to fill up quickly across all properties.
                            </p>

                        </div>


                        {{-- Tags --}}
                        <div class="mt-8 flex flex-wrap items-center gap-3 border-t border-gray-100 pt-8">

                            <span class="text-sm font-medium text-dark-900">
                                Tags:
                            </span>

                            <a
                                href="#"
                                class="rounded-lg border border-gray-200 bg-dark-50 px-3 py-1.5 text-xs font-medium text-dark-400 transition-colors hover:bg-primary/5 hover:text-primary"
                            >
                                Travel
                            </a>

                            <a
                                href="#"
                                class="rounded-lg border border-gray-200 bg-dark-50 px-3 py-1.5 text-xs font-medium text-dark-400 transition-colors hover:bg-primary/5 hover:text-primary"
                            >
                                Hotels
                            </a>

                            <a
                                href="#"
                                class="rounded-lg border border-gray-200 bg-dark-50 px-3 py-1.5 text-xs font-medium text-dark-400 transition-colors hover:bg-primary/5 hover:text-primary"
                            >
                                Canada
                            </a>

                            <a
                                href="#"
                                class="rounded-lg border border-gray-200 bg-dark-50 px-3 py-1.5 text-xs font-medium text-dark-400 transition-colors hover:bg-primary/5 hover:text-primary"
                            >
                                Summer
                            </a>

                        </div>


                        {{-- Share --}}
                        <div class="mt-6 flex items-center gap-3">

                            <span class="text-sm font-medium text-dark-900">
                                Share:
                            </span>

                            <a
                                href="#"
                                class="flex h-9 w-9 items-center justify-center rounded-lg bg-dark-50 text-dark-400 transition-all hover:bg-primary hover:text-white"
                            >
                                <i class="fab fa-facebook-f text-xs"></i>
                            </a>

                            <a
                                href="#"
                                class="flex h-9 w-9 items-center justify-center rounded-lg bg-dark-50 text-dark-400 transition-all hover:bg-primary hover:text-white"
                            >
                                <i class="fab fa-twitter text-xs"></i>
                            </a>

                            <a
                                href="#"
                                class="flex h-9 w-9 items-center justify-center rounded-lg bg-dark-50 text-dark-400 transition-all hover:bg-primary hover:text-white"
                            >
                                <i class="fab fa-pinterest text-xs"></i>
                            </a>

                            <a
                                href="#"
                                class="flex h-9 w-9 items-center justify-center rounded-lg bg-dark-50 text-dark-400 transition-all hover:bg-primary hover:text-white"
                            >
                                <i class="fab fa-linkedin-in text-xs"></i>
                            </a>

                        </div>

                    </div>

                </article>


                {{-- =================================================
                     AUTHOR BIO
                ================================================== --}}
                <div
                    class="mt-8 flex flex-col gap-6 rounded-2xl border border-gray-100 bg-white p-8 sm:flex-row"
                    data-aos="fade-up"
                >

                    <img
                        decoding="async"
                        src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop&q=80"
                        alt="Kevin Martin"
                        class="h-24 w-24 flex-shrink-0 rounded-2xl object-cover"
                    >

                    <div>

                        <h4 class="text-lg font-semibold text-dark-900">
                            Kevin Martin
                        </h4>

                        <p class="mb-3 text-sm text-primary">
                            Travel Writer & Explorer
                        </p>

                        <p class="text-sm leading-relaxed text-dark-400">
                            Kevin is a passionate traveler and writer who has visited over
                            40 countries. He specializes in finding unique accommodations
                            and hidden gems that provide authentic local experiences.
                            Follow him for the latest travel tips and destination guides.
                        </p>

                        <div class="mt-4 flex gap-3">

                            <a
                                href="#"
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-dark-50 text-dark-400 transition-all hover:bg-primary hover:text-white"
                            >
                                <i class="fab fa-twitter text-xs"></i>
                            </a>

                            <a
                                href="#"
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-dark-50 text-dark-400 transition-all hover:bg-primary hover:text-white"
                            >
                                <i class="fab fa-facebook-f text-xs"></i>
                            </a>

                            <a
                                href="#"
                                class="flex h-8 w-8 items-center justify-center rounded-lg bg-dark-50 text-dark-400 transition-all hover:bg-primary hover:text-white"
                            >
                                <i class="fab fa-instagram text-xs"></i>
                            </a>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     COMMENTS
                ================================================== --}}
                <div
                    class="mt-8 rounded-2xl border border-gray-100 bg-white p-8"
                    data-aos="fade-up"
                >

                    <h3 class="mb-8 text-xl font-bold text-dark-900">
                        3 Comments
                    </h3>


                    {{-- Comment 1 --}}
                    <div class="mb-6 flex gap-4 border-b border-gray-100 pb-6">

                        <img
                            src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=100&h=100&fit=crop&q=80"
                            alt="Jessica Brown"
                            class="h-12 w-12 flex-shrink-0 rounded-full object-cover"
                        >

                        <div class="flex-1">

                            <div class="mb-2 flex items-center gap-3">

                                <h5 class="text-sm font-semibold text-dark-900">
                                    Jessica Brown
                                </h5>

                                <span class="text-xs text-dark-300">
                                    Aug 08, 2026
                                </span>

                            </div>

                            <p class="text-sm leading-relaxed text-dark-400">
                                This is such a great list! I visited Lake Louise last summer
                                and it was absolutely breathtaking. The Fairmont is definitely
                                worth the splurge. I'd also recommend checking out Tofino in BC
                                for a more laid-back beach vibe.
                            </p>

                            <button
                                type="button"
                                class="mt-3 text-xs font-medium text-primary transition-colors hover:text-primary-dark"
                            >
                                <i class="fas fa-reply mr-1"></i>
                                Reply
                            </button>

                        </div>

                    </div>


                    {{-- Comment 2 / Reply --}}
                    <div class="mb-6 ml-6 flex gap-4 border-b border-gray-100 pb-6 sm:ml-12">

                        <img
                            src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&q=80"
                            alt="Kevin Martin"
                            class="h-12 w-12 flex-shrink-0 rounded-full object-cover"
                        >

                        <div class="flex-1">

                            <div class="mb-2 flex flex-wrap items-center gap-3">

                                <h5 class="text-sm font-semibold text-dark-900">
                                    Kevin Martin
                                </h5>

                                <span class="rounded-full bg-primary/10 px-2 py-0.5 text-xs text-primary">
                                    Author
                                </span>

                                <span class="text-xs text-dark-300">
                                    Aug 08, 2026
                                </span>

                            </div>

                            <p class="text-sm leading-relaxed text-dark-400">
                                Thanks Jessica! Tofino is a fantastic recommendation.
                                I actually have it on my list for an upcoming article
                                about the best surf spots on the Canadian west coast.
                                Stay tuned!
                            </p>

                            <button
                                type="button"
                                class="mt-3 text-xs font-medium text-primary transition-colors hover:text-primary-dark"
                            >
                                <i class="fas fa-reply mr-1"></i>
                                Reply
                            </button>

                        </div>

                    </div>


                    {{-- Comment 3 --}}
                    <div class="flex gap-4">

                        <img
                            src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=100&h=100&fit=crop&q=80"
                            alt="David Chen"
                            class="h-12 w-12 flex-shrink-0 rounded-full object-cover"
                        >

                        <div class="flex-1">

                            <div class="mb-2 flex items-center gap-3">

                                <h5 class="text-sm font-semibold text-dark-900">
                                    David Chen
                                </h5>

                                <span class="text-xs text-dark-300">
                                    Aug 09, 2026
                                </span>

                            </div>

                            <p class="text-sm leading-relaxed text-dark-400">
                                I've been looking for exactly this kind of guide.
                                Planning a two-week road trip across Canada next summer
                                and this gives me some great starting points. Would love
                                to see a similar guide for winter destinations!
                            </p>

                            <button
                                type="button"
                                class="mt-3 text-xs font-medium text-primary transition-colors hover:text-primary-dark"
                            >
                                <i class="fas fa-reply mr-1"></i>
                                Reply
                            </button>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     COMMENT FORM
                ================================================== --}}
                <div
                    class="mt-8 rounded-2xl border border-gray-100 bg-white p-8"
                    data-aos="fade-up"
                >

                    <h3 class="mb-6 text-xl font-bold text-dark-900">
                        Leave a Comment
                    </h3>

                    <form
                        action="#"
                        method="POST"
                        class="space-y-4"
                    >

                        @csrf

                        <div class="grid gap-4 sm:grid-cols-2">

                            <input
                                type="text"
                                name="name"
                                placeholder="Your Name"
                                class="rounded-xl border border-gray-200 bg-dark-50 px-4 py-3 text-sm text-dark-900 placeholder:text-dark-300 transition-all focus:outline-none focus:ring-2 focus:ring-primary/30"
                            >

                            <input
                                type="email"
                                name="email"
                                placeholder="Your Email"
                                class="rounded-xl border border-gray-200 bg-dark-50 px-4 py-3 text-sm text-dark-900 placeholder:text-dark-300 transition-all focus:outline-none focus:ring-2 focus:ring-primary/30"
                            >

                        </div>

                        <textarea
                            name="comment"
                            rows="5"
                            placeholder="Write your comment..."
                            class="w-full resize-none rounded-xl border border-gray-200 bg-dark-50 px-4 py-3 text-sm text-dark-900 placeholder:text-dark-300 transition-all focus:outline-none focus:ring-2 focus:ring-primary/30"
                        ></textarea>

                        <button
                            type="submit"
                            class="rounded-xl bg-primary px-8 py-3 text-sm font-medium text-white shadow-lg shadow-primary/25 transition-colors hover:bg-primary-dark"
                        >
                            Post Comment
                        </button>

                    </form>

                </div>

            </div>


            {{-- =================================================
                 SIDEBAR
            ================================================== --}}
            <aside class="space-y-6">


                {{-- Search --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-6"
                    data-aos="fade-left"
                >

                    <h4 class="mb-4 font-semibold text-dark-900">
                        Search
                    </h4>

                    <form
                        action="{{ url('/blog') }}"
                        method="GET"
                        class="relative"
                    >

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search blog..."
                            class="w-full rounded-xl border border-gray-200 bg-dark-50 py-3 pl-4 pr-12 text-sm text-dark-900 placeholder:text-dark-300 transition-all focus:outline-none focus:ring-2 focus:ring-primary/30"
                        >

                        <button
                            type="submit"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-dark-300 transition-colors hover:text-primary"
                        >
                            <i class="fas fa-search"></i>
                        </button>

                    </form>

                </div>


                {{-- Categories --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-6"
                    data-aos="fade-left"
                    data-aos-delay="100"
                >

                    <h4 class="mb-4 font-semibold text-dark-900">
                        Categories
                    </h4>

                    <ul class="space-y-3">

                        <li>
                            <a
                                href="#"
                                class="flex items-center justify-between text-sm text-dark-400 transition-colors hover:text-primary"
                            >
                                <span>
                                    <i class="fas fa-chevron-right mr-2 text-xs text-primary/50"></i>
                                    Restaurant
                                </span>

                                <span class="rounded-lg bg-dark-50 px-2 py-0.5 text-xs text-dark-300">
                                    24
                                </span>
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="flex items-center justify-between text-sm text-dark-400 transition-colors hover:text-primary"
                            >
                                <span>
                                    <i class="fas fa-chevron-right mr-2 text-xs text-primary/50"></i>
                                    Hotels
                                </span>

                                <span class="rounded-lg bg-dark-50 px-2 py-0.5 text-xs text-dark-300">
                                    18
                                </span>
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="flex items-center justify-between text-sm text-dark-400 transition-colors hover:text-primary"
                            >
                                <span>
                                    <i class="fas fa-chevron-right mr-2 text-xs text-primary/50"></i>
                                    Shopping
                                </span>

                                <span class="rounded-lg bg-dark-50 px-2 py-0.5 text-xs text-dark-300">
                                    15
                                </span>
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="flex items-center justify-between text-sm text-dark-400 transition-colors hover:text-primary"
                            >
                                <span>
                                    <i class="fas fa-chevron-right mr-2 text-xs text-primary/50"></i>
                                    Travel
                                </span>

                                <span class="rounded-lg bg-dark-50 px-2 py-0.5 text-xs text-dark-300">
                                    32
                                </span>
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="flex items-center justify-between text-sm text-dark-400 transition-colors hover:text-primary"
                            >
                                <span>
                                    <i class="fas fa-chevron-right mr-2 text-xs text-primary/50"></i>
                                    Nightlife
                                </span>

                                <span class="rounded-lg bg-dark-50 px-2 py-0.5 text-xs text-dark-300">
                                    9
                                </span>
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="flex items-center justify-between text-sm text-dark-400 transition-colors hover:text-primary"
                            >
                                <span>
                                    <i class="fas fa-chevron-right mr-2 text-xs text-primary/50"></i>
                                    Business
                                </span>

                                <span class="rounded-lg bg-dark-50 px-2 py-0.5 text-xs text-dark-300">
                                    21
                                </span>
                            </a>
                        </li>

                    </ul>

                </div>


                {{-- Recent Posts --}}
                <div
                    class="rounded-2xl border border-gray-100 bg-white p-6"
                    data-aos="fade-left"
                    data-aos-delay="200"
                >

                    <h4 class="mb-4 font-semibold text-dark-900">
                        Recent Posts
                    </h4>

                    <div class="space-y-4">


                        {{-- Recent 1 --}}
                        <a
                            href="{{ url('/blog/leverage-agile-frameworks-better-listings') }}"
                            class="group flex gap-4"
                        >

                            <div class="img-zoom h-16 w-20 flex-shrink-0 overflow-hidden rounded-xl">

                                <img
                                    decoding="async"
                                    src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=160&h=128&fit=crop&q=80"
                                    alt="How to Leverage Agile Frameworks"
                                    class="h-full w-full object-cover"
                                    loading="lazy"
                                >

                            </div>

                            <div>

                                <h5 class="line-clamp-2 text-sm font-medium text-dark-900 transition-colors group-hover:text-primary">
                                    How to Leverage Agile Frameworks
                                </h5>

                                <span class="mt-1 text-xs text-dark-300">
                                    <i class="far fa-calendar mr-1"></i>
                                    Aug 05, 2026
                                </span>

                            </div>

                        </a>


                        {{-- Recent 2 --}}
                        <a
                            href="{{ url('/blog/win-win-survival-strategies-modern-directory') }}"
                            class="group flex gap-4"
                        >

                            <div class="img-zoom h-16 w-20 flex-shrink-0 overflow-hidden rounded-xl">

                                <img
                                    decoding="async"
                                    src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=160&h=128&fit=crop&q=80"
                                    alt="Win-Win Survival Strategies"
                                    class="h-full w-full object-cover"
                                    loading="lazy"
                                >

                            </div>

                            <div>

                                <h5 class="line-clamp-2 text-sm font-medium text-dark-900 transition-colors group-hover:text-primary">
                                    Win-Win Survival Strategies
                                </h5>

                                <span class="mt-1 text-xs text-dark-300">
                                    <i class="far fa-calendar mr-1"></i>
                                    Aug 02, 2026
                                </span>

                            </div>

                        </a>


                        {{-- Recent 3 --}}
                        <a
                            href="{{ url('/blog/tips-growing-business-online-directories') }}"
                            class="group flex gap-4"
                        >

                            <div class="img-zoom h-16 w-20 flex-shrink-0 overflow-hidden rounded-xl">

                                <img
                                    decoding="async"
                                    src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=160&h=128&fit=crop&q=80"
                                    alt="10 Tips for Growing Your Business"
                                    class="h-full w-full object-cover"
                                    loading="lazy"
                                >

                            </div>

                            <div>

                                <h5 class="line-clamp-2 text-sm font-medium text-dark-900 transition-colors group-hover:text-primary">
                                    10 Tips for Growing Your Business
                                </h5>

                                <span class="mt-1 text-xs text-dark-300">
                                    <i class="far fa-calendar mr-1"></i>
                                    Jul 28, 2026
                                </span>

                            </div>

                        </a>

                    </div>

                </div>


                {{-- Back to Blog CTA --}}
                <div
                    class="relative overflow-hidden rounded-2xl bg-dark-900 p-7"
                    data-aos="fade-left"
                >

                    <div class="bg-grid-dark absolute inset-0 opacity-30"></div>

                    <div class="relative">

                        <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                            <i class="fas fa-newspaper"></i>
                        </div>

                        <h3 class="text-xl font-bold text-white">
                            Explore More Articles
                        </h3>

                        <p class="mt-3 text-sm leading-6 text-white/60">
                            Discover more useful guides, business insights
                            and travel stories from our blog.
                        </p>

                        <a
                            href="{{ url('/blog') }}"
                            class="mt-6 inline-flex items-center gap-2 rounded-xl bg-primary px-5 py-3 text-sm font-semibold text-white transition hover:opacity-90"
                        >
                            View All Articles
                            <i class="fas fa-arrow-right"></i>
                        </a>

                    </div>

                </div>

            </aside>

        </div>

    </div>

</section>

@endsection

