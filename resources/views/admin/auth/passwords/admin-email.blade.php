

@extends('layouts/app')

@section('content')

<div class="container wow fadeInDown" data-wow-delay="0.5s" data-wow-duration="2s">
    <div class="row">
        <div class="col-lg-8 push-lg-2 col-md-10 push-md-1 col-sm-10 push-sm-1 login_top_bottom">
            <div class="row">
                <div class="col-lg-8 push-lg-2 col-md-10 push-md-1 col-sm-12">
                    <div class="login_logo login_border_radius1">
                        <h3 class="text-xs-center">
                            <img src="{{ asset('administrator/img/logow.png') }}" alt="josh logo" class="admire_logo"><span class="text-white"> ADMIN &nbsp;<br/>
                                Forgot Password</span>
                        </h3>
                    </div>
                    <div class="bg-white login_content login_border_radius">


                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.password.email') }}" name="forgot-password" id="forgot-password" method="post" class="login_form">

                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email" class="form-control-label">E-mail</label>
                                <div class="input-group">
                                    <span class="input-group-addon input_email"><i
                                            class="fa fa-envelope text-primary"></i></span>
                                    <input type="text" class="form-control  form-control-md" name="email" placeholder="E-mail" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="form-group">
                            <label class="form-control-label">Go back to login. </label>
                            <a href="{{ url('admin/login') }}"><b>Log In</b></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection