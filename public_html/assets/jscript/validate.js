var validation_text = "* Required";
/**
 * Function to validate password
 * pwd for password
 * cpwd for confirm password
 */
$(document).ready(function () {
    $(".form-control").keyup(function () {
        var pwd = $("#pwd").val();
        var cpwd = $("#cpwd").val();
        if ((pwd == cpwd) && (pwd != "") && (cpwd != "")) {
            $("#submit").prop('disabled', false);
            $("#msg_password").text("MATCHING");
            $("#msg_password").addClass('validation_password');
        } else {
            $("#submit").prop('disabled', true);
            $("#msg_password").addClass('validation_error');
            $("#msg_password").text("MISMATCH");
        }
    });
});

/**
 * Function to validate student registration
 * name to store name
 * email to store email
 * address to store address
 * date to store date
 * pwd to store password
 * cpwd to store confirm password
 */
$(document).ready(function () {
    $(".form-control").focusout(function () {
        var name = $("#name").val();
        var email = $("#email").val();
        var address = $("#address").val();
        var date = $("#date").val();
        var pwd = $("#pwd").val();
        var cpwd = $("#cpwd").val();

        if (name == "" || email == "" || address == "" || date == "") {
            $("#submit").prop('disabled', true);
            if (name == "") {
                $("#name").addClass('validation_error_box');
                $("#msg_name").addClass('validation_error');
                $("#msg_name").text(validation_text);

            }
            if (email == "") {
                $("#email").addClass('validation_error_box');
                $("#msg_email").addClass('validation_error');
                $("#msg_email").text(validation_text);

            }
            if (address == "") {
                $("#address").addClass('validation_error_box');
                $("#msg_address").addClass('validation_error');
                $("#msg_address").text(validation_text);
            }
            if (date == "") {
                $("#date").addClass('validation_error_box');
                $("#msg_date").addClass('validation_error');
                $("#msg_date").text(validation_text);
            }
        } else {
            $("#submit").prop('disabled', true);
        }
        if ((pwd == "") && (cpwd == "")) {
            $("#submit").prop('disabled', true);
            $("#pwd").addClass('validation_error_box');
            $("#cpwd").addClass('validation_error_box');
            $("#msg_password").addClass('validation_error');
            $("#msg_password").text(validation_text);
        }
    });
});


/**
 * Function to validate Institution registration
 * name to store name
 * email to store email
 * address to store address
 * date to store date
 * pwd to store password
 * cpwd to store confirm password
 */

$(document).ready(function () {
    $(".form-control").focusout(function () {
        var name = $("#name").val();
        var address = $("#address").val();
        var email = $("#email").val();
        var pwd = $("#pwd").val();
        var cpwd = $("#cpwd").val();
        if (name == "" || address == "" || email == "") {
            $("#submit").prop('disabled', true);
            if (name == "") {
                $("#name").addClass('validation_error_box');
                $("#msg_name").addClass('validation_error');
                $("#msg_name").text(validation_text);

            }
            if (address == "") {
                $("#address").addClass('validation_error_box');
                $("#msg_address").addClass('validation_error');
                $("#msg_address").text(validation_text);
            }
            if (email == "") {
                $("#email").addClass('validation_error_box');
                $("#msg_email").addClass('validation_error');
                $("#msg_email").text(validation_text);
            }
        } else {
            $("#submit").prop('disabled', false);
        }
        if ((pwd == "") && (cpwd == "")) {
            $("#submit").prop('disabled', true);
            $("#pwd").addClass('validation_error_box');
            $("#cpwd").addClass('validation_error_box');
            $("#msg_password").addClass('validation_error');
            $("#msg_password").text(validation_text);
        }
    });
});
