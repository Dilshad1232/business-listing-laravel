@extends('layouts.user.master')

@section('content')

@php
    $initials = collect(explode(' ', trim($user->name)))
        ->filter()
        ->map(fn($word) => strtoupper(substr($word, 0, 1)))
        ->take(2)
        ->implode('');

    $memberSince = $user->created_at
        ? $user->created_at->format('d M Y')
        : 'N/A';
@endphp


<style>
    /* =========================================================
       PROFILE PAGE
    ========================================================= */

    .profile-page {
        max-width: 1200px;
        margin: 0 auto;
    }

    .profile-hero {
        position: relative;
        overflow: hidden;
        padding: 30px;
        margin-bottom: 24px;

        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 20px;

        box-shadow:
            0 12px 30px rgba(16, 24, 40, 0.07),
            0 3px 8px rgba(16, 24, 40, 0.04);

        transition:
            background 0.25s ease,
            border-color 0.25s ease,
            box-shadow 0.25s ease;
    }

    body.dark-mode .profile-hero {
        box-shadow:
            0 14px 35px rgba(0, 0, 0, 0.28),
            inset 0 1px 0 rgba(255, 255, 255, 0.03);
    }

    .profile-hero::before {
        content: "";
        position: absolute;

        width: 180px;
        height: 180px;

        right: -55px;
        top: -80px;

        border-radius: 50%;

        background: var(--primary-light);
    }

    .profile-hero::after {
        content: "";
        position: absolute;

        width: 100px;
        height: 100px;

        right: 100px;
        bottom: -65px;

        border-radius: 50%;

        background: var(--primary-light);
    }

    .profile-hero-content {
        position: relative;
        z-index: 2;

        display: flex;
        align-items: center;
        gap: 22px;
    }


    /* =========================================================
       3D AVATAR
    ========================================================= */

    .profile-avatar-wrap {
        position: relative;
        flex-shrink: 0;
    }

    .profile-avatar {
        width: 92px;
        height: 92px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 24px;

        background:
            linear-gradient(
                145deg,
                var(--primary),
                #ffad61
            );

        color: #fff;

        font-size: 29px;
        font-weight: 800;

        box-shadow:
            0 14px 0 rgba(223, 111, 18, 0.12),
            0 20px 28px rgba(245, 130, 32, 0.22);

        transform: perspective(600px) rotateX(2deg) rotateY(-3deg);

        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease;
    }

    .profile-avatar-wrap:hover .profile-avatar {
        transform:
            perspective(600px)
            rotateX(0)
            rotateY(0)
            translateY(-4px);

        box-shadow:
            0 18px 0 rgba(223, 111, 18, 0.12),
            0 26px 35px rgba(245, 130, 32, 0.25);
    }

    .profile-status {
        position: absolute;

        right: -5px;
        bottom: -5px;

        width: 25px;
        height: 25px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background: var(--card-bg);

        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }

    .profile-status span {
        width: 11px;
        height: 11px;

        border-radius: 50%;

        background: var(--success);
    }


    /* =========================================================
       HERO TEXT
    ========================================================= */

    .profile-hero-text h2 {
        margin: 0 0 5px;

        color: var(--text-main);

        font-size: 24px;
        font-weight: 800;
    }

    .profile-hero-text p {
        margin: 0 0 10px;

        color: var(--text-muted);

        font-size: 13px;
    }

    .profile-role {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        padding: 6px 11px;

        border-radius: 30px;

        background: var(--primary-light);
        color: var(--primary);

        font-size: 11px;
        font-weight: 750;
    }


    /* =========================================================
       3D CARDS
    ========================================================= */

    .profile-card {
        height: 100%;

        background: var(--card-bg);

        border: 1px solid var(--border);

        border-radius: var(--radius);

        box-shadow:
            0 8px 22px rgba(16, 24, 40, 0.055),
            0 2px 5px rgba(16, 24, 40, 0.035);

        overflow: hidden;

        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease,
            background 0.25s ease,
            border-color 0.25s ease;
    }

    .profile-card:hover {
        transform: translateY(-3px);

        box-shadow:
            0 16px 32px rgba(16, 24, 40, 0.09),
            0 3px 8px rgba(16, 24, 40, 0.04);
    }

    body.dark-mode .profile-card {
        box-shadow:
            0 12px 28px rgba(0, 0, 0, 0.24),
            inset 0 1px 0 rgba(255, 255, 255, 0.025);
    }

    .profile-card-header {
        display: flex;
        align-items: center;
        gap: 12px;

        padding: 20px 22px;

        border-bottom: 1px solid var(--border);
    }

    .profile-card-icon {
        width: 40px;
        height: 40px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 11px;

        background: var(--primary-light);
        color: var(--primary);

        font-size: 17px;
    }

    .profile-card-header h5 {
        margin: 0;

        color: var(--text-main);

        font-size: 15px;
        font-weight: 800;
    }

    .profile-card-header p {
        margin: 2px 0 0;

        color: var(--text-muted);

        font-size: 10px;
    }

    .profile-card-body {
        padding: 22px;
    }


    /* =========================================================
       FORM
    ========================================================= */

    .profile-label {
        display: block;

        margin-bottom: 7px;

        color: var(--text-main);

        font-size: 12px;
        font-weight: 700;
    }

    .profile-input {
        width: 100%;

        min-height: 45px;

        padding: 10px 13px;

        background: var(--body-bg);

        border: 1px solid var(--border);

        border-radius: 10px;

        color: var(--text-main);

        font-size: 13px;

        outline: none;

        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease,
            background 0.25s ease;
    }

    .profile-input::placeholder {
        color: var(--text-muted);
    }

    .profile-input:focus {
        border-color: var(--primary);

        box-shadow:
            0 0 0 3px rgba(245, 130, 32, 0.10);
    }

    .profile-input:disabled {
        opacity: 0.75;
        cursor: not-allowed;
    }

    .profile-help {
        margin-top: 6px;

        color: var(--text-muted);

        font-size: 10px;
    }


    /* =========================================================
       INFO ITEMS
    ========================================================= */

    .profile-info-list {
        display: flex;
        flex-direction: column;
        gap: 13px;
    }

    .profile-info-item {
        display: flex;
        align-items: center;
        gap: 12px;

        padding: 13px;

        background: var(--body-bg);

        border: 1px solid var(--border);

        border-radius: 12px;

        transition:
            transform 0.2s ease,
            border-color 0.2s ease;
    }

    .profile-info-item:hover {
        transform: translateX(3px);
        border-color: var(--primary);
    }

    .profile-info-icon {
        width: 38px;
        height: 38px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: var(--primary-light);
        color: var(--primary);

        font-size: 16px;
    }

    .profile-info-item small {
        display: block;

        margin-bottom: 2px;

        color: var(--text-muted);

        font-size: 10px;
    }

    .profile-info-item strong {
        display: block;

        color: var(--text-main);

        font-size: 12px;

        word-break: break-word;
    }


    /* =========================================================
       SECURITY BOX
    ========================================================= */

    .security-note {
        display: flex;
        align-items: flex-start;
        gap: 10px;

        margin-bottom: 18px;

        padding: 12px 14px;

        background: var(--primary-light);

        border: 1px solid rgba(245, 130, 32, 0.12);

        border-radius: 11px;

        color: var(--text-muted);

        font-size: 11px;
        line-height: 1.5;
    }

    .security-note i {
        color: var(--primary);

        font-size: 15px;

        margin-top: 1px;
    }


    /* =========================================================
       BUTTON
    ========================================================= */

    .profile-save-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        min-height: 43px;

        padding: 10px 18px;

        border: 0;
        border-radius: 10px;

        background: var(--primary);

        color: #fff;

        font-size: 12px;
        font-weight: 750;

        box-shadow:
            0 7px 16px rgba(245, 130, 32, 0.20);

        transition:
            transform 0.2s ease,
            background 0.2s ease,
            box-shadow 0.2s ease;
    }

    .profile-save-btn:hover {
        background: var(--primary-dark);

        color: #fff;

        transform: translateY(-2px);

        box-shadow:
            0 10px 22px rgba(245, 130, 32, 0.25);
    }


    /* =========================================================
       ERROR
    ========================================================= */

    .profile-error {
        margin-top: 6px;

        color: var(--danger);

        font-size: 10px;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 767px) {

        .profile-hero {
            padding: 22px;
        }

        .profile-hero-content {
            align-items: flex-start;
        }

        .profile-avatar {
            width: 76px;
            height: 76px;

            border-radius: 20px;

            font-size: 24px;
        }

        .profile-hero-text h2 {
            font-size: 20px;
        }

        .profile-card-body {
            padding: 18px;
        }

    }

    @media (max-width: 480px) {

        .profile-hero-content {
            flex-direction: column;
        }

        .profile-avatar {
            width: 72px;
            height: 72px;
        }

        .profile-save-btn {
            width: 100%;
        }

    }
</style>


<div class="profile-page">

    <!-- =====================================================
         PROFILE HERO
    ====================================================== -->

    <div class="profile-hero">

        <div class="profile-hero-content">

            <div class="profile-avatar-wrap">

                <div class="profile-avatar">
                    {{ $initials ?: 'U' }}
                </div>

                <div class="profile-status">
                    <span></span>
                </div>

            </div>


            <div class="profile-hero-text">

                <h2>
                    {{ $user->name }}
                </h2>

                <p>
                    Manage your account information and security settings.
                </p>

                <span class="profile-role">
                    <i class="bi bi-shield-check"></i>
                    {{ ucfirst($user->role ?? 'User') }}
                </span>

            </div>

        </div>

    </div>


    <!-- =====================================================
         MAIN GRID
    ====================================================== -->

    <div class="row g-4">

        <!-- =================================================
             PERSONAL INFORMATION
        ================================================== -->

        <div class="col-lg-8">

            <div class="profile-card">

                <div class="profile-card-header">

                    <div class="profile-card-icon">
                        <i class="bi bi-person-vcard"></i>
                    </div>

                    <div>

                        <h5>
                            Personal Information
                        </h5>

                        <p>
                            Update your basic account details
                        </p>

                    </div>

                </div>


                <div class="profile-card-body">

                    <form
                        method="POST"
                        action="{{ route('user.profile.update') }}"
                    >

                        @csrf
                        @method('PUT')


                        <div class="row g-3">

                            <!-- NAME -->

                            <div class="col-md-6">

                                <label
                                    for="name"
                                    class="profile-label"
                                >
                                    Full Name
                                </label>

                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="profile-input"
                                    value="{{ old('name', $user->name) }}"
                                    placeholder="Enter your name"
                                    required
                                >

                                @error('name')
                                    <div class="profile-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <!-- EMAIL -->

                            <div class="col-md-6">

                                <label
                                    for="email"
                                    class="profile-label"
                                >
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="profile-input"
                                    value="{{ old('email', $user->email) }}"
                                    placeholder="Enter your email"
                                    required
                                >

                                @error('email')
                                    <div class="profile-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            <!-- ROLE -->

                            <div class="col-md-6">

                                <label class="profile-label">
                                    Account Role
                                </label>

                                <input
                                    type="text"
                                    class="profile-input"
                                    value="{{ ucfirst($user->role ?? 'User') }}"
                                    disabled
                                >

                                <div class="profile-help">
                                    Your account role cannot be changed here.
                                </div>

                            </div>


                            <!-- MEMBER SINCE -->

                            <div class="col-md-6">

                                <label class="profile-label">
                                    Member Since
                                </label>

                                <input
                                    type="text"
                                    class="profile-input"
                                    value="{{ $memberSince }}"
                                    disabled
                                >

                            </div>

                        </div>


                        <div class="mt-4">

                            <button
                                type="submit"
                                class="profile-save-btn"
                            >
                                <i class="bi bi-check2-circle"></i>
                                Save Changes
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>


        <!-- =================================================
             ACCOUNT OVERVIEW
        ================================================== -->

        <div class="col-lg-4">

            <div class="profile-card">

                <div class="profile-card-header">

                    <div class="profile-card-icon">
                        <i class="bi bi-person-check"></i>
                    </div>

                    <div>

                        <h5>
                            Account Overview
                        </h5>

                        <p>
                            Your account information
                        </p>

                    </div>

                </div>


                <div class="profile-card-body">

                    <div class="profile-info-list">

                        <div class="profile-info-item">

                            <div class="profile-info-icon">
                                <i class="bi bi-person"></i>
                            </div>

                            <div>
                                <small>Name</small>
                                <strong>
                                    {{ $user->name }}
                                </strong>
                            </div>

                        </div>


                        <div class="profile-info-item">

                            <div class="profile-info-icon">
                                <i class="bi bi-envelope"></i>
                            </div>

                            <div>
                                <small>Email</small>
                                <strong>
                                    {{ $user->email }}
                                </strong>
                            </div>

                        </div>


                        <div class="profile-info-item">

                            <div class="profile-info-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>

                            <div>
                                <small>Role</small>
                                <strong>
                                    {{ ucfirst($user->role ?? 'User') }}
                                </strong>
                            </div>

                        </div>


                        <div class="profile-info-item">

                            <div class="profile-info-icon">
                                <i class="bi bi-calendar3"></i>
                            </div>

                            <div>
                                <small>Member Since</small>
                                <strong>
                                    {{ $memberSince }}
                                </strong>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- =================================================
             SECURITY
        ================================================== -->

        <div class="col-12">

            <div class="profile-card">

                <div class="profile-card-header">

                    <div class="profile-card-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>

                    <div>

                        <h5>
                            Security
                        </h5>

                        <p>
                            Change your account password
                        </p>

                    </div>

                </div>


                <div class="profile-card-body">

                    <div class="security-note">

                        <i class="bi bi-info-circle-fill"></i>

                        <span>
                            Use a strong password with at least 8 characters.
                            Your password should be unique and difficult to guess.
                        </span>

                    </div>


                    <div class="row g-3">

                        <!-- CURRENT PASSWORD -->

                        <div class="col-lg-4 col-md-6">

                            <label
                                for="current_password"
                                class="profile-label"
                            >
                                Current Password
                            </label>

                            <input
                                type="password"
                                id="current_password"
                                name="current_password"
                                class="profile-input"
                                form="securityForm"
                                placeholder="Current password"
                            >

                            @error('current_password')
                                <div class="profile-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- NEW PASSWORD -->

                        <div class="col-lg-4 col-md-6">

                            <label
                                for="password"
                                class="profile-label"
                            >
                                New Password
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="profile-input"
                                form="securityForm"
                                placeholder="New password"
                            >

                            @error('password')
                                <div class="profile-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <!-- CONFIRM PASSWORD -->

                        <div class="col-lg-4 col-md-6">

                            <label
                                for="password_confirmation"
                                class="profile-label"
                            >
                                Confirm New Password
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="profile-input"
                                form="securityForm"
                                placeholder="Confirm password"
                            >

                        </div>

                    </div>


                    <div class="mt-4">

                        <form
                            id="securityForm"
                            method="POST"
                            action="{{ route('user.profile.update') }}"
                        >

                            @csrf
                            @method('PUT')

                            <input
                                type="hidden"
                                name="name"
                                value="{{ $user->name }}"
                            >

                            <input
                                type="hidden"
                                name="email"
                                value="{{ $user->email }}"
                            >

                            <button
                                type="submit"
                                class="profile-save-btn"
                            >
                                <i class="bi bi-key"></i>
                                Update Password
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
