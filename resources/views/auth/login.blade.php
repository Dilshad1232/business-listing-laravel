
@extends('layouts.main')

@section('title', 'Login — Lokora')

@section('description', 'Login to your Lokora account and manage your businesses, products and services.')

@section('content')

<style>

/* =========================================================
   LOKORA LOGIN PAGE
========================================================= */

.lokora-login-section {
    min-height: calc(100vh - 80px);

    background:
        radial-gradient(
            circle at 8% 18%,
            rgba(252, 60, 60, 0.14),
            transparent 30%
        ),
        radial-gradient(
            circle at 92% 82%,
            rgba(40, 110, 190, 0.18),
            transparent 32%
        ),
        linear-gradient(
            135deg,
            #061326 0%,
            #0b1f3a 50%,
            #102d52 100%
        );

    display: flex;
    align-items: center;
    justify-content: center;

    position: relative;
    overflow: hidden;

    /* Header se proper gap */
    padding: 55px 20px;
}


/* =========================================================
   BACKGROUND 3D SHAPES
========================================================= */

.login-shape {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
}

.login-shape.one {
    width: 280px;
    height: 280px;

    top: -130px;
    left: -90px;

    border: 1px solid rgba(255,255,255,.08);

    box-shadow:
        0 0 90px rgba(252,60,60,.10),
        inset 0 0 45px rgba(255,255,255,.03);
}

.login-shape.two {
    width: 360px;
    height: 360px;

    bottom: -190px;
    right: -140px;

    border: 1px solid rgba(255,255,255,.08);

    box-shadow:
        0 0 100px rgba(50,130,220,.12),
        inset 0 0 50px rgba(255,255,255,.03);
}


/* =========================================================
   MAIN 3D CONTAINER
========================================================= */

.login-main-card {
    width: 100%;
    max-width: 1080px;

    min-height: 555px;

    display: grid;

    grid-template-columns:
        minmax(0, 1fr)
        390px;

    position: relative;
    z-index: 2;

    border-radius: 28px;

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.10),
            rgba(255,255,255,.045)
        );

    border: 1px solid rgba(255,255,255,.15);

    box-shadow:
        0 35px 80px rgba(0,0,0,.38),
        0 12px 30px rgba(0,0,0,.18),
        inset 0 1px 0 rgba(255,255,255,.14);

    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);

    overflow: hidden;

    /* Card header se chipkega nahi */
    margin-top: 65px;
    margin-bottom: 5px;
}


/* =========================================================
   LEFT CONTENT
========================================================= */

.login-left {
    padding: 48px 50px;

    display: flex;
    flex-direction: column;
    justify-content: center;

    position: relative;
}


/* Vertical divider */

.login-left::after {
    content: "";

    position: absolute;

    right: 0;
    top: 12%;

    height: 76%;
    width: 1px;

    background:
        linear-gradient(
            transparent,
            rgba(255,255,255,.15),
            transparent
        );
}


/* Badge */

.login-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    width: fit-content;

    padding: 7px 13px;

    border-radius: 30px;

    color: #fff;

    font-size: 12px;
    font-weight: 600;

    background: rgba(252,60,60,.11);

    border: 1px solid rgba(252,60,60,.25);

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.08),
        0 8px 20px rgba(0,0,0,.12);
}

.login-badge i {
    color: #fc3c3c;
}


/* Heading */

.login-left h1 {
    color: #fff;

    font-size: clamp(34px, 4vw, 48px);

    line-height: 1.08;

    font-weight: 800;

    letter-spacing: -1.5px;

    margin: 18px 0 13px;
}

.login-left h1 span {
    color: #fc3c3c;
}


/* Description */

.login-description {
    color: rgba(255,255,255,.68);

    font-size: 14px;

    line-height: 1.7;

    max-width: 500px;

    margin-bottom: 23px;
}


/* =========================================================
   FEATURES
========================================================= */

.login-features {
    display: grid;

    grid-template-columns:
        repeat(2, 1fr);

    gap: 10px;

    max-width: 500px;
}

.login-feature {
    display: flex;
    align-items: center;

    gap: 11px;

    padding: 10px 12px;

    border-radius: 12px;

    background:
        rgba(255,255,255,.055);

    border:
        1px solid rgba(255,255,255,.08);

    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.04),
        0 8px 20px rgba(0,0,0,.08);

    transition: .25s ease;
}

.login-feature:hover {
    transform: translateY(-2px);

    background:
        rgba(255,255,255,.09);

    border-color:
        rgba(252,60,60,.25);
}


/* Feature icon */

.feature-icon {
    width: 34px;
    height: 34px;

    min-width: 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    color: #fc3c3c;

    background:
        rgba(252,60,60,.10);

    border:
        1px solid rgba(252,60,60,.16);
}

.login-feature span {
    color: rgba(255,255,255,.78);

    font-size: 12px;

    font-weight: 500;
}


/* =========================================================
   RIGHT LOGIN AREA
========================================================= */

.login-right {
    display: flex;

    align-items: center;
    justify-content: center;

    padding: 25px;

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.11),
            rgba(255,255,255,.035)
        );

    position: relative;
}


/* =========================================================
   LOGIN BOX
========================================================= */

.login-box {
    width: 100%;

    max-width: 335px;

    padding: 25px 26px 22px;

    background: #fff;

    border-radius: 20px;

    box-shadow:
        0 25px 50px rgba(0,0,0,.28),
        0 8px 18px rgba(0,0,0,.12),
        inset 0 1px 0 rgba(255,255,255,.9);

    transform:
        translateY(-2px);
}


/* Login icon */

.login-icon {
    width: 46px;
    height: 46px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 13px;

    color: #fff;

    background:
        linear-gradient(
            135deg,
            #fc3c3c,
            #d92626
        );

    box-shadow:
        0 10px 20px rgba(252,60,60,.28),
        inset 0 1px 0 rgba(255,255,255,.25);

    margin-bottom: 12px;
}

.login-icon i {
    font-size: 19px;
}


/* Heading */

.login-box h2 {
    font-size: 23px;

    font-weight: 800;

    color: #111827;

    margin:
        0 0 3px;
}

.login-box-subtitle {
    color: #6b7280;

    font-size: 12px;

    margin-bottom: 17px;
}


/* =========================================================
   ALERTS
========================================================= */

.login-alert {
    padding: 8px 10px;

    border-radius: 8px;

    font-size: 11px;

    margin-bottom: 11px;
}


/* =========================================================
   FORM
========================================================= */

.login-form-group {
    margin-bottom: 11px;
}

.login-form-group label {
    display: block;

    color: #374151;

    font-size: 12px;

    font-weight: 600;

    margin-bottom: 5px;
}


/* Input wrapper */

.login-input-wrap {
    position: relative;
}


/* Left icon */

.login-input-wrap > i {
    position: absolute;

    left: 12px;
    top: 50%;

    transform:
        translateY(-50%);

    color: #9ca3af;

    font-size: 13px;

    z-index: 2;
}


/* Input */

.login-input {
    width: 100%;

    height: 42px;

    border:
        1px solid #e5e7eb;

    border-radius: 10px;

    padding:
        0 40px 0 36px;

    font-size: 12px;

    color: #111827;

    outline: none;

    background: #f9fafb;

    transition: .2s ease;
}

.login-input:focus {
    background: #fff;

    border-color:
        #fc3c3c;

    box-shadow:
        0 0 0 3px
        rgba(252,60,60,.09);
}


/* Password toggle */

.password-toggle {
    position: absolute;

    right: 11px;
    top: 50%;

    transform:
        translateY(-50%);

    border: 0;

    background: transparent;

    color: #9ca3af;

    cursor: pointer;

    padding: 2px;
}

.password-toggle:hover {
    color: #fc3c3c;
}


/* =========================================================
   REMEMBER / FORGOT
========================================================= */

.login-options {
    display: flex;

    align-items: center;

    justify-content: space-between;

    margin:
        5px 0 14px;

    font-size: 11px;
}

.remember-check {
    display: flex;

    align-items: center;

    gap: 6px;

    color: #6b7280;
}

.remember-check input {
    accent-color:
        #fc3c3c;
}

.forgot-link {
    color:
        #fc3c3c;

    text-decoration: none;

    font-weight: 600;
}

.forgot-link:hover {
    color:
        #d92626;
}


/* =========================================================
   LOGIN BUTTON
========================================================= */

.login-submit {
    width: 100%;

    height: 42px;

    border: 0;

    border-radius: 10px;

    color: #fff;

    background:
        linear-gradient(
            135deg,
            #fc3c3c,
            #d92626
        );

    font-size: 13px;

    font-weight: 700;

    box-shadow:
        0 10px 18px
        rgba(252,60,60,.24),

        inset 0 1px 0
        rgba(255,255,255,.2);

    transition: .25s ease;

    cursor: pointer;
}

.login-submit:hover {
    transform:
        translateY(-2px);

    box-shadow:
        0 14px 25px
        rgba(252,60,60,.30),

        inset 0 1px 0
        rgba(255,255,255,.2);
}

.login-submit i {
    margin-right: 6px;
}


/* =========================================================
   REGISTER
========================================================= */

.register-text {
    text-align: center;

    color: #6b7280;

    font-size: 12px;

    margin:
        14px 0 0;
}

.register-text a {
    color:
        #fc3c3c;

    font-weight: 700;

    text-decoration: none;
}

.register-text a:hover {
    color:
        #d92626;
}


/* =========================================================
   SECURITY
========================================================= */

.secure-text {
    display: flex;

    justify-content: center;
    align-items: center;

    gap: 5px;

    margin-top: 10px;

    color: #9ca3af;

    font-size: 10px;
}

.secure-text i {
    color:
        #16a34a;
}


/* =========================================================
   DESKTOP SHORT SCREEN
========================================================= */

@media (min-width: 992px) and (max-height: 760px) {

    .lokora-login-section {
        min-height: calc(100vh - 80px);

        padding-top: 35px;
        padding-bottom: 35px;
    }

    .login-main-card {
        min-height: 510px;
    }

    .login-left {
        padding:
            35px 45px;
    }

    .login-left h1 {
        font-size: 38px;

        margin:
            14px 0 10px;
    }

    .login-description {
        margin-bottom: 17px;
    }

    .login-right {
        padding: 20px;
    }

    .login-box {
        padding:
            21px 24px 19px;
    }

    .login-box h2 {
        font-size: 21px;
    }

    .login-box-subtitle {
        margin-bottom: 12px;
    }

    .login-form-group {
        margin-bottom: 8px;
    }

    .login-options {
        margin-bottom: 11px;
    }

    .register-text {
        margin-top: 10px;
    }
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991px) {

    .lokora-login-section {
        min-height: auto;

        padding:
            38px 18px;
    }

    .login-main-card {
        max-width: 650px;

        grid-template-columns:
            1fr;
    }

    .login-left {
        padding:
            38px 35px 25px;
    }

    .login-left::after {
        display: none;
    }

    .login-left h1 {
        font-size: 36px;
    }

    .login-right {
        padding:
            10px 35px 38px;
    }

    .login-box {
        max-width: 390px;
    }
}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 575px) {

    .lokora-login-section {
        padding:
            25px 12px;
    }

    .login-main-card {
        border-radius:
            20px;
    }

    .login-left {
        padding:
            28px 22px 20px;
    }

    .login-left h1 {
        font-size:
            30px;

        letter-spacing:
            -1px;
    }

    .login-description {
        font-size:
            13px;
    }

    .login-features {
        grid-template-columns:
            1fr;
    }

    .login-right {
        padding:
            5px 16px 25px;
    }

    .login-box {
        padding:
            22px 20px 20px;

        border-radius:
            17px;
    }

}


/* =========================================================
   VERY SMALL MOBILE
========================================================= */

@media (max-width: 380px) {

    .login-left h1 {
        font-size:
            27px;
    }

    .login-left {
        padding:
            24px 18px 18px;
    }

    .login-right {
        padding:
            5px 10px 20px;
    }

    .login-box {
        padding:
            20px 17px 18px;
    }

}

</style>


{{-- =======================================================
     LOGIN SECTION
======================================================== --}}

<section class="lokora-login-section">

    {{-- Background Decoration --}}
    <div class="login-shape one"></div>
    <div class="login-shape two"></div>


    {{-- ===================================================
         MAIN 3D CARD
    ==================================================== --}}

    <div class="login-main-card">


        {{-- ===============================================
             LEFT CONTENT
        ================================================ --}}

        <div class="login-left">

            {{-- Badge --}}
            <div class="login-badge">

                <i class="fa-solid fa-shield-halved"></i>

                Secure Lokora Account

            </div>


            {{-- Heading --}}
            <h1>

                Welcome back<br>

                to <span>Lokora.</span>

            </h1>


            {{-- Description --}}
            <p class="login-description">

                Sign in to manage your businesses,
                products and services from one simple
                and powerful dashboard.

            </p>


            {{-- Features --}}
            <div class="login-features">


                {{-- Feature 1 --}}
                <div class="login-feature">

                    <div class="feature-icon">

                        <i class="fa-solid fa-building"></i>

                    </div>

                    <span>
                        Manage Businesses
                    </span>

                </div>


                {{-- Feature 2 --}}
                <div class="login-feature">

                    <div class="feature-icon">

                        <i class="fa-solid fa-box-open"></i>

                    </div>

                    <span>
                        Showcase Products
                    </span>

                </div>


                {{-- Feature 3 --}}
                <div class="login-feature">

                    <div class="feature-icon">

                        <i class="fa-solid fa-briefcase"></i>

                    </div>

                    <span>
                        Publish Services
                    </span>

                </div>


                {{-- Feature 4 --}}
                <div class="login-feature">

                    <div class="feature-icon">

                        <i class="fa-solid fa-comments"></i>

                    </div>

                    <span>
                        Manage Enquiries
                    </span>

                </div>


            </div>

        </div>


        {{-- ===============================================
             RIGHT LOGIN
        ================================================ --}}

        <div class="login-right">


            <div class="login-box">


                {{-- Login Icon --}}
                <div class="login-icon">

                    <i class="fa-solid fa-right-to-bracket"></i>

                </div>


                {{-- Title --}}
                <h2>
                    Sign In
                </h2>


                <p class="login-box-subtitle">

                    Access your Lokora account

                </p>


                {{-- =======================================
                     SUCCESS MESSAGE
                ======================================== --}}

                @if(session('success'))

                    <div class="alert alert-success login-alert">

                        {{ session('success') }}

                    </div>

                @endif


                {{-- =======================================
                     ERROR MESSAGE
                ======================================== --}}

                @if($errors->any())

                    <div class="alert alert-danger login-alert">

                        {{ $errors->first() }}

                    </div>

                @endif


                {{-- =======================================
                     LOGIN FORM
                ======================================== --}}

                <form
                    method="POST"
                    action="{{ route('login.submit') }}"
                >

                    @csrf


                    {{-- Email --}}
                    <div class="login-form-group">

                        <label for="email">

                            Email Address

                        </label>


                        <div class="login-input-wrap">

                            <i class="fa-regular fa-envelope"></i>


                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="login-input"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                required
                                autocomplete="email"
                            >

                        </div>

                    </div>


                    {{-- Password --}}
                    <div class="login-form-group">

                        <label for="password">

                            Password

                        </label>


                        <div class="login-input-wrap">

                            <i class="fa-solid fa-lock"></i>


                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="login-input"
                                placeholder="Enter your password"
                                required
                                autocomplete="current-password"
                            >


                            {{-- Show Password --}}
                            <button
                                type="button"
                                class="password-toggle"
                                id="togglePassword"
                                aria-label="Show password"
                            >

                                <i class="fa-regular fa-eye"></i>

                            </button>

                        </div>

                    </div>


                    {{-- Remember + Forgot --}}
                    <div class="login-options">


                        <label class="remember-check">

                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                            >

                            Remember me

                        </label>


                        <a
                            href="#"
                            class="forgot-link"
                        >

                            Forgot Password?

                        </a>


                    </div>


                    {{-- Login Button --}}
                    <button
                        type="submit"
                        class="login-submit"
                    >

                        <i
                            class="fa-solid fa-arrow-right-to-bracket"
                        ></i>

                        Sign In

                    </button>


                </form>


                {{-- Register --}}
                <p class="register-text">

                    Don't have an account?

                    <a href="{{ route('register') }}">

                        Create Account

                    </a>

                </p>


                {{-- Security --}}
                <div class="secure-text">

                    <i class="fa-solid fa-lock"></i>

                    Your information is securely protected

                </div>


            </div>

        </div>


    </div>

</section>


{{-- =======================================================
     PASSWORD SHOW / HIDE
======================================================== --}}

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const togglePassword =
            document.getElementById('togglePassword');

        const password =
            document.getElementById('password');


        if (
            togglePassword &&
            password
        ) {

            togglePassword.addEventListener(
                'click',
                function () {

                    const currentType =
                        password.getAttribute('type');


                    if (
                        currentType === 'password'
                    ) {

                        password.setAttribute(
                            'type',
                            'text'
                        );

                    } else {

                        password.setAttribute(
                            'type',
                            'password'
                        );

                    }


                    const icon =
                        this.querySelector('i');


                    icon.classList.toggle(
                        'fa-eye'
                    );

                    icon.classList.toggle(
                        'fa-eye-slash'
                    );

                }
            );

        }

    }
);

</script>

@endsection
