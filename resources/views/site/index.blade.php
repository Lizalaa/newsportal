@extends('site/layouts.app')
@section('sitecontent')
<script type="text/javascript">


  $(document).ready(function(){

        index_load(0);
        
        $("#load_more").click(function(e){
            e.preventDefault();
            var page = $(this).data('val');
            index_load(page);
        });

    });


    var index_load = function(page){

        $.ajax({
          url:"index_load",
          method:'GET',
          data: {page:page}
        }).done(function(data){
            //$("#load_more").hide();
          
          if (data == 1) 
          {
            $("#load_more").hide();
          } 
          else
          {
            //$("#load_more").show();
            var data = $.parseJSON(data);
            $.each(data, function (i) {
                var image= url+"/uploads/news_uploads/"+data[i].image;
                var link = url+"/detail/"+data[i].permalink;
                var category_link = url+"/category/"+data[i].category_permalink;
                var permalink = data[i].permalink;
                var category = data[i].category;
                var title = data[i].title;
                var created_date = data[i].created_at;
                var color = data[i].color;
            $("#ajax_image").append('<div class="stylish-news col-lg-4 col-md-6"><div class="img-container"><img src='+image+' alt="swadesh" class="img-fitted"><div class="stylish-caption"><a href='+category_link+' class="news-cat" style="background-color:'+color+'; color:white; text-decoration: none;">'+category+'</a><h3><a href='+link+' data-custom-value="'+permalink+'" class="click_link" style=" text-decoration: none;">'+title+'</a></h3><span class="news-time"><i class="far fa-clock">'+created_date+'</i></span></div></div></div>');
      });
            $('#load_more').data('val',($('#load_more').data('val')+1));
            //scroll();
          }
        });
    };
    var scroll  = function(){
        $('html, body').animate({
            scrollTop: $('#load_more').offset().top
        }, 1000);
    };
</script>
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

<!-- slider -->
<section class="slider-wrap">
  <div class="row slider">
    <div class="col-lg-6">
      <div id="slider1" class="carousel carousel-fade slide large-slider" data-interval="10000" data-ride="carousel" data-pause="false">
        <div class="carousel-inner">
      <!-- 
      Display albums in carousel 
       -->
          <?php 
          for ($i=0; $i < 2 ; $i++) { 
            if(empty($news_featured[$i]))
            {
              break;
            }

            if($i == 0)
            {
              echo '<div class="carousel-item active">';
            }
            else
            {
              echo '<div class="carousel-item">';
            }
          ?>
          
            <img src="<?php echo url('').'/uploads/news_uploads/'.$news_featured[$i]['image'];?>" alt="{{$news_featured[$i]['title']}}" class="img-fitted">
            <!-- news -->
            <div class="carousel-caption animated fadeIn" style="animation-delay:1s">
              <div class="caption-news text-left">

                  <a href="<?php echo url('').'/category/'.$news_featured[$i]['category_permalink'] ;?>" class="news-cat" style="background-color:<?php echo $news_featured[$i]['color'] ?>; color:white; text-decoration: none;">
                    <?php echo $news_featured[$i]['category'] ?></a>
                  <h3 class="heading-sm">
                  <a href="<?php echo url('').'/detail/'.$news_featured[$i]['permalink'] ;?>" data-custom-value="<?php echo $news_featured[$i]['permalink']; ?>" class="click_link" style="text-decoration: none;">
                 <?php echo $news_featured[$i]['title'] ?></a></h3>
                <span class="news-time"><i class="far fa-clock"></i>
                  <?php $php_timestamp =strtotime($news_featured[$i]['created_at']); 
                  $php_timestamp_date = date("d F Y H:i:s", $php_timestamp);
                   echo "".$php_timestamp_date.""; ?>
                </span>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
            

    <!-- second slider -->

    <div class="col-lg-3 col-md-6">
     
      <div id="slider2" class="carousel carousel-fade slide small-slider" data-ride="carousel" data-interval="10000" data-pause="false">
        <div class="carousel-inner">
           <?php 
          for ($i=2; $i < 4 ; $i++) { 
            if(empty($news_featured[$i]))
            {
              break;
            }
            if($i == 2)
            {
              echo '<div class="carousel-item active">';
            }
            else
            {
              echo '<div class="carousel-item">';
            }
          ?>
            <img src="<?php echo url('').'/uploads/news_uploads/'.$news_featured[$i]['image'];?>" alt="{{$news_featured[$i]['title']}}" class="img-fitted">
            <!-- news -->
            <div class="carousel-caption animated fadeIn" style="animation-delay:2s">
              <div class="caption-news text-left">
                <a href="<?php echo url('').'/category/'.$news_featured[$i]['category_permalink'] ;?>" class="news-cat" style="background-color:<?php echo $news_featured[$i]['color'] ?>; color:white; text-decoration: none;"><?php echo $news_featured[$i]['category'] ?></a>
                  
                <a href="<?php echo url('').'/detail/'.$news_featured[$i]['permalink'] ;?>" data-custom-value="<?php echo $news_featured[$i]['permalink'] ; ?>" class="click_link" style="text-decoration: none;">
                <h3 class="heading-sm"><?php echo $news_featured[$i]['title'] ?></a></h3>
                <span class="news-time"><i class="far fa-clock"></i> <?php $php_timestamp =strtotime($news_featured[$i]['created_at']); 
                  $php_timestamp_date = date("d F Y H:i:s", $php_timestamp);
                   echo "".$php_timestamp_date.""; ?></span>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    
    <!-- second slider -->
    <div class="col-lg-3 col-md-6">
       
      <div id="slider3" class="carousel carousel-fade slide small-slider" data-ride="carousel" data-interval="10000" data-pause="false">
      <div class="carousel-inner">
             <?php 
            for ($i=4; $i < 6 ; $i++) { 
              if(empty($news_featured[$i]))
            {
              break;
            }

            if($i == 4)
            {
              echo '<div class="carousel-item active">';
            }
            else
            {
              echo '<div class="carousel-item">';
            }
          ?>
  
            <img src="<?php echo url('').'/uploads/news_uploads/'.$news_featured[$i]['image'];?>" alt="{{$news_featured[$i]['title']}}" class="img-fitted">
            <!-- news -->
            <div class="carousel-caption animated fadeIn" style="animation-delay:3s">
              <div class="caption-news text-left">
                <a href="<?php echo url('').'/category/'.$news_featured[$i]['category_permalink'] ;?>" class="news-cat" style="background-color:<?php echo $news_featured[$i]['color'] ?>; color:white; text-decoration: none;"><?php echo $news_featured[$i]['category'] ?></a>
                <a href="<?php echo url('').'/detail/'.$news_featured[$i]['permalink'] ;?>" data-custom-value="{{ $news_featured[$i]['permalink']}}" class="click_link" style="text-decoration: none;">
                <h3 class="heading-sm">
                <?php echo $news_featured[$i]['title'] ?></a></h3>
                <span class="news-time"><i class="far fa-clock"></i> <?php $php_timestamp =strtotime($news_featured[$i]['created_at']); 
                  $php_timestamp_date = date("d F Y H:i:s", $php_timestamp);
                   echo "".$php_timestamp_date.""; ?></span>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
</section>

<!-- latest -->
<section class="pad-top stylish-whole pad-bot">
  <div class="container">
    <h3 class="heading-mid">LATEST</h3>
    <div class="row stylish-news-wrap ajax_image" id="ajax_image">
</div>
      <div class="text-center btn-wrap">

    <button class="btn btn-common load_more" id="load_more" data-val ="0">Load more..</button>
    </div>
  </div>
</section>

<!-- popular -->
<section class="pad-top pad-bot standard-news-whole">
  <div class="container">
    <h3 class="heading-mid">POPULAR</h3>
    <div class="row standard-news-wrap">
      <!-- small news -->
      
      <div class="col-lg-3 col-md-3">
        <!-- news -->
          <?php 
            for ($i=0; $i < 2; $i++) { 
              if(empty($news_popular[$i]))
            {
              break;
            }
          ?>
          <div class="common-news text-center">
          <div class="img-container">
            <a href="<?php echo url('').'/detail/'.$news_popular[$i]['permalink'] ;?>" data-custom-value="<?php echo $news_popular[$i]['permalink']  ?>" id="click_link" class="image-overlay click_link"></a>
            <img src='<?php echo url('')."/uploads/news_uploads/".$news_popular[$i]['image'] ;?>' class="img-fitted" alt="<?php echo $news_popular[$i]['title']?>">
           </div>
          <div class="common-caption">
            <h4 class="heading-vsm"><?php echo $news_popular[$i]['title']?></h4>
              <p><?php
              echo substr(strip_tags($news_popular[$i]['description']), 0, 60).'...'; 
            ?>
            </p>
            <span class="news-time"><i class="far fa-clock"></i> <?php $php_timestamp =strtotime($news_popular[$i]['created_at']); 
                  $php_timestamp_date = date("d F Y H:i:s", $php_timestamp);
                   echo "".$php_timestamp_date.""; ?></span>        
                 </div>          

          </div>
          <?php } ?>
        </div>

      
      <!-- big news -->

      <div class="col-lg-6 col-md-6 standard-news">
              <?php 
            for ($i=2; $i < 3; $i++) { 
               if(empty($news_popular[$i]))
            {
              break;
            }
            ?>
        <div class="standard-news-in text-center">
          <div class="img-container">
           <a href="#" data-custom-value="<?php echo $news_popular[$i]['permalink']  ?>" id="click_link"  class="image-overlay click_link"></a>
            <img src='<?php echo url('')."/uploads/news_uploads/".$news_popular[$i]['image'] ;?>' class="img-fitted" alt="<?php echo $news_popular[$i]['title']?>">
          </div>
          <div class="standard-caption">
            <h3><?php echo $news_popular[$i]['title']?></h3>
            <p>
              <?php
               echo substr(strip_tags($news_popular[$i]['description']), 0, 60).'...'; 
            ?></p>
            <span class="news-time"><i class="far fa-clock"></i> <?php $php_timestamp =strtotime($news_popular[$i]['created_at']); 
                  $php_timestamp_date = date("d F Y H:i:s", $php_timestamp);
                   echo "".$php_timestamp_date.""; ?></span>
          </div>
        </div>      <?php } ?>
      </div>
      <!-- small news -->
   
      <div class="col-lg-3 col-md-3">
           <?php 
            for ($i=3; $i < 5; $i++) { 
               if(empty($news_popular[$i]))
            {
              break;
            }
            ?>
        <!-- news -->
        <div class="common-news text-center">
          <div class="img-container">
             <a href="<?php echo url('').'/detail/'.$news_popular[$i]['permalink'] ;?>" data-custom-value="<?php echo $news_popular[$i]['permalink']  ?>" id="click_link"  class="image-overlay click_link"></a>
            <img src='<?php echo url('')."/uploads/news_uploads/".$news_popular[$i]['image'] ;?>' class="img-fitted" alt="<?php echo $news_popular[$i]['title']?>">
          </div>
          <div class="common-caption">
            <h4 class="heading-vsm"><?php echo $news_popular[$i]['title']?></h4>
              <p><?php
              echo substr(strip_tags($news_popular[$i]['description']), 0, 60).'...'; 
            ?>
            </p>
          <span class="news-time"><i class="far fa-clock"></i> <?php $php_timestamp =strtotime($news_popular[$i]['created_at']); 
                  $php_timestamp_date = date("d F Y H:i:s", $php_timestamp);
                   echo "".$php_timestamp_date.""; ?></span>
          </div>            

        </div>
        <?php } ?>
       
      </div>
    </div>
  </div>

</section>

<section class="pad-top pad-bot other-wrap">
  <div class="container">

    <div class="other-news row">
      <!-- small news -->
      <?php for ($i=5; $i < (count($news_popular)); $i++) { 

        ?>
      <div class="col-sm-3 other-news-in">
        <!-- news -->
        
        <div class="common-news text-center">
          <div class="img-container">
            <a href="<?php echo url('').'/detail/'.$news_popular[$i]['permalink'] ;?>" data-custom-value="<?php echo $news_popular[$i]['permalink']  ?>" id="click_link"  class="image-overlay click_link"></a>
            <img src="<?php echo url('')."/uploads/news_uploads/".$news_popular[$i]['image'] ;?>" class="img-fitted" alt="swadesh">
          </div>
          <div class="common-caption">
            <h4 class="heading-vsm"><h4 class="heading-vsm"><?php echo $news_popular[$i]['title']?></h4>
            <p><?php echo substr(strip_tags($news_popular[$i]['description']), 0, 60).'...';;?></p>
            <span class="news-time"><i class="far fa-clock"></i> <?php $php_timestamp =strtotime($news_popular[$i]['created_at']); 
                  $php_timestamp_date = date("d F Y H:i:s", $php_timestamp);
                   echo "".$php_timestamp_date.""; ?></span>
          </div>

        </div>
       
      </div> 
      <?php
      }
      ?>
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

        <a href="{{url('').'/gallery'}}" class="image-overlay"></a>
        <img src="<?php echo url('')."/uploads/gallery_uploads/".$value['cover_image'] ;?>" class="img-fitted" alt="{{$value['name']}}">
        </div>
      </div>
            <?php } ?>
      </div>

    </div>
  </div>
</section>

@endsection