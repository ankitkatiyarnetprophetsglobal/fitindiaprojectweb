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

    // COI REGISTRATION

            $('.cyclothonrolew').change(function(){

            event.preventDefault();
            cyclothon_val = $('#cyclothonrole').val();

            if(cyclothon_val == 'individual'){

                $("#name").attr("placeholder", "Your Name");
                $("#user_join_club_id_show").css("display", "block");
                htmlroleindividual = ``;
                htmlroleindividual += `<option value="cyclothon-2024">FIT INDIA CYCLING DRIVE</option>`
                $('#role').html(htmlroleindividual)
                $("#participant_number_row").css("display", "none");
                $("#cycle_display").css("display", "block");
                $("#tshirtsizeshow").css("display", "none");
                $("#name").val("");

            }else if(cyclothon_val == 'organization'){

                $("#name").attr("placeholder", "Organisation Name");
                htmlroleorganization = ``;
                htmlroleorganization += `<option value="cyclothon-2024">FIT INDIA CYCLING DRIVE</option>`
                $('#role').html(htmlroleorganization)
                $("#participant_number_row").css("display", "block");
                $("#user_join_club_id_show").css("display", "none");
                $("#cycle_display").css("display", "block");
                $("#tshirtsizeshow").css("display", "none");
                $("#name").val("");

            }else if(cyclothon_val == 'club'){

                // window.location.href = "https://fitindia.gov.in/errorfitindia";

                $("#name").attr("placeholder", "Club Name");
                $("#participant_number_row").css("display", "block");
                $("#cycle_display").css("display", "none");
                $("#user_join_club_id_show").css("display", "none");
                $("#tshirtsizeshow").css("display", "block");
                htmlroleclub = ``;
                htmlroleclub += `<option value="namo-fit-india-cycling-club">Namo Fit India Club For Cycling</option>`
                $('#role').html(htmlroleclub)
                $("#name").val("");

            }else{

                $("#participant_number_row").css("display", "none");
                $("#name").attr("placeholder", "Your Name");
                $("#name").val("");

            }

        });
});

   function fi_rolechange(val){
       $.ajax({
           url: routes.getroles,
           type: "post",
           data: { "groupid" : val, "_token": csrfToken} ,
           success: function (response) {
               console.log(response);
               var elem = '<option value="">Select</option>';
                for(var index in response) {
                    elem += '<option value="'+response[index]['slug'] + '">' + response[index]['name'] + "</option>" ;
                }
                $('#role').html(elem);

            },
        });

    }
