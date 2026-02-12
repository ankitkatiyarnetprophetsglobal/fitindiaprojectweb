<div class="modal fade" id="mobileModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content mheight-modal">
                            <div class="modal-header">
                                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button> --}}
                            </div>
                            <div class="modal-body" id="mediumBody">
                                <div class="row justify-content-center">
                                    <h2 class="text-center">Verification code</h2>
                                </div>
                                <div class="row mt-2 justify-content-center">
                                    <p class="w-100 text-center">We will send you an password via registered</p>
                                    <h6 class="mt-1 w-100 text-center" style="font-weight: 700">Mobile number</h6>
                                </div>
                                <div class="row justify-content-center mt-2">
                                    <div class="col-6">
                                        <input type="number" class="form-control" id="phone_otp" name="phone_otp" size="100" maxlength="6" min="1">
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-2">
                                    <span class="mobile_otp_error" style="display:none; color:red;">
                                        Please enter a valid OTP
                                    </span>
                                </div>
                                <div class="row justify-content-center mt-2">
                                    Time left &nbsp; <span id="mobile_timer"> </span>
                                </div>
                                <div class="register-row">
                                    <div class="register-row-center">
                                        <label for="captcha " class="w-100  text-center">Please enter the captcha text</label>
                                        <div class="d-flex align-items-center justify-content-center" id="pagecaptcha-cont">
                                            <div class="captchaotpimg">
                                                <span>{!! captcha_img() !!}</span>
                                            </div>
                                            <button type="button" class="btn btn-info reload-captcha" id="reload-captcha"> ↻ </button>
                                        </div>
                                        <input type="text" id="captchaotp" name="captchaotp" class="d-block mx-auto form-control w-50 @error('captcha') is-invalid @enderror" placeholder="Captcha" maxlength="10">
                                        <span id="captcha-error" class="error-message text-danger small"></span>
                                        <div class="row justify-content-center mt-2">
                                            <span id="captcha_value_error" style="display:none; color:red;">
                                                Please enter valid captcha value.
                                            </span>
                                        </div>
                                        {{-- @error('captcha')
                                            <span class="invalid-feedback text-danger small" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror --}}
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-2">
                                    <button type="button" class="btn btn-info mt-2" style="background-color: #02349a;">
                                        <a id="mobile_otp_verify">OTP verify</a>
                                    </button>
                                </div>
                                <div class="row justify-content-center mt-2">
                                    <p class="text-center mt-2">Didn't receive the verification OTP?
                                        <br />
                                        <br />
                                        <span id="mobile_otp_resend" style="display:none;">
                                            <button type="button" class="btn btn-info">
                                                <a class="mobile_verify" style="color:#fff;">Resend OTP</a>
                                            </button>
                                        </span>
                                    </p>
                                </div>



                                {{-- <div>
                            Mobile
                            <input type="number" id="phone_otp" name="phone_otp" size="100" maxlength="6" min="1">
                            <span id="mobile_otp_error" style="display:none; color:red;">
                                Please Enter A Valid OTP
                            </span>
                            <button type="button" class="btn btn-info">
                                <a id="mobile_otp_verify">otp verify</a>
                            </button>
                        </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- OTP Limit Exceed Modal -->
                <div class="modal fade" id="otpLimitexceed" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content otpheight-modal">
                            <div class="modal-headerotp bg-danger text-white">
                                <h5 class="modal-title" id="otpLimitLabel">OTP Limit Exceeded</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="mediumBody">
                                <div class="row mt-2 justify-content-center">
                                    <p class="w-100 text-center">You have reached your daily OTP request limit (10).</p>
                                    <p class="w-100 text-center">Please try again tomorrow.</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="otpfooter" class="btn btn-secondary" data-dismiss="modal">OK</button>
                            </div>
                        </div>
                    </div>
                </div>



<script>
   $('#reload-captcha').click(function () {
    $.ajax({
        type: 'GET',
        url: "{{ route('reloadCaptcha')}}",
        success: function (data) {
            $(".captchaotpimg span").html(data.captcha);
        }
    });
});
</script>
