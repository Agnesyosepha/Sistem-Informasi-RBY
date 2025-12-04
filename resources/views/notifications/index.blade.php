@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Notifikasi</h4>
                    <button id="mark-all-read" class="btn btn-sm btn-outline-primary">
                        Tandai Semua Dibaca
                    </button>
                </div>
                <div class="card-body">
                    @if($notifications->count() > 0)
                        <div class="notification-list">
                            @foreach($notifications as $notification)
                                <div class="notification-item {{ $notification->is_read ? 'read' : 'unread' }}" data-id="{{ $notification->id }}">
                                    <div class="notification-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-1">
                                            @if($notification->type == 'success')
                                                <i class="fas fa-check-circle text-success"></i>
                                            @elseif($notification->type == 'warning')
                                                <i class="fas fa-exclamation-triangle text-warning"></i>
                                            @elseif($notification->type == 'error')
                                                <i class="fas fa-times-circle text-danger"></i>
                                            @else
                                                <i class="fas fa-info-circle text-info"></i>
                                            @endif
                                            {{ $notification->title }}
                                        </h5>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-2">{{ $notification->message }}</p>
                                    @if($notification->tugas_harian_id)
                                        <a href="{{ route('admin') }}" class="btn btn-sm btn-outline-primary">
                                            Lihat Detail Tugas
                                        </a>
                                    @endif
                                    @if(!$notification->is_read)
                                        <button class="btn btn-sm btn-outline-secondary mark-read" data-id="{{ $notification->id }}">
                                            Tandai Dibaca
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="d-flex justify-content-center mt-3">
                            {{ $notifications->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                            <h5>Belum Ada Notifikasi</h5>
                            <p class="text-muted">Anda tidak memiliki notifikasi saat ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mark as read
    document.querySelectorAll('.mark-read').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            
            fetch(`/notifications/${id}/mark-as-read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const notificationItem = this.closest('.notification-item');
                    notificationItem.classList.remove('unread');
                    notificationItem.classList.add('read');
                    this.remove();
                    
                    // Update unread count
                    updateUnreadCount();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
    
    // Mark all as read
    document.getElementById('mark-all-read').addEventListener('click', function() {
        fetch('/notifications/mark-all-as-read', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelectorAll('.notification-item').forEach(item => {
                    item.classList.remove('unread');
                    item.classList.add('read');
                });
                
                document.querySelectorAll('.mark-read').forEach(button => {
                    button.remove();
                });
                
                // Update unread count
                updateUnreadCount();
            }
        })
        .catch(error => console.error('Error:', error));
    });
    
    // Function to update unread count
    function updateUnreadCount() {
        fetch('/notifications/unread-count', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            const badge = document.querySelector('.notification-badge');
            if (badge) {
                if (data.count > 0) {
                    badge.textContent = data.count;
                    badge.style.display = 'inline-block';
                } else {
                    badge.style.display = 'none';
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }
});
</script>

<style>
.notification-item {
    padding: 15px;
    border-bottom: 1px solid #eee;
    transition: background-color 0.2s;
}

.notification-item:last-child {
    border-bottom: none;
}

.notification-item.unread {
    background-color: #f8f9fa;
    border-left: 4px solid #007bff;
}

.notification-item.read {
    opacity: 0.7;
}

.notification-item:hover {
    background-color: #f0f0f0;
}

.notification-header h5 {
    font-size: 16px;
    font-weight: 600;
}

/* Notifikasi Styles */
.notification-badge {
    display: inline-block;
    background-color: #dc3545;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    text-align: center;
    line-height: 20px;
    font-size: 12px;
    margin-left: 5px;
    vertical-align: middle;
}

.border-left-warning {
    border-left: 4px solid #f6c23e !important;
}

.border-left-primary {
    border-left: 4px solid #4e73df !important;
}

.border-left-success {
    border-left: 4px solid #1cc88a !important;
}

.border-left-info {
    border-left: 4px solid #36b9cc !important;
}
</style>
@endpush