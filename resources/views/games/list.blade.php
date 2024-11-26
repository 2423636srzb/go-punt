@extends('layout.layout')

@php
    $title = 'Game Management';
    $subTitle = 'Game Management';
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

                <button type="button"
                    class="btn btn-sm rounded-pill btn-primary-600 radius-8 px-20 py-11 d-flex align-items-center gap-2"
                    data-bs-toggle="modal" data-bs-target="#addGame" id="createGameBtn">
                    <iconify-icon icon="gridicons:add-outline" class="text-xl"></iconify-icon>Add
                    Game
                </button>

            </div>
        </div>
        <div class="card-body">
            <table class="table bordered-table mb-0" id="dataTable" data-page-length='10'>
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Login link</th>
                        <th scope="col">Created Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
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
                            <td>{{ $game->login_link }}</td>
                            <td>{{ $game->created_at }}</td>
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

                            <td>
                                <!-- <a href="javascript:void(0);" data-id="{{ $game->id }}"
                                class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center game-detail">
                                <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                            </a>
                        -->
                                <div class="form-switch switch-success d-inline-flex align-items-center">
                                    <input class="form-check-input switch-input" type="checkbox"
                                        data-id="{{ $game->id }}" role="switch"
                                        @if ($game->status == 'active') checked @endif>
                                </div>
                                <a href="javascript:void(0)" onclick="editGame({{ $game->id }})"
                                    class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                </a>

            
                            <a href="javascript:void(0)" data-id="{{ $game->id }}"
                                class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center delete-game">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </a>
                            
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade" id="addGame" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-xl mb-0" id="addTaskModalLabel"><span class="game-name">Create Game</span></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="gameModal" class="row gy-3 needs-validation" action="{{ route('games.store') }}"
                        method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                         <!-- Logo Preview Section -->
                      <div class="col-md-12 text-center mb-1">
                        <img id="logoPreview" src="" alt="Game Logo" class="img-fluid rounded" style="max-height: 50px; display: none;">
                       </div>
                        <div class="col-md-6">
                            <label class="form-label">Game Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Logo</label>
                            <input class="form-control" type="file" name="logo" id="logo" required>
                            <div class="invalid-feedback">
                                Please choose a file.
                            </div>
                        </div>
                      

                        <div class="col-md-6">
                            <label class="form-label">Login Link</label>
                            <input type="url" name="login_link" id="login_link" class="form-control"
                                placeholder="Enter Game Link" required>
                            <div class="invalid-feedback">
                                Please provide valid link.
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
                    </div>
                    <div class="modal-footer justify-content-center gap-3">
                        <button class="btn btn-primary-600" type="submit" id="submitButton">Create Game</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    


    <div class="modal fade" id="UpdateGame" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-xl mb-0" id="addTaskModalLabel"><span class="game-name"></span></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row gy-3 needs-validation" action="{{ route('games.update', ':id') }}" method="POST"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT') <!-- Add the PUT method for update -->
                        <div class="col-md-6">
                            <label class="form-label">Game Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Logo</label>
                            <input 
                                class="form-control" 
                                type="file" 
                                name="logo" 
                                id="logo" 
                                required 
                                onchange="updateFileName(this)">
                            <small id="file-name" class="form-text text-muted mt-1"></small>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Login Link</label>
                            <input type="url" name="login_link" id="login_link" class="form-control"
                                placeholder="Enter Game Link" required>
                            <div class="invalid-feedback">
                                Please provide valid link.
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
                            <button class="btn btn-primary-600" type="submit">Update Game</button>
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


function updateFileName(input) {
        const fileNameElement = document.getElementById('file-name');
        if (input.files && input.files[0]) {
            fileNameElement.textContent = input.files[0].name; // Display file name
        } else {
            fileNameElement.textContent = ''; // Clear if no file selected
        }
    }

    document.getElementById('createGameBtn').addEventListener('click', function() {
    // Change the modal title and button text for creating a game
    document.querySelector('#addTaskModalLabel .game-name').textContent = 'Create Game';
    document.getElementById('submitButton').textContent = 'Create Game';  // Change button text

    // Clear the form fields when the modal is opened for creating a game
    document.getElementById('gameModal').reset();

    // Clear the logo preview
    document.getElementById('logoPreview').style.display = 'none';
    document.getElementById('logoPreview').setAttribute('src', '');

    // Optionally, reset the action URL for the form (make sure it points to the store route)
    document.getElementById('gameModal').setAttribute('action', '{{ route('games.store') }}');
});

     function editGame(gameId) {
    // Make an AJAX request to fetch the game data by ID
    $.ajax({
        url: "{{ url('games') }}/" + gameId + "/edit",
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            document.querySelector('#addTaskModalLabel .game-name').textContent = 'Update Game';
            document.getElementById('submitButton').textContent = 'Update Game'; 
            // Populate the modal with the game's data
            $('#name').val(data.name);
            $('#login_link').val(data.login_link);
            $('#status').val(data.status);

            // Handle the logo preview
            if (data.logo) {
                const logoUrl = `{{ asset('') }}${data.logo}`; // Build the full URL for the logo
                $('#logoPreview').attr('src', logoUrl).show(); // Show the logo preview
            } else {
                $('#logoPreview').hide(); // Hide the preview if no logo exists
            }

            // Update the form action to point to the correct route for updating the game
            const formAction = `/games/${gameId}`;
            $('#gameModal').attr('action', formAction);

            // Open the modal
            $('#addGame').modal('show');
        },
        error: function(xhr, status, error) {
            console.error('Error fetching game data:', error);
        }
    });
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
