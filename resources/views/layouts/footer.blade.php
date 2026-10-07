
<!-- ===== FOOTER ===== -->
<footer class="bg-dark-900 pt-20 pb-8 relative overflow-hidden">
    <div class="bg-grid-dark absolute inset-0"></div>
    <div class="absolute top-0 right-0 w-80 h-80 bg-primary/5 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10 mb-16">

            <!-- Brand -->
            <div>
                <img
                    src="{{ asset('storage/' . $websiteSettings->logo) }}"
                    alt="{{ $websiteSettings->website_name ?? 'Logo' }}"
                    style="height: 40px; width: auto; display: block;"
                >

                <p class="text-dark-300 text-sm mt-4 leading-relaxed">
                    {{ $websiteSettings->tagline ?? 'Discover and connect with the best businesses and places around the world.' }}
                </p>

                <!-- Social Links -->
                <div class="flex gap-3 mt-6">

                    @if(!empty($websiteSettings->facebook))
                        <a href="{{ $websiteSettings->facebook }}"
                           target="_blank"
                           rel="noopener"
                           class="w-10 h-10 bg-white/5 hover:bg-primary text-dark-300 hover:text-white rounded-xl flex items-center justify-center transition-all">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                    @endif

                    @if(!empty($websiteSettings->instagram))
                        <a href="{{ $websiteSettings->instagram }}"
                           target="_blank"
                           rel="noopener"
                           class="w-10 h-10 bg-white/5 hover:bg-primary text-dark-300 hover:text-white rounded-xl flex items-center justify-center transition-all">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                    @endif

                    @if(!empty($websiteSettings->youtube))
                        <a href="{{ $websiteSettings->youtube }}"
                           target="_blank"
                           rel="noopener"
                           class="w-10 h-10 bg-white/5 hover:bg-primary text-dark-300 hover:text-white rounded-xl flex items-center justify-center transition-all">
                            <i class="fab fa-youtube text-sm"></i>
                        </a>
                    @endif

                    @if(!empty($websiteSettings->linkedin))
                        <a href="{{ $websiteSettings->linkedin }}"
                           target="_blank"
                           rel="noopener"
                           class="w-10 h-10 bg-white/5 hover:bg-primary text-dark-300 hover:text-white rounded-xl flex items-center justify-center transition-all">
                            <i class="fab fa-linkedin-in text-sm"></i>
                        </a>
                    @endif

                </div>
            </div>


            <!-- Explore -->
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-5">
                    Explore
                </h4>

                <ul class="space-y-3">

                    <li>
                        <a href="{{ url('/about-us') }}"
                           class="text-sm text-dark-300 hover:text-primary transition-colors">
                            About Us
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/how-it-works') }}"
                           class="text-sm text-dark-300 hover:text-primary transition-colors">
                            How It Works
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/listings') }}"
                           class="text-sm text-dark-300 hover:text-primary transition-colors">
                            Browse Listings
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/blog') }}"
                           class="text-sm text-dark-300 hover:text-primary transition-colors">
                            Blog
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/contact-us') }}"
                           class="text-sm text-dark-300 hover:text-primary transition-colors">
                            Contact Us
                        </a>
                    </li>

                </ul>
            </div>


            <!-- For Businesses -->
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-5">
                    For Businesses
                </h4>

                <ul class="space-y-3">

                    <li>
                        <a href="{{ url('/advertise-with-us') }}"
                           class="text-sm text-dark-300 hover:text-primary transition-colors">
                            Advertise With Us
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/user-dashboard/businesses/create') }}"
                           class="text-sm text-dark-300 hover:text-primary transition-colors">
                            Add Your Business
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/user-dashboard') }}"
                           class="text-sm text-dark-300 hover:text-primary transition-colors">
                            User Dashboard
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/faq') }}"
                           class="text-sm text-dark-300 hover:text-primary transition-colors">
                            FAQ
                        </a>
                    </li>

                </ul>
            </div>


            <!-- Newsletter / Contact -->
            <div>
                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-5">
                    Newsletter
                </h4>

                <p class="text-sm text-dark-300 mb-4">
                    Subscribe to get the latest updates and exclusive offers.
                </p>

                <form class="mc-form flex gap-2">
                    <input
                        type="email"
                        placeholder="Your email"
                        class="flex-1 px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white text-sm placeholder:text-dark-400 focus:outline-none focus:border-primary/50 transition-colors"
                    >

                    <button
                        type="submit"
                        class="px-4 py-3 bg-primary hover:bg-primary-dark text-white rounded-xl transition-colors">
                        <i class="fas fa-paper-plane text-sm"></i>
                    </button>
                </form>


                @if(!empty($websiteSettings->address))
                    <p class="text-xs text-dark-400 mt-3">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        {{ $websiteSettings->address }}
                    </p>
                @endif

            </div>

        </div>


        <!-- Bottom Footer -->
        <div class="border-t border-white/10 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">

            <p class="text-sm text-dark-400">
                {{ $websiteSettings->copyright_text ?? '© 2026 Lokora. All rights reserved.' }}
            </p>

            <div class="flex flex-wrap gap-6">

                <a href="{{ url('/privacy-policy') }}"
                   class="text-xs text-dark-400 hover:text-primary transition-colors">
                    Privacy Policy
                </a>

                <a href="{{ url('/terms-conditions') }}"
                   class="text-xs text-dark-400 hover:text-primary transition-colors">
                    Terms & Conditions
                </a>

                <a href="{{ url('/disclaimer') }}"
                   class="text-xs text-dark-400 hover:text-primary transition-colors">
                    Disclaimer
                </a>

            </div>

        </div>

    </div>
</footer>


<!-- Scroll to top -->
<a href="#"
   class="scroll-to-top w-12 h-12 bg-primary hover:bg-primary-dark text-white rounded-full flex items-center justify-center shadow-lg shadow-primary/25 transition-all">
    <i class="fas fa-arrow-up text-sm"></i>
</a>


<!-- Side Menu (Mobile) -->
<div class="side-menu__block">

    <div class="side-menu__block-overlay absolute inset-0 bg-dark-900/60 backdrop-blur-sm"></div>

    <div class="side-menu__block-inner p-8">

        <button
            class="side-menu__block-overlay absolute top-4 right-4 w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-all">
            <i class="fas fa-times text-sm"></i>
        </button>

        <div class="mt-12">

            <a href="{{ url('/') }}"
               class="text-xl font-bold text-dark-900">
                {{ $websiteSettings->website_name ?? 'Lokora' }}
            </a>

            <nav class="mt-8 space-y-1 mobile-nav__container">

                <a href="{{ url('/') }}"
                   class="block px-4 py-3 text-dark-600 hover:text-primary hover:bg-primary/5 rounded-xl transition-all font-medium">
                    Home
                </a>

                <a href="{{ url('/about-us') }}"
                   class="block px-4 py-3 text-dark-600 hover:text-primary hover:bg-primary/5 rounded-xl transition-all font-medium">
                    About Us
                </a>

                <a href="{{ url('/listings') }}"
                   class="block px-4 py-3 text-dark-600 hover:text-primary hover:bg-primary/5 rounded-xl transition-all font-medium">
                    Listings
                </a>

                <a href="{{ url('/how-it-works') }}"
                   class="block px-4 py-3 text-dark-600 hover:text-primary hover:bg-primary/5 rounded-xl transition-all font-medium">
                    How It Works
                </a>

                <a href="{{ url('/blog') }}"
                   class="block px-4 py-3 text-dark-600 hover:text-primary hover:bg-primary/5 rounded-xl transition-all font-medium">
                    Blog
                </a>

                <a href="{{ url('/contact-us') }}"
                   class="block px-4 py-3 text-dark-600 hover:text-primary hover:bg-primary/5 rounded-xl transition-all font-medium">
                    Contact Us
                </a>

            </nav>


            <div class="mt-8 pt-8 border-t border-gray-100">

                @if(!empty($websiteSettings->email))
                    <p class="text-sm text-dark-400">
                        <i class="fas fa-envelope mr-2 text-primary"></i>
                        {{ $websiteSettings->email }}
                    </p>
                @endif

                @if(!empty($websiteSettings->phone))
                    <p class="text-sm text-dark-400 mt-2">
                        <i class="fas fa-phone mr-2 text-primary"></i>
                        {{ $websiteSettings->phone }}
                    </p>
                @endif

            </div>

        </div>

    </div>
</div>


<!-- Search Popup -->
<div class="search-popup">

    <div class="search-popup__overlay"></div>

    <div class="relative z-10 w-full max-w-xl mx-4">

        <form class="flex gap-2">

            <input
                type="text"
                placeholder="Search listings..."
                class="flex-1 px-6 py-4 bg-white rounded-2xl text-dark-900 text-lg focus:outline-none focus:ring-2 focus:ring-primary/30 shadow-2xl"
            >

            <button
                type="submit"
                class="px-6 py-4 bg-primary hover:bg-primary-dark text-white rounded-2xl transition-colors shadow-2xl">
                <i class="fas fa-search text-lg"></i>
            </button>

        </form>

    </div>

</div>

