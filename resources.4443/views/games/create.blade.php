@extends('layout.layout')

@php
$title = 'New Game';
$subTitle = 'New Game';
$script = '<script>
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
                    <h5 class="card-title mb-0">Add New Game</h5>
                </div>
                <div class="card-body">
                    <form class="row gy-3 needs-validation" action="{{ route('games.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
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
                            <input type="url" name="login_link" id="login_link" class="form-control" placeholder="Enter Game Link" required>
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
                            <button class="btn btn-primary-600" type="submit">Create Game</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>

@endsection
