
@extends('layouts.main')

@section('title', '500 — Something Went Wrong')

@section('content')

<!-- 500 Error Page -->
<section class="relative flex min-h-[75vh] items-center overflow-hidden bg-grid-dark py-20 lg:py-24">

    <div class="absolute inset-0 bg-gradient-to-br from-dark-900 via-dark-900 to-primary/20"></div>

    <div class="container relative z-10 mx-auto px-4">

        <div class="mx-auto max-w-3xl text-center">

            <!-- Error Icon -->
            <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-3xl bg-primary/10 text-primary shadow-xl sm:h-28 sm:w-28">
                <i class="fa-solid fa-server text-4xl sm:text-5xl"></i>
            </div>

            <!-- Error Code -->
            <div class="mt-8">
                <span class="text-7xl font-black tracking-tight text-white sm:text-8xl">
                    500
                </span>
            </div>

            <!-- Heading -->
            <h1 class="mt-5 text-3xl font-bold text-white sm:text-4xl">
                Something Went Wrong
            </h1>

            <!-- Description -->
            <p class="mx-auto mt-5 max-w-xl text-lg leading-8 text-dark-300">
                We're sorry, but something went wrong on our side.
                Please try again in a few moments.
            </p>

            <!-- Buttons -->
            <div class="mt-8 flex flex-col justify-center gap-3 sm:flex-row">

                <a href="{{ url('/') }}"
                   class="inline-flex items-center justify-center rounded-xl bg-primary px-7 py-3.5 font-semibold text-white transition hover:bg-primary-dark">
                    <i class="fa-solid fa-house mr-2"></i>
                    Back to Home
                </a>

                <button type="button"
                        onclick="window.location.reload()"
                        class="inline-flex items-center justify-center rounded-xl border border-white/20 px-7 py-3.5 font-semibold text-white transition hover:bg-white/10">
                    <i class="fa-solid fa-rotate-right mr-2"></i>
                    Try Again
                </button>

            </div>

        </div>

    </div>

</section>


<!-- Helpful Links -->
<section class="bg-dark-50 py-16">
    <div class="container mx-auto px-4">

        <div class="mx-auto max-w-2xl text-center">

            <h2 class="text-2xl font-bold text-dark-900 sm:text-3xl">
                Need Something Else?
            </h2>

            <p class="mt-3 text-dark-500">
                You can continue exploring Lokora using these helpful options.
            </p>

        </div>

        <div class="mx-auto mt-10 grid max-w-4xl gap-5 sm:grid-cols-3">

            <!-- Explore -->
            <a href="{{ url('/listings') }}"
               class="card-hover rounded-2xl border border-dark-100 bg-white p-6 text-center">

                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                    <i class="fa-solid fa-compass text-lg"></i>
                </div>

                <h3 class="mt-4 font-bold text-dark-900">
                    Explore Listings
                </h3>

                <p class="mt-2 text-sm leading-6 text-dark-500">
                    Find businesses and services in the directory.
                </p>

            </a>


            <!-- Contact -->
            <a href="{{ url('/contact-us') }}"
               class="card-hover rounded-2xl border border-dark-100 bg-white p-6 text-center">

                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                    <i class="fa-solid fa-envelope text-lg"></i>
                </div>

                <h3 class="mt-4 font-bold text-dark-900">
                    Contact Us
                </h3>

                <p class="mt-2 text-sm leading-6 text-dark-500">
                    Get in touch with our team if you need help.
                </p>

            </a>


            <!-- How It Works -->
            <a href="{{ url('/how-it-works') }}"
               class="card-hover rounded-2xl border border-dark-100 bg-white p-6 text-center">

                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                    <i class="fa-solid fa-circle-question text-lg"></i>
                </div>

                <h3 class="mt-4 font-bold text-dark-900">
                    How It Works
                </h3>

                <p class="mt-2 text-sm leading-6 text-dark-500">
                    Learn how to use the Lokora directory.
                </p>

            </a>

        </div>

    </div>
</section>

@endsection

