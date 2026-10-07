@extends('admin.layouts.master')

@section('title', 'Home Sliders')

@section('content')

<div class="container-fluid py-4">

    {{-- PAGE HEADER --}}
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">

        <div>
            <h1 class="h3 fw-bold mb-1">
                Home Sliders
            </h1>

            <p class="text-muted mb-0">
                Manage homepage hero sliders and promotional content.
            </p>
        </div>

        <a
            href="{{ route('admin.home-sliders.create') }}"
            class="btn btn-primary d-inline-flex align-items-center gap-2"
        >
            <i class="bi bi-plus-lg"></i>
            Add Slider
        </a>

    </div>


    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))

        <div
            class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2"
            role="alert"
        >

            <i class="bi bi-check-circle-fill"></i>

            <span>{{ session('success') }}</span>

            <button
                type="button"
                class="btn-close ms-auto"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    {{-- SLIDERS --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 py-3 px-4">

            <div class="d-flex align-items-center justify-content-between">

                <div>

                    <h5 class="mb-1 fw-bold">
                        All Home Sliders
                    </h5>

                    <p class="text-muted small mb-0">
                        Manage homepage hero slider content.
                    </p>

                </div>

                <span class="badge text-bg-light border">
                    {{ $sliders->count() }} Records
                </span>

            </div>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th class="px-4">
                            Slider
                        </th>

                        <th>
                            Background
                        </th>

                        <th>
                            Order
                        </th>

                        <th>
                            Status
                        </th>

                        <th class="text-end px-4">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($sliders as $slider)

                        <tr>

                            {{-- SLIDER --}}
                            <td class="px-4">

                                <div class="d-flex align-items-start gap-3">

                                    <div
                                        class="rounded-3 bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center flex-shrink-0"
                                        style="width:46px;height:46px;"
                                    >
                                        <i class="bi bi-images fs-5"></i>
                                    </div>

                                    <div>

                                        <div class="fw-semibold">
                                            {{ $slider->title }}

                                            @if($slider->highlight)
                                                <span class="text-primary">
                                                    {{ $slider->highlight }}
                                                </span>
                                            @endif
                                        </div>

                                        @if($slider->badge)

                                            <div class="small text-muted mt-1">
                                                {{ $slider->badge }}
                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- BACKGROUND --}}
                            <td>

                                @if($slider->background_image)

                                    <img
                                        src="{{ asset('storage/' . $slider->background_image) }}"
                                        alt="{{ $slider->title }}"
                                        class="rounded-3"
                                        style="width:100px;height:55px;object-fit:cover;"
                                    >

                                @else

                                    <span class="text-muted">
                                        No Image
                                    </span>

                                @endif

                            </td>


                            {{-- ORDER --}}
                            <td>

                                <span class="badge bg-light text-dark border">
                                    {{ $slider->sort_order }}
                                </span>

                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if($slider->status)

                                    <span class="badge bg-success-subtle text-success border border-success-subtle">
                                        Active
                                    </span>

                                @else

                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">
                                        Inactive
                                    </span>

                                @endif

                            </td>


      {{-- ACTIONS --}}
<td class="text-end px-4">

    <div class="d-inline-flex align-items-center gap-2">

        {{-- VIEW --}}
        <a
            href="{{ route('admin.home-sliders.show', $slider) }}"
            class="btn btn-sm btn-outline-info"
            title="View Slider"
        >
            <i class="bi bi-eye"></i>
        </a>

        {{-- EDIT --}}
        <a
            href="{{ route('admin.home-sliders.edit', $slider) }}"
            class="btn btn-sm btn-outline-primary"
            title="Edit Slider"
        >
            <i class="bi bi-pencil"></i>
        </a>

        {{-- DELETE --}}
        <form
            action="{{ route('admin.home-sliders.destroy', $slider) }}"
            method="POST"
            class="d-inline"
            onsubmit="return confirm('Are you sure you want to delete this slider?');"
        >
            @csrf
            @method('DELETE')

            <button
                type="submit"
                class="btn btn-sm btn-outline-danger"
                title="Delete Slider"
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
                                colspan="5"
                                class="text-center py-5"
                            >

                                <div
                                    class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center mx-auto mb-3"
                                    style="width:64px;height:64px;"
                                >

                                    <i class="bi bi-images fs-3"></i>

                                </div>


                                <h5 class="fw-bold mb-2">
                                    No Home Sliders Found
                                </h5>


                                <p class="text-muted mb-3">
                                    Create your first homepage slider.
                                </p>


                                <a
                                    href="{{ route('admin.home-sliders.create') }}"
                                    class="btn btn-primary"
                                >

                                    <i class="bi bi-plus-lg me-1"></i>

                                    Add First Slider

                                </a>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
