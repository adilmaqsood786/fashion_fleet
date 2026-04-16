@extends('admin_penal.master')
@section('content')
 
   
        
  <!-- /.card --> 
        
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Vendor Record</h3>
                    <div class=" d-flex justify-content-end align-items-center">
                    <a href="{{route('vendorCreate')}}" class="btn btn-outline-warning">New</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                      
                  <div class="card-body p-0 table-responsive " >
                    <table class="table table-sm table-border">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Store Name</th>
                          <th>Store Slug</th>
                          <th>logo</th>
                          <th>Description</th>
                          <th>Address</th>
                          <th>City</th>
                          <th>Country</th>
                          <th>Commission rate</th>
                          <th>Approved</th>
                          <th>Status</th>
                          <th>Edit</th>
                          <th>Delete</th>

                        </tr>
                      </thead>
                  @foreach ($vendors as $vendor )
                      <tbody>
                        <tr class="align-middle">
                          <td>{{$vendor['id']}}</td>
                          <td>{{$vendor['store_name']}}</td>
                          <td>{{$vendor['store_slug']}}</td>
                          <td><img src="{{ asset('storage/'.$vendor->logo) }}" width="100" height="100"></td>
                          <td>{{$vendor['description']}}</td>
                          <td>{{$vendor['address']}}</td>
                          <td>{{$vendor['city']}}</td>
                          <td>{{$vendor['country']}}</td>
                          <td>{{$vendor['commission_rate']}}</td>
                          <td>{{$vendor['is_approved']?"yes":"no"}}</td>
                          <td>{{$vendor['is_active']?"yes":"no"}}</td>
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
















                