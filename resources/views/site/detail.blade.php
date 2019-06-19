@extends('site/layouts.app')
@section('sitecontent')
<script src="//platform-api.sharethis.com/js/sharethis.js#property=5b0d7d8211cf9d00119f646a&product=inline-share-buttons"></script>
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

 <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
        if(d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=2089176568074768&autoLogAppEvents=1';
          fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));</script>
<!-- 
     Display detail news 
     -->

            <?php foreach ($detail_cat as $row) {
              ?>
            <title><?php echo $row['title']; ?></title>

              
            <?php
          }
        ?>

  <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
        if(d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0&appId=2089176568074768&autoLogAppEvents=1';
          fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));</script>



<!-- popular -->
<section class="pad-top pad-bot news-details-page inner-page">
  <div class="container">
    <div class="row news-details">
    <!-- main details -->
      <div class="col-sm-9 news-details-wrap">
        <?php
        foreach ($detail_cat as $row) {
          ?>

        <a href="<?php echo '/category/'.$row['category_permalink'] ;?>" class="news-cat-main" style="color:<?php echo $row['color'] ?>; text-decoration: none;"><?php echo $row['category']; ?></a>
        <h1><?php echo $row['title']; ?></h1>

        <div class="other-info">
          <span class="author-name">By Marie Russell</span>
        <span class="news-time"><i class="far fa-clock"></i>{{$row['created_at']}}</span>

        </div>
        <!-- share plugin -->
        <div>
          <div class="sharethis-inline-share-buttons" data-url="<?php echo url('').'/details/'.$row['permalink'];?>" data-title="<?php echo $row['title']; ?>" data-image="<?php echo '/news_uploads/'.$row['news_image']; ?>"  data-description="<?php echo $row['description']['0']; ?>">
          </div>
        </div>

    
  
        <!-- image -->
        <div class="img-container">
          <img src="<?php echo url('').'/uploads/news_uploads/'.$row['image']; ?>" alt="{{$row['title']}}">
        </div>
        
        <!-- news -->
        <div class="detail-texts">
          <p class="main-text"><span class="bigger-letter"><?php echo ($row['description']['0']); ?></span>
            <text><?php echo substr($row['description'],1); ?></text>
          </p>
        </div>
      </div>          
      <?php
        }
      ?>

             <!-- side bar -->

      <div class="col-sm-3 main-sidebar">
               <?php
       foreach ($other_details as $value) {
          ?>
        <!-- news -->
        <div class="common-news text-center">
          <div class="img-container">
              
           <a href="<?php echo url('').'/detail/'.$value['permalink'] ;?>" data-custom-value="<?php echo $value['permalink']  ?>" id="click_link" class="image-overlay click_link"></a>
            <img src="<?php echo url('').'/uploads/news_uploads/'.$value['image']; ?>" class="img-fitted" alt="swadesh">
          </div>
          <div class="common-caption">
            <h4 class="heading-vsm"><?php echo $value['title']; ?></h4>
            <p><?php echo substr(strip_tags($value['description']), 0, 30).'...'; ?></p>
            <span class="news-time"><i class="far fa-clock"></i><?php echo $value['created_at'] ?></span>
          </div>
      <?php
      }
      ?>
    </div>
</section>
<section>
  <div class="container">
  <div class="fb-comments" data-href="<?php echo url('').'/detail/'.$row['permalink'];?>" data-numposts="5"></div>
</div>
</section>
@endsection