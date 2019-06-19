
    $('#signup_button').click(function (event) {
        $('#loading-signup').html('<img src="user/images/loading.gif">');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token-register"]').attr('content')
            }
        });
        event.preventDefault();
        var email = $("#email_user").val();
        var username = $("#username_user").val();
        var password = $("#password_user").val();
        
        // if(email.length == 0 || username.length == 0 || password.length == 0)
        // {
        //     setTimeout(function () {
        //         $('#loading-signup').html('');
        //     }, 100);
        //     $(".response").append("<div class='alert alert-danger'>Please fill the empty fields.</div>");
        //     setTimeout(function () {
        //         $('#loading-signup').html('');
        //     }, 100);
        // }

        // else
        // {
        $.ajax({
            url: 'sign-up',
            type: 'POST',
            data:
                {
                    user_email: email,
                    user_username: username,
                    user_password: password, 
                },
            datatype: 'json',
            success: function (response) {
                if (response == 1) {
                    alert('Registered. Please check you email for further details.');
                    window.location = url;
                }
                else if (response == 0) {
                    setTimeout(function () {
                        $('#loading-signup').html('');
                    }, 100);
                    $(".response").append("<div class='alert alert-danger'>Sorry not registered.</div>");
                    setTimeout(function () {
                        $('#loading-signup').html('');
                    }, 100);
                }
                
                else{
                    setTimeout(function () {
                        $('#loading-signup').html('');
                    }, 100);
                    var response = JSON.stringify(response);
                    $(".response").append("<div class='alert alert-danger'>" + response + "</div>");
                        
            
                    setTimeout(function () {
                        $('.alert').fadeOut('fast');
                    }, 5000);
                }

            },
  
        });
    //}
    });
