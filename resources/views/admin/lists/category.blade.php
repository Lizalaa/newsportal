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
            <div class="col-sm-8"><a class="btn btn-success" href="{{url('admin/category/create')}}"> <i class="fa fa-plus"></i> Add new </a></div>
              
              
               
               
               
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
                  <h3 class="box-title"><b>All Category</b></h3>
                </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                <tbody>
                      <tr>
                    <th>ID</th>
                    <th>Parent Category</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Color</th> 
                    <th>Permalink</th>     
                    <th>Order</th>                                                                                                                                                                                                                                                                         
                    <th>Action</th>
                  </tr>
                  <?php
                  $i=1;

                    foreach($category as $row)
                    {
                    ?>
                    <tr>
                    <td><?php echo $i; ?></td>
                    <?php 
                    if ($row->parentcategory == '0') {
                      echo '<td><div class="label label-danger" style="margin-top:1px">Parent Category</div></td>';
                    }
                    else {
                      echo '<td><div class="label label-danger" style="margin-top:1px">Sub Category</div></td>';                      # code...
                    }
                    ?>
                    <td><div class="label label-primary" style="margin-top:1px"><?php echo $row->category; ?></div></td>
                   
                    <td><?php $php_timestamp =strtotime($row->date); 
                  $php_timestamp_date = date("d F Y", $php_timestamp);
                   echo "".$php_timestamp_date.""; ?></td>

                    <td><?php echo substr(strip_tags($row->description), 0, 60).'...'; ?></td>
                    <td><img src="{{url('')}}/uploads/category_uploads/<?php echo $row->image?>" width='150px' class="img-rounded" height='150px' alt='User Image' ></td>
                    
                    <?php $published=$row->status; 
                    					if($published == '1')
                    					{
                      					?>
                    						<td><a href="<?php echo url('admin/category/unpublish_category',$row->id ) ?>" class="text-success publish"><i class="fa fa-circle publish"></i> Published</a></td>
                    						<?php
                  						}
                 						else
                  						{
                    					?>
                    						<td><a href="<?php echo url('admin/category/publish_category',$row->id ) ?>" class="text-danger publish"><i class="fa fa-circle-o publish"></i> Unpublished</a></td>
                    					<?php
                 						}
                  						?> 
                    <td>{{$row->color}}</td>
                    <td>{{$row->permalink}}</td>
                    <td>{{$row->order}}</td>
                    
                    

                    <td><a href="{{url('admin/category/edit', $row->id)}}" class="text-info"><i class="fa fa-pencil"></i> Edit</a> 
                      {{-- <form action="{{url('admin/category', $row->id)}}" method="post">
                            @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form><a href="#" class="text-danger"><i class="fa fa-trash"></i> Trash</a></td> --}}
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
