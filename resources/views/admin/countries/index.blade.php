@extends('admin.layouts.master')

@section('title', 'Countries')

@section('content')

<div class="container-fluid py-3">

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h4 class="mb-1">Countries</h4>

        <p class="text-muted mb-0">
            Manage countries for your business directory.
        </p>
    </div>

    <a
        href="{{ route('admin.countries.create') }}"
        class="btn btn-primary"
    >
        <i class="bi bi-plus-lg me-1"></i>
        Add Country
    </a>

</div>


{{-- Messages --}}
@if(session('success'))

    <div class="alert alert-success">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
    </div>

@endif


{{-- Countries Card --}}
<div class="card border-0 shadow-sm">

    <div class="card-header bg-white border-bottom">

        <div class="d-flex justify-content-between align-items-center">

            <strong>
                All Countries
            </strong>

            <span class="text-muted small">
                Total: {{ $countries->total() }}
            </span>

        </div>

    </div>


    <div class="card-body p-0">

        @if($countries->count())

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>#</th>

                            <th>Country</th>

                            <th>Code</th>

                            <th>Phone Code</th>

                            <th>Status</th>

                            <th>Order</th>

                            <th class="text-end">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($countries as $country)

                            <tr>

                                <td>
                                    {{ $countries->firstItem() + $loop->index }}
                                </td>


                                <td>

                                    <div class="fw-semibold">
                                        {{ $country->name }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $country->slug }}
                                    </small>

                                </td>


                                <td>

                                    @if($country->code)

                                        <span class="badge bg-light text-dark">
                                            {{ strtoupper($country->code) }}
                                        </span>

                                    @else

                                        —

                                    @endif

                                </td>


                                <td>
                                    {{ $country->phone_code ?: '—' }}
                                </td>


                                <td>

                                    @if($country->status)

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
                                    {{ $country->sort_order }}
                                </td>


                                <td>

                                    <div class="d-flex justify-content-end gap-1">

                                        {{-- View --}}
                                        <a
                                            href="{{ route('admin.countries.show', $country) }}"
                                            class="btn btn-sm btn-light"
                                            title="View"
                                        >
                                            <i class="bi bi-eye"></i>
                                        </a>


                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('admin.countries.edit', $country) }}"
                                            class="btn btn-sm btn-light"
                                            title="Edit"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- Delete --}}
                                        <form
                                            action="{{ route('admin.countries.destroy', $country) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this country?')"
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

                {{ $countries->links() }}

            </div>


        @else

            <div class="text-center py-5">

                <i class="bi bi-globe2 fs-1 text-muted"></i>

                <h5 class="mt-3">
                    No Countries Found
                </h5>

                <p class="text-muted">
                    Add your first country to get started.
                </p>

                <a
                    href="{{ route('admin.countries.create') }}"
                    class="btn btn-primary"
                >
                    <i class="bi bi-plus-lg me-1"></i>
                    Add Country
                </a>

            </div>

        @endif

    </div>

</div>


</div>

@endsection
