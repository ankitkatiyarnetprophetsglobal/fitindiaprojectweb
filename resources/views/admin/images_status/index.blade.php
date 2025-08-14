@extends('admin.layouts.app')
@section('title', 'Fit India Admin-All Posts')

@section('content')
<style>
    .mb-3 {
        margin-bottom: 0 !important;
        margin-right: 10px;
    }
    .bulk-button {
    margin: 8px !important;
}

    .btn-sm {
        padding: .375rem .75rem;
    }

    .rtside {
        float: right;
    }

    .badge-warning {
        background-color: #ffc107;
    }

    .badge-success {
        background-color: #28a745;
    }

    .badge-danger {
        background-color: #dc3545;
    }

    .status-dropdown {
        width: 120px;
    }

    .image-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(5px);
    }

    .modal-content {
        position: relative;
        margin: auto;
        display: block;
        max-width: 55%;
        max-height: 55%;
        top: 35%;
        transform: translateY(-50%);
        border-radius: 10px;
    }

    .modal-image {
        width: 100%;
        height: auto;
        border-radius: 10px;
        object-fit: contain;
    }

    .close-button {
        position: absolute;
        top: -15px;
        right: -15px;
        color: white;
        font-size: 32px;
        cursor: pointer;
        background: rgba(0, 0, 0, 0.7);
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .profile-image {
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .profile-image:hover {
        transform: scale(1.05);
    }

    .user-info {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 10px 20px;
        border-radius: 20px;
        font-family: Arial, sans-serif;
    }
</style>
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Images Status</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Manage Images Status</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Management</h3>
                    </div>

                    <!-- Filters -->
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.image_index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="status" class="form-control">
                                        <option value="">All Status</option>
                                        @foreach($statusLabels as $value => $label)
                                        <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="search" class="form-control" placeholder="Search users..."
                                        value="{{ request('search') }}">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('admin.image_index') }}" class="btn btn-secondary">Clear</a>
                                </div>
                            </div>
                        </form>

                        <!-- Bulk Actions -->
                        <div class="bulk-button">
                            <button type="button" class="btn btn-success" id="bulk-approve-btn" disabled>
                                <i class="fas fa-check"></i> Bulk Approve
                            </button>
                            <button type="button" class="btn btn-danger" id="bulk-reject-btn" disabled>
                                <i class="fas fa-times"></i> Bulk Reject
                            </button>
                            <span id="selected-count" class="ml-2 text-muted">0 selected</span>
                            
                        </div>

                        <!-- Users Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="select-all">
                                        </th>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Image</th>
                                        <th>Mobile</th>
                                        <th>State</th>
                                        <th>Designation</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="user-checkbox" value="{{ $user->id }}">
                                        </td>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->fullname }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->image)
                                            <a href="javascript:void(0);" onclick="openImageModal('{{ asset($user->image) }}', '{{ $user->fullname }}')" class="profile-image">
                                                <img src="{{ asset($user->image) }}"
                                                    alt="{{ $user->fullname }}"
                                                    style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid #ddd;">
                                            </a>
                                            @else
                                            <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; border: 2px solid #ddd;">
                                                <i class="fas fa-user text-muted"></i>
                                            </div>
                                            @endif
                                        </td>
                                        <td>{{ $user->mobile }}</td>
                                        <td>{{ $user->state }}</td>
                                        <td>{{ $user->designation }}</td>
                                        <td>
                                            <span class="badge 
                                            @if($user->status == 1) badge-warning
                                            @elseif($user->status == 2) badge-success
                                            @else badge-danger
                                            @endif">
                                                {{ $user->status_label }}
                                            </span>
                                        </td>
                                        <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                                        <td>
                                            @if($user->status == 1)
                                            <button class="btn btn-sm btn-success approve-btn" data-id="{{ $user->id }}">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger reject-btn" data-id="{{ $user->id }}">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            @else
                                            <select class="form-control form-control-sm status-dropdown" data-id="{{ $user->id }}">
                                                @foreach($statusLabels as $value => $label)
                                                <option value="{{ $value }}" {{ $user->status == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="11" class="text-center">No users found</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $users->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="image-modal" onclick="closeImageModal()">
        <div class="modal-content" onclick="event.stopPropagation()">
            <span class="close-button" onclick="closeImageModal()">&times;</span>
            <img id="modalImage" class="modal-image" src="" alt="">
            <div id="modalUserInfo" class="user-info"></div>
        </div>
    </div>

</div>
@endsection

<script>
    // Image modal functions
    function openImageModal(imageSrc, userName) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const modalUserInfo = document.getElementById('modalUserInfo');

        modalImage.src = imageSrc;
        modalImage.alt = userName;
        modalUserInfo.textContent = userName;

        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closeImageModal() {
        document.getElementById('imageModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    document.addEventListener('DOMContentLoaded', function() {
        // CSRF token setup
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Helper function for AJAX requests
        function makeRequest(url, method = 'POST', data = null) {
            const options = {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            };

            if (data) {
                options.body = JSON.stringify(data);
            }

            return fetch(url, options);
        }

        // Select all checkbox - using event delegation
        document.addEventListener('change', function(e) {
            if (e.target.id === 'select-all') {
                console.log('Select all clicked');
                const userCheckboxes = document.querySelectorAll('.user-checkbox');
                userCheckboxes.forEach(checkbox => {
                    checkbox.checked = e.target.checked;
                });
                updateBulkButtons();
            }
        });

        // Individual checkbox
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('user-checkbox')) {
                console.log('Individual checkbox clicked');
                updateBulkButtons();

                // Update select-all checkbox state
                const totalCheckboxes = document.querySelectorAll('.user-checkbox').length;
                const checkedCheckboxes = document.querySelectorAll('.user-checkbox:checked').length;
                const selectAllCheckbox = document.getElementById('select-all');

                if (selectAllCheckbox) {
                    if (checkedCheckboxes === totalCheckboxes) {
                        selectAllCheckbox.checked = true;
                    } else {
                        selectAllCheckbox.checked = false;
                    }
                }
            }
        });

        // Update bulk buttons state
        function updateBulkButtons() {
            const selectedCount = document.querySelectorAll('.user-checkbox:checked').length;

            const selectedCountElement = document.getElementById('selected-count');
            if (selectedCountElement) {
                selectedCountElement.textContent = selectedCount + ' selected';
            }

            const bulkApproveBtn = document.getElementById('bulk-approve-btn');
            const bulkRejectBtn = document.getElementById('bulk-reject-btn');

            if (selectedCount > 0) {
                if (bulkApproveBtn) bulkApproveBtn.disabled = false;
                if (bulkRejectBtn) bulkRejectBtn.disabled = false;
            } else {
                if (bulkApproveBtn) bulkApproveBtn.disabled = true;
                if (bulkRejectBtn) bulkRejectBtn.disabled = true;
            }
        }

        // Individual approve
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('approve-btn')) {
                const userId = e.target.getAttribute('data-id');

                if (confirm('Are you sure you want to approve this user?')) {
                    makeRequest(`image_approve/${userId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error approving user');
                        });
                }
            }
        });

        // Individual reject
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('reject-btn')) {
                const userId = e.target.getAttribute('data-id');
                if (confirm('Are you sure you want to reject this user?')) {
                    makeRequest(`image_reject/${userId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error rejecting user');
                        });
                }
            }
        });

        // Status dropdown change
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('status-dropdown')) {
                const userId = e.target.getAttribute('data-id');
                const status = e.target.value;

                makeRequest(`image_status/${userId}`, 'POST', {
                        status: status
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Error: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error updating status');
                    });
            }
        });

        // Bulk approve
        document.addEventListener('click', function(e) {
            if (e.target.id === 'bulk-approve-btn') {
                const selectedCheckboxes = document.querySelectorAll('.user-checkbox:checked');
                const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.value);

                if (selectedIds.length === 0) {
                    alert('Please select at least one user');
                    return;
                }

                if (confirm(`Are you sure you want to approve ${selectedIds.length} users?`)) {
                    makeRequest('image_bulk_approve', 'POST', {
                            user_ids: selectedIds
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error approving users');
                        });
                }
            }
        });

        // Bulk reject
        document.addEventListener('click', function(e) {
            if (e.target.id === 'bulk-reject-btn') {
                const selectedCheckboxes = document.querySelectorAll('.user-checkbox:checked');
                const selectedIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.value);

                if (selectedIds.length === 0) {
                    alert('Please select at least one user');
                    return;
                }

                if (confirm(`Are you sure you want to reject ${selectedIds.length} users?`)) {
                    makeRequest('image_bulk_reject', 'POST', {
                            user_ids: selectedIds
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                location.reload();
                            } else {
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error rejecting users');
                        });
                }
            }
        });

        // Initialize bulk buttons state on page load
        updateBulkButtons();

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeImageModal();
            }
        });
    });
</script>