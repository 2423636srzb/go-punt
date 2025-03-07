@extends('layout.layout')

@php
$title = 'Users List';
$subTitle = 'Users List';
$script = '
<script>
    $(".remove-item-btn").on("click", function () {
        $(this).closest("tr").addClass("d-none")
    });
    let table = new DataTable("#dataTable");
</script>';
@endphp

@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0" id="dataTable">
                <thead>
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Name</th>
                        <th scope="col">Join Date</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Balance</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    @php

                    $image = $user->profile_image != '' ? asset('/storage/profile_images/' .
                    $user->profile_image) : asset('assets/images/user-list/user-list1.png');

                    @endphp
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $image }}" alt=""
                                    class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                <div class="flex-grow-1">
                                    <span class="text-md mb-0 fw-normal text-secondary-light">{{ $user->username
                                        }}</span>
                                </div>
                            </div>
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>-</td>
                        <td><span id="user-status-{{ $user->id }}"
                                class="@if($user->user_status == 'active')bg-success-focus text-success-main @else bg-danger-focus text-danger-main @endif  px-24 py-4 rounded-pill fw-medium text-sm">
                                {{ ucfirst($user->user_status) }}</span>
                        </td>

                        <td class="text-center">
                            <div class="form-switch switch-success d-flex align-items-center gap-3">
                                <input class="form-check-input switch-input" type="checkbox" data-id="{{ $user->id }}"
                                    role="switch" @if($user->user_status == 'active') checked @endif>
                            </div>
                            <!--
                            <div class="d-flex align-items-center gap-10 justify-content-center">
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
                                </button>
                                -->
        </div>
        </td>
        </tr>
        @endforeach
        </tbody>
        </table>
    </div>


</div>
</div>


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
<script src="{{asset('assets/js/lib/') }}/confirmation-modal.min.js"></script>

<script>
    $(document).ready(function () {
        // Disable user
        $('.switch-input').on('click', function () {
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
                        url: `{{ url('admin/users/updateUserStatus/') }}` + "/" + userId + "/" + status,
                        type: 'PATCH', // Use PATCH to update the status
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            showToast('User ' + status + ' successfully.', 'success');

                            if (status == 'enable') {
                                $('#user-status-' + userId).removeClass('text-danger-main bg-danger-focus');
                                $('#user-status-' + userId).addClass('text-success-main bg-success-focus');

                                $('#user-status-' + userId).html('Active');
                            } else {
                                $('#user-status-' + userId).addClass('text-danger-main bg-danger-focus');
                                $('#user-status-' + userId).removeClass('text-success-main bg-success-focus');
                                $('#user-status-' + userId).html('Inactive');
                            }

                        },
                        error: function () {
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