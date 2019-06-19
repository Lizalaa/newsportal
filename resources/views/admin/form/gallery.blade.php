@extends('layouts.page')
@section('content')
    <div class="content-wrapper"> 
    <!-- Content Header (Page header) --> 

    <!-- Main content -->
    <section class="content">
          <?php  $action = isset($gallery->id) ? url('admin/gallery/update', $gallery->id) : url('admin/gallery/store'); ?>
          <form  method="POST" action="<?php echo $action; ?>" id="add_gallery" enctype="multipart/form-data">
            @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        {{$errors}}
                    </div>
                @endif
                {!! csrf_field() !!}
            <?php if(isset($gallery->id))
            {
            ?>
                <input type="hidden" name="update_id" value="<?php echo $gallery->id;?>">
            <?php } ?>
        <div class="row">
              <div class="col-md-12"> 
            <!-- /.box-body -->
            <div class="box-footer text-right">
                  <button type="submit" class="btn btn-success">
                  <?php $action = isset($gallery->id) ? print 'Update' : print 'Insert'; ?>
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
                <h3 class="box-title"><b><?php isset($gallery->id) ? print 'Update gallery' : print 'Add gallery' ;?></b></h3>
              </div>
              </div>
                  <!-- /.box-header -->
                  <div class="box-body">

                <div class="form-group">
                      <label for="Name"> Name:* </label>
                		<input type="text" class="form-control" name="name" id="name" placeholder="Name" value="{{ isset($gallery->name) ?  $gallery->name :  old('name') }}">

                      <span class="error_form" id="title_error_message"></span>
                    </div>

                    <div class="form-group">
                    <?php 
                    if(isset($gallery->id))
                    {
                    if(empty($gallery->cover_image))
					{
                    ?>

						<label class="label label-warning">None</label>
                    <?php 
                    }
                    else
                    {
                      ?>
                      <label for="cost">Previous Image:</label>
                      <img src="<?php echo url('').'/uploads/gallery_uploads/'.$gallery->cover_image; ?>" class="img-rounded" width="100px" height="100px">
                      <input type="hidden" name="previousimage" value="<?php echo $gallery->cover_image; ?>">
                      <?php } } ?>
                    </div>
                    <div class="form-group">
                      <label for="logo">Cover Image:*</label>
                      <input type="file" class="form-control" name="cover_image" id="image">

                      <span class="error_form" id="cover_image_error_message"></span>
                    </div>
                <div class="form-group">
                      <label for="gallery"> Image(Multiple image upload): </label>
                     <input type="file" class="form-control" name="galleryimage[]" multiple/>
                    </div>  
                    </form>
                <?php
                if(isset($gallery->id)) 
                  {
                    foreach ($images as $value) {
                    ?>
                     <?php if(empty($value->image))
                      {

                        break;
                      }
                       else
                      {
                    ?>
        
                    <div class="form-group">
                      <img src="<?php echo url('').'/uploads/gallery_uploads/'.$gallery->id.'/'.$value->image; ?>" class="img-rounded" width="100px" height="100px">
                      <form action="{{url('/gallery', $value->id)}}" method="post">
                            @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <input type="hidden" value="{{$value->image}}" name="previourimage1">
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form> 
                      <?php } ?>
                      
                    </div>
                    <?php }} ?>
              </div>
            </div>
                    

        
              
              </div>
                </div>
          </div>
          
           
                    
                </div>
          </div>
            </div>
      
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