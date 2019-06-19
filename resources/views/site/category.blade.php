@extends('site/layouts.app')
@section('sitecontent')
<script type="text/javascript">
  $(document).ready(function () {

    $(document).on('click', '.click_link', function () {
        var link = $(this).data('custom-value');
            $.ajax({
                    type: "GET",
                    data:{link:link},
                    url: "count_view",
                    dataType: 'json'
                });

    });
});

</script>
<!-- popular -->
<section class="pad-top pad-bot standard-news-whole inner-page">
  <div class="container">
    <h3 class="heading-mid"><?php foreach ($categorylist as $value) {
      echo $value['category'];
      break;
    } ?></h3>
    <div class="row standard-news-wrap">
      <!-- small news -->
      <div class="col-sm-3">
        <!-- news -->

          <?php 
            for ($i=0; $i < 2; $i++) { 
                if(empty($categorylist[$i]))
            {
              break;
            }

          ?>
                  <div class="common-news text-center">
          <div class="img-container">
            
            <a href="<?php echo url('').'/detail/'.$categorylist[$i]['permalink'] ;?>" data-custom-value="<?php echo $categorylist[$i]['permalink']   ?>" id="click_link" class="image-overlay click_link"></a>
            <img src='<?php echo url('')."/uploads/news_uploads/".$categorylist[$i]['image'] ;?>' class="img-fitted" alt="swadesh">
           </div>
          <div class="common-caption">
            <h4 class="heading-vsm"><?php echo $categorylist[$i]['title']?></h4>
            <p>
            <?php
              echo substr(strip_tags($categorylist[$i]['description']), 0, 60).'...'; 
            ?>         
            <span class="news-time"><i class="far fa-clock"></i><?php echo $categorylist[$i]['created_at']?></span>        
          </div>   
          </div>
                 
          <?php } ?>

        </div>

        <!-- big news -->
       <div class="col-lg-6 col-md-6 standard-news">
              <?php 
            for ($i=2; $i < 3; $i++) { 
              if(empty($categorylist[$i]))
            {
              break;
            }

            ?>
        <div class="standard-news-in text-center">
          <div class="img-container">
           <a href="<?php echo url('').'/detail/'.$categorylist[$i]['permalink'] ;?>" data-custom-value="<?php echo $categorylist[$i]['permalink']   ?>" id="click_link" class="image-overlay click_link"></a>
            <img src='<?php echo url('')."/uploads/news_uploads/".$categorylist[$i]['image'] ;?>' alt="img" class="img-fitted">
          </div>
          <div class="standard-caption">
            <h3><?php echo $categorylist[$i]['title']?></h3>
            <p><?php
              echo substr(strip_tags($categorylist[$i]['description']), 0, 60).'...'; 
            ?>  </p>
            <span class="news-time"><i class="far fa-clock"></i><?php echo $categorylist[$i]['created_at'];?></span>
          </div>
        </div>      <?php } ?>

      </div>
      <!-- small news -->
      <div class="col-lg-3 col-md-3">
           <?php 
            for ($i=3; $i < 5; $i++) { 
            if(empty($categorylist[$i]))
            {
              break;
            }

            ?>
        <!-- news -->
        <div class="common-news text-center">
          <div class="img-container">
            <a href="<?php echo url('').'/detail/'.$categorylist[$i]['permalink'] ;?>" data-custom-value="<?php echo $categorylist[$i]['permalink']   ?>" id="click_link" class="image-overlay click_link"></a>
            <img src='<?php echo url('')."/uploads/news_uploads/".$categorylist[$i]['image'] ;?>' class="img-fitted" alt="swadesh">
            
          </div>
          <div class="common-caption">
            <h4 class="heading-vsm"><?php echo $categorylist[$i]['title']?></h4>
            <p><?php
              echo substr(strip_tags($categorylist[$i]['description']), 0, 60).'...'; 
            ?>  </p>
            <span class="news-time"><i class="far fa-clock"></i><?php echo $categorylist[$i]['created_at'];?></span>
          </div>              <?php } ?>

        </div>

       
      </div>
    </div>
  </div>
</section>
<!-- other news -->

<section class="pad-top pad-bot other-wrap">
  <div class="container">
    <div class="other-news row">
      <!-- small news -->
         <?php for ($i=5; $i < (count($categorylist)); $i++) { 

        ?>
      <div class="col-sm-3 other-news-in">
     
        <!-- news -->
        <div class="common-news text-center">
          <div class="img-container">
           <a href="<?php echo url('').'/detail/'.$categorylist[$i]['permalink'] ;?>" data-custom-value="<?php echo $categorylist[$i]['permalink']   ?>" id="click_link" class="image-overlay click_link"></a>
             <img src='<?php echo url('')."/uploads/news_uploads/".$categorylist[$i]['image'] ;?>' class="img-fitted" alt="swadesh">
          </div>
          <div class="common-caption">
            <h4 class="heading-vsm"><?php echo $categorylist[$i]['title'];?></h4>
            <p><?php
              echo substr(strip_tags($categorylist[$i]['description']), 0, 60).'...'; 
            ?>  </p>
            <span class="news-time"><i class="far fa-clock"></i><?php echo $categorylist[$i]['created_at'];?></span>
          </div>

      </div>

      </div>
                      <?php } ?>
    </div>


    <div class="text-center btn-wrap">
      <!-- <a href="#" class="btn-common">LOAD MORE</a> -->
    </div>
  </div>
</section>


<!-- gallery -->
<section class="gallery-home-wrap pad-bot">
  <div class="container">
    <h3 class="heading-mid text-center">GALLERY</h3>
    <div class="row gallery-home">
          <?php 
          foreach ($gallery_data as $value) {
          ?>
      <div class="col-lg-3 col-md-6 gallery-in">
        <div class="img-container">

          <a href="<?php echo url('').'/gallery' ?>" class="image-overlay"></a>
          <img src="<?php echo url('').'/uploads/gallery_uploads/'.$value->cover_image; ?>" class="img-fitted" alt="gallery">
        </div>
      </div>
            <?php } ?>
      </div>

    </div>
  </div>
</section>
@endsection