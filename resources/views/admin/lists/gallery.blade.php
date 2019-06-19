@extends('layouts.page')
@section('content')
      <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    
    <section class="content actionbuttonbox">
          <div class="row">
        <div class="col-xs-12">
        
        
        
              <div class="box text-right actionbutton clearfix padding">
              
              <div class="col-sm-4"><form>
              <input type="search" placeholder="search" class="form-control">
              </form></div>
                            <div class="col-sm-8"><a class="btn btn-success" href="{{url('admin/gallery/create')}}"> <i class="fa fa-plus"></i> Add new </a></div>
              
              
               
               
               
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
                  <h3 class="box-title"><b>All Galleries</b></h3>
                </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <?php foreach ($gallery as $row){ ?>

    <div class="col-sm-3">
        <div class="img-container">
            <img src="<?php echo url('').'/uploads/gallery_uploads/'.$row->cover_image; ?> " alt="Image Gallery" class="img-rounded" width="200px" height="170px">
          </a>
        </div>
        <div>
        <p class="actionDiv">
          <a href="{{url('admin/gallery/edit',$row->id)}} " class="edit btn-link" title="Edit"><i class="fa fa-pencil"></i> EDIT</a>  | 
<form action="{{url('admin/gallery/delete_folder', $row->id)}}" method="post">
                            @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>          </p>
          </div>
        <div class="main-details">
          <h3 class="common-heading color-blue">
            <a href="{{url('gallery/edit'.$row->id)}}">
            </a>
          </h3></p>
      </div>
    </div>

<?php } ?>
             </div>
           </div>
           </div>
         </div>
        </section>
    <!-- /.content --> 
  </div>






  </div>
</section>
@endsection