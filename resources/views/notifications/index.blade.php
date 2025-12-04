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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
/* Wrapper card */
.card {
    border-radius: 12px;
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    overflow: hidden;
}

/* Header */
.card-header {
    background: #fff;
    border-bottom: 1px solid #eee;
    padding: 18px 22px;
}

.card-header h4 {
    font-size: 20px;
    font-weight: 700;
}

/* Button styles */
#mark-all-read {
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 13px;
}

.notification-list {
    margin-top: 10px;
}

/* Notifikasi item */
.notification-item {
    padding: 18px 22px;
    background: #ffffff;
    margin-bottom: 10px;
    border-radius: 10px;
    border: 1px solid #f0f0f0;
    transition: all 0.25s ease;
}

.notification-item:hover {
    transform: translateY(-3px);
    background: #fafafa;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

/* Unread highlight */
.notification-item.unread {
    border-left: 5px solid #4e73df;
    background: #f4f6ff;
}

.notification-item.read {
    opacity: 0.75;
}

/* Title */
.notification-header h5 {
    font-size: 17px;
    margin: 0;
    font-weight: 600;
}

/* Waktu */
.notification-header small {
    font-size: 12px;
}

/* Message */
.notification-item p {
    margin: 6px 0 12px 0;
    line-height: 1.4;
    font-size: 14px;
}

/* Buttons */
.notification-item a.btn,
.notification-item button.btn {
    border-radius: 6px;
    padding: 5px 12px;
    font-size: 13px;
}

/* Badge at top-right */
.notification-badge {
    display: inline-block;
    background-color: #dc3545;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    text-align: center;
    line-height: 20px;
    font-size: 11px;
    margin-left: 4px;
    font-weight: 600;
}

/* Icon styling */
.notification-header i {
    margin-right: 6px;
    font-size: 15px;
}

/* Empty state */
.text-center i {
    opacity: 0.4;
}
/* ---- BOOTSTRAP MINI FOR NOTIFICATION ONLY ---- */
.container {
    max-width: 1100px;
    margin: 0 auto;
}

.row {
    display: flex;
    flex-wrap: wrap;
}

.col-md-12 {
    flex: 0 0 100%;
}

/* Card */
.card {
    background: #fff;
    border-radius: 14px;
    padding: 20px;
    border: 1px solid #e6e6e6;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

/* Header */
.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
}

/* Buttons */
.btn {
    cursor: pointer;
    border: none;
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
}

.btn-outline-primary {
    color: #4e73df;
    border: 1px solid #4e73df;
    background: transparent;
}

.btn-outline-primary:hover {
    background: #4e73df;
    color: #fff;
}

.btn-outline-secondary {
    color: #6c757d;
    border: 1px solid #6c757d;
    background: transparent;
}

.btn-outline-secondary:hover {
    background: #6c757d;
    color: #fff;
}

/* Notification list */
.notification-item {
    border: 1px solid #ececec;
    padding: 18px;
    border-radius: 10px;
    margin-bottom: 12px;
    background: #fff;
    transition: 0.2s;
}

.notification-item:hover {
    background: #f8f9ff;
    transform: translateY(-3px);
}

/* Unread highlight */
.notification-item.unread {
    border-left: 5px solid #4e73df;
    background: #f4f6ff;
}

/* Read effect */
.notification-item.read {
    opacity: 0.7;
}

/* Title */
.notification-header h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}

/* Message */
.notification-item p {
    margin-top: 5px;
    font-size: 14px;
    line-height: 1.4;
}

.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

</style>

@endpush