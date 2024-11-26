@extends('layout.layout')

@php
    $title = 'Account Management';
    $subTitle = 'Account Management';
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
            <h5 class="card-title mb-0">Games</h5>

            <div class="ms-auto d-flex gap-2">
                <button type="button" onclick="addAccont()"
                    class="btn btn-sm rounded-pill btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2">
                    Add
                    Accounts
                </button>
                <button type="button"
                    class="btn btn-sm rounded-pill btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#fileUploadModal">
                    <iconify-icon icon="material-symbols:upload-sharp" class="text-xl"></iconify-icon> Upload
                    Accounts
                </button>


            </div>
        </div>
        <div class="card-body">
            <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                <thead>
                    <tr>
                        <th scope="col">Platform</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Assigned </th>
                        <th scope="col">Available </th>
                        <th scope="col">Status</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach ($games as $game)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ url($game->logo) }}" alt="{{ $game->name }}"
                                        class="flex-shrink-0 me-12 radius-8" width="50" />
                                    <h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $game->name }}</h6>
                                </div>
                            </td>
                            {{-- <td>
                                @php
                                    $usernames = $game->accounts->map(function ($account) {
                                        return $account->userAccount->user->username ?? '';
                                    })->unique();
                                @endphp
                                {{ $usernames->join('/') }}
                            </td> --}}
                            <td>{{ $game->created_at }}</td>
                            <td><a href="{{ route('accounts.assigned', [$game->id]) }}">{{ $game->assigned_count }} </a>
                            </td>
                            <td>{{ $game->available_count }}</td>
                            <td>
                                <span
                                    class=" @if ($game->status == 'active') bg-success-focus text-success-main @else bg-danger-focus text-danger-main @endif px-24 py-4 rounded-pill fw-medium text-sm"
                                    id="game-status-{{ $game->id }}">
                                    @if ($game->status == 'active')
                                        Active
                                    @else
                                        Inactive
                                    @endif
                                </span>

                            </td>
    
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- View Game Modal -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-xl mb-0" id="addTaskModalLabel"><span class="game-name"></span></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="taskForm">
                        <input type="hidden" id="editTaskId" value="">
                        <div class="mb-3">
                            <label for="taskTitle"
                                class="form-label fw-semibold text-primary-light text-sm mb-8 me-12">Name: </label>
                            <span class="game-name"></span>
                        </div>
                        <div class="mb-3">
                            <label for="taskTag" class="form-label fw-semibold text-primary-light text-sm mb-8 me-12">Logo:
                            </label>
                            <img id="game-logo" src="" alt="Game Logo" width="100">
                        </div>
                        <div class="mb-3">
                            <label for="startDate"
                                class="form-label fw-semibold text-primary-light text-sm mb-8 me-12">Login
                                Link: </label>
                            <a href="" id="game-login-link" target="_blank">Game Link</a>
                        </div>
                        <div class="mb-3">
                            <label for="taskDescription"
                                class="form-label fw-semibold text-primary-light text-sm mb-8 me-12">Game
                                Status: </label>
                            <span id="game-status"></span>
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

    <!-- Bootstrap Modal for Uploading and Downloading Excel File -->
    <div class="modal fade" id="fileUploadModal" tabindex="-1" aria-labelledby="fileUploadModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false" data-bs-focus="false">
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


    <div class="modal fade" id="addAccount" tabindex="-1" aria-labelledby="fileUploadModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false" data-bs-focus="false">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h6 class="modal-title text-xl mb-0" id="addTaskModalLabel"><span class="game-name">Add Account</span></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Two-column Layout -->
                    <form class="row gy-3 needs-validation" action="{{ route('account.store') }}" method="POST"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="col-md-6">
                            <label for="platform" class="form-label">Select Platform</label>
                            <select class="form-select" required id="platform" name="platform_id" required>
                                <option selected disabled>Choose a platform</option>
                                @foreach ($platforms as $platform)
                                    <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" required name="username" id="username" class="form-control"
                                placeholder="Enter Account Username" required>
                            <div class="invalid-feedback">
                                Please provide username
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="text" required name="password" id="password" class="form-control"
                                placeholder="Enter Account Password" required>
                            <div class="invalid-feedback">
                                Please provide password
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary-600" type="submit">Add Account</button>
                        </div>
                    </form>
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
        function addAccont() {
            $('#addAccount').modal('show');
        }
        $(document).ready(function() {
            $("#file").pekeUpload({
                dragMode: true,
                bootstrap: false,
                url: '{{ url('games/uploadAccountMultiplee') }}',
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
