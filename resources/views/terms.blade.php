
@extends('layouts.main')

@section('title', 'Terms & Conditions — Lokora Directory')

@section('content')

<!-- Page Header -->
<section class="relative overflow-hidden bg-grid-dark py-20 lg:py-24">
    <div class="absolute inset-0 bg-gradient-to-br from-dark-900 via-dark-900 to-primary/20"></div>

    <div class="container relative z-10 mx-auto px-4">
        <div class="mx-auto max-w-3xl text-center">
            <span class="mb-4 inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-semibold text-primary">
                <i class="fa-solid fa-file-contract mr-2"></i>
                Terms & Conditions
            </span>

            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl">
                Terms & <span class="text-primary">Conditions</span>
            </h1>

            <p class="mx-auto mt-5 max-w-2xl text-lg leading-8 text-dark-300">
                Please read these terms carefully before using the Lokora
                directory and its services.
            </p>
        </div>
    </div>
</section>


<!-- Terms Content -->
<section class="py-16 lg:py-20">
    <div class="container mx-auto px-4">
        <div class="mx-auto max-w-4xl">

            <!-- Introduction -->
            <div class="rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">
                <div class="mb-8 flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary/10 text-primary">
                        <i class="fa-solid fa-circle-info"></i>
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
                    Welcome to Lokora. By accessing or using this website,
                    directory, and related services, you agree to comply with
                    these Terms & Conditions. If you do not agree with any part
                    of these terms, please do not use the platform.
                </p>
            </div>


            <!-- Section 1 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">
                <h2 class="text-2xl font-bold text-dark-900">
                    1. Use of the Platform
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    Lokora provides an online platform that allows users to
                    discover businesses, services, products, and other
                    publicly available information.
                </p>

                <ul class="mt-5 space-y-3 text-dark-500">
                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        You must use the platform only for lawful purposes.
                    </li>
                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        You must not misuse or interfere with the operation of the website.
                    </li>
                    <li class="flex gap-3">
                        <i class="fa-solid fa-check mt-1 text-primary"></i>
                        You must not use the platform to submit fraudulent or misleading information.
                    </li>
                </ul>
            </div>


            <!-- Section 2 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">
                <h2 class="text-2xl font-bold text-dark-900">
                    2. Business Listings
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    Businesses may submit information for listing on Lokora.
                    Business owners and authorized representatives are
                    responsible for ensuring that the information they provide
                    is accurate, current, and complete.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    Lokora may review, modify, reject, suspend, or remove a
                    listing where information violates applicable requirements
                    or these Terms & Conditions.
                </p>
            </div>


            <!-- Section 3 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">
                <h2 class="text-2xl font-bold text-dark-900">
                    3. User Accounts
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    Certain features may require an account. You are responsible
                    for maintaining the confidentiality of your login
                    credentials and for activity performed through your account.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    If you believe your account has been accessed without
                    authorization, you should notify the platform as soon as
                    reasonably possible.
                </p>
            </div>


            <!-- Section 4 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">
                <h2 class="text-2xl font-bold text-dark-900">
                    4. Reviews and User Content
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    Users may be able to submit reviews, comments, images, or
                    other content. Users are responsible for the content they
                    submit.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    Content must not be unlawful, defamatory, abusive,
                    misleading, fraudulent, or infringe the rights of another
                    person or organization.
                </p>
            </div>


            <!-- Section 5 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">
                <h2 class="text-2xl font-bold text-dark-900">
                    5. Intellectual Property
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    Unless otherwise stated, the website design, branding,
                    graphics, text, software, and other original materials
                    provided by Lokora are protected by applicable intellectual
                    property laws.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    You may not reproduce, distribute, modify, or commercially
                    exploit protected material without appropriate permission.
                </p>
            </div>


            <!-- Section 6 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">
                <h2 class="text-2xl font-bold text-dark-900">
                    6. Third-Party Businesses and Links
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    Lokora may display information about third-party businesses
                    and may provide links to external websites.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    Third-party businesses, products, services, offers, and
                    websites are operated independently. Users should verify
                    relevant information directly with the applicable business
                    before making a decision or transaction.
                </p>
            </div>


            <!-- Section 7 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">
                <h2 class="text-2xl font-bold text-dark-900">
                    7. Advertising
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    Businesses may have opportunities to advertise or promote
                    their listings on the platform. Advertising arrangements,
                    availability, pricing, placement, and applicable terms may
                    vary.
                </p>
            </div>


            <!-- Section 8 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">
                <h2 class="text-2xl font-bold text-dark-900">
                    8. Availability of Services
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    We aim to keep Lokora available and useful, but we do not
                    guarantee that the website or every feature will always be
                    available, uninterrupted, secure, or error-free.
                </p>
            </div>


            <!-- Section 9 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">
                <h2 class="text-2xl font-bold text-dark-900">
                    9. Limitation of Liability
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    Information displayed on a directory platform may come from
                    businesses, users, public sources, or other third parties.
                    Users should independently verify important information
                    before relying on it.
                </p>

                <p class="mt-4 leading-8 text-dark-500">
                    To the extent permitted by applicable law, Lokora is not
                    responsible for losses resulting from reliance on third-party
                    information, business services, transactions, or external
                    websites.
                </p>
            </div>


            <!-- Section 10 -->
            <div class="mt-6 rounded-3xl border border-dark-100 bg-white p-7 shadow-sm sm:p-10">
                <h2 class="text-2xl font-bold text-dark-900">
                    10. Changes to These Terms
                </h2>

                <p class="mt-4 leading-8 text-dark-500">
                    We may update these Terms & Conditions from time to time.
                    Changes will become effective when the updated terms are
                    published on this page.
                </p>
            </div>


            <!-- Contact -->
            <div class="mt-8 rounded-3xl bg-dark-900 p-8 text-center sm:p-10">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-primary text-white">
                    <i class="fa-solid fa-envelope text-xl"></i>
                </div>

                <h2 class="mt-5 text-2xl font-bold text-white">
                    Questions About These Terms?
                </h2>

                <p class="mx-auto mt-3 max-w-xl leading-7 text-dark-300">
                    If you have questions or concerns about these Terms &
                    Conditions, please contact us.
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

