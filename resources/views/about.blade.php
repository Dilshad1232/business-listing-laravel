@extends('layouts.main')

@section('title', 'About Us — Lokora Directory')

@section('content')

  <!-- ===== PAGE HEADER ===== -->

  <section class="relative py-20 bg-dark-900 overflow-hidden">
    <div class="bg-grid-dark absolute inset-0"></div>
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
  <div class="text-center" data-aos="fade-up">
    <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">
      About Us
    </h1>

    <nav class="flex items-center justify-center gap-2 text-sm">
      <a href="{{ url('/') }}"
         class="text-dark-300 hover:text-primary transition-colors">
        Home
      </a>

      <i class="fas fa-chevron-right text-xs text-dark-400"></i>

      <span class="text-primary">About Us</span>
    </nav>
  </div>
</div>


  </section>

  <!-- ===== OUR STORY ===== -->

  <section class="py-20 lg:py-28 bg-white relative overflow-hidden">
    <div class="bg-dots absolute inset-0 opacity-50"></div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
  <div class="grid lg:grid-cols-2 gap-12 items-center">

    <!-- Image Side -->
    <div class="relative" data-aos="fade-right">

      <div class="grid grid-cols-2 gap-4">

        <div class="rounded-2xl overflow-hidden aspect-[3/4]">
          <img
            decoding="async"
            src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=400&h=530&fit=crop&q=80"
            alt="Business directory workspace"
            class="w-full h-full object-cover"
            loading="lazy">
        </div>

        <div class="rounded-2xl overflow-hidden aspect-[3/4] mt-8">
          <img
            decoding="async"
            src="https://images.unsplash.com/photo-1497215842964-222b430dc094?w=400&h=530&fit=crop&q=80"
            alt="Businesses and professionals"
            class="w-full h-full object-cover"
            loading="lazy">
        </div>

      </div>

      <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-primary/10 rounded-full blur-2xl"></div>
    </div>


    <!-- Text Side -->
    <div data-aos="fade-left">

      <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
        Get to Know Us
      </span>

      <h2 class="text-3xl sm:text-4xl font-bold text-dark-900 mb-6">
        Connecting People With Trusted Businesses
      </h2>

      <p class="text-dark-400 leading-relaxed mb-6">
        Lokora is a modern business directory designed to help people
        discover businesses, services, professionals and places in their
        local area. Our goal is to make finding the right business
        simple, convenient and reliable.
      </p>

      <p class="text-dark-400 leading-relaxed mb-8">
        Whether you are looking for a restaurant, service provider,
        professional or local business, Lokora brings useful business
        information together in one easy-to-use platform.
      </p>

      <div class="flex flex-col sm:flex-row gap-4">

        <a href="{{ url('/how-it-works') }}"
           class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-primary hover:bg-primary-dark text-white font-medium rounded-xl transition-colors shadow-lg shadow-primary/25">
          How It Works
          <i class="fas fa-arrow-right"></i>
        </a>

        <a href="{{ url('/contact') }}"
           class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-dark-900 hover:bg-dark-800 text-white font-medium rounded-xl transition-colors">
          Contact Us
        </a>

      </div>

    </div>

  </div>
</div>


  </section>

  <!-- ===== OUR COMMUNITY ===== -->

  <section class="py-20 lg:py-28 bg-dark-50 relative overflow-hidden">


<div class="bg-grid absolute inset-0"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

  <div class="grid lg:grid-cols-2 gap-12 items-center">

    <!-- Text Side -->
    <div data-aos="fade-right">

      <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
        Our Community
      </span>

      <h2 class="text-3xl sm:text-4xl font-bold text-dark-900 mb-6">
        A Better Way to Discover Local Businesses
      </h2>

      <p class="text-dark-400 leading-relaxed mb-6">
        Lokora brings businesses and customers together through an
        organized and easy-to-navigate directory. Users can explore
        categories, locations and business listings to find relevant
        services more easily.
      </p>

      <div class="grid grid-cols-2 gap-6 mt-8">

        <!-- Feature 1 -->
        <div class="flex items-start gap-3">
          <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
            <i class="fas fa-check text-primary text-sm"></i>
          </div>

          <div>
            <h4 class="font-semibold text-dark-900 text-sm">
              Easy Discovery
            </h4>

            <p class="text-xs text-dark-400 mt-1">
              Find businesses by category and location
            </p>
          </div>
        </div>


        <!-- Feature 2 -->
        <div class="flex items-start gap-3">
          <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
            <i class="fas fa-check text-primary text-sm"></i>
          </div>

          <div>
            <h4 class="font-semibold text-dark-900 text-sm">
              Useful Information
            </h4>

            <p class="text-xs text-dark-400 mt-1">
              Business details available in one place
            </p>
          </div>
        </div>


        <!-- Feature 3 -->
        <div class="flex items-start gap-3">
          <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
            <i class="fas fa-check text-primary text-sm"></i>
          </div>

          <div>
            <h4 class="font-semibold text-dark-900 text-sm">
              Growing Directory
            </h4>

            <p class="text-xs text-dark-400 mt-1">
              Discover businesses across different locations
            </p>
          </div>
        </div>


        <!-- Feature 4 -->
        <div class="flex items-start gap-3">
          <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
            <i class="fas fa-check text-primary text-sm"></i>
          </div>

          <div>
            <h4 class="font-semibold text-dark-900 text-sm">
              Simple Experience
            </h4>

            <p class="text-xs text-dark-400 mt-1">
              Clean and convenient browsing experience
            </p>
          </div>
        </div>

      </div>

    </div>


    <!-- Image Side -->
    <div class="relative" data-aos="fade-left">

      <div class="rounded-3xl overflow-hidden aspect-[4/3]">
        <img
          decoding="async"
          src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=700&h=525&fit=crop&q=80"
          alt="Lokora business community"
          class="w-full h-full object-cover"
          loading="lazy">
      </div>

      <div class="absolute -top-6 -right-6 w-40 h-40 bg-primary/10 rounded-full blur-2xl"></div>

    </div>

  </div>
</div>


  </section>

  <!-- ===== STATS ===== -->

  <section class="py-16 bg-dark-900 relative overflow-hidden">


<div class="bg-grid-dark absolute inset-0"></div>

<div class="absolute top-0 left-1/4 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

  <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">

    <div data-aos="fade-up">
      <div class="text-4xl sm:text-5xl font-bold text-white counter-value counter"
           data-count="100">
        0
      </div>
      <p class="text-dark-300 mt-2 text-sm">
        Business Listings
      </p>
    </div>

    <div data-aos="fade-up" data-aos-delay="100">
      <div class="text-4xl sm:text-5xl font-bold text-white counter-value counter"
           data-count="25">
        0
      </div>
      <p class="text-dark-300 mt-2 text-sm">
        Categories
      </p>
    </div>

    <div data-aos="fade-up" data-aos-delay="200">
      <div class="text-4xl sm:text-5xl font-bold text-white counter-value counter"
           data-count="10">
        0
      </div>
      <p class="text-dark-300 mt-2 text-sm">
        Locations
      </p>
    </div>

    <div data-aos="fade-up" data-aos-delay="300">
      <div class="text-4xl sm:text-5xl font-bold text-white counter-value counter"
           data-count="1000">
        0
      </div>
      <p class="text-dark-300 mt-2 text-sm">
        Visitors Served
      </p>
    </div>

  </div>

</div>


  </section>

  <!-- ===== WHY LOKORA ===== -->

  <section class="py-20 lg:py-28 bg-white relative overflow-hidden">


<div class="bg-dots absolute inset-0 opacity-50"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

  <div class="text-center mb-14" data-aos="fade-up">

    <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
      Why Choose Lokora
    </span>

    <h2 class="text-3xl sm:text-4xl font-bold text-dark-900">
      Built for Businesses and Customers
    </h2>

    <p class="text-dark-400 mt-3 max-w-2xl mx-auto">
      Lokora provides a simple platform where customers can discover
      businesses and businesses can build their online presence.
    </p>

  </div>


  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

    <!-- Card 1 -->
    <div class="card-hover bg-white rounded-2xl border border-gray-100 p-6 text-center"
         data-aos="fade-up">

      <div class="w-14 h-14 mx-auto bg-primary/10 rounded-2xl flex items-center justify-center mb-5">
        <i class="fas fa-search text-primary text-xl"></i>
      </div>

      <h4 class="font-semibold text-dark-900">
        Discover Easily
      </h4>

      <p class="text-sm text-dark-400 mt-2 leading-relaxed">
        Search and explore businesses based on your needs and location.
      </p>

    </div>


    <!-- Card 2 -->
    <div class="card-hover bg-white rounded-2xl border border-gray-100 p-6 text-center"
         data-aos="fade-up"
         data-aos-delay="100">

      <div class="w-14 h-14 mx-auto bg-primary/10 rounded-2xl flex items-center justify-center mb-5">
        <i class="fas fa-building text-primary text-xl"></i>
      </div>

      <h4 class="font-semibold text-dark-900">
        Business Visibility
      </h4>

      <p class="text-sm text-dark-400 mt-2 leading-relaxed">
        Give your business a place where customers can discover your services.
      </p>

    </div>


    <!-- Card 3 -->
    <div class="card-hover bg-white rounded-2xl border border-gray-100 p-6 text-center"
         data-aos="fade-up"
         data-aos-delay="200">

      <div class="w-14 h-14 mx-auto bg-primary/10 rounded-2xl flex items-center justify-center mb-5">
        <i class="fas fa-map-marker-alt text-primary text-xl"></i>
      </div>

      <h4 class="font-semibold text-dark-900">
        Location Based
      </h4>

      <p class="text-sm text-dark-400 mt-2 leading-relaxed">
        Find relevant businesses and services in different locations.
      </p>

    </div>


    <!-- Card 4 -->
    <div class="card-hover bg-white rounded-2xl border border-gray-100 p-6 text-center"
         data-aos="fade-up"
         data-aos-delay="300">

      <div class="w-14 h-14 mx-auto bg-primary/10 rounded-2xl flex items-center justify-center mb-5">
        <i class="fas fa-layer-group text-primary text-xl"></i>
      </div>

      <h4 class="font-semibold text-dark-900">
        Organized Directory
      </h4>

      <p class="text-sm text-dark-400 mt-2 leading-relaxed">
        Browse businesses through organized categories and locations.
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
        Grow With Lokora
      </span>

      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6">
        Get Your Business<br>
        <span class="text-gradient">Discovered Online</span>
      </h2>

      <p class="text-dark-300 text-lg mb-8 max-w-md">
        Add your business to Lokora and make it easier for customers
        to discover your products and services.
      </p>

      <a href="{{ url('/user-dashboard/businesses/create') }}"
         class="inline-flex items-center gap-2 px-8 py-4 bg-primary hover:bg-primary-dark text-white font-medium rounded-xl transition-colors shadow-lg shadow-primary/25">
        Add Your Business
        <i class="fas fa-arrow-right"></i>
      </a>

    </div>


    <div class="flex-1" data-aos="fade-left">

      <img
        decoding="async"
        src="https://images.unsplash.com/photo-1553877522-43269d4ea984?w=600&h=400&fit=crop&q=80"
        alt="Grow your business with Lokora"
        class="rounded-3xl shadow-2xl w-full"
        loading="lazy">

    </div>

  </div>

</div>


  </section>

@endsection
