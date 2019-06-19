@extends('site/layouts.app')
@section('sitecontent')

<!-- albums -->
<section class="gallery-albums pad-bot inner-page pad-top">
  <div class="container">
    <h3 class="heading-mid text-center">

        </h3>
    <div class="row gallery-home">
            <?php 
            if(empty($all_image))
            {
              //echo "<script>alert('Sorry, empty gallery');</script>";
              //redirect(gallery_page);
              echo "empty";
            }
            else
            {
              foreach ($all_image as $value) {
            ?>
              <div class="col-lg-3 col-md-6 gallery-in album">
              <div class="img-container">
              <?php if(empty($value->image))
              {
        	       break;
              }
              else
       	      {
       		   ?>
                <a href="<?php echo url(''); ?>/uploads/gallery_uploads/<?php echo $value->id; ?>/<?php echo $value->image; ?>" class="image-overlay cboxElement group2" title="<?php echo $value->image; ?>"></a>
                <img src="<?php echo url(''); ?>/uploads/gallery_uploads/<?php echo $value->id; ?>/<?php echo $value->image; ?>" class="img-fitted" alt="gallery">
              <?php } ?>
          </div>
        </div>
      <?php } } ?>
    </div>
  </div>
</section>
<!-- add -->



@endsection