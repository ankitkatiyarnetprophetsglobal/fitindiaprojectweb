// form.js
$('#fi-register').on('submit', async function (e) {
     e.preventDefault();
    let isValid = true;
    // 2. Role (select)
    if (!$('#cyclothonrole').val()) {
         $('#cyclothonrole-error').text('Role is required');
    }else{
          $('#cyclothonrole-error').text('');
    }

    // 3. Name
    const name = $('#name').val().trim();
    if (!name) {
        $('#name-error').text('Name is required');
        isValid = false;
    }  else {
        $('#name-error').text('');
    }
    const participant_number = $('#name').val().trim();
    if (!participant_number) {
        $('#participant_number-error').text('Participant number is required');
        isValid = false;
    }  else {
        $('#participant_number-error').text('');
    }

 
    if ($('#fi_orgname').is(':visible') && !$('#fi_orgname').val().trim()) {
        $('#fi_orgname').after('<span class="text-danger small">Organisation name is required</span>');
        isValid = false;
    }

    // 5. Email
    const email = $('#email').val().trim();
    if (!email) {
        $('#email-error').text('Email is required').show();
        isValid = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        $('#email-error').text('Invalid email format').show();
        isValid = false;
    } else {
        $('#email_error').hide();
    }

    // 6. Phone
    const phone = $('#phone').val().trim();
    if (!phone) {
        $('#phone-error').text('Mobile is required').show();
        isValid = false;
    } else if (!/^[0-9]{10}$/.test(phone)) {
        $('#phone-error').text('Enter valid 10 digit Mobile').show();
        isValid = false;
    } else {
        $('#phone-error').hide();
    }
    // const address_line_one = $('#address_line_one').val().trim();
    // if (!address_line_one) {
    //     $('#address_line_one-error').text('Address Line 1 is required').show();
    //     isValid = false;
    // } else {
    //     $('#address_line_one-error').hide();
    // }
    // const address_line_two = $('#address_line_two').val().trim();
    // if (!address_line_two) {
    //     $('#address_line_two-error').text('Address Line 1 is required').show();
    //     isValid = false;
    // } else {
    //     $('#address_line_two-error').hide();
    // }
    const pincode = $('#pincode').val().trim();
    if (!pincode) {
        $('#pincode-error').text('pincode is required').show();
        isValid = false;
    } else {
        $('#pincode-error').hide();
    }

    // 7. State
        if ($('#state').val() === "") {
            $('#state-error').text('State is required');
            isValid = false;
        } else {
            $('#state-error').text('');
        }

    // 8. District
    if (!$('#district').val()) {
        $('#district-error').text('District is required');
        isValid = false;
    }else{
         $('#district-error').text('');
    }

    // 9. Block
    if (!$('#block').val()) {
        $('#block-error').text('Block is required');
        isValid = false;
    }
    else{
        $('#block-error').text('');
    }

    // 10. City
    if (!$('#fi_city').val().trim()) {
        $('#fi_city-error').text('City is required');
        isValid = false;
    }else{
        $('#fi_city-error').text('');
    }

    // 11. Password
    const password = $('#password').val().trim();
    if (!password) {
        $('#password-error').text('Password is required');
        isValid = false;
    } else if (password.length < 8) {
        $('#password-error').text('Password must be at least 8 characters');
        isValid = false;
    } else {
        $('#password-error').text('');
    }

    // 12. Confirm Password
    const confirm = $('#password-confirm').val().trim();
    if (!confirm) {
        $('#confirm-error').text('Confirm password is required');
        isValid = false;
    } else if (confirm !== password) {
        $('#confirm-error').text('Passwords do not match');
        isValid = false;
    } else {
        $('#confirm-error').text('');
    }

    // 13. Captcha
    if (!$('#captcha').val().trim()) {
        $('#captcha-error').text('Captcha is required');
        isValid = false;
    }

    // Stop if validation fails
    if (!isValid) return false;

    try {
        $('#password').val(await encryptGCM(password, "64"));
        $('#password-confirm').val(await encryptGCM(confirm, "64"));
        this.submit();
    } catch (err) {
        console.error("Encryption error:", err);
        alert("Encryption failed, please retry.");
        return false;
    }
});

// Password validation
function validatePassword(input) {
    const policyRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}$/;
    const errorEl = document.getElementById("password-error");

    if (!policyRegex.test(input.value)) {
        errorEl.textContent = "Password must be at least 8 characters, include 1 lowercase, 1 uppercase, 1 digit, and 1 special character.";
        input.classList.add("is-invalid");
    } else {
        errorEl.textContent = "";
        input.classList.remove("is-invalid");
    }
}

function validateConfirmPassword(input) {
    const password = document.getElementById("password").value;
    const errorEl = document.getElementById("confirm-error");

    if (input.value !== password) {
        errorEl.textContent = "Passwords do not match.";
        input.classList.add("is-invalid");
    } else {
        errorEl.textContent = "";
        input.classList.remove("is-invalid");
    }
}
// === Real-time remove error when typing / selecting ===
$('#fi-register input, #fi-register select').on('input change', function () {
    const id = $(this).attr('id');   // input ka id get karo
    if (id === 'password' || id === 'password-confirm') return;
    $('#' + id + '-error').text(''); //
});

