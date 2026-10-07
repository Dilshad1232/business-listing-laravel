@extends('admin.layouts.master')

@section('title', 'States')

@section('content')

<div class="container-fluid py-3">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">States</h4>

            <p class="text-muted mb-0">
                Manage states for your business directory.
            </p>
        </div>

        <a
            href="{{ route('admin.states.create') }}"
            class="btn btn-primary"
        >
            <i class="bi bi-plus-lg me-1"></i>
            Add State
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

        </div>

    @endif


    {{-- States Table --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-bottom">

            <div class="d-flex justify-content-between align-items-center">

                <strong>
                    All States
                </strong>

                <span class="text-muted small">
                    Total: {{ $states->total() }}
                </span>

            </div>

        </div>


        <div class="card-body p-0">

            @if($states->count())

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th>#</th>

                                <th>State</th>

                                <th>Country</th>

                                <th>Code</th>

                                <th>Status</th>

                                <th>Order</th>

                                <th class="text-end">
                                    Actions
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($states as $state)

                                <tr>

                                    {{-- Number --}}
                                    <td>
                                        {{ $states->firstItem() + $loop->index }}
                                    </td>


                                    {{-- State --}}
                                    <td>

                                        <div class="fw-semibold">
                                            {{ $state->name }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $state->slug }}
                                        </small>

                                    </td>


                                    {{-- Country --}}
                                    <td>

                                        @if($state->country)

                                            <span class="fw-semibold">
                                                {{ $state->country->name }}
                                            </span>

                                        @else

                                            <span class="text-muted">
                                                —
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Code --}}
                                    <td>

                                        @if($state->code)

                                            <span class="badge bg-light text-dark">
                                                {{ strtoupper($state->code) }}
                                            </span>

                                        @else

                                            —

                                        @endif

                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($state->status)

                                            <span class="badge bg-success">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Sort Order --}}
                                    <td>
                                        {{ $state->sort_order }}
                                    </td>


                                    {{-- Actions --}}
                                    <td>

                                        <div class="d-flex justify-content-end gap-1">

                                            {{-- View --}}
                                            <a
                                                href="{{ route('admin.states.show', $state) }}"
                                                class="btn btn-sm btn-light"
                                                title="View"
                                            >
                                                <i class="bi bi-eye"></i>
                                            </a>


                                            {{-- Edit --}}
                                            <a
                                                href="{{ route('admin.states.edit', $state) }}"
                                                class="btn btn-sm btn-light"
                                                title="Edit"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </a>


                                            {{-- Delete --}}
                                            <form
                                                action="{{ route('admin.states.destroy', $state) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this state?')"
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

                            @endforeach

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                <div class="p-3">

                    {{ $states->links() }}

                </div>

            @else

                {{-- Empty State --}}
                <div class="text-center py-5">

                    <i class="bi bi-map fs-1 text-muted"></i>

                    <h5 class="mt-3">
                        No States Found
                    </h5>

                    <p class="text-muted">
                        Add your first state to get started.
                    </p>

                    <a
                        href="{{ route('admin.states.create') }}"
                        class="btn btn-primary"
                    >
                        <i class="bi bi-plus-lg me-1"></i>
                        Add State
                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection
