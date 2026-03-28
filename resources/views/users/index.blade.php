@extends('admin_penal.master')
@section('content')
 
        
  <!-- /.card --> 
        
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Uses Record</h3>
                  </div>
                  <!-- /.card-header -->
                      
                  <div class="card-body p-0">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Father Name</th>
                          <th>Email</th>
                          <th>Phone Number</th>
                          <th>Address</th>
                          <th>Edit</th>
                          <th>Delete</th>

                        </tr>
                      </thead>
                  @foreach ($users as $user )
                      <tbody>
                        <tr class="align-middle">
                          <td>{{$user['id']}}</td>
                          <td>{{$user['first_name']}}</td>
                          <td>{{$user['last_name']}}</td>
                          <td>{{$user['father_name']}}</td>
                          <td>{{$user['email']}}</td>
                          <td>{{$user['phone']}}</td>
                          <td>{{$user['address']}}</td>
                          <td><a href="{{route('userEdit',['edit_id'=>$user['id']])}}" class="btn btn-outline-primary">Edit</a></td>
                          <td><a href="{{route('userDelete',['delete_id'=>$user['id']])}}" class="btn btn-outline-danger">Delete</a></td>
                        </tr>
                      </tbody>
                  @endforeach

                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>

@endsection
















                