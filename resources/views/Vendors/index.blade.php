@extends('admin_penal.master')
@section('content')
 
   
        
  <!-- /.card --> 
        
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Vendor Record</h3>
                  </div>
                  <!-- /.card-header -->
                      
                  <div class="card-body p-0">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Name</th>
                          <th>Slug</th>
                          <th>Description</th>
                          <th>logo</th>
                          <th>Status</th>
                          <th>Edit</th>
                          <th>Delete</th>

                        </tr>
                      </thead>
                  @foreach ($vendors as $vendor )
                      <tbody>
                        <tr class="align-middle">
                          <td>{{$vendor['id']}}</td>
                          <td>{{$vendor['name']}}</td>
                          <td>{{$vendor['slug']}}</td>
                          <td>{{$vendor['description']}}</td>
                          {{-- <td>{{$vendor['logo']}}</td> --}}
                          <td><img src="{{ asset('storage/'.$vendor->logo) }}" width="100" height="100"></td>
                          <td>{{$vendor['status']}}</td>
                          <td><a href="{{route('vendorEdit',['edit_id'=>$vendor['id']])}}" class="btn btn-outline-primary">Edit</a></td>
                          <td><a href="{{route('vendorDelete',['delete_id'=>$vendor['id']])}}" class="btn btn-outline-danger">Delete</a></td>
                        </tr>
                      </tbody>
                  @endforeach

                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>

@endsection
















                