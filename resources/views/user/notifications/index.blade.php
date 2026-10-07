@extends('layouts.user.master')

@section('title', 'Notifications')

@section('content')

<div class="section-header mt-0">

    <div>
        <h4>Notifications</h4>

        <div class="business-location mt-1">
            Stay updated with your latest activities.
        </div>
    </div>

    @if($notifications->where('is_read', false)->count() > 0)

        <form action="{{ route('user.notifications.read-all') }}"
              method="POST">

            @csrf

            <button type="submit"
                    class="btn btn-sm btn-primary">

                <i class="bi bi-check2-all me-1"></i>
                Mark All as Read

            </button>

        </form>

    @endif

</div>


@if(session('success'))

    <div class="alert alert-success alert-dismissible fade show"
         role="alert">

        {{ session('success') }}

        <button type="button"
                class="btn-close"
                data-bs-dismiss="alert">
        </button>

    </div>

@endif


<div class="content-card">

    @forelse($notifications as $notification)

        <div class="notification-item
            {{ !$notification->is_read ? 'unread' : '' }}">

            <div class="d-flex align-items-start gap-3">

                {{-- Icon --}}
                <div class="notification-icon">

                    @if($notification->type === 'booking')

                        <i class="bi bi-calendar-check"></i>

                    @elseif($notification->type === 'enquiry')

                        <i class="bi bi-envelope"></i>

                    @elseif($notification->type === 'review')

                        <i class="bi bi-star"></i>

                    @elseif($notification->type === 'report')

                        <i class="bi bi-flag"></i>

                    @else

                        <i class="bi bi-bell"></i>

                    @endif

                </div>


                {{-- Content --}}
                <div class="flex-grow-1">

                    <div class="d-flex justify-content-between align-items-start gap-3">

                        <div>

                            <h6 class="fw-bold mb-1">

                                {{ $notification->title }}

                                @if(!$notification->is_read)

                                    <span class="notification-dot"></span>

                                @endif

                            </h6>


                            <p class="text-muted mb-2">

                                {{ $notification->message }}

                            </p>


                            <small class="text-muted">

                                <i class="bi bi-clock me-1"></i>

                                {{ $notification->created_at->diffForHumans() }}

                            </small>

                        </div>


                        @if(!$notification->is_read)

                            <form action="{{ route('user.notifications.read', $notification->id) }}"
                                  method="POST">

                                @csrf

                                <button type="submit"
                                        class="btn btn-sm btn-light border">

                                    <i class="bi bi-check2 me-1"></i>
                                    Mark as read

                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    @empty

        <div class="empty-state">

            <i class="bi bi-bell-slash"></i>

            <h6>No Notifications</h6>

            <p>You don't have any notifications yet.</p>

        </div>

    @endforelse

</div>


@if($notifications->hasPages())

    <div class="mt-4">

        {{ $notifications->links() }}

    </div>

@endif


<style>

.notification-item {
    padding: 20px 24px;
    border-bottom: 1px solid #eef0f3;
    transition: background 0.2s ease;
}

.notification-item:last-child {
    border-bottom: none;
}

.notification-item:hover {
    background: #fafafa;
}

.notification-item.unread {
    background: #fff8f2;
}

.notification-icon {
    width: 44px;
    height: 44px;
    min-width: 44px;
    border-radius: 12px;
    background: var(--primary-light);
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
}

.notification-dot {
    display: inline-block;
    width: 7px;
    height: 7px;
    margin-left: 5px;
    border-radius: 50%;
    background: var(--primary);
    vertical-align: middle;
}

@media (max-width: 576px) {

    .notification-item {
        padding: 16px;
    }

    .notification-item .d-flex.justify-content-between {
        flex-direction: column;
    }

    .notification-item form {
        margin-top: 4px;
    }

}

</style>

@endsection
