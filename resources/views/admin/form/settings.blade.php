@extends('layouts.page')
@section('content')

<div class="content-wrapper"> 
    <!-- Content Header (Page header) --> 

    
    <!-- Main content -->
        <section class="content">
            <form method="post" action="{{url('admin/settings/update', $setting_data['id'])}}" name="update_setting" id="update_setting" enctype="multipart/form-data">
            {!! csrf_field() !!}
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{$errors}}
                </div>

            @endif
             @if (\Session::has('success'))
      <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
      </div><br />
     @endif
                <div class="row">
                    <div class="col-md-12">
                    <!-- /.box-body -->
                        <div class="box-footer text-right">
                            <input type="submit" name="Update" class="btn btn-success">
                        </div>
                    <!-- /.box --> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"><b>Update Settings</b></h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Site Name"> Site Name:* </label>
                                    <input type="text" class="form-control" name="name" id="update_form_category" placeholder="Site Name" value="<?php echo $setting_data['name']; ?>">
                                </div>
                                <input type="hidden" name="id" value="<?php echo $setting_data['id']; ?>">

                                <div class="form-group">
                                    <label for="Logo">Pervious Logo:</label>
                                    <img src="<?php echo url('').'/uploads/setting_uploads/'.$setting_data['logo']; ?>" width="100px" height="100px">
                                    <input type="hidden" name="previouslogo" value="<?php echo $setting_data['logo']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="Logo">Logo:*</label>
                                    <input type="file" class="form-control" name="logo" id="logo">  
                                </div>

                                <div class="form-group">
                                    <label for="facebook link">Facebook link:*</label>
                                    <input type="text" class="form-control" name="facebook_link" placeholder="Facebook Link" value="<?php echo $setting_data['facebook_link']; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="twitter link">Twitter link:*</label>
                                    <input type="text" class="form-control" name="twitter_link" placeholder="Twitter Link" value="<?php echo $setting_data['twitter_link']; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    <!-- /.content --> 
@endsection

