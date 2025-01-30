@extends('layout.layout')

@php
    $title = 'Payment Request';
    $subTitle = 'Payment Request';
    $script = '
<script>
    let table = new DataTable("#dataTable");
</script>';
@endphp
<style>
    #dt-length-0{
        margin-right: 10px;
    }
</style>
@section('content')
    <div class="card">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">

            <div class="d-flex flex-wrap align-items-center gap-3">
                <div class="d-flex align-items-center gap-2">
                    <span>Show</span>
                    <select id="showSelect" class="form-select form-select-sm w-auto">
                        <option>10</option>
                        <option>20</option>
                        <option>30</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div>
                <div class="icon-field">
                    <input id="searchInput" type="text" name="#0" class="form-control form-control-sm w-auto" placeholder="Search">
                    <span class="icon">
                        <iconify-icon icon="ion:search-outline"></iconify-icon>
                    </span>
                </div>
            </div>
            <div class="d-flex flex-wrap align-items-center gap-3">
                <select id="statusSelect" class="form-select form-select-sm w-auto">
                    <option>All</option>
                    <option>Approved</option>
                    <option>Rejected</option>
                    <option>Pending</option>
                </select>

            </div>
        </div>
        <div class="card-body mt-0 pt-0">
            <div class="d-flex flex-wrap align-items-center gap-1 justify-content-between mb-16">
                <ul class="nav border-gradient-tab nav-pills mb-0" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center active" id="pills-to-do-list-tab"
                            data-bs-toggle="pill" data-bs-target="#pills-to-do-list" type="button" role="tab"
                            aria-controls="pills-to-do-list" aria-selected="true">
                            Deposit Requests
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center" id="pills-recent-leads-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-recent-leads" type="button" role="tab"
                            aria-controls="pills-recent-leads" aria-selected="false" tabindex="-1">
                            Withdrawal Requests
                        </button>
                    </li>
                </ul>
                <a href="javascript:void(0)" class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                    View All
                    <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                </a>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <!-- Deposit Requests Tab -->
                <div class="tab-pane fade show active" id="pills-to-do-list" role="tabpanel" aria-labelledby="pills-to-do-list-tab" tabindex="0">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Request ID</th>
                                    <th scope="col">Platform Name</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Request Date/Time</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">UTR #</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($depositRequests as $paymentRequest)
                                    <tr>
                                        <td><a href="javascript:void(0)" class="text-primary-600">#{{ $paymentRequest->id }}</a></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img width="50" src="{{ url($paymentRequest->logo) }}" alt="" class="flex-shrink-0 me-12 radius-8">
                                                <h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $paymentRequest->game_name }}</h6>
                                            </div>
                                        </td>
                                        <td>{{ $paymentRequest->user_name }}</td>
                                        <td>{{ $paymentRequest->created_at }}</td>
                                        <td>{{ setCurrency($paymentRequest->amount) }}</td>
                                        <td>{{ $paymentRequest->utr_number }}</td>
                                        <td>
                                            <span class="@if ($paymentRequest->status == 'approved') bg-success-focus text-success-main @endif
                                                         @if ($paymentRequest->status == 'pending') bg-info-focus text-info-main @endif
                                                         @if ($paymentRequest->status == 'rejected') bg-danger-focus text-danger-main @endif 
                                                         px-24 py-4 rounded-pill fw-medium text-sm">
                                                {{ $paymentRequest->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="viewRequest({{ $paymentRequest->id }})"
                                                class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                                <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                            </a>
                                            @if ($paymentRequest->status == 'pending')
                                                <a href="{{ url('payment-request-approve') }}/{{$paymentRequest->id}}" title="Approve"
                                                   class="w-32-px h-32-px bg-success-focus text-success-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                                    <iconify-icon icon="charm:tick"></iconify-icon>
                                                </a>
                                                <a href="{{ url('payment-request-reject') }}/{{$paymentRequest->id}}" title="Reject"
                                                   class="w-32-px h-32-px bg-danger-focus text-danger-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                                    <iconify-icon icon="twemoji:cross-mark"></iconify-icon>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
        
                <!-- Withdrawal Requests Tab -->
                <div class="tab-pane" id="pills-recent-leads" role="tabpanel" aria-labelledby="pills-recent-leads-tab" tabindex="0">
                    <div class="table-responsive scroll-sm">
                        <table class="table bordered-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Request ID</th>
                                    <th scope="col">User Name</th>
                                    <th scope="col">Requested On</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($withdrawalRequests as $withdraw)
                                    <tr>
                                        <td><a href="javascript:void(0)" class="text-primary-600">#{{ $withdraw->id }}</a></td>
                                        <td>{{ $withdraw->user_name }}</td>
                                        <td>{{ $withdraw->created_at }}</td>
                                        <td>{{ setCurrency($withdraw->amount) }}</td>
                                        <td>

                                            <span class="@if ($withdraw->status == 'approved') bg-success-focus text-success-main @endif
                                                @if ($withdraw->status == 'pending') bg-info-focus text-info-main @endif
                                                @if ($withdraw->status == 'rejected') bg-danger-focus text-danger-main @endif 
                                                px-24 py-4 rounded-pill fw-medium text-sm">
                                       {{ $withdraw->status }}
                                   </span>
                                        
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="viewWithDrawRequest({{ $withdraw->id }})"
                                                class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                                <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                            </a>
                                            @if ($withdraw->status == 'pending')
                                                <a href="{{ url('/withdraw-request-approve') }}/{{ $withdraw->id }}" title="Approve"
                                                   class="w-32-px h-32-px bg-success-focus text-success-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                                    <iconify-icon icon="charm:tick"></iconify-icon>
                                                </a>
                                                <a href="{{ url('/withdraw-request-reject') }}/{{ $withdraw->id }}" title="Reject"
                                                   class="w-32-px h-32-px bg-danger-focus text-danger-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                                    <iconify-icon icon="twemoji:cross-mark"></iconify-icon>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="modal fade" id="paymentRequestViewModal" tabindex="-1" aria-labelledby="uploadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h6 class="modal-title" id="uploadModalLabel">Deposit Request</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
               <!-- Modal Body -->
                <div class="modal-body">
                    <form id="transactionFormView" enctype="multipart/form-data">
                        <div class="row">
                            <!-- Left Side: File Upload Area -->
                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <div
                                    class="requestScreenShot upload-area p-4 border border-2 border-dashed rounded text-center h-100 d-flex flex-column justify-content-center align-items-center">
                                    <!-- Image will go here -->
                                </div>
                            </div>

                            <!-- Right Side: Form Fields -->
                            <div class="col-md-6">
                                <!-- Platform Selection -->
                                <div class="mb-3">
                                    <label for="platform" class="form-label">User: </label>
                                    <label id="paymentRequestUser" class="form-label"></label>
                                </div>

                                <div class="mb-3">
                                    <label for="platform" class="form-label">Selected Platform: </label>
                                    <label id="viewPlatform" class="form-label"></label>
                                </div>

                                <!-- Amount -->
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Amount: </label>
                                    <label id="enteredAmount" class="form-label"></label>
                                </div>

                                <!-- Created At -->
                                <div class="mb-3">
                                    <label for="amount" class="form-label">Created At: </label>
                                    <label id="paymentRequestCreatedAt" class="form-label"></label>
                                </div>

                                <div class="mt-5">
                                    <a class="approve-request">
                                        <button type="button" class="btn btn-info w-100">Approve</button>
                                    </a>
                                    <a class="reject-request">
                                        <button type="button" class="btn btn-danger w-100">Reject</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<div class="modal fade" id="withdrawRequestViewModal" tabindex="-1" aria-labelledby="uploadModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title" id="withdrawModalLabel">WithDrawal Request</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form id="withdrawFormView" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <div class="requestScreenShot1 upload-area p-4 border border-2 border-dashed rounded text-center h-100 d-flex flex-column justify-content-center align-items-center">
                                <!-- QR Code Image will go here -->
                                
                            </div>
                        </div>
                        <!-- Right Side: Form Fields -->
                        <div class="col-md-6">
                            <!-- User Field -->
                            <div class="mb-3">
                                <label for="platform" class="form-label">User: </label>
                                <label id="withdrawRequestUser" class="form-label"></label>
                            </div>

                            <!-- Payment Method Field -->
                            <div class="mb-3">
                                <label for="platform" class="form-label">Selected Platform: </label>
                                <label id="withdrawPlatform" class="form-label"></label>
                            </div>

                            <!-- Payment Detail Field (Account number, crypto wallet, or UPI number) -->
                            <div class="mb-3">
                                <label for="payment_detail" class="form-label">Account Number: </label>
                                <label id="withdrawAccountDetail" class="form-label"></label>  <!-- Dynamic payment detail -->
                            </div>
                               <!-- Additional Fields (These will be shown conditionally) -->
                            <div class="mb-3" id="withdrawBankName" style="display: none;">
                                <label for="bank_name" class="form-label">Bank Name: </label>
                                <label id="withdrawBankNameLabel" class="form-label"></label>
                            </div>

                            <div class="mb-3" id="withdrawBranchName" style="display: none;">
                                <label for="branch_name" class="form-label">Branch Name: </label>
                                <label id="withdrawBranchNameLabel" class="form-label"></label>
                            </div>

                            <div class="mb-3" id="withdrawIFCNumber" style="display: none;">
                                <label for="ifc_number" class="form-label">IFC Number: </label>
                                <label id="withdrawIFCNumberLabel" class="form-label"></label>
                            </div>
                            <!-- Amount Field -->
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount: </label>
                                <label id="withdrawAmount" class="form-label"></label>
                            </div>

                            <!-- Created At Field -->
                            <div class="mb-3">
                                <label for="amount" class="form-label">Created At: </label>
                                <label id="withdrawRequestCreatedAt" class="form-label"></label>
                            </div>

                          

                            <div class="mt-5">
                                <a class="approve-withdraw_request">
                                    <button type="button" class="btn btn-info w-100">Approve</button>
                                </a>
                                <a class="reject-withdraw_request">
                                    <button type="button" class="btn btn-danger w-100">Reject</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const statusSelect = document.getElementById('statusSelect');
    
    // Function to search and filter table rows
    function filterTable() {
        // Get the currently active tab's table
        const activeTab = document.querySelector('.tab-pane.active');
        const table = activeTab.querySelector('table');
        const rows = table.querySelectorAll('tbody tr');
        
        const searchTerm = searchInput.value.toLowerCase();
        const statusFilter = statusSelect.value.toLowerCase();
        
        rows.forEach(row => {
            let textMatch = false;
            let statusMatch = false;
            
            // Check all cells in the row except the last one (actions column)
            const cells = Array.from(row.cells).slice(0, -1);
            
            // Search through all cells
            textMatch = cells.some(cell => {
                return cell.textContent.toLowerCase().includes(searchTerm);
            });
            
            // Check status
            const statusCell = row.querySelector('td span');
            if (statusCell) {
                const rowStatus = statusCell.textContent.trim().toLowerCase();
                statusMatch = statusFilter === 'all' || rowStatus === statusFilter;
            }
            
            // Show/hide row based on both filters
            row.style.display = (textMatch && statusMatch) ? '' : 'none';
        });
    }
    
    // Add event listeners
    searchInput.addEventListener('input', filterTable);
    statusSelect.addEventListener('change', filterTable);
    
    // Add event listeners for tab changes
    const tabButtons = document.querySelectorAll('[data-bs-toggle="pill"]');
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Clear the search input and reset status when changing tabs
            searchInput.value = '';
            statusSelect.value = 'All';
            // Show all rows in the new active table
            setTimeout(filterTable, 100); // Small delay to ensure tab content is loaded
        });
    });
});
</script>

@endsection
