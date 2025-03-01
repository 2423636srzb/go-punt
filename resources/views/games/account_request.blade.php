@extends('layout.layout')

@php
    $title = 'Account Requests';
    $subTitle = 'Account Requests';
@endphp
<style>
    #dt-length-0 {
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
                            <th scope="col">User Name</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Plateform</th>
                            <th scope="col">Request Date</th>
                            <th scope="col" class="text-center">phone</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $key => $request)

                        <tr>
                            <td>{{ $request->name }}</td>
                            <td>
                                <img src="{{ url($request->game_logo) }}" alt="{{ $request->game_name }}" width="50">
                            </td>
                            <td>{{ $request->game_name }}</td>
                            <td>{{ $request->created_at }}</td>
                            <td>{{ $request->phone_number }}</td>
                            <td>{{ ucfirst($request->status) }}</td>
                            <td class="text-center">
                                @if($request->status == 'pending')
                                    <!-- Approve Button -->
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#approveModal"
                                    data-id="{{ $request->id }}" data-user="{{ $request->name }}">
                                        Approve
                                    </button>

                                    <!-- Reject Button -->
                                    <button class="btn btn-danger btn-sm" onclick="rejectRequest({{ $request->id }})">
                                        Reject
                                    </button>
                                @else
                                    <span class="badge badge-primary" style="color: black">Processed</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                                {{-- <td scope="col">

                                    <span
                                        class="@if ($list->status == 'Approved') bg-success-focus text-success-main @endif
                                @if ($list->status == 'Pending') bg-info-focus text-info-main @endif
                                px-24 py-4 rounded-pill fw-medium text-sm">
                                        {{ $list->status }}
                                    </span>

                                </td>
                                <td scope="col">
                                    @if ($list->status == 'Pending')
                                        <a href="#" title="Approve"
                                            class="w-32-px h-32-px bg-success-focus text-success-600 rounded-circle d-inline-flex align-items-center justify-content-center approve-btn"
                                            data-id="{{ $list->id }}">
                                            <iconify-icon icon="charm:tick"></iconify-icon>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>


        </div>
    </div>
<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="approveModalLabel">Account Detail</h6>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="approveForm" autocomplete="off">

                    <input type="hidden" id="requestId">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" id="username" autocomplete="off" required >
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="password" autocomplete="new-password" required >
                    </div>

                    <!-- Button aligned to the right -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    // Open Approve Modal
    $(document).on('click', '[data-target="#approveModal"]', function () {
        let requestId = $(this).data('id');

        $('#requestId').val(requestId);


        $('#approveModal').modal('show');
    });

    // Prevent browser autofill for username & password
    $('#username, #password').attr('autocomplete', 'off');

    // Handle Approve Form Submission
    $('#approveForm').submit(function (e) {
        e.preventDefault();

        let requestId = $('#requestId').val();
        let userId = $('#userId').val();
        let gameId = $('#gameId').val();
        let username = $('#username').val();
        let password = $('#password').val();

        $.ajax({
            url: "{{ route('account-requests.approve') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                request_id: requestId,
                user_id: userId,
                game_id: gameId,
                username: username,
                password: password
            },
            success: function (response) {
                if (response.success) {
                    alert(response.message); // Show success message
                    $('#approveModal').modal('hide');
                    location.reload(); // Refresh page
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function (xhr) {
                alert("An error occurred: " + xhr.responseJSON.message);
            }
        });
    });
});


// Reject Request Function
function rejectRequest(requestId) {
    if (confirm('Are you sure you want to reject this request?')) {
        $.ajax({
            url: "{{ route('account-requests.reject') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                request_id: requestId
            },
            success: function () {
                location.reload(); // Refresh page
            }
        });
    }
}
</script>
@endsection


