@extends('layouts.main')

@section('title', 'How It Works — Lokora Directory')

@section('content')

  <!-- ===== PAGE HEADER ===== -->

  <section class="relative py-20 bg-dark-900 overflow-hidden">
    <div class="bg-grid-dark absolute inset-0"></div>
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
  <div class="text-center" data-aos="fade-up">

    <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">
      How It Works
    </h1>

    <p class="text-dark-300 max-w-2xl mx-auto mb-6">
      Discover businesses, explore listings and connect with the
      places that matter to you.
    </p>

    <nav class="flex items-center justify-center gap-2 text-sm">
      <a href="{{ url('/') }}"
         class="text-dark-300 hover:text-primary transition-colors">
        Home
      </a>

      <i class="fas fa-chevron-right text-xs text-dark-400"></i>

      <span class="text-primary">How It Works</span>
    </nav>

  </div>
</div>


  </section>

  <!-- ===== 3-STEP PROCESS ===== -->

  <section class="py-20 lg:py-28 bg-white relative overflow-hidden">

<div class="bg-dots absolute inset-0 opacity-50"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

  <div class="text-center mb-14" data-aos="fade-up">

    <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
      Simple Steps
    </span>

    <h2 class="text-3xl sm:text-4xl font-bold text-dark-900">
      How Lokora Works
    </h2>

    <p class="text-dark-400 mt-3 max-w-lg mx-auto">
      Follow these simple steps to discover the right businesses
      and services for your needs.
    </p>

  </div>


  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

    <!-- Step 1 -->
    <div class="card-hover bg-white rounded-2xl border border-gray-100 p-8 text-center relative"
         data-aos="fade-up">

      <div class="w-20 h-20 mx-auto mb-6 bg-primary/5 rounded-2xl flex items-center justify-center relative">

        <i class="fas fa-th-large text-3xl text-primary"></i>

        <span class="absolute -top-3 -right-3 w-9 h-9 bg-primary text-white text-sm font-bold rounded-full flex items-center justify-center shadow-lg shadow-primary/25">
          1
        </span>

      </div>

      <h3 class="text-xl font-bold text-dark-900 mb-3">
        Choose a Category
      </h3>

      <p class="text-dark-400 leading-relaxed">
        Browse businesses by category and discover restaurants,
        services, shopping, hotels and many other types of businesses
        available on Lokora.
      </p>

    </div>


    <!-- Step 2 -->
    <div class="card-hover bg-white rounded-2xl border border-gray-100 p-8 text-center relative"
         data-aos="fade-up"
         data-aos-delay="100">

      <div class="w-20 h-20 mx-auto mb-6 bg-primary/5 rounded-2xl flex items-center justify-center relative">

        <i class="fas fa-search text-3xl text-primary"></i>

        <span class="absolute -top-3 -right-3 w-9 h-9 bg-primary text-white text-sm font-bold rounded-full flex items-center justify-center shadow-lg shadow-primary/25">
          2
        </span>

      </div>

      <h3 class="text-xl font-bold text-dark-900 mb-3">
        Find What You Need
      </h3>

      <p class="text-dark-400 leading-relaxed">
        Search and explore listings using relevant categories,
        locations and available business information to find
        options that match your requirements.
      </p>

    </div>


    <!-- Step 3 -->
    <div class="card-hover bg-white rounded-2xl border border-gray-100 p-8 text-center relative sm:col-span-2 lg:col-span-1"
         data-aos="fade-up"
         data-aos-delay="200">

      <div class="w-20 h-20 mx-auto mb-6 bg-primary/5 rounded-2xl flex items-center justify-center relative">

        <i class="fas fa-map-marked-alt text-3xl text-primary"></i>

        <span class="absolute -top-3 -right-3 w-9 h-9 bg-primary text-white text-sm font-bold rounded-full flex items-center justify-center shadow-lg shadow-primary/25">
          3
        </span>

      </div>

      <h3 class="text-xl font-bold text-dark-900 mb-3">
        Connect & Explore
      </h3>

      <p class="text-dark-400 leading-relaxed">
        Open a listing, review the available business information
        and use the provided contact details to connect with the
        business or explore its services.
      </p>

    </div>

  </div>


  <!-- Bottom CTA -->
  <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="300">

    <p class="text-dark-400">
      Want to grow your business visibility?

      <a href="{{ url('/user-dashboard/businesses/create') }}"
         class="text-primary font-semibold hover:text-primary-dark transition-colors">
        Add Your Business
      </a>
    </p>

  </div>

</div>


  </section>

  <!-- ===== VIDEO SECTION ===== -->

  <section class="py-20 lg:py-28 bg-dark-50 relative overflow-hidden">

<div class="bg-grid absolute inset-0"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

  <div class="text-center mb-14" data-aos="fade-up">

    <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
      Let's Find Out
    </span>

    <h2 class="text-3xl sm:text-4xl font-bold text-dark-900">
      See How Lokora Works
    </h2>

    <p class="text-dark-400 mt-3 max-w-lg mx-auto">
      Learn how easy it is to discover businesses and explore
      listings through Lokora.
    </p>

  </div>


  <!-- Video -->
  <div class="relative rounded-3xl overflow-hidden aspect-video max-w-4xl mx-auto"
       data-aos="zoom-in">

    <img
      decoding="async"
      src="https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?w=1200&h=675&fit=crop&q=80"
      alt="How Lokora Works"
      class="w-full h-full object-cover"
      loading="lazy">

    <div class="absolute inset-0 bg-dark-900/40 flex items-center justify-center">

      <a href="https://www.youtube.com/watch?v=i9E_Blai8vk"
         class="video-popup w-20 h-20 bg-white/90 hover:bg-white rounded-full flex items-center justify-center shadow-2xl transition-all animate-pulse-glow">

        <i class="fas fa-play text-primary text-xl ml-1"></i>

      </a>

    </div>


    <div class="absolute left-6 top-1/2 -translate-y-1/2 hidden lg:block">

      <p class="text-white/70 text-sm font-medium"
         style="writing-mode: vertical-rl; transform: rotate(180deg);">
        Discover Lokora
      </p>

    </div>


    <div class="absolute right-6 top-1/2 -translate-y-1/2 hidden lg:block">

      <p class="text-white/70 text-sm font-medium"
         style="writing-mode: vertical-rl;">
        Explore businesses
      </p>

    </div>

  </div>

</div>


  </section>

  <!-- ===== COMMUNITY SECTION ===== -->

  <section class="py-20 lg:py-28 bg-white relative overflow-hidden">

<div class="bg-dots absolute inset-0 opacity-50"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

  <div class="grid lg:grid-cols-2 gap-12 items-center">

    <!-- Image -->
    <div class="relative" data-aos="fade-right">

      <div class="rounded-3xl overflow-hidden aspect-[4/3]">

        <img
          decoding="async"
          src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=700&h=525&fit=crop&q=80"
          alt="Lokora Business Community"
          class="w-full h-full object-cover"
          loading="lazy">

      </div>

      <div class="absolute -bottom-6 -left-6 w-40 h-40 bg-primary/10 rounded-full blur-2xl"></div>

    </div>


    <!-- Content -->
    <div data-aos="fade-left">

      <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
        Our Community
      </span>

      <h2 class="text-3xl sm:text-4xl font-bold text-dark-900 mb-6">
        Connecting People With Local Businesses
      </h2>

      <p class="text-dark-400 leading-relaxed mb-6">
        Lokora brings businesses and customers together through
        an easy-to-use directory where people can discover
        services, explore listings and find useful business
        information.
      </p>

      <p class="text-dark-400 leading-relaxed mb-8">
        Whether you are searching for a service or looking to
        showcase your business online, Lokora provides a simple
        platform to get started.
      </p>

      <a href="{{ url('/about') }}"
         class="inline-flex items-center gap-2 px-8 py-4 bg-primary hover:bg-primary-dark text-white font-medium rounded-xl transition-colors shadow-lg shadow-primary/25">

        Learn More

        <i class="fas fa-arrow-right"></i>

      </a>

    </div>

  </div>

</div>

  </section>

  <!-- ===== WHY USE LOKORA ===== -->

  <section class="py-20 lg:py-28 bg-dark-50 relative overflow-hidden">


<div class="bg-grid absolute inset-0"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

  <div class="text-center mb-14" data-aos="fade-up">

    <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
      Why Lokora
    </span>

    <h2 class="text-3xl sm:text-4xl font-bold text-dark-900">
      Built To Make Discovery Easier
    </h2>

    <p class="text-dark-400 mt-3 max-w-2xl mx-auto">
      Everything is designed to make finding and discovering
      businesses simpler and more convenient.
    </p>

  </div>


  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- Feature 1 -->
    <div class="bg-white rounded-2xl border border-gray-100 p-7 text-center"
         data-aos="fade-up">

      <div class="w-14 h-14 mx-auto mb-5 bg-primary/10 rounded-xl flex items-center justify-center">
        <i class="fas fa-search-location text-xl text-primary"></i>
      </div>

      <h3 class="font-bold text-dark-900 mb-2">
        Easy Discovery
      </h3>

      <p class="text-sm text-dark-400 leading-relaxed">
        Find relevant businesses through categories and locations.
      </p>

    </div>


    <!-- Feature 2 -->
    <div class="bg-white rounded-2xl border border-gray-100 p-7 text-center"
         data-aos="fade-up"
         data-aos-delay="100">

      <div class="w-14 h-14 mx-auto mb-5 bg-primary/10 rounded-xl flex items-center justify-center">
        <i class="fas fa-layer-group text-xl text-primary"></i>
      </div>

      <h3 class="font-bold text-dark-900 mb-2">
        Organized Listings
      </h3>

      <p class="text-sm text-dark-400 leading-relaxed">
        Browse business information in a clear and organized format.
      </p>

    </div>


    <!-- Feature 3 -->
    <div class="bg-white rounded-2xl border border-gray-100 p-7 text-center"
         data-aos="fade-up"
         data-aos-delay="200">

      <div class="w-14 h-14 mx-auto mb-5 bg-primary/10 rounded-xl flex items-center justify-center">
        <i class="fas fa-building text-xl text-primary"></i>
      </div>

      <h3 class="font-bold text-dark-900 mb-2">
        Business Visibility
      </h3>

      <p class="text-sm text-dark-400 leading-relaxed">
        Give your business an additional place to be discovered online.
      </p>

    </div>


    <!-- Feature 4 -->
    <div class="bg-white rounded-2xl border border-gray-100 p-7 text-center"
         data-aos="fade-up"
         data-aos-delay="300">

      <div class="w-14 h-14 mx-auto mb-5 bg-primary/10 rounded-xl flex items-center justify-center">
        <i class="fas fa-headset text-xl text-primary"></i>
      </div>

      <h3 class="font-bold text-dark-900 mb-2">
        Helpful Support
      </h3>

      <p class="text-sm text-dark-400 leading-relaxed">
        Get assistance when you need help using the platform.
      </p>

    </div>

  </div>

</div>


  </section>

  <!-- ===== CTA SECTION ===== -->

  <section class="relative py-20 overflow-hidden"
           style="background: linear-gradient(135deg, #161c26 0%, #1f2937 100%)">

<div class="bg-grid-dark absolute inset-0"></div>

<div class="absolute -top-20 -right-20 w-80 h-80 bg-primary/20 rounded-full blur-3xl"></div>

<div class="absolute -bottom-20 -left-20 w-60 h-60 bg-primary/10 rounded-full blur-3xl"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

  <div class="flex flex-col lg:flex-row items-center gap-12">

    <div class="flex-1" data-aos="fade-right">

      <span class="inline-block px-4 py-1 bg-primary/10 text-primary text-sm font-medium rounded-full mb-6">
        Get Started
      </span>

      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6">
        Discover More.<br>
        <span class="text-gradient">Connect Better.</span>
      </h2>

      <p class="text-dark-300 text-lg mb-8 max-w-md">
        Explore businesses on Lokora or add your own business
        listing and start reaching more people.
      </p>

      <div class="flex flex-wrap gap-3">

        <a href="{{ url('/listings') }}"
           class="inline-flex items-center gap-2 px-8 py-4 bg-primary hover:bg-primary-dark text-white font-medium rounded-xl transition-colors shadow-lg shadow-primary/25">

          Explore Listings

          <i class="fas fa-arrow-right"></i>

        </a>

        <a href="{{ url('/user-dashboard/businesses/create') }}"
           class="inline-flex items-center gap-2 px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-medium rounded-xl transition-colors border border-white/10">

          Add Business

          <i class="fas fa-plus"></i>

        </a>

      </div>

    </div>


    <div class="flex-1" data-aos="fade-left">

      <img
        decoding="async"
        src="https://images.unsplash.com/photo-1553877522-43269d4ea984?w=600&h=400&fit=crop&q=80"
        alt="Get Started With Lokora"
        class="rounded-3xl shadow-2xl w-full"
        loading="lazy">

    </div>

  </div>

</div>


  </section>

@endsection
