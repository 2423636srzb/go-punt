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
                        <div class="col-md-6 d-flex justify-content-center">


                            <div id="accountDetails" style="display: none;" class="mb-3">
                                <div id="detailsList"></div>
                                <div class="form-check d-flex align-items-center">
                                    <input type="checkbox" class="form-check-input me-2" id="confirmCheckbox">
                                    <label class="form-check-label mb-0" for="confirmCheckbox">
                                        Confirm That I Have Deposited The Amount In Above Account
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            @if ($adminAccounts !== null)
                                <div class="mb-3">
                                    <label for="adminAccount" class="form-label">Select Payment Method</label>
                                    <select class="form-select" id="adminAccount" name="admin_account_id" required>
                                        <option selected disabled>Choose Account</option>
                                        @foreach ($adminAccounts as $adminAccount)
                                            <option value="{{ $adminAccount->id }}">
                                                {{ $adminAccount->payment_method }}{{ $adminAccount->bank_name ? ' (' . $adminAccount->bank_name . ')' : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount"
                                    placeholder="Enter amount" min="0" step="0.01" required>
                            </div>

                            <div class="mb-3">
                                <label for="utrNumber" class="form-label">UTR #</label>
                                <input type="text" class="form-control" id="utrNumber" name="utr_number"
                                    placeholder="Enter UTR Number" required>
                            </div>
                            @if (count($shareaccounts) > 0)
                                <div class="mb-3">
                                    <label for="platform" class="form-label">Choose Platform</label>
                                    <select class="form-select" id="platform" name="platform_id" disabled required>
                                        <option selected disabled>Choose platform</option>
                                        @foreach ($shareaccounts as $account)
                                            <option value="{{ $account->game->id }}">{{ $account->game->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="mb-3">
                                <!-- File input field -->
                                <div class="mb-3" style="width: 100%;">
                                    <label for="fileInput" class="form-label">Choose your payment receipt</label>
                                    <input type="file" name="file" accept=".jpg, .png, .jpeg" class="form-control"
                                        id="fileInput" required>
                                </div>
                            </div>
                            <button type="submit" id="sendRequest" class="btn btn-primary w-100">Send Request</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<!-- Modal Structure Withdrawal Request -->

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
                      <input class="form-control" type="number" name="amount" id="Drawamount" required>
                    </div>

                    <!-- Payment Method Selection -->
                    <div class="mb-3">
                      <label class="form-label">Select Payment Method</label>
                      <div style="display: flex; gap: 10px;">
                        <!-- Bank -->
                        <div class="payment-option" data-method="bank" onclick="selectPaymentMethod('bank')" style="cursor:pointer; text-align:center;">
                          <img src="/assets/images/BD/bank-logo.jpg" alt="Bank" style="width:100px; height:100px; object-fit:cover; border: 2px solid transparent;" id="img-bank">
                          <div>Bank</div>
                        </div>
                        <!-- UPI -->
                        <div class="payment-option" data-method="upi" onclick="selectPaymentMethod('upi')" style="cursor:pointer; text-align:center;">
                          <img src="/assets/images/BD/upi.jpg" alt="UPI" style="width:100px; height:100px; object-fit:cover; border: 2px solid transparent;" id="img-upi">
                          <div>UPI</div>
                        </div>
                        <!-- Crypto -->
                        <div class="payment-option" data-method="crypto" onclick="selectPaymentMethod('crypto')" style="cursor:pointer; text-align:center;">
                          <img src="/assets/images/BD/crypto.jpg" alt="Crypto" style="width:100px; height:100px; object-fit:cover; border: 2px solid transparent;" id="img-crypto">
                          <div>Crypto</div>
                        </div>
                      </div>
                    </div>

                    <!-- Dropdowns for Saved Accounts -->
                    <!-- Bank Accounts Dropdown (default shown) -->
                    <div class="mb-3" id="dropdown-bank" style="display: block;">
                      <label for="savedBankAccounts" class="form-label">Select Bank Account</label>
                      <select class="form-select" id="savedBankAccounts" name="account_id" required>
                        @foreach ($user->bankAccounts->where('payment_method', 'bank-transfer') as $account)
                          <option value="{{ $account->id }}"> {{ $account->account_holder_name }} </option>
                        @endforeach
                      </select>
                    </div>

                    <!-- UPI Accounts Dropdown -->
                    <div class="mb-3" id="dropdown-upi" style="display: none;">
                      <label for="savedUpiAccounts" class="form-label">Select UPI Account</label>
                      <select class="form-select" id="savedUpiAccounts" name="account_id_upi">
                        @foreach ($user->bankAccounts->where('payment_method', 'upi') as $account)
                          <option value="{{ $account->id }}"> {{ $account->account_holder_name }} </option>
                        @endforeach
                      </select>
                    </div>

                    <!-- Crypto Accounts Dropdown -->
                    <div class="mb-3" id="dropdown-crypto" style="display: none;">
                      <label for="savedCryptoAccounts" class="form-label">Select Crypto Account</label>
                      <select class="form-select" id="savedCryptoAccounts" name="account_id_crypto">
                        @foreach ($user->bankAccounts->where('payment_method', 'crypto') as $account)
                          <option value="{{ $account->id }}"> {{ $account->account_holder_name }} </option>
                        @endforeach
                      </select>
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


<script>
    // Set default selected method to 'bank'
    let selectedMethod = 'bank';
    // add a class or border style to the default selected image
    document.getElementById('img-bank').style.borderColor = '#007bff';

    function selectPaymentMethod(method) {
      selectedMethod = method;
      // Hide all dropdowns
      document.getElementById('dropdown-bank').style.display = 'none';
      document.getElementById('dropdown-upi').style.display = 'none';
      document.getElementById('dropdown-crypto').style.display = 'none';

      // Remove highlight from all images
      document.getElementById('img-bank').style.borderColor = 'transparent';
      document.getElementById('img-upi').style.borderColor = 'transparent';
      document.getElementById('img-crypto').style.borderColor = 'transparent';

      // Show dropdown for selected method and add border highlight to selected image
      if (method === 'bank') {
        document.getElementById('dropdown-bank').style.display = 'block';
        document.getElementById('img-bank').style.borderColor = '#007bff';
      } else if (method === 'upi') {
        document.getElementById('dropdown-upi').style.display = 'block';
        document.getElementById('img-upi').style.borderColor = '#007bff';
      } else if (method === 'crypto') {
        document.getElementById('dropdown-crypto').style.display = 'block';
        document.getElementById('img-crypto').style.borderColor = '#007bff';
      }
    }
  </script>
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
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('fileInput');
        const sendRequestButton = document.getElementById('sendRequest');

        // Disable the button initially
        sendRequestButton.disabled = true;

        // Enable the button when a file is selected
        fileInput.addEventListener('change', function() {
            sendRequestButton.disabled = !fileInput.files.length; // Enable only if there's a file
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        const adminAccountSelect = document.getElementById('adminAccount');
        const accountDetailsDiv = document.getElementById('accountDetails');
        const detailsList = document.getElementById('detailsList');
        const confirmCheckbox = document.getElementById('confirmCheckbox');
        const platformSelect = document.getElementById('platform');

        adminAccountSelect.addEventListener('change', function() {
            const accountId = this.value;

            fetch(`/admin-account-details/${accountId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const account = data.data;

                        // Clear the previous details
                        detailsList.innerHTML = '';
                        console.log(account.upi_qr_code);
                        const baseUrl = window.location.origin;
                        let qrImageUrl = '';
                        if (account.upi_qr_code) { // Gets the base URL of your site
                            qrImageUrl = account.upi_qr_code.startsWith('/') ?
                                baseUrl + account.upi_qr_code // If path starts with /, add base URL
                                :
                                baseUrl + '/' + account.upi_qr_code;
                        }
                        // Determine the fields to display based on payment method
                        if (account.payment_method === 'bank-transfer') {
                            detailsList.innerHTML = `
                                <div style="margin-bottom: 10px;">
                                <!-- Centered image -->
                                <div style="text-align: center; margin-bottom: 10px; width: 200px; height: 200px; border-radius: 10px; display: block; margin: 0 auto;">
                                    <img src="/assets/images/BD/bank-logo.jpg" alt="Bank Transfer" >
                                </div>
                                <!-- Left-aligned list -->
                                <ul style="list-style-type: none; margin: 0; padding: 0;">
                                    <li><strong>Account Holder:</strong> ${account.account_holder_name}</li>
                                    <li><strong>Bank Name:</strong> ${account.bank_name || 'N/A'}</li>
                                    <li><strong>Account Number:</strong> ${account.account_number || 'N/A'}</li>
                                    <li><strong>IFSC Number:</strong> ${account.ifc_number || 'N/A'}</li>
                                </ul>
                                </div>
                                 `;

                        } else if (account.payment_method === 'upi') {
                            detailsList.innerHTML = `
                    <div style="margin-bottom: 10px;">
                            <!-- Centered image row -->
                            <div style="text-align: center; margin-bottom: 10px; width: 200px; height: 200px; border-radius: 10px; display: block; margin: 0 auto;">
                                <img src="${qrImageUrl}" alt="UPI QR Code" >
                            </div>
                            <!-- Left-aligned list row -->
                            <div style="text-align: left;">
                                <ul style="list-style-type: none; margin: 0; padding: 0;">
                                <li><strong>Account Holder:</strong> ${account.account_holder_name}</li>
                                <li><strong>UPI Number:</strong> ${account.upi_number || 'N/A'}</li>
                                </ul>
                            </div>
                            </div>
                `;
                        } else if (account.payment_method === 'crypto') {
                            detailsList.innerHTML = `
                  <div style="margin-bottom: 10px;">
                            <!-- Centered image row -->
                            <div style="text-align: center; margin-bottom: 10px; width: 200px; height: 200px; border-radius: 10px; display: block; margin: 0 auto;">
                                <img src="${qrImageUrl}" alt="Crypto QR Code" >
                            </div>
                            <!-- Left-aligned list row -->
                            <div style="text-align: left;">
                                <ul style="list-style-type: none; margin: 0; padding: 0;">
                                <li><strong>Account Holder:</strong> ${account.account_holder_name}</li>
                                <li><strong>Crypto Wallet:</strong> ${account.crypto_wallet || 'N/A'}</li>
                                </ul>
                            </div>
                            </div>

                `;
                        }

                        // Display the checkbox below

                        // document.getElementById('accountDetails').innerHTML += checkboxHtml;

                        // Show the details and confirmation checkbox
                        accountDetailsDiv.style.display = 'block';

                        // Show the details and confirmation checkbox
                        accountDetailsDiv.style.display = 'block';
                    }
                })
                .catch(error => console.error('Error fetching account details:', error));
        });

        confirmCheckbox.addEventListener('change', function() {
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
                if (response.user_name || response.name || response.amount || response.created_at) {
                    $('#paymentRequestUser').html(response.user_name);
                    $('#viewPlatform').html(response.name);
                    $('#enteredAmount').html(response.amount);
                    $('#paymentRequestCreatedAt').html(response.created_at);
                } else {
                    console.error("Missing required data:", response);
                }

                // Display the image if available
                if (response.image) {
                    $('.requestScreenShot').html('<img width="500" src="' + '{{ url('/') }}/' +
                        response.image + '" alt="Screenshot" />');
                }

                // Set the approve/reject URLs
                $('.approve-request').attr('href', '{{ url('payment-request-approve') }}' + '/' + response
                    .id);
                $('.reject-request').attr('href', '{{ url('payment-request-reject') }}' + '/' + response
                    .id);

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
    fileInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block'; // Show the image preview
            };
            reader.readAsDataURL(file);
        }
    });
</script>
