<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>{{ $pageTitle ?? 'Dashboard' }} | Business Listing</title>

<link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
>

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
>

<style>

    /* =========================================================
       THEME VARIABLES
    ========================================================= */

    :root {
        --primary: #f58220;
        --primary-dark: #df6f12;
        --primary-light: #fff1e6;

        --body-bg: #f5f7fb;
        --card-bg: #ffffff;
        --header-bg: #ffffff;

        --text-main: #172033;
        --text-muted: #7d8798;

        --border: #e7ebf1;

        --sidebar-bg: #ffffff;
        --sidebar-text: #667085;
        --sidebar-hover: #f5f7fb;
        --sidebar-border: #e7ebf1;
        --sidebar-muted: #98a2b3;
        --sidebar-brand: #172033;
        --sidebar-scrollbar: #d0d5dd;

        --success: #16a34a;
        --danger: #dc2626;
        --warning: #d97706;
        --info: #2563eb;

        --header-height: 72px;
        --sidebar-width: 260px;

        --shadow-sm: 0 2px 8px rgba(16, 24, 40, 0.04);
        --shadow-md: 0 8px 24px rgba(16, 24, 40, 0.07);

        --radius: 16px;
    }


    /* =========================================================
       DARK MODE
    ========================================================= */

    body.dark-mode {
        --body-bg: #0b1120;
        --card-bg: #111827;
        --header-bg: #111827;

        --text-main: #f3f4f6;
        --text-muted: #9ca3af;

        --border: #263244;

        --sidebar-bg: #111827;
        --sidebar-text: #aeb7c7;
        --sidebar-hover: #1f2937;
        --sidebar-border: rgba(255, 255, 255, 0.07);
        --sidebar-muted: #6f7b91;
        --sidebar-brand: #ffffff;
        --sidebar-scrollbar: #374151;

        --primary-light: rgba(245, 130, 32, 0.12);

        --shadow-sm: 0 2px 10px rgba(0, 0, 0, 0.18);
        --shadow-md: 0 8px 28px rgba(0, 0, 0, 0.25);
    }


    /* =========================================================
       GLOBAL
    ========================================================= */

    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;

        font-family:
            Inter,
            -apple-system,
            BlinkMacSystemFont,
            "Segoe UI",
            sans-serif;

        background: var(--body-bg);
        color: var(--text-main);

        transition:
            background 0.25s ease,
            color 0.25s ease;
    }

    a {
        text-decoration: none;
    }


    /* =========================================================
       SIDEBAR
    ========================================================= */

    .user-sidebar {
        position: fixed;

        top: 0;
        left: 0;

        width: var(--sidebar-width);
        height: 100vh;

        background: var(--sidebar-bg);

        border-right: 1px solid var(--sidebar-border);

        z-index: 1200;

        overflow-y: auto;
        overflow-x: hidden;

        padding: 20px 15px;

        scrollbar-width: thin;
        scrollbar-color:
            var(--sidebar-scrollbar)
            transparent;

        transition:
            background 0.25s ease,
            border-color 0.25s ease,
            transform 0.3s ease;
    }

    .user-sidebar::-webkit-scrollbar {
        width: 5px;
    }

    .user-sidebar::-webkit-scrollbar-track {
        background: transparent;
    }

    .user-sidebar::-webkit-scrollbar-thumb {
        background: var(--sidebar-scrollbar);
        border-radius: 20px;
    }


    /* =========================================================
       BRAND
    ========================================================= */

    .brand {
        display: flex;
        align-items: center;
        gap: 11px;

        padding: 4px 8px 20px;

        color: var(--sidebar-brand);

        font-size: 20px;
        font-weight: 800;

        border-bottom: 1px solid var(--sidebar-border);

        margin-bottom: 20px;

        transition: 0.25s ease;
    }

    .brand:hover {
        color: var(--sidebar-brand);
    }

    .brand-icon {
        width: 40px;
        height: 40px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: var(--primary);
        color: #fff;

        border-radius: 12px;

        font-size: 20px;

        box-shadow:
            0 7px 18px rgba(245, 130, 32, 0.22);
    }

    .brand small {
        display: block;

        font-size: 10px;
        font-weight: 500;

        color: var(--sidebar-muted);

        margin-top: 1px;

        letter-spacing: 0.4px;
    }


    /* =========================================================
       SIDEBAR MENU
    ========================================================= */

    .menu-title {
        padding: 0 11px;
        margin: 22px 0 8px;

        color: var(--sidebar-muted);

        font-size: 10px;
        font-weight: 800;

        text-transform: uppercase;
        letter-spacing: 1.1px;
    }

    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-menu li {
        margin-bottom: 4px;
    }

    .sidebar-menu a {
        display: flex;
        align-items: center;
        gap: 12px;

        min-height: 45px;

        padding: 10px 12px;

        border-radius: 11px;

        color: var(--sidebar-text);

        font-size: 14px;
        font-weight: 600;

        transition:
            background 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .sidebar-menu a i {
        width: 20px;

        font-size: 17px;

        text-align: center;
    }

    .sidebar-menu a:hover {
        background: var(--sidebar-hover);
        color: var(--sidebar-brand);

        transform: translateX(2px);
    }

    .sidebar-menu a.active {
        background: var(--primary);
        color: #fff;

        box-shadow:
            0 7px 18px rgba(245, 130, 32, 0.22);
    }

    .sidebar-menu a.active:hover {
        background: var(--primary-dark);
        color: #fff;

        transform: none;
    }

    .sidebar-logout-form {
    margin: 0;
}

.sidebar-logout-btn {
    width: 100%;
    border: 0;
    background: transparent;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 14px;
    color: inherit;
    text-align: left;
    cursor: pointer;
    font: inherit;
}

.sidebar-logout-btn:hover {
    background: var(--primary-light);
    color: var(--primary);
}
    /* =========================================================
       MAIN AREA
    ========================================================= */

    .dashboard-main {
        margin-left: var(--sidebar-width);

        min-height: 100vh;

        display: flex;
        flex-direction: column;
    }


    /* =========================================================
       TOP HEADER
    ========================================================= */

    .top-header {
        position: sticky;

        top: 0;

        height: var(--header-height);

        background: var(--header-bg);

        border-bottom: 1px solid var(--border);

        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 0 28px;

        z-index: 1000;

        transition:
            background 0.25s ease,
            border-color 0.25s ease;
    }

    .header-left {
        display: flex;
        align-items: center;

        gap: 14px;
    }

    .page-title {
        margin: 0;

        font-size: 18px;
        font-weight: 750;

        color: var(--text-main);
    }

    .page-subtitle {
        margin: 2px 0 0;

        color: var(--text-muted);

        font-size: 12px;
    }


    /* =========================================================
       HEADER RIGHT
    ========================================================= */

    .header-actions {
        display: flex;
        align-items: center;

        gap: 10px;
    }

    .icon-button {
        width: 40px;
        height: 40px;

        border: 1px solid var(--border);

        border-radius: 11px;

        background: var(--card-bg);

        color: var(--text-main);

        display: flex;
        align-items: center;
        justify-content: center;

        cursor: pointer;

        transition: 0.2s ease;
    }

    .icon-button:hover {
        color: var(--primary);

        border-color: var(--primary);

        background: var(--primary-light);
    }


    /* =========================================================
       USER PROFILE
    ========================================================= */

    .user-profile {
        display: flex;
        align-items: center;

        gap: 10px;

        padding-left: 8px;
    }

    .avatar {
        width: 39px;
        height: 39px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 50%;

        background:
            linear-gradient(
                135deg,
                var(--primary),
                #ffad61
            );

        color: #fff;

        font-size: 14px;
        font-weight: 800;
    }

    .user-info strong {
        display: block;

        color: var(--text-main);

        font-size: 13px;
    }

    .user-info span {
        display: block;

        color: var(--text-muted);

        font-size: 11px;
    }


    /* =========================================================
       CONTENT
    ========================================================= */

    .dashboard-content {
        padding: 30px;

        flex: 1;
    }


    /* =========================================================
       WELCOME CARD
    ========================================================= */

    .welcome-card {
        position: relative;

        overflow: hidden;

        padding: 28px;

        border-radius: 18px;

        background:
            linear-gradient(
                135deg,
                #f58220,
                #ff9a4d
            );

        color: #fff;

        box-shadow:
            0 14px 30px rgba(245, 130, 32, 0.18);

        margin-bottom: 26px;
    }

    .welcome-card::before {
        content: "";

        position: absolute;

        width: 190px;
        height: 190px;

        border-radius: 50%;

        right: -70px;
        top: -85px;

        background: rgba(255, 255, 255, 0.10);
    }

    .welcome-card::after {
        content: "";

        position: absolute;

        width: 120px;
        height: 120px;

        border-radius: 50%;

        right: 90px;
        bottom: -75px;

        background: rgba(255, 255, 255, 0.08);
    }

    .welcome-content {
        position: relative;

        z-index: 2;
    }

    .welcome-card h2 {
        margin: 0 0 7px;

        font-size: 25px;
        font-weight: 800;
    }

    .welcome-card p {
        margin: 0;

        max-width: 650px;

        font-size: 13px;

        opacity: 0.9;
    }

    .welcome-btn {
        display: inline-flex;
        align-items: center;

        gap: 7px;

        margin-top: 18px;

        padding: 10px 17px;

        border-radius: 9px;

        background: #fff;

        color: var(--primary);

        font-size: 13px;
        font-weight: 750;

        transition: 0.2s ease;
    }

    .welcome-btn:hover {
        color: var(--primary-dark);

        transform: translateY(-2px);
    }


    /* =========================================================
       STAT CARDS
    ========================================================= */

    .stat-card {
        height: 100%;

        background: var(--card-bg);

        border: 1px solid var(--border);

        border-radius: var(--radius);

        padding: 21px;

        box-shadow: var(--shadow-sm);

        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease,
            background 0.25s ease,
            border-color 0.25s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);

        box-shadow: var(--shadow-md);
    }

    .stat-top {
        display: flex;
        align-items: center;
        justify-content: space-between;

        margin-bottom: 17px;
    }

    .stat-icon {
        width: 45px;
        height: 45px;

        border-radius: 12px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 19px;
    }

    .icon-orange {
        background: var(--primary-light);
        color: var(--primary);
    }

    .icon-green {
        background: rgba(22, 163, 74, 0.10);
        color: var(--success);
    }

    .icon-blue {
        background: rgba(37, 99, 235, 0.10);
        color: var(--info);
    }

    .icon-red {
        background: rgba(220, 38, 38, 0.10);
        color: var(--danger);
    }

    .stat-label {
        color: var(--text-muted);

        font-size: 12px;
        font-weight: 600;
    }

    .stat-number {
        margin: 0;

        color: var(--text-main);

        font-size: 28px;
        font-weight: 800;
    }

    .stat-change {
        margin-top: 6px;

        color: var(--text-muted);

        font-size: 11px;
    }


    /* =========================================================
       SECTION HEADER
    ========================================================= */

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;

        margin: 32px 0 15px;
    }

    .section-header h4 {
        margin: 0;

        color: var(--text-main);

        font-size: 16px;
        font-weight: 800;
    }

    .section-header a {
        color: var(--primary);

        font-size: 12px;
        font-weight: 700;
    }


    /* =========================================================
       CONTENT CARD
    ========================================================= */

    .content-card {
        background: var(--card-bg);

        border: 1px solid var(--border);

        border-radius: var(--radius);

        box-shadow: var(--shadow-sm);

        overflow: hidden;

        transition:
            background 0.25s ease,
            border-color 0.25s ease;
    }


    /* =========================================================
       TABLE
    ========================================================= */

    .custom-table {
        width: 100%;

        margin: 0;

        color: var(--text-main);
    }

    .custom-table thead th {
        padding: 15px 18px;

        background: var(--sidebar-hover);

        border-bottom: 1px solid var(--border);

        color: var(--text-muted);

        font-size: 10px;
        font-weight: 800;

        text-transform: uppercase;

        letter-spacing: 0.5px;
    }

    .custom-table tbody td {
        padding: 17px 18px;

        border-bottom: 1px solid var(--border);

        color: var(--text-main);

        font-size: 13px;

        vertical-align: middle;
    }

    .custom-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .business-name {
        font-weight: 700;
    }

    .business-location {
        color: var(--text-muted);

        font-size: 11px;
    }


    /* =========================================================
       STATUS
    ========================================================= */

    .status {
        display: inline-flex;
        align-items: center;

        gap: 5px;

        padding: 5px 9px;

        border-radius: 30px;

        font-size: 10px;
        font-weight: 750;
    }

    .status-approved {
        background: rgba(22, 163, 74, 0.10);

        color: var(--success);
    }

    .status-pending {
        background: rgba(217, 119, 6, 0.10);

        color: var(--warning);
    }

    .status-rejected {
        background: rgba(220, 38, 38, 0.10);

        color: var(--danger);
    }


    /* =========================================================
       QUICK ACTIONS
    ========================================================= */

    .quick-action {
        display: flex;
        align-items: center;

        gap: 13px;

        padding: 15px;

        border: 1px solid var(--border);

        border-radius: 13px;

        background: var(--card-bg);

        color: var(--text-main);

        transition: 0.2s ease;
    }

    .quick-action:hover {
        border-color: var(--primary);

        background: var(--primary-light);

        color: var(--primary);

        transform: translateY(-2px);
    }

    .quick-icon {
        width: 40px;
        height: 40px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;

        background: var(--primary-light);

        color: var(--primary);

        font-size: 17px;
    }

    .quick-action strong {
        display: block;

        font-size: 13px;
    }

    .quick-action span {
        display: block;

        margin-top: 2px;

        color: var(--text-muted);

        font-size: 10px;
    }


    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .empty-state {
        padding: 38px 20px;

        text-align: center;

        color: var(--text-muted);
    }

    .empty-state i {
        font-size: 35px;

        color: var(--primary);

        opacity: 0.65;
    }

    .empty-state h6 {
        margin: 12px 0 5px;

        color: var(--text-main);

        font-size: 14px;
        font-weight: 750;
    }

    .empty-state p {
        margin: 0;

        font-size: 12px;
    }


    /* =========================================================
       FOOTER
    ========================================================= */

    .dashboard-footer {
        margin-top: 40px;

        padding: 20px 30px;

        border-top: 1px solid var(--border);

        color: var(--text-muted);

        font-size: 11px;

        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .dashboard-footer strong {
        color: var(--text-main);
    }


    /* =========================================================
       MOBILE SIDEBAR
    ========================================================= */

    .mobile-menu-btn {
        display: none;
    }

    .sidebar-overlay {
        display: none;

        position: fixed;

        inset: 0;

        background: rgba(0, 0, 0, 0.45);

        z-index: 1150;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 991px) {

        .user-sidebar {
            transform: translateX(-100%);
        }

        .user-sidebar.show {
            transform: translateX(0);
        }

        .sidebar-overlay.show {
            display: block;
        }

        .dashboard-main {
            margin-left: 0;
        }

        .mobile-menu-btn {
            display: flex;
        }

        .top-header {
            padding: 0 18px;
        }

        .dashboard-content {
            padding: 22px 18px;
        }

        .user-info {
            display: none;
        }

    }


    @media (max-width: 575px) {

        .top-header {
            height: 65px;
        }

        .page-subtitle {
            display: none;
        }

        .header-actions {
            gap: 5px;
        }

        .icon-button {
            width: 37px;
            height: 37px;
        }

        .avatar {
            width: 36px;
            height: 36px;
        }

        .dashboard-content {
            padding: 18px 14px;
        }

        .welcome-card {
            padding: 22px;
        }

        .welcome-card h2 {
            font-size: 21px;
        }

        .stat-number {
            font-size: 24px;
        }

        .dashboard-footer {
            padding: 18px;

            flex-direction: column;

            gap: 5px;

            text-align: center;
        }

        .custom-table {
            min-width: 650px;
        }

        .table-wrapper {
            overflow-x: auto;
        }

    }

</style>

</head>

<body>


<!-- =========================================================
     SIDEBAR OVERLAY
========================================================== -->

<div
    class="sidebar-overlay"
    id="sidebarOverlay"
></div>


<!-- =========================================================
     SIDEBAR
========================================================== -->

<aside
    class="user-sidebar"
    id="userSidebar"
>

    {{-- BRAND --}}
    <a
        href="{{ route('user.dashboard') }}"
        class="brand"
    >

        <div class="brand-icon">
            <i class="bi bi-buildings-fill"></i>
        </div>

        <div>
            Business Listing
            <small>User Panel</small>
        </div>

    </a>


    {{-- MAIN MENU --}}
    <div class="menu-title">
        Main Menu
    </div>

    <ul class="sidebar-menu">

        <li>
            <a
                href="{{ route('user.dashboard') }}"
                class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
            >
                <i class="bi bi-grid-1x2-fill"></i>

                <span>
                    Dashboard
                </span>
            </a>
        </li>

    </ul>

{{-- EXPLORE --}}
<div class="menu-title">
    Explore
</div>

<ul class="sidebar-menu">

    <li>
        <a
            href="{{ route('categories.index') }}"
            class="{{ request()->routeIs('categories.*') ? 'active' : '' }}"
        >
            <i class="bi bi-grid"></i>

            <span>
                Categories
            </span>
        </a>
    </li>
    {{-- <li>
        <a href="{{ route('listings.index') }}"
           class="{{ request()->routeIs('listings.*') ? 'active' : '' }}">
            <i class="bi bi-geo-alt"></i>
            <span>Locations</span>
        </a>
    </li> --}}

    <li>
        <a
            href="{{ route('businesses.index') }}"
            class="{{ request()->routeIs('businesses.*') ? 'active' : '' }}"
        >
            <i class="bi bi-search"></i>

            <span>
                Browse Listings
            </span>
        </a>
    </li>

</ul>
    {{-- MY BUSINESSES --}}
    <div class="menu-title">
        My Businesses
    </div>

    <ul class="sidebar-menu">

        <li>
            <a
                href="{{ route('user.businesses.index') }}"
                class="{{ request()->routeIs('user.businesses.index') ? 'active' : '' }}"
            >
                <i class="bi bi-buildings"></i>

                <span>
                    All Businesses
                </span>
            </a>
        </li>


        <li>
            <a
                href="{{ route('user.businesses.create') }}"
                class="{{ request()->routeIs('user.businesses.create') ? 'active' : '' }}"
            >
                <i class="bi bi-plus-circle"></i>

                <span>
                    Add Business
                </span>
            </a>
        </li>

    </ul>


    {{-- ENGAGEMENT --}}
    <div class="menu-title">
        Engagement
    </div>

    <ul class="sidebar-menu">

        <li>
            <a
                href="{{ route('user.notifications.index') }}"
                class="{{ request()->routeIs('user.notifications.*') ? 'active' : '' }}"
            >
                <i class="bi bi-bell"></i>

                <span>
                    Notifications
                </span>

                @if(isset($unreadNotifications) && $unreadNotifications > 0)

                    <span class="sidebar-badge">
                        {{ $unreadNotifications > 99 ? '99+' : $unreadNotifications }}
                    </span>

                @endif

            </a>
        </li>

    </ul>


    {{-- ACCOUNT --}}
    <div class="menu-title">
        Account
    </div>

    <ul class="sidebar-menu">

        <li>
            <a
                href="{{ route('user.profile') }}"
                class="{{ request()->routeIs('user.profile') ? 'active' : '' }}"
            >
                <i class="bi bi-person-circle"></i>

                <span>
                    My Profile
                </span>
            </a>
        </li>


        <li>

            <form
                method="POST"
                action="{{ route('logout') }}"
                class="sidebar-logout-form"
            >

                @csrf

                <button
                    type="submit"
                    class="sidebar-logout-btn"
                >

                    <i class="bi bi-box-arrow-right"></i>

                    <span>
                        Logout
                    </span>

                </button>

            </form>

        </li>

    </ul>

</aside>


<!-- =========================================================
     MAIN
========================================================== -->

<main class="dashboard-main">


    <!-- =====================================================
         HEADER
    ====================================================== -->

    <header class="top-header">

        <div class="header-left">

            <button
                type="button"
                class="icon-button mobile-menu-btn"
                id="mobileMenuBtn"
            >

                <i class="bi bi-list"></i>

            </button>


            <div>

                <h1 class="page-title">
                    {{ $pageTitle ?? 'Dashboard' }}
                </h1>

                <p class="page-subtitle">
                    {{ $pageSubtitle ?? 'Manage your business presence' }}
                </p>

            </div>

        </div>


        <div class="header-actions">


            <!-- THEME -->

            <button
                type="button"
                class="icon-button"
                id="themeToggle"
                title="Toggle Theme"
            >

                <i
                    class="bi bi-moon-stars-fill"
                    id="themeIcon"
                ></i>

            </button>


            <!-- NOTIFICATION -->

<a
    href="{{ route('user.notifications.index') }}"
    class="icon-button position-relative"
    title="Notifications"
>

    <i class="bi bi-bell"></i>

    @auth
        @php
            $unreadNotifications = auth()->user()
                ->notifications()
                ->where('is_read', false)
                ->count();
        @endphp

        @if($unreadNotifications > 0)
            <span
                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                style="font-size: 9px;"
            >
                {{ $unreadNotifications > 99 ? '99+' : $unreadNotifications }}
            </span>
        @endif
    @endauth

</a>

<!-- USER PROFILE -->

<div class="dropdown">

    <button
        type="button"
        class="user-profile border-0 bg-transparent"
        data-bs-toggle="dropdown"
        aria-expanded="false"
    >

        <div class="avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <div class="user-info">

            <strong>
                {{ auth()->user()->name }}
            </strong>

            <span>
                {{ ucfirst(auth()->user()->role) }}
            </span>

        </div>

        <i class="bi bi-chevron-down ms-1"></i>

    </button>


    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">

        <li class="px-3 py-2">

            <div class="fw-semibold">
                {{ auth()->user()->name }}
            </div>

            <small class="text-muted">
                {{ auth()->user()->email }}
            </small>

        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li>
            <a
                class="dropdown-item py-2"
                href="{{ route('user.dashboard') }}"
            >
                <i class="bi bi-grid me-2"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a
    class="dropdown-item py-2"
    href="{{ route('user.profile') }}"
>
                <i class="bi bi-person me-2"></i>
                My Profile
            </a>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li>

            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="dropdown-item text-danger py-2"
                >
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </button>

            </form>

        </li>

    </ul>

</div>
        </div>

    </header>


    <!-- =====================================================
         PAGE CONTENT
    ====================================================== -->

    <section class="dashboard-content">
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mx-4 mt-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mx-4 mt-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"></button>
        </div>
    @endif

    @yield('content')


    </section>


    <!-- =====================================================
         FOOTER
    ====================================================== -->

    <footer class="dashboard-footer">

        <div>

            © {{ date('Y') }}

            <strong>
                Business Listing
            </strong>.

            All rights reserved.

        </div>

        <div>
            User Dashboard
        </div>

    </footer>


</main>


<!-- =========================================================
     JAVASCRIPT
========================================================== -->

<script>

    /* =====================================================
       THEME
    ====================================================== */

    const themeToggle =
        document.getElementById('themeToggle');

    const themeIcon =
        document.getElementById('themeIcon');


    function updateThemeIcon() {

        if (
            document.body.classList.contains('dark-mode')
        ) {

            themeIcon.className =
                'bi bi-sun-fill';

        } else {

            themeIcon.className =
                'bi bi-moon-stars-fill';

        }

    }


    const savedTheme =
        localStorage.getItem('dashboardTheme');


    if (savedTheme === 'dark') {

        document.body.classList.add('dark-mode');

    }


    updateThemeIcon();


    themeToggle.addEventListener(
        'click',
        function () {

            document.body.classList.toggle(
                'dark-mode'
            );


            const isDark =
                document.body.classList.contains(
                    'dark-mode'
                );


            localStorage.setItem(
                'dashboardTheme',
                isDark ? 'dark' : 'light'
            );


            updateThemeIcon();

        }
    );


    /* =====================================================
       MOBILE SIDEBAR
    ====================================================== */

    const sidebar =
        document.getElementById('userSidebar');

    const mobileMenuBtn =
        document.getElementById('mobileMenuBtn');

    const sidebarOverlay =
        document.getElementById('sidebarOverlay');


    function closeSidebar() {

        sidebar.classList.remove('show');

        sidebarOverlay.classList.remove('show');

    }


    mobileMenuBtn.addEventListener(
        'click',
        function () {

            sidebar.classList.add('show');

            sidebarOverlay.classList.add('show');

        }
    );


    sidebarOverlay.addEventListener(
        'click',
        closeSidebar
    );


    /* =====================================================
       CLOSE SIDEBAR ON MOBILE MENU CLICK
    ====================================================== */

    document
        .querySelectorAll('.sidebar-menu a')
        .forEach(function (link) {

            link.addEventListener(
                'click',
                function () {

                    if (window.innerWidth <= 991) {

                        closeSidebar();

                    }

                }
            );

        });

</script>

@stack('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
