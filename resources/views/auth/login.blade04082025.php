@extends('layouts.app')
@section('title', 'Login | Fit India')
@section('content')


<section class="log_sec">
  <div class="container">
    <div class="row">
      
      <div class="col-12 signup_frm frm-details-login">
         <div class="frontlogin ">
            <form action="{{ route('login') }}" method="POST" id="frontadmin" novalidate="novalidate">  
                    @csrf
                @if (Session::has('succ'))
                  <div class="alert alert-success">
                    <strong>Success !!</strong> {{ Session::get('succ') }}
                  </div>
                @endif 
                <p>New to site? 
                   <a id="fi_signup" href="{{ route('register') }}">Create an Account</a>
                </p>
        
               <div class="frm-details log_div">
                 <h1>{{ __('Login') }}</h1>               
                 
                 <div class="login-row" style="display:block;"> 
                 <label for="username">Email / Username</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror                               
                 </div>
                 <div class="login-row" style="display:block;"> 
                    <label for="password">Password</label>          
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="off" required>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
                                
                  </div>
                  
                  <div class="login-row"> 
                     <div class="um-field" id="capcha-page-cont">
                       <label for="captcha">Please Enter the Captcha Text</label><br>
                       <div style="float:left; width:115px;  margin: 6px 0;" id="pagecaptcha-cont">
                            <div class="captchaimg">
                                <span>{!! captcha_img() !!}</span>
                            </div>
                        </div>
                       <div style="float:left; margin: 6px 20px 6px 10px; cursor: pointer;">
                         <button type="button" class="btn btn-info" class="reload" id="reload"> ↻ </button>
                       </div>
                       
                       <div style="float:left;" class="cap_width_login">
                           <input type="text" id="captcha" name="captcha" class="form-control @error('captcha') is-invalid @enderror" required  placeholder="Captcha">
                            @error('captcha')
                                <span class="invalid-feedback" role="alert" >
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                       </div>
                       <div style="clear:both;"></div>
                   </div>
                 </div>
                        
                <div class="register-row-submit">
                 <input class="submit_button" type="submit" value="LOGIN">
</div>

               </div>  
               </form>
               <br>
               @if (Route::has('password_change'))
                <p class="forgot-pass"><a href="{{ route('password_change') }}">{{ __('Lost your password?') }}</a></p>
               @endif
         </div>
      </div>
    </div>

  </div>
 
</section>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script> --}}
<script src="{{ asset('resources/js/crypto/crypto-js.js')}}"></script>
<script>
    
jQuery('#reload').click(function () {
    jQuery.ajax({
    type: 'GET',
    url: 'reloadcaptcha',
    success: function (data) {
        jQuery(".captchaimg span").html(data.captcha);
    }
    });
});

///Crypto js 
var CryptoJSAesJson = {
    stringify: function (cipherParams) {
        var j = {ct: cipherParams.ciphertext.toString(CryptoJS.enc.Base64)};
        if (cipherParams.iv) j.iv = cipherParams.iv.toString();
        if (cipherParams.salt) j.s = cipherParams.salt.toString();
        return JSON.stringify(j);
    },
    parse: function (jsonStr) {
        var j = JSON.parse(jsonStr);
        var cipherParams = CryptoJS.lib.CipherParams.create({ciphertext: CryptoJS.enc.Base64.parse(j.ct)});
        if (j.iv) cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv)
        if (j.s) cipherParams.salt = CryptoJS.enc.Hex.parse(j.s)
        return cipherParams;
    }
}
// var encrypted = CryptoJS.AES.encrypt(JSON.stringify("Sai@1234"), "64", {format: CryptoJSAesJson}).toString();
// document.write(encrypted);
// var decrypted = JSON.parse(CryptoJS.AES.decrypt(encrypted, "64", {format: CryptoJSAesJson}).toString(CryptoJS.enc.Utf8));
// document.write(decrypted);
///Crypto js 






$('#frontadmin').on('submit',function(e){
    e.preventDefault;
    let raw_password = $('#password').val();

    let encrypt_pass = CryptoJS.AES.encrypt(JSON.stringify(raw_password), "64", {format: CryptoJSAesJson}).toString();

    console.log('pass',encrypt_pass);
    $('#password').val(encrypt_pass);

})

$( document ).ready(function() {
    $('password').attr('autocomplete','off');
});



// const hashValue = val =>
//   crypto.subtle
//     .digest('SHA-256', new TextEncoder('utf-8').encode(val))
//     .then(h => {
//       let hexes = [],
//         view = new DataView(h);
//       for (let i = 0; i < view.byteLength; i += 4)
//         hexes.push(('00000000' + view.getUint32(i).toString(16)).slice(-8));
//       return hexes.join('');
//     });

//     console.log(hashValue(111111));
// hashValue(
//   JSON.stringify(111111)).then(console.log);  
</script>


@endsection
