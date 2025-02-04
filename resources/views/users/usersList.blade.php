@extends('layout.layout')

@php
    $title = 'Users List';
    $subTitle = 'Users List';
    $script = '
<script>
    $(".remove-item-btn").on("click", function() {
        $(this).closest("tr").addClass("d-none")
    });
    let table = new DataTable("#dataTable");
</script>';
@endphp
<style>
    #dt-length-0{
        margin-right: 10px;
    }
</style>
@section('content')
    <div class="card h-100 p-0 radius-12">
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
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Name</th>
                            {{-- <th scope="col">Join Date</th> --}}
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col" class="text-center">Bonus</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            @php

                                $image =
                                    $user->profile_image != ''
                                        ? url($user->profile_image)
                                        : asset('assets/images/users/avatar-large-square.jpg');

                            @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $image }}" alt=""
                                            class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                        <div class="flex-grow-1">
                                            <span
                                                class="text-md mb-0 fw-normal text-secondary-light">{{ $user->username }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->name }}</td>
                                {{-- <td>{{ $user->created_at->format('M d, Y') }}</td> --}}
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>
                                    <button class="btn btn-primary btn-xs ms-2" style="font-size: 12px; padding: 5px 10px;" onclick="openBonusModal({{ $user->id }})">
                                        Give Bonus
                                    </button>
                                </td>

                                <td class="text-center">
                                    <div class="form-switch switch-success d-flex align-items-center gap-3">
                                        <input class="form-check-input switch-input" type="checkbox"
                                            data-id="{{ $user->id }}" role="switch"
                                            @if ($user->user_status == 'active') checked @endif>
                                        <button type="button" title="Attach Games to User"
                                            onclick="editUser({{ $user->id }})"
                                    class="bg-info-focus
                                            bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex
                                            justify-content-center align-items-center rounded-circle user-detail">
                                            <iconify-icon icon="lucide:edit" class="icon text-xl"></iconify-icon>
                                        </button>
                                    </div>

                                    {{-- <div class="d-flex align-items-center gap-10 justify-content-center">
                                <button type="button" title="Attach Games to User"
                                    onclick="window.location.href = '{{ route('admin.user.view', $user->id) }}';"
                                    class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle user-detail">
                                    <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                                </button>
                                <button type="button" title="Assign user/passwords to user"
                                    onclick="window.location.href = '{{ route('admin.user.attachments', $user->id) }}';"
                                    class="bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                    <iconify-icon icon="lucide:file" class="menu-icon"></iconify-icon>
                                </button>

                                <button type="button" data-id="{{ $user->id }}"
                                    class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                    <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                                </button> --}}


            </div>
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>
        </div>


    </div>
    </div>
<!-- Bonus Modal -->
<div class="modal fade" id="bonusModal" tabindex="-1" aria-labelledby="bonusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bonusModalLabel">Grant Bonus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="bonusUserId">
                <label for="bonusAmount" class="form-label">Enter Bonus Amount</label>
                <input type="number" id="bonusAmount" class="form-control" placeholder="Enter amount" min="1">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="submitBonus()">Give Bonus</button>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-xl mb-0" id="addTaskModalLabel"><span class="game-name">Update User</span></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" class="row gy-3 needs-validation" action="{{ route('user.update') }}"
                        method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="" />
                        <div class="col-md-6">
                            <label class="form-label">User Name</label>
                            <input type="text" name="username" id="username" class="form-control" value=""
                                required>
                            <div class="valid-feedback">
                                User name
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value=""
                                required>
                            <div class="valid-feedback">
                                Name
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="text" name="email" id="email" class="form-control" value=""
                                required>
                            <div class="valid-feedback">
                                Email
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">  Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-control" value=""
                                required>
                            <div class="valid-feedback">
                               Phone Number
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password (Leave blank if not changing)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        {{-- <div class="mb-3 col-md-8">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div> --}}



                        <div class="col-12">

                        </div>

                </div>
                <div class="modal-footer justify-content-center gap-3">
                    {{-- <button type="button"
                        class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-md px-50 py-11 radius-8"
                        data-bs-dismiss="modal">
                        Cancel
                    </button> --}}
                    <button class="btn btn-primary-600" type="submit">Update User</button>

                </div>
            </form>
            </div>
        </div>
    </div>

    <script>
        function editUser(id) {

            // Make an AJAX request to fetch the game data by ID
            $.ajax({
                url: "{{ url('admin/user/edit/') }}/" + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#user_id').val(data.id);
                    $('#username').val(data.username);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone_number);
                    $('#password').val('');
                    $('#password_confirmation').val('');
                    // Open the modal (assuming Bootstrap is used)
                    $('#editUserModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching game data:', error);
                }
            });
        }
    </script>

    <!-- View Game Modal -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title text-xl mb-0" id="addTaskModalLabel"><span class="user-name"></span></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="taskForm">
                        <input type="hidden" id="editTaskId" value="">
                        <div class="mb-3">
                            <label for="taskTitle"
                                class="form-label fw-semibold text-primary-light text-sm mb-8 me-12">Name: </label>
                            <span class="user-name"></span>
                        </div>
                        <div class="mb-3">
                            <label for="taskTag"
                                class="form-label fw-semibold text-primary-light text-sm mb-8 me-12">Profile Image:
                            </label>
                            <img id="profile-image" src="" alt="Profile Image" width="100">
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
@endsection


@section('js')
    <script src="{{ asset('assets/js/lib/') }}/confirmation-modal.min.js"></script>

    <script>

function openBonusModal(userId) {
    document.getElementById("bonusUserId").value = userId; // Store user ID
    document.getElementById("bonusAmount").value = ""; // Reset input field

    let modal = new bootstrap.Modal(document.getElementById("bonusModal"));
    modal.show();
}

function submitBonus() {
    let userId = document.getElementById("bonusUserId").value;
    let amount = document.getElementById("bonusAmount").value;

    if (!amount || amount <= 0) {
        alert("Please enter a valid bonus amount.");
        return;
    }

    fetch("{{ route('admin.give.bonus') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ user_id: userId, amount: amount })
    })
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => { throw new Error(text) });
        }
        return response.json();
    })
    .then(data => {
        alert(data.message);
        let modal = bootstrap.Modal.getInstance(document.getElementById("bonusModal"));
        modal.hide();
    })
    .catch(error => {
        console.error("Error:", error);
        alert("An error occurred: " + error.message);
    });
}




        $(document).ready(function() {
            // Disable user
            $('.switch-input').on('click', function() {
                const userId = $(this).data('id');
                var curr_obj = $(this);
                var status = '';
                if ($(this).is(":checked")) {
                    status = 'enable';
                } else {
                    status = 'disable';
                }

                confirmationModal.show({
                        closeIcon: true,
                        message: 'Are you sure you want to ' + status + ' this user?',
                        title: 'User Status',
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
                            url: `{{ url('admin/users/updateUserStatus/') }}` + "/" + userId +
                                "/" + status,
                            type: 'PATCH', // Use PATCH to update the status
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                showToast('User ' + status + ' successfully.', 'success');

                                if (status == 'enable') {
                                    $('#user-status-' + userId).removeClass(
                                        'text-danger-main bg-danger-focus');
                                    $('#user-status-' + userId).addClass(
                                        'text-success-main bg-success-focus');

                                    $('#user-status-' + userId).html('Active');
                                } else {
                                    $('#user-status-' + userId).addClass(
                                        'text-danger-main bg-danger-focus');
                                    $('#user-status-' + userId).removeClass(
                                        'text-success-main bg-success-focus');
                                    $('#user-status-' + userId).html('Inactive');
                                }

                            },
                            error: function() {
                                showToast('Error ' + status + ' user.', 'error');
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
