@extends('site/layouts.app')
@section('sitecontent')

<!-- albums -->
<section class="gallery-albums pad-bot inner-page pad-top">
  <div class="container">
    <h3 class="heading-mid text-center">Sign Up</h3>
    <div class="ad-form-wrap">
      <form class="common-form" action="" id="sign_up_form" class="sign_up_form" method="POST">
<meta name="csrf-token-register" content="{{ csrf_token() }}">
        <!-- first group -->
          <div class="response">
                  
                      </div>
        <div class="form-groups row"> 
              
          <div class="col-lg-6 col-md-6 form-group">
            <label>Email:</label>
          <input type="text" name="email" id="email_user" value="{{old('email_user')}}">
            <span class="error_form" id="email_error_message"></span>
          </div>
          
          <!-- name -->
          <div class="col-lg-6 col-md-6 form-group">
            <label>Name:</label>
            <input type="text" name="username" id="username_user" value="{{old('username_user')}}">
            <span class="error_form" id="username_error_message"></span>
          </div>
        </div>
          
          
        <!-- third group -->
        <div class="form-groups row"> 
          <!-- name -->
          <div class="col-lg-6 col-md-6 form-group">
            <label>Password:</label>
          <input type="password" name="password" id="password_user" value="{{old('password_user')}}">
            <span class="error_form" id="password_error_message"></span>
          </div>

          
          </div>
          <div id="loading-signup"></div>
          <button type="submit" name="register" id="signup_button" class="form-btn">SEND <i class="fab fa-telegram-plane"></i></button>
          <div class="clearfix"></div>
        </div>
      </form>
    </div>
  </div>
</section>



<!-- add -->
<!-- <section class="pad-bot pad-top">
  <div class="container">
    <div class="standard-ad"> <a href="#"><img src="images/ad.jpg" class="" alt="ad"></a></div>
  </div>
</section>
 -->

@endsection
