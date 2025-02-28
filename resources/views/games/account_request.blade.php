@extends('layout.layout')

@php
    $title = 'Forgot Password List';
    $subTitle = 'Forgot Password List';
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

    <!-- Approval Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" aria-labelledby="approveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel">Enter New Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="listId">
                <div class="mb-3">
                    <label for="newPassword" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="submitNewPassword">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection


