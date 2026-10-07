<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BizDirectory Admin Dashboard</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <style>

        :root {
            --bd-primary: #4f46e5;
            --bd-primary-hover: #4338ca;

            /* LIGHT SIDEBAR */
            --bd-sidebar: #ffffff;
            --bd-sidebar-hover: #f3f4f6;
            --bd-sidebar-text: #4b5563;
            --bd-sidebar-muted: #9ca3af;
            --bd-sidebar-border: #e5e7eb;

            --bd-bg: #f5f7fb;
            --bd-card: #ffffff;
            --bd-text: #111827;
            --bd-muted: #6b7280;
            --bd-border: #e5e7eb;

            --bd-success: #16a34a;
            --bd-warning: #f59e0b;
            --bd-danger: #dc2626;
            --bd-info: #0284c7;
        }


        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;
            font-family: "Inter", sans-serif;
            background: var(--bd-bg);
            color: var(--bd-text);
            transition: background-color .3s ease, color .3s ease;
        }


        /* =========================
           SIDEBAR
        ========================= */

        .bd-sidebar {
            position: fixed;
            left: 0;
            top: 0;

            width: 260px;
            height: 100vh;

            background: var(--bd-sidebar);
            color: var(--bd-sidebar-text);

            padding: 22px 14px;

            z-index: 1000;
            overflow-y: auto;

            border-right: 1px solid var(--bd-sidebar-border);

            transition:
                background-color .3s ease,
                color .3s ease,
                border-color .3s ease,
                transform .3s ease;
        }


        /* Sidebar scrollbar */

        .bd-sidebar::-webkit-scrollbar {
            width: 5px;
        }


        .bd-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }


        .bd-sidebar::-webkit-scrollbar-thumb {
            background: var(--bd-sidebar-border);
            border-radius: 10px;
        }


        /* =========================
           BRAND
        ========================= */

        .bd-brand {
            display: flex;
            align-items: center;
            gap: 12px;

            padding: 4px 12px 25px;
            margin-bottom: 10px;
        }


        .bd-brand-icon {
            width: 42px;
            height: 42px;

            border-radius: 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(
                135deg,
                #6366f1,
                #4f46e5
            );

            color: #fff;
            font-size: 21px;

            box-shadow: 0 7px 18px rgba(79,70,229,.20);
        }


        .bd-brand-name {
            color: var(--bd-text);

            font-size: 18px;
            font-weight: 800;

            letter-spacing: -.4px;
        }


        .bd-brand-sub {
            display: block;

            color: var(--bd-sidebar-muted);

            font-size: 10px;

            margin-top: 2px;

            letter-spacing: .8px;
            text-transform: uppercase;
        }


        /* =========================
           MENU TITLE
        ========================= */

        .bd-menu-title {
            color: var(--bd-sidebar-muted);

            font-size: 10px;
            font-weight: 700;

            text-transform: uppercase;
            letter-spacing: 1px;

            padding: 14px 12px 8px;
        }


        /* =========================
           NAVIGATION
        ========================= */

        .bd-nav {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }


        .bd-nav a {
            color: var(--bd-sidebar-text);

            text-decoration: none;

            display: flex;
            align-items: center;

            gap: 12px;

            padding: 11px 13px;

            border-radius: 10px;

            font-size: 13px;
            font-weight: 500;

            transition:
                background-color .2s ease,
                color .2s ease,
                transform .2s ease;
        }


        .bd-nav a i {
            font-size: 17px;

            width: 21px;

            text-align: center;
        }


        .bd-nav a:hover {
            color: var(--bd-text);
            background: var(--bd-sidebar-hover);
        }


        .bd-nav a.active {
            color: #fff;

            background: var(--bd-primary);

            box-shadow:
                0 7px 18px rgba(79,70,229,.25);
        }


        /* =========================
           SIDEBAR BOTTOM
        ========================= */

        .bd-sidebar-bottom {
            margin-top: 25px;

            padding-top: 18px;

            border-top: 1px solid var(--bd-sidebar-border);
        }


        .bd-admin-mini {
            display: flex;
            align-items: center;

            gap: 10px;

            padding: 8px;
        }


        .bd-avatar {
            width: 38px;
            height: 38px;

            min-width: 38px;
            min-height: 38px;

            border-radius: 50%;

            background: linear-gradient(
                135deg,
                #818cf8,
                #4f46e5
            );

            display: flex;
            align-items: center;
            justify-content: center;

            color: #fff;

            font-size: 13px;
            font-weight: 700;

            flex-shrink: 0;

            overflow: hidden;
        }
        .bd-avatar-img {
    width: 38px;
    height: 38px;

    border-radius: 50%;

    object-fit: cover;

    display: block;

    flex-shrink: 0;
}

        /* PROFILE IMAGE FIX */

        .bd-avatar-image {
            width: 38px;
            height: 38px;

            min-width: 38px;
            min-height: 38px;

            object-fit: cover;

            border-radius: 50%;

            display: block;

            flex-shrink: 0;
        }


        .bd-admin-name {
            color: var(--bd-text);

            font-size: 12px;
            font-weight: 600;

            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }


        .bd-admin-role {
            color: var(--bd-sidebar-muted);

            font-size: 10px;

            margin-top: 2px;
        }


        .bd-admin-info {
            min-width: 0;
        }


        /* =========================
           MAIN
        ========================= */

        .bd-main {
            margin-left: 260px;
            min-height: 100vh;
        }


        /* =========================
           TOPBAR
        ========================= */

   /* =========================
   TOPBAR
========================= */

.bd-topbar {
    height: 76px;

    background: var(--bd-card);

    border-bottom: 1px solid var(--bd-border);

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 0 30px;

    position: sticky;
    top: 0;

    /* Sidebar ke 260px ke baad start hoga */
    margin-left: 260px;
    width: calc(100% - 260px);

    z-index: 900;

    transition:
        background-color .3s ease,
        border-color .3s ease,
        margin-left .3s ease,
        width .3s ease;
}


        .bd-search {
            width: 330px;
            position: relative;
        }


        .bd-search i {
            position: absolute;

            left: 14px;
            top: 50%;

            transform: translateY(-50%);

            color: var(--bd-muted);
        }


        .bd-search input {
            width: 100%;
            height: 42px;

            border: 1px solid var(--bd-border);

            border-radius: 10px;

            outline: none;

            padding: 0 15px 0 42px;

            font-size: 13px;

            background: var(--bd-bg);
            color: var(--bd-text);

            transition: .2s ease;
        }


        .bd-search input:focus {
            border-color: var(--bd-primary);

            box-shadow:
                0 0 0 3px rgba(79,70,229,.08);
        }


        .bd-top-actions {
            display: flex;
            align-items: center;

            gap: 10px;
        }


        .bd-icon-btn {
            width: 40px;
            height: 40px;

            border: 1px solid var(--bd-border);

            background: var(--bd-card);

            color: var(--bd-muted);

            border-radius: 10px;

            display: flex;
            align-items: center;
            justify-content: center;

            cursor: pointer;

            transition: .2s;

            position: relative;
        }


        .bd-icon-btn:hover {
            color: var(--bd-primary);
            border-color: var(--bd-primary);
        }


        /* TOPBAR PROFILE IMAGE */

        .bd-profile-avatar {
            width: 38px;
            height: 38px;

            min-width: 38px;
            min-height: 38px;

            border-radius: 50%;

            object-fit: cover;

            display: block;

            flex-shrink: 0;
        }


        .bd-notification-dot {
            position: absolute;

            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: #ef4444;

            top: 8px;
            right: 8px;

            border: 1px solid var(--bd-card);
        }


        .bd-page {
            padding: 30px;
        }


        .bd-page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 25px;
        }


        .bd-page-title {
            font-size: 25px;
            font-weight: 800;

            margin: 0;

            letter-spacing: -.6px;
        }


        .bd-page-subtitle {
            color: var(--bd-muted);

            font-size: 12px;

            margin-top: 6px;
        }


        .bd-add-btn {
            border: none;

            background: var(--bd-primary);

            color: #fff;

            padding: 11px 17px;

            border-radius: 10px;

            font-size: 12px;
            font-weight: 600;

            text-decoration: none;

            display: inline-flex;
            align-items: center;

            gap: 7px;

            transition: .2s;
        }


        .bd-add-btn:hover {
            background: var(--bd-primary-hover);

            color: #fff;

            transform: translateY(-1px);
        }


        /* =========================
           STAT CARDS
        ========================= */

        .bd-stat-card {
            background: var(--bd-card);

            border: 1px solid var(--bd-border);

            border-radius: 14px;

            padding: 20px;

            height: 100%;

            transition: .2s;
        }


        .bd-stat-card:hover {
            transform: translateY(-2px);

            box-shadow:
                0 10px 25px rgba(15,23,42,.06);
        }


        .bd-stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }


        .bd-stat-icon {
            width: 43px;
            height: 43px;

            border-radius: 11px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 19px;
        }


        .bd-icon-purple {
            background: #eef2ff;
            color: #4f46e5;
        }


        .bd-icon-green {
            background: #ecfdf5;
            color: #16a34a;
        }


        .bd-icon-orange {
            background: #fff7ed;
            color: #ea580c;
        }


        .bd-icon-blue {
            background: #eff6ff;
            color: #2563eb;
        }


        .bd-stat-label {
            color: var(--bd-muted);

            font-size: 11px;

            margin-top: 18px;
        }


        .bd-stat-value {
            font-size: 24px;
            font-weight: 800;

            margin-top: 4px;

            letter-spacing: -.6px;
        }


        .bd-stat-footer {
            margin-top: 9px;

            font-size: 10px;
        }


        .bd-up {
            color: var(--bd-success);
            font-weight: 700;
        }


        .bd-muted {
            color: var(--bd-muted);
        }


        /* =========================
           CONTENT CARDS
        ========================= */

        .bd-content-card {
            background: var(--bd-card);

            border: 1px solid var(--bd-border);

            border-radius: 14px;

            overflow: hidden;
        }


        .bd-card-header {
            padding: 18px 20px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            border-bottom: 1px solid var(--bd-border);
        }


        .bd-card-title {
            font-size: 14px;
            font-weight: 700;

            margin: 0;
        }


        .bd-view-all {
            color: var(--bd-primary);

            font-size: 11px;

            text-decoration: none;

            font-weight: 600;
        }


        .bd-card-body {
            padding: 20px;
        }


        /* =========================
           TABLE
        ========================= */

        .bd-table {
            width: 100%;

            border-collapse: collapse;
        }


        .bd-table th {
            color: var(--bd-muted);

            font-size: 10px;

            text-transform: uppercase;
            letter-spacing: .5px;

            font-weight: 700;

            padding: 12px 14px;

            background: var(--bd-bg);

            border-bottom: 1px solid var(--bd-border);
        }


        .bd-table td {
            padding: 14px;

            border-bottom: 1px solid var(--bd-border);

            font-size: 11px;

            vertical-align: middle;
        }


        .bd-table tr:last-child td {
            border-bottom: none;
        }


        .bd-business {
            display: flex;
            align-items: center;

            gap: 10px;
        }


        .bd-business-img {
            width: 36px;
            height: 36px;

            border-radius: 9px;

            background: #eef2ff;
            color: var(--bd-primary);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 15px;
        }


        .bd-business-name {
            font-weight: 600;
        }


        .bd-business-cat {
            color: var(--bd-muted);

            font-size: 9px;

            margin-top: 3px;
        }


        .bd-status {
            display: inline-flex;

            padding: 5px 8px;

            border-radius: 20px;

            font-size: 9px;
            font-weight: 700;
        }


        .bd-status-active {
            background: #ecfdf5;
            color: #15803d;
        }


        .bd-status-pending {
            background: #fffbeb;
            color: #b45309;
        }


        .bd-status-rejected {
            background: #fef2f2;
            color: #b91c1c;
        }


        /* =========================
           REVIEW
        ========================= */

        .bd-review {
            display: flex;

            gap: 12px;

            padding: 13px 0;

            border-bottom: 1px solid var(--bd-border);
        }


        .bd-review:last-child {
            border-bottom: none;
        }


        .bd-review-avatar {
            width: 34px;
            height: 34px;

            border-radius: 50%;

            background: #e0e7ff;
            color: #4338ca;

            display: flex;

            justify-content: center;
            align-items: center;

            font-size: 10px;
            font-weight: 700;

            flex-shrink: 0;
        }


        .bd-review-name {
            font-size: 11px;
            font-weight: 700;
        }


        .bd-stars {
            color: #f59e0b;

            font-size: 10px;

            margin: 3px 0;
        }


        .bd-review-text {
            color: var(--bd-muted);

            font-size: 10px;

            line-height: 1.5;
        }


        /* =========================
           LOCATION
        ========================= */

        .bd-location {
            display: flex;

            justify-content: space-between;
            align-items: center;

            padding: 12px 0;

            border-bottom: 1px solid var(--bd-border);
        }


        .bd-location:last-child {
            border-bottom: none;
        }


        .bd-location-name {
            font-size: 11px;
            font-weight: 600;
        }


        .bd-location-count {
            color: var(--bd-muted);

            font-size: 9px;
        }


        .bd-progress {
            width: 90px;
            height: 5px;

            background: var(--bd-bg);

            border-radius: 20px;

            overflow: hidden;
        }


        .bd-progress-bar {
            height: 100%;

            background: var(--bd-primary);

            border-radius: 20px;
        }


        /* =====================================================
           SIDEBAR DROPDOWNS
        ===================================================== */

        .bd-nav-dropdown {
            width: 100%;
        }


        .bd-dropdown-toggle {
            width: 100%;

            border: none;

            background: transparent;

            color: var(--bd-sidebar-text);

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 11px 13px;

            border-radius: 10px;

            font-family: inherit;

            font-size: 13px;
            font-weight: 500;

            cursor: pointer;

            transition: .2s ease;
        }


        .bd-dropdown-toggle:hover {
            color: var(--bd-text);

            background: var(--bd-sidebar-hover);
        }


        .bd-nav-left {
            display: flex;

            align-items: center;

            gap: 12px;
        }


        .bd-nav-left i {
            font-size: 17px;

            width: 21px;

            text-align: center;
        }


        .bd-chevron {
            font-size: 11px !important;

            width: auto !important;

            transition: transform .25s ease;
        }


        .bd-dropdown-toggle.bd-open .bd-chevron {
            transform: rotate(180deg);
        }


        /* =========================
           SUBMENU
        ========================= */

        .bd-submenu {
            display: none;

            margin: 3px 0 5px 16px;

            padding-left: 16px;

            border-left: 1px solid var(--bd-sidebar-border);
        }


        .bd-submenu.bd-submenu-open {
            display: block;
        }


        .bd-submenu a {
            position: relative;

            padding: 9px 11px !important;

            border-radius: 8px;

            font-size: 11px !important;

            color: var(--bd-sidebar-text) !important;

            gap: 9px !important;
        }


        .bd-submenu a i {
            font-size: 13px !important;

            width: 17px !important;
        }


        .bd-submenu a:hover {
            color: var(--bd-text) !important;

            background: var(--bd-sidebar-hover);
        }


        .bd-submenu a.bd-sub-active {
            color: var(--bd-primary) !important;

            background: rgba(79,70,229,.10);
        }


        .bd-submenu a.bd-sub-active::before {
            content: "";

            position: absolute;

            left: -17px;

            top: 50%;

            width: 2px;
            height: 20px;

            transform: translateY(-50%);

            background: var(--bd-primary);

            border-radius: 5px;
        }


        /* =========================
           BADGE
        ========================= */

        .bd-menu-badge {
            margin-left: auto;

            min-width: 19px;
            height: 19px;

            padding: 0 5px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            border-radius: 20px;

            background: rgba(239,68,68,.15);

            color: #ef4444;

            font-size: 9px;
            font-weight: 700;
        }


        .bd-nav > a {
            position: relative;
        }


        /* =========================
           ADMIN MORE
        ========================= */

        .bd-admin-more {
            margin-left: auto;

            width: 28px;
            height: 28px;

            border: none;

            background: transparent;

            color: var(--bd-sidebar-muted);

            border-radius: 7px;

            display: flex;

            align-items: center;
            justify-content: center;

            cursor: pointer;
        }


        .bd-admin-more:hover {
            background: var(--bd-sidebar-hover);

            color: var(--bd-text);
        }


        /* =====================================================
           DARK MODE
        ===================================================== */

        body.bd-dark {

            --bd-bg: #0b1120;

            --bd-card: #111827;

            --bd-text: #f3f4f6;

            --bd-muted: #9ca3af;

            --bd-border: #1f2937;


            /* DARK SIDEBAR */

            --bd-sidebar: #070b14;

            --bd-sidebar-hover: #151c2b;

            --bd-sidebar-text: #9ca3af;

            --bd-sidebar-muted: #6b7280;

            --bd-sidebar-border: #1f2937;
        }


        /* Dark search */

        body.bd-dark .bd-search input {
            background: #0b1120;
        }


        /* Dark stat icons */

        body.bd-dark .bd-icon-purple {
            background: rgba(99,102,241,.15);
        }


        body.bd-dark .bd-icon-green {
            background: rgba(34,197,94,.12);
        }


        body.bd-dark .bd-icon-orange {
            background: rgba(249,115,22,.12);
        }


        body.bd-dark .bd-icon-blue {
            background: rgba(59,130,246,.12);
        }


        /* Dark table */

        body.bd-dark .bd-table th {
            background: #0b1120;
        }


        body.bd-dark .bd-notification-dot {
            border-color: #111827;
        }


        body.bd-dark .bd-submenu a.bd-sub-active {
            color: #a5b4fc !important;

            background: rgba(99,102,241,.16);
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        .bd-mobile-menu {
            display: none;
        }


        @media (max-width: 991px) {

.bd-sidebar {
    transform: translateX(-100%);

    box-shadow:
        15px 0 40px rgba(0,0,0,.18);
}

.bd-sidebar.bd-show {
    transform: translateX(0);
}

.bd-topbar {
    margin-left: 0;
    width: 100%;
}

.bd-main {
    margin-left: 0;
}

.bd-mobile-menu {
    display: flex;
}

.bd-search {
    width: 220px;
}

.bd-page {
    padding: 20px;
}
}


        @media (max-width: 575px) {

            .bd-topbar {
                padding: 0 15px;
            }


            .bd-search {
                display: none;
            }


            .bd-page-heading {
                align-items: flex-start;

                gap: 15px;

                flex-direction: column;
            }


            .bd-page-title {
                font-size: 21px;
            }


            .bd-card-body {
                overflow-x: auto;
            }


            .bd-table {
                min-width: 600px;
            }

        }
/* =========================================================
   DASHBOARD MARQUEE
========================================================= */

.bd-dashboard-marquee {
    width: 100%;
    max-width: 560px;
    height: 40px;
    overflow: hidden;
    border: 1px solid var(--bd-border);
    border-radius: 10px;
    background: var(--bd-card);
    display: flex;
    align-items: center;
}

.bd-marquee-track {
    width: 100%;
    overflow: hidden;
    white-space: nowrap;
}

.bd-marquee-content {
    display: flex;
    width: max-content;
    align-items: center;
    gap: 18px;
    animation: bdMarquee 20s linear infinite;
}

.bd-marquee-content span {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    color: var(--bd-text);
    font-size: 13px;
    font-weight: 600;
}

.bd-marquee-content span i {
    color: #f58220;
}

.bd-marquee-content b {
    color: var(--bd-muted);
}

@keyframes bdMarquee {
    from {
        transform: translateX(0);
    }

    to {
        transform: translateX(-50%);
    }
}


/* Mobile */
@media (max-width: 767px) {

    .bd-dashboard-marquee {
        max-width: 163px;
        height: 36px;
    }

    .bd-marquee-content {
        gap: 14px;
        animation-duration: 18s;
    }

    .bd-marquee-content span {
        font-size: 11px;
    }

}
.bd-sidebar-close {
    display: none;
}

@media (max-width: 991px) {
    .bd-sidebar-close {
        display: flex;
        position: absolute;
        top: 18px;
        right: 15px;
        width: 34px;
        height: 34px;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 8px;
        background: transparent;
        color: var(--bd-text);
        font-size: 17px;
        cursor: pointer;
        z-index: 100;
    }

    .bd-sidebar-close:hover {
        background: var(--bd-border);
    }
}
    </style>
</head>


<body>


<!-- =========================
     TOPBAR
========================= -->

<header class="bd-topbar">

    <!-- LEFT -->
    <div class="d-flex align-items-center gap-3">

        <!-- Mobile Menu -->
        <button
            type="button"
            class="bd-icon-btn bd-mobile-menu"
            id="bdMobileMenu"
            title="Menu"
        >
            <i class="bi bi-list"></i>
        </button>


        <!-- Dashboard Marquee -->
        <div class="bd-dashboard-marquee">

            <div class="bd-marquee-track">

                <div class="bd-marquee-content">

                    <!-- FIRST -->
                    <span>
                        <i class="bi bi-grid-1x2-fill"></i>
                        Business Listing Dashboard
                    </span>

                    <b>•</b>

                    <span>
                        <i class="bi bi-buildings-fill"></i>
                        Manage Businesses
                    </span>

                    <b>•</b>

                    <span>
                        <i class="bi bi-people-fill"></i>
                        Manage Users
                    </span>

                    <b>•</b>

                    <span>
                        <i class="bi bi-bar-chart-fill"></i>
                        Track Your Directory
                    </span>

                    <b>•</b>

                    <span>
                        <i class="bi bi-lightning-charge-fill"></i>
                        Everything Under Control
                    </span>


                    <!-- SECOND COPY -->
                    <span>
                        <i class="bi bi-grid-1x2-fill"></i>
                        Business Listing Dashboard
                    </span>

                    <b>•</b>

                    <span>
                        <i class="bi bi-buildings-fill"></i>
                        Manage Businesses
                    </span>

                    <b>•</b>

                    <span>
                        <i class="bi bi-people-fill"></i>
                        Manage Users
                    </span>

                    <b>•</b>

                    <span>
                        <i class="bi bi-bar-chart-fill"></i>
                        Track Your Directory
                    </span>

                    <b>•</b>

                    <span>
                        <i class="bi bi-lightning-charge-fill"></i>
                        Everything Under Control
                    </span>

                </div>

            </div>

        </div>

    </div>


    <!-- RIGHT -->
    <div class="bd-top-actions d-flex align-items-center gap-2">

        <!-- Theme -->
        <button
            type="button"
            class="bd-icon-btn"
            id="bdThemeToggle"
            title="Toggle theme"
        >
            <i class="bi bi-moon-stars" id="bdThemeIcon"></i>
        </button>


        <!-- Notifications -->
        <div class="dropdown">

            <button
                type="button"
                class="bd-icon-btn position-relative"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                title="Notifications"
            >

                <i class="bi bi-bell"></i>

                <span class="bd-notification-dot"></span>

            </button>


            <div class="dropdown-menu dropdown-menu-end shadow border-0 p-0">

                <div class="p-3 border-bottom">

                    <div class="d-flex justify-content-between align-items-center">

                        <strong>
                            Notifications
                        </strong>

                        <span class="badge bg-primary">
                            3
                        </span>

                    </div>

                    <small class="text-muted">
                        Latest activity
                    </small>

                </div>


                <div style="width: 320px;">

                    <a
                        href="#"
                        class="dropdown-item py-3"
                    >

                        <div class="d-flex gap-3">

                            <i class="bi bi-buildings text-primary fs-5"></i>

                            <div>

                                <strong class="d-block">
                                    New business submitted
                                </strong>

                                <small class="text-muted">
                                    A business is waiting for approval.
                                </small>

                            </div>

                        </div>

                    </a>


                    <a
                        href="#"
                        class="dropdown-item py-3"
                    >

                        <div class="d-flex gap-3">

                            <i class="bi bi-person-plus text-success fs-5"></i>

                            <div>

                                <strong class="d-block">
                                    New user registered
                                </strong>

                                <small class="text-muted">
                                    A new user joined the platform.
                                </small>

                            </div>

                        </div>

                    </a>


                    <a
                        href="#"
                        class="dropdown-item py-3"
                    >

                        <div class="d-flex gap-3">

                            <i class="bi bi-star text-warning fs-5"></i>

                            <div>

                                <strong class="d-block">
                                    New review received
                                </strong>

                                <small class="text-muted">
                                    A business received a new review.
                                </small>

                            </div>

                        </div>

                    </a>

                </div>


                <div class="p-2 border-top text-center">

                    <a
                        href="#"
                        class="small text-decoration-none"
                    >
                        View all notifications
                    </a>

                </div>

            </div>

        </div>


        <!-- =========================
             PROFILE
        ========================= -->

        <div class="dropdown">

            <button
                type="button"
                class="bd-icon-btn"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                title="Admin Profile"
            >

            @if(auth()->user()->profile_photo)
            <img
                src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                alt="{{ auth()->user()->name }}"
                class="bd-avatar-img"
            >
        @else
            <div class="bd-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}
            </div>
        @endif

            </button>


            <div class="dropdown-menu dropdown-menu-end shadow border-0">

                <!-- Admin Info -->

                <div class="px-3 py-3 border-bottom">

                    <div class="d-flex align-items-center gap-3">

                        <!-- Profile Image -->

                        <div
                        class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center overflow-hidden"
                        style="width:45px;height:45px;flex-shrink:0;"
                    >

                        @if(auth()->user()->profile_photo)

                            <img
                                src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                                alt="{{ auth()->user()->name }}"
                                style="
                                    width:45px;
                                    height:45px;
                                    object-fit:cover;
                                    border-radius:50%;
                                    display:block;
                                "
                            >

                        @else

                            <span class="fw-bold">
                                {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}
                            </span>

                        @endif

                    </div>


                        <!-- Admin Details -->

                        <div>

                            <strong class="d-block">

                                {{ auth()->user()->name ?? 'Administrator' }}

                            </strong>

                            <small class="text-muted">

                                {{ auth()->user()->email ?? '' }}

                            </small>

                        </div>

                    </div>

                </div>


                <!-- Profile -->

                <a
                    href="{{ route('admin.profile.index') }}"
                    class="dropdown-item py-2"
                >

                    <i class="bi bi-person me-2"></i>

                    My Profile

                </a>


                <!-- Settings -->

                <a
                    href="{{ route('admin.settings.edit') }}"
                    class="dropdown-item py-2"
                >

                    <i class="bi bi-gear me-2"></i>

                    Settings

                </a>


                <div class="dropdown-divider"></div>


                <!-- Logout -->

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

            </div>

        </div>

    </div>

</header>


<!-- =========================
     SIDEBAR
========================= -->

<aside class="bd-sidebar" id="bdSidebar">
<button type="button" class="bd-sidebar-close" id="bdSidebarClose">
    <i class="bi bi-x-lg"></i>
</button>

    <!-- BRAND -->

    <div class="bd-brand">

        <div class="bd-brand-icon">
            <i class="bi bi-buildings"></i>
        </div>

        <div>

            <div class="bd-brand-name">
                BizDirectory
            </div>

            <span class="bd-brand-sub">
                Admin Panel
            </span>

        </div>

    </div>


    <!-- =========================
         MAIN MENU
    ========================= -->

    <div class="bd-menu-title">
        Main Menu
    </div>


    <nav class="bd-nav">


        <!-- Dashboard -->

        <a
            href="{{ route('admin.dashboard') }}"
            class="active"
        >

            <i class="bi bi-grid-1x2-fill"></i>

            <span>
                Dashboard
            </span>

        </a>


        <!-- =========================
             OFFERS & DEALS
        ========================= -->

        <div class="bd-nav-dropdown">

            <button
                type="button"
                class="bd-dropdown-toggle"
                data-dropdown="offersMenu"
            >

                <span class="bd-nav-left">

                    <i class="bi bi-tags"></i>

                    <span>
                        Offers & Deals
                    </span>

                </span>

                <i class="bi bi-chevron-down bd-chevron"></i>

            </button>


            <div
                class="bd-submenu"
                id="offersMenu"
            >

                <a href="{{ route('admin.offers.index') }}">
                    <i class="bi bi-list-ul"></i>
                    All Offers
                </a>

                <a href="{{ route('admin.offers.create') }}">
                    <i class="bi bi-plus-circle"></i>
                    Add Offer
                </a>

                <a href="#">
                    <i class="bi bi-hourglass-split"></i>
                    Pending Approval
                    <span class="bd-menu-badge">24</span>
                </a>

                <a href="#">
                    <i class="bi bi-x-circle"></i>
                    Declined Offers
                    <span class="bd-menu-badge">4</span>
                </a>

            </div>

        </div>
<!-- =========================
     HOME SLIDERS
========================= -->

<div class="bd-nav-dropdown">

    <button
        type="button"
        class="bd-dropdown-toggle"
        data-dropdown="homeSlidersMenu"
    >

        <span class="bd-nav-left">

            <i class="bi bi-images"></i>

            <span>
                Home Sliders
            </span>

        </span>

        <i class="bi bi-chevron-down bd-chevron"></i>

    </button>


    <div
        class="bd-submenu"
        id="homeSlidersMenu"
    >

        <a
            href="{{ route('admin.home-sliders.index') }}"
            class="{{ request()->routeIs('admin.home-sliders.index') ? 'active' : '' }}"
        >
            <i class="bi bi-list-ul"></i>
            All Sliders
        </a>

        <a
            href="{{ route('admin.home-sliders.create') }}"
            class="{{ request()->routeIs('admin.home-sliders.create') ? 'active' : '' }}"
        >
            <i class="bi bi-plus-circle"></i>
            Add Slider
        </a>

    </div>

</div>

        <!-- =========================
             BUSINESSES
        ========================= -->

        <div class="bd-nav-dropdown">

            <button
                type="button"
                class="bd-dropdown-toggle"
                data-dropdown="businessesMenu"
            >

                <span class="bd-nav-left">

                    <i class="bi bi-buildings"></i>

                    <span>
                        Businesses
                    </span>

                </span>

                <i class="bi bi-chevron-down bd-chevron"></i>

            </button>


            <div
                class="bd-submenu"
                id="businessesMenu"
            >

                <a href="{{ route('admin.businesses.index') }}">
                    <i class="bi bi-list-ul"></i>
                    All Businesses
                </a>

                <a href="{{ route('admin.businesses.create') }}">
                    <i class="bi bi-plus-circle"></i>
                    Add Business
                </a>

                <a href="#">
                    <i class="bi bi-hourglass-split"></i>
                    Pending Approval
                    <span class="bd-menu-badge">24</span>
                </a>

                <a href="#">
                    <i class="bi bi-check-circle"></i>
                    Active Listings
                </a>

                <a href="#">
                    <i class="bi bi-x-circle"></i>
                    Rejected Listings
                </a>

                <a href="#">
                    <i class="bi bi-star-fill"></i>
                    Featured Listings
                </a>

                <a href="#">
                    <i class="bi bi-calendar-x"></i>
                    Expired Listings
                </a>

            </div>

        </div>


        <!-- =========================
             BOOKINGS
        ========================= -->

        <div class="bd-nav-dropdown">

            <button
                type="button"
                class="bd-dropdown-toggle"
                data-dropdown="bookingsMenu"
            >

                <span class="bd-nav-left">

                    <i class="bi bi-calendar-event"></i>

                    <span>
                        Bookings
                    </span>

                </span>

                <i class="bi bi-chevron-down bd-chevron"></i>

            </button>


            <div
                class="bd-submenu"
                id="bookingsMenu"
            >

                <a href="{{ route('admin.bookings.index') }}">
                    <i class="bi bi-list-ul"></i>
                    All Bookings
                </a>

                <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}">
                    <i class="bi bi-hourglass-split"></i>
                    Pending Approval
                    <span class="bd-menu-badge">24</span>
                </a>

                <a href="{{ route('admin.bookings.index', ['status' => 'confirmed']) }}">
                    <i class="bi bi-check-circle"></i>
                    Confirmed Bookings
                </a>

                <a href="{{ route('admin.bookings.index', ['status' => 'declined']) }}">
                    <i class="bi bi-x-circle"></i>
                    Declined Bookings
                </a>

            </div>

        </div>


        <!-- =========================
             CATEGORIES
        ========================= -->

        <div class="bd-nav-dropdown">

            <button
                type="button"
                class="bd-dropdown-toggle"
                data-dropdown="categoriesMenu"
            >

                <span class="bd-nav-left">

                    <i class="bi bi-folder2-open"></i>

                    <span>
                        Categories
                    </span>

                </span>

                <i class="bi bi-chevron-down bd-chevron"></i>

            </button>


            <div
                class="bd-submenu"
                id="categoriesMenu"
            >

                <a href="{{ route('admin.categories.index') }}">
                    <i class="bi bi-list-ul"></i>
                    All Categories
                </a>

                <a href="{{ route('admin.categories.create') }}">
                    <i class="bi bi-plus-circle"></i>
                    Add Category
                </a>

                <a href="{{ route('admin.subcategories.index') }}">
                    <i class="bi bi-diagram-3"></i>
                    Sub Categories
                </a>

            </div>

        </div>


       

        <!-- =========================
             LOCATIONS
        ========================= -->

        <div class="bd-nav-dropdown">

            <button
                type="button"
                class="bd-dropdown-toggle"
                data-dropdown="locationsMenu"
            >

                <span class="bd-nav-left">

                    <i class="bi bi-geo-alt"></i>

                    <span>
                        Locations
                    </span>

                </span>

                <i class="bi bi-chevron-down bd-chevron"></i>

            </button>


            <div
                class="bd-submenu"
                id="locationsMenu"
            >

                <a href="{{ route('admin.countries.index') }}">
                    <i class="bi bi-globe2"></i>
                    Countries
                </a>

                <a href="{{ route('admin.states.index') }}">
                    <i class="bi bi-map"></i>
                    States
                </a>

                <a href="{{ route('admin.cities.index') }}">
                    <i class="bi bi-buildings"></i>
                    Cities
                </a>

                <a href="{{ route('admin.areas.index') }}">
                    <i class="bi bi-pin-map"></i>
                    Areas
                </a>

            </div>

        </div>


        <!-- =========================
             USERS
        ========================= -->

        <div class="bd-nav-dropdown">

            <button
                type="button"
                class="bd-dropdown-toggle"
                data-dropdown="usersMenu"
            >

                <span class="bd-nav-left">

                    <i class="bi bi-people"></i>

                    <span>
                        Users
                    </span>

                </span>

                <i class="bi bi-chevron-down bd-chevron"></i>

            </button>


            <div
                class="bd-submenu"
                id="usersMenu"
            >

                <a href="#">
                    <i class="bi bi-people"></i>
                    All Users
                </a>

                <a href="#">
                    <i class="bi bi-person-badge"></i>
                    Business Owners
                </a>

                <a href="#">
                    <i class="bi bi-person"></i>
                    Customers
                </a>

                <a href="#">
                    <i class="bi bi-patch-check"></i>
                    Verified Users
                </a>

                <a href="#">
                    <i class="bi bi-person-x"></i>
                    Blocked Users
                </a>

            </div>

        </div>


        <!-- =========================
             REVIEWS
        ========================= -->

        <div class="bd-nav-dropdown">

            <button
                type="button"
                class="bd-dropdown-toggle"
                data-dropdown="reviewsMenu"
            >

                <span class="bd-nav-left">

                    <i class="bi bi-star"></i>

                    <span>
                        Reviews
                    </span>

                </span>

                <i class="bi bi-chevron-down bd-chevron"></i>

            </button>


            <div
                class="bd-submenu"
                id="reviewsMenu"
            >

                <a href="{{ route('admin.reviews.index') }}">
                    <i class="bi bi-star"></i>
                    All Reviews
                </a>

                <a href="{{ route('admin.reviews.index', ['status' => 'pending']) }}">
                    <i class="bi bi-hourglass"></i>
                    Pending Reviews

                    <span class="bd-menu-badge">
                        {{ $pendingReviews ?? 0 }}
                    </span>
                </a>

                <a href="#">
                    <i class="bi bi-flag"></i>
                    Reported Reviews
                </a>

            </div>

        </div>


        <!-- =========================
             PRODUCTS
        ========================= -->

        <div class="bd-nav-dropdown">

            <button
                type="button"
                class="bd-dropdown-toggle"
                data-dropdown="productsMenu"
            >

                <span class="bd-nav-left">

                    <i class="bi bi-bag"></i>

                    <span>
                        Products
                    </span>

                </span>

                <i class="bi bi-chevron-down bd-chevron"></i>

            </button>


            <div
                class="bd-submenu"
                id="productsMenu"
            >

                <a href="{{ route('admin.products.index') }}">
                    <i class="bi bi-bag"></i>
                    All Products
                </a>

                <a href="{{ route('admin.products.index', ['status' => 'pending']) }}">
                    <i class="bi bi-hourglass"></i>
                    Pending Products

                    <span class="bd-menu-badge">
                        {{ $pendingProducts ?? 0 }}
                    </span>
                </a>

                <a href="#">
                    <i class="bi bi-flag"></i>
                    Reported Products
                </a>

            </div>

        </div>


        <!-- =========================
             ENQUIRIES
        ========================= -->

        <div class="bd-nav-dropdown">

            <button
                type="button"
                class="bd-dropdown-toggle"
                data-dropdown="enquiriesMenu"
            >

                <span class="bd-nav-left">

                    <i class="bi bi-chat-left-text"></i>

                    <span>
                        Enquiries
                    </span>

                </span>

                <i class="bi bi-chevron-down bd-chevron"></i>

            </button>


            <div
                class="bd-submenu"
                id="enquiriesMenu"
            >

                {{-- All Enquiries --}}

                <a href="{{ route('admin.enquiries.index') }}">

                    <i class="bi bi-chat-left-text"></i>

                    <span>
                        All Enquiries
                    </span>

                </a>


                {{-- New Enquiries --}}

                <a href="{{ route('admin.enquiries.index', ['status' => 'new']) }}">

                    <i class="bi bi-envelope"></i>

                    <span>
                        New Enquiries
                    </span>

                    @if(isset($stats) && ($stats['new'] ?? 0) > 0)

                        <span class="bd-menu-badge">
                            {{ $stats['new'] }}
                        </span>

                    @endif

                </a>


                {{-- Contacted --}}

                <a href="{{ route('admin.enquiries.index', ['status' => 'contacted']) }}">

                    <i class="bi bi-telephone"></i>

                    <span>
                        Contacted
                    </span>

                </a>


                {{-- Closed --}}

                <a href="{{ route('admin.enquiries.index', ['status' => 'closed']) }}">

                    <i class="bi bi-check2-circle"></i>

                    <span>
                        Closed
                    </span>

                </a>

            </div>

        </div>

    </nav>


    <!-- =========================
         MANAGEMENT
    ========================= -->

    <div class="bd-menu-title">
        Management
    </div>


    <nav class="bd-nav">


        <!-- PAYMENTS -->

        <div class="bd-nav-dropdown">

            <button
                type="button"
                class="bd-dropdown-toggle"
                data-dropdown="paymentsMenu"
            >

                <span class="bd-nav-left">

                    <i class="bi bi-credit-card"></i>

                    <span>
                        Payments
                    </span>

                </span>

                <i class="bi bi-chevron-down bd-chevron"></i>

            </button>


            <div
                class="bd-submenu"
                id="paymentsMenu"
            >

                <a href="#">
                    <i class="bi bi-receipt"></i>
                    Transactions
                </a>

                <a href="#">
                    <i class="bi bi-check-circle"></i>
                    Successful
                </a>

                <a href="#">
                    <i class="bi bi-hourglass"></i>
                    Pending
                </a>

                <a href="#">
                    <i class="bi bi-x-circle"></i>
                    Failed
                </a>

            </div>

        </div>


        <!-- ANALYTICS -->

        <div class="bd-nav-dropdown">

            <button
                type="button"
                class="bd-dropdown-toggle"
                data-dropdown="analyticsMenu"
            >

                <span class="bd-nav-left">

                    <i class="bi bi-bar-chart-line"></i>

                    <span>
                        Analytics
                    </span>

                </span>

                <i class="bi bi-chevron-down bd-chevron"></i>

            </button>


            <div
                class="bd-submenu"
                id="analyticsMenu"
            >

                <a href="#">
                    <i class="bi bi-speedometer2"></i>
                    Overview
                </a>

                <a href="#">
                    <i class="bi bi-buildings"></i>
                    Listing Analytics
                </a>

                <a href="#">
                    <i class="bi bi-people"></i>
                    User Analytics
                </a>

                <a href="#">
                    <i class="bi bi-currency-rupee"></i>
                    Revenue Analytics
                </a>

            </div>

        </div>


        <!-- NOTIFICATIONS -->

        <a href="{{ route('admin.notifications.index') }}">

            <i class="bi bi-bell"></i>

            <span>
                Notifications
            </span>

            @php
                $unreadNotifications = \App\Models\Notification::where('is_read', false)->count();
            @endphp

            @if($unreadNotifications > 0)

                <span class="bd-menu-badge ms-auto">
                    {{ $unreadNotifications }}
                </span>

            @endif

        </a>


        <!-- SETTINGS -->

        <div class="bd-nav-dropdown">

            <button
                type="button"
                class="bd-dropdown-toggle"
                data-dropdown="settingsMenu"
            >

                <span class="bd-nav-left">

                    <i class="bi bi-gear"></i>

                    <span>
                        Settings
                    </span>

                </span>

                <i class="bi bi-chevron-down bd-chevron"></i>

            </button>


            <div
                class="bd-submenu"
                id="settingsMenu"
            >

                <a href="{{ route('admin.settings.edit') }}">
                    <i class="bi bi-sliders"></i>
                    General Settings
                </a>

                <a href="{{ route('admin.profile.index') }}">
                    <i class="bi bi-person-circle"></i>
                    Profile
                </a>

                <a href="#">
                    <i class="bi bi-shield-lock"></i>
                    Change Password
                </a>

                <a href="#">
                    <i class="bi bi-envelope-gear"></i>
                    Email Settings
                </a>

                <a href="#">
                    <i class="bi bi-share"></i>
                    Social Media
                </a>

            </div>

        </div>

    </nav>


    <!-- =========================
         ADMIN PROFILE
    ========================= -->

    <div class="bd-sidebar-bottom">

        <div class="bd-admin-mini">


            <!-- PROFILE IMAGE -->

            @if(auth()->user()->profile_photo)

    <img
        src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
        alt="{{ auth()->user()->name }}"
        class="bd-avatar-img"
    >

@else

    <div class="bd-avatar">
        {{ strtoupper(substr(auth()->user()->name ?? 'AD', 0, 2)) }}
    </div>

@endif


            <!-- ADMIN DETAILS -->

            <div class="bd-admin-info">

                <div class="bd-admin-name">
                    {{ auth()->user()->name ?? 'Administrator' }}
                </div>

                <div class="bd-admin-role">

                    Super Admin

                </div>

            </div>


            <!-- MORE BUTTON -->

            <button
                type="button"
                class="bd-admin-more"
                title="Profile options"
            >

                <i class="bi bi-three-dots-vertical"></i>

            </button>

        </div>

    </div>

</aside>


<!-- =========================
     MAIN
========================= -->

<main class="bd-main">


    @if(session('error'))

        <div
            class="alert alert-danger alert-dismissible fade show mx-4 mt-3"
            role="alert"
        >

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>

        </div>

    @endif


    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show mx-4 mt-3"
            role="alert"
        >

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
            ></button>

        </div>

    @endif


    @yield('content')


</main>


<!-- Chart.js -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<script>


    /* =========================================================
       THEME TOGGLE
    ========================================================= */

    const themeToggle =
        document.getElementById('bdThemeToggle');

    const themeIcon =
        document.getElementById('bdThemeIcon');


    const savedTheme =
        localStorage.getItem('bd-theme');


    if (savedTheme === 'dark') {

        document.body.classList.add('bd-dark');

        if (themeIcon) {

            themeIcon.classList.remove(
                'bi-moon-stars'
            );

            themeIcon.classList.add(
                'bi-sun'
            );

        }

    }


    if (themeToggle) {

        themeToggle.addEventListener(
            'click',
            function () {

                document.body.classList.toggle(
                    'bd-dark'
                );


                const isDark =
                    document.body.classList.contains(
                        'bd-dark'
                    );


                if (themeIcon) {

                    themeIcon.classList.toggle(
                        'bi-moon-stars',
                        !isDark
                    );

                    themeIcon.classList.toggle(
                        'bi-sun',
                        isDark
                    );

                }


                localStorage.setItem(
                    'bd-theme',
                    isDark ? 'dark' : 'light'
                );

            }
        );

    }


    /* =========================================================
       MOBILE SIDEBAR
    ========================================================= */

    const mobileMenu =
        document.getElementById(
            'bdMobileMenu'
        );


    const sidebar =
        document.getElementById(
            'bdSidebar'
        );


    if (mobileMenu && sidebar) {

        mobileMenu.addEventListener(
            'click',
            function () {

                sidebar.classList.toggle(
                    'bd-show'
                );

            }
        );

    }

/* =========================================================
   MOBILE SIDEBAR CLOSE BUTTON
========================================================= */

const sidebarClose =
    document.getElementById(
        'bdSidebarClose'
    );

if (sidebarClose && sidebar) {

    sidebarClose.addEventListener(
        'click',
        function (e) {

            e.preventDefault();
            e.stopPropagation();

            sidebar.classList.remove(
                'bd-show'
            );

        }
    );

}


/* =========================================================
   CLOSE SIDEBAR ON OUTSIDE CLICK
========================================================= */

document.addEventListener(
    'click',
    function (e) {

        if (window.innerWidth > 991) {
            return;
        }

        if (
            sidebar &&
            sidebar.classList.contains('bd-show') &&
            !sidebar.contains(e.target) &&
            !mobileMenu.contains(e.target)
        ) {

            sidebar.classList.remove(
                'bd-show'
            );

        }

    }
);
    /* =========================================================
       LISTING CHART
    ========================================================= */

    const chartCanvas =
        document.getElementById(
            'bdListingChart'
        );


    const chartPeriod =
        document.getElementById(
            'bdListingPeriod'
        );


    if (
        chartCanvas &&
        typeof Chart !== 'undefined' &&
        typeof listingGrowth !== 'undefined'
    ) {

        const chartContext =
            chartCanvas.getContext('2d');


        let listingChart;


        function loadListingChart(period) {

            let chartData =
                listingGrowth[period];


            if (!chartData) {
                return;
            }


            if (listingChart) {

                listingChart.destroy();

            }


            listingChart =
                new Chart(
                    chartContext,
                    {

                        type: 'line',

                        data: {

                            labels:
                                chartData.labels,

                            datasets: [{

                                label:
                                    'Listings',

                                data:
                                    chartData.data,

                                tension:
                                    0.4,

                                fill:
                                    true,

                                borderWidth:
                                    2,

                                pointRadius:
                                    period === 'daily'
                                        ? 2
                                        : 4

                            }]

                        },


                        options: {

                            responsive:
                                true,

                            maintainAspectRatio:
                                false,


                            plugins: {

                                legend: {

                                    display:
                                        false

                                }

                            },


                            scales: {

                                y: {

                                    beginAtZero:
                                        true,

                                    ticks: {

                                        precision:
                                            0

                                    },

                                    grid: {

                                        drawBorder:
                                            false

                                    }

                                },


                                x: {

                                    grid: {

                                        display:
                                            false

                                    }

                                }

                            }

                        }

                    }
                );

        }


        /*
        |--------------------------------------------------------------------------
        | Initial Chart
        |--------------------------------------------------------------------------
        */

        loadListingChart(
            'monthly'
        );


        /*
        |--------------------------------------------------------------------------
        | Period Change
        |--------------------------------------------------------------------------
        */

        if (chartPeriod) {

            chartPeriod.addEventListener(
                'change',
                function () {

                    loadListingChart(
                        this.value
                    );

                }
            );

        }

    }


    /* =========================================================
       SIDEBAR DROPDOWNS
    ========================================================= */

    const dropdownButtons =
        document.querySelectorAll(
            '.bd-dropdown-toggle'
        );


    dropdownButtons.forEach(
        function(button) {

            button.addEventListener(
                'click',
                function() {

                    const targetId =
                        this.getAttribute(
                            'data-dropdown'
                        );


                    if (!targetId) {
                        return;
                    }


                    const target =
                        document.getElementById(
                            targetId
                        );


                    if (!target) {
                        return;
                    }


                    /* Close other submenus */

                    document
                        .querySelectorAll(
                            '.bd-submenu.bd-submenu-open'
                        )
                        .forEach(
                            function(menu) {

                                if (menu !== target) {

                                    menu.classList.remove(
                                        'bd-submenu-open'
                                    );

                                }

                            }
                        );


                    /* Close other dropdown buttons */

                    document
                        .querySelectorAll(
                            '.bd-dropdown-toggle.bd-open'
                        )
                        .forEach(
                            function(otherButton) {

                                if (
                                    otherButton !== button
                                ) {

                                    otherButton.classList.remove(
                                        'bd-open'
                                    );

                                }

                            }
                        );


                    /* Toggle current submenu */

                    target.classList.toggle(
                        'bd-submenu-open'
                    );


                    this.classList.toggle(
                        'bd-open'
                    );

                }
            );

        }
    );


    /* =========================================================
       CLOSE MOBILE SIDEBAR WHEN LINK IS CLICKED
    ========================================================= */

    document
        .querySelectorAll(
            '.bd-sidebar a'
        )
        .forEach(
            function(link) {

                link.addEventListener(
                    'click',
                    function() {

                        if (
                            window.innerWidth <= 991 &&
                            sidebar
                        ) {

                            sidebar.classList.remove(
                                'bd-show'
                            );

                        }

                    }
                );

            }
        );


    /* =========================================================
       BOOTSTRAP TOOLTIP
       Only initialize if Bootstrap exists.
    ========================================================= */

    if (
        typeof bootstrap !== 'undefined'
    ) {

        const tooltipTriggerList =
            document.querySelectorAll(
                '[data-bs-toggle="tooltip"]'
            );


        tooltipTriggerList.forEach(
            function(
                tooltipTriggerEl
            ) {

                new bootstrap.Tooltip(
                    tooltipTriggerEl
                );

            }
        );

    }

</script>


</body>
</html>
