@extends('user/layouts.userlayouts')

@section('usercontent')

 <!-- user-contents -->	
  	
  	
  	<div class="userdash-content col-lg-9 col-md-9">
  	<div class="dash-inner">
  	<div class="dash-main">
  	<!-- profile -->
  		<div class="user-profile row">
  		<!-- profile image -->
  		<div class="user-image col-lg-4">
  		<div class="img-container">
  			<img src="images/user.png" alt="username" class="img-fitted">
  			</div>	
  		</div>	
  		<!-- profile details -->
 		<div class="user-details col-lg-8">
 			<ul class="user-details-list">
 				<li><span>Name:</span>{{$userdetail->name}}</li>
 				<li><span>Email:</span>{{$userdetail->email}}</li>
 			</ul> 
 			
 			<!-- links -->
  				<div class="posts-thumb">
				  <h4>You have submitted <span class="color-blue">{{$news}}</span> posts...</h4>	
  				<a href="{{url('user/news/create')}}" class="btn-common">NEW POST</a>	
  				<a href="{{url('user/news')}}" class="btn-stylish">RECENT POSTS</a>	
  				</div>							
 		</div>		
 				
  			
  				
  		</div>
  		
  			</div>	
  		</div>	
  	</div>
  	
  	
  </div>
  </div>
</section>
@endsection
@section('userfooter')
@endsection

