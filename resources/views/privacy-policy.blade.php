
@extends('layouts.main')

@section('title', 'Privacy Policy — Lokora Directory')

@section('content')

<!-- Page Header -->
<section class="relative overflow-hidden bg-grid-dark py-20 lg:py-24">
    <div class="absolute inset-0 bg-gradient-to-br from-dark-900 via-dark-900 to-primary/20"></div>

    <div class="container relative z-10 mx-auto px-4">
        <div class="mx-auto max-w-3xl text-center">

            <span class="mb-4 inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-semibold text-primary">
                <i class="fa-solid fa-shield-halved mr-2"></i>
                Privacy Policy
            </span>

            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl">
                Your Privacy <span class="text-primary">Matters</span>
            </h1>

            <p class="mx-auto mt-5 max-w-2xl text-lg leading-8 text-dark-300">
                This Privacy Policy explains how information may be collected,
                used, stored, and protected when you use Lokora.
            </p>

        </div>
    </div>
</section>


<!-- Privacy Content -->
<section class="py-16 lg:py-20">
    <div class="container mx-auto px-4">
        <div class="mx-auto max-w-4xl">

            <!-- Introduction -->
            <div class="rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <div class="mb-8 flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold text-dark-900">
                            Introduction
                        </h2>

                        <p class="text-sm text-dark-400">
                            Last updated: {{ date('F Y') }}
                        </p>
                    </div>
                </div>

                <p class="leading-8 text-dark-500">
                    At Lokora, we respect your privacy and aim to handle your
                    information responsibly. This Privacy Policy describes the
                    types of information that may be collected when you use our
                    website, directory, account features, and related services.
                </p>

            </div>


            <!-- 1 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <h2 class="text-2xl font-bold text-dark-900">
                    1. Information We May Collect
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    Depending on how you use Lokora, we may collect information
                    that you provide directly or information generated through
                    your interaction with the platform.
                </p>

                <ul class="mt-5 space-y-3 text-dark-500">

                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Name and contact information
                    </li>

                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Account and login information
                    </li>

                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Business information submitted for listings
                    </li>

                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Reviews, comments, images, and other submitted content
                    </li>

                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Messages and enquiries submitted through the website
                    </li>

                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Technical and usage information
                    </li>

                </ul>

            </div>


            <!-- 2 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <h2 class="text-2xl font-bold text-dark-900">
                    2. How We Use Information
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    Information may be used to operate, maintain, improve, and
                    personalize the Lokora platform.
                </p>

                <ul class="mt-5 space-y-3 text-dark-500">

                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Provide and manage directory services
                    </li>

                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Create and manage user accounts
                    </li>

                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Process business listings and enquiries
                    </li>

                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Respond to support requests
                    </li>

                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Improve website performance and user experience
                    </li>

                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        Detect misuse, fraud, or security issues
                    </li>

                </ul>

            </div>


            <!-- 3 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <h2 class="text-2xl font-bold text-dark-900">
                    3. Business Listing Information
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    When a business owner or authorized representative submits
                    a listing, information such as the business name,
                    description, category, contact details, website,
                    location, images, and other listing information may be
                    displayed publicly.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    Businesses should avoid submitting sensitive personal
                    information that is not necessary for their public listing.
                </p>

            </div>


            <!-- 4 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <h2 class="text-2xl font-bold text-dark-900">
                    4. Cookies and Similar Technologies
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    Lokora may use cookies or similar technologies to support
                    essential website functionality, remember preferences,
                    understand usage patterns, and improve the overall user
                    experience.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    You may be able to manage or disable cookies through your
                    browser settings. Some website features may not work as
                    intended if certain cookies are disabled.
                </p>

            </div>


            <!-- 5 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <h2 class="text-2xl font-bold text-dark-900">
                    5. Information Sharing
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    We do not intend to sell personal information simply because
                    you use the directory. Information may be shared when
                    reasonably necessary to provide services, operate the
                    platform, protect users, comply with legal obligations, or
                    support legitimate business operations.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    Public business listing information may be visible to
                    visitors because the purpose of a directory is to help
                    people discover businesses.
                </p>

            </div>


            <!-- 6 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <h2 class="text-2xl font-bold text-dark-900">
                    6. Third-Party Services
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    Certain features may rely on third-party services such as
                    hosting providers, analytics tools, email services,
                    payment providers, maps, or other technology providers.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    These providers may process information according to their
                    own terms and privacy policies.
                </p>

            </div>


            <!-- 7 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <h2 class="text-2xl font-bold text-dark-900">
                    7. Data Security
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    Reasonable technical and organizational measures may be used
                    to protect information from unauthorized access, loss,
                    misuse, alteration, or disclosure.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    However, no internet transmission or electronic storage
                    system can be guaranteed to be completely secure.
                </p>

            </div>


            <!-- 8 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <h2 class="text-2xl font-bold text-dark-900">
                    8. Data Retention
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    Information may be retained for as long as reasonably
                    necessary for the purposes described in this policy,
                    including providing services, maintaining records,
                    resolving disputes, preventing misuse, and meeting legal
                    obligations.
                </p>

            </div>


            <!-- 9 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <h2 class="text-2xl font-bold text-dark-900">
                    9. Your Choices
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    Depending on the applicable law and the features available
                    on the platform, you may have options regarding your
                    personal information, including requesting access,
                    correction, or deletion of certain information.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    You may contact us if you have a privacy-related request or
                    concern.
                </p>

            </div>


            <!-- 10 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <h2 class="text-2xl font-bold text-dark-900">
                    10. Children's Privacy
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    Lokora is not intended to knowingly collect personal
                    information from children where such collection is
                    restricted by applicable law.
                </p>

            </div>


            <!-- 11 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">

                <h2 class="text-2xl font-bold text-dark-900">
                    11. Changes to This Privacy Policy
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    This Privacy Policy may be updated periodically to reflect
                    changes in our services, technology, legal requirements, or
                    privacy practices.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    Any updated version will be published on this page with a
                    revised date.
                </p>

            </div>


            <!-- Contact CTA -->
            <div class="mt-8 rounded-3xl bg-dark-900 p-8 text-center sm:p-10">

                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-primary text-white">
                    <i class="fa-solid fa-lock text-xl"></i>
                </div>

                <h2 class="mt-5 text-2xl font-bold text-white">
                    Privacy Questions?
                </h2>

                <p class="mx-auto mt-3 max-w-xl leading-7 text-dark-300">
                    If you have questions about how information is handled on
                    Lokora, please contact our team.
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

