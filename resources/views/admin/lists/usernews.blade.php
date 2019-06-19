@extends('layouts.page')


@section('content')

    <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    
    	<section class="content actionbuttonbox">
         	<div class="row">
        		<div class="col-xs-12">
        			@if (\Session::has('success'))
      					<div class="alert alert-success">
        					<p>{{ \Session::get('success') }}</p>
      					</div><br>
     				@endif
        
              		<div class="box text-right actionbutton clearfix padding">
              			<div class="col-sm-4">
							  <form>
							  </form>
						</div>
						<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
						<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
						<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
            			<div class="col-sm-8"><a class="btn btn-success" href="{{url('admin/news/create')}}"> <i class="fa fa-plus"></i> Add new </a></div>
               		</div>
            	</div>
      		</div>
        </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
        	<div class="col-xs-12">
              	<div class="box">
            		<div class="box-header">
                  		<h3 class="box-title"><b>All News</b></h3>
                	</div>
            <!-- /.box-header -->
            		<div class="box-body table-responsive no-padding">
                  		<table class="table table-hover" id="table">
                			<thead>
                     			<tr>
                    				<th>ID</th>
                    				<th>News Title</th>
                                    <th>Category</th>
                    				<th>Date</th>
                    				<th>Description</th>
                                    <th>Image</th>
                    				<th>Video Link</th>                                                                        
                    				<th>Publish</th>                                                                            
								 </tr>
                			</thead>
                  			<tbody>
								  <?php
								  $i = 1;
								  foreach($news as $row)
                    			{

                    			?>
                    				<tr>
                    					<td><?php echo $i; ?></td>
                    					<td><div class="label label-primary" style="margin-top:1px"><?php echo $row->title; ?></div></td>
									<td>{{$row->category}}</td>
                   
                    					<td>
											<?php $php_timestamp =strtotime($row->date); 
                  			  				$php_timestamp_date = date("d F Y", $php_timestamp);
								 			echo "".$php_timestamp_date.""; ?>
										</td>

                    					<td><?php echo substr(strip_tags($row->description), 0, 60).'...'; ?></td>
									<td><img src="{{url('')}}/uploads/usernews_uploads/<?php echo $row->image?>" width='150px' class="img-rounded" height='150px' alt='User Image' ></td>
                                    <td><a href="{{$row->video_link}}" target="_blank">{{$row->video_link}}</a></td>
                                        <?php $published=$row->status; 
                    					if($published == '1')
                    					{
                      					?>
                    						<td><a href="<?php echo url('admin/news/unpublish_user_news',$row->id ) ?>" class="text-success publish"><i class="fa fa-circle publish"></i> Published</a></td>
                    						<?php
                  						}
                 						else
                  						{
                    					?>
                    						<td><a href="<?php echo url('admin/news/publish_user_news',$row->id ) ?>" class="text-danger publish"><i class="fa fa-circle-o publish"></i> Unpublished</a></td>
                    					<?php
                 						}
                  						?> 
										
									</tr>
								<?php
                    			$i++;
                    			}
								?>
							</tbody>
               			</table>
             		</div>
           		</div>
           </div>
        </div>
    </section>
    <!-- /.content --> 
<script type="text/javascript">
$(document).ready(function() {
    $('#table').DataTable();
} );
 </script>
@endsection
