@extends('user/layouts.userlayouts')
@section('usercontent')
      
      <!-- user-contents -->
      
      <div class="userdash-content col-lg-9 col-md-9">
        <div class="dash-inner">
          <div class="dash-main"> 
            <!-- profile -->
            <div class="new-post"> 
              <!-- add new post/article -->
              <h4>Post News/Article</h4>
            
              <form class="common-form" action="<?php echo url('user/news/store')?>" id="add_user_news" method="POST" enctype="multipart/form-data">
                <!-- news title -->
                {!!csrf_field()!!}
                
                @if($errors->any())
                <div class="alert alert-danger">
                    {{$errors}}
                    </div>
                @endif
                <div class="form-group">
                  <label>Title:</label>
                <input type="text" class="form-control" placeholder="Title" name="title" id="title" value="{{old('title')}}">
                      <span class="error_form" id="title_error_message"></span>
                </div>
                
                <!-- news date and image -->
                
                <div class="form-groups row">
                  <div class="form-group col-lg-6 col-md-6">
                    <label>Category:*</label>
                    <select name="category" class="category" id="parentcategory">
                        
                        <option value="-1">- Select -</option>
                        <?php foreach($category as $row)
                        { 
						   	$sel = (($row->id == old('category')) ) ? 'selected' : ($row->id == old('category'));
                            echo '<option value='.$row->id.' '.$sel.' >'.$row->category.'</option>';
                        }
                        ?>
                      </select>
                      <span class="error_form" id="news_category_error_message"></span>
                  </div>

                  <div class="form-group col-lg-6 col-md-6" id="subcategory_field">
                    <label for="Sub Category">Sub Category:*</label>
                    <br>
                    <select name="subcategory" class="models" id="subcategory">
                        <option value="0">- Select -</option>
                    </select>
                      
                  </div>

                  <div class="form-group col-lg-6 col-md-6">
                     <label for="Video Link"> Video Link: </label>
                  <input type="text" class="form-control" name="video_link" id="videolink" placeholder="Video Link" value="{{old('video_link')}}">
                      <span class="error_form" id="videolink_error_message"></span>
                      
                  </div>

                  <div class="form-group col-lg-6 col-md-6">
                    <label>Date:*</label>
                  <input type="date" class="form-control" name="date" id="date" placeholder="Date" value="{{old('date')}}">
                      <span class="error_form" id="date_error_message"></span>
                  </div>
                </div>
                <!-- news date -->
                <div class="form-group">
                  <label>Description:*</label>
                  <textarea class="form-control" rows="6" id="description" name="description">{{old('description')}}</textarea>

                      <span class="error_form" id="description_error_message"></span>
        
      </textarea>
                </div>
                
                <!-- image -->
                
                <div class="form-group">
                  <label>Upload Image:</label>
                  <input type="file" name="image" class="form-control"  id="image">
                      <span class="error_form" id="news_image_error_message"></span>
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