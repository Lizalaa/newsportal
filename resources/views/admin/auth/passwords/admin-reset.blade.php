

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
                                Reset Password</span>
                        </h3>
                    </div>
                    <div class="bg-white login_content login_border_radius">


                    <form action="{{ route('admin.password.request') }}" name="login_form" id="login_form" method="post" class="login_form">

                        {{ csrf_field() }}

                        <input type="hidden" name="token" value="{{ $token }}">
                                           
                        @if($errors->any())
                        {{$errors}}
                        @endif
                            <div class="form-group">
                                <label for="email" class="form-control-label">E-mail</label>
                                <div class="input-group">
                                    <span class="input-group-addon input_email"><i
                                            class="fa fa-envelope text-primary"></i></span>
                                    <input type="text" class="form-control  form-control-md" name="email" placeholder="E-mail" value="{{ $email or old('email') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-control-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon addon_password"><i
                                            class="fa fa-lock text-primary"></i></span>
                                    <input type="password" class="form-control form-control-md" name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-control-label">Password Confirmation</label>
                                <div class="input-group">
                                    <span class="input-group-addon addon_password"><i
                                            class="fa fa-lock text-primary"></i></span>
                                    <input type="password" class="form-control form-control-md" name="password_confirmation" placeholder="Password Confirmation">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection