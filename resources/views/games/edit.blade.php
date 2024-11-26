@extends('layout.layout')

@php
$title = 'Edit Game';
$subTitle = 'Edit Game';
$script = '
<script>
    (() => {
        "use strict"

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll(".needs-validation")

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener("submit", event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add("was-validated")
            }, false)
        })
    })()
</script>';
@endphp

@section('content')

<div class="row gy-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Game</h5>
            </div>
            <div class="card-body">
                <form class="row gy-3 needs-validation" action="{{ route('games.update', $game) }}" method="POST"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="col-md-6">
                        <label class="form-label">Game Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $game->name }}"
                            required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Logo</label>
                        <input class="form-control" type="file" name="logo" id="logo" required>
                        <img src="{{ asset('storage/' . $game->logo) }}" alt="{{ $game->name }}" width="50">
                        <div class="invalid-feedback">
                            Please choose a file.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Login Link</label>
                        <input type="url" name="login_link" id="login_link" class="form-control"
                            value="{{ $game->login_link }}" placeholder="Enter Game Link" required>
                        <div class="invalid-feedback">
                            Please provide valid link.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="active" {{ $game->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $game->status == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
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
        </div>
    </div>

</div>

@endsection