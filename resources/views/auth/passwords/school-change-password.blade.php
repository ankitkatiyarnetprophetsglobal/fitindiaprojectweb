@extends('layouts.app')
@section('title', ' Edit Profile | Fit India')
@section('content')

<div class="banner_area">
    <img src="{{ asset('resources/imgs/fitindia-bg-white.jpg') }}" alt="about-fitindia" class="img-fluid expand_img" />
    @include('event.userheader')
    <div class="container">
        <div class="et_pb_row et_area">
            <div class="row ">
                @include('event.sidebar')
                <div class="col-sm-12 col-md-9 ">
                    <div class=" ">
                        <div class="description_box">
                            <h2>Change Password</h2>

                            {{-- Success message --}}
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{-- Error messages --}}
                            @if($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Form --}}
                            <form action="{{ url('update-school-password') }}" method="post" novalidate="novalidate">
                                @csrf

                                <div class="row">
                                    <!-- New Password -->
                                    <div class="col-sm-12 col-md-6 mt-3">
                                        <div class="form-row">
                                            <label for="password">New Password <span style="color: red">*</span></label>
                                            <input id="password"
                                                type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password"
                                                placeholder="Enter new password"
                                                minlength="8"
                                                maxlength="255"
                                                required>
                                            <span id="password-error" class="text-danger small"></span>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-sm-12 col-md-6 mt-3">
                                        <div class="form-row">
                                            <label for="password_confirmation">Confirm Password <span style="color: red">*</span></label>
                                            <input id="password_confirmation"
                                                type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                name="password_confirmation"
                                                placeholder="Re-enter new password"
                                                minlength="8"
                                                maxlength="255"
                                                required>
                                            <span id="confirm-error" class="text-danger small"></span>
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-3 p-0 mt-3">
                                    <div class="form-row">
                                        <input type="submit" name="updateprofile" value="Submit" class="widthblock btn btn-primary">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Full JS Validation --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const passwordInput = document.getElementById("password");
        const confirmPasswordInput = document.getElementById("password_confirmation");
        const passwordError = document.getElementById("password-error");
        const confirmError = document.getElementById("confirm-error");

        // Password Policy Regex
        const policyRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}$/;

        function validatePassword() {
            const password = passwordInput.value;
            if (!policyRegex.test(password)) {
                passwordError.textContent =
                    "Password must be at least 8 characters, include 1 lowercase, 1 uppercase, 1 digit, and 1 special character.";
                passwordInput.classList.add("is-invalid");
                return false;
            } else {
                passwordError.textContent = "";
                passwordInput.classList.remove("is-invalid");
                return true;
            }
        }

        function validateConfirmPassword() {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;
            if (confirmPassword !== password) {
                confirmError.textContent = "Passwords do not match.";
                confirmPasswordInput.classList.add("is-invalid");
                return false;
            } else {
                confirmError.textContent = "";
                confirmPasswordInput.classList.remove("is-invalid");
                return true;
            }
        }

        // Real-time validation
        passwordInput.addEventListener("keyup", validatePassword);
        passwordInput.addEventListener("blur", validatePassword);

        confirmPasswordInput.addEventListener("keyup", validateConfirmPassword);
        confirmPasswordInput.addEventListener("blur", validateConfirmPassword);

        // Prevent form submit if validation fails
        const form = document.querySelector("form");
        form.addEventListener("submit", function (e) {
            const isPasswordValid = validatePassword();
            const isConfirmValid = validateConfirmPassword();
            if (!isPasswordValid || !isConfirmValid) {
                e.preventDefault();
            }
        });
    });
</script>

@endsection
