
@extends('layouts.main')

@section('title', 'Disclaimer — Lokora Directory')

@section('content')

<!-- Page Header -->
<section class="relative overflow-hidden bg-grid-dark py-20 lg:py-24">
    <div class="absolute inset-0 bg-gradient-to-br from-dark-900 via-dark-900 to-primary/20"></div>

    <div class="container relative z-10 mx-auto px-4">
        <div class="mx-auto max-w-3xl text-center">

            <span class="mb-4 inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-semibold text-primary">
                <i class="fa-solid fa-triangle-exclamation mr-2"></i>
                Disclaimer
            </span>

            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl">
                Important <span class="text-primary">Disclaimer</span>
            </h1>

            <p class="mx-auto mt-5 max-w-2xl text-lg leading-8 text-dark-300">
                Important information about business listings, third-party
                content, advertisements, and information available on Lokora.
            </p>

        </div>
    </div>
</section>


<!-- Disclaimer Content -->
<section class="py-16 lg:py-20">
    <div class="container mx-auto px-4">
        <div class="mx-auto max-w-4xl">

            <!-- General Information -->
            <div class="rounded-3xl border border-primary/20 bg-primary/5 p-7 sm:p-10">

                <div class="flex gap-5">

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-primary text-white">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold text-dark-900">
                            General Information
                        </h2>

                        <p class="mt-3 leading-8 text-dark-500">
                            The information provided on Lokora is intended for
                            general informational and directory purposes only.
                            While reasonable efforts may be made to maintain
                            useful and accurate information, we do not guarantee
                            that every piece of information is complete,
                            current, or error-free.
                        </p>
                    </div>

                </div>

            </div>


            <!-- Business Information -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <div class="flex items-center gap-4">

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <i class="fa-solid fa-building"></i>
                    </div>

                    <h2 class="text-2xl font-bold text-dark-900">
                        Business Information
                    </h2>

                </div>

                <p class="mt-5 leading-8 text-dark-500">
                    Business profiles may contain information submitted by
                    business owners, representatives, users, public sources,
                    or other third parties.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    The presence of a business on Lokora does not by itself
                    constitute an endorsement, certification, guarantee, or
                    recommendation of that business or its products and services.
                </p>

            </div>


            <!-- Accuracy of Information -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <div class="flex items-center gap-4">

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>

                    <h2 class="text-2xl font-bold text-dark-900">
                        Accuracy of Information
                    </h2>

                </div>

                <p class="mt-5 leading-8 text-dark-500">
                    Business details such as names, addresses, phone numbers,
                    opening hours, pricing, services, images, websites, and
                    other information may change over time.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    Users should verify important information directly with the
                    relevant business before visiting, purchasing a product,
                    booking a service, or entering into a transaction.
                </p>

            </div>


            <!-- Third Party -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <div class="flex items-center gap-4">

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <i class="fa-solid fa-link"></i>
                    </div>

                    <h2 class="text-2xl font-bold text-dark-900">
                        Third-Party Websites & Services
                    </h2>

                </div>

                <p class="mt-5 leading-8 text-dark-500">
                    Lokora may contain links to third-party websites or
                    services. These websites are operated independently from
                    Lokora and may have their own terms, policies, and privacy
                    practices.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    We are not responsible for the content, availability,
                    accuracy, security, or practices of external websites.
                </p>

            </div>


            <!-- Reviews -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <div class="flex items-center gap-4">

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <i class="fa-solid fa-star"></i>
                    </div>

                    <h2 class="text-2xl font-bold text-dark-900">
                        Reviews & User Opinions
                    </h2>

                </div>

                <p class="mt-5 leading-8 text-dark-500">
                    Reviews, ratings, comments, and opinions published by users
                    represent the views of their respective authors and not
                    necessarily those of Lokora.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    Users should consider multiple sources of information when
                    evaluating a business, product, or service.
                </p>

            </div>


            <!-- Advertising -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <div class="flex items-center gap-4">

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>

                    <h2 class="text-2xl font-bold text-dark-900">
                        Advertising & Sponsored Content
                    </h2>

                </div>

                <p class="mt-5 leading-8 text-dark-500">
                    Some businesses or listings may be promoted through paid
                    advertising or other promotional arrangements.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    Advertising or promotional placement should not be
                    interpreted as a guarantee of the quality, performance,
                    reliability, or suitability of a business or its services.
                </p>

            </div>


            <!-- No Professional Advice -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <div class="flex items-center gap-4">

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>

                    <h2 class="text-2xl font-bold text-dark-900">
                        No Professional Advice
                    </h2>

                </div>

                <p class="mt-5 leading-8 text-dark-500">
                    Information available through the platform should not be
                    considered legal, financial, medical, tax, professional,
                    or other specialized advice.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    Where professional advice is required, users should consult
                    a suitably qualified professional.
                </p>

            </div>


            <!-- Limitation -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <div class="flex items-center gap-4">

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>

                    <h2 class="text-2xl font-bold text-dark-900">
                        Limitation of Responsibility
                    </h2>

                </div>

                <p class="mt-5 leading-8 text-dark-500">
                    To the extent permitted by applicable law, Lokora does not
                    accept responsibility for losses, damages, disputes, or
                    other consequences arising from reliance on information
                    provided through the directory or from dealings with
                    third-party businesses.
                </p>

            </div>


            <!-- Changes -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <div class="flex items-center gap-4">

                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <i class="fa-solid fa-rotate"></i>
                    </div>

                    <h2 class="text-2xl font-bold text-dark-900">
                        Changes to This Disclaimer
                    </h2>

                </div>

                <p class="mt-5 leading-8 text-dark-500">
                    This Disclaimer may be updated from time to time to reflect
                    changes to the platform, services, or applicable
                    requirements. Updated information will be published on
                    this page.
                </p>

            </div>


            <!-- Contact CTA -->
            <div class="mt-8 overflow-hidden rounded-3xl bg-dark-900 p-8 text-center sm:p-10">

                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-primary text-white">
                    <i class="fa-solid fa-envelope text-xl"></i>
                </div>

                <h2 class="mt-5 text-2xl font-bold text-white">
                    Have a Question?
                </h2>

                <p class="mx-auto mt-3 max-w-xl leading-7 text-dark-300">
                    If you have questions about the information displayed on
                    Lokora or this Disclaimer, please get in touch with us.
                </p>

                <a href="{{ url('/contact-us') }}"
                   class="mt-6 inline-flex items-center rounded-xl bg-primary px-6 py-3 font-semibold text-white transition hover:bg-primary-dark">
                    Contact Us
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>

            </div>

        </div>
    </div>
</section>

@endsection

