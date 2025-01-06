@extends('layout.layout')

@php
$title = 'Website Settings';
$subTitle = 'Website Settings';
$default = asset('assets/images/user-grid/user-grid-img14.png');




$script = '
<script>
    // ======================== Upload Image Start =====================
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#imagePreview").css("background-image", "url(" + e.target.result + ")");
                $("#imagePreview").hide();
                $("#imagePreview").fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function () {
        readURL(this);
    });

    // ======================== Upload Image End =====================

    // ================== Password Show Hide Js Start ==========
    function initializePasswordToggle(toggleSelector) {
        $(toggleSelector).on("click", function () {
            $(this).toggleClass("ri-eye-off-line");
            var input = $($(this).attr("data-toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }
    // Call the function
    initializePasswordToggle(".toggle-password");
    // ========================= Password Show Hide Js End ===========================
</script>';
@endphp

@section('content')
<div class="row">
<div class="col-md-7">
            
    <div class="card ">
        <div class="card-body ">
        
            <form method="POST" action="{{ route('website.update') }}" enctype="multipart/form-data">

                @csrf
                <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="name"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">Website Name
                                <span class="text-danger-600">*</span></label>
                            <input type="text" name="name" class="form-control radius-8" id="name"
                                placeholder="Enter Full Name" value="{{ $settings->name }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="name"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">Logo
                                <span class="text-danger-600">*</span></label>
                            <input type="file" name="logo" class="form-control radius-8" id="logo"
                                placeholder="Enter Username"  readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="email"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">Currency <span
                                    class="text-danger-600">*</span></label>
                                  
                            <input type="text" name="currency" class="form-control radius-8" id="email"
                                placeholder="Enter email address" value="{{ $settings->currency }}">
                        </div>
                    </div>
                    

                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="Language"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">Language
                                <span class="text-danger-600">*</span> </label>
                            <select class="form-control radius-8 form-select" name="language" id="Language">
                                <option> English</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <button type="submit"
                        class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                        Save
                    </button>
                </div>
            </form>
        
        </div>
    </div>
</div>
<div class="col-md-5">
            
    <div class="card ">
        <div class="card-body ">
        
            <form method="POST" action="{{ route('website.announce') }}" enctype="multipart/form-data">

                @csrf
               
                    <div class="col-sm-12">
                        <div class="mb-20">
                            <label for="email"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">Announcement <span
                                    class="text-danger-600">*</span></label>
                                    <small class="text-muted">For Line Break used / forward slash</small>
                            <textarea name="announce" class="form-control radius-8" id="announce" 
                            placeholder="Enter Announcement text" rows="5" style="width: 100%;"></textarea>
                        </div>
                    </div>
                    
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <button type="submit"
                        class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                        Save
                    </button>
                </div>
            </form>
        
        </div>
    </div>
</div>
</div>
<h6 class="fw-semibold mt-9">Bank Accounts</h6>
<div class="col-md-12 ">
            
    <div class="card ">
        <div class="card-body ">
            <form id="bank-account-form" action="#" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value=""> <!-- For update -->
                <input type="hidden" id="bank_id" name="bank_id" value="">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="payment-method" class="form-label fw-semibold text-primary-light text-sm mb-8">
                                Select Payment Method <span class="text-danger-600">*</span>
                            </label>
                            <div class="position-relative">
                                <select class="form-control radius-8" id="payment-method" name="payment_method" onchange="togglePaymentFields()">
                                    <option value="" disabled selected>Select Payment Method</option>
                                    <option value="bank-transfer">Bank Transfer</option>
                                    <option value="upi">UPI</option>
                                    <option value="crypto">Crypto</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="display: none;" id="bank-name">
                        <div class="mb-20">
                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">Bank Name</label>
                            <div class="position-relative">
                                <input type="text" class="form-control radius-8" name="bank_name" placeholder="Bank Name" id="bank-name-input" value="">
                            </div>
                        </div>
                    </div>
                        <div class="col-sm-6" id="account-title" style="display: none;" >
                            <div class="mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Account Holder Name</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control radius-8" name="account_holder_name" placeholder="Account Holder Name" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" style="display: none;" id="account-number">
                            <div class="mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Account Number</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control radius-8" name="account_number" placeholder="Account Number" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" style="display: none;" id="crypto-wallet">
                            <div class="mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">Crypto Wallet Address</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control radius-8" name="crypto_wallet" placeholder="Crypto Wallet " value="">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-sm-6" style="display: none;" id="IBAN-number">
                            <div class="mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">IBAN Number</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control radius-8" name="iban_number" placeholder="IBAN" value="">
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-sm-6" id="ifc-number" style="display: none;">
                            <div class="mb-20 position-relative">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">IFSC Number</label>
                                <div class="position-relative d-flex">
                                    <input type="text" class="form-control radius-8" name="ifc_number" id="ifsc-input" placeholder="IFSC Number">
                                    <button type="button" id="ifsc-search-btn" class="btn btn-primary ms-2" style="display: none;">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" style="display: none;" id="UPI-number">
                            <div class="mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">UPI Number</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control radius-8" name="upi_number" placeholder="UPI Number" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6" style="display: none;" id="upi-qr-code">
                            <div class="mb-20">
                                <label class="form-label fw-semibold text-primary-light text-sm mb-8">UPI QR Code</label>
                                <div class="position-relative">
                                    <input type="file" class="form-control radius-8" name="upi_qr_code" value="">
                                </div>
                            </div>
                        </div>         
                                                    <!-- Container for IFSC details -->
                        <div id="ifsc-details" class="border p-3 radius-8 mt-3" style="display: none;">
                            <ul class="list-unstyled mb-0">
                                <li><strong>Bank:</strong> <span id="details-bank-name"></span></li>
                                <li><strong>Branch:</strong> <span id="details-branch-name"></span></li>
                                <li><strong>Contact:</strong> <span id="details-contact"></span></li>
                                <li><strong>Bank Details:</strong> <span id="details-bank-details"></span></li>
                                <li><strong>City:</strong> <span id="details-city"></span></li>
                                <li><strong>District:</strong> <span id="details-district"></span></li>
                                <li><strong>State:</strong> <span id="details-state"></span></li>
                                <li><strong>Country:</strong> <span id="details-country"></span></li>
                                <li><strong>Address:</strong> <span id="details-address"></span></li>
                            </ul>
                              <!-- Confirm IFSC checkbox -->
                            <div class="form-check mt-3">
                                <input type="checkbox" class="form-check-input" id="confirm-ifsc">
                                <label for="confirm-ifsc" class="form-check-label">Confirm IFSC</label>
                            </div>
                        </div>
                        <div class="col-sm-12 d-flex justify-content-center mt-3 mb-3">
                            <!-- Save button centered and small -->
                            <button type="submit" id="btnBankProfile"
                                class="btn btn-primary border border-primary-600 text-md px-40 py-10 radius-8">
                                Save
                            </button>
                        </div>
            </form>
            <br />
            <div class="row">
                <!-- Bank Transfer Table -->
                <div class="col-12">
                    <h6 class="text-xl mb-16 mt-16">Bank</h6>
                    <table class="table bordered-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Account Holder Name</th>
                                <th scope="col">Bank Name</th>
                                <th scope="col">Account #</th>
                                <th scope="col">IFSC No</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->adminBankAccounts as $bankAccount)
                                @if($bankAccount->payment_method == 'bank-transfer') <!-- Filter for Bank Transfer -->
                                    <tr>
                                        <td><a href="javascript:void(0)" class="text-primary-600" id="{{$bankAccount->id}}-accountholder">{{$bankAccount->account_holder_name}}</a></td>
                                        <td id="{{$bankAccount->id}}-bank_name">{{$bankAccount->bank_name}}</td>
                                        <td id="{{$bankAccount->id}}-account_number">{{$bankAccount->account_number}}</td>
                                        <td id="{{$bankAccount->id}}-iban">{{$bankAccount->ifc_number}}</td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="{{$bankAccount->id}}" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center edit">
                                                <iconify-icon icon="lucide:edit"></iconify-icon>
                                            </a>
                                            <a href="javascript:void(0)" data-id="{{$bankAccount->id}}" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center delete">
                                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            
                <!-- UPI Table -->
                <div class="col-6">
                    <h6 class="text-xl mb-16 mt-16">UPI</h6>
                    <table class="table bordered-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Account Holder Name</th>
                                <th scope="col">UPI ID</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->adminBankAccounts as $bankAccount)
                                @if($bankAccount->payment_method == 'upi') <!-- Filter for UPI -->
                                    <tr>
                                        <td><a href="javascript:void(0)" class="text-primary-600" id="{{$bankAccount->id}}-accountholder">{{$bankAccount->account_holder_name}}</a></td>
                                        <td id="{{$bankAccount->id}}-upi_number">{{$bankAccount->upi_number}}</td>
                                
                                        <td>
                                            <a href="javascript:void(0)" data-id="{{$bankAccount->id}}" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center edit">
                                                <iconify-icon icon="lucide:edit"></iconify-icon>
                                            </a>
                                            <a href="javascript:void(0)" data-id="{{$bankAccount->id}}" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center delete">
                                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            
                <!-- Crypto Table -->
                <div class="col-6">
                    <h6 class="text-xl mb-16 mt-16">Crypto</h6>
                    <table class="table bordered-table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Account Holder Name</th>
                                <th scope="col">Crypto Wallet</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->adminBankAccounts as $bankAccount)
                                @if($bankAccount->payment_method == 'crypto') <!-- Filter for Crypto -->
                                    <tr>
                                        <td><a href="javascript:void(0)" class="text-primary-600" id="{{$bankAccount->id}}-accountholder">{{$bankAccount->account_holder_name}}</a></td>
                                        <td id="{{$bankAccount->id}}-crypto_wallet">{{$bankAccount->crypto_wallet}}</td>
                                        <td>
                                            <a href="javascript:void(0)" data-id="{{$bankAccount->id}}" class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center edit">
                                                <iconify-icon icon="lucide:edit"></iconify-icon>
                                            </a>
                                            <a href="javascript:void(0)" data-id="{{$bankAccount->id}}" class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center delete">
                                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        
    </div>
</div>
</div>
</div>
</div>

<!-- OTP Verification Modal -->
<div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
    <h5 class="modal-title" id="otpModalLabel">OTP Verification</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <p>An OTP has been sent to your email/mobile. Please enter it below to continue.</p>
    <div class="mb-3">
        <label for="otp-input" class="form-label">Enter OTP</label>
        <input type="text" class="form-control" id="otp-input" name="otp" placeholder="Enter OTP">
    </div>
    <div id="otp-error" class="text-danger" style="display: none;">Invalid OTP. Please try again.</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
    <button type="button" id="verify-otp-btn" class="btn btn-primary">Verify OTP</button>
</div>
</div>
</div>
</div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('assets/js/lib/') }}/confirmation-modal.min.js"></script>
<script>
    $(document).ready(function () {
        const ifscInput = $('#ifsc-input');
        const searchBtn = $('#ifsc-search-btn');
        const detailsDiv = $('#ifsc-details');
        const confirmIfscCheckbox = $('#confirm-ifsc');
        const saveButton = $('#btnBankProfile');

        // Show search button when user starts typing
        ifscInput.on('input', function () {
            const ifscCode = $(this).val().trim();
            if (ifscCode) {
                searchBtn.show(); // Show the search button
            } else {
                searchBtn.hide(); // Hide the search button if input is empty
                detailsDiv.hide(); // Hide the details div
                saveButton.prop('disabled', true); // Disable the Save button
            }
        });

        // Search button click handler
        searchBtn.on('click', function () {
            const ifscCode = ifscInput.val().trim();
            if (ifscCode) {
                // Make an AJAX request to fetch IFSC details
                $.ajax({
                    url: `https://ifsc.razorpay.com/${ifscCode}`,
                    method: 'GET',
                    success: function (response) {
                        // Populate the details div
                        $('#details-bank-name').text(response.BANK || 'N/A');
                        $('#details-branch-name').text(response.BRANCH || 'N/A');
                        $('#details-contact').text(response.CONTACT || 'N/A');
                        $('#details-bank-details').text(response.BANK || 'N/A');
                        $('#details-city').text(response.CITY || 'N/A');
                        $('#details-district').text(response.DISTRICT || 'N/A');
                        $('#details-state').text(response.STATE || 'N/A');
                        $('#details-country').text('India'); // Assuming country is India
                        $('#details-address').text(response.ADDRESS || 'N/A');

                        // Show the details div
                        detailsDiv.show();
                        // Disable the Save button until the user confirms IFSC
                        saveButton.prop('disabled', true);
                        confirmIfscCheckbox.prop('checked', false); // Reset checkbox
                    },
                    error: function () {
                        alert('Invalid IFSC Code or unable to fetch details.');
                        detailsDiv.hide(); // Hide details if error occurs
                    }
                });
            }
        });

        // Enable Save button only when Confirm IFSC is checked
        confirmIfscCheckbox.on('change', function () {
            if ($(this).is(':checked')) {
                saveButton.prop('disabled', false); // Enable the Save button
            } else {
                saveButton.prop('disabled', true); // Disable the Save button
            }
        });
    });
</script>



<script>
    let isOtpVerified = false; // Flag to track OTP verification
    let generatedOtp = null; // OTP from the server

    // Trigger OTP modal on form submission
    $('#bank-account-form').submit(function (e) {
        e.preventDefault();

        if (isOtpVerified) {
            // If OTP is already verified, save the bank account
            saveBankAccount();
        } else {
            // Show the OTP modal
            $('#otpModal').modal('show');

            // Generate and send OTP
            $.ajax({
                url: '{{ route("send.otp") }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.status === 'success') {
                        generatedOtp = response.otp; // Store OTP for comparison
                        showToast('OTP sent to your email.', 'success');
                    } else {
                        showToast(response.message, 'error');
                    }
                },
                error: function () {
                    showToast('Failed to send OTP. Please try again.', 'error');
                }
            });
        }
    });
//    verify otp
$('#verify-otp-btn').click(function () {
    const enteredOtp = $('#otp-input').val();

    $.ajax({
        url: '{{ route("verify.otp") }}',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: { otp: enteredOtp },
        success: function (response) {
            if (response.status === 'success') {
                $('#otpModal').modal('hide');
                showToast('OTP verified successfully.', 'success');
                console.log("submit");
                // Submit the form with edited data
                submitBankAccountForm();
               
            } else {
                $('#otp-error').text(response.message).show();
            }
        },
        error: function () {
            showToast('Failed to verify OTP. Please try again.', 'error');
        }
    });
});


function submitBankAccountForm() {
    const formData = new FormData($('#bank-account-form')[0]);

    // Log FormData for debugging
    for (let [key, value] of formData.entries()) {
        console.log(key + ": " + value);
    }

    // Determine method and URL
    const method = formData.get('bank_id') ? 'PUT' : 'POST';
    const url = formData.get('bank_id') 
        ? '{{ route("admin.bank_accounts.update", ":id") }}'.replace(':id', formData.get('bank_id')) 
        : '{{ route("admin.bankAccount") }}';

    if (method === 'PUT') {
        formData.append('_method', 'PUT'); // Add _method for Laravel
    }

    // AJAX request
    $.ajax({
        url: url,
        method: 'POST', // Always use POST; Laravel will interpret _method
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        data: formData,
        processData: false, // Prevent jQuery from automatically processing data
        contentType: false, // Let the browser set the Content-Type with boundary
        success: function(response) {
            if (response.status === 'success') {
                showToast(response.message, 'success');
                window.location.reload();
            }
        },
        error: function(xhr) {
            const errors = xhr.responseJSON?.errors;
            let errorMessage = '';

            if (errors) {
                $.each(errors, function(key, messages) {
                    errorMessage += messages.join(' ') + '<br>';
                });
            } else {
                errorMessage = xhr.responseJSON?.message || 'An unknown error occurred.';
            }

            showToast(errorMessage, 'error');
        }
    });
}





// Ensure the togglePaymentFieldsEdit() is executed after form data is populated.
function togglePaymentFieldsEdit() {
    const paymentMethod = $('#payment-method').val();
    console.log("Payment Method:", paymentMethod);

    // Hide all optional fields initially
    $('#account-title, #account-number, #IBAN-number, #bank-name, #ifc-number, #UPI-number, #upi-qr-code,#crypto-wallet').hide();

    if (paymentMethod === 'bank-transfer') {
        console.log("Toggling fields for bank-transfer");
        $('#account-title, #account-number, #bank-name, #ifc-number').show();
    } else if (paymentMethod === 'upi') {
        console.log("Toggling fields for UPI");
        $('#account-title, #UPI-number, #upi-qr-code').show();
        $('#upi-qr-code .form-label').html('UPI QR Code');
    } else if (paymentMethod === 'crypto') {
        console.log("Toggling fields for Crypto");
        $('#account-title, #crypto-wallet, #upi-qr-code').show();
        $('#upi-qr-code .form-label').html('Crypto QR Code');
    } else {
        console.log("No matching payment method");
    }
    console.log("toggle4 - togglePaymentFields execution ended");
}

// On clicking the edit button, populate form data
$(document).on('click', '.edit', function () {
    const bankAccountId = $(this).data('id');

    // Validate bankAccountId
    if (!bankAccountId) {
        showToast('Invalid bank account ID.', 'error');
        return;
    }

    const url = '{{ route("admin.bankAccount.edit", ":id") }}'.replace(':id', bankAccountId);

    // Fetch bank account details via AJAX
    $.ajax({
        url: url,
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.status === 'success') {
                const bankAccount = response.data;

                // Populate form fields
                $('#bank_id').val(bankAccount.id);
                $('#payment-method').val(bankAccount.payment_method).change();
                $('input[name="account_holder_name"]').val(bankAccount.account_holder_name);
                $('input[name="account_number"]').val(bankAccount.account_number || '');
                $('input[name="crypto_wallet"]').val(bankAccount.crypto_wallet || '');
                $('input[name="bank_name"]').val(bankAccount.bank_name || '');
                $('input[name="ifc_number"]').val(bankAccount.ifc_number || '');
                $('input[name="upi_number"]').val(bankAccount.upi_number || '');
                $('input[name="_method"]').val('PUT');
                
                togglePaymentFieldsEdit();
                
                // Scroll to form
                $('html, body').animate({
                    scrollTop: $('#bank-account-form').offset().top
                }, 500);
                  
                showToast('Account details loaded successfully.', 'success');
            } else {
                showToast(response.message, 'error');
            }
        },
        error: function (xhr) {
            console.error(xhr.responseText);
            showToast('Failed to load bank account details. Please try again.', 'error');
        }
    });
});




    $('.edit').on('click', function () {
        var id = $(this).data('id');
        var accountHolderName = $('#' + id + '-accountholder').text();
        var bankName = $('#' + id + '-bank_name').text();
        var accountNumber = $('#' + id + '-account_number').text();
        var ibanNumber = $('#' + id + '-iban').text();

        $('#bank_name').val($.trim(bankName));
        $('#account_number').val($.trim(accountNumber));
        $('#account_holder_name').val($.trim(accountHolderName));
        $('#iban_number').val($.trim(ibanNumber));
        $('#bank_id').val(id);
        $('#btnBankProfile').text('Update Bank');
    });


    $('.delete').on('click', function () {
        var id = $(this).data('id');
        confirmationModal.show({
            closeIcon: true,
            message: 'Are you sure you want to delete this account?',
            title: 'Delete Bank Account',
            no: {
                class: 'btn btn-danger',
                text: 'No'
            },
            yes: {
                class: 'btn btn-success',
                text: 'Yes'
            }
        }).then(() => modalClosed(true))
            .catch(() => modalClosed(false));
        let url = `{{ route('admin.bank_accounts.destroy', ':id') }}`.replace(':id', id);
        const modalClosed = isYes => {
            if (isYes) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        showToast('Bank account deleted successfully.', 'success');
                        window.location.href = "{{ route('users.user_profile') }}#pills-change-bank-accounts-tab";

                        // Reload the page to ensure the hash is taken into account
                        window.location.reload();
                    },
                    error: function (xhr, status, error) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        // Check if there are specific errors or a general message
                        if (errors) {
                            // Loop through each error and concatenate them
                            $.each(errors, function (key, messages) {
                                errorMessage += messages.join(' ') + '<br>';
                            });
                        } else {
                            errorMessage = xhr.responseJSON.message || 'An unknown error occurred.';
                        }

                        // Display error message in the toast or any other notification element
                        showToast(errorMessage, 'error');
                    }
                });
            } else {
                return false;
            }
        };
    });
</script>

<script>
    function togglePaymentFields() {
        const paymentMethod = document.getElementById('payment-method').value;

        // Hide all fields initially
        document.getElementById('account-title').style.display = 'none';
        document.getElementById('account-number').style.display = 'none';
        document.getElementById('crypto-wallet').style.display = 'none';
        document.getElementById('bank-name').style.display = 'none';
        document.getElementById('ifc-number').style.display = 'none';
        document.getElementById('UPI-number').style.display = 'none';
        document.getElementById('upi-qr-code').style.display = 'none';
       
        const searchBtn = $('#ifsc-search-btn');
        const detailsDiv = $('#ifsc-details');
        const saveButton = $('#btnBankProfile');
        // Show fields based on selection
        if (paymentMethod === 'bank-transfer') {
            document.getElementById('account-title').style.display = 'block';
        document.getElementById('account-number').style.display = 'block';
        // document.getElementById('IBAN-number').style.display = 'block';
        document.getElementById('bank-name').style.display = 'block';
        document.getElementById('ifc-number').style.display = 'block';
        saveButton.prop('disabled',true);
        } else if (paymentMethod === 'upi') {
            document.getElementById('account-title').style.display = 'block';
            document.getElementById('UPI-number').style.display = 'block';
        document.getElementById('upi-qr-code').style.display = 'block';
        var label = document.querySelector('#upi-qr-code .form-label');
    if (label) {
        label.innerHTML = 'UPI QR Code';  // This will change the label text to "Crypto QR Code"
    }
    searchBtn.hide(); // Hide the search button if input is empty
                detailsDiv.hide(); // Hide the details div
                saveButton.prop('disabled', false);
        } else if (paymentMethod === 'crypto') {
            document.getElementById('account-title').style.display = 'block';
        document.getElementById('crypto-wallet').style.display = 'block';
        document.getElementById('upi-qr-code').style.display = 'block';
        var label = document.querySelector('#upi-qr-code .form-label');
    if (label) {
        label.innerHTML = 'Crypto QR Code';  // This will change the label text to "Crypto QR Code"
    }
    searchBtn.hide(); // Hide the search button if input is empty
                detailsDiv.hide(); // Hide the details div
                saveButton.prop('disabled', false);
        }
    }
</script>
@endsection
