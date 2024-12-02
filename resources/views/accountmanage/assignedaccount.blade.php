@extends('layout.layout')

@php
    $title = 'Assigned Accounts';
    $subTitle = 'Accounts';
    $script = '
<script>
    let table = new DataTable("#dataTable");
</script>';
@endphp

@section('content')

    <div class="card basic-data-table">
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
        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="card-title mb-0">Accounts</h5>


        </div>
        <div class="card-body">
            <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">User</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $account)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ url($account->game->logo) }}" alt="{{ $account->game->name }}"
                                        class="flex-shrink-0 me-12 radius-8" width="50" />
                                    <h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $account->game->name }}</h6>
                                </div>
                            </td>
                            <td>{{$account->userAccount->user->username}}</td>
                            <td>{{ $account->username }}</td>
                            <td>{{ $account->password }}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="editAccount({{ $account->id }})"
                                   class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                   <iconify-icon icon="lucide:edit"></iconify-icon>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-xl mb-0" id="addTaskModalLabel"><span class="game-name"></span></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="gameModal" class="row gy-3 needs-validation" action="{{ route('account.update') }}"
                    method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="col-md-6">
                        <input type="hidden" name="id" id="id" value="" />
                        <label class="form-label">User Name</label>
                        <input type="text" name="username" id="username" disabled class="form-control" value=""
                            required>
                        <div class="valid-feedback">
                           Account Username
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Passoword</label>
                        <input type="text" name="password" required id="password" class="form-control" value=""
                        required>
                        <div class="invalid-feedback">
                           Account Password
                        </div>
                    </div>
                  
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select the game status.
                        </div>
                    </div>


                    <div class="col-12">
                        <button class="btn btn-primary-600" type="submit">Update Account</button>
                    </div>
                </form>
                </div>
                <div class="modal-footer justify-content-center gap-3">
                    <button type="button"
                        class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-50 py-11 radius-8"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>
    
                </div>
            </div>
        </div>
    </div>

    <script>
        function editAccunt(accountId) {
            $('#accountModal').modal('show');
            $.ajax({
                        url: `{{ url('account/') }}` + "/" + accountId,
                        type: 'GET',
                        success: function (response) {
                            document.getElementById('username').value = response.username;
                            document.getElementById('password').value = response.password;
                            document.getElementById('id').value = response.id;
                        },
                        error: function () {
                            showToast('Error deleting game.', 'error');
                        }
                    });
            // Make an AJAX request to fetch the game data by ID
            
        }
    </script>

    <!-- Bootstrap Modal for Uploading and Downloading Excel File -->
    <div class="modal fade" id="fileUploadModal" tabindex="-1" aria-labelledby="fileUploadModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="fileUploadModalLabel">Upload Data File</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Two-column Layout -->
                    <div class="row">
                        <!-- Left Side: File Upload Area -->
                        <div class="col-md-7">
                            <div
                                class="upload-area p-4 border border-2 border-dashed rounded text-center h-100 d-flex flex-column justify-content-center align-items-center">
                                <input type="file" name="file" id="file" accept=".xlsx, .xls"
                                    class="d-none">
                            </div>
                        </div>

                        <!-- Right Side: Download Sample Button -->
                        <div class="col-md-5 d-flex justify-content-center align-items-center">
                            <a href="{{ route('admin.sample.download') }}" class="btn btn-outline-primary">
                                <i class="bi bi-file-earmark-arrow-down"></i> Download Sample File
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{ asset('assets/js/lib/') }}/confirmation-modal.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/lib/') }}/pekeUpload.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/lib/') }}/pekeUpload.css" type="text/css" />

    <script>
        $(document).ready(function() {
            $("#file").pekeUpload({
                dragMode: true,
                bootstrap: false,
                url: '{{ route('games.uploadAccounts') }}',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                allowedExtensions: 'xlsx|xls',
                showPreview: true,
                showPercent: true,
                showFilename: true,
                dragText: 'Drag and Drop Files Here',
                onFileSuccess: function(file, response) {
                    showToast('File uploaded successfully and accounts assigned to users', 'success');
                    $('#fileUploadModal').modal('hide');
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                },
                onFileError: function(file, error) {
                    console.log(file);
                    console.error('File upload failed:', error);
                }
            });

            $('.game-detail').on('click', function() {
                const gameId = $(this).data('id');

                $.ajax({
                    url: `{{ url('games/') }}` + "/" + gameId,
                    type: 'GET',
                    success: function(data) {
                        // Populate modal fields with the data from the server
                        $('.game-name').text(data.name);
                        $('#game-logo').attr('src', `{{ asset('storage/') }}/${data.logo}`);
                        $('#game-login-link').attr('href', data.login_link).html(
                            "<i>Click here to open game page</i>");
                        $('#game-status').text(data.status.charAt(0).toUpperCase() + data.status
                            .slice(1));

                        // Show the modal
                        var addTaskModal = new bootstrap.Modal(document.getElementById(
                            "addTaskModal"));
                        addTaskModal.show();
                    }
                });
            });

            $('.delete-game').on('click', function() {
                const gameId = $(this).data('id');

                confirmationModal.show({
                        closeIcon: true,
                        message: 'Are you sure you want to delete this game?',
                        title: 'Delete Game',
                        no: {
                            class: 'btn btn-danger',
                            text: 'No'
                        },
                        yes: {
                            class: 'btn btn-success',
                            text: 'Yes'
                        }
                    })
                    .then(() => modalClosed(true))
                    .catch(() => modalClosed(false));

                const modalClosed = isYes => {

                    if (isYes) {
                        $.ajax({
                            url: `{{ url('games/') }}` + "/" + gameId,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}' // CSRF token for Laravel security
                            },
                            success: function(response) {
                                showToast('Game Deleted Successfully.',
                                'success'); // Red toast for error

                                // Optionally, remove the deleted game's row from the table

                                setTimeout(function() {
                                    location.reload();
                                }, 1000)

                            },
                            error: function() {
                                showToast('Error deleting game.', 'error');
                            }
                        });
                    } else {
                        // Do nothing
                    }
                };
            });

            // Disable game
            $('.switch-input').on('click', function() {
                const gameId = $(this).data('id');
                var curr_obj = $(this);
                var status = '';
                if ($(this).is(":checked")) {
                    status = 'enable';
                } else {
                    status = 'disable';
                }

                confirmationModal.show({
                        closeIcon: true,
                        message: 'Are you sure you want to ' + status + ' this game?',
                        title: 'Game Status',
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

                const modalClosed = isYes => {
                    if (isYes) {
                        $.ajax({
                            url: `{{ url('games/') }}` + "/" + gameId + "/" + status,
                            type: 'PATCH', // Use PATCH to update the status
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                showToast('Game ' + status + ' successfully.', 'success');
                                if (status == 'enable') {
                                    $('#game-status-' + gameId).removeClass(
                                        'text-danger-main bg-danger-focus');
                                    $('#game-status-' + gameId).addClass(
                                        'text-success-main bg-success-focus');

                                    $('#game-status-' + gameId).html('Active');
                                } else {
                                    $('#game-status-' + gameId).addClass(
                                        'text-danger-main bg-danger-focus');
                                    $('#game-status-' + gameId).removeClass(
                                        'text-success-main bg-success-focus');
                                    $('#game-status-' + gameId).html('Inactive');
                                }

                            },
                            error: function() {
                                showToast('Error ' + status + ' game.', 'error');
                                curr_obj.prop('checked', false);
                            }
                        });
                    } else {
                        curr_obj.prop('checked', (!$(this).is(":checked")));
                    }
                };

            });
        });
    </script>
@endsection
