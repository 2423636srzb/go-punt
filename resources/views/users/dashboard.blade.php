@extends('layout.layout')

@php
    $title = 'Dashboard';
    $subTitle = 'Home';
    $script = '
<script src="' . asset('assets/js/homeOneChart.js') . '"></script>';

@endphp

@section('content')
    <style>
        .copy-container {
            display: inline-flex;
            align-items: center;
            /* Align text and icon in the center vertically */
            gap: 8px;
            /* Space between text and icon */
        }

        .icon {
            cursor: pointer;
            /* Change cursor to pointer for clickable icon */
            font-size: 1.2em;
            /* Adjust icon size as needed */
            color: #007bff;
            /* Customize icon color */
            transition: color 0.3s ease;
            /* Smooth transition for hover */
        }

        .icon:hover {
            color: #0056b3;
            /* Darken color on hover for a subtle effect */
        }
    </style>
    {{-- new card --}}
    <div class="row row-cols-xxxl-4 row-cols-lg-4  row-cols-sm-2 row-cols-1 gy-4">
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-1 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Assigned Sites</p>
                            <h6 class="mb-0">{{ $userAccountsCount }}</h6>
                        </div>
                        <div
                            class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:map-marker-outline" class="text-white text-2xl mb-0"></iconify-icon>

                        </div>
                    </div>
                    {{-- <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main">
                            {{ isset($lastApprovedRequest->amount) ? $lastApprovedRequest->amount : 0 }}
                        </span>
                        Last Transaction
                    </p> --}}
                </div>
            </div><!-- card end -->
        </div>
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-5 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">TOTAL DEPOSIT</p>
                            <h6 class="mb-0">{{ $depositeSum }}</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-red rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa6-solid:file-invoice-dollar"
                            class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-danger-main">
                            {{ $depositePendingRequest }}
                        </span>
                        Last Deposit
                    </p>
                </div>
            </div><!-- card end -->
        </div>
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-3 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total  Withdrawal</p>
                            <h6 class="mb-0">{{ $withDrawSum }}</h6>
                        </div>
                        <div
                            class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="solar:wallet-bold" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-info-main">
                            {{ $withDrawSumPendingRequest }}
                        </span>
                        Last Withdrawal
                    </p>
                </div>
            </div><!-- card end -->
        </div>
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-4 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Bonus</p>
                            <h6 class="mb-0">{{ $totalBonus }}</h6>
                        </div>
                        <div
                            class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="mdi:gift" class="text-white text-2xl"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main">

                        </span>
                        <h3 class="text-lg font-semibold cursor-pointer text-blue-500 hover:underline" onclick="openBonusModal()">
                            Redeem Bonus
                        </h3>
                    </p>
                </div>
            </div><!-- card end -->
        </div>
    </div>

    <div class="row gy-4 mt-1">
        <div class="col-xxl-12 col-xl-12">
            <div class="card h-100">
                <div class="card-body p-24">

                    <div class="d-flex flex-wrap align-items-center gap-1 justify-content-between mb-16">
                        <ul class="nav border-gradient-tab nav-pills mb-0" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center active" id="pills-to-do-list-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-to-do-list" type="button" role="tab"
                                    aria-controls="pills-to-do-list" aria-selected="true">
                                    Our Gaming Panel
                                    <span
                                        class="text-sm fw-semibold py-6 px-12 bg-neutral-500 rounded-pill text-white line-height-1 ms-12 notification-alert">{{ $userAccountsCount }}</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center" id="pills-recent-leads-tab"
                                    data-bs-toggle="pill" data-bs-target="#pills-recent-leads" type="button" role="tab"
                                    aria-controls="pills-recent-leads" aria-selected="false" tabindex="-1">
                                    Upcoming Gaming Panel
                                    <span
                                        class="text-sm fw-semibold py-6 px-12 bg-neutral-500 rounded-pill text-white line-height-1 ms-12 notification-alert">0</span>
                                </button>
                            </li>
                        </ul>
                        <a href="javascript:void(0)"
                            class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                            View All
                            <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                        </a>
                    </div>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-to-do-list" role="tabpanel"
                            aria-labelledby="pills-to-do-list-tab" tabindex="0">
                            <!-- <div class="table-responsive scroll-sm">
                                <table class="table bordered-table sm-table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Platforms </th>
                                            <th scope="col">Credentials</th>
                                            <th scope="col">Balance</th>
                                            <th scope="col" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($userAccounts as $userAccount)
    <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ url($userAccount->game_logo) }}" alt=""
                                                        class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                    <div class="flex-grow-1">
                                                        <h6 class="text-md mb-0 fw-medium">{{ $userAccount->game_name }}</h6>
                                                        <span class="text-sm text-secondary-light fw-medium"><a
                                                                href="{{ $userAccount->login_link }}"
                                                                target="_blank">{{ $userAccount->login_link }}</a></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="copy-container">
                                                    <span id="user-email">{{ $userAccount->username }}</span>
                                                    <iconify-icon icon="mage:copy" class="icon" onclick="copyToClipboard('user-email')" title="Copy Email"></iconify-icon>
                                                </div>
                                                <br />
                                                <div class="copy-container">
                                                    <span class="user-password" data-password="{{ $userAccount->password }}" data-row-id="{{ $userAccount->id }}">
                                                        ..........
                                                    </span>
                                                    <iconify-icon icon="mage:copy" class="icon" onclick="copyToClipboard(this)" title="Copy Password"></iconify-icon>
                                                    <iconify-icon class="eye-icon cursor-pointer" icon="mdi:eye" onclick="showPassword(this)" title="Show Password"></iconify-icon>
                                                </div>
                                            </td>
                                            <td>{{ $userAccount->transaction_amount ?? 0 }}</td>
                                            <td class="text-center">
                                                <span class="bg-{{ $userAccount->status == 1 ? 'success-focus text-success-main' : 'danger-focus text-danger-main' }} px-24 py-4 rounded-pill fw-medium text-sm">
                                                    {{ $userAccount->status == 1 ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                        </tr>
    @endforeach
                                    </tbody>
                                </table>
                            </div> -->
                            <div id="messageContainer" style="display: none;" class="alert alert-info" role="alert">
                            </div>
                            <div class="row ">
                                @foreach ($userAccounts as $userAccount)
                                <div class="col-md-3 mt-10">
                                    <div class="crypto-box mt-4 d-flex flex-column align-items-center justify-content-center">
                                        <div class="center text-center">
                                            <span class="icon-btc">
                                                <img src="{{ url($userAccount->game_logo) }}" alt="Game 1 Logo"
                                                    width="125"
                                                    class="mx-auto mb-2 rounded-lg transition-transform duration-300">
                                            </span>
                                            <h6 class="price" style="font-size: 18px !important;" data-game-name="{{ $userAccount->game_name }}">
                                                {{ $userAccount->game_name }}
                                            </h6>
                                            <div class="copy-container">
                                                <span id="user-email" data-account-name="{{ $userAccount->username }}">
                                                    {{ $userAccount->username }}
                                                </span>
                                                <iconify-icon icon="mage:copy" class="icon"
                                                    onclick="copyToClipboard('user-email')"
                                                    title="Copy Email"></iconify-icon>
                                            </div>
                                            <br />
                                            <div class="copy-container">
                                                <span class="user-password"
                                                    data-password="{{ $userAccount->password }}"
                                                    data-row-id="{{ $userAccount->id }}">
                                                    ..........
                                                </span>
                                                <iconify-icon icon="mage:copy" class="icon"
                                                    onclick="copyToClipboard(this)"
                                                    title="Copy Password"></iconify-icon>
                                                <iconify-icon class="eye-icon cursor-pointer" icon="mdi:eye"
                                                    onclick="showPassword(this)"
                                                    title="Show Password"></iconify-icon>
                                            </div>

                                            <!-- Show Pending Request or Forgot Password -->
                                            @if ($userAccount->forgot_request_status === 'Pending')
                                                <span class="text-warning d-block" style="font-size:11px;">
                                                    Pending Request
                                                </span>
                                            @else
                                                <span class="text-primary d-block forgot-password"
                                                    style="font-size:11px; cursor:pointer;"
                                                    data-id="{{ $userAccount->id }}"
                                                    data-game-name="{{ $userAccount->game_name }}"
                                                    data-account-name="{{ $userAccount->username }}"
                                                    data-password="{{ $userAccount->password }}">
                                                    Forgot Password
                                                </span>
                                            @endif

                                            <div class="live-button-container">
                                                <a href="{{ $userAccount->login_link }}">
                                                    {{-- <button class="circular-button">
                                                        <img src="{{ asset('assets/images/BD/play-now.jpg') }}"
                                                            alt="Live Stream" class="button-image" />
                                                    </button> --}}
                                                        <button type="submit" class="btn btn-primary" style="padding: 5px 20px; margin-bottom: 10px; margin-top:10px;border-radius: 90px;color: #fff;display: inline-block;position: relative;overflow: hidden;">Play Now</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                    <script>
                        function showPassword(iconElement) {
                            // Get the parent span element that holds the password
                            const passwordSpan = iconElement.closest('.copy-container').querySelector('.user-password');

                            // Get the password from the data attribute
                            const password = passwordSpan.getAttribute('data-password');

                            // Temporarily show the password
                            const originalText = passwordSpan.innerText; // Save the original text
                            passwordSpan.innerText = password;

                            // Revert back to dots after 3 seconds
                            setTimeout(() => {
                                passwordSpan.innerText = originalText;
                            }, 3000); // 3 seconds delay
                        }
                    </script>
                    <div class="tab-pane fade" id="pills-recent-leads" role="tabpanel"
                        aria-labelledby="pills-recent-leads-tab" tabindex="0">
                        <div class="table-responsive scroll-sm">
                            <table class="table bordered-table sm-table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Users </th>
                                        <th scope="col">Registered On</th>
                                        <th scope="col">Plan</th>
                                        <th scope="col" class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('assets/images/users/user1.png') }}" alt=""
                                                    class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-medium">Dianne Russell</h6>
                                                    <span
                                                        class="text-sm text-secondary-light fw-medium">redaniel@gmail.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>27 Mar 2024</td>
                                        <td>Free</td>
                                        <td class="text-center">
                                            <span
                                                class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Active</span>
                                        </td>
                                    </tr> --}}

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Forgot Password Confirmation Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to request a password reset ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmForgotPassword">Confirm</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Bonus Modal -->
<div class="modal fade" id="bonusModal" tabindex="-1" aria-labelledby="bonusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="bonusModalLabel">Redeem Your Bonus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Display Total Bonus -->
                <p class="text-gray-700 text-center mb-3">Total Bonus:
                    <span class="font-semibold text-primary" id="bonusAmount">{{ $totalBonus }}</span>
                </p>

                <!-- Game Platform Dropdown -->
                <label for="gamePlatform" class="form-label">Select Platform:</label>
                <select id="gamePlatform" class="form-select">
                    <option value="">-- Select Platform --</option>
                    @foreach ($userAccounts as $userAccount)
                        <option value="{{ $userAccount->id }}" data-user-name="{{ $userAccount->game_name }}">
                            {{ $userAccount->game_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="assignBonus()">Redeem</button>
                <button type="button" class="btn btn-success" onclick="saveBonus()">Save</button>
            </div>
        </div>
    </div>
</div>

    </div>


@endsection

@section('js')

<script>
   // Open Modal Function (Bootstrap automatically handles this)
function openBonusModal() {
    let bonusModal = new bootstrap.Modal(document.getElementById("bonusModal"));
    bonusModal.show();
}

// Assign Bonus Function
function assignBonus() {
    let gamePlatformDropdown = document.getElementById("gamePlatform");
    let userAccountId = gamePlatformDropdown.value;
    let gamePlatformName = gamePlatformDropdown.options[gamePlatformDropdown.selectedIndex]?.dataset.userName;

    if (!userAccountId) {
        alert("Please select a game platform!");
        return;
    }

    fetch("{{ route('admin.assign.bonus') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            user_id: "{{ auth()->id() }}",
            user_account_id: userAccountId,
            game_name: gamePlatformName,
            totalBonus: "{{ $totalBonus }}"
        })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        let modal = bootstrap.Modal.getInstance(document.getElementById("bonusModal"));
        modal.hide(); // Close modal after success
        location.reload();
    })
    .catch(error => console.error('Error:', error));
}

// Save Bonus (Example function)
function saveBonus() {
    alert("Bonus saved successfully!");
    let modal = bootstrap.Modal.getInstance(document.getElementById("bonusModal"));
    modal.hide(); // Close modal after saving
}


        document.addEventListener("DOMContentLoaded", function() {
            let userId = null;
            let gameName = null;
            let accountName = null;
            let password = null;
            let loggedInUserName = "{{ auth()->user()->name }}"; // Get the logged-in username

            // Add event listeners to all forgot-password links
            document.querySelectorAll(".forgot-password").forEach(function(element) {
                element.addEventListener("click", function() {
                    userId = this.getAttribute("data-id"); // Get user account ID
                    gameName = this.getAttribute("data-game-name"); // Get game name
                    accountName = this.getAttribute("data-account-name"); // Get account name
                    password = this.getAttribute("data-password"); // Get password

                    let modal = new bootstrap.Modal(document.getElementById("forgotPasswordModal"));
                    modal.show();
                });
            });

            // Handle confirmation button click
            document.getElementById("confirmForgotPassword").addEventListener("click", function() {
    if (!userId) {
        showMessage('No user account selected.', 'alert-danger');
        return;
    }

    console.log("Submitting request for User ID:", userId); // Debugging output

    // Build form data for POST request
    let formData = new FormData();
    formData.append('user_account_id', userId);
    formData.append('game_name', gameName);
    formData.append('account_name', accountName);
    formData.append('password', password);
    formData.append('requested_by', loggedInUserName);

    // Pass parameters via POST request
    fetch("{{ route('forgot.password') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showMessage('Password reset request submitted successfully!', 'alert-success');
        } else {
            showMessage('Something went wrong. Please try again.', 'alert-danger');
        }

        // Hide the modal
        let modal = bootstrap.Modal.getInstance(document.getElementById("forgotPasswordModal"));
        modal.hide();
    })
    .catch(error => {
        console.error("Error:", error);
        showMessage('An error occurred. Please try again.', 'alert-danger');
    });
});


            function showMessage(message, alertClass) {
                let messageContainer = document.getElementById('messageContainer');
                messageContainer.innerHTML = message;
                messageContainer.classList.add(alertClass);
                messageContainer.style.display = 'block';

                // Hide message after 2 seconds
                setTimeout(function() {
                    messageContainer.style.display = 'none';
                    messageContainer.classList.remove(alertClass);
                }, 2000);
            }
        });





        function copyToClipboard(element) {
            let textToCopy;

            // Check if `element` is a string (id for email) or an HTML element (password)
            if (typeof element === "string") {
                // For email (uses id)
                const textElement = document.getElementById(element);
                textToCopy = textElement ? textElement.innerText : '';
            } else {
                // For password (uses data attribute)
                const passwordContainer = element.previousElementSibling;
                textToCopy = passwordContainer ? passwordContainer.getAttribute('data-password') : '';
            }

            if (textToCopy) {
                navigator.clipboard.writeText(textToCopy)
                    .then(() => alert('Copied to clipboard!'))
                    .catch(err => console.error('Failed to copy: ', err));
            } else {
                alert('Nothing to copy!');
            }
        }
    </script>
@endsection
