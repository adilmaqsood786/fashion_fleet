@extends('admin_penal.master')
@section('content')
 
        
  <!-- /.card --> 
        
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">users Record</h3>
                    <div class=" d-flex justify-content-end align-items-center">
                    <a href="" class="btn btn-outline-warning">New</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                 


   
                  <div class="card-body p-0 table-responsive">
                    <table class="table table-sm ">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>
                          <th>Password </th>
                          <th>role</th>
                          <th>status</th>
                          <th>email_verified_at</th>
                          <th>Edit</th>
                          <th>Delete</th>

                        </tr>
                      </thead>

                  @foreach ($users as $user )
                      <tbody>
                        <tr class="align-middle">
                          <td>{{$user['id']}}</td>
                          <td>{{$user['name']}}</td>
                          <td>{{$user['email']}}</td>
                          <td>{{$user['phone']}}</td>
                          <td>{{$user['password']}}</td>
                          <td>{{$user['role']}}</td>
                          <td>{{$user['status']}}</td>
                          <td>{{$user['email_verified_at']}}</td>
                             <td><a href="{{ route('user.edit',['id'=>$user['id']])}}" class="btn btn-primary btn-sm">Edit</a></td>
                             <td><a href="{{ route('user.delete',['delete_id'=>$user['id']]) }}" class="btn btn-danger btn-sm">Delete</a></td>
                        
                            </tr>
                      </tbody>
                  @endforeach 

                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>



@endsection














                