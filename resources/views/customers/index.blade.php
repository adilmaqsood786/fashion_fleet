@extends('admin_penal.master')
@section('content')
 
        
  <!-- /.card --> 
        
                <div class="card mb-4">
                  <div class="card-header">
                    
                    <h3 class="card-title">Customer Record</h3>
                    <div class=" d-flex justify-content-end align-items-center">
                    <a href="{{route('customerCreate')}}" class="btn btn-outline-warning">New</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                      
                  <div class="card-body p-0 table-responsive" >
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
                          <th>Name</th>
                          <th>Email</th>
                          <th>Phone</th>


                         

                        </tr>
                      </thead>
                      <tbody>

                  @foreach ($customers as $customer )
                        <tr class="align-middle">
                          <td>{{$customer['id']}}</td>
                          <td>{{$customer['first_name']}}</td>
                          <td>{{$customer['last_name']}}</td>
                          <td>{{$customer['father_name']}}</td>
                          <td>{{$customer['email']}}</td>
                          <td>{{$customer['phone']}}</td>
                          <td>{{$customer['address']}}</td>
                          <td><a href="{{route('customerEdit',['edit_id'=>$customer['id']])}}" class="btn btn-outline-primary">Edit</a></td>
                          <td><a href="{{route('customerDelete',['delete_id'=>$customer['id']])}}" class="btn btn-outline-danger">Delete</a></td>
                        
                  @endforeach
                  @foreach ($users as $user )
                      
                          <td>{{$user['id']}}</td>
                          <td>{{$user['name']}}</td>
                          <td>{{$user['email']}}</td>
                          <td>{{$user['phone']}}</td>
                          <td>{{$user['password']}}</td>
                          <td>{{$user['role']}}</td>
                          <td>{{$user['status']}}</td>
                          <td>{{$user['email_verified_at']}}</td>
                     </tr>
                  @endforeach
                           

                      </tbody>

                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>

@endsection
















                