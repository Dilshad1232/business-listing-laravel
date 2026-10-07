@extends('admin.layouts.master')

@section('title', 'Areas')

@section('content')

<div class="container-fluid py-3">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Areas</h4>

            <p class="text-muted mb-0">
                Manage areas of your business directory.
            </p>
        </div>

        <a
            href="{{ route('admin.areas.create') }}"
            class="btn btn-primary"
        >
            <i class="bi bi-plus-lg me-1"></i>
            Add Area
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
                All Areas
            </strong>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>

                            <th>Area</th>

                            <th>City</th>

                            <th>State</th>

                            <th>Country</th>

                            <th>Status</th>

                            <th width="180">Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($areas as $area)

                            <tr>

                                <td>
                                    {{ $areas->firstItem() + $loop->index }}
                                </td>

                                <td>

                                    <div class="fw-semibold">
                                        {{ $area->name }}
                                    </div>

                                    @if($area->code)

                                        <small class="text-muted">
                                            {{ $area->code }}
                                        </small>

                                    @endif

                                </td>

                                <td>
                                    {{ $area->city?->name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $area->state?->name ?? 'N/A' }}
                                </td>

                                <td>
                                    {{ $area->country?->name ?? 'N/A' }}
                                </td>

                                <td>

                                    @if($area->status)

                                        <span class="badge bg-success">
                                            Active
                                        </span>

                                    @else

                                        <span class="badge bg-secondary">
                                            Inactive
                                        </span>

                                    @endif

                                </td>

                                <td>

                                    <a
                                        href="{{ route('admin.areas.show', $area) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="View"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a
                                        href="{{ route('admin.areas.edit', $area) }}"
                                        class="btn btn-sm btn-outline-warning"
                                        title="Edit"
                                    >
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form
                                        action="{{ route('admin.areas.destroy', $area) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this area?');"
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

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="7"
                                    class="text-center py-5"
                                >

                                    <div class="text-muted">

                                        <i
                                            class="bi bi-geo-alt fs-1 d-block mb-2"
                                        ></i>

                                        <div class="fw-semibold">
                                            No areas found
                                        </div>

                                        <small>
                                            Add your first area.
                                        </small>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        @if($areas->hasPages())

            <div class="card-footer bg-white">

                {{ $areas->links() }}

            </div>

        @endif

    </div>

</div>

@endsection
