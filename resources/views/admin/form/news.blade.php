@extends('layouts.page')
@section('content')
      	<div class="content-wrapper"> 
    <!-- Content Header (Page header) --> 

    <!-- Main content -->
    		<section class="content">
          		<?php  $action = isset($news->id) ? url('admin/news/update', $news->id) : url('admin/news/store'); ?>
          			<form  method="POST" action="<?php echo $action; ?>" id="add_news" enctype="multipart/form-data">
           				@if ($errors->any())
                    		<div class="alert alert-danger" role="alert">
                        		{{$errors}}
                    		</div>
                		@endif
                		{!! csrf_field() !!}
            			<?php if(isset($news->id))
            			{
            			?>
          					<input type="hidden" name="update_id" value="<?php echo $news->id;?>">
         				<?php } ?>
        				<div class="row">
              				<div class="col-md-12"> 
            					<!-- /.box-body -->
            					<div class="box-footer text-right">
                  					<button type="submit" class="btn btn-success">
                  						<?php $action = isset($news->id) ? print 'Update' : print 'Insert'; ?>
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
                							<h3 class="box-title"><b><?php isset($news->id) ? print 'Update News' : print 'Add News' ;?></b></h3>
              							</div>
              						</div>
                  					<!-- /.box-header -->
                  					<div class="box-body">
                						<div class="form-group">
                      						<label for="Title"> Title:* </label>
                							<input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ isset($news->title) ?  $news->title :  old('title') }}">
											<span class="error_form" id="title_error_message"></span>
                    					</div>

                    					<div class="form-group">
                      						<label for="Date"> Date:* </label>
                      						<input type="date" name="date" id="date" class="form-control date" value="{{ isset($news->date)? $news->date :  old('date') }}">
                      						<span class="error_form" id="date_error_message"></span>
										</div>
										
                    					<div class="form-group">
                    						<?php 
                    						if(isset($news->id))
                    						{
                    							if(empty($news->image))
						       					{
                        						?>
													<label class="label label-warning">None</label>
                    							<?php 
                    							}
                    							else
                    							{
                      							?>
                      								<label for="cost">Previous Image:</label>
                      								<img src="<?php echo url('').'/uploads/news_uploads/'.$news->image; ?>" class="img-rounded" width="100px" height="100px">
                      								<input type="hidden" name="previousimage" value="<?php echo $news->image; ?>">
                      							<?php } } ?>
											</div>
											
                    						<div class="form-group">
                      							<label for="logo">News Image:*</label>
                      							<input type="file" class="form-control" name="news_image" id="image">

                      							<span class="error_form" id="news_image_error_message"></span>
                    						</div>
            
             								<div class="form-group">
                      							<label for="Category" >Category:*</label>
                      							<br>
                      							<select class="form-control" name="category" class="category" id="parentcategory" >
                        							<option value = '-1'>--Select category--</option>
                        							<?php
                          							foreach($category as $categories)
                          							{

										   				$sel = (isset($news->id)?($categories->id == $news->category ):($categories->id == old('category')) ) ? 'selected' : ($categories->id == old('category'));
														echo "<option value='$categories->id' $sel>$categories->category</option>";

													}  
                        							?>
                      							</select>
                      							<span class="error_form" id="news_category_error_message"></span>
              								</div>
				
											<div class="form-group" id="subcategory_field">
                      							<label for="Sub Category" >Sub Category:*</label>
                      							<br>
											<select class="form-control" name="subcategory"  class="subcategory" id="subcategory">
                        							<option value = '0'>--Select sub category--</option>
                      							</select>
                      							<span class="error_form" id="news_category_error_message"></span>
											</div>
											  
                							<div class="form-group">
                      							<label for="description">Descriptions:*</label>
                      							<textarea class="form-control" id="description"  name="description">{{ isset($news->description)? $news->description : old('description') }}</textarea>
												<span class="error_form" id="description_error_message"></span>
											</div>
                
                    						<div class="form-group">
                      							<label for="Feature">Feature:*</label>
                            							<div class="radio">
                                						<label>
                                							<input type="radio" name="feature" value="1"  <?php echo (isset($news->feature)&&($news->feature == '1'))?'checked="checked"':'';?>>Yes
                                						</label>
                            							</div>
                            							<div class="radio">
                                						<label>
                                							<input type="radio" name="feature" value="0"  <?php echo (isset($news->feature)?((isset($news->feature)&&($news->feature == '0'))?'checked="checked"':''):'checked="checked"');?> >No
                                						</label>
                            							</div>
                							</div>

                							<div class="form-group">
                      							<label for="Published">Published:*</label>
                            					<div class="radio">
                                					<label>
                                						<input type="radio" name="publish" value="1"  <?php echo (isset($news->publish)&&($news->publish == '1'))?'checked="checked"':'';?>>Yes
                                					</label>
                            					</div>
                            					<div class="radio">
                                					<label>
                                						<input type="radio" name="publish" value="0"  <?php echo (isset($news->publish)?((isset($news->publish)&&($news->publish == '0'))?'checked="checked"':''):'checked="checked"');?> >No
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