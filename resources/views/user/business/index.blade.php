@extends('layouts.user.master')

@section('title', 'My Businesses')

@section('content')

<div class="section-header mt-0">

    <div>
        <h4>My Businesses</h4>

        <div class="business-location mt-1">
            Manage your business listings
        </div>
    </div>

    <a href="{{ route('user.businesses.create') }}"
       class="btn btn-sm btn-primary">

        <i class="bi bi-plus-lg me-1"></i>
        Add Business

    </a>

</div>


<div class="content-card">

    <div class="table-wrapper">

        @if($businesses->count() > 0)

            <table class="custom-table">

                <thead>
                    <tr>

                        <th>Business</th>

                        <th>Category</th>

                        <th>Location</th>

                        <th>Status</th>

                        <th>Action</th>

                    </tr>
                </thead>


                <tbody>

                    @foreach($businesses as $business)

                        <tr>

                            {{-- Business --}}
                            <td>

                                <div class="business-name">
                                    {{ $business->name }}
                                </div>

                                @if($business->email)

                                    <div class="business-location">
                                        {{ $business->email }}
                                    </div>

                                @endif

                            </td>


                            {{-- Category --}}
                            <td>

                                {{ $business->category->name ?? '—' }}

                            </td>


                            {{-- Location --}}
                            <td>

                                <div class="business-location">

                                    <i class="bi bi-geo-alt me-1"></i>

                                    {{ $business->city->name ?? '—' }}

                                    @if($business->state)

                                        , {{ $business->state->name }}

                                    @endif

                                </div>

                            </td>


                            {{-- Status --}}
                            <td>

                                @if($business->status === 'approved')

                                    <span class="status status-approved">

                                        <i class="bi bi-check-circle-fill"></i>
                                        Approved

                                    </span>

                                @elseif($business->status === 'rejected')

                                    <span class="status status-rejected">

                                        <i class="bi bi-x-circle-fill"></i>
                                        Rejected

                                    </span>

                                @else

                                    <span class="status status-pending">

                                        <i class="bi bi-clock-fill"></i>
                                        Pending

                                    </span>

                                @endif

                            </td>


                            {{-- Action --}}
                            <td>

                                <div class="d-flex gap-2">

                                    <a href="{{ route('user.businesses.show', $business) }}"
                                    class="btn btn-sm btn-light"
                                    title="View">

                                     <i class="bi bi-eye"></i>

                                 </a>

                                    <a href="{{ route('user.businesses.edit', $business) }}"
                                    class="btn btn-sm btn-light"
                                    title="Edit">

                                     <i class="bi bi-pencil"></i>

                                 </a>
                                 <form action="{{ route('user.businesses.destroy', $business) }}"
                                 method="POST"
                                 class="d-inline"
                                 onsubmit="return confirm('Are you sure you want to delete this business? This action cannot be undone.')">

                               @csrf
                               @method('DELETE')

                               <button type="submit"
                                       class="btn btn-sm btn-outline-danger"
                                       title="Delete Business">

                                   <i class="bi bi-trash"></i>

                               </button>

                           </form>
                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>


            {{-- Pagination --}}
            @if($businesses->hasPages())

                <div class="mt-4">

                    {{ $businesses->links() }}

                </div>

            @endif


        @else

            <div class="empty-state">

                <i class="bi bi-buildings"></i>

                <h6>
                    No Businesses Found
                </h6>

                <p>
                    You haven't added any business yet.
                </p>

                <a href="{{ route('user.businesses.create') }}"
                   class="btn btn-sm btn-primary mt-3">

                    <i class="bi bi-plus-lg me-1"></i>
                    Add Your First Business

                </a>

            </div>

        @endif

    </div>

</div>

@endsection
