// form.js
$('#fi-register').on('submit', async function (e) {
     e.preventDefault();
    let isValid = true;

    // Clear old errors
    $('.text-danger.small').text('');
    $('.invalid-feedback strong').text('');

    // Helper function
    function showError(selector, message) {
        $(selector).text(message).show();
        isValid = false;
    }

    // 1. Role Type (radio)
    if (!$('input[name="roletype"]:checked').val()) {
        alert("Please select role type."); // no span available for this
        isValid = false;
    }

    // 2. Role (select)
    // if (!$('#role').val()) {
    //     showError('#role').next('.invalid-feedback strong', 'Role is required');
    // }

    // 3. Name
    if (!$('#name').val().trim()) {
        $('#name').siblings('.invalid-feedback strong').text('Name is required');
        isValid = false;
    }

    // 4. Udise / Orgname (if visible)
    if ($('#fi_udise').is(':visible') && !$('#fi_udise').val().trim()) {
        $('#fi_udise').siblings('.invalid-feedback strong').text('U-Dise number is required');
        isValid = false;
    }
    if ($('#fi_orgname').is(':visible') && !$('#fi_orgname').val().trim()) {
        $('#fi_orgname').after('<span class="text-danger small">Organisation name is required</span>');
        isValid = false;
    }

    // 5. Email
    const email = $('#email').val().trim();
    if (!email) {
        $('#email_error').text('Email is required').show();
        isValid = false;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        $('#email_error').text('Invalid email format').show();
        isValid = false;
    } else {
        $('#email_error').hide();
    }

    // 6. Phone
    const phone = $('#phone').val().trim();
    if (!phone) {
        $('#phone_error').text('Phone is required').show();
        isValid = false;
    } else if (!/^[0-9]{10}$/.test(phone)) {
        $('#phone_error').text('Enter valid 10 digit phone').show();
        isValid = false;
    } else {
        $('#phone_error').hide();
    }

    // 7. State
    if (!$('#state').val()) {
        $('#state').siblings('.invalid-feedback strong').text('State is required');
        isValid = false;
    }

    // 8. District
    if (!$('#district').val()) {
        $('#district').siblings('.invalid-feedback strong').text('District is required');
        isValid = false;
    }

    // 9. Block
    if (!$('#block').val()) {
        $('#block').siblings('.invalid-feedback strong').text('Block is required');
        isValid = false;
    }

    // 10. City
    if (!$('#fi_city').val().trim()) {
        $('#fi_city').siblings('.invalid-feedback strong').text('City is required');
        isValid = false;
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
        $('#captcha').siblings('.invalid-feedback strong').text('Captcha is required');
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
