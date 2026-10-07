@extends('admin.layouts.master')

@section('title', 'Subcategories')

@section('content')

<div class="bd-page-heading">

    <div>
        <h1 class="bd-page-title">
            Subcategories
        </h1>

        <div class="bd-page-subtitle">
            Manage all business subcategories.
        </div>
    </div>

    <a href="{{ route('admin.subcategories.create') }}"
       class="bd-add-btn">

        <i class="bi bi-plus-circle"></i>

        Add Subcategory

    </a>

</div>


{{-- Success Message --}}
@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif


{{-- Error Message --}}
@if(session('error'))

    <div class="alert alert-danger">
        {{ session('error') }}
    </div>

@endif


<div class="bd-content-card">

    <div class="bd-card-header">

        <div>

            <h5 class="bd-card-title">
                All Subcategories
            </h5>

            <small class="bd-muted">
                Manage your business subcategories.
            </small>

        </div>

    </div>


    <div class="bd-card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>

                    <tr>

                        <th class="ps-4">
                            #
                        </th>

                        <th>
                            Subcategory
                        </th>

                        <th>
                            Category
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Sort Order
                        </th>

                        <th class="text-end pe-4">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($subcategories as $subcategory)

                        <tr>

                            {{-- ID --}}
                            <td class="ps-4">
                                {{ $subcategory->id }}
                            </td>


                            {{-- Subcategory --}}
                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    @if($subcategory->image)

                                        <img
                                            src="{{ asset('storage/' . $subcategory->image) }}"
                                            alt="{{ $subcategory->name }}"
                                            width="48"
                                            height="48"
                                            style="object-fit:cover;border-radius:10px;"
                                        >

                                    @else

                                        <div
                                            class="d-flex align-items-center justify-content-center"
                                            style="
                                                width:48px;
                                                height:48px;
                                                border-radius:10px;
                                                background:#f1f5f9;
                                            "
                                        >

                                            <i class="bi bi-diagram-3 text-muted"></i>

                                        </div>

                                    @endif


                                    <div>

                                        <div class="fw-semibold">
                                            {{ $subcategory->name }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $subcategory->slug }}
                                        </small>

                                    </div>

                                </div>

                            </td>


                            {{-- Category --}}
                            <td>

                                @if($subcategory->category)

                                    <span class="fw-semibold">
                                        {{ $subcategory->category->name }}
                                    </span>

                                @else

                                    <span class="text-muted">
                                        No Category
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td>

                                @if($subcategory->status)

                                    <span class="badge bg-success-subtle text-success">
                                        Active
                                    </span>

                                @else

                                    <span class="badge bg-danger-subtle text-danger">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            {{-- Sort --}}
                            <td>
                                {{ $subcategory->sort_order ?? 0 }}
                            </td>


                            {{-- Actions --}}
                            <td class="text-end pe-4">

                                <div class="d-flex justify-content-end gap-2">


                                    {{-- Edit --}}
                                    <a
                                        href="{{ route('admin.subcategories.edit', $subcategory) }}"
                                        class="btn btn-sm btn-light border"
                                        title="Edit"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        action="{{ route('admin.subcategories.destroy', $subcategory) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this subcategory?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-light border text-danger"
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
                                colspan="6"
                                class="text-center py-5"
                            >

                                <div class="mb-3">

                                    <i
                                        class="bi bi-diagram-3"
                                        style="font-size:42px;color:#94a3b8;"
                                    ></i>

                                </div>

                                <h6 class="fw-semibold">
                                    No subcategories found
                                </h6>

                                <p class="text-muted mb-3">
                                    Start by creating your first subcategory.
                                </p>

                                <a
                                    href="{{ route('admin.subcategories.create') }}"
                                    class="btn btn-primary"
                                >

                                    <i class="bi bi-plus-circle me-1"></i>

                                    Add Subcategory

                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Pagination --}}
    @if($subcategories->hasPages())

        <div class="p-3 border-top">

            {{ $subcategories->links() }}

        </div>

    @endif

</div>

@endsection

