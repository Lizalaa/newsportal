@extends('layouts.page')
@section('content')
    <div class="content-wrapper"> 
    <!-- Content Header (Page header) --> 

    <!-- Main content -->
    <section class="content">
          <?php  $action = isset($user->id) ? url('admin/update', $user->id) : url('admin/store'); ?>
          <form  method="POST" action="<?php echo $action; ?>" id="add_user" enctype="multipart/form-data">
            @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        {{$errors}}
                    </div>
                @endif
                {!! csrf_field() !!}
            <?php if(isset($user->id))
            {
            ?>
                <input type="hidden" name="update_id" value="<?php echo $user->id;?>">
            <?php } ?>
        <div class="row">
              <div class="col-md-12"> 
            <!-- /.box-body -->
            <div class="box-footer text-right">
                  <button type="submit" class="btn btn-success">
                  <?php $action = isset($user->id) ? print 'Update' : print 'Insert'; ?>
                </button>
                   </div>
            <!-- /.box --> 
          </div>
            </div>
        <div class="row">
              <div class="col-md-8">
            <div class="box box-primary">
                  <div class="box-header with-border">
                    
                    <div>
                <h3 class="box-title"><b><?php isset($user->id) ? print 'Update user' : print 'Add user' ;?></b></h3>
              </div>
              </div>
                  <!-- /.box-header -->
                  <div class="box-body">

					<div class="form-group">
					 <label for="Email"> Email:* </label>
                		<input type="text" class="form-control" name="email" id="email" placeholder="Email" value="{{ isset($user->email) ?  $user->email :  old('email') }}">

                    </div>
                <div class="form-group">
                      <label for="Name"> Name:* </label>
                		<input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ isset($user->name) ?  $user->name :  old('name') }}">

                      <span class="error_form" id="title_error_message"></span>
                    </div>

                    <div class="form-group">
					 <label for="Password"> Password:* </label>
                		<input type="password" class="form-control" name="password" id="password" placeholder="Password" >

                    </div>

                    <div class="form-group">
					 <label for="Confirm Password"> Confirm Password:* </label>
                		<input type="password" class="form-control" name="password_confirmation" id="confirmpassword" placeholder="Confirm Password" >

                    </div>
                    <div class="form-group">
                    <?php 
                    if(isset($user->id))
                    {
                    if(empty($user->profile_picture))
					{
                    ?>

						<label class="label label-warning">None</label>
                    <?php 
                    }
                    else
                    {
                      ?>
                      <label for="cost">Previous Image:</label>
                      <img src="<?php echo '/user_uploads/'.$user->profile_picture; ?>" class="img-rounded" width="100px" height="100px">
                      <input type="hidden" name="previousimage" value="<?php echo $user->profile_picture; ?>">
                      <?php } } ?>
                    </div>
                    <div class="form-group">
                      <label for="logo">User Image:*</label>
                      <input type="file" class="form-control" name="user_image" id="image">

                      <span class="error_form" id="user_image_error_message"></span>
                    </div>
        
                
                    <div class="form-group">
                      <label for="User Type">User Type:*</label>
                            <div class="radio">
                                <label>
                                <input type="radio" name="userType" value="User"  <?php echo (isset($user->userType)&&($user->userType == 'User'))?'checked="checked"':'';?>>User
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                <input type="radio" name="userType" value="Admin"  <?php echo (isset($user->userType)?((isset($user->userType)&&($user->userType == 'Admin'))?'checked="checked"':''):'checked="checked"');?> >Admin
                                </label>
                            </div>
                </div>

        
              
              </div>
                </div>
          </div>
          
           
                    
                </div>
          </div>
            </div>
      </form>
        </section>
    <!-- /.content --> 
  </div>
<!-- 
 <script type="text/javascript">
            $(function () {
                $('#date').datetimepicker();
            });
        </script>
@endsection