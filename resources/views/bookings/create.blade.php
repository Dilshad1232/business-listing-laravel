@extends('layouts.main')

@section('content')

@php
    $businessName = $business->name ?? 'Business';
    $businessLocation = collect([
        $business->area?->name,
        $business->city?->name,
        $business->state?->name,
    ])->filter()->implode(', ');
@endphp

<div class="bg-dark-50 min-h-screen">

    {{-- =========================================================
        HERO
    ========================================================== --}}
    <section class="relative overflow-hidden bg-dark-900">

        <div class="absolute inset-0 bg-grid-dark opacity-40"></div>

        <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-primary/20 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-80 h-80 rounded-full bg-primary/10 blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-sm text-gray-400 mb-8">
                <a href="{{ url('/') }}" class="hover:text-white transition">
                    Home
                </a>

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="m9 5 7 7-7 7"/>
                </svg>

                <a href="{{ route('businesses.index') }}"
                   class="hover:text-white transition">
                    Businesses
                </a>

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="m9 5 7 7-7 7"/>
                </svg>

                <span class="text-gray-300">
                    Book Appointment
                </span>
            </div>

            <div class="max-w-3xl">

                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full
                            bg-primary/10 border border-primary/20
                            text-primary text-sm font-semibold mb-5">

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z"/>
                    </svg>

                    Appointment Booking
                </div>

                <h1 class="text-4xl sm:text-5xl font-bold text-white leading-tight">
                    Book an Appointment
                </h1>

                <p class="mt-5 text-lg text-gray-400 leading-relaxed">
                    Schedule your appointment with
                    <span class="text-white font-semibold">
                        {{ $businessName }}
                    </span>
                    in just a few simple steps.
                </p>

                @if($businessLocation)
                    <div class="mt-6 flex items-center gap-2 text-gray-400">

                        <svg class="w-5 h-5 text-primary"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 21s7-4.35 7-10a7 7 0 1 0-14 0c0 5.65 7 10 7 10Z"/>

                            <circle cx="12"
                                    cy="11"
                                    r="2.5"
                                    stroke-width="2"/>
                        </svg>

                        {{ $businessLocation }}
                    </div>
                @endif

            </div>

        </div>
    </section>


    {{-- =========================================================
        MAIN
    ========================================================== --}}
    <section class="py-12 sm:py-16">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid lg:grid-cols-3 gap-8">

                {{-- =================================================
                    BOOKING FORM
                ================================================== --}}
                <div class="lg:col-span-2">

                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">

                        <div class="p-6 sm:p-8 border-b border-gray-100">

                            <div class="flex items-start gap-4">

                                <div class="w-12 h-12 rounded-xl bg-primary/10
                                            flex items-center justify-center shrink-0">

                                    <svg class="w-6 h-6 text-primary"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12Z"/>

                                    </svg>

                                </div>

                                <div>
                                    <h2 class="text-2xl font-bold text-dark-900">
                                        Appointment Details
                                    </h2>

                                    <p class="mt-1 text-gray-500">
                                        Select a service, choose your preferred date and time,
                                        and provide your contact details.
                                    </p>
                                </div>

                            </div>

                        </div>


                        {{-- SUCCESS --}}
                        @if(session('booking_success'))

                            <div class="mx-6 sm:mx-8 mt-6 p-4 rounded-xl
                                        bg-green-50 border border-green-200
                                        text-green-800">

                                <div class="flex gap-3">

                                    <svg class="w-5 h-5 mt-0.5 shrink-0"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="m5 12 4 4L19 6"/>

                                    </svg>

                                    <div>
                                        <p class="font-semibold">
                                            Booking Submitted
                                        </p>

                                        <p class="text-sm mt-1">
                                            {{ session('booking_success') }}
                                        </p>
                                    </div>

                                </div>

                            </div>

                        @endif


                        {{-- ERRORS --}}
                        @if($errors->any())

                            <div class="mx-6 sm:mx-8 mt-6 p-4 rounded-xl
                                        bg-red-50 border border-red-200
                                        text-red-800">

                                <div class="font-semibold mb-2">
                                    Please correct the following:
                                </div>

                                <ul class="list-disc list-inside text-sm space-y-1">

                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach

                                </ul>

                            </div>

                        @endif


                        <form
                            method="POST"
                            action="{{ route('bookings.store', $business->slug) }}"
                            class="p-6 sm:p-8"
                            id="bookingForm"
                        >

                            @csrf


                            {{-- =========================================
                                SERVICE
                            ========================================== --}}
                            <div class="mb-8">

                                <label for="bookingService"
                                       class="block text-sm font-semibold text-dark-900 mb-2">

                                    Select Service
                                    <span class="text-red-500">*</span>

                                </label>

                                <select
                                    name="business_service_id"
                                    id="bookingService"
                                    required
                                    class="w-full rounded-xl border border-gray-200
                                           bg-white px-4 py-3.5
                                           text-dark-900
                                           focus:border-primary
                                           focus:ring-2 focus:ring-primary/20
                                           outline-none transition"
                                >

                                    <option value="">
                                        Select a service
                                    </option>

                                    @forelse($business->services as $service)

                                        <option
                                            value="{{ $service->id }}"
                                            data-price="{{ $service->price ?? 0 }}"
                                            @selected(old('business_service_id') == $service->id)
                                        >
                                            {{ $service->name }}

                                            @if(!is_null($service->price))
                                                — ₹{{ number_format($service->price, 2) }}
                                            @endif
                                        </option>

                                    @empty

                                        <option value="" disabled>
                                            No services available
                                        </option>

                                    @endforelse

                                </select>

                                @error('business_service_id')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- =========================================
                                OFFERS
                            ========================================== --}}
                            @if($offers->count())

                                <div class="mb-8">

                                    <div class="flex items-center justify-between gap-4 mb-4">

                                        <div>

                                            <h3 class="text-lg font-bold text-dark-900">
                                                Available Offers
                                            </h3>

                                            <p class="text-sm text-gray-500 mt-1">
                                                Select an offer and enter its coupon code
                                                to receive the discount.
                                            </p>

                                        </div>

                                        <span class="hidden sm:inline-flex
                                                     px-3 py-1 rounded-full
                                                     bg-primary/10 text-primary
                                                     text-xs font-semibold">

                                            {{ $offers->count() }}
                                            {{ Str::plural('Offer', $offers->count()) }}

                                        </span>

                                    </div>


                                    {{-- NO OFFER --}}
                                    <label
                                        for="offer_none"
                                        class="block cursor-pointer mb-3"
                                    >

                                        <input
                                            type="radio"
                                            name="offer_id"
                                            value=""
                                            id="offer_none"
                                            class="peer sr-only booking-offer"
                                            @checked(!old('offer_id'))
                                        >

                                        <div class="rounded-2xl border border-gray-200
                                                    bg-white p-4
                                                    peer-checked:border-primary
                                                    peer-checked:bg-primary/5
                                                    transition">

                                            <div class="flex items-center gap-3">

                                                <div class="w-10 h-10 rounded-xl
                                                            bg-gray-100
                                                            flex items-center justify-center">

                                                    <svg class="w-5 h-5 text-gray-500"
                                                         fill="none"
                                                         stroke="currentColor"
                                                         viewBox="0 0 24 24">

                                                        <path stroke-linecap="round"
                                                              stroke-linejoin="round"
                                                              stroke-width="2"
                                                              d="M6 18 18 6M6 6l12 12"/>

                                                    </svg>

                                                </div>

                                                <div>
                                                    <p class="font-semibold text-dark-900">
                                                        No Offer
                                                    </p>

                                                    <p class="text-sm text-gray-500">
                                                        Continue without a discount
                                                    </p>
                                                </div>

                                            </div>

                                        </div>

                                    </label>


                                    {{-- OFFERS --}}
                                    <div class="space-y-3">

                                        @foreach($offers as $offer)

                                            <label
                                                for="offer_{{ $offer->id }}"
                                                class="block cursor-pointer"
                                            >

                                                <input
                                                    type="radio"
                                                    name="offer_id"
                                                    value="{{ $offer->id }}"
                                                    id="offer_{{ $offer->id }}"
                                                    class="peer sr-only booking-offer"
                                                    data-type="{{ $offer->discount_type }}"
                                                    data-value="{{ $offer->discount_value ?? 0 }}"
                                                    data-minimum="{{ $offer->minimum_purchase ?? 0 }}"
                                                    data-maximum="{{ $offer->maximum_discount ?? 0 }}"
                                                    data-coupon="{{ $offer->coupon_code ?? '' }}"
                                                    @checked(old('offer_id') == $offer->id)
                                                >

                                                <div class="rounded-2xl border border-gray-200
                                                            bg-white p-5
                                                            peer-checked:border-primary
                                                            peer-checked:bg-primary/5
                                                            transition">

                                                    <div class="flex flex-col sm:flex-row
                                                                sm:items-start
                                                                sm:justify-between gap-4">

                                                        <div class="flex gap-4">

                                                            <div class="w-11 h-11 rounded-xl
                                                                        bg-primary/10
                                                                        flex items-center
                                                                        justify-center
                                                                        shrink-0">

                                                                <svg class="w-5 h-5 text-primary"
                                                                     fill="none"
                                                                     stroke="currentColor"
                                                                     viewBox="0 0 24 24">

                                                                    <path stroke-linecap="round"
                                                                          stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="M20 12V8a2 2 0 0 0-2-2h-3.5a2 2 0 0 1-1.414-.586L12 4.328a2 2 0 0 0-1.414-.586H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h5"/>

                                                                    <path stroke-linecap="round"
                                                                          stroke-linejoin="round"
                                                                          stroke-width="2"
                                                                          d="m15 17 2 2 4-4"/>

                                                                </svg>

                                                            </div>

                                                            <div>

                                                                <div class="flex flex-wrap
                                                                            items-center gap-2">

                                                                    <h4 class="font-bold text-dark-900">
                                                                        {{ $offer->title }}
                                                                    </h4>

                                                                    @if($offer->discount_type === 'percentage')

                                                                        <span class="px-2.5 py-1 rounded-full
                                                                                     bg-green-100 text-green-700
                                                                                     text-xs font-bold">

                                                                            {{ rtrim(rtrim(number_format((float)$offer->discount_value, 2), '0'), '.') }}%
                                                                            OFF

                                                                        </span>

                                                                    @elseif($offer->discount_type === 'fixed')

                                                                        <span class="px-2.5 py-1 rounded-full
                                                                                     bg-green-100 text-green-700
                                                                                     text-xs font-bold">

                                                                            ₹{{ number_format((float)$offer->discount_value, 2) }}
                                                                            OFF

                                                                        </span>

                                                                    @endif

                                                                </div>

                                                                @if($offer->short_description)

                                                                    <p class="text-sm text-gray-500 mt-1">
                                                                        {{ $offer->short_description }}
                                                                    </p>

                                                                @endif

                                                                <div class="flex flex-wrap
                                                                            items-center gap-3
                                                                            mt-3 text-xs
                                                                            text-gray-500">

                                                                    <span>
                                                                        Valid:
                                                                        {{ $offer->starts_at?->format('d M Y') ?? 'Now' }}
                                                                        →
                                                                        {{ $offer->ends_at?->format('d M Y') ?? 'No Expiry' }}
                                                                    </span>

                                                                    @if($offer->minimum_purchase > 0)

                                                                        <span class="px-2 py-1 rounded-lg
                                                                                     bg-gray-100">

                                                                            Min ₹{{ number_format((float)$offer->minimum_purchase, 2) }}

                                                                        </span>

                                                                    @endif

                                                                    @if($offer->coupon_code)

                                                                    <span class="inline-flex items-center gap-1.5
                                                                                 px-2.5 py-1 rounded-lg
                                                                                 bg-primary/10
                                                                                 text-primary
                                                                                 font-semibold">

                                                                        <svg class="w-3.5 h-3.5"
                                                                             fill="none"
                                                                             stroke="currentColor"
                                                                             viewBox="0 0 24 24">

                                                                            <path stroke-linecap="round"
                                                                                  stroke-linejoin="round"
                                                                                  stroke-width="2"
                                                                                  d="M15 5h4a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-4M9 19H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h4"/>

                                                                            <path stroke-linecap="round"
                                                                                  stroke-linejoin="round"
                                                                                  stroke-width="2"
                                                                                  d="M8 12h8"/>

                                                                        </svg>

                                                                        Coupon:
                                                                        <strong class="tracking-wider">
                                                                            {{ $offer->coupon_code }}
                                                                        </strong>

                                                                    </span>

                                                                @endif

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="text-gray-300
                                                                    peer-checked:text-primary">

                                                            <svg class="w-6 h-6"
                                                                 fill="none"
                                                                 stroke="currentColor"
                                                                 viewBox="0 0 24 24">

                                                                <circle cx="12"
                                                                        cy="12"
                                                                        r="9"
                                                                        stroke-width="2"/>

                                                                <circle cx="12"
                                                                        cy="12"
                                                                        r="4"
                                                                        stroke-width="2"/>

                                                            </svg>

                                                        </div>

                                                    </div>

                                                </div>

                                            </label>

                                        @endforeach

                                    </div>

                                </div>

                            @endif


                            {{-- =========================================
                                COUPON CODE
                            ========================================== --}}
                            <div
                                id="couponSection"
                                class="hidden mb-8 rounded-2xl border border-primary/20
                                       bg-primary/5 p-5"
                            >

                                <div class="flex items-start gap-3 mb-4">

                                    <div class="w-10 h-10 rounded-xl bg-primary/10
                                                flex items-center justify-center shrink-0">

                                        <svg class="w-5 h-5 text-primary"
                                             fill="none"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M15 5h4a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-4M9 19H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h4"/>

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M8 12h8"/>

                                        </svg>

                                    </div>

                                    <div>

                                        <h3 class="font-bold text-dark-900">
                                            Enter Coupon Code
                                        </h3>

                                        <p class="text-sm text-gray-500 mt-1">
                                            Enter the coupon code shown with your selected offer
                                            to unlock the discount.
                                        </p>

                                    </div>

                                </div>


                                <div class="flex flex-col sm:flex-row gap-3">

                                    <input
                                        type="text"
                                        name="coupon_code"
                                        id="couponCode"
                                        value="{{ old('coupon_code') }}"
                                        placeholder="Enter coupon code"
                                        autocomplete="off"
                                        class="flex-1 rounded-xl border border-gray-200
                                               bg-white px-4 py-3
                                               uppercase tracking-wider
                                               text-dark-900
                                               focus:border-primary
                                               focus:ring-2 focus:ring-primary/20
                                               outline-none"
                                    >

                                    <button
                                        type="button"
                                        id="applyCouponBtn"
                                        class="inline-flex items-center justify-center
                                               gap-2 px-6 py-3 rounded-xl
                                               bg-dark-900 text-white
                                               font-semibold
                                               hover:bg-dark-800
                                               transition"
                                    >
                                        Apply Coupon
                                    </button>

                                </div>


                                <div id="couponStatus"
                                     class="hidden mt-3 text-sm font-medium">
                                </div>

                            </div>


                            {{-- =========================================
                                PRICE SUMMARY
                            ========================================== --}}
                            <div
                                id="bookingPriceSummary"
                                class="hidden mb-8 rounded-2xl
                                       border border-gray-200
                                       bg-gray-50 p-5"
                            >

                                <div class="flex items-center justify-between mb-4">

                                    <h3 class="font-bold text-dark-900">
                                        Price Summary
                                    </h3>

                                    <span
                                        id="couponAppliedBadge"
                                        class="hidden px-2.5 py-1 rounded-full
                                               bg-green-100 text-green-700
                                               text-xs font-bold"
                                    >
                                        Coupon Applied
                                    </span>

                                </div>


                                <div class="space-y-3 text-sm">

                                    <div class="flex justify-between gap-4">

                                        <span class="text-gray-500">
                                            Original Amount
                                        </span>

                                        <span
                                            id="bookingOriginalAmount"
                                            class="font-semibold text-dark-900"
                                        >
                                            ₹0.00
                                        </span>

                                    </div>


                                    <div
                                        id="bookingDiscountRow"
                                        class="hidden justify-between gap-4"
                                    >

                                        <span class="text-green-600">
                                            Discount
                                        </span>

                                        <span
                                            id="bookingDiscountAmount"
                                            class="font-semibold text-green-600"
                                        >
                                            - ₹0.00
                                        </span>

                                    </div>


                                    <div class="border-t border-gray-200 pt-3
                                                flex justify-between gap-4">

                                        <span class="font-bold text-dark-900">
                                            Final Amount
                                        </span>

                                        <span
                                            id="bookingFinalAmount"
                                            class="text-xl font-bold text-primary"
                                        >
                                            ₹0.00
                                        </span>

                                    </div>

                                </div>


                                <div
                                    id="bookingOfferMessage"
                                    class="hidden mt-4 p-3 rounded-xl
                                           bg-yellow-50 border border-yellow-200
                                           text-yellow-800 text-sm"
                                >

                                    <span id="bookingOfferMessageText"></span>

                                </div>

                            </div>


                            {{-- =========================================
                                DATE & TIME
                            ========================================== --}}
                            <div class="grid sm:grid-cols-2 gap-5 mb-8">

                                <div>

                                    <label for="bookingDate"
                                           class="block text-sm font-semibold text-dark-900 mb-2">

                                        Appointment Date
                                        <span class="text-red-500">*</span>

                                    </label>

                                    <input
                                        type="date"
                                        name="booking_date"
                                        id="bookingDate"
                                        value="{{ old('booking_date') }}"
                                        min="{{ now()->format('Y-m-d') }}"
                                        required
                                        class="w-full rounded-xl border border-gray-200
                                               bg-white px-4 py-3.5
                                               text-dark-900
                                               focus:border-primary
                                               focus:ring-2 focus:ring-primary/20
                                               outline-none"
                                    >

                                    @error('booking_date')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                <div>

                                    <label for="bookingTime"
                                           class="block text-sm font-semibold text-dark-900 mb-2">

                                        Appointment Time
                                        <span class="text-red-500">*</span>

                                    </label>

                                    <input
                                        type="time"
                                        name="booking_time"
                                        id="bookingTime"
                                        value="{{ old('booking_time') }}"
                                        required
                                        class="w-full rounded-xl border border-gray-200
                                               bg-white px-4 py-3.5
                                               text-dark-900
                                               focus:border-primary
                                               focus:ring-2 focus:ring-primary/20
                                               outline-none"
                                    >

                                    @error('booking_time')
                                        <p class="mt-2 text-sm text-red-600">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>

                            </div>


                            {{-- =========================================
                                CUSTOMER INFORMATION
                            ========================================== --}}
                            <div class="mb-8">

                                <div class="mb-5">

                                    <h3 class="text-lg font-bold text-dark-900">
                                        Your Information
                                    </h3>

                                    <p class="text-sm text-gray-500 mt-1">
                                        We'll use these details to contact you
                                        regarding your appointment.
                                    </p>

                                </div>


                                <div class="grid sm:grid-cols-2 gap-5">

                                    <div class="sm:col-span-2">

                                        <label for="customerName"
                                               class="block text-sm font-semibold text-dark-900 mb-2">

                                            Full Name
                                            <span class="text-red-500">*</span>

                                        </label>

                                        <input
                                            type="text"
                                            name="customer_name"
                                            id="customerName"
                                            value="{{ old('customer_name') }}"
                                            required
                                            maxlength="255"
                                            placeholder="Enter your full name"
                                            class="w-full rounded-xl border border-gray-200
                                                   bg-white px-4 py-3.5
                                                   text-dark-900
                                                   focus:border-primary
                                                   focus:ring-2 focus:ring-primary/20
                                                   outline-none"
                                        >

                                        @error('customer_name')
                                            <p class="mt-2 text-sm text-red-600">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>


                                    <div>

                                        <label for="customerEmail"
                                               class="block text-sm font-semibold text-dark-900 mb-2">

                                            Email Address

                                        </label>

                                        <input
                                            type="email"
                                            name="customer_email"
                                            id="customerEmail"
                                            value="{{ old('customer_email') }}"
                                            maxlength="255"
                                            placeholder="you@example.com"
                                            class="w-full rounded-xl border border-gray-200
                                                   bg-white px-4 py-3.5
                                                   text-dark-900
                                                   focus:border-primary
                                                   focus:ring-2 focus:ring-primary/20
                                                   outline-none"
                                        >

                                        @error('customer_email')
                                            <p class="mt-2 text-sm text-red-600">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>


                                    <div>

                                        <label for="customerPhone"
                                               class="block text-sm font-semibold text-dark-900 mb-2">

                                            Phone Number
                                            <span class="text-red-500">*</span>

                                        </label>

                                        <input
                                            type="text"
                                            name="customer_phone"
                                            id="customerPhone"
                                            value="{{ old('customer_phone') }}"
                                            required
                                            maxlength="30"
                                            placeholder="Enter phone number"
                                            class="w-full rounded-xl border border-gray-200
                                                   bg-white px-4 py-3.5
                                                   text-dark-900
                                                   focus:border-primary
                                                   focus:ring-2 focus:ring-primary/20
                                                   outline-none"
                                        >

                                        @error('customer_phone')
                                            <p class="mt-2 text-sm text-red-600">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>

                                </div>

                            </div>


                            {{-- =========================================
                                NOTES
                            ========================================== --}}
                            <div class="mb-8">

                                <label for="bookingNotes"
                                       class="block text-sm font-semibold text-dark-900 mb-2">

                                    Additional Notes

                                </label>

                                <textarea
                                    name="notes"
                                    id="bookingNotes"
                                    rows="5"
                                    maxlength="2000"
                                    placeholder="Anything you'd like the business to know..."
                                    class="w-full rounded-xl border border-gray-200
                                           bg-white px-4 py-3.5
                                           text-dark-900
                                           focus:border-primary
                                           focus:ring-2 focus:ring-primary/20
                                           outline-none resize-none"
                                >{{ old('notes') }}</textarea>

                                @error('notes')
                                    <p class="mt-2 text-sm text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- =========================================
                                SUBMIT
                            ========================================== --}}
                            <div class="pt-2">

                                <button
                                    type="submit"
                                    class="w-full inline-flex items-center
                                           justify-center gap-2
                                           px-6 py-4 rounded-xl
                                           bg-primary text-white
                                           font-bold text-base
                                           hover:bg-primary-dark
                                           transition shadow-sm"
                                >

                                    <svg class="w-5 h-5"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12Z"/>

                                    </svg>

                                    Submit Appointment Request

                                </button>

                                <p class="text-center text-xs text-gray-400 mt-3">
                                    Your appointment request will be sent to the business
                                    for confirmation.
                                </p>

                            </div>

                        </form>

                    </div>

                </div>


                {{-- =================================================
                    SIDEBAR
                ================================================== --}}
                <div class="lg:col-span-1">

                    <div class="lg:sticky lg:top-24 space-y-6">

                        {{-- BUSINESS CARD --}}
                        <div class="bg-white rounded-2xl border border-gray-100
                                    shadow-sm overflow-hidden">

                            <div class="h-32 bg-dark-900 relative overflow-hidden">

                                <div class="absolute inset-0 bg-grid-dark opacity-30"></div>

                                <div class="absolute -right-10 -top-10
                                            w-40 h-40 rounded-full
                                            bg-primary/20 blur-2xl"></div>

                            </div>

                            <div class="px-6 pb-6">

                                <div class="-mt-10 mb-4">

                                    <div class="w-20 h-20 rounded-2xl
                                                bg-white border border-gray-100
                                                shadow-lg overflow-hidden
                                                flex items-center justify-center">

                                        @if($business->logo)

                                            <img
                                                src="{{ asset('storage/' . $business->logo) }}"
                                                alt="{{ $businessName }}"
                                                class="w-full h-full object-cover"
                                            >

                                        @else

                                            <span class="text-2xl font-bold text-primary">
                                                {{ strtoupper(substr($businessName, 0, 1)) }}
                                            </span>

                                        @endif

                                    </div>

                                </div>


                                <h3 class="text-xl font-bold text-dark-900">
                                    {{ $businessName }}
                                </h3>

                                @if($business->tagline)

                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $business->tagline }}
                                    </p>

                                @endif


                                @if($business->category)

                                    <div class="mt-4 inline-flex items-center gap-2
                                                px-3 py-1.5 rounded-full
                                                bg-primary/10 text-primary
                                                text-xs font-semibold">

                                        {{ $business->category->name }}

                                    </div>

                                @endif


                                <div class="mt-5 space-y-3">

                                    @if($businessLocation)

                                        <div class="flex items-start gap-3 text-sm text-gray-600">

                                            <svg class="w-5 h-5 text-primary shrink-0 mt-0.5"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M12 21s7-4.35 7-10a7 7 0 1 0-14 0c0 5.65 7 10 7 10Z"/>

                                                <circle cx="12"
                                                        cy="11"
                                                        r="2.5"
                                                        stroke-width="2"/>

                                            </svg>

                                            <span>
                                                {{ $businessLocation }}
                                            </span>

                                        </div>

                                    @endif


                                    @if($business->phone)

                                        <a href="tel:{{ $business->phone }}"
                                           class="flex items-center gap-3
                                                  text-sm text-gray-600
                                                  hover:text-primary transition">

                                            <svg class="w-5 h-5 text-primary"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M3 5a2 2 0 0 1 2-2h3.28a2 2 0 0 1 1.94 1.515l.7 2.8a2 2 0 0 1-.57 1.91L9.5 10.5a16 16 0 0 0 4 4l1.275-1.85a2 2 0 0 1 1.91-.57l2.8.7A2 2 0 0 1 21 14.72V18a2 2 0 0 1-2 2h-1C9.716 20 4 14.284 4 7V6a2 2 0 0 1-1-1Z"/>

                                            </svg>

                                            {{ $business->phone }}

                                        </a>

                                    @endif


                                    @if($business->email)

                                        <a href="mailto:{{ $business->email }}"
                                           class="flex items-center gap-3
                                                  text-sm text-gray-600
                                                  hover:text-primary transition">

                                            <svg class="w-5 h-5 text-primary"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M3 7.5A2.5 2.5 0 0 1 5.5 5h13A2.5 2.5 0 0 1 21 7.5v9a2.5 2.5 0 0 1-2.5 2.5h-13A2.5 2.5 0 0 1 3 16.5v-9Z"/>

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="m4 7 8 6 8-6"/>

                                            </svg>

                                            <span class="break-all">
                                                {{ $business->email }}
                                            </span>

                                        </a>

                                    @endif

                                </div>


                                <a
                                    href="{{ route('businesses.show', $business->slug) }}"
                                    class="mt-6 w-full inline-flex items-center
                                           justify-center gap-2
                                           px-4 py-3 rounded-xl
                                           border border-gray-200
                                           text-dark-900 font-semibold
                                           hover:border-primary
                                           hover:text-primary
                                           transition"
                                >

                                    View Business Profile

                                    <svg class="w-4 h-4"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="m9 5 7 7-7 7"/>

                                    </svg>

                                </a>

                            </div>

                        </div>


                        {{-- HOW IT WORKS --}}
                        <div class="bg-dark-900 rounded-2xl p-6 text-white">

                            <h3 class="text-lg font-bold">
                                How Booking Works
                            </h3>

                            <div class="mt-5 space-y-5">

                                <div class="flex gap-4">

                                    <div class="w-9 h-9 rounded-full
                                                bg-primary/20 text-primary
                                                flex items-center justify-center
                                                font-bold shrink-0">
                                        1
                                    </div>

                                    <div>
                                        <p class="font-semibold">
                                            Choose a Service
                                        </p>

                                        <p class="text-sm text-gray-400 mt-1">
                                            Select the service you want to book.
                                        </p>
                                    </div>

                                </div>


                                <div class="flex gap-4">

                                    <div class="w-9 h-9 rounded-full
                                                bg-primary/20 text-primary
                                                flex items-center justify-center
                                                font-bold shrink-0">
                                        2
                                    </div>

                                    <div>
                                        <p class="font-semibold">
                                            Apply Coupon
                                        </p>

                                        <p class="text-sm text-gray-400 mt-1">
                                            Enter the valid coupon code if an offer is available.
                                        </p>
                                    </div>

                                </div>


                                <div class="flex gap-4">

                                    <div class="w-9 h-9 rounded-full
                                                bg-primary/20 text-primary
                                                flex items-center justify-center
                                                font-bold shrink-0">
                                        3
                                    </div>

                                    <div>
                                        <p class="font-semibold">
                                            Pick Date & Time
                                        </p>

                                        <p class="text-sm text-gray-400 mt-1">
                                            Select your preferred appointment slot.
                                        </p>
                                    </div>

                                </div>


                                <div class="flex gap-4">

                                    <div class="w-9 h-9 rounded-full
                                                bg-primary/20 text-primary
                                                flex items-center justify-center
                                                font-bold shrink-0">
                                        4
                                    </div>

                                    <div>
                                        <p class="font-semibold">
                                            Submit Request
                                        </p>

                                        <p class="text-sm text-gray-400 mt-1">
                                            The business will receive your booking request.
                                        </p>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================================================
        BOTTOM CTA
    ========================================================== --}}
    <section class="pb-16">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="relative overflow-hidden rounded-3xl bg-dark-900 p-8 sm:p-12">

                <div class="absolute inset-0 bg-grid-dark opacity-30"></div>

                <div class="absolute -right-20 -top-20
                            w-64 h-64 rounded-full
                            bg-primary/20 blur-3xl"></div>

                <div class="relative max-w-2xl">

                    <span class="text-primary text-sm font-bold uppercase tracking-wider">
                        Need Help?
                    </span>

                    <h2 class="mt-3 text-2xl sm:text-3xl font-bold text-white">
                        Have questions before booking?
                    </h2>

                    <p class="mt-3 text-gray-400">
                        You can visit the business profile to view complete
                        information, services, reviews and contact details.
                    </p>

                    <a
                        href="{{ route('businesses.show', $business->slug) }}"
                        class="mt-6 inline-flex items-center gap-2
                               px-5 py-3 rounded-xl
                               bg-white text-dark-900
                               font-semibold
                               hover:bg-gray-100 transition"
                    >

                        View Business

                        <svg class="w-4 h-4"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="m9 5 7 7-7 7"/>

                        </svg>

                    </a>

                </div>

            </div>

        </div>

    </section>

</div>


{{-- =============================================================
    JAVASCRIPT
============================================================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const serviceSelect = document.getElementById('bookingService');

    const offerInputs = document.querySelectorAll('.booking-offer');

    const couponSection = document.getElementById('couponSection');
    const couponCode = document.getElementById('couponCode');
    const applyCouponBtn = document.getElementById('applyCouponBtn');
    const couponStatus = document.getElementById('couponStatus');

    const summary = document.getElementById('bookingPriceSummary');

    const originalAmount = document.getElementById('bookingOriginalAmount');
    const discountRow = document.getElementById('bookingDiscountRow');
    const discountAmount = document.getElementById('bookingDiscountAmount');
    const finalAmount = document.getElementById('bookingFinalAmount');

    const couponAppliedBadge = document.getElementById('couponAppliedBadge');

    const offerMessage = document.getElementById('bookingOfferMessage');
    const offerMessageText = document.getElementById('bookingOfferMessageText');


    let couponApplied = false;


    function money(value) {

        return '₹' + Number(value || 0).toLocaleString('en-IN', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

    }


    function getSelectedOffer() {

        let selectedOffer = null;

        offerInputs.forEach(function (input) {

            if (input.checked && input.value !== '') {
                selectedOffer = input;
            }

        });

        return selectedOffer;

    }


    function showCouponStatus(message, success = false) {

        couponStatus.classList.remove('hidden');

        couponStatus.classList.remove(
            'text-red-600',
            'text-green-600'
        );

        couponStatus.classList.add(
            success ? 'text-green-600' : 'text-red-600'
        );

        couponStatus.textContent = message;

    }


    function clearCoupon() {

        couponApplied = false;

        couponAppliedBadge.classList.add('hidden');

        showCouponStatus('', false);

        couponStatus.classList.add('hidden');

    }


    function updateCouponVisibility() {

        const selectedOffer = getSelectedOffer();

        clearCoupon();

        if (!selectedOffer) {

            couponSection.classList.add('hidden');

            couponCode.value = '';

            return;

        }


        const coupon = selectedOffer.dataset.coupon || '';

        if (coupon.trim() !== '') {

            couponSection.classList.remove('hidden');

        } else {

            couponSection.classList.add('hidden');

            couponCode.value = '';

            couponApplied = true;

        }

        calculatePrice();

    }


    function calculatePrice() {

        if (!serviceSelect || !summary) {
            return;
        }


        const selectedService =
            serviceSelect.options[serviceSelect.selectedIndex];


        const price =
            parseFloat(selectedService?.dataset.price || 0);


        if (!serviceSelect.value || price <= 0) {

            summary.classList.add('hidden');

            return;

        }


        let discount = 0;

        const selectedOffer = getSelectedOffer();


        /*
         * IMPORTANT:
         * Coupon based offer will NOT receive discount
         * until couponApplied becomes true.
         */
        if (selectedOffer) {

            const type =
                selectedOffer.dataset.type || '';

            const value =
                parseFloat(selectedOffer.dataset.value || 0);

            const minimum =
                parseFloat(selectedOffer.dataset.minimum || 0);

            const maximum =
                parseFloat(selectedOffer.dataset.maximum || 0);

            const requiredCoupon =
                (selectedOffer.dataset.coupon || '').trim();


            /*
             * Offer has coupon
             */
            if (requiredCoupon !== '') {

                if (couponApplied) {

                    if (price >= minimum) {

                        if (type === 'percentage') {

                            discount = (price * value) / 100;

                            if (maximum > 0) {
                                discount = Math.min(
                                    discount,
                                    maximum
                                );
                            }

                        } else if (type === 'fixed') {

                            discount = value;

                        }

                        discount = Math.min(
                            discount,
                            price
                        );

                        offerMessage.classList.add('hidden');

                    } else {

                        discount = 0;

                        offerMessage.classList.remove('hidden');

                        offerMessageText.textContent =
                            'This offer requires a minimum purchase of ' +
                            money(minimum) + '.';

                    }

                } else {

                    discount = 0;

                    offerMessage.classList.remove('hidden');

                    offerMessageText.textContent =
                        'Enter and apply the coupon code to receive this discount.';

                }

            }

            /*
             * Offer does NOT have coupon
             */
            else {

                if (price >= minimum) {

                    if (type === 'percentage') {

                        discount = (price * value) / 100;

                        if (maximum > 0) {
                            discount = Math.min(
                                discount,
                                maximum
                            );
                        }

                    } else if (type === 'fixed') {

                        discount = value;

                    }

                    discount = Math.min(
                        discount,
                        price
                    );

                    offerMessage.classList.add('hidden');

                } else {

                    discount = 0;

                    offerMessage.classList.remove('hidden');

                    offerMessageText.textContent =
                        'This offer requires a minimum purchase of ' +
                        money(minimum) + '.';

                }

            }

        } else {

            offerMessage.classList.add('hidden');

        }


        const finalPrice = price - discount;


        summary.classList.remove('hidden');


        originalAmount.textContent =
            money(price);


        discountAmount.textContent =
            '- ' + money(discount);


        finalAmount.textContent =
            money(finalPrice);


        if (discount > 0) {

            discountRow.classList.remove('hidden');
            discountRow.classList.add('flex');

        } else {

            discountRow.classList.add('hidden');
            discountRow.classList.remove('flex');

        }


        if (couponApplied && discount > 0) {

            couponAppliedBadge.classList.remove('hidden');

        } else {

            couponAppliedBadge.classList.add('hidden');

        }

    }


    /*
     * SERVICE CHANGE
     */
    if (serviceSelect) {

        serviceSelect.addEventListener('change', function () {

            const selectedOffer = getSelectedOffer();

            if (selectedOffer) {

                const requiredCoupon =
                    (selectedOffer.dataset.coupon || '').trim();

                if (requiredCoupon !== '') {

                    couponApplied = false;

                }

            }

            calculatePrice();

        });

    }


    /*
     * OFFER CHANGE
     */
    offerInputs.forEach(function (input) {

        input.addEventListener('change', function () {

            couponApplied = false;

            couponCode.value = '';

            updateCouponVisibility();

        });

    });


    /*
     * APPLY COUPON
     *
     * This frontend check is only for user experience.
     * The BookingController performs the real validation.
     */
    if (applyCouponBtn) {

        applyCouponBtn.addEventListener('click', function () {

            const selectedOffer = getSelectedOffer();

            if (!selectedOffer) {

                showCouponStatus(
                    'Please select an offer first.',
                    false
                );

                return;

            }


            const requiredCoupon =
                (selectedOffer.dataset.coupon || '').trim();


            if (!requiredCoupon) {

                couponApplied = true;

                calculatePrice();

                showCouponStatus(
                    'This offer does not require a coupon code.',
                    true
                );

                return;

            }


            const enteredCoupon =
                couponCode.value.trim().toUpperCase();


            if (!enteredCoupon) {

                couponApplied = false;

                calculatePrice();

                showCouponStatus(
                    'Please enter the coupon code.',
                    false
                );

                return;

            }


            if (enteredCoupon !== requiredCoupon.toUpperCase()) {

                couponApplied = false;

                calculatePrice();

                showCouponStatus(
                    'Invalid coupon code for this offer.',
                    false
                );

                return;

            }


            const selectedService =
                serviceSelect.options[serviceSelect.selectedIndex];


            const price =
                parseFloat(selectedService?.dataset.price || 0);


            const minimum =
                parseFloat(selectedOffer.dataset.minimum || 0);


            if (price < minimum) {

                couponApplied = false;

                calculatePrice();

                showCouponStatus(
                    'This coupon requires a minimum purchase of ' +
                    money(minimum) + '.',
                    false
                );

                return;

            }


            couponApplied = true;

            calculatePrice();

            showCouponStatus(
                'Coupon applied successfully.',
                true
            );

        });

    }


    /*
     * UPPERCASE COUPON INPUT
     */
    if (couponCode) {

        couponCode.addEventListener('input', function () {

            this.value =
                this.value.toUpperCase();

            couponApplied = false;

            couponStatus.classList.add('hidden');

            calculatePrice();

        });

    }


    /*
     * INITIAL LOAD
     */
    updateCouponVisibility();

    calculatePrice();

});
</script>

@endsection
