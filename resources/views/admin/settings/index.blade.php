@extends('admin.layouts.master')

@section('content')

<div class="container-fluid py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="mb-1 fw-bold">
            Website Settings
        </h3>

        <p class="text-muted mb-0">
            Manage your website information, contact details, social links and SEO settings.
        </p>
    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- VALIDATION ERRORS --}}
    @if($errors->any())

        <div class="alert alert-danger">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form action="{{ route('admin.settings.update') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')


        {{-- GENERAL SETTINGS --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-0 py-3">

                <h5 class="mb-1 fw-bold">
                    <i class="bi bi-globe2 me-2 text-primary"></i>
                    General Settings
                </h5>

                <small class="text-muted">
                    Basic website information
                </small>

            </div>


            <div class="card-body">

                <div class="row g-4">

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Website Name
                        </label>

                        <input
                            type="text"
                            name="website_name"
                            class="form-control"
                            value="{{ old('website_name', $settings->website_name) }}"
                            placeholder="Lokora"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Tagline
                        </label>

                        <input
                            type="text"
                            name="tagline"
                            class="form-control"
                            value="{{ old('tagline', $settings->tagline) }}"
                            placeholder="Discover, Connect, Explore"
                        >

                    </div>


                    {{-- LOGO --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Website Logo
                        </label>

                        <input
                            type="file"
                            name="logo"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.webp"
                        >

                        @if($settings->logo)

                            <div class="mt-3">

                                <img
                                    src="{{ asset('storage/' . $settings->logo) }}"
                                    alt="Website Logo"
                                    style="max-height:70px;"
                                    class="border rounded p-2"
                                >

                            </div>

                        @endif

                    </div>


                    {{-- FAVICON --}}
                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Favicon
                        </label>

                        <input
                            type="file"
                            name="favicon"
                            class="form-control"
                            accept=".jpg,.jpeg,.png,.ico,.webp"
                        >

                        @if($settings->favicon)

                            <div class="mt-3">

                                <img
                                    src="{{ asset('storage/' . $settings->favicon) }}"
                                    alt="Website Favicon"
                                    style="width:48px;height:48px;"
                                    class="border rounded p-2"
                                >

                            </div>

                        @endif

                    </div>

                </div>

            </div>

        </div>


        {{-- CONTACT SETTINGS --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-0 py-3">

                <h5 class="mb-1 fw-bold">
                    <i class="bi bi-telephone me-2 text-primary"></i>
                    Contact Settings
                </h5>

                <small class="text-muted">
                    Contact information displayed across the website
                </small>

            </div>


            <div class="card-body">

                <div class="row g-4">

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Email Address
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email', $settings->email) }}"
                            placeholder="hello@example.com"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Phone Number
                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            value="{{ old('phone', $settings->phone) }}"
                            placeholder="+91 98765 43210"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            WhatsApp Number
                        </label>

                        <input
                            type="text"
                            name="whatsapp"
                            class="form-control"
                            value="{{ old('whatsapp', $settings->whatsapp) }}"
                            placeholder="+91 98765 43210"
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Address
                        </label>

                        <textarea
                            name="address"
                            rows="3"
                            class="form-control"
                            placeholder="Website business address"
                        >{{ old('address', $settings->address) }}</textarea>

                    </div>

                </div>

            </div>

        </div>


        {{-- SOCIAL MEDIA --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-0 py-3">

                <h5 class="mb-1 fw-bold">
                    <i class="bi bi-share me-2 text-primary"></i>
                    Social Media
                </h5>

                <small class="text-muted">
                    Add your official social media profiles
                </small>

            </div>


            <div class="card-body">

                <div class="row g-4">

                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Facebook
                        </label>

                        <input
                            type="url"
                            name="facebook"
                            class="form-control"
                            value="{{ old('facebook', $settings->facebook) }}"
                            placeholder="https://facebook.com/..."
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            Instagram
                        </label>

                        <input
                            type="url"
                            name="instagram"
                            class="form-control"
                            value="{{ old('instagram', $settings->instagram) }}"
                            placeholder="https://instagram.com/..."
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            YouTube
                        </label>

                        <input
                            type="url"
                            name="youtube"
                            class="form-control"
                            value="{{ old('youtube', $settings->youtube) }}"
                            placeholder="https://youtube.com/..."
                        >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label fw-semibold">
                            LinkedIn
                        </label>

                        <input
                            type="url"
                            name="linkedin"
                            class="form-control"
                            value="{{ old('linkedin', $settings->linkedin) }}"
                            placeholder="https://linkedin.com/..."
                        >

                    </div>

                </div>

            </div>

        </div>


        {{-- SEO SETTINGS --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-0 py-3">

                <h5 class="mb-1 fw-bold">
                    <i class="bi bi-search me-2 text-primary"></i>
                    SEO Settings
                </h5>

                <small class="text-muted">
                    Default search engine optimization information
                </small>

            </div>


            <div class="card-body">

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Meta Title
                    </label>

                    <input
                        type="text"
                        name="meta_title"
                        class="form-control"
                        value="{{ old('meta_title', $settings->meta_title) }}"
                        placeholder="Lokora - Discover Local Businesses"
                    >

                </div>


                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Meta Description
                    </label>

                    <textarea
                        name="meta_description"
                        rows="4"
                        class="form-control"
                        placeholder="Describe your website for search engines..."
                    >{{ old('meta_description', $settings->meta_description) }}</textarea>

                </div>


                <div>

                    <label class="form-label fw-semibold">
                        Meta Keywords
                    </label>

                    <textarea
                        name="meta_keywords"
                        rows="3"
                        class="form-control"
                        placeholder="business directory, local businesses, restaurants..."
                    >{{ old('meta_keywords', $settings->meta_keywords) }}</textarea>

                </div>

            </div>

        </div>


        {{-- FOOTER --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-header bg-white border-0 py-3">

                <h5 class="mb-1 fw-bold">
                    <i class="bi bi-layout-text-window-reverse me-2 text-primary"></i>
                    Footer Settings
                </h5>

                <small class="text-muted">
                    Website footer information
                </small>

            </div>


            <div class="card-body">

                <label class="form-label fw-semibold">
                    Copyright Text
                </label>

                <textarea
                    name="copyright_text"
                    rows="2"
                    class="form-control"
                    placeholder="© 2026 Lokora. All rights reserved."
                >{{ old('copyright_text', $settings->copyright_text) }}</textarea>

            </div>

        </div>


        {{-- SAVE BUTTON --}}
        <div class="d-flex justify-content-end mb-4">

            <button type="submit"
                    class="btn btn-primary px-4">

                <i class="bi bi-check-lg me-1"></i>

                Save Settings

            </button>

        </div>

    </form>

</div>

@endsection