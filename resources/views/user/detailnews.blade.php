@extends('user/layouts.userlayouts')
@section('usercontent') 
      <!-- user-contents -->
      
      <div class="userdash-content col-lg-9 col-md-9">
        <div class="dash-inner">
          <div class="dash-main">
            <div class="userdash-common user-posts-wrap">
              <div class="news-details-wrap">

                <?php foreach($detailnews as $row)
                {
                  ?>
                
                <h3 style="margin-bottom:5px;"><?php echo $row['title'] ; ?></h3>
                <div class="other-info"> <span class="news-time">Date: <?php echo $row['created_at'] ; ?></span> <span class="news-time" style="border-left:1px solid #ddd; padding-left: 10px; margin-left:10px;">Category: <?php echo $row['category'] ?></span> </div>
                <!-- image -->
                <div class="img-container"> <?php if(empty($row['image']))
                    { } 
                    else
                      { ?><img src="<?php echo url('').'/uploads/usernews_uploads/'.$row['image'] ; ?>" alt="swa">
                      <?php } ?><p><a href="<?php echo $row['video_link']; ?>" target="_blank"><?php echo $row['video_link']; ?></a> </p>
                </div>
                <!-- news -->
                <div class="detail-texts">
                  <p class="main-text"><span class="bigger-letter"><?php echo ($row['description']['0']); ?></span>
                    <text><?php echo substr($row['description'],1); ?></text>
                  </p>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection