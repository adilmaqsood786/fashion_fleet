@extends('admin_penal.master')
@section('content')
 
        
  <!-- /.card --> 
        
                <div class="card mb-4">
                  <div class="card-header">
                    
                    <div class="card-title"><h3>User Profile</h3></div>
                    <div class="d-flex justify-content-end align-items-center">
                    <a href="{{route('profileCreate')}}" class="btn btn-outline-warning">New</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                      
                  <div class="card-body p-0 table-responsive">
                    <table class="table table-sm">
                      <thead class="table-dark">
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>User_id</th>
                          <th>Label</th>
                          <th>Full Name</th>
                          <th>Phone no.</th>
                          <th>Address line 1</th>
                          <th>Address line 2</th>
                          <th>City</th>
                          <th>State</th>
                          <th>Postal code</th>
                          <th>Country</th>
                          <th>latitude</th>
                          <th>longitude</th>
                          <th>Edit</th>
                          <th>Delete</th>

                        </tr>
                      </thead>
                  @foreach ($users as $user )
                      <tbody>
                        <tr class="align-middle">
                          <td>{{$user['id']}}</td>
                          <td>{{$user['user_id']}}</td>
                          <td>{{$user['label']}}</td>
                          <td>{{$user['full_name']}}</td>
                          <td>{{$user['phone']}}</td>
                          <td>{{$user['address_line_1']}}</td>
                          <td>{{$user['address_line_2']}}</td>
                          <td>{{$user['city']}}</td>
                          <td>{{$user['state']}}</td>
                          <td>{{$user['postal_code']}}</td>
                          <td>{{$user['country']}}</td>
                          <td>{{$user['latitude']}}</td>
                          <td>{{$user['longitude']}}</td>

                          <td><a href="{{route('profileEdit',['edit_id'=>$user['id']])}}" class="btn btn-outline-primary">Edit</a></td>
                          <td><a href="{{route('profileDelete',['delete_id'=>$user['id']])}}" class="btn btn-outline-danger">Delete</a></td>
                        </tr>
                      </tbody>
                  @endforeach

                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>

@endsection
















                