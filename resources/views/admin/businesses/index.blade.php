@extends('admin.layouts.master')

@section('title', 'Businesses')

@section('content')

<div class="container-fluid py-3">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Businesses</h4>

            <p class="text-muted mb-0">
                Manage all businesses listed in your directory.
            </p>
        </div>

        <a
            href="{{ route('admin.businesses.create') }}"
            class="btn btn-primary"
        >
            <i class="bi bi-plus-lg me-1"></i>
            Add Business
        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-bottom">

            <strong>
                All Businesses
            </strong>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>Sr.</th>

                            <th>Logo</th>

                            <th>Cover Image</th>

                            <th>Name</th>

                            <th>Business</th>

                            <th>Owner</th>

                            <th>Category</th>

                            <th>Location</th>

                            <th>Status</th>

                            <th width="180">Actions</th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($businesses as $business)

                            <tr>

                                {{-- Sr. --}}
                                <td>
                                    {{ $businesses->firstItem() + $loop->index }}
                                </td>


                                {{-- Logo --}}
                                <td>

                                    @if($business->logo)

                                        <img
                                            src="{{ asset('storage/' . $business->logo) }}"
                                            alt="{{ $business->name }}"
                                            width="55"
                                            height="55"
                                            class="rounded-3 border"
                                            style="object-fit: contain; background: #fff;"
                                        >

                                    @else

                                        <div
                                            class="rounded-3 border bg-light d-flex align-items-center justify-content-center"
                                            style="width: 55px; height: 55px;"
                                        >

                                            <i class="bi bi-building text-muted fs-5"></i>

                                        </div>

                                    @endif

                                </td>


                                {{-- Cover Image --}}
                                <td>

                                    @if($business->cover_image)

                                        <img
                                            src="{{ asset('storage/' . $business->cover_image) }}"
                                            alt="{{ $business->name }} Cover"
                                            width="100"
                                            height="55"
                                            class="rounded-3 border"
                                            style="object-fit: cover;"
                                        >

                                    @else

                                        <div
                                            class="rounded-3 border bg-light d-flex align-items-center justify-content-center"
                                            style="width: 100px; height: 55px;"
                                        >

                                            <i class="bi bi-image text-muted fs-5"></i>

                                        </div>

                                    @endif

                                </td>


                                {{-- Name --}}
                                <td>

                                    <div class="fw-semibold">
                                        {{ $business->name }}
                                    </div>

                                    @if($business->tagline)

                                        <small class="text-muted">
                                            {{ $business->tagline }}
                                        </small>

                                    @endif

                                </td>


                                {{-- Business --}}
                               {{-- Business --}}
<td>

    @if($business->description)

        <small class="text-muted">
            {{ Str::limit($business->description, 80) }}
        </small>

    @else

        <span class="text-muted">
            N/A
        </span>

    @endif

</td>


                                {{-- Owner --}}
                                <td>

                                    {{ $business->user?->name ?? 'N/A' }}

                                </td>


                                {{-- Category --}}
                                <td>

                                    <div class="fw-semibold">
                                        {{ $business->category?->name ?? 'N/A' }}
                                    </div>

                                    @if($business->subcategory)

                                        <small class="text-muted">
                                            {{ $business->subcategory->name }}
                                        </small>

                                    @endif

                                </td>


                                {{-- Location --}}
                                <td>

                                    @if($business->city)

                                        <div class="fw-semibold">
                                            {{ $business->city->name }}
                                        </div>

                                    @else

                                        <div class="fw-semibold">
                                            N/A
                                        </div>

                                    @endif


                                    @if($business->state)

                                        <small class="text-muted">
                                            {{ $business->state->name }}
                                        </small>

                                    @endif

                                </td>


                                {{-- Status --}}
                                <td>

                                    @if($business->status === 'approved')

                                        <span class="badge bg-success">
                                            Approved
                                        </span>

                                    @elseif($business->status === 'rejected')

                                        <span class="badge bg-danger">
                                            Rejected
                                        </span>

                                    @else

                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td>

                                    <div class="d-flex gap-1">

                                        {{-- View --}}
                                        <a
                                            href="{{ route('admin.businesses.show', $business) }}"
                                            class="btn btn-sm btn-outline-primary"
                                            title="View"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('admin.businesses.edit', $business) }}"
                                            class="btn btn-sm btn-outline-warning"
                                            title="Edit"
                                        >

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        {{-- Delete --}}
                                        <form
                                            action="{{ route('admin.businesses.destroy', $business) }}"
                                            method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this business?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
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
                                    colspan="10"
                                    class="text-center py-5"
                                >

                                    <div class="text-muted">

                                        <i
                                            class="bi bi-building fs-1 d-block mb-2"
                                        ></i>


                                        <div class="fw-semibold">
                                            No businesses found
                                        </div>


                                        <small>
                                            Add your first business.
                                        </small>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>
                </table>

            </div>

        </div>

        @if($businesses->hasPages())

            <div class="card-footer bg-white">

                {{ $businesses->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
