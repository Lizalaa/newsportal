$(document).ready(function () {
    
    // $('#login_btn').click(function (event) {
    //     $.ajax({
    //         url: "login-check",
    //         datatype: 'json',
    //         method: 'GET',
    //         success: function (response) {
    //             if (response == 1) {
    //                 $(".dialog").hide();
    //                 window.location = "user/dashboard";
    //             }
    //             if (response == 0) {
    //                 $(".dialog").show();
    //             }
    //         }
        });

        $('#loginbutton').click(function (event) {
            $('#loading').html('<img src="user/images/loading.gif">');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            event.preventDefault();
            

            var email = $("input[name=email]").val();
            var password = $("input[name=password]").val();
            // if (email.length == 0 || password.length == 0)
            // {
            //     setTimeout(function () {
            //         $('#loading').html('');
            //     }, 100);
            //     $(".response_login").append("<div class='alert alert-danger'>Please fill the field</div>");
            //     setTimeout(function () {
            //         $('.alert').fadeOut('fast');
            //     }, 5000);
            // }
            // else
            // {
            $.ajax({
                url: "user/login",
                type: 'POST',
                data: {login_email:email, login_password:password},
                datatype: 'json',
                success: function (response) {
                    //alert(response);
                    if (response == 1) {
                        window.location = "user/dashboard";

                    }
                    else if (response == 0) {
                        setTimeout(function () {
                            $('#loading').html('');
                        }, 100);

                        $(".response_login").append("<div class='alert alert-danger'>Wrong email or password</div>");
                        setTimeout(function () {
                            $('.alert').fadeOut('fast');
                        }, 5000);
                    }
                    else if (response == 2) {
                        setTimeout(function () {
                            $('#loading').html('');
                        }, 100);

                        $(".response_login").append("<div class='alert alert-danger'>Your email is not verified.</div>");
                        setTimeout(function () {
                            $('.alert').fadeOut('fast');
                        }, 5000);
                    }
                    else{
                        setTimeout(function () {
                            $('#loading').html('');
                        }, 100);
                        var response = JSON.stringify(response);

                        $(".response_login").append("<div class='alert alert-danger'>"+response+"</div>");
                        setTimeout(function () {
                            $('.alert').fadeOut('fast');
                        }, 5000);
                    }
                    
                }
            });
        //}
        });
        
