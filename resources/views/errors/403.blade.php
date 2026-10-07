
@extends('layouts.main')

@section('title', '403 — Access Forbidden')

@section('content')

<!-- Error Hero -->
<section class="relative overflow-hidden bg-[#161c26] py-24 lg:py-32">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute inset-0 bg-grid-dark"></div>
    </div>

    <div class="relative mx-auto max-w-4xl px-6 text-center lg:px-8">

        <!-- Icon -->
        <div class="mx-auto mb-8 flex h-24 w-24 items-center justify-center rounded-3xl bg-primary/10">
            <svg class="h-12 w-12 text-primary"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="1.8"
                      d="M12 15v2m-6 4h12a2 2 0 002-2V11a8 8 0 10-16 0v8a2 2 0 002 2zm3-10V9a3 3 0 016 0v2"/>
            </svg>
        </div>

        <!-- Error Code -->
        <div class="mb-4 text-7xl font-bold tracking-tight text-white sm:text-8xl">
            403
        </div>

        <h1 class="mb-5 text-3xl font-bold text-white sm:text-4xl">
            Access Forbidden
        </h1>

        <p class="mx-auto max-w-2xl text-lg leading-8 text-dark-400">
            You don't have permission to access this page or resource.
            Please make sure you're using the correct account or return to a safe page.
        </p>

        <!-- Buttons -->
        <div class="mt-10 flex flex-col justify-center gap-4 sm:flex-row">

            <a href="{{ url('/') }}"
               class="inline-flex items-center justify-center rounded-xl bg-primary px-6 py-3.5 font-semibold text-white transition hover:bg-primary-dark">

                <svg class="mr-2 h-5 w-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"/>
                </svg>

                Back to Home
            </a>

            <a href="{{ url('/listings') }}"
               class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-6 py-3.5 font-semibold text-white transition hover:bg-white/10">

                <svg class="mr-2 h-5 w-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                Browse Listings
            </a>

        </div>

    </div>
</section>


<!-- Helpful Links -->
<section class="bg-white py-20">
    <div class="mx-auto max-w-6xl px-6 lg:px-8">

        <div class="mb-12 text-center">

            <span class="mb-3 inline-block text-sm font-semibold uppercase tracking-wider text-primary">
                Need Another Page?
            </span>

            <h2 class="text-3xl font-bold text-dark-900 sm:text-4xl">
                Explore BizDirectory
            </h2>

            <p class="mx-auto mt-4 max-w-2xl text-dark-400">
                You can continue browsing the directory or contact us if you
                believe you should have access to this page.
            </p>

        </div>


        <div class="grid gap-6 md:grid-cols-3">

            <!-- Listings -->
            <a href="{{ url('/listings') }}"
               class="card-hover group rounded-2xl border border-gray-100 bg-white p-7 shadow-sm">

                <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary transition group-hover:bg-primary group-hover:text-white">

                    <svg class="h-6 w-6"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>

                </div>

                <h3 class="mb-2 text-lg font-bold text-dark-900">
                    Browse Listings
                </h3>

                <p class="text-sm leading-6 text-dark-400">
                    Explore businesses, services and places available in our directory.
                </p>

            </a>


            <!-- How It Works -->
            <a href="{{ url('/how-it-works') }}"
               class="card-hover group rounded-2xl border border-gray-100 bg-white p-7 shadow-sm">

                <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary transition group-hover:bg-primary group-hover:text-white">

                    <svg class="h-6 w-6"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000-16"/>
                    </svg>

                </div>

                <h3 class="mb-2 text-lg font-bold text-dark-900">
                    How It Works
                </h3>

                <p class="text-sm leading-6 text-dark-400">
                    Learn more about how BizDirectory works.
                </p>

            </a>


            <!-- Contact -->
            <a href="{{ url('/contact-us') }}"
               class="card-hover group rounded-2xl border border-gray-100 bg-white p-7 shadow-sm">

                <div class="mb-5 flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary transition group-hover:bg-primary group-hover:text-white">

                    <svg class="h-6 w-6"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="1.8"
                              d="M3 8l9 6 9-6M5 5h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2z"/>
                    </svg>

                </div>

                <h3 class="mb-2 text-lg font-bold text-dark-900">
                    Contact Us
                </h3>

                <p class="text-sm leading-6 text-dark-400">
                    If you believe this is a mistake, contact our support team.
                </p>

            </a>

        </div>

    </div>
</section>

@endsection
