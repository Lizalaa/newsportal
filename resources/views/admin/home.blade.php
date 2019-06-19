@extends('layouts.page')

@section('content')
<div class="content-wrapper"> 
        <!-- Content Header (Page header) --> 
<br>
<br>
    <section class="content-header">
        <div>
            <div class="callout callout-info text-center">
              <h1> Dashboard </h1>
              <p><small>Control panel</small> </p>
              <h4>Welcome</h4>
              <p>
              	Admin 
              </p>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row news_info">

                <div class="col-lg-4 col-sm-6">
                    <div class="circle-tile ">
                        <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-laptop" style="font-size:50px"></i></div></a>
                        <div class="circle-tile-content blue">
                            <div class="circle-tile-description text-faded">News</div>
                            <div class="circle-tile-number text-faded ">{{$news}}<i class="fa fa-laptop" style="font-size:50px"></i></div>
                            <a class="circle-tile-footer" href="<?php echo url(''); ?>admin/news">View details..</a>
                        </div>
                    </div>
                </div> 

                <div class="col-lg-4 col-sm-6">
                    <div class="circle-tile ">
                        <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-pie-chart" style="font-size:50px"></i></div></a>
                        <div class="circle-tile-content blue">
                            <div class="circle-tile-description text-faded">Category</div>
                            <div class="circle-tile-number text-faded ">{{$category}}<i class="fa fa-pie-chart" style="font-size:50px"></i></div>
                            <a class="circle-tile-footer" href="<?php echo url('');?>admin/category">View details..</a>
                        </div>
                    </div>
                </div> 

                <div class="col-lg-4 col-sm-6">
                    <div class="circle-tile ">
                        <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-buysellads" style="font-size:40px"></i></div></a>
                        <div class="circle-tile-content blue">
                            <div class="circle-tile-description text-faded">Ads</div>
                            <div class="circle-tile-number text-faded ">{{$ads}}<i class="fa fa-buysellads" style="font-size:50px"></i></div>
                            <a class="circle-tile-footer" href="<?php echo  url(''); ?>admin/ad">View details..</a>
                        </div>
                    </div>
                </div> 
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="circle-tile">
                    <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-user" style="font-size:50px"></i></div></a>
                    <div class="circle-tile-content blue">
                        <div class="circle-tile-description text-faded">Users</div>
                        <div class="circle-tile-number text-faded ">{{$user}}<i class="fa fa-user" style="font-size:50px"></i></div>
                        <a class="circle-tile-footer" href="<?php echo url(''); ?>admin">View details..</a>
                    </div>
                </div>
            </div> 
        </div>
    </section>
</div>
@endsection
