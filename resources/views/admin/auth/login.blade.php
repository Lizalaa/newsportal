
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Admin Login</title>
        <script src="<?=asset('js/plugins/jQuery/jQuery-2.1.4.min.js'); ?>"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?=asset('css/login_css.css');?>" media="screen" />
    </head>

    <body>
        <div id="container">
            <div class="login">
                <div class="login-screen">
                    <h1 class="app-title">Signin Here!</h1>
                    
                    <div class="login-form">
                    
                        <div class="control-group">
                            <form name="login_form" action="{{ route('admin.login.submit') }}" id="login_form" method="POST">
                                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        {{$errors}}
                    </div>
                @endif
                {{ csrf_field() }}
                                <p>
                                    <input type="text" name="email" placeholder="Email" class="login-field" id="form_email"
                                value="{{old('email')}}"/>
                                    <span class="error_form" id="email_error_message"></span>
                                    <br />
                                </p>

                                <p>
                                    <input type="password" name="password" placeholder="Password"
                                    class="login-field" id="form_password"/><br />
                                    <span class="error_form" id="password_error_message"></span>
                                </p>

                                <p>
                                    <input type="submit" name="submit" class="btn" value="Signin" />
                                </p>

                                </form>
                            <p>Forget Password? <a href="{{route('admin.password.request')}}">Reset here</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

