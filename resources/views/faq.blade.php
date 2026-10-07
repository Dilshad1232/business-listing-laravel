@extends('layouts.main')

@section('title', 'FAQ — Lokora Directory')

@section('content')

  <!-- ===== PAGE HEADER ===== -->

  <section class="relative py-20 bg-dark-900 overflow-hidden">
    <div class="bg-grid-dark absolute inset-0"></div>
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>


<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
  <div class="text-center" data-aos="fade-up">

    <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">
      Frequently Asked Questions
    </h1>

    <p class="text-dark-300 max-w-2xl mx-auto mb-6">
      Find answers to common questions about discovering businesses,
      managing listings and using Lokora.
    </p>

    <nav class="flex items-center justify-center gap-2 text-sm">
      <a href="{{ url('/') }}"
         class="text-dark-300 hover:text-primary transition-colors">
        Home
      </a>

      <i class="fas fa-chevron-right text-xs text-dark-400"></i>

      <span class="text-primary">FAQ</span>
    </nav>

  </div>
</div>


  </section>

  <!-- ===== FAQ INTRO ===== -->

  <section class="py-20 lg:py-28 bg-white relative overflow-hidden">


<div class="bg-dots absolute inset-0 opacity-50"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

  <div class="grid lg:grid-cols-2 gap-12 items-center">

    <!-- Text -->
    <div data-aos="fade-right">

      <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
        Need Help?
      </span>

      <h2 class="text-3xl sm:text-4xl font-bold text-dark-900 mb-6">
        Everything You Need to Know About Lokora
      </h2>

      <p class="text-dark-400 leading-relaxed mb-6">
        Whether you are looking for a local business or want to add
        your own business to the directory, we have answers to some
        of the most common questions.
      </p>

      <p class="text-dark-400 leading-relaxed mb-8">
        If you cannot find the information you are looking for,
        our support team is available to help.
      </p>

      <a href="{{ url('/contact') }}"
         class="inline-flex items-center gap-2 px-7 py-3.5 bg-primary hover:bg-primary-dark text-white font-medium rounded-xl transition-colors shadow-lg shadow-primary/25">
        Contact Us
        <i class="fas fa-arrow-right"></i>
      </a>

    </div>


    <!-- Image -->
    <div class="relative" data-aos="fade-left">

      <div class="rounded-3xl overflow-hidden aspect-[4/3]">
        <img
          decoding="async"
          src="https://images.unsplash.com/photo-1556761175-b413da4baf72?w=700&h=525&fit=crop&q=80"
          alt="Lokora support and community"
          class="w-full h-full object-cover"
          loading="lazy">
      </div>

      <div class="absolute -bottom-6 -right-6 w-40 h-40 bg-primary/10 rounded-full blur-2xl"></div>

    </div>

  </div>

</div>


  </section>

  <!-- ===== FAQ SECTION ===== -->

  <section class="py-20 lg:py-28 bg-dark-50 relative overflow-hidden">

<div class="bg-grid absolute inset-0"></div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">

  <div class="text-center mb-14" data-aos="fade-up">

    <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
      Common Questions
    </span>

    <h2 class="text-3xl sm:text-4xl font-bold text-dark-900">
      Frequently Asked Questions
    </h2>

    <p class="text-dark-400 mt-3 max-w-2xl mx-auto">
      Quick answers to help you understand how Lokora works.
    </p>

  </div>


  <!-- FAQ LIST -->
  <div class="space-y-4">

    <!-- FAQ 1 -->
    <div class="faq-item bg-white rounded-2xl border border-gray-100 overflow-hidden"
         data-aos="fade-up">

      <button
        type="button"
        class="faq-question w-full flex items-center justify-between gap-6 p-6 text-left">

        <span class="font-semibold text-dark-900">
          What is Lokora?
        </span>

        <span class="faq-icon w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0 transition-transform">
          <i class="fas fa-plus text-sm"></i>
        </span>

      </button>

      <div class="faq-answer hidden px-6 pb-6">
        <p class="text-dark-400 leading-relaxed">
          Lokora is a business directory platform that helps people
          discover businesses, services and places by category and
          location. Businesses can also create listings to improve
          their online visibility.
        </p>
      </div>

    </div>


    <!-- FAQ 2 -->
    <div class="faq-item bg-white rounded-2xl border border-gray-100 overflow-hidden"
         data-aos="fade-up"
         data-aos-delay="50">

      <button
        type="button"
        class="faq-question w-full flex items-center justify-between gap-6 p-6 text-left">

        <span class="font-semibold text-dark-900">
          How can I find a business?
        </span>

        <span class="faq-icon w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0 transition-transform">
          <i class="fas fa-plus text-sm"></i>
        </span>

      </button>

      <div class="faq-answer hidden px-6 pb-6">
        <p class="text-dark-400 leading-relaxed">
          You can search for businesses using the search bar and
          browse listings by category or location. Open a business
          listing to view its available information and contact details.
        </p>
      </div>

    </div>


    <!-- FAQ 3 -->
    <div class="faq-item bg-white rounded-2xl border border-gray-100 overflow-hidden"
         data-aos="fade-up"
         data-aos-delay="100">

      <button
        type="button"
        class="faq-question w-full flex items-center justify-between gap-6 p-6 text-left">

        <span class="font-semibold text-dark-900">
          How can I add my business to Lokora?
        </span>

        <span class="faq-icon w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0 transition-transform">
          <i class="fas fa-plus text-sm"></i>
        </span>

      </button>

      <div class="faq-answer hidden px-6 pb-6">
        <p class="text-dark-400 leading-relaxed">
          Create an account and use the Add Business option from your
          user dashboard. Enter your business information and submit
          the listing for review.
        </p>
      </div>

    </div>


    <!-- FAQ 4 -->
    <div class="faq-item bg-white rounded-2xl border border-gray-100 overflow-hidden"
         data-aos="fade-up"
         data-aos-delay="150">

      <button
        type="button"
        class="faq-question w-full flex items-center justify-between gap-6 p-6 text-left">

        <span class="font-semibold text-dark-900">
          Is adding a business free?
        </span>

        <span class="faq-icon w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0 transition-transform">
          <i class="fas fa-plus text-sm"></i>
        </span>

      </button>

      <div class="faq-answer hidden px-6 pb-6">
        <p class="text-dark-400 leading-relaxed">
          Listing availability and any applicable plans depend on the
          options provided by Lokora. Please check the available
          listing or advertising options for current details.
        </p>
      </div>

    </div>


    <!-- FAQ 5 -->
    <div class="faq-item bg-white rounded-2xl border border-gray-100 overflow-hidden"
         data-aos="fade-up"
         data-aos-delay="200">

      <button
        type="button"
        class="faq-question w-full flex items-center justify-between gap-6 p-6 text-left">

        <span class="font-semibold text-dark-900">
          How long does it take for a listing to appear?
        </span>

        <span class="faq-icon w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0 transition-transform">
          <i class="fas fa-plus text-sm"></i>
        </span>

      </button>

      <div class="faq-answer hidden px-6 pb-6">
        <p class="text-dark-400 leading-relaxed">
          Submitted listings may require review before they become
          publicly visible. The availability of a listing depends on
          the review and approval process.
        </p>
      </div>

    </div>


    <!-- FAQ 6 -->
    <div class="faq-item bg-white rounded-2xl border border-gray-100 overflow-hidden"
         data-aos="fade-up"
         data-aos-delay="250">

      <button
        type="button"
        class="faq-question w-full flex items-center justify-between gap-6 p-6 text-left">

        <span class="font-semibold text-dark-900">
          Can I edit my business listing?
        </span>

        <span class="faq-icon w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0 transition-transform">
          <i class="fas fa-plus text-sm"></i>
        </span>

      </button>

      <div class="faq-answer hidden px-6 pb-6">
        <p class="text-dark-400 leading-relaxed">
          Yes. Businesses can manage and update their listing
          information through the available dashboard options.
          Changes may be subject to review before publication.
        </p>
      </div>

    </div>


    <!-- FAQ 7 -->
    <div class="faq-item bg-white rounded-2xl border border-gray-100 overflow-hidden"
         data-aos="fade-up"
         data-aos-delay="300">

      <button
        type="button"
        class="faq-question w-full flex items-center justify-between gap-6 p-6 text-left">

        <span class="font-semibold text-dark-900">
          Can I search businesses by location?
        </span>

        <span class="faq-icon w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0 transition-transform">
          <i class="fas fa-plus text-sm"></i>
        </span>

      </button>

      <div class="faq-answer hidden px-6 pb-6">
        <p class="text-dark-400 leading-relaxed">
          Yes. Lokora is designed to help users discover businesses
          based on categories and locations, making it easier to find
          relevant services nearby.
        </p>
      </div>

    </div>


    <!-- FAQ 8 -->
    <div class="faq-item bg-white rounded-2xl border border-gray-100 overflow-hidden"
         data-aos="fade-up"
         data-aos-delay="350">

      <button
        type="button"
        class="faq-question w-full flex items-center justify-between gap-6 p-6 text-left">

        <span class="font-semibold text-dark-900">
          How can I contact Lokora?
        </span>

        <span class="faq-icon w-9 h-9 rounded-full bg-primary/10 text-primary flex items-center justify-center flex-shrink-0 transition-transform">
          <i class="fas fa-plus text-sm"></i>
        </span>

      </button>

      <div class="faq-answer hidden px-6 pb-6">
        <p class="text-dark-400 leading-relaxed">
          You can contact the Lokora team through the Contact Us page.
          Send us your question or enquiry and our team can assist you
          with the available support options.
        </p>
      </div>

    </div>

  </div>

</div>


  </section>

  <!-- ===== STILL HAVE QUESTIONS ===== -->

  <section class="py-20 bg-white relative overflow-hidden">


<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">

  <div class="relative rounded-3xl overflow-hidden bg-dark-900 p-8 sm:p-12 text-center"
       data-aos="fade-up">

    <div class="bg-grid-dark absolute inset-0"></div>

    <div class="absolute -top-20 -right-20 w-64 h-64 bg-primary/20 rounded-full blur-3xl"></div>

    <div class="relative">

      <div class="w-16 h-16 mx-auto bg-primary/10 rounded-2xl flex items-center justify-center mb-6">
        <i class="fas fa-headset text-primary text-2xl"></i>
      </div>

      <span class="inline-block px-4 py-1 bg-primary/10 text-primary text-sm font-medium rounded-full mb-5">
        Need More Help?
      </span>

      <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
        Still Have Questions?
      </h2>

      <p class="text-dark-300 max-w-xl mx-auto mb-8">
        If you could not find the answer you were looking for,
        get in touch with our team and we will be happy to help.
      </p>

      <a href="{{ url('/contact') }}"
         class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-primary hover:bg-primary-dark text-white font-medium rounded-xl transition-colors shadow-lg shadow-primary/25">
        Contact Us
        <i class="fas fa-arrow-right"></i>
      </a>

    </div>

  </div>

</div>


  </section>

  <!-- ===== FAQ SCRIPT ===== -->

  <script>
    document.addEventListener('DOMContentLoaded', function () {

      const faqQuestions = document.querySelectorAll('.faq-question');

      faqQuestions.forEach(function (question) {

        question.addEventListener('click', function () {

          const currentItem = this.closest('.faq-item');
          const currentAnswer = currentItem.querySelector('.faq-answer');
          const currentIcon = currentItem.querySelector('.faq-icon i');

          document.querySelectorAll('.faq-item').forEach(function (item) {

            if (item !== currentItem) {

              const answer = item.querySelector('.faq-answer');
              const icon = item.querySelector('.faq-icon i');

              answer.classList.add('hidden');

              icon.classList.remove('fa-minus');
              icon.classList.add('fa-plus');

            }

          });

          if (currentAnswer.classList.contains('hidden')) {

            currentAnswer.classList.remove('hidden');

            currentIcon.classList.remove('fa-plus');
            currentIcon.classList.add('fa-minus');

          } else {

            currentAnswer.classList.add('hidden');

            currentIcon.classList.remove('fa-minus');
            currentIcon.classList.add('fa-plus');

          }

        });

      });

    });
  </script>

@endsection
