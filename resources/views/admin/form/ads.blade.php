@extends('layouts.page')
@section('content')
    <div class="content-wrapper"> 
    <!-- Content Header (Page header) --> 

    <!-- Main content -->
    <section class="content">
          <?php  $action = isset($ad->id) ? url('admin/ad/update', $ad->id) : url('admin/ad/store'); ?>
          <form  method="POST" action="<?php echo $action; ?>" id="add_ad" enctype="multipart/form-data">
            @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        {{$errors}}
                    </div>
                @endif
                {!! csrf_field() !!}
            <?php if(isset($ad->id))
            {
            ?>
                <input type="hidden" name="update_id" value="<?php echo $ad->id;?>">
            <?php } ?>
        <div class="row">
              <div class="col-md-12"> 
            <!-- /.box-body -->
            <div class="box-footer text-right">
                  <button type="submit" class="btn btn-success">
                  <?php $action = isset($ad->id) ? print 'Update' : print 'Insert'; ?>
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
                <h3 class="box-title"><b><?php isset($ad->id) ? print 'Update ad' : print 'Add ad' ;?></b></h3>
              </div>
              </div>
                  <!-- /.box-header -->
                  <div class="box-body">

					 <div class="form-group">
                      <label for="Title"> Title:* </label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ isset($ad->title) ?  $ad->title :  old('title') }}">

                      <span class="error_form" id="permalink_error_message"></span>
                    </div>
                    <div class="form-group">
                    <?php 
                    if(isset($ad->id))
                    {
                    if(empty($ad->image))
					{
                    ?>

						<label class="label label-warning">None</label>
                    <?php 
                    }
                    else
                    {
                      ?>
                      <label for="cost">Previous Image:</label>
                      <img src="<?php echo url('').'/uploads/ad_uploads/'.$ad->image; ?>" class="img-rounded" width="100px" height="100px">
                      <input type="hidden" name="previousimage" value="<?php echo $ad->image; ?>">
                      <?php } } ?>
                    </div>
                    <div class="form-group">
                      <label for="logo">Ad Image:*</label>
                      <input type="file" class="form-control" name="ad_image" id="image">

                      <span class="error_form" id="ad_image_error_message"></span>
                    </div>
                
                   

                    
                    <div class="form-group">
                      <label for="Status">Status:*</label>
                            <div class="radio">
                                <label>
                                <input type="radio" name="status" value="1"  <?php echo (isset($ad->status)&&($ad->status == '1'))?'checked="checked"':'';?>>Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                <input type="radio" name="status" value="0"  <?php echo (isset($ad->status)?((isset($ad->status)&&($ad->status == '0'))?'checked="checked"':''):'checked="checked"');?> >No
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