@extends('admin.layouts.master')

@section('content')

<div class="container-fluid py-4">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">

        <div>
            <h3 class="mb-1 fw-bold">
                Enquiries
            </h3>

            <p class="text-muted mb-0">
                Manage product and business enquiries
            </p>
        </div>

    </div>


    {{-- =========================================================
        STATISTICS
    ========================================================== --}}
    <div class="row g-3 mb-4">

        {{-- TOTAL --}}
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <p class="text-muted small mb-1">
                                Total Enquiries
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ number_format($stats['total']) }}
                            </h3>

                        </div>

                        <div
                            class="rounded-3 d-flex align-items-center justify-content-center"
                            style="
                                width:48px;
                                height:48px;
                                background:rgba(79,70,229,.10);
                                color:#4f46e5;
                            "
                        >

                            <i class="bi bi-inbox fs-5"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- NEW --}}
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <p class="text-muted small mb-1">
                                New
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ number_format($stats['new']) }}
                            </h3>

                        </div>

                        <div
                            class="rounded-3 d-flex align-items-center justify-content-center"
                            style="
                                width:48px;
                                height:48px;
                                background:rgba(13,110,253,.10);
                                color:#0d6efd;
                            "
                        >

                            <i class="bi bi-envelope fs-5"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- CONTACTED --}}
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <p class="text-muted small mb-1">
                                Contacted
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ number_format($stats['contacted']) }}
                            </h3>

                        </div>

                        <div
                            class="rounded-3 d-flex align-items-center justify-content-center"
                            style="
                                width:48px;
                                height:48px;
                                background:rgba(255,193,7,.12);
                                color:#d39e00;
                            "
                        >

                            <i class="bi bi-chat-dots fs-5"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- CLOSED --}}
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <p class="text-muted small mb-1">
                                Closed
                            </p>

                            <h3 class="fw-bold mb-0">
                                {{ number_format($stats['closed']) }}
                            </h3>

                        </div>

                        <div
                            class="rounded-3 d-flex align-items-center justify-content-center"
                            style="
                                width:48px;
                                height:48px;
                                background:rgba(25,135,84,.10);
                                color:#198754;
                            "
                        >

                            <i class="bi bi-check-circle fs-5"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- =========================================================
        FILTER CARD
    ========================================================== --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <form
                method="GET"
                action="{{ route('admin.enquiries.index') }}"
            >

                <div class="row g-3 align-items-end">

                    {{-- SEARCH --}}
                    <div class="col-lg-6 col-md-6">

                        <label class="form-label fw-semibold">
                            Search
                        </label>

                        <div class="input-group">

                            <span class="input-group-text bg-white">
                                <i class="bi bi-search"></i>
                            </span>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control"
                                placeholder="Name, email, phone, product or business..."
                            >

                        </div>

                    </div>


                    {{-- STATUS --}}
                    <div class="col-lg-3 col-md-3">

                        <label class="form-label fw-semibold">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select"
                        >

                            <option value="">
                                All Status
                            </option>

                            <option
                                value="new"
                                {{ request('status') === 'new' ? 'selected' : '' }}
                            >
                                New
                            </option>

                            <option
                                value="contacted"
                                {{ request('status') === 'contacted' ? 'selected' : '' }}
                            >
                                Contacted
                            </option>

                            <option
                                value="closed"
                                {{ request('status') === 'closed' ? 'selected' : '' }}
                            >
                                Closed
                            </option>

                        </select>

                    </div>


                    {{-- BUTTONS --}}
                    <div class="col-lg-3 col-md-3">

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >

                                <i class="bi bi-funnel me-1"></i>

                                Filter

                            </button>


                            <a
                                href="{{ route('admin.enquiries.index') }}"
                                class="btn btn-light"
                            >

                                <i class="bi bi-arrow-counterclockwise me-1"></i>

                                Reset

                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>



    {{-- =========================================================
        ENQUIRIES TABLE
    ========================================================== --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th class="px-4">
                                #
                            </th>

                            <th>
                                Customer
                            </th>

                            <th>
                                Product
                            </th>

                            <th>
                                Business
                            </th>

                            <th>
                                Message
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Date
                            </th>

                            <th class="text-end px-4">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($enquiries as $enquiry)

                            <tr>

                                {{-- ID --}}
                                <td class="px-4">

                                    <span class="text-muted">
                                        #{{ $enquiry->id }}
                                    </span>

                                </td>


                                {{-- CUSTOMER --}}
                                <td>

                                    <div class="d-flex align-items-center gap-3">

                                        <div
                                            class="rounded-circle d-flex
                                                   align-items-center
                                                   justify-content-center
                                                   fw-bold text-white"
                                            style="
                                                width:42px;
                                                height:42px;
                                                background:#4f46e5;
                                            "
                                        >

                                            {{ strtoupper(
                                                substr($enquiry->name, 0, 1)
                                            ) }}

                                        </div>


                                        <div>

                                            <div class="fw-semibold">

                                                {{ $enquiry->name }}

                                            </div>

                                            <small class="text-muted">

                                                {{ $enquiry->email }}

                                            </small>

                                            @if($enquiry->phone)

                                                <div>

                                                    <small class="text-muted">

                                                        {{ $enquiry->phone }}

                                                    </small>

                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- PRODUCT --}}
                                <td>

                                    @if($enquiry->product)

                                        <div class="fw-semibold">

                                            {{ $enquiry->product->name }}

                                        </div>

                                        <small class="text-muted">

                                            Product #{{ $enquiry->product->id }}

                                        </small>

                                    @else

                                        <span class="text-muted">
                                            General Enquiry
                                        </span>

                                    @endif

                                </td>


                                {{-- BUSINESS --}}
                                <td>

                                    @if($enquiry->business)

                                        <div class="fw-semibold">

                                            {{ $enquiry->business->name }}

                                        </div>

                                    @else

                                        <span class="text-muted">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- MESSAGE --}}
                                <td style="min-width:220px; max-width:300px;">

                                    <div
                                        class="text-muted small"
                                        style="
                                            display:-webkit-box;
                                            -webkit-line-clamp:2;
                                            -webkit-box-orient:vertical;
                                            overflow:hidden;
                                        "
                                    >

                                        {{ $enquiry->message }}

                                    </div>

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($enquiry->status === 'new')

                                        <span class="badge bg-primary">
                                            <i class="bi bi-envelope me-1"></i>
                                            New
                                        </span>

                                    @elseif($enquiry->status === 'contacted')

                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-chat-dots me-1"></i>
                                            Contacted
                                        </span>

                                    @elseif($enquiry->status === 'closed')

                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Closed
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            {{ ucfirst($enquiry->status) }}
                                        </span>

                                    @endif

                                </td>


                                {{-- DATE --}}
                                <td>

                                    <div class="fw-semibold small">

                                        {{ $enquiry->created_at->format('d M Y') }}

                                    </div>

                                    <small class="text-muted">

                                        {{ $enquiry->created_at->format('h:i A') }}

                                    </small>

                                </td>


                                {{-- ACTION --}}
                                <td class="text-end px-4">

                                    <div class="d-inline-flex gap-1">

                                        {{-- VIEW --}}
                                        <a
                                            href="{{ route(
                                                'admin.enquiries.show',
                                                $enquiry
                                            ) }}"
                                            class="btn btn-sm btn-light"
                                            title="View Enquiry"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        {{-- DELETE --}}
                                        <form
                                            action="{{ route(
                                                'admin.enquiries.destroy',
                                                $enquiry
                                            ) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm(
                                                'Are you sure you want to delete this enquiry?'
                                            );"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-light text-danger"
                                                title="Delete"
                                            >

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center py-5"
                                >

                                    <div class="mb-3">

                                        <div
                                            class="mx-auto rounded-3
                                                   d-flex align-items-center
                                                   justify-content-center"
                                            style="
                                                width:64px;
                                                height:64px;
                                                background:#f1f3f5;
                                            "
                                        >

                                            <i
                                                class="bi bi-inbox fs-2 text-muted"
                                            ></i>

                                        </div>

                                    </div>


                                    <h6 class="mb-1">
                                        No Enquiries Found
                                    </h6>


                                    <p class="text-muted mb-0">

                                        Product enquiries submitted by
                                        customers will appear here.

                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- =========================================================
            PAGINATION
        ========================================================== --}}
        @if($enquiries->hasPages())

            <div class="card-footer bg-white border-0 py-3">

                {{ $enquiries->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
