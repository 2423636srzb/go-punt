@extends('layout.layout')

@php
$title = 'Payment Request';
$subTitle = 'Payment Request';
@endphp

@section('content')
<style>
    .custom-drop-area {
        border: 2px dashed #ccc;
        border-radius: 5px;
        padding: 40px;
        text-align: center;
        background-color: #f9f9f9;
        color: #333;
    }

    .custom-drop-area h4 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .custom-drop-area p {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 20px;
    }

    .custom-drop-area .btn-browse {
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 3px;
        border: none;
    }

    .custom-drop-area .btn-browse:hover {
        background-color: #0056b3;
        color: #fff;
    }

    /* Hide the default pekeUpload button if it still appears */
    .pekecontainer {
        display: none !important;
    }
</style>
<div class="card">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">

        <div class="d-flex flex-wrap align-items-center gap-3">
            <form method="GET" action="{{ route('users.payment_request') }}">
                <select name="status" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="Paid" {{ request('status') == 'Paid' ? 'selected' : '' }}>Paid</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </form>

            <div class="dropdown">
                <button class="btn btn-primary-600 not-active px-12 py-6 text-sm dropdown-toggle toggle-icon"
                    type="button" data-bs-toggle="dropdown" aria-expanded="false"> Create Request </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900"
                            href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#uploadModal">Deposit
                            Request</a></li>
                    <li><a class="dropdown-item px-16 py-8 rounded text-secondary-light bg-hover-neutral-200 text-hover-neutral-900"
                            href="javascript:void(0)" data-bs-toggle="modal"
                            data-bs-target="#withdrawalModal">WithDrawal Request</a></li>
                </ul>
            </div>

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
                        data-bs-target="#pills-recent-leads" type="button" role="tab" aria-controls="pills-recent-leads"
                        aria-selected="false" tabindex="-1">
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
            <div class="tab-pane fade show active" id="pills-to-do-list" role="tabpanel"
                aria-labelledby="pills-to-do-list-tab" tabindex="0">
                <div class="table-responsive scroll-sm">
                    <table id="withdraw" class="table bordered-table mb-0">
                        <thead>
                            <tr>

                                <th scope="col">Request ID</th>
                                <th scope="col">Platform Name</th>
                                <th scope="col">Requested On</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <td><a href="javascript:void(0)" class="text-primary-600">#{{ $transaction->id }}</a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/') }}/{{$transaction->image}}" alt=""
                                             class="flex-shrink-0 me-12 radius-8">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-medium">{{ $transaction->name ?? 'N/A' }}</h6>
                                        </div>
                                    </div>
                                </td>

                                <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y H:i:s') }}</td>
                                <td>{{ setCurrency($transaction->amount) }}</td>
                                <td>
                                    <span class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                       class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                        <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                    </a>

                                    <a href="javascript:void(0)"
                                    class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                    data-transaction-id="{{ $transaction->id }}"
                                    id="deleteTransactionBtn">
                                    <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                 </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="tab-pane" id="pills-recent-leads" role="tabpanel" aria-labelledby="pills-recent-leads-tab"
                tabindex="0">
                <div class="table-responsive scroll-sm">
                    <table class="table bordered-table mb-0">
                        <thead>
                            <tr>

                                <th scope="col">Request ID</th>
                                <th scope="col">Platform Name</th>
                                <th scope="col">Requested On</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="javascript:void(0)" class="text-primary-600">#526534</a></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="http://localhost/betdalal/public/assets/images/users/user1.png" alt=""
                                            class="flex-shrink-0 me-12 radius-8">
                                        <div class="flex-grow-1">
                                            <h6 class="text-md mb-0 fw-medium">BMW</h6>
                                            <!--
                                            <span class="text-sm text-secondary-light fw-medium"><a
                                                    href="https://bmw.com/" target="_blank">https://bmw.com/</a></span>
                                            -->
                                        </div>
                                    </div>
                                </td>

                                <td>25 Jan 2024 22:00:00</td>
                                <td>{{setCurrency(200)}}</td>
                                <td> <span
                                        class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Pending</span>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                        class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                        <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                                    </a>

                                    <a href="javascript:void(0)"
                                        class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title" id="uploadModalLabel">Deposit Request</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="transactionForm" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Left Side: File Upload Area -->
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <div class="upload-area p-4 border border-2 border-dashed rounded text-center h-100 d-flex flex-column justify-content-center align-items-center">
                                <input
                                    type="file"
                                    name="file"
                                    id="dropArea"
                                    accept=".jpg, .png, .jpeg"
                                    class="d-none">
                            </div>
                        </div>

                        <!-- Right Side: Form Fields -->
                        <div class="col-md-6">
                            <!-- Platform Selection -->
                            <div class="mb-3">
                                <label for="platform" class="form-label">Select Platform</label>
                                <select class="form-select" id="platform" name="platform_id" required>
                                    <option selected disabled>Choose a platform</option>
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->game->id }}">{{ $account->game->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Amount Input -->
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="amount"
                                    name="amount"
                                    placeholder="Enter amount"
                                    min="0"
                                    step="0.01"
                                    required>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100">Send Request</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Structure -->

<div class="modal fade" id="withdrawalModal" tabindex="-1" aria-labelledby="withdrawalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="withdrawalModalLabel">Withdrawal Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="withdrawalForm">
                    <!-- Amount Field -->
                    <div class="mb-3">
                        <label for="amount" class="form-label">Enter Amount</label>
                      <input class="form-control" type="number" name="amount" id="amount" required>
                    </div>

                    <!-- Radio Buttons for Account Selection -->
                    <div class="mb-3">
                        <label class="form-label">Select Option</label>

                        <div class="form-check checked-success d-flex align-items-center gap-2">
                            <input class="form-check-input" type="radio" name="accountOption" id="savedAccount" checked="" onclick="toggleAccountOptions()">
                            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="savedAccount">
                                Continue with Saved Accounts
                            </label>
                        </div>

                        <div class="form-check checked-success d-flex align-items-center gap-2">
                            <input class="form-check-input" type="radio" name="accountOption" id="newAccount" onclick="toggleAccountOptions()">
                            <label class="form-check-label line-height-1 fw-medium text-secondary-light" for="newAccount">
                                Add new account
                            </label>
                        </div>
                    </div>

                    <!-- Saved Accounts Dropdown -->
                    <div class="mb-3" id="savedAccountsDropdown">
                        <label for="savedAccounts" class="form-label">Select Saved Account</label>
                        <select class="form-select" id="savedAccounts">
                            @foreach($user->bankAccounts as $bankAccount)
                                <option value="{{$bankAccount->id}}">{{$bankAccount->bank_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- New Account Fields -->
                    <div id="newAccountFields" style="display: none;">
                        <div class="mb-3">
                            <label for="bankName" class="form-label">Bank Name</label>
                            <input type="text" class="form-control" id="bankName" placeholder="Enter bank name">
                        </div>
                        <div class="mb-3">
                            <label for="accountNumber" class="form-label">Bank Account Number</label>
                            <input type="text" class="form-control" id="accountNumber" placeholder="Enter account number">
                        </div>
                        <div class="mb-3">
                            <label for="accountHolderName" class="form-label">Account Holder Name</label>
                            <input type="text" class="form-control" id="accountHolderName" placeholder="Enter account holder name">
                        </div>
                        <div class="mb-3">
                            <label for="iban" class="form-label">IBAN #</label>
                            <input type="text" class="form-control" id="iban" placeholder="Enter IBAN">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection


@section('js')

<script src="{{asset('assets/js/lib/') }}/confirmation-modal.min.js"></script>
<script type="text/javascript" src="{{asset('assets/js/lib/') }}/pekeUpload.js"></script>
<link rel="stylesheet" href="{{asset('assets/css/lib/') }}/pekeUpload.css" type="text/css" />

<!-- JavaScript to Toggle Account Options -->
<script>
    function toggleAccountOptions() {
        const savedAccountsDropdown = document.getElementById('savedAccountsDropdown');
        const newAccountFields = document.getElementById('newAccountFields');
        const isSavedAccount = document.getElementById('savedAccount').checked;

        if (isSavedAccount) {
            savedAccountsDropdown.style.display = 'block';
            newAccountFields.style.display = 'none';
        } else {
            savedAccountsDropdown.style.display = 'none';
            newAccountFields.style.display = 'block';
        }
    }

    $(document).ready(function () {
        $("#dropArea").pekeUpload({
            dragMode: true,
            bootstrap: false,
            btnText: 'Upload Files ...',  // Hide default button text as we created our own button
            allowedExtensions: "jpeg|jpg|png",  // Set file extensions as needed
            url: '{{ route("games.uploadAccounts") }}',
            data: { _token: '{{ csrf_token() }}' },
            onFileSuccess: function (file, response) {
                showToast('File uploaded successfully and accounts assigned to users', 'success');
                $('#fileUploadModal').modal('hide');
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            },
            onFileError: function (file, error) {
                console.log(file);
                console.error('File upload failed:', error);
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#transactionForm').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            // Create FormData object
            let formData = new FormData(this);

            // AJAX request
            $.ajax({
                url: '{{ route('transaction.store') }}', // Corrected to use the named route
                type: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Set content type to false for FormData
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                beforeSend: function () {
                    // Optional: Add a loader or disable the submit button
                    $('#transactionForm button[type="submit"]').prop('disabled', true).text('Submitting...');
                },
                success: function (response) {
                    // Handle success response
                    if (response.success) {
                        showToast('Transaction submitted successfully!', 'success');
                        // If you have a modal, you can hide it like this
                        // $('#uploadModal').modal('hide'); // Hide the modal
                        $('#transactionForm')[0].reset(); // Reset the form
                        location.reload(); // This will refresh the page
                    } else {
                        showToast('Something went wrong.');
                    }
                },
                error: function (xhr) {
                    // Handle error response
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = Object.values(errors).flat().join('\n');
                        showToast('Validation Error:\n' + errorMessages);
                    } else {
                        showToast('An unexpected error occurred. Please try again.');
                    }
                },
                complete: function () {
                    // Re-enable the submit button
                    $('#transactionForm button[type="submit"]').prop('disabled', false).text('Send Request');
                }
            });
        });
    });
    </script>
    <script>
        $(document).ready(function () {
            // Event listener for delete button
            $('#deleteTransactionBtn').on('click', function () {
                var transactionId = $(this).data('transaction-id'); // Get transaction ID from data attribute

                // Confirm before delete
                if (confirm('Are you sure you want to delete this transaction?')) {
                    // Send AJAX request to delete the transaction
                    $.ajax({
                        url: '{{ route('transaction.destroy', '') }}/' + transactionId, // The delete route
                        type: 'DELETE', // Using DELETE method
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                        },
                        success: function (response) {
                            if (response.success) {
                                alert(response.success); // Show success message
                                location.reload(); // Refresh the page
                            } else {
                                alert('Failed to delete transaction.');
                            }
                        },
                        error: function (xhr) {
                            alert('Error: ' + xhr.responseText); // Show error message
                        }
                    });
                }
            });
        });


        $(document).ready(function () {
    // Initialize DataTable
    var table = $('#withdraw').DataTable({
        // Your DataTable options
    });

    // Custom search input integration
    $('#customSearch').on('keyup', function () {
        table.search(this.value).draw();
    });
});


$(document).ready(function () {
    // Initialize DataTable
    var table = $('#withdraw').DataTable();

    // Event listener for the custom status filter
    $('#statusFilter').on('change', function () {
        var selectedStatus = $(this).val();

        // Use the DataTables search API to filter the table
        table.column(0).search(selectedStatus).draw(); // Column 0 is the "Status" column
    });
});



$('#withdrawalForm').on('submit', function (e) {
    e.preventDefault(); // Prevent page reload

    var amount = $('#amount').val();
    var accountOption = $("input[name='accountOption']:checked").val();

    var formData = {
        amount: amount,
        accountOption: accountOption,
        bankId: null, // Default to null
        newAccountData: {} // Empty object for new account
    };

    // If new account is selected, prepare new account data
    if (accountOption === 'newAccount') {
        formData.newAccountData = {
            bankName: $('#bankName').val(),
            accountNumber: $('#accountNumber').val(),
            accountHolderName: $('#accountHolderName').val(),
            iban: $('#iban').val()
        };
    } else {
        // If saved account is selected, use the selected bank account ID
        formData.bankId = $('#savedAccounts').val();
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '{{ route('submitWithdrawal') }}',
        type: 'POST',
        data: formData,
        success: function(response) {
            alert(response.message); // Show success message
        },
        error: function(xhr, status, error) {
            alert('Error occurred while processing withdrawal'); // Handle error
        }
    });
});

    </script>

@endsection
