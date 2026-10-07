
@extends('layouts.main')

@section('title', 'Create Account — Lokora')
@section('description', 'Create your Lokora account and start growing your business online.')

@section('content')

<style>
/* =========================================================
   LOKORA REGISTER — COMPACT PREMIUM / NO SCROLL
========================================================= */

.lokora-register-page {
    position: relative;
    min-height: calc(100vh - 145px);
    padding: 28px 20px;

    display: flex;
    align-items: center;
    justify-content: center;

    overflow: hidden;

    background:
        radial-gradient(
            circle at 10% 20%,
            rgba(252,60,60,.10),
            transparent 28%
        ),
        radial-gradient(
            circle at 90% 80%,
            rgba(60,100,170,.12),
            transparent 30%
        ),
        #111822;
}

/* GRID */

.reg-bg-grid {
    position: absolute;

    top: 25px;
    bottom: 25px;
    left: 0;
    right: 0;

    opacity: .16;

    background-image:
        linear-gradient(
            rgba(255,255,255,.025) 1px,
            transparent 1px
        ),
        linear-gradient(
            90deg,
            rgba(255,255,255,.025) 1px,
            transparent 1px
        );

    background-size: 42px 42px;

    pointer-events: none;
}

/* ORBS */

.reg-orb {
    position: absolute;
    border-radius: 50%;
    pointer-events: none;
}

.reg-orb-one {
    width: 220px;
    height: 220px;

    top: -100px;
    left: -70px;

    background: rgba(252,60,60,.06);

    box-shadow:
        0 0 100px rgba(252,60,60,.14);
}

.reg-orb-two {
    width: 280px;
    height: 280px;

    right: -130px;
    bottom: -130px;

    background: rgba(70,110,180,.06);

    box-shadow:
        0 0 120px rgba(70,110,180,.12);
}

/* MAIN CARD */

.reg-main-card {
    position: relative;
    z-index: 5;
margin-top: 80px;
    width: 100%;
    max-width: 1040px;

    min-height: 500px;

    display: grid;

    grid-template-columns: 380px 1fr;

    overflow: hidden;

    border-radius: 25px;

    background: rgba(255,255,255,.055);

    border: 1px solid rgba(255,255,255,.10);

    box-shadow:
        0 30px 80px rgba(0,0,0,.45),
        inset 0 1px 0 rgba(255,255,255,.07);

    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}

/* =========================================================
   FORM PANEL
========================================================= */

.reg-form-panel {
    padding: 28px 34px;

    background: rgba(255,255,255,.98);

    display: flex;
    align-items: center;
}

.reg-form {
    width: 100%;
    max-width: 310px;

    margin: auto;
}

/* BRAND */

.reg-brand {
    display: flex;
    align-items: center;
    gap: 9px;

    margin-bottom: 15px;
}

.reg-brand-mark {
    width: 34px;
    height: 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 10px;

    background: linear-gradient(
        135deg,
        #fc3c3c,
        #d82424
    );

    color: #fff;

    font-size: 14px;
    font-weight: 800;

    box-shadow:
        0 7px 16px rgba(252,60,60,.22);
}

.reg-brand-name {
    color: #171d27;

    font-size: 16px;
    font-weight: 800;
}

/* HEADING */

.reg-heading {
    margin-bottom: 16px;
}

.reg-heading h2 {
    margin: 0 0 4px;

    color: #121821;

    font-size: 24px;
    font-weight: 800;

    letter-spacing: -.6px;
}

.reg-heading p {
    margin: 0;

    color: #8b939f;

    font-size: 11px;
}

/* ERROR */

.reg-error-box {
    margin-bottom: 10px;

    padding: 7px 10px;

    border-radius: 8px;

    background: #fff1f1;

    border: 1px solid #ffd6d6;

    color: #d62d2d;

    font-size: 9px;
}

.reg-error-box ul {
    margin: 0;
    padding-left: 15px;
}

/* FIELD */

.reg-field {
    margin-bottom: 9px;
}

.reg-field label {
    display: block;

    margin-bottom: 4px;

    color: #303844;

    font-size: 10px;
    font-weight: 700;
}

/* INPUT */

.reg-input-box {
    position: relative;
}

.reg-input-icon {
    position: absolute;

    left: 12px;
    top: 50%;

    transform: translateY(-50%);

    width: 14px;
    height: 14px;

    color: #9aa2ad;

    pointer-events: none;
}

/* USER ICON */

.icon-user::before {
    content: "";

    width: 6px;
    height: 6px;

    border: 1.4px solid currentColor;
    border-radius: 50%;

    position: absolute;

    top: 0;
    left: 4px;
}

.icon-user::after {
    content: "";

    width: 11px;
    height: 6px;

    border: 1.4px solid currentColor;
    border-bottom: 0;

    border-radius: 8px 8px 0 0;

    position: absolute;

    bottom: 0;
    left: 1px;
}

/* MAIL ICON */

.icon-mail::before {
    content: "";

    width: 13px;
    height: 9px;

    border: 1.4px solid currentColor;

    border-radius: 3px;

    position: absolute;

    left: 0;
    top: 2px;
}

.icon-mail::after {
    content: "";

    position: absolute;

    width: 7px;
    height: 7px;

    border-left: 1.4px solid currentColor;
    border-bottom: 1.4px solid currentColor;

    transform: rotate(-45deg);

    left: 3px;
    top: 0;
}

/* LOCK ICON */

.icon-lock::before {
    content: "";

    width: 11px;
    height: 9px;

    border: 1.4px solid currentColor;

    border-radius: 3px;

    position: absolute;

    bottom: 0;
    left: 1px;
}

.icon-lock::after {
    content: "";

    width: 7px;
    height: 7px;

    border: 1.4px solid currentColor;
    border-bottom: 0;

    border-radius: 7px 7px 0 0;

    position: absolute;

    top: 0;
    left: 3px;
}

/* INPUT */

.reg-input {
    width: 100%;
    height: 39px;

    padding: 0 36px;

    border: 1px solid #e1e5ea;

    border-radius: 9px;

    background: #f8f9fb;

    color: #202733;

    outline: none;

    font-size: 11px;

    transition: .2s ease;
}

.reg-input:hover {
    border-color: #d4d9df;
}

.reg-input:focus {
    background: #fff;

    border-color: #fc3c3c;

    box-shadow:
        0 0 0 3px rgba(252,60,60,.06);
}

.reg-input::placeholder {
    color: #adb4bd;
}

/* PASSWORD TOGGLE */

.reg-password-toggle {
    position: absolute;

    right: 9px;
    top: 50%;

    transform: translateY(-50%);

    width: 23px;
    height: 23px;

    border: 0;

    background: transparent;

    color: #9aa1ab;

    cursor: pointer;

    padding: 0;
}

.reg-password-toggle:hover {
    color: #fc3c3c;
}

.eye-icon {
    font-size: 10px;
}

/* TERMS */

.reg-terms {
    display: flex;
    align-items: flex-start;

    gap: 7px;

    margin: 10px 0 12px;

    color: #858d98;

    font-size: 9px;

    line-height: 1.4;
}

.reg-terms input {
    width: 12px;
    height: 12px;

    margin-top: 1px;

    accent-color: #fc3c3c;

    flex-shrink: 0;
}

.reg-terms label {
    cursor: pointer;
}

.reg-terms a {
    color: #fc3c3c;

    text-decoration: none;

    font-weight: 700;
}

/* BUTTON */

.reg-submit {
    width: 100%;
    height: 40px;

    border: 0;

    border-radius: 9px;

    background: #171d27;

    color: #fff;

    font-size: 11px;
    font-weight: 700;

    cursor: pointer;

    transition: .25s ease;
}

.reg-submit:hover {
    background: #fc3c3c;

    transform: translateY(-2px);

    box-shadow:
        0 10px 22px rgba(252,60,60,.22);
}

.reg-submit-content {
    display: flex;
    align-items: center;
    justify-content: center;

    gap: 7px;
}

.submit-arrow {
    width: 19px;
    height: 19px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: rgba(255,255,255,.13);

    font-size: 10px;
}

/* LOGIN */

.reg-login {
    margin-top: 11px;

    text-align: center;

    color: #9299a3;

    font-size: 9.5px;
}

.reg-login a {
    color: #fc3c3c;

    text-decoration: none;

    font-weight: 700;
}

/* =========================================================
   RIGHT INFO PANEL
========================================================= */

.reg-info-panel {
    position: relative;

    padding: 42px;

    display: flex;
    flex-direction: column;
    justify-content: center;

    color: #fff;

    overflow: hidden;

    background:
        radial-gradient(
            circle at 80% 20%,
            rgba(252,60,60,.08),
            transparent 35%
        ),
        #111822;
}

.reg-info-panel::before {
    content: "";

    position: absolute;

    width: 380px;
    height: 380px;

    right: -190px;
    top: -190px;

    border: 1px solid rgba(255,255,255,.05);

    border-radius: 50%;
}

.reg-info-panel::after {
    content: "";

    position: absolute;

    width: 220px;
    height: 220px;

    right: -110px;
    top: -110px;

    border: 1px solid rgba(252,60,60,.10);

    border-radius: 50%;
}

/* LABEL */

.reg-info-label {
    position: relative;
    z-index: 2;

    width: fit-content;

    display: flex;
    align-items: center;

    gap: 7px;

    padding: 6px 11px;

    margin-bottom: 16px;

    border-radius: 50px;

    background: rgba(252,60,60,.09);

    border: 1px solid rgba(252,60,60,.17);

    color: #ff7777;

    font-size: 8px;
    font-weight: 700;

    letter-spacing: .7px;
}

.label-dot {
    width: 5px;
    height: 5px;

    border-radius: 50%;

    background: #fc3c3c;

    box-shadow:
        0 0 9px rgba(252,60,60,.7);
}

/* TITLE */

.reg-info-panel h1 {
    position: relative;
    z-index: 2;

    max-width: 490px;

    margin: 0 0 13px;

    color: #fff;

    font-size: clamp(34px, 4vw, 48px);

    line-height: 1.04;

    font-weight: 800;

    letter-spacing: -1.8px;
}

.reg-info-panel h1 span {
    color: #fc3c3c;
}

/* DESCRIPTION */

.reg-info-text {
    position: relative;
    z-index: 2;

    max-width: 460px;

    margin: 0 0 22px;

    color: rgba(255,255,255,.58);

    font-size: 11px;

    line-height: 1.7;
}

/* BENEFITS */

.reg-benefits {
    position: relative;
    z-index: 2;

    display: grid;

    grid-template-columns: repeat(2, 1fr);

    gap: 9px;

    max-width: 470px;
}

.reg-benefit {
    display: flex;
    align-items: center;

    gap: 9px;

    padding: 10px;

    border-radius: 11px;

    background: rgba(255,255,255,.035);

    border: 1px solid rgba(255,255,255,.065);

    transition: .2s ease;
}

.reg-benefit:hover {
    transform: translateY(-2px);

    background: rgba(255,255,255,.055);

    border-color: rgba(252,60,60,.18);
}

.reg-benefit-icon {
    width: 30px;
    height: 30px;

    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 8px;

    background: rgba(252,60,60,.10);

    color: #fc3c3c;

    font-size: 12px;
}

.reg-benefit strong {
    display: block;

    margin-bottom: 1px;

    color: rgba(255,255,255,.88);

    font-size: 9px;
}

.reg-benefit small {
    color: rgba(255,255,255,.38);

    font-size: 7.5px;
}

/* =========================================================
   TABLET
========================================================= */

@media (max-width: 991px) {

    .lokora-register-page {
        min-height: auto;

        padding: 35px 18px;

        overflow: visible;
    }

    .reg-main-card {
        max-width: 600px;

        grid-template-columns: 1fr;
    }

    .reg-form-panel {
        order: 1;

        padding: 30px;
    }

    .reg-info-panel {
        order: 2;

        padding: 35px;

        text-align: center;

        align-items: center;
    }

    .reg-info-label {
        margin-left: auto;
        margin-right: auto;
    }

    .reg-info-text {
        margin-left: auto;
        margin-right: auto;
    }

    .reg-benefits {
        width: 100%;
    }

    .reg-info-panel::before,
    .reg-info-panel::after {
        display: none;
    }
}

/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 575px) {

    .lokora-register-page {
        padding: 20px 12px;
    }

    .reg-main-card {
        border-radius: 20px;
    }

    .reg-form-panel {
        padding: 25px 18px;
    }

    .reg-info-panel {
        padding: 28px 20px;
    }

    .reg-info-panel h1 {
        font-size: 32px;

        letter-spacing: -1px;
    }

    .reg-benefits {
        grid-template-columns: 1fr;
    }
}

/* =========================================================
   SMALL HEIGHT DESKTOP
========================================================= */

@media (max-height: 720px) and (min-width: 992px) {

    .lokora-register-page {
        min-height: calc(100vh - 145px);

        padding: 18px 20px;
    }

    .reg-main-card {
        min-height: 455px;
    }

    .reg-form-panel {
        padding: 22px 30px;
    }

    .reg-brand {
        margin-bottom: 10px;
    }

    .reg-heading {
        margin-bottom: 11px;
    }

    .reg-field {
        margin-bottom: 6px;
    }

    .reg-input {
        height: 36px;
    }

    .reg-submit {
        height: 37px;
    }

    .reg-info-panel {
        padding: 30px 38px;
    }

    .reg-info-text {
        margin-bottom: 16px;
    }

    .reg-benefit {
        padding: 8px;
    }
}
</style>


<section class="lokora-register-page">

    <div class="reg-bg-grid"></div>

    <div class="reg-orb reg-orb-one"></div>
    <div class="reg-orb reg-orb-two"></div>


    <div class="reg-main-card">


        {{-- =================================================
             LEFT : REGISTER FORM
        ================================================== --}}

        <div class="reg-form-panel">

            <div class="reg-form">


                {{-- BRAND --}}

                <div class="reg-brand">

                    <div class="reg-brand-mark">
                        L
                    </div>

                    <div class="reg-brand-name">
                        Lokora
                    </div>

                </div>


                {{-- HEADING --}}

                <div class="reg-heading">

                    <h2>
                        Create your account
                    </h2>

                    <p>
                        Start building your business presence today.
                    </p>

                </div>


                {{-- ERRORS --}}

                @if ($errors->any())

                    <div class="reg-error-box">

                        <ul>

                            @foreach ($errors->all() as $error)

                                <li>
                                    {{ $error }}
                                </li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                {{-- FORM --}}

                <form
                    action="{{ route('register.submit') }}"
                    method="POST"
                >

                    @csrf


                    {{-- NAME --}}

                    <div class="reg-field">

                        <label for="name">
                            Full Name
                        </label>

                        <div class="reg-input-box">

                            <span class="reg-input-icon icon-user"></span>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="reg-input"
                                placeholder="Enter your full name"
                                value="{{ old('name') }}"
                                required
                                autocomplete="name"
                            >

                        </div>

                    </div>


                    {{-- EMAIL --}}

                    <div class="reg-field">

                        <label for="email">
                            Email Address
                        </label>

                        <div class="reg-input-box">

                            <span class="reg-input-icon icon-mail"></span>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="reg-input"
                                placeholder="Enter your email address"
                                value="{{ old('email') }}"
                                required
                                autocomplete="email"
                            >

                        </div>

                    </div>


                    {{-- PASSWORD --}}

                    <div class="reg-field">

                        <label for="password">
                            Password
                        </label>

                        <div class="reg-input-box">

                            <span class="reg-input-icon icon-lock"></span>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="reg-input"
                                placeholder="Create a password"
                                required
                                autocomplete="new-password"
                            >

                            <button
                                type="button"
                                class="reg-password-toggle"
                                onclick="toggleRegPassword('password', this)"
                            >
                                <span class="eye-icon">●</span>
                            </button>

                        </div>

                    </div>


                    {{-- CONFIRM PASSWORD --}}

                    <div class="reg-field">

                        <label for="password_confirmation">
                            Confirm Password
                        </label>

                        <div class="reg-input-box">

                            <span class="reg-input-icon icon-lock"></span>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="reg-input"
                                placeholder="Confirm your password"
                                required
                                autocomplete="new-password"
                            >

                            <button
                                type="button"
                                class="reg-password-toggle"
                                onclick="toggleRegPassword(
                                    'password_confirmation',
                                    this
                                )"
                            >
                                <span class="eye-icon">●</span>
                            </button>

                        </div>

                    </div>


                    {{-- TERMS --}}

                    <div class="reg-terms">

                        <input
                            type="checkbox"
                            id="terms"
                            name="terms"
                            value="1"
                            required
                        >

                        <label for="terms">

                            I agree to the
                            <a href="#">
                                Terms
                            </a>
                            and
                            <a href="#">
                                Privacy Policy
                            </a>.

                        </label>

                    </div>


                    {{-- SUBMIT --}}

                    <button
                        type="submit"
                        class="reg-submit"
                    >

                        <span class="reg-submit-content">

                            Create Account

                            <span class="submit-arrow">
                                →
                            </span>

                        </span>

                    </button>

                </form>


                {{-- LOGIN LINK --}}

                <div class="reg-login">

                    Already have an account?

                    <a href="{{ route('login') }}">
                        Sign in
                    </a>

                </div>

            </div>

        </div>


        {{-- =================================================
             RIGHT : BRANDING
        ================================================== --}}

        <div class="reg-info-panel">


            <div class="reg-info-label">

                <span class="label-dot"></span>

                WELCOME TO LOKORA

            </div>


            <h1>

                Put your business
                <span>on the map.</span>

            </h1>


            <p class="reg-info-text">

                Create your professional business presence,
                showcase your products and services, and
                help customers discover your business.

            </p>


            <div class="reg-benefits">


                {{-- BUSINESS --}}

                <div class="reg-benefit">

                    <div class="reg-benefit-icon">
                        ✓
                    </div>

                    <div>

                        <strong>
                            Business Listing
                        </strong>

                        <small>
                            Create your profile
                        </small>

                    </div>

                </div>


                {{-- PRODUCTS --}}

                <div class="reg-benefit">

                    <div class="reg-benefit-icon">
                        +
                    </div>

                    <div>

                        <strong>
                            Products
                        </strong>

                        <small>
                            Showcase products
                        </small>

                    </div>

                </div>


                {{-- SERVICES --}}

                <div class="reg-benefit">

                    <div class="reg-benefit-icon">
                        ◆
                    </div>

                    <div>

                        <strong>
                            Services
                        </strong>

                        <small>
                            Promote services
                        </small>

                    </div>

                </div>


                {{-- CUSTOMERS --}}

                <div class="reg-benefit">

                    <div class="reg-benefit-icon">
                        ↗
                    </div>

                    <div>

                        <strong>
                            Reach Customers
                        </strong>

                        <small>
                            Grow your visibility
                        </small>

                    </div>

                </div>


            </div>

        </div>

    </div>

</section>


<script>

function toggleRegPassword(inputId, button)
{
    const input = document.getElementById(inputId);
    const icon = button.querySelector('.eye-icon');

    if (input.type === 'password') {

        input.type = 'text';

        icon.style.opacity = '1';

        icon.innerHTML = '◉';

    } else {

        input.type = 'password';

        icon.style.opacity = '.45';

        icon.innerHTML = '●';

    }
}

</script>

@endsection

