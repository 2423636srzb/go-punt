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
<div class="row row-cols-xxxl-3 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4">
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-1 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">TOTAL BALANCE</p>
                        <h6 class="mb-0">{{$depositeSum}}</h6>
                    </div>

                    <div
                        class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="hugeicons:money-send-square"
                            class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center gap-1 text-success-main">
                        <!-- <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> --> {{ isset($lastApprovedRequest->amount)?$lastApprovedRequest->amount:0}}
                       
                    </span>
                    Last Transaction
                </p>
            </div>
        </div><!-- card end -->
    </div>
    <!--
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-2 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total Subscription</p>
                            <h6 class="mb-0">15,000</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fa-solid:award" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-danger-main">
                            <iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon> -800
                        </span>
                        Last 30 days subscription
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow-none border bg-gradient-start-3 h-100">
                <div class="card-body p-20">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                        <div>
                            <p class="fw-medium text-primary-light mb-1">Total Free Users</p>
                            <h6 class="mb-0">5,000</h6>
                        </div>
                        <div class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                            <iconify-icon icon="fluent:people-20-filled" class="text-white text-2xl mb-0"></iconify-icon>
                        </div>
                    </div>
                    <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                        <span class="d-inline-flex align-items-center gap-1 text-success-main">
                            <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +200
                        </span>
                        Last 30 days users
                    </p>
                </div>
            </div>
        </div>
    -->
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-4 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">TOTAL DEPOSIT</p>
                        <h6 class="mb-0">{{$depositeSum}}</h6>
                    </div>
                    <div
                        class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="solar:wallet-bold" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center gap-1 text-success-main">
                        <!--<iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon>-->
                        {{$depositePendingRequest}}
                    </span>
                    Last Deposit
                </p>
            </div>
        </div><!-- card end -->
    </div>

    <div class="col">
        <div class="card shadow-none border bg-gradient-start-5 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">TOTAL WITHDRAWAL</p>
                        <h6 class="mb-0">{{$withDrawSum}}</h6>
                    </div>
                    <div class="w-50-px h-50-px bg-red rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="fa6-solid:file-invoice-dollar"
                            class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center gap-1 text-danger-main">
                        <!--<iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon>-->
                        {{$withDrawSumPendingRequest}}
                    </span>
                    Last Withdrawal
                </p>
            </div>
        </div><!-- card end -->
    </div>
</div>

<div class="row gy-4 mt-1">
    <div class="col-xxl-9 col-xl-12">
        <div class="card h-100">
            <div class="card-body p-24">

                <div class="d-flex flex-wrap align-items-center gap-1 justify-content-between mb-16">
                    <ul class="nav border-gradient-tab nav-pills mb-0" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center active" id="pills-to-do-list-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-to-do-list" type="button" role="tab"
                                aria-controls="pills-to-do-list" aria-selected="true">
                                Assigned Accounts
                                <span
                                    class="text-sm fw-semibold py-6 px-12 bg-neutral-500 rounded-pill text-white line-height-1 ms-12 notification-alert">{{$userAccountsCount}}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center" id="pills-recent-leads-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-recent-leads" type="button" role="tab"
                                aria-controls="pills-recent-leads" aria-selected="false" tabindex="-1">
                                Pending Accounts
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
                                                <img src="{{url($userAccount->game_logo)}}" alt=""
                                                    class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                                <div class="flex-grow-1">
                                                    <h6 class="text-md mb-0 fw-medium">{{$userAccount->game_name}}</h6>
                                                    <span class="text-sm text-secondary-light fw-medium"><a
                                                            href="{{$userAccount->login_link}}"
                                                            target="_blank">{{$userAccount->login_link}}</a></span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="copy-container">
                                                <span id="user-email">{{$userAccount->username}}</span>
                                                <iconify-icon icon="mage:copy" class="icon" onclick="copyToClipboard('user-email')" title="Copy Email"></iconify-icon>
                                            </div>
                                            <br />
                                            <div class="copy-container">
                                                <span class="user-password" data-password="{{$userAccount->password}}" data-row-id="{{$userAccount->id}}">
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
                <div class="row">
                @foreach ($userAccounts as $userAccount)
                  <div class="col-md-3"> <!-- Ensure each game takes up 3 columns (4 games per row) -->
                    <div class="crypto-box mt-4 d-flex flex-column align-items-center justify-content-center">
                      <div class="center text-center">
                        <span class="icon-btc">
                          <img src="{{url($userAccount->game_logo)}}" alt="Game 1 Logo" width="125" class="mx-auto mb-2 rounded-lg transition-transform duration-300">
                        </span>
                        <h6 class="price">{{$userAccount->game_name}}</h6>
                        <div class="copy-container">
                        <span id="user-email">{{$userAccount->username}}</span>
                        <iconify-icon icon="mage:copy" class="icon" onclick="copyToClipboard('user-email')" title="Copy Email"></iconify-icon>
                         </div>
                        <br />
                        <div class="copy-container">
                         <span class="user-password" data-password="{{$userAccount->password}}" data-row-id="{{$userAccount->id}}">
                          ..........
                         </span>
                        <iconify-icon icon="mage:copy" class="icon" onclick="copyToClipboard(this)" title="Copy Password"></iconify-icon>
                        <iconify-icon class="eye-icon cursor-pointer" icon="mdi:eye" onclick="showPassword(this)" title="Show Password"></iconify-icon>
                        </div>
                        <div class="live-button-container">
                            <a href="{{$userAccount->login_link}}">
                                <button class="circular-button">
                                <img src="{{asset('assets/images/BD/play-now.jpg')}}" alt="Live Stream" class="button-image" />
                                </button>
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
    <div class="col-xxl-3 col-xl-12">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                    <h6 class="mb-2 fw-bold text-lg mb-0">Payment Request</h6>
                    <a href="javascript:void(0)"
                        class="text-primary-600 hover-text-primary d-flex align-items-center gap-1">
                        View All
                        <iconify-icon icon="solar:alt-arrow-right-linear" class="icon"></iconify-icon>
                    </a>
                </div>

                <div class="mt-32">
                    @foreach ($transactions as $transaction )
                    <div class="d-flex align-items-center justify-content-between gap-3 mb-24">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset($transaction->image) }}" alt=""
                                class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                            <div class="flex-grow-1">
                                <h6 class="text-md mb-0 fw-medium">{{ $transaction->name }}</h6>
                                <span class="text-sm text-secondary-light fw-medium">Status: <span
                                        class="@if($transaction->status == 'approved') text-success @endif @if($transaction->status == 'rejected') text-danger @endif @if($transaction->status == 'pending') text-info @endif">{{ $transaction->status }}</span></span>
                            </div>
                        </div>
                        <span class="text-primary-light text-md fw-medium">{{setCurrency($transaction->amount)}}</span>
                    </div> 
                    @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
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