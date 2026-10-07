@extends('layouts.main')

@section('title', 'Contact Us — Lokora Directory')

@section('content')
@if(session('success'))
    <div
        id="contact-success-popup"
        class="fixed inset-0 z-[9999] flex items-center justify-center px-4"
        style="background: rgba(22, 28, 38, 0.65); backdrop-filter: blur(6px);"
    >

        <div
            class="relative w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden"
            style="animation: contactPopup 0.35s ease-out;"
        >

            {{-- Top Accent --}}
            <div class="h-1.5 bg-primary"></div>

            {{-- Close Button --}}
            <button
                type="button"
                onclick="closeContactPopup()"
                class="absolute top-4 right-4 w-9 h-9 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-500 hover:text-gray-900 flex items-center justify-center transition"
            >
                <i class="fas fa-times text-sm"></i>
            </button>

            <div class="px-7 py-8 text-center">

                {{-- Success Icon --}}
                <div class="mx-auto mb-5 w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center">
                    <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center">
                        <i class="fas fa-check text-white text-xl"></i>
                    </div>
                </div>

                {{-- Heading --}}
                <h3 class="text-2xl font-bold text-dark-900 mb-2">
                    Message Sent Successfully!
                </h3>

                {{-- Message --}}
                <p class="text-sm text-dark-300 leading-6 mb-6">
                    {{ session('success') }}
                </p>

                {{-- Button --}}
                <button
                    type="button"
                    onclick="closeContactPopup()"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary hover:bg-primary-dark text-white font-semibold rounded-xl transition-all"
                >
                    <i class="fas fa-check text-sm"></i>
                    Okay, Got It
                </button>

            </div>

        </div>
    </div>

    <style>
        @keyframes contactPopup {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(20px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
    </style>

    <script>
        function closeContactPopup() {
            const popup = document.getElementById('contact-success-popup');

            if (popup) {
                popup.style.opacity = '0';
                popup.style.transition = 'opacity 0.2s ease';

                setTimeout(function () {
                    popup.remove();
                }, 200);
            }
        }

        setTimeout(function () {
            closeContactPopup();
        }, 5000);
    </script>
@endif
{{-- ================= PAGE HEADER ================= --}}
<section class="relative py-20 bg-dark-900 overflow-hidden">
    <div class="bg-grid-dark absolute inset-0"></div>

    <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary/10 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center" data-aos="fade-up">

            <h1 class="text-4xl sm:text-5xl font-bold text-white mb-4">
                Contact Us
            </h1>

            <nav class="flex items-center justify-center gap-2 text-sm">
                <a href="{{ url('/') }}"
                   class="text-dark-300 hover:text-primary transition-colors">
                    Home
                </a>

                <i class="fas fa-chevron-right text-xs text-dark-400"></i>

                <span class="text-primary">
                    Contact
                </span>
            </nav>

        </div>
    </div>
</section>


{{-- ================= CONTACT INFO ================= --}}
<section class="py-20 lg:py-28 bg-white relative overflow-hidden">

    <div class="bg-dots absolute inset-0 opacity-50"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-20">

            {{-- Address --}}
            <div class="card-hover bg-white rounded-2xl border border-gray-100 p-8 text-center"
                 data-aos="fade-up">

                <div class="w-16 h-16 mx-auto mb-5 bg-primary/5 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-map-marker-alt text-2xl text-primary"></i>
                </div>

                <h3 class="text-lg font-semibold text-dark-900 mb-2">
                    Visit Us Anytime
                </h3>

                <p class="text-dark-400 text-sm">
                    88 Brooklyn Golden Street,<br>
                    New York, USA
                </p>

            </div>


            {{-- Email --}}
            <div class="card-hover bg-white rounded-2xl border border-gray-100 p-8 text-center"
                 data-aos="fade-up"
                 data-aos-delay="100">

                <div class="w-16 h-16 mx-auto mb-5 bg-primary/5 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-envelope text-2xl text-primary"></i>
                </div>

                <h3 class="text-lg font-semibold text-dark-900 mb-2">
                    Send a Email
                </h3>

                <p class="text-dark-400 text-sm">

                    <a href="mailto:needhelp@lokora.com"
                       class="hover:text-primary transition-colors">
                        needhelp@lokora.com
                    </a>

                </p>

            </div>


            {{-- Phone --}}
            <div class="card-hover bg-white rounded-2xl border border-gray-100 p-8 text-center sm:col-span-2 lg:col-span-1"
                 data-aos="fade-up"
                 data-aos-delay="200">

                <div class="w-16 h-16 mx-auto mb-5 bg-primary/5 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-phone text-2xl text-primary"></i>
                </div>

                <h3 class="text-lg font-semibold text-dark-900 mb-2">
                    Call Center
                </h3>

                <p class="text-dark-400 text-sm">

                    <a href="tel:+92666888000"
                       class="hover:text-primary transition-colors">
                        92 666 888 0000
                    </a>

                </p>

            </div>

        </div>


        {{-- ================= CONTACT FORM ================= --}}
        <div class="grid lg:grid-cols-5 gap-12">

            {{-- Left Content --}}
            <div class="lg:col-span-2"
                 data-aos="fade-right">

                <span class="inline-block px-4 py-1 bg-primary/5 text-primary text-sm font-medium rounded-full mb-4">
                    Contact Us
                </span>

                <h2 class="text-3xl sm:text-4xl font-bold text-dark-900 mb-6">
                    How Can We Help You?
                </h2>

                <p class="text-dark-400 leading-relaxed mb-8">
                    Have a question about a business listing, partnership,
                    account, or anything else? Our team is here to help.
                    Send us a message and we'll get back to you as soon as possible.
                </p>

                <div class="flex items-center gap-3">

                    <a href="#"
                       class="w-10 h-10 bg-dark-50 hover:bg-primary text-dark-400 hover:text-white rounded-full flex items-center justify-center transition-all">
                        <i class="fab fa-twitter text-sm"></i>
                    </a>

                    <a href="#"
                       class="w-10 h-10 bg-dark-50 hover:bg-primary text-dark-400 hover:text-white rounded-full flex items-center justify-center transition-all">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>

                    <a href="#"
                       class="w-10 h-10 bg-dark-50 hover:bg-primary text-dark-400 hover:text-white rounded-full flex items-center justify-center transition-all">
                        <i class="fab fa-dribbble text-sm"></i>
                    </a>

                    <a href="#"
                       class="w-10 h-10 bg-dark-50 hover:bg-primary text-dark-400 hover:text-white rounded-full flex items-center justify-center transition-all">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>

                </div>

            </div>


            {{-- Form --}}
            <div class="lg:col-span-3"
                 data-aos="fade-left">

                {{-- Backend baad mein connect karenge --}}
                <form action="{{ route('contact.store') }}"
                      method="POST">

                    @csrf

                    <div class="grid sm:grid-cols-2 gap-4">

                        {{-- Name --}}
                        <div>
                            <input
                                type="text"
                                name="name"
                                placeholder="Your name"
                                class="w-full px-5 py-4 bg-dark-50 border border-gray-100 rounded-xl text-dark-900 text-sm placeholder:text-dark-300 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/30 transition-all">
                        </div>


                        {{-- Email --}}
                        <div>
                            <input
                                type="email"
                                name="email"
                                placeholder="Email address"
                                class="w-full px-5 py-4 bg-dark-50 border border-gray-100 rounded-xl text-dark-900 text-sm placeholder:text-dark-300 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/30 transition-all">
                        </div>


                        {{-- Phone --}}
                        <div>
                            <input
                                type="text"
                                name="phone"
                                placeholder="Phone number"
                                class="w-full px-5 py-4 bg-dark-50 border border-gray-100 rounded-xl text-dark-900 text-sm placeholder:text-dark-300 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/30 transition-all">
                        </div>


                        {{-- Subject --}}
                        <div>
                            <input
                                type="text"
                                name="subject"
                                placeholder="Subject"
                                class="w-full px-5 py-4 bg-dark-50 border border-gray-100 rounded-xl text-dark-900 text-sm placeholder:text-dark-300 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/30 transition-all">
                        </div>


                        {{-- Message --}}
                        <div class="sm:col-span-2">

                            <textarea
                                name="message"
                                rows="5"
                                placeholder="Write your message..."
                                class="w-full px-5 py-4 bg-dark-50 border border-gray-100 rounded-xl text-dark-900 text-sm placeholder:text-dark-300 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary/30 transition-all resize-none"></textarea>

                        </div>


                        {{-- Button --}}
                        <div class="sm:col-span-2">

                            <button
                                type="submit"
                                class="inline-flex items-center gap-2 px-8 py-4 bg-primary hover:bg-primary-dark text-white font-medium rounded-xl transition-colors shadow-lg shadow-primary/25">

                                Send Message

                                <i class="fas fa-paper-plane"></i>

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>


{{-- ================= MAP ================= --}}
<section class="relative">

    <div class="aspect-[16/5] w-full">

        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.575!2d100.5347!3d13.7463!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29ecde3aee521%3A0x9f43939a2caf2963!2sSiam%20Paragon!5e0!3m2!1sen!2sth!4v1711000000000"
            class="w-full h-full border-0"
            allowfullscreen
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>

    </div>

</section>


{{-- ================= CTA ================= --}}
<section class="relative py-20 overflow-hidden"
         style="background: linear-gradient(135deg, #161c26 0%, #1f2937 100%)">

    <div class="bg-grid-dark absolute inset-0"></div>

    <div class="absolute -top-20 -right-20 w-80 h-80 bg-primary/20 rounded-full blur-3xl"></div>

    <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-primary/10 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        <div class="flex flex-col lg:flex-row items-center gap-12">

            <div class="flex-1"
                 data-aos="fade-right">

                <span class="inline-block px-4 py-1 bg-primary/10 text-primary text-sm font-medium rounded-full mb-6">
                    Special Offer
                </span>

                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6">
                    Sign up to get<br>
                    Special Offers
                    <span class="text-gradient">Every Day</span>
                </h2>

                <p class="text-dark-300 text-lg mb-8 max-w-md">
                    Join thousands of businesses and explore the best listing opportunities available.
                </p>

                <a href="#"
                   class="inline-flex items-center gap-2 px-8 py-4 bg-primary hover:bg-primary-dark text-white font-medium rounded-xl transition-colors shadow-lg shadow-primary/25">

                    Get Started Free

                    <i class="fas fa-arrow-right"></i>

                </a>

            </div>


            <div class="flex-1"
                 data-aos="fade-left">

                <img
                    decoding="async"
                    src="https://images.unsplash.com/photo-1553877522-43269d4ea984?w=600&h=400&fit=crop&q=80"
                    alt="Special Offer"
                    class="rounded-3xl shadow-2xl w-full"
                    loading="lazy">

            </div>

        </div>

    </div>

</section>

@endsection
