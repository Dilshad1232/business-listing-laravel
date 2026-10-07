@extends('admin.layouts.master')

@section('title', 'All Categories')

@section('content')

    {{-- PAGE HEADER --}}
    <div class="bd-page-heading">

        <div>
            <h1 class="bd-page-title">
                Categories
            </h1>

            <div class="bd-page-subtitle">
                Manage all business categories from here.
            </div>
        </div>

        <a href="{{ route('admin.categories.create') }}" class="bd-add-btn">
            <i class="bi bi-plus-lg"></i>
            Add Category
        </a>

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- VALIDATION ERRORS --}}
    @if($errors->any())

        <div class="alert alert-danger mb-4">

            <strong>Please fix the following errors:</strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- CATEGORY TABLE --}}
    <div class="bd-content-card">

        <div class="bd-card-header">

            <div>

                <h5 class="bd-card-title">
                    All Categories
                </h5>

                <small class="bd-muted">
                    Total Categories: {{ $categories->total() }}
                </small>

            </div>

        </div>


        <div class="bd-card-body p-0">

            <div class="table-responsive">

                <table class="bd-table">

                    <thead>

                        <tr>

                            <th>
                                #
                            </th>

                            <th>
                                Category
                            </th>

                            <th>
                                Slug
                            </th>

                            <th>
                                Subcategories
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Sort Order
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($categories as $category)

                            <tr>

                                {{-- ID --}}
                                <td>
                                    {{ $category->id }}
                                </td>


                                {{-- CATEGORY --}}
                                <td>

                                    <div class="bd-business">

                                        <div class="bd-business-img">

                                            @if($category->icon)

                                                <i class="{{ $category->icon }}"></i>

                                            @else

                                                <i class="bi bi-folder2-open"></i>

                                            @endif

                                        </div>


                                        <div>

                                            <div class="bd-business-name">
                                                {{ $category->name }}
                                            </div>

                                            @if($category->short_description)

                                                <div class="bd-business-cat">

                                                    {{ Str::limit($category->short_description, 45) }}

                                                </div>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- SLUG --}}
                                <td>

                                    <span class="bd-muted">
                                        {{ $category->slug }}
                                    </span>

                                </td>


                                {{-- SUBCATEGORIES --}}
                                <td>

                                    <span class="badge bg-light text-dark">

                                        {{ $category->subcategories_count }}

                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($category->status)

                                        <span class="bd-status bd-status-active">
                                            Active
                                        </span>

                                    @else

                                        <span class="bd-status bd-status-rejected">
                                            Inactive
                                        </span>

                                    @endif

                                </td>


                                {{-- SORT ORDER --}}
                                <td>

                                    {{ $category->sort_order }}

                                </td>


                                {{-- ACTION --}}
                                <td>

                                    <div class="d-flex gap-1">

                                        {{-- EDIT --}}
                                        <a
                                            href="{{ route('admin.categories.edit', $category) }}"
                                            class="btn btn-sm btn-light"
                                            title="Edit Category"
                                        >
                                            <i class="bi bi-pencil"></i>
                                        </a>


                                        {{-- DELETE --}}
                                        <form
                                            action="{{ route('admin.categories.destroy', $category) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this category?');"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-light text-danger"
                                                title="Delete Category"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-5">

                                    <div class="text-muted">

                                        <i
                                            class="bi bi-folder-x"
                                            style="font-size:35px;"
                                        ></i>

                                        <div class="mt-2">
                                            No categories found.
                                        </div>

                                        <a
                                            href="{{ route('admin.categories.create') }}"
                                            class="bd-add-btn mt-3"
                                        >
                                            <i class="bi bi-plus-lg"></i>
                                            Add First Category
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        {{-- PAGINATION --}}
        @if($categories->hasPages())

            <div class="p-3 border-top">

                {{ $categories->links() }}

            </div>

        @endif

    </div>

@endsection
