<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">

<x-head />

<body>
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
    $('#withdrawalForm').on('submit', function (e) { 
    e.preventDefault(); // Prevent page reload

    var amount = $('#withDrawamount').val();
    var accountOption = $("input[name='accountOption']:checked").val();

    var formData = new FormData();
    formData.append('amount', amount);
    formData.append('accountOption', accountOption);

    if (accountOption === 'newAccount') {
        formData.append('newAccountData[bankName]', $('#bankName').val());
        formData.append('newAccountData[accountNumber]', $('#accountNumber').val());
        formData.append('newAccountData[accountHolderName]', $('#accountHolderName').val());
        formData.append('newAccountData[iban]', $('#iban').val());
    } else {
        formData.append('bankId', $('#savedAccounts').val());
    }

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
                        $('#transactionForm button[type="submit"]').prop('disabled', true).text(
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
                        $('#transactionForm button[type="submit"]').prop('disabled', false)
                            .text('Send Request');
                    }
                });
            });
        });
   


</script>
</body>

</html>