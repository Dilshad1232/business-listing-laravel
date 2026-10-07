<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Lokora — Discover, Connect, Explore')
    </title>

    {{-- Favicon --}}
    <link
        rel="icon"
        type="image/png"
        sizes="32x32"
        href="{{ asset('assets/images/favicons/favicon-32x32.png') }}"
    >

    {{-- SEO --}}
    <meta
        name="description"
        content="@yield('description', 'Your one-stop platform to find the best businesses, restaurants, hotels, and services around you. Powered by Lokora.')"
    >

    <meta
        name="keywords"
        content="explore places, connect businesses, discover restaurants, local services, city explorer"
    >

    <meta name="author" content="Lokora">

    <meta
        name="robots"
        content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1"
    >
{{-- Canonical URL --}}
<link rel="canonical" href="{{ url()->current() }}">
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    >

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#fc3c3c',
                            light: '#fff1f1',
                            dark: '#d92626',
                            50: '#fff5f5',
                            100: '#ffe3e3',
                            200: '#ffc9c9',
                            300: '#ffa8a8',
                            400: '#ff6b6b',
                            500: '#fc3c3c',
                            600: '#d92626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d'
                        },

                        dark: {
                            DEFAULT: '#161c26',
                            50: '#f5f6f7',
                            100: '#e5e7eb',
                            200: '#d1d5db',
                            300: '#9ca3af',
                            400: '#828892',
                            500: '#6b7280',
                            600: '#4b5563',
                            700: '#374151',
                            800: '#1f2937',
                            900: '#161c26'
                        }
                    },

                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    },

                    borderRadius: {
                        '4xl': '2rem'
                    }
                }
            }
        }
    </script>

    {{-- AOS --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css"
    >

    {{-- Swiper --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    >

    {{-- GLightbox --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/glightbox@3.3.0/dist/css/glightbox.min.css"
    >

    {{-- Font Awesome --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css"
    >

    {{-- Vegas --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/vegas@2.5.4/dist/vegas.min.css"
    >

    {{-- Lokora Icons --}}
    <link
        rel="stylesheet"
        href="{{ asset('assets/css/lokora-icon.css') }}"
    >

    <link
        rel="stylesheet"
        href="{{ asset('assets/css/lokora-new-icons.css') }}"
    >

    {{-- Custom CSS --}}
    <link
        rel="stylesheet"
        href="{{ asset('assets/css/custom.css') }}"
    >
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/nouislider@15.8.1/dist/nouislider.min.css"
>

{{-- Website Schema --}}
<script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "WebSite",
        "name": "Lokora",
        "url": "{{ url('/') }}",
        "description": "Your one-stop platform to find the best businesses, restaurants, hotels, and services around you."
    }
    </script>

    @stack('styles')

</head>

<body>

    {{-- Header --}}
    @include('layouts.header')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')


    {{-- jQuery --}}
    <script
        src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js">
    </script>

    {{-- Swiper --}}
    <script
        src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js">
    </script>

    {{-- GSAP --}}
    <script
        src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js">
    </script>

    {{-- AOS --}}
    <script
        src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js">
    </script>

    {{-- GLightbox --}}
    <script
        src="https://cdn.jsdelivr.net/npm/glightbox@3.3.0/dist/js/glightbox.min.js">
    </script>

    {{-- Typed --}}
    <script
        src="https://cdn.jsdelivr.net/npm/typed.js@2.0.16/dist/typed.umd.js">
    </script>

    {{-- Vegas --}}
    <script
        src="https://cdn.jsdelivr.net/npm/vegas@2.5.4/dist/vegas.min.js">
    </script>

    {{-- CountUp --}}
    <script
        src="https://cdn.jsdelivr.net/npm/countup.js@2.8.0/dist/countUp.umd.js">
    </script>
<script src="https://cdn.jsdelivr.net/npm/nouislider@15.8.1/dist/nouislider.min.js"></script>
    {{-- Lokora JS --}}
    <script src="{{ asset('assets/js/theme.js') }}"></script>

    @stack('scripts')



    {{-- Justdial Style Vertical Tabs --}}
    <div class="lokora-vertical-tabs">

        <a href="{{ route('listings.index') }}" class="lokora-vtab">
            <span>LISTINGS</span>
        </a>

        <a href="{{ route('businesses.index') }}" class="lokora-vtab">
            <span>BUSINESSES</span>
        </a>

        <a href="{{ url('/') }}#special-offers" class="lokora-vtab">
            <span>OFFERS</span>
        </a>

    </div>

    <style>
    /* =========================================================
       JUSTDIAL STYLE VERTICAL TABS
    ========================================================= */

    .lokora-vertical-tabs {
        position: fixed;
        right: 0;
        top: 50%;
        transform: translateY(-50%);

        z-index: 99999;

        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .lokora-vtab {
        width: 30px;
        height: 100px;

        display: flex;
        align-items: center;
        justify-content: center;

        position: relative;

        background: #ffffff;
        border: 2px solid #fc3c3c;
        border-right: none;

        border-radius: 10px 0 0 10px;

        text-decoration: none;

        box-shadow: -4px 5px 18px rgba(0,0,0,0.15);

        overflow: hidden;

        transition: all 0.3s ease;
    }

    /* Vertical text */
    .lokora-vtab span {
        writing-mode: vertical-rl;
        transform: rotate(180deg);

        color: #161c26;

        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.5px;

        white-space: nowrap;

        transition: all 0.3s ease;
    }

    /* Animated premium border */
    .lokora-vtab::before {
        content: "";

        position: absolute;

        top: 0;
        left: 0;

        width: 3px;
        height: 100%;

        background: linear-gradient(
            180deg,
            #fc3c3c,
            #ffb347,
            #fc3c3c
        );

        background-size: 100% 300%;

        animation: lokoraVerticalGlow 3s linear infinite;
    }

    /* Hover */
    .lokora-vtab:hover {
        width: 38px;

        background: #fc3c3c;

        box-shadow:
            -6px 8px 25px rgba(252,60,60,0.35);
    }

    .lokora-vtab:hover span {
        color: #ffffff;
        letter-spacing: 2px;
    }

    /* Glow animation */
    @keyframes lokoraVerticalGlow {

        0% {
            background-position: 0% 0%;
        }

        50% {
            background-position: 0% 100%;
        }

        100% {
            background-position: 0% 0%;
        }

    }

    /* Mobile */
    @media (max-width: 768px) {

        .lokora-vertical-tabs {
            gap: 5px;
        }

        .lokora-vtab {
            width: 26px;
            height: 140px;

            border-radius: 8px 0 0 8px;
        }

        .lokora-vtab span {
            font-size: 9px;
            letter-spacing: 1px;
        }

        .lokora-vtab:hover {
            width: 32px;
        }

    }
    </style>


</body>

</html>
