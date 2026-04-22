{{-- @foreach ($image as $img)
    <p>{{$img->product_id}}</p>
    <p><img src="{{ asset('storage/'.$img->image_path) }}" width="100" height="100"></p>

@endforeach --}}
@extends('admin_penal.master')
@section('content')
 
   
        
  <!-- /.card --> 
        
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title"> Product Images</h3>
                    <div class=" d-flex justify-content-end align-items-center">
                    <a href="{{route('imageCreate')}}" class="btn btn-info">New</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                      
                  <div class="card-body p-0 table-responsive " >
                    <table class="table table-sm table-border">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Product</th>
                          <th>Image</th>
                          <th>sort_order</th>
                          <th>Edit</th>
                          <th>Delete</th>

                        </tr>
                      </thead>
                  @foreach ($image as $img )
                      <tbody> 
                        <tr class="align-middle">
                          <td>{{$img['id']}}</td>
                          <td>{{$img->product_id}}</td>
                          <td><img src="{{ asset('storage/'.$img->image_path) }}" width="100" height="100"></td>
                          <td>{{$img->sort_order}}</td>
                          <td><a href="{{route('imageEdit',['edit_id'=>$img->id])}}" class="btn btn-outline-primary">Edit</a></td>
                          <td><a href="{{route('imageDelete',['delete_id'=>$img->id])}}" class="btn btn-outline-danger">Delete</a></td>
                        </tr>
                      </tbody>
                  @endforeach

                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>

@endsection
















                