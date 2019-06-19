<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>User {{$title}}</title>
<link rel="icon" href="{{ asset('user/images/fav.fw.png') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<!-- Bootstrap Core CSS -->
<link href="{{ asset('user/css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('user/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('user/owl/owl.carousel.css') }}" rel="stylesheet">
<link href="{{ asset('user/owl/owl.theme.css') }}" rel="stylesheet">
<link href="{{ asset('user/owl/owl.transitions.css') }}" rel="stylesheet">
<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('user/css/colorbox.css') }}">
<link rel="stylesheet" href="{{ asset('user/css/hover-min.css') }}">
<link rel="stylesheet" href="{{ asset('user/css/dialog.css') }}">
<link rel="stylesheet" href="{{ asset('user/css/dialog-wilma.css') }}">
<link href="{{ asset('user/css/main.css') }}" rel="stylesheet">
<script src="{{ asset('user/js/jquery3.3.1.min.js') }}"></script>
<script src="{{ asset('user/js/popper.min.js') }}"></script>
<script src="{{ asset('user/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('user/js/modernizr.custom.js') }}"></script>
<script>var url = "{{url('')}}"; </script>

</head>

<body>
<div id="mySidenav" class="sidenav" style="z-index:99999">
  <div class="nav-side">
    <img src="{{ asset('user/images/logo.fw.png')}}" class="side-logo" alt="swadesh sandesh">
    <div class="mobile-search">
    </div>
    <div class="side-cat-wrap">
      <h3 class="cats-title">CATEGORIES</h3>
      <ul class="nav navbar-nav">
        <?php 
        foreach ($sidebar_data as $value) 
        {
         ?><li class="active">
          <a href="{{url('')}}/category/{{$value->permalink}}"><?php echo $value->category; ?></a>
         </li>
        <?php
        }
        ?>
      </ul>
    </div>
  </div>
  <div class="nav-ad img-container">
    <a href="index.html"><img src="images/ad4.jpg" alt="ad"></a>
  </div>
  <div class="close-btn-wrap">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  </div>
  <script>
function openNav() {
    document.getElementById("mySidenav").style.left = "0";
}

function closeNav() {
    document.getElementById("mySidenav").style.left = "-380px";
}
</script>
</div>

<!-- Header -->
<header>
  <!-- header top -->
  <div class="header-top">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 top-left">
          <div class="content-search">
            <form>
              <button type="submit"><i class="fas fa-search"></i></button>
              <input type="search" placeholder="Search content..." value="">
            </form>
          </div>
        </div>
        <div class="col-lg-4 top-mid left-align right-align text-center">
          <div class="logo-wrap img-container">
            <a href="{{url('')}}"><img src="<?php echo url('').'/uploads/setting_uploads/'.$settings->logo ?>" alt="swadsh sandesh"></a>
          </div>
        </div>
        <div class="col-lg-4 top-right">
          <a href="#" class="normal-link" style="border-right:2px solid #EEEEEE; padding-right:15px;"><i class="fas fa-edit"></i> Post</a>
          <a href="#" class="normal-link"><i class="fas fa-bullhorn"></i> Advertise</a>
          <a href="#" class="login-btn trigger" id="login_btn" data-dialog="login">Login</a>
          <div id="login" class="dialog">
            <div class="dialog__overlay"></div>
            <div class="dialog__content">
              <div class="morph-shape">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 560 280" preserveAspectRatio="none">
                  <rect x="3" y="3" fill="none" width="556" height="276"/>
                </svg>
              </div>
              <div class="dialog-inner">
                <h2><strong>Login</strong></h2>
                <div class="container" style="margin-left: 100px; margin-top: -50px; margin-bottom: 10px">
                  <form class="common-form" action="" name="logForm" id="logForm" method="POST">
                  <meta name="csrf-token" content="{{ csrf_token() }}">
                    
                    <div class="form-groups row"> 
                      <div class="col-lg-6 col-md-6 form-group">
                        <label>Email:</label>
                        <input type="text" name="email" id="login_email" >
                      </div>
                    </div>

                    <div class="form-groups row"> 
                      <div class="col-lg-6 col-md-6 form-group">
                        <label>Password:</label>
                        <input type="password" name="password" id="login_password">
                      </div>
                    </div>
                  </form>
                </div>
                <a href="forgot-password">Reset Password</a>
                <div style="margin-right: 10px">
                  <div id="loading">
                  </div>
                  <button type="submit" name="login" class="action loginbutton" id="loginbutton">Login</button>
                  <button class="action" data-dialog-close>Close</button>
                </div>
              </div>
            </div>
          </div>
          <a href="#" class="menu-bar" onClick="openNav()"><i class="fas fa-bars"></i></a> </div>
      </div>
    </div>
  </div>
</header>

<!-- user dashboard -->
<section class="user-dash pad-bot inner-page pad-top">
  <div class="container">
  <div class="row">
  <!-- sidebar -->
  	<div class="userdash-sidebar col-lg-3 col-md-3">
  	<div class="user-title bg-blue">
  	<span>Welcome!</span>
  	<h3>{{$userdetail->name}}</h3>
  	</div>
  <ul class="user-nav">
  <li class="active"><a href="{{url('user/dashboard')}}"><i class="fas fa-user"></i>Home<span class="fas fa-angle-right"></span></a></li>
          <li><a href="{{url('user/news')}}"><i class="fas fa-edit"></i>Posts<span class="fas fa-angle-right"></span></a></li>
          <li><a href="{{url('user/profile')}}"><i class="fas fa-cog"></i>Edit Profile<span class="fas fa-angle-right"></span></a></li>
          <li><a href="{{url('user/logout')}}"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
        </ul>	
      </div>
      @yield('usercontent')

      <!-- footer -->
<footer class="pad-bot">
  <div class="container text-center">
    <p class="copyright-text">Copyright @SwodeshSandesh 2018. All Rights Reserved. Powered By:
      <a href="https://www.rewasoft.com.np/" target="_blank">REWASOFT</a>
    </p>
  </div>
</footer>

<!-- owl sliders -->
<script src="owl/owl.carousel.js"></script>

<!-- Only for home page and gallery page -->
<script>
			$(document).ready(function(){
				//Examples of how to assign the Colorbox event to elements
				$(".group1").colorbox({rel:'group1'});
				$(".group2").colorbox({rel:'group2', transition:"fade", width:"75%"});
				$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
				$(".group4").colorbox({rel:'group4', slideshow:true});
				$(".ajax").colorbox();
				$(".youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
				$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				$(".inline").colorbox({inline:true, width:"50%"});
				$(".callbacks").colorbox({
					onOpen:function(){ alert('onOpen: colorbox is about to open'); },
					onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
					onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
					onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
					onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
				});

				$('.non-retina').colorbox({rel:'group5', transition:'none'})
				$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
				
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>
<script src="{{ asset('user/js/jquery.colorbox.js') }}"></script>
<script src="{{ asset('user/js/plugins.min.js') }}"></script>
<script src="{{ asset('user/js/classie.js') }}"></script>
<script src="{{ asset('user/js/dialogFx.js') }}"></script>
<script src="{{ asset('js/sub_category.js') }}"></script>
<script src="{{ asset('user/js/login_ajax.js') }}"></script>



<script>
(function() {
 var dlgtrigger = document.querySelector( '[data-dialog]' ),
	 somedialog = document.getElementById( dlgtrigger.getAttribute( 'data-dialog' ) ),
	  dlg = new DialogFx( somedialog );

				dlgtrigger.addEventListener( 'click', dlg.toggle.bind(dlg) );

			})();
		</script>
</body>
</html>
@yield('userfooter')