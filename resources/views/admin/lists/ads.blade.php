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
      </div><br />
     @endif
        
              <div class="box text-right actionbutton clearfix padding">
              
              <div class="col-sm-4"><form>
              </form></div>
            <div class="col-sm-8"><a class="btn btn-success" href="{{url('admin/ad/create')}}"> <i class="fa fa-plus"></i> Add new </a></div>
              
              
               
               
               
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
                  <h3 class="box-title"><b>All Ad</b></h3>
                </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                <tbody>
                      <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Status</th>                                                                                                                                                                                                                                                                       
                    <th>Action</th>
                  </tr>
                  <?php
                  $i=1;

                    foreach($ad as $row)
                    {
                    ?>
                    <tr>
                        <td>{{$i}}</td>
                    <td>{{$row->title}}</td>
                    <td><img src="{{url('')}}/uploads/ad_uploads/<?php echo $row->image?>" width='150px' class="img-rounded" height='150px' alt='User Image' ></td>
                    <?php $published=$row->status; 
                    					if($published == '1')
                    					{
                      					?>
                    						<td><a href="<?php echo url('admin/ad/unpublish_ad',$row->id ) ?>" class="text-success publish"><i class="fa fa-circle publish"></i> Published</a></td>
                    						<?php
                  						}
                 						else
                  						{
                    					?>
                    						<td><a href="<?php echo url('admin/ad/publish_ad',$row->id ) ?>" class="text-danger publish"><i class="fa fa-circle-o publish"></i> Unpublished</a></td>
                    					<?php
                 						}
                  						?> 

                    
                    
                    

                    <td><a href="{{url('admin/ad/edit', $row->id)}}" class="text-info"><i class="fa fa-pencil"></i> Edit</a> | <form action="{{url('admin/ad', $row->id)}}" method="post">
                            @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form><a href="#" class="text-danger"><i class="fa fa-trash"></i> Trash</a></td>
                    <?php
                    $i++;

                    }
                    
                    ?>

                  </tr>
                 </tbody>
               </table>
             </div>
           </div>
           </div>
         </div>
        </section>
    <!-- /.content --> 

@endsection
