@extends('layouts.page')

@section('content')
      <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    
    <section class="content actionbuttonbox">
          <div class="row">
        <div class="col-xs-12">
        
        @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
        
              <div class="box text-right actionbutton clearfix padding">
              
              <div class="col-sm-4"><form>
              </form></div>
            <div class="col-sm-8"><a class="btn btn-success" href="{{url('admin/create')}}"> <i class="fa fa-plus"></i> Add new </a></div>
              
              
               
               
               
               </div>
            </div>
      </div>
        </section>
    <!-- Main content -->
    <section class="content">
          <div class="row">
        <div class="col-xs-12">
              <div class="box">
            <div class="box-header">
                  <h3 class="box-title"><b>All Users</b></h3>
                </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                <tbody>
                  <tr>
                    <th>ID</th>
                    <th>Name</th></th>
                    <th>Email</th>
                    <th>Profile Picture</th>
                    <th>Hash Password</th>
                    <th>Status</th>
                    <th>User Type</th>                                                                                                                                                                                                                                                  
                  </tr>
                  <?php
                  $i=1;

                    foreach($users as $row)
                    {
                    ?>
                    <tr>
                    <td><?php echo $i; ?></td>
                    
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                   

                    <td><img src="{{url('')}}/uploads/user_uploads/<?php echo $row->profile_picture?>" width='150px' class="img-rounded" height='150px' alt='User Image' ></td>
                    <td>{{$row->password}}</td>
                    <td>{{$row->verified}}</td>
                    <td>{{$row->userType}}</td>
                    
                    

                    <?php
                    $i++;

                    }
                    
                    ?>

                  </tr>
                 </tbody>
               </table>
             </div>
           </div>
           </div>
         </div>
        </section>
    <!-- /.content --> 

@endsection
