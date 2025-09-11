// role.js
$(document).ready(function () {
    $('#udise_row').hide();

    if ($('#role').val() === 'school') {
        $('#udise_row').show();
    }

    $('#role').change(function () {
        const elem = $(this).val();
        if (elem === 'school') {
            $('#udise_row').show();
        } else if (elem === 'cyclothon-2024') {
            $("#divloader").show();
            window.location.replace(routes.coiregistration);
        } else {
            $('#udise_row').hide();
        }
    });

    $('#state').change(function () {
        $.post(routes.getdistrict, {
            id: $(this).val(),
            _token: csrfToken
        }).done(function (response) {
            $('#district').html(response);
        });
    });

    $('#district').change(function () {
        $.post(routes.getblock, {
            id: $(this).val(),
            _token: csrfToken
        }).done(function (response) {
            $('#block').html(response);
        });
    });
});
