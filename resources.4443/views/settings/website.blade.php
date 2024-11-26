@extends('layout.layout')

@php
$title = 'Website Settings';
$subTitle = 'Website Settings';
$default = asset('assets/images/user-grid/user-grid-img14.png');




$script = '
<script>
    // ======================== Upload Image Start =====================
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#imagePreview").css("background-image", "url(" + e.target.result + ")");
                $("#imagePreview").hide();
                $("#imagePreview").fadeIn(650);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#imageUpload").change(function () {
        readURL(this);
    });

    // ======================== Upload Image End =====================

    // ================== Password Show Hide Js Start ==========
    function initializePasswordToggle(toggleSelector) {
        $(toggleSelector).on("click", function () {
            $(this).toggleClass("ri-eye-off-line");
            var input = $($(this).attr("data-toggle"));
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }
    // Call the function
    initializePasswordToggle(".toggle-password");
    // ========================= Password Show Hide Js End ===========================
</script>';
@endphp

@section('content')

<div class="col-lg-8">
            
    <div class="card ">
        <div class="card-body ">
        
            <form method="POST" action="{{ route('website.update') }}" enctype="multipart/form-data">

                @csrf
                <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="name"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">Website Name
                                <span class="text-danger-600">*</span></label>
                            <input type="text" name="name" class="form-control radius-8" id="name"
                                placeholder="Enter Full Name" value="{{ $settings->name }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="name"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">Logo
                                <span class="text-danger-600">*</span></label>
                            <input type="file" name="logo" class="form-control radius-8" id="logo"
                                placeholder="Enter Username"  readonly>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="email"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">Currency <span
                                    class="text-danger-600">*</span></label>
                                  
                            <input type="text" name="currency" class="form-control radius-8" id="email"
                                placeholder="Enter email address" value="{{ $settings->currency }}">
                        </div>
                    </div>
                    

                    <div class="col-sm-6">
                        <div class="mb-20">
                            <label for="Language"
                                class="form-label fw-semibold text-primary-light text-sm mb-8">Language
                                <span class="text-danger-600">*</span> </label>
                            <select class="form-control radius-8 form-select" name="language" id="Language">
                                <option> English</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <button type="submit"
                        class="btn btn-primary border border-primary-600 text-md px-56 py-12 radius-8">
                        Save
                    </button>
                </div>
            </form>
        
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('assets/js/lib/') }}/confirmation-modal.min.js"></script>

@endsection
