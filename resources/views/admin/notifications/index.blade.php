@extends('admin.layouts.master')

@section('content')

<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">Notifications</h4>
            <p class="text-muted mb-0">
                Manage all system notifications.
            </p>
        </div>

        @if($notifications->where('is_read', false)->count() > 0)
            <form action="{{ route('admin.notifications.read-all') }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check2-all me-1"></i>
                    Mark All as Read
                </button>
            </form>
        @endif

    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- Notifications --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            @forelse($notifications as $notification)

                <div class="notification-item
                    d-flex align-items-start gap-3 p-4
                    border-bottom
                    {{ !$notification->is_read ? 'bg-light' : '' }}">

                    {{-- Icon --}}
                    <div class="notification-icon
                        d-flex align-items-center justify-content-center
                        rounded-circle">

                        @if($notification->type === 'booking')
                            <i class="bi bi-calendar-check"></i>

                        @elseif($notification->type === 'review')
                            <i class="bi bi-star"></i>

                        @elseif($notification->type === 'enquiry')
                            <i class="bi bi-chat-left-text"></i>

                        @elseif($notification->type === 'business')
                            <i class="bi bi-building"></i>

                        @else
                            <i class="bi bi-bell"></i>
                        @endif

                    </div>


                    {{-- Content --}}
                    <div class="flex-grow-1">

                        <div class="d-flex justify-content-between gap-3">

                            <div>

                                <h6 class="fw-semibold mb-1">
                                    {{ $notification->title }}

                                    @if(!$notification->is_read)
                                        <span class="badge bg-primary ms-2">
                                            New
                                        </span>
                                    @endif
                                </h6>

                                <p class="text-muted mb-2">
                                    {{ $notification->message }}
                                </p>

                                <small class="text-muted">
                                    <i class="bi bi-person me-1"></i>

                                    {{ $notification->user?->name ?? 'System' }}

                                    <span class="mx-2">•</span>

                                    {{ $notification->created_at->diffForHumans() }}
                                </small>

                            </div>


                            {{-- Action --}}
                            @if(!$notification->is_read)

                                <form
                                    action="{{ route('admin.notifications.read', $notification->id) }}"
                                    method="POST"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Mark as read"
                                    >
                                        <i class="bi bi-check2"></i>
                                    </button>

                                </form>

                            @endif

                        </div>

                    </div>

                </div>

            @empty

                <div class="text-center py-5">

                    <div class="mb-3">
                        <i class="bi bi-bell-slash fs-1 text-muted"></i>
                    </div>

                    <h6 class="fw-semibold">
                        No notifications
                    </h6>

                    <p class="text-muted mb-0">
                        There are no notifications to display.
                    </p>

                </div>

            @endforelse

        </div>

    </div>


    {{-- Pagination --}}
    @if($notifications->hasPages())

        <div class="mt-4">
            {{ $notifications->links() }}
        </div>

    @endif

</div>


<style>

.notification-item {
    transition: background-color .2s ease;
}

.notification-item:hover {
    background-color: #f8f9fa;
}

.notification-icon {
    width: 44px;
    height: 44px;
    min-width: 44px;
    background: #eef2ff;
    color: #4f46e5;
    font-size: 18px;
}

</style>

@endsection
