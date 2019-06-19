<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$title}}</title>
        <link rel="icon" href="<?php echo url('').'/uploads/user_uploads/'.$user_detail['profile_picture']; ?> " class="img-rounded">

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navi.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.css') }}" media="screen" />


    <!-- Bootstrap Styles-->


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- FontAwesome Styles-->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/dist/css/AdminLTE.min.css') }}" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('css/dist/css/skins/_all-skins.min.css') }}" />

    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" />
     <!-- jQuery 2.1.4 -->
     
    <script src="{{ asset('js/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
 <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
 -->

  <script type="text/javascript" src="{{ asset('js/plugins/imagetools/plugin.min.js') }}"></script> 
 <!--  <script type="text/javascript" src="{{ asset('tinymce/js/tinymce/jquery.tinymce.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}"></script>

  <script src="{{ asset('js/main_js/news_tinymce.js') }}"></script>
 -->

  </head>

    <body class="hold-transition skin-blue sidebar-mini">


    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>R</b>A</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>REWA_</b>ADMIN</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                

                <?php
                  if(empty($user_detail['profile_picture']))
                  {
                  }
                  else
                  {
                ?>
                <img src="{{url('')}}/uploads/user_uploads/{{$user_detail['profile_picture']}}" width=20px height=20px class='img-circle' alt='User Image';>
                    <?php 
                  }?>
                <span class="hidden-xs"></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                   <?php
                  if(empty($user_detail['profile_picture']))
                  {
                  }
                  else
                  {
                ?>
                <img src="{{url('')}}/uploads/user_uploads/{{$user_detail['profile_picture']}}" width=20px height=20px class='img-circle' alt='User Image';> 
                    <?php 
                  }?>
                  <p>{{$user_detail['name']}}</p>
                  </li>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                    <a href="{{url('admin/profile')}}" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{url('admin/logout')}}" class="btn btn-default btn-flat">Logout</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="{{ url('admin/settings')}}"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
<!-- Left side column. contains the logo and sidebar -->

<aside class="main-sidebar"> 
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar"> 
    <!-- Sidebar user panel -->
    <div class="user-panel">
   
      <div class="pull-left image"><?php
                  if(empty($user_detail['profile_picture']))
                  {
                  }
                  else
                  {
                ?>
                <img src="{{url('')}}/uploads/user_uploads/{{$user_detail['profile_picture']}}" width=20px height=20px class='img-circle' alt='User Image';>; 
              <?php
              }
              ?>
                   </div>
      <div class="info">
        <p></p>

      <small> <i class="fa fa-circle text-success"></i> Hi </small> {{$user_detail['name']}}</div>
      <div class="clearfix"></div>
    </div>
    <!-- search form --> 
    
    <!-- /.search form --> 
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      	<li class="header">MAIN NAVIGATION</li>
    <li><a href="{{url('admin/home')}}"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a> </li>
      	<li><a href="{{url('')}}"> <i class="fa fa-laptop"></i> <span>Visit Website</span> </a> </li>
      	<li class="treeview"> <a href="#"> <i class="fa fa-pie-chart"></i> <span>Task Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
          <li> <a href="{{ url('admin/news')}}"><i class="fa fa-user"></i> <span>Manage Admin News </span></a> </li>
          <li> <a href="{{ url('admin/usernews')}}"><i class="fa fa-user"></i> <span>Manage User News </span></a> </li>          
          <li> <a href="{{ url('admin/category')}}"><i class="fa fa-user"></i> <span>Manage Category </span></a> </li>
        	<li> <a href="{{ url('admin/gallery')}}"><i class="fa fa-photo"></i> <span>Gallery </span></a> </li>
          	<li> <a href="{{ url('admin/ad')}}"><i class="fa fa-photo"></i> <span>Advertisement </span></a> </li>
        </ul>
      </li>
      <li class="treeview"> <a href="#"> <i class="fa fa-user"></i> <span>User Management</span> <i class="fa fa-angle-left pull-right"></i> </a>
        <ul class="treeview-menu">
        <li> <a href="{{url('admin')}}"><i class="fa fa-book"></i><span> Admin </span></a> </li>
    </ul>
      </li>

            <li> <a href="{{ url('admin/settings')}}"><i class="fa fa-edit"></i> <span>Setting</span> </a> </li>
    </ul>
  </section>
  <!-- /.sidebar --> 
</aside>
<div>
<main>
        @yield('content')

</main>
</div>
<div class="clearfix"></div>
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<footer class="main-footer">
  <div class="pull-right"> <strong>Copyright &copy; 2015 <a href="http://rewasoft.net/">Rewasoft</a>.</strong> All rights reserved. </div>
  <div class="clearfix"></div>
</footer>


   
<script src="{{ asset('js/bootstrap.min.js') }}"></script> 
<!-- Bootstrap WYSIHTML5 --> 

<!-- FastClick --> 
<script src="{{ asset('js/plugins/fastclick/fastclick.min.js') }}"></script> 
<!-- AdminLTE App --> 

<script src="{{ asset('js/dist/js/app.min.js') }}"></script> 
<script src="{{ asset('js/sub_category.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) --> 
<script src="{{ asset('js/dist/js/pages/dashboard.js') }}"></script> 
<script src="{{ asset('js/custom-scripts.js') }}"></script> 
<!-- <script>
    $(function() {
    $( "#dialog").dialog();
  
  

  });
    </script> 
 -->
</body>
</html>
    

