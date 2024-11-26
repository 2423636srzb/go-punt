@extends('layout.layout')

@php
$title = 'Assign login Details';
$subTitle = 'Assign login Details';
@endphp

@section('content')

<div class="row gy-4">

    <div class="card">
        <div class="card-header">
            <h6 class="card-title mb-0">User Games Management</h6>
        </div>
        <div class="card-body">
            <!-- Button to download the Excel file -->
            <a href="{{ route('admin.user.exportGames', $user->id) }}" class="btn btn-success mb-3">Download User
                Games</a>

            <!-- Form to upload the updated Excel file -->
            <form action="{{ route('admin.user.importGames', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">Upload Updated Excel File</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Upload and Update</button>
            </form>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Assign logins</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.user.updateAssignedGames', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row gy-3">
                        @foreach ($userGames as $userGame)
                        <div class="col-md-3">
                            <!-- Game Name and Logo -->
                            <label class="form-label">Game Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-base">
                                    <img src="{{ asset('storage/' . $userGame->logo) }}" alt="image" width="50">
                                </span>
                                <input type="text" class="form-control flex-grow-1" value="{{ $userGame->name }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <!-- Game URL -->
                            <label class="form-label">Game URL</label>
                            <input type="text" class="form-control" value="{{ $userGame->login_link }}" readonly>
                        </div>

                        <div class="col-md-3">
                            <!-- Username -->
                            <label class="form-label">Username</label>
                            <input type="text" name="games[{{ $userGame->game_id }}][username]" class="form-control"
                                value="{{ $userGame->username }}" placeholder="username">
                        </div>

                        <div class="col-md-3">
                            <!-- Password -->
                            <label class="form-label">Password</label>
                            <input type="password" name="games[{{ $userGame->game_id }}][password]" class="form-control"
                                value="{{ $userGame->password }}" placeholder="password">
                        </div>

                        <hr> <!-- Add a separator between game sections -->
                        @endforeach
                    </div>

                    <!-- Update Button -->
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary">Update User Credentials</button>
                    </div>
                </form>
            </div>
        </div><!-- card end -->
    </div>


</div>

@endsection