@extends('admin.layouts.master')

@section('title', 'Admin Profile')

@section('content')

<div class="bd-page">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Profile Settings</h4>
            <p class="text-muted mb-0">
                Manage your administrator profile information.
            </p>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row g-4">

        {{-- Profile Information --}}
        <div class="col-lg-8">

            <div class="bd-content-card">

                <div class="bd-card-header">
                    <div>
                        <h5 class="mb-1">Profile Information</h5>
                        <p class="text-muted mb-0">
                            Update your personal administrator information.
                        </p>
                    </div>
                </div>

                <div class="bd-card-body">

                    <form action="{{ route('admin.profile.update') }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        {{-- Profile Photo --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Profile Photo
                            </label>

                            <div class="d-flex align-items-center gap-3">

                                @if($admin->profile_photo)
                                    <img
                                        src="{{ asset('storage/' . $admin->profile_photo) }}"
                                        alt="Profile"
                                        class="admin-profile-preview"
                                    >
                                @else
                                    <div class="admin-profile-placeholder">
                                        {{ strtoupper(substr($admin->name, 0, 2)) }}
                                    </div>
                                @endif

                                <div>
                                    <input
                                        type="file"
                                        name="profile_photo"
                                        class="form-control"
                                        accept=".jpg,.jpeg,.png,.webp"
                                    >

                                    <small class="text-muted">
                                        JPG, PNG or WEBP. Maximum 2MB.
                                    </small>
                                </div>

                            </div>

                        </div>


                        {{-- Name --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Full Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $admin->name) }}"
                                placeholder="Enter your name"
                                required
                            >

                        </div>


                        {{-- Email --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $admin->email) }}"
                                placeholder="Enter email address"
                                required
                            >

                        </div>


                        {{-- Phone --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Phone Number
                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone', $admin->phone) }}"
                                placeholder="+91 98765 43210"
                            >

                        </div>


                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check2-circle me-1"></i>
                            Save Changes
                        </button>

                    </form>

                </div>

            </div>

        </div>


        {{-- Account Information --}}
        <div class="col-lg-4">

            <div class="bd-content-card mb-4">

                <div class="bd-card-header">
                    <div>
                        <h5 class="mb-1">Account Information</h5>
                        <p class="text-muted mb-0">
                            Your administrator account details.
                        </p>
                    </div>
                </div>

                <div class="bd-card-body">

                    <div class="profile-info-item">
                        <span>Role</span>
                        <strong>
                            {{ ucfirst($admin->role) }}
                        </strong>
                    </div>

                    <div class="profile-info-item">
                        <span>Email</span>
                        <strong class="text-break">
                            {{ $admin->email }}
                        </strong>
                    </div>

                    <div class="profile-info-item">
                        <span>Member Since</span>
                        <strong>
                            {{ $admin->created_at?->format('d M Y') }}
                        </strong>
                    </div>

                </div>

            </div>


            {{-- Change Password --}}
            <div class="bd-content-card">

                <div class="bd-card-header">
                    <div>
                        <h5 class="mb-1">Change Password</h5>
                        <p class="text-muted mb-0">
                            Keep your admin account secure.
                        </p>
                    </div>
                </div>

                <div class="bd-card-body">

                    <form action="{{ route('admin.profile.password.update') }}"
                          method="POST">

                        @csrf
                        @method('PUT')

                        {{-- Current Password --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Current Password
                            </label>

                            <input
                                type="password"
                                name="current_password"
                                class="form-control"
                                placeholder="Current password"
                                required
                            >

                        </div>


                        {{-- New Password --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                New Password
                            </label>

                            <input
                                type="password"
                                name="new_password"
                                class="form-control"
                                placeholder="Minimum 8 characters"
                                required
                            >

                        </div>


                        {{-- Confirm Password --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Confirm New Password
                            </label>

                            <input
                                type="password"
                                name="new_password_confirmation"
                                class="form-control"
                                placeholder="Confirm new password"
                                required
                            >

                        </div>


                        <button type="submit" class="btn btn-dark w-100">
                            <i class="bi bi-shield-lock me-1"></i>
                            Change Password
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


<style>
    .admin-profile-preview,
    .admin-profile-placeholder {
        width: 76px;
        height: 76px;
        border-radius: 50%;
        object-fit: cover;
        flex-shrink: 0;
    }

    .admin-profile-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #4f46e5;
        color: #fff;
        font-size: 22px;
        font-weight: 700;
    }

    .profile-info-item {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        padding: 13px 0;
        border-bottom: 1px solid var(--bs-border-color);
    }

    .profile-info-item:first-child {
        padding-top: 0;
    }

    .profile-info-item:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .profile-info-item span {
        color: #6c757d;
        font-size: 14px;
    }

    .profile-info-item strong {
        text-align: right;
        font-size: 14px;
    }
</style>

@endsection
