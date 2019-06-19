<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Reset Password</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?=asset('css/login_css.css');?>" media="screen" />
    </head>

    <body>
        <div class="box-header with-border">

        <div id="container">
            <div class="login">
                <div class="login-screen">
                    <h1 class="app-title">Reset Here!</h1>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors }}
                        </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div id="body">
                    <form action="{{route('user.password.email')}}" name="reset" method="post">
                                       {!! csrf_field() !!}

                        <p>
                            <label for="email">Email</label>
                        <input type="input" name="email" value="{{old('email')}}"/><br />
                        </p>

                        <p>
                            <input type="submit" class="btn" name="forget" value="Send Email" />
                        </p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>