@extends('user/layouts.userlayouts')
@section('usercontent')

<div class="userdash-content col-lg-9 col-md-9">
        <div class="dash-inner">
          <div class="dash-main"> 
            <!-- profile -->
            
            <div class="new-post"> 
              <!-- add new post/article -->
              <h4>Edit Profile</h4>
                
              <form class="common-form" id="registration_form" action="<?php echo url('user/profile/update', $userdetail->id) ?>" method="POST" enctype="multipart/form-data">
               {!!csrf_field()!!}
                @if($errors->any())
                <div class="alert alert-danger">{{$errors}}</div>
                @endif
                @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
                <div class="form-groups row">
                  <div class="form-groups-side col-lg-6 col-md-6"> 
                   <!-- firstname -->
                <div class="form-group">
                      <label for="Email">Email:*</label>
                      <input type="text" class="form-control" name="email" value="<?php echo $userdetail->email ; ?>" id="email">
                      <span class="error_form" id="email_error_message"></span> 
                </div>

                <div class="form-group">
                      <label for="Password">Password:*</label>
                      <input type="password" class="form-control" name="password" id="password" >
                      <input type="hidden" class="form-control" name="previouspassword" value="<?php echo $userdetail->password ; ?>" id="previouspassword">
                </div>
                
                <div class="form-group">
                      <label for="username">Username:*</label>
                      <input type="text" class="form-control" name="username" value="<?php echo $userdetail->name ; ?>" id="username">
                      <span class="error_form" id="username_error_message"></span> 
                </div>
              </div>
                <div class="form-groups-side col-lg-6 col-md-6">
                 <div class="img-container">

                  <?php if(empty($userdetail->profile_picture))
                    {
                    }
                    else
                    {
                      ?>
                <!-- image -->
                   
                  <img src="<?php echo url('').'/uploads/newuser_uploads/'.$userdetail->profile_picture; ?>" width="100px" height="100px" alt="username" class="img-fitted">
                  <input type="hidden" class="form-control" name="previousprofile" value="<?php echo $userdetail->profile_picture ; ?>" id="previousprofile">
                  <?php } ?>
                </div>
                <div class="form-group">
                      <label for="Profile Picture">Upload File:*</label>
                      <input type="file" name="user_image" class="form-control" >
                      
                    </div>
                </div>
              </div>
                  
                
                <!-- submit -->
                <div class="form-group">
                  <button type="submit" class="form-btn">POST</button>
                  <div class="clearfix"></div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection