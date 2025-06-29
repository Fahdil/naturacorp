@extends('layouts.app')

@section('content')
<style>
    .notification-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem 1rem;

    }

    .notification-header {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .notification-header h2 {
        margin: 0;
        font-size: 1.8rem;
    }

    .btn {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        transition: background 0.2s ease-in-out;
    }

    .btn-primary {
        background-color: #007BFF;
        color: white;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background-color: #565e64;
    }

    .notification-card {
        background-color: white;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .notification-item {
        padding: 1rem;
        border-bottom: 1px solid #eee;
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notification-unread {
        background-color: #f9f9f9;
    }

    .notification-time {
        font-size: 0.8rem;
        color: #888;
        margin-top: 0.25rem;
    }

    .notification-actions {
        margin-top: 0.75rem;
    }

    @media (max-width: 600px) {
        .notification-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .btn {
            width: 100%;
        }

        .notification-actions {
            text-align: right;
        }
    }
</style>

<div class="notification-container">
    <div class="notification-header">
        <h2>📬 Mes notifications</h2>
        <form method="POST" action="{{ route('notifications.readAll') }}">
            @csrf
            <button class="btn btn-primary">Tout marquer comme lu</button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="margin-bottom: 1rem; color: green;">
            {{ session('success') }}
        </div>
    @endif

    <div class="notification-card">
        @forelse($notifications as $notification)
            <div class="notification-item {{ is_null($notification->read_at) ? 'notification-unread' : '' }}">
                <div>{{ $notification->data['message'] }}</div>
                <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>

                @if(is_null($notification->read_at))
                    <div class="notification-actions">
                        <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                            @csrf
                            <button class="btn btn-secondary">Marquer comme lu</button>
                        </form>
                    </div>
                @endif
            </div>
        @empty
            <div class="notification-item text-center">
                Aucune notification.
            </div>
        @endforelse
    </div>
</div>
@endsection
