@extends('site/layouts.app')
@section('sitecontent')
<!-- albums -->
<section class="gallery-albums pad-bot inner-page pad-top">
  <div class="container">
    <h3 class="heading-mid text-center">GALLERY</h3>
    <div class="row gallery-home">
    	 <!-- 
     	Display all albums 
		-->
       <?php 
          foreach ($gallery_data as $value) 
          {
          ?>
      <div class="col-lg-3 col-md-6 gallery-in album">
        <div class="img-container">
          <a href="<?php echo url('').'/gallery_image/'.$value->id ;?>" class="image-overlay"><i class="far fa-images"></i> <br><?php echo $value->name ?></a>
          <img src="<?php echo url('').'/uploads/gallery_uploads/'.$value->cover_image; ?>" class="img-fitted" alt="<?php  echo $value->name;?>">
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
</section>

@endsection
