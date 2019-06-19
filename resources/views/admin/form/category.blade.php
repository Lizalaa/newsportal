@extends('layouts.page')
@section('content')
    <div class="content-wrapper"> 
    <!-- Content Header (Page header) --> 

    <!-- Main content -->
    <section class="content">
          <?php  $action = isset($category->id) ? url('admin/category/update', $category->id) : url('admin/category/store'); ?>
          <form  method="POST" action="<?php echo $action; ?>" id="add_category" enctype="multipart/form-data">
            @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        {{$errors}}
                    </div>
                @endif
                {!! csrf_field() !!}
            <?php if(isset($category->id))
            {
            ?>
                <input type="hidden" name="update_id" value="<?php echo $category->id;?>">
            <?php } ?>
        <div class="row">
              <div class="col-md-12"> 
            <!-- /.box-body -->
            <div class="box-footer text-right">
                  <button type="submit" class="btn btn-success">
                  <?php $action = isset($category->id) ? print 'Update' : print 'Insert'; ?>
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
                <h3 class="box-title"><b><?php isset($category->id) ? print 'Update category' : print 'Add category' ;?></b></h3>
              </div>
              </div>
                  <!-- /.box-header -->
                  <div class="box-body">

					<div class="form-group">
					  <label for="Category"> Parent Category:* </label>
            <br>
                		<select name="parentcategory" class="form-control">
							<option value="0">--Select parent category--</option>
              <?php
              
							foreach($parentcategory as $row)
							{
                				$sel = (isset($category->id)?($row->id == $category->parentcategory ):($row->id == old('parentcategory')) ) ? 'selected' : ($row->id == old('parentcategory'));
								echo "<option value='$row->id' $sel>$row->category</option>";
							} 
							?>
						</select>

                      <span class="error_form" id="title_error_message"></span>
                    </div>
                <div class="form-group">
                      <label for="Category"> Category:* </label>
                		<input type="text" class="form-control" name="category" id="category" placeholder="Category" value="{{ isset($category->category) ?  $category->category :  old('category') }}">

                      <span class="error_form" id="title_error_message"></span>
                    </div>

                    <div class="form-group">
                      <label for="Date"> Date:* </label>
                      <input type="date" name="date" id="date" class="form-control date" value="{{ isset($category->date)? $category->date :  old('date') }}">
                      
                      <span class="error_form" id="date_error_message"></span>
                    </div>
                    <div class="form-group">
                    <?php 
                    if(isset($category->id))
                    {
                    if(empty($category->image))
					{
                    ?>

						<label class="label label-warning">None</label>
                    <?php 
                    }
                    else
                    {
                      ?>
                      <label for="cost">Previous Image:</label>
                      <img src="<?php echo url('').'/uploads/category_uploads/'.$category->image; ?>" class="img-rounded" width="100px" height="100px">
                      <input type="hidden" name="previousimage" value="<?php echo $category->image; ?>">
                      <?php } } ?>
                    </div>
                    <div class="form-group">
                      <label for="logo">Category Image:*</label>
                      <input type="file" class="form-control" name="category_image" id="image">

                      <span class="error_form" id="category_image_error_message"></span>
                    </div>
                
                    <div class="form-group">
                      <label for="Permalink"> Permalink:* </label>
                <input type="text" class="form-control" name="permalink" id="permalink" placeholder="Permalink" value="{{ isset($category->permalink) ?  $category->permalink :  old('permalink') }}">

                      <span class="error_form" id="permalink_error_message"></span>
                    </div>

                    <div class="form-group">
                      <label for="Color"> Color:* </label>
                <input type="text" class="form-control" name="color" id="color" placeholder="Color" value="{{ isset($category->color) ?  $category->color :  old('color') }}">

                      <span class="error_form" id="color_error_message"></span>
                    </div>
                
                    <div class="form-group">
                      <label for="Order"> Order:* </label>
                <input type="text" class="form-control" name="order" id="order" placeholder="Order" value="{{ isset($category->order) ?  $category->order :  old('order') }}">

                      <span class="error_form" id="order_error_message"></span>
                    </div>
                <div class="form-group">
                      <label for="description">Descriptions:*</label>
                      <textarea class="form-control" id="description"  name="description">{{ isset($category->description)? $category->description : old('description') }}</textarea>
                      <span class="error_form" id="description_error_message"></span>

                    </div>
                
                    <div class="form-group">
                      <label for="Status">Status:*</label>
                            <div class="radio">
                                <label>
                                <input type="radio" name="status" value="1"  <?php echo (isset($category->status)&&($category->status == '1'))?'checked="checked"':'';?>>Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                <input type="radio" name="status" value="0"  <?php echo (isset($category->status)?((isset($category->status)&&($category->status == '0'))?'checked="checked"':''):'checked="checked"');?> >No
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