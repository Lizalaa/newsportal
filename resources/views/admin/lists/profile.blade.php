@extends('layouts.page')
@section('content')
        <div class="content-wrapper"> 
      <!-- Content Header (Page header) -->
      
      <section class="content actionbuttonbox">
            <div class="row">
          <div class="col-xs-12">
          
          <div class="col-xs-12">
        
        @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
          
              </div>
        </div>
          </section>


        <div class="col-md-4">
              
              <div class="box box-primary">
                      <div class="box-header with-border">
                          <h3 class="box-title">
                              Your Details
                          </h3>
                      </div>
                      <!-- /.box-header -->
                        <div class="box-body col-xs-* a">

                    <div><img src="<?php echo url('').'/uploads/user_uploads/'.$users['profile_picture'] ; ?>" width='150px' height='150px' class="img-circle" alt='User Image' >
                    <!-- <input type="button" id="clicky" value="Update profile picture"> -->
                    </div>
                    <div>
                      <br>
                    <div><label>Email:</label><?php echo $users['email']; ?></div>
                    <div><label>Name: </label><?php echo $users['name']; ?></div>
                    
                      <a href="<?php echo url('admin/edit', $users['id']) ;?>" class="text-info"><i class="fa fa-pencil"></i> Edit</a> 

                    </div>
                  </div>
                      </div>
                          
                          
                          
                          
      </section>
    </div>
@endsection