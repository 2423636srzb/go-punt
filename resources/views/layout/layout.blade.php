<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<x-head />

<body>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <?php 
        if(Auth::Check())
            if(Auth::user()->is_admin == 1){ ?>
    <x-sidebaradmin />
    <?php
            } else { ?>
    <x-sidebar />
    <?php }
        ?>

    <main class="dashboard-main">

        <!-- ..::  navbar start ::.. -->
        <x-navbar />
        <!-- ..::  navbar end ::.. -->
        <div class="dashboard-main-body">

            <!-- ..::  breadcrumb  start ::.. -->
            <x-breadcrumb title='{{ $title }}' subTitle='{{ $subTitle }}' />
            <!-- ..::  header area end ::.. -->

            @yield('content')
        </div>
            @include('layout.paymentModal')
        </div>
        <!-- ..::  footer  start ::.. -->
        <x-footer />
        <!-- ..::  footer area end ::.. -->

        <div id="toast"
            class="toast hidden fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-md shadow-lg z-50">
            <p id="toast-message">Signup successful!</p>
        </div>
    </main>

    <!-- ..::  scripts  start ::.. -->
    <x-scripts script="{!! isset($script) ? $script : '' !!}" />

    @yield('js')
    <!-- ..::  scripts  end ::.. -->
    <script>
        function logout() {
            $.ajax({
                url: '{{ route("logout") }}', // Laravel logout route
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    window.location.href = "{{route('home')}}"; // Redirect to home page after logout
                },
                error: function (error) {
                    alert("Logout failed");
                }
            });
        }


    </script>

@section('js')
    <script src="{{ asset('assets/js/lib/') }}/confirmation-modal.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/lib/') }}/pekeUpload.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/lib/') }}/pekeUpload.css" type="text/css" />
@endsection

<script>
function viewWithDrawRequest(id) {
    // Fetch withdrawal data using AJAX
    fetch(`/withdrawal/${id}`)
        .then(response => response.json())
        .then(data => {
            console.log(data); // Debugging - Ensure data is received
            
            // ✅ Update Labels
            $('#withdrawRequestUser').text(data.user_name || 'N/A');
            $('#withdrawPlatform').text(data.payment_method || 'N/A');
            $('#withdrawAccountDetail').text(data.payment_detail || 'N/A');
            $('#withdrawAmount').text(data.amount || 'N/A');
            $('#withdrawRequestCreatedAt').text(data.created_at || 'N/A');

            // ✅ Show QR Code If Available
            if (data.QRCode !== null) {
                const captionStyles = {
                    'upi': { text: 'UPI QR CODE', class: 'text-primary' },
                    'crypto': { text: 'CRYPTO QR CODE', class: 'text-success' }
                };

                const paymentType = data.payment_method ? data.payment_method.toLowerCase() : '';
                const caption = captionStyles[paymentType];

                $('.requestScreenShot1').html(`
                    <div class="text-center">
                        <img width="300" src="${data.QRCode}" alt="QR Code" class="mb-2"/>
                        ${caption ? `<div class="mt-3 ${caption.class} fw-bold">${caption.text}</div>` : ''}
                    </div>
                `);
            } else {
                $('.requestScreenShot1').html('<p>Bank Transfer</p>');
            }

            // ✅ Show Bank Details If Needed
            if (data.payment_method === 'bank-transfer') {
                $('#withdrawBankName').show();
                $('#withdrawBankNameLabel').text(data.bankName || 'N/A');

                $('#withdrawBranchName').show();
                $('#withdrawBranchNameLabel').text(data.branchName || 'N/A');

                $('#withdrawIFCNumber').show();
                $('#withdrawIFCNumberLabel').text(data.ifcNumber || 'N/A');
            } else {
                $('#withdrawBankName').hide();
                $('#withdrawBranchName').hide();
                $('#withdrawIFCNumber').hide();
            }

            // ✅ Set Approve/Reject Button Links
            $('.approve-withdraw_request').attr('href', `/withdraw-request-approve/${data.id}`);
            $('.reject-withdraw_request').attr('href', `/withdraw-request-reject/${data.id}`);

            // ✅ Show Modal
            $('#withdrawRequestViewModal').modal('show');
        })
        .catch(error => {
            console.error('Error fetching withdrawal data:', error);
        });
}




    let inactivityTimeout;
let logoutTime; // Timeout duration in milliseconds
const warningTime = 3300 * 1000; // 55 minutes for users (adjust as needed)

// Dynamically set `logoutTime` based on user role
function setLogoutTime() {
    // Example: Fetch user role from a meta tag or another source
    const isAdmin = document.querySelector('meta[name="is-admin"]').getAttribute('content') === '1';

    // Set timeout: 24 hours for admins, 1 hour for users
    logoutTime = isAdmin ? 86400 * 1000 : 3600 * 1000; // 24 hours or 1 hour
}

function resetInactivityTimer() {
    clearTimeout(inactivityTimeout);
    inactivityTimeout = setTimeout(() => {
        alert('You have been inactive. You will be logged out.');
        fetch('/logout', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => {
            if (response.ok) {
                window.location.href = '/'; // Redirect to the home page or login page
            } else {
                console.error('Logout failed');
            }
        }).catch(error => console.error('Error:', error));
    }, logoutTime);
}

// Initialize the script
setLogoutTime(); // Set logout time based on role
document.addEventListener('mousemove', resetInactivityTimer);
document.addEventListener('keypress', resetInactivityTimer);

resetInactivityTimer(); // Initialize the inactivity timer
 // Initialize the timer
</script>

<script>
    $('#withdrawalForm').on('submit', function (e) { 
    e.preventDefault(); // Prevent page reload

    var amount = $('#Drawamount').val();
    // var accountOption = $("input[name='accountOption']:checked").val();

    var formData = new FormData();
    formData.append('amount', amount);
    // formData.append('accountOption', accountOption);

    // if (accountOption === 'newAccount') {
    //     formData.append('newAccountData[bankName]', $('#bankName').val());
    //     formData.append('newAccountData[accountNumber]', $('#accountNumber').val());
    //     formData.append('newAccountData[accountHolderName]', $('#accountHolderName').val());
    //     formData.append('newAccountData[iban]', $('#iban').val());
    // } else {
        formData.append('bankId', $('#savedAccounts').val());
    // }

    console.log([...formData]); // Debugging to check the data being sent

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '{{ route('submitWithdrawal') }}',
        type: 'POST',
        data: formData,
        processData: false, // Don't process the data
        contentType: false, // Let the browser set the content type
        success: function (response) {
            location.reload(); 
        },
        error: function (xhr, status, error) {
            alert('Error occurred while processing withdrawal');
        }
    });
});

</script>



    <!-- JavaScript to Toggle Account Options -->
    <script>
        function toggleAccountOptions() {
    const savedAccountsDropdown = document.getElementById('savedAccountsDropdown');
    const newAccountFields = document.getElementById('newAccountFields');
    const isSavedAccount = document.getElementById('savedAccount').checked;

    if (isSavedAccount) {
        savedAccountsDropdown.style.display = 'block'; // Show saved accounts dropdown
        newAccountFields.style.display = 'none'; // Hide new account fields
    } else {
        savedAccountsDropdown.style.display = 'none'; // Hide saved accounts dropdown
        newAccountFields.style.display = 'block'; // Show new account fields
    }
}

$(document).ready(function () {
    $("#dropArea").pekeUpload({
        dragMode: true,
        bootstrap: false,
        btnText: 'Upload Files ...',
        allowedExtensions: "jpeg|jpg|png",
        url: '{{ route('games.uploadAccounts') }}',
        data: {
            _token: '{{ csrf_token() }}'
        },
        onFileSuccess: function (file, response) {
            showToast('File uploaded successfully and accounts assigned to users', 'success');
            $('#uploadModal').modal('hide');
            setTimeout(() => {
                window.location.reload();
            }, 500);
        },
        onFileError: function (file, error) {
            console.error('File upload failed:', error);
        }
    });

    // Optional: Show image preview when file is selected
    $("#dropArea input[type='file']").on("change", function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $("#imagePreview").attr("src", e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });
});

   
        $(document).ready(function() {
            $('#transactionForm').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Create FormData object
                let formData = new FormData(this);

                // AJAX request
                $.ajax({
                    url: '{{ url('transaction-store') }}', // Corrected to use the named route
                    type: 'POST',
                    data: formData,
                    processData: false, // Prevent jQuery from processing the data
                    contentType: false, // Set content type to false for FormData
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // Include CSRF token
                    },
                    beforeSend: function() {
                        // Optional: Add a loader or disable the submit button
                        $('#sendRequest').prop('disabled', true).text(
                            'Submitting...');
                    },
                    success: function(response) {
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
                    error: function(xhr) {
                        // Handle error response
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessages = Object.values(errors).flat().join('\n');
                            showToast('Validation Error:\n' + errorMessages);
                        } else {
                            showToast('An unexpected error occurred. Please try again.');
                        }
                    },
                    complete: function() {
                        // Re-enable the submit button
                        $('#sendRequest').prop('disabled', false)
                            .text('Send Request');
                    }
                });
            });
        });
   


</script>


<script>
    function refreshAnalytics() {
        axios.get('/analytics-data')
            .then(response => {
                const data = response.data;

                // Update DOM elements
                document.querySelector('#activeUsers').innerText = data.activeUsers;
                document.querySelector('#newUsers').innerText = data.newUsers;
                document.querySelector('#uniqueUsers').innerText = data.uniqueUsers;
                document.querySelector('#avgEngagementTime').innerText = data.avgEngagementTime;
            })
            .catch(error => {
                console.error('Error fetching analytics data:', error);
            });
    }

    // Refresh every 60 seconds
    setInterval(refreshAnalytics, 60000);

    // Initial load
    refreshAnalytics();
</script>
<script>
    let isNavigating = false;
    let isRefreshing = false;

    // Detect link clicks inside the application
    document.addEventListener("click", function (event) {
        let target = event.target.closest("a");
        if (target && target.href) {
            isNavigating = true; // User is navigating inside the app
        }
    });

    // Detect form submissions inside the application
    document.addEventListener("submit", function () {
        isNavigating = true; // User is navigating inside the app
    });

    // Detect page refresh and set the flag
    window.onbeforeunload = function () {
        isRefreshing = true; // Page is refreshing
    };

    // Detect actual tab close or browser exit
    window.addEventListener("beforeunload", function (event) {
        if (!isNavigating && !isRefreshing) {
            navigator.sendBeacon("{{ route('logout') }}");
        }
    });

    // Reset flags after navigation or refresh
    window.addEventListener("load", function () {
        isNavigating = false;
        isRefreshing = false;
    });
</script>
</body>

</html>