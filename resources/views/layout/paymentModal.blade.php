


@php
    $title = 'Payment Request';
    $subTitle = 'Payment Request';
@endphp

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
    #dropArea {
    min-height: 200px;
    width: 100%;
    border: 2px dashed #ccc;
    text-align: center;
    padding: 20px;
}

    </style>

{{-- <div class="d-flex flex-wrap align-items-center gap-1 justify-content-between mb-16">
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
</div>     <!-- Modal Structure --> --}}
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="uploadModalLabel">Deposit Request</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="transactionForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center justify-content-center">
                            <div id="dropArea" class="upload-area p-4 border border-2 border-dashed rounded text-center h-100 d-flex flex-column justify-content-center align-items-center" style="width: 100%; min-height: 200px; cursor: pointer;">
                                <p class="text-muted">Drag and drop your file here</p>
                                <input type="file" name="file" accept=".jpg, .png, .jpeg" class="d-none" id="fileInput">
                                <img id="imagePreview" src="" alt="Image Preview" style="max-width: 100%; max-height: 150px; display: none;">
                            </div>
                        </div>
                
                        <div class="col-md-6">
                            @if ($adminAccounts !== null)
                                <div class="mb-3">
                                    <label for="adminAccount" class="form-label">Select Admin Account</label>
                                    <select class="form-select" id="adminAccount" name="admin_account_id" required>
                                        <option selected disabled>Choose Account</option>
                                        @foreach ($adminAccounts as $adminAccount)
                                            <option value="{{ $adminAccount->id }}">{{ $adminAccount->payment_method }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                
                            <div id="accountDetails" style="display: none;" class="mb-3">
                                <ul id="detailsList"></ul>
                                <div class="form-check d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input me-2" id="confirmCheckbox">
                                    <label class="form-check-label mb-0" for="confirmCheckbox">
                                        Confirm That I Have Deposited The Amount In Above Account
                                    </label>
                                </div>
                                
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount" min="0" step="0.01" required>
                            </div>
                
                            <div class="mb-3">
                                <label for="utrNumber" class="form-label">UTR #</label>
                                <input type="text" class="form-control" id="utrNumber" name="utr_number" placeholder="Enter UTR Number" required>
                            </div>
                            @if (count($shareaccounts) > 0)
                                <div class="mb-3">
                                    <label for="platform" class="form-label">Select Platform</label>
                                    <select class="form-select" id="platform" name="platform_id" disabled required>
                                        <option selected disabled>Choose a platform</option>
                                        @foreach ($shareaccounts as $account)
                                            <option value="{{ $account->game->id }}">{{ $account->game->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                
                         
                
                            <button type="submit" id="sendRequest" class="btn btn-primary w-100">Send Request</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal Structure Withdrawal Request -->

<div class="modal fade" id="withdrawalModal" tabindex="-1" aria-labelledby="withdrawalModalLabel"
aria-hidden="true">
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
                <input class="form-control" type="number" value="" name="amount" id="Drawamount" required>
            </div>

            <!-- Radio Buttons for Account Selection -->
            {{-- <div class="mb-3">
                <label class="form-label">Select Option</label>

                <div class="form-check checked-success d-flex align-items-center gap-2">
                    <input class="form-check-input" type="radio" name="accountOption" id="savedAccount" checked onclick="toggleAccountOptions()">
                    <label class="form-check-label line-height-1 fw-medium text-secondary-light"
                        for="savedAccount">
                        Continue with Saved Accounts
                    </label>
                </div>

                <div class="form-check checked-success d-flex align-items-center gap-2">
                    <input class="form-check-input" type="radio" name="accountOption" id="newAccount" onclick="toggleAccountOptions()">
                    <label class="form-check-label line-height-1 fw-medium text-secondary-light"
                        for="newAccount">
                        Add new account
                    </label>
                </div>
            </div> --}}

            <!-- Saved Accounts Dropdown -->
            <div class="mb-3" id="savedAccountsDropdown">
                <label for="savedAccounts" class="form-label">Select Saved Account</label>
                <select class="form-select" id="savedAccounts">
                    @foreach ($user->bankAccounts as $bankAccount)
                        <option value="{{ $bankAccount->id }}"> {{ $bankAccount->account_holder_name }}  ( {{ $bankAccount->payment_method}} ) </option>
                    @endforeach
                </select>
            </div>

            <!-- New Account Fields -->
            {{-- <div id="newAccountFields" style="display: none;">
                <div class="mb-3">
                    <label for="bankName" class="form-label">Bank Name</label>
                    <input type="text" class="form-control" id="bankName" placeholder="Enter bank name">
                </div>
                <div class="mb-3">
                    <label for="accountNumber" class="form-label">Bank Account Number</label>
                    <input type="text" class="form-control" id="accountNumber"
                        placeholder="Enter account number">
                </div>
                <div class="mb-3">
                    <label for="accountHolderName" class="form-label">Account Holder Name</label>
                    <input type="text" class="form-control" id="accountHolderName"
                        placeholder="Enter account holder name">
                </div>
                <div class="mb-3">
                    <label for="iban" class="form-label">IBAN #</label>
                    <input type="text" class="form-control" id="iban" placeholder="Enter IBAN">
                </div>
            </div> --}}

            <!-- Submit Button -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>    

{{-- modal of Deposit Request
<div class="modal fade" id="paymentRequestViewModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
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
                    <div
                        class="requestScreenShot upload-area p-4 border border-2 border-dashed rounded text-center h-100 d-flex flex-column justify-content-center align-items-center">
                   
                    </div>
                </div>

                <!-- Right Side: Form Fields -->
                <div class="col-md-6">
                    <!-- Platform Selection -->
                    <div class="mb-3">
                        <label for="platform" class="form-label">Selected Platform</label>
                        <input type="text" class="form-control" disabled id="viewPlatform" name="platform"
                            placeholder="Entered amount" min="0" step="0.01" required>
                    </div>

                    <!-- Amount Input -->
                    <div class="mb-3">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" disabled class="form-control" id="enteredAmount" name="amount"
                            placeholder="Enter amount" min="0" step="0.01" required>
                    </div>
                   

                    <!-- Submit Button -->
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>  --}}

<script>

document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('fileInput');
    const sendRequestButton = document.getElementById('sendRequest');

    // Disable the button initially
    sendRequestButton.disabled = true;

    // Enable the button when a file is selected
    fileInput.addEventListener('change', function () {
        sendRequestButton.disabled = !fileInput.files.length; // Enable only if there's a file
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const adminAccountSelect = document.getElementById('adminAccount');
    const accountDetailsDiv = document.getElementById('accountDetails');
    const detailsList = document.getElementById('detailsList');
    const confirmCheckbox = document.getElementById('confirmCheckbox');
    const platformSelect = document.getElementById('platform');

    adminAccountSelect.addEventListener('change', function () {
        const accountId = this.value;

        fetch(`/admin-account-details/${accountId}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const account = data.data;

                    // Clear the previous details
                    detailsList.innerHTML = '';

                    // Determine the fields to display based on payment method
                    if (account.payment_method === 'bank-transfer') {
                        detailsList.innerHTML = `
                            <li><strong>Account Holder:</strong> ${account.account_holder_name}</li>
                            <li><strong>Bank Name:</strong> ${account.bank_name || 'N/A'}</li>
                            <li><strong>Account Number:</strong> ${account.account_number || 'N/A'}</li>
                            <li><strong>IFSC Number:</strong> ${account.ifc_number || 'N/A'}</li>
                        `;
                    } else if (account.payment_method === 'upi') {
                        detailsList.innerHTML = `
                            <li><strong>Account Holder:</strong> ${account.account_holder_name}</li>
                            <li><strong>UPI Number:</strong> ${account.upi_number || 'N/A'}</li>
                        `;
                    } else if (account.payment_method === 'crypto') {
                        detailsList.innerHTML = `
                            <li><strong>Account Holder:</strong> ${account.account_holder_name}</li>
                            <li><strong>Crypto Wallet:</strong> ${account.crypto_wallet || 'N/A'}</li>
                        `;
                    }

                    // Show the details and confirmation checkbox
                    accountDetailsDiv.style.display = 'block';
                }
            })
            .catch(error => console.error('Error fetching account details:', error));
    });

    confirmCheckbox.addEventListener('change', function () {
        platformSelect.disabled = !this.checked;
    });
});

</script>
<script>
    function viewRequest(id) {
         $.ajax({
      url: `{{ url('get-payment-request/') }}` + "/" + id,
      type: 'GET',
      processData: false, // Prevent jQuery from processing the data
      contentType: false, // Set content type to false for FormData
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
      },
      success: function(response) {
  // Log the response to ensure it has the data
  console.log(response);

  // Check if the necessary fields exist in the response
  if(response.user_name && response.name && response.amount && response.created_at) {
      $('#paymentRequestUser').html(response.user_name);
      $('#viewPlatform').html(response.name);
      $('#enteredAmount').html(response.amount);
      $('#paymentRequestCreatedAt').html(response.created_at);
  } else {
      console.error("Missing required data:", response);
  }

  // Display the image if available
  if (response.image) {
      $('.requestScreenShot').html('<img width="500" src="' + '{{ url('/') }}/' + response.image + '" alt="Screenshot" />');
  }

  // Set the approve/reject URLs
  $('.approve-request').attr('href', '{{ url('payment-request-approve') }}' + '/' + response.id);
  $('.reject-request').attr('href', '{{ url('payment-request-reject') }}' + '/' + response.id);

  // Show the modal
  $('#paymentRequestViewModal').modal('show');
},

      error: function(xhr) {
          // Handle error response
          if (xhr.status === 422) {
              let errors = xhr.responseJSON.errors;
              let errorMessages = Object.values(errors).flat().join('\n');
              showToast('Validation Error:\n' + errorMessages);
          } else {
              showToast('An unexpected error occurred. Please try again.');
          }
      }
  });
}

  </script>    


<script>
    // Get the drop area and file input elements
    const dropArea = document.getElementById('dropArea');
    const fileInput = document.getElementById('fileInput');
    const imagePreview = document.getElementById('imagePreview');
    
    // Trigger click on the file input when the user clicks the drop area
    dropArea.addEventListener('click', () => {
        fileInput.click();
    });

    // Optional: Show image preview when a file is selected
    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block'; // Show the image preview
            };
            reader.readAsDataURL(file);
        }
    });
</script>