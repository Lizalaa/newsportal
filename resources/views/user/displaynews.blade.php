 @extends('user/layouts.userlayouts')
@section('usercontent') 
  <!-- user-contents -->
      
      <div class="userdash-content col-lg-9 col-md-9">
        <div class="dash-inner">
          <div class="dash-main">
            <div class="userdash-common user-posts-wrap">
              <h4>My Posts <a href="<?php echo url('user/news/create') ?>" class="btn-common" style="float:right; font-size: 12px; padding:10px 30px;">NEW POST</a></h4>
              <div class="user-posts row"> 
                <!-- news -->
                <?php foreach($usernews as $row)
                {
                  ?>
                <div class="col-lg-4 col-md-6"> 
                  <!-- news -->
                  <div class="common-news text-center">

                    <div class="img-container"> <a href="<?php echo url('user/news/detail',$row->permalink ) ?>" class="image-overlay"></a> <?php if(empty($row->image))
                    {
                        
                        echo "No image";
                    } 
                    else
                      {
                        ?><img src="<?php echo url('').'/uploads/usernews_uploads/'.$row->image ; ?>" class="img-fitted" alt="swadesh">
                      <?php } ?>
                    <!-- status-->
                    <?php if(($row->status)==1)
                    { 
                    ?>
                      <span class="approved s-status">
                        <i class="far fa-check-circle"></i></span>
                      <?php 
                    }
                    else
                    {
                      ?>
                      <span class="not-approved s-status"><i class="far fa-times-circle"></i>
                     </span>
                     
                    
                    <?php }
                    ?>
                     	
                     
                      </div>
                    <div class="common-caption">
                      <h4 class="heading-vsm"><?php echo $row->title ;?></h4>
                      <p><?php echo substr(strip_tags($row->description), 0, 60).'...'; ?></p>
                    </div>
                  </div>
                </div>
                <?php } ?>
                <!-- news -->
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection