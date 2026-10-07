
@extends('layouts.main')

@section('title', 'Advertise With Us — Lokora Directory')

@section('content')

<!-- Page Header -->
<section class="relative overflow-hidden bg-grid-dark py-20 lg:py-24">
    <div class="absolute inset-0 bg-gradient-to-br from-dark-900 via-dark-900 to-primary/20"></div>

    <div class="container relative z-10 mx-auto px-4">
        <div class="mx-auto max-w-3xl text-center">
            <span class="mb-4 inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-semibold text-primary">
                <i class="fa-solid fa-bullhorn mr-2"></i>
                Advertise With Us
            </span>

            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Put Your Business
                <span class="text-primary">In Front of More Customers</span>
            </h1>

            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-dark-300">
                Reach people who are actively searching for businesses, services,
                products and local solutions through Lokora.
            </p>
        </div>
    </div>
</section>


<!-- Introduction -->
<section class="py-20 lg:py-24">
    <div class="container mx-auto px-4">
        <div class="grid items-center gap-12 lg:grid-cols-2">

            <!-- Image -->
            <div class="relative">
                <div class="overflow-hidden rounded-3xl">
                    <img
                        src="https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1200&q=80"
                        alt="Business advertising and marketing"
                        class="h-full min-h-[420px] w-full object-cover"
                    >
                </div>

                <div class="absolute -bottom-6 -right-4 hidden rounded-2xl bg-white p-5 shadow-xl sm:block lg:-right-6">
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                            <i class="fa-solid fa-chart-line text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-dark-400">Grow Your</p>
                            <p class="font-bold text-dark-900">Business Visibility</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div>
                <span class="text-sm font-bold uppercase tracking-wider text-primary">
                    Grow With Lokora
                </span>

                <h2 class="mt-3 text-3xl font-bold text-dark-900 sm:text-4xl">
                    Make Your Business Easier to Discover
                </h2>

                <p class="mt-5 leading-8 text-dark-500">
                    Lokora helps businesses connect with people who are looking
                    for products and services. Advertising on the platform can
                    give your business additional visibility across relevant
                    categories and locations.
                </p>

                <div class="mt-8 space-y-5">

                    <div class="flex gap-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-dark-900">Increase Visibility</h3>
                            <p class="mt-1 text-sm leading-6 text-dark-500">
                                Give your business more opportunities to be discovered
                                by relevant visitors.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-dark-900">Reach Local Customers</h3>
                            <p class="mt-1 text-sm leading-6 text-dark-500">
                                Promote your business in the locations and categories
                                that matter to you.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-primary/10 text-primary">
                            <i class="fa-solid fa-arrow-trend-up"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-dark-900">Build Your Presence</h3>
                            <p class="mt-1 text-sm leading-6 text-dark-500">
                                Create a stronger online presence and make it easier
                                for potential customers to connect with you.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>


<!-- Advertising Options -->
<section class="bg-dark-50 py-20 lg:py-24">
    <div class="container mx-auto px-4">

        <div class="mx-auto max-w-2xl text-center">
            <span class="text-sm font-bold uppercase tracking-wider text-primary">
                Advertising Options
            </span>

            <h2 class="mt-3 text-3xl font-bold text-dark-900 sm:text-4xl">
                Ways to Promote Your Business
            </h2>

            <p class="mt-4 leading-7 text-dark-500">
                Choose an advertising option based on your business goals and
                visibility requirements.
            </p>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">

            <!-- Featured Listing -->
            <div class="card-hover rounded-3xl bg-white p-7 shadow-sm">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                    <i class="fa-solid fa-star text-xl"></i>
                </div>

                <h3 class="mt-6 text-xl font-bold text-dark-900">
                    Featured Listing
                </h3>

                <p class="mt-3 leading-7 text-dark-500">
                    Highlight your business and give your listing additional
                    visibility across relevant directory sections.
                </p>

                <ul class="mt-6 space-y-3 text-sm text-dark-500">
                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Enhanced listing visibility
                    </li>
                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Featured placement
                    </li>
                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Business profile promotion
                    </li>
                </ul>
            </div>


            <!-- Category Promotion -->
            <div class="card-hover rounded-3xl bg-white p-7 shadow-sm">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                    <i class="fa-solid fa-layer-group text-xl"></i>
                </div>

                <h3 class="mt-6 text-xl font-bold text-dark-900">
                    Category Promotion
                </h3>

                <p class="mt-3 leading-7 text-dark-500">
                    Promote your business within relevant categories so visitors
                    can discover your services more easily.
                </p>

                <ul class="mt-6 space-y-3 text-sm text-dark-500">
                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Category-focused promotion
                    </li>
                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Relevant audience exposure
                    </li>
                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Better discoverability
                    </li>
                </ul>
            </div>


            <!-- Business Promotion -->
            <div class="card-hover rounded-3xl bg-white p-7 shadow-sm">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                    <i class="fa-solid fa-bullhorn text-xl"></i>
                </div>

                <h3 class="mt-6 text-xl font-bold text-dark-900">
                    Business Promotion
                </h3>

                <p class="mt-3 leading-7 text-dark-500">
                    Promote your brand with dedicated advertising opportunities
                    designed around your business objectives.
                </p>

                <ul class="mt-6 space-y-3 text-sm text-dark-500">
                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Promotional opportunities
                    </li>
                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Brand visibility
                    </li>
                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Flexible advertising options
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>


<!-- Why Advertise -->
<section class="py-20 lg:py-24">
    <div class="container mx-auto px-4">

        <div class="mx-auto max-w-2xl text-center">
            <span class="text-sm font-bold uppercase tracking-wider text-primary">
                Why Advertise
            </span>

            <h2 class="mt-3 text-3xl font-bold text-dark-900 sm:text-4xl">
                Built Around Business Visibility
            </h2>

            <p class="mt-4 leading-7 text-dark-500">
                Advertising can help you put your business in front of people
                when they are actively exploring relevant listings.
            </p>
        </div>

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">

            <div class="card-hover rounded-3xl border border-dark-100 bg-white p-6 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h3 class="mt-5 font-bold text-dark-900">More Exposure</h3>
                <p class="mt-2 text-sm leading-6 text-dark-500">
                    Help more visitors discover your business.
                </p>
            </div>

            <div class="card-hover rounded-3xl border border-dark-100 bg-white p-6 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <h3 class="mt-5 font-bold text-dark-900">Search Discovery</h3>
                <p class="mt-2 text-sm leading-6 text-dark-500">
                    Appear where users are searching for relevant businesses.
                </p>
            </div>

            <div class="card-hover rounded-3xl border border-dark-100 bg-white p-6 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                    <i class="fa-solid fa-location-crosshairs"></i>
                </div>
                <h3 class="mt-5 font-bold text-dark-900">Local Reach</h3>
                <p class="mt-2 text-sm leading-6 text-dark-500">
                    Connect your business with relevant locations.
                </p>
            </div>

            <div class="card-hover rounded-3xl border border-dark-100 bg-white p-6 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-primary/10 text-primary">
                    <i class="fa-solid fa-chart-simple"></i>
                </div>
                <h3 class="mt-5 font-bold text-dark-900">Business Growth</h3>
                <p class="mt-2 text-sm leading-6 text-dark-500">
                    Create additional opportunities to reach potential customers.
                </p>
            </div>

        </div>
    </div>
</section>


<!-- Contact / CTA -->
<section class="relative overflow-hidden bg-dark-900 py-20 lg:py-24">
    <div class="absolute inset-0 bg-grid-dark opacity-50"></div>

    <div class="container relative z-10 mx-auto px-4">
        <div class="mx-auto max-w-3xl text-center">

            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-primary text-white shadow-lg">
                <i class="fa-solid fa-comments text-2xl"></i>
            </div>

            <h2 class="mt-7 text-3xl font-bold text-white sm:text-4xl">
                Interested in Advertising?
            </h2>

            <p class="mx-auto mt-4 max-w-2xl leading-7 text-dark-300">
                Tell us about your business and the type of visibility you are
                looking for. Our team can help you understand the available
                advertising opportunities.
            </p>

            <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">

                <a href="{{ url('/contact-us') }}"
                   class="inline-flex items-center justify-center rounded-xl bg-primary px-7 py-3.5 font-semibold text-white transition hover:bg-primary-dark">
                    <i class="fa-solid fa-paper-plane mr-2"></i>
                    Contact Us
                </a>

                <a href="{{ url('/listings') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-white/20 px-7 py-3.5 font-semibold text-white transition hover:bg-white/10">
                    Explore Directory
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>

            </div>
        </div>
    </div>
</section>

@endsection

