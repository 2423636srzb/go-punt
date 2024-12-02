@extends('layout.layout')

@php
$title = 'View Profile';
$subTitle = 'View Profile';
$default = asset('assets/images/users/avatar-large-square.jpg');

if($user->profile_image == null){
$profile_image = $default;
}else{
$profile_image = url('/'.$user->profile_image);
}


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

<div class="row gy-4">
    <div class="col-lg-4">
        <div class="user-grid-card position-relative border radius-16 overflow-hidden bg-base h-100">
            <img src="{{ asset('assets/images/users/image-cover.jpg') }}" alt="" class="w-100 object-fit-cover">
            <div class="pb-24 ms-16 mb-24 me-16  mt--100">
                <div class="text-center border border-top-0 border-start-0 border-end-0">
                    <img src="{{ $profile_image }}" alt=""
                        class="border br-white border-width-2-px w-200-px h-200-px rounded-circle object-fit-cover"
                        id="user_image">
                    <h6 class="mb-0 mt-16">{{ $user->name }}</h6>
                    <span class="text-secondary-light mb-16">{{ $user->username }}</span>
                </div>
                <div class="mt-24">
                    <h6 class="text-xl mb-16">Personal Info</h6>
                    <ul>
                        <li class="d-flex align-items-center gap-1 mb-12">
                            <span class="w-30 text-md fw-semibold text-primary-light">Full Name</span>
                            <span class="w-70 text-secondary-light fw-medium">: {{ $user->name }}</span>
                        </li>
                        <li class="d-flex align-items-center gap-1 mb-12">
                            <span class="w-30 text-md fw-semibold text-primary-light"> Email</span>
                            <span class="w-70 text-secondary-light fw-medium">: {{ $user->email }}</span>
                        </li>
                        <li class="d-flex align-items-center gap-1 mb-12">
                            <span class="w-30 text-md fw-semibold text-primary-light"> Phone Number</span>
                            <span class="w-70 text-secondary-light fw-medium">: {{ $user->phone_number }}</span>
                        </li>

                        <li class="d-flex align-items-center gap-1">
                            <span class="w-30 text-md fw-semibold text-primary-light"> Language</span>
                            <span class="w-70 text-secondary-light fw-medium">: {{ $user->language }} </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-body p-24">
                @if(!auth()->user()->is_admin)
                <ul class="nav border-gradient-tab nav-pills mb-20 d-inline-flex" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center px-24 active" id="pills-edit-profile-tab"
                            data-bs-toggle="pill" data-bs-target="#pills-edit-profile" type="button" role="tab"
                            aria-controls="pills-edit-profile" aria-selected="true">
                            Edit Profile
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-center px-24" id="pills-change-bank-accounts-tab"
                            data-bs-toggle="pill" data-bs-target="#pills-change-bank-accounts" type="button" role="tab"
                            aria-controls="pills-change-bank-accounts" aria-selected="false" tabindex="-1">
                            Payment Methods
                        </button>
                    </li>
                </ul>
                @endif

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel"
                        aria-labelledby="pills-edit-profile-tab" tabindex="0">
                        <h6 class="text-md text-primary-light mb-16">Profile Image</h6>
                        <!-- Upload Image Start -->
                        <div class="mb-24 mt-16">
                            <div class="avatar-upload">
                                <div
                                    class="avatar-edit position-absolute bottom-0 end-0 me-24 mt-16 z-1 cursor-pointer">
                                    <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" hidden
                                        id="profileImageUpload">
                                    <label for="imageUpload"
                                        class="w-32-px h-32-px d-flex justify-content-center align-items-center bg-primary-50 text-primary-600 border border-primary-600 bg-hover-primary-100 text-lg rounded-circle">
                                        <iconify-icon icon="solar:camera-outline" class="icon"></iconify-icon>
                                    </label>
                                </div>
                                <div class="avatar-preview">
                                    <div id="imagePreview"></div>
                                </div>
                            </div>
                        </div>
                        <!-- Upload Image End -->
                        <form action="#" id="updateProfileForm">
                            @csrf
                            <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-20">
                                        <label for="name"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Full Name
                                            <span class="text-danger-600">*</span></label>
                                        <input type="text" name="name" class="form-control radius-8" id="name"
                                            placeholder="Enter Full Name" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-20">
                                        <label for="name"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">UserName
                                            <span class="text-danger-600">*</span></label>
                                        <input type="text" name="username" class="form-control radius-8" id="username"
                                            placeholder="Enter Username" value="{{ $user->username }}" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-20">
                                        <label for="email"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span
                                                class="text-danger-600">*</span></label>
                                        <input type="email" name="email" class="form-control radius-8" id="email"
                                            placeholder="Enter email address" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-20">
                                        <label for="number"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Phone</label>
                                        <input type="text" class="form-control radius-8" name="phone_number"
                                            id="phone_number" placeholder="Enter phone number"
                                            value="{{ $user->phone_number }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb-20">
                                        <label for="Language"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">Language
                                            <span class="text-danger-600">*</span> </label>
                                        <select class="form-control radius-8 form-select" id="Language">
                                            <option> English</option>
                                            <option> Bangla </option>
                                            <option> Hindi</option>
                                            <option> Arabic</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="mb-20">
                                        <label for="your-password"
                                            class="form-label fw-semibold text-primary-light text-sm mb-8">New Password
                                            <span class="text-danger-600">*</span></label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control radius-8" id="password"
                                                name="password" value="" placeholder="Enter New Password*">
                                            <span
                                                class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light"
                                                data-toggle="#your-password"></span>
                                        </div>
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

                    <div class="tab-pane fade" id="pills-change-bank-accounts" role="tabpanel"
                        aria-labelledby="pills-change-bank-accounts-tab" tabindex="0">
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
                                            <input type="text" class="form-control radius-8" name="bank_name" placeholder="Bank Name" value="">
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
                                    <div class="col-sm-6" style="display: none;" id="ifc-number">
                                        <div class="mb-20">
                                            <label class="form-label fw-semibold text-primary-light text-sm mb-8">IFSC Number</label>
                                            <div class="position-relative">
                                                <input type="text" class="form-control radius-8" name="ifc_number" placeholder="IFC Number" value="">
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
                                        @foreach($user->bankAccounts as $bankAccount)
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
                            <div class="col-12">
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
                                        @foreach($user->bankAccounts as $bankAccount)
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
                            <div class="col-12">
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
                                        @foreach($user->bankAccounts as $bankAccount)
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
@endsection

@section('js')
<script src="{{asset('assets/js/lib/') }}/confirmation-modal.min.js"></script>


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
    // Gather all input fields including hidden ones
    const formData = $('#bank-account-form').serializeArray().reduce(function(obj, item) {
        // Only include non-empty fields
        if (item.value.trim() !== '') {
            obj[item.name] = item.value;
        }
        return obj;
    }, {});

    // Basic validation: Ensure 'payment_method' is selected
    if (!formData['payment_method']) {
        showToast('Please select a payment method.', 'error');
        return;
    }

    // Additional validation for 'bank-transfer' method
    if (formData['payment_method'] === 'bank-transfer') {
        const requiredFields = ['account_holder_name', 'account_number', 'bank_name','ifc_number'];
        const missingFields = requiredFields.filter(field => !formData[field]);

        if (missingFields.length > 0) {
            showToast('Please fill all the required fields for Bank Transfer.', 'error');
            return;
        }
    }

    // Determine method and URL based on `bank_id`
    const method = formData['bank_id'] ? 'PUT' : 'POST';
    const url = formData['bank_id']
        ? '{{ route("bank_accounts.update", ":id") }}'.replace(':id', formData['bank_id'])
        : '{{ route("users.bankAccount") }}';

    // AJAX request
    $.ajax({
        url: url,
        method: method,
        headers: {
            "X-CSRF-TOKEN": '{{ csrf_token() }}'
        },
        data: formData,
        success: function(response) {
            if (response.status === 'success') {
                showToast(response.message, 'success');
                // Reload the page to ensure updates are reflected
                window.location.reload();
            }
        },
        error: function(xhr) {
            const errors = xhr.responseJSON.errors;
            let errorMessage = '';
            // Check for specific errors or a general message
            if (errors) {
                // Loop through each error and concatenate them
                $.each(errors, function(key, messages) {
                    errorMessage += messages.join(' ') + '<br>';
                });
            } else {
                errorMessage = xhr.responseJSON.message || 'An unknown error occurred.';
            }

            showToast(errorMessage, 'error');
        }
    });
}


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


$(document).on('click', '.edit', function () {
    const bankAccountId = $(this).data('id');

    // Validate bankAccountId
    if (!bankAccountId) {
        showToast('Invalid bank account ID.', 'error');
        return;
    }

    // Construct the URL dynamically
    const url = '{{ route("users.bankAccount.edit", ":id") }}'.replace(':id', bankAccountId);

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
                $('input[name="account_holder_name"]').val(bankAccount.account_holder_name || '');
                $('input[name="account_number"]').val(bankAccount.account_number || '');
                $('input[name="crypto_wallet"]').val(bankAccount.crypto_wallet || '');
                $('input[name="bank_name"]').val(bankAccount.bank_name || '');
                $('input[name="ifc_number"]').val(bankAccount.ifc_number || '');
                $('input[name="upi_number"]').val(bankAccount.upi_number || '');
                $('input[name="_method"]').val('PUT');
                togglePaymentFieldsEdit();
                console.log(typeof togglePaymentFields);
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
</script>

<script>
  
    $(document).ready(function () {
        var hash = window.location.hash; // Get the hash from the URL
        if (hash) {
            // If there's a hash, activate the corresponding tab
            $(hash).trigger('click');
        }
    });

    // AJAX function for image upload
    $("#imageUpload").on("change", function () {
        var formData = new FormData();
        formData.append("profile_image", this.files[0]);

        $.ajax({
            url: '{{ route("users.uploadProfileImage") }}',
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": '{{ csrf_token() }}'
            },
            success: function (response) {
                if (response.success) {
                    $('#user_image').attr('src', response.profile_image);
                    //alert("Profile image uploaded successfully!");
                } else {
                    showToast("Error uploading image. Please try again.", "error");
                }
            },
            error: function (xhr) {
                showToast(xhr.responseJSON.message, "error");
            }
        });
    });

    function convertImageUrlToDataUrl(imageUrl, callback) {
        if (window.Worker) {
            // Check if Web Workers are supported in the browser
            const worker = new Worker("{{ asset('assets/js/worker.js') }}"); // Path to your worker.js file

            // Send the image URL to the worker for processing
            worker.postMessage(imageUrl);

            // Receive the processed data URL from the worker
            worker.onmessage = function (e) {
                const dataURL = e.data;

                if (dataURL) {
                    // Pass the data URL to the callback
                    callback(dataURL);
                } else {
                    console.error('Error processing image in worker.');
                }

                // Terminate the worker after use
                worker.terminate();
            };
        } else {
            console.error("Your browser does not support Web Workers.");
        }
    }

    // Usage example
    const imageUrl = '{{ $profile_image }}'; // Replace with your image URL
    convertImageUrlToDataUrl(imageUrl, function (dataURL) {
        //console.log(dataURL); // This is the Base64-encoded data URL
        // You can now set this as the src for an image preview or send it via AJAX
        document.getElementById("imagePreview").style.backgroundImage = `url(${dataURL})`;// Set the background image of an element
    });

    // JavaScript/jQuery to handle the profile update
    $('#updateProfileForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: '{{route("users.updateProfile")}}',
            type: 'POST',
            headers: {
                "X-CSRF-TOKEN": '{{ csrf_token() }}'
            },
            data: {
                user_id: $('#user_id').val(),
                name: $('#name').val(),
                email: $('#email').val(),
                phone_number: $('#phone_number').val(),
                language: $('#Language').val(),
                password: $('#password').val()
            },
            success: function (response) {
                if (response.success) {
                    showToast('Profile updated successfully!', 'success');

                    window.location.href = "{{ route('users.user_profile') }}";
                    // Optionally, update the page with the new data
                } else {
                    showToast('Failed to update profile.', 'error');
                }
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
    });


   // Submit the form using AJAX
// $('#bank-account-form').submit(function (e) {
//     e.preventDefault();

//     // Dynamically gather visible input fields
//     const visibleInputs = $('#bank-account-form')
//         .find(':input:visible') // Only visible inputs
//         .serializeArray(); // Serialize form fields into a key-value array

//     const formData = {};
//     // Convert serialized array to key-value pairs
//     visibleInputs.forEach(input => {
//         formData[input.name] = input.value;
//     });

//     // Basic validation (Optional: Customize based on requirements)
//     if (!formData['payment_method']) {
//         showToast('Please select a payment method.', 'error');
//         return;
//     }

//     if (formData['payment_method'] === 'bank-transfer' &&
//         (!formData['account_holder_name'] || !formData['account_number'] || !formData['branch_name'])) {
//         showToast('Please fill all the required fields for Bank Transfer.', 'error');
//         return;
//     }

//     // Set method and URL for the request
//     const method = formData['bank_id'] ? 'PUT' : 'POST';
//     const url = formData['bank_id']
//         ? '{{ route("users.bankAccount") }}/' + formData['bank_id']
//         : '{{ route("users.bankAccount") }}';

//     // AJAX request
//     $.ajax({
//         url: url,
//         method: method,
//         headers: {
//             "X-CSRF-TOKEN": '{{ csrf_token() }}'
//         },
//         data: formData,
//         success: function (response) {
//             if (response.status === 'success') {
//                 showToast(response.message, 'success');
//                 window.location.href = "{{ route('users.user_profile') }}#pills-change-bank-accounts-tab";

//                 // Reload the page to ensure the hash is taken into account
//                 window.location.reload();
//             }
//         },
//         error: function (xhr) {
//             const errors = xhr.responseJSON.errors;
//             let errorMessage = '';

//             // Check for specific errors or a general message
//             if (errors) {
//                 // Loop through each error and concatenate them
//                 $.each(errors, function (key, messages) {
//                     errorMessage += messages.join(' ') + '<br>';
//                 });
//             } else {
//                 errorMessage = xhr.responseJSON.message || 'An unknown error occurred.';
//             }

//             showToast(errorMessage, 'error');
//         }
//     });
// });


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
        let url = `{{ route('bank_accounts.destroy', ':id') }}`.replace(':id', id);
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
       
       

        // Show fields based on selection
        if (paymentMethod === 'bank-transfer') {
            document.getElementById('account-title').style.display = 'block';
        document.getElementById('account-number').style.display = 'block';
        // document.getElementById('IBAN-number').style.display = 'block';
        document.getElementById('bank-name').style.display = 'block';
        document.getElementById('ifc-number').style.display = 'block';
        } else if (paymentMethod === 'upi') {
            document.getElementById('account-title').style.display = 'block';
            document.getElementById('UPI-number').style.display = 'block';
        document.getElementById('upi-qr-code').style.display = 'block';
        } else if (paymentMethod === 'crypto') {
            document.getElementById('account-title').style.display = 'block';
        document.getElementById('crypto-wallet').style.display = 'block';
        document.getElementById('upi-qr-code').style.display = 'block';
        var label = document.querySelector('#upi-qr-code .form-label');
    if (label) {
        label.innerHTML = 'Crypto QR Code';  // This will change the label text to "Crypto QR Code"
    }
        }
    }
</script>

@endsection
