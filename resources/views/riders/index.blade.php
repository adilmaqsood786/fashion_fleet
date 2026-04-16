

@extends('admin_penal.master')
@section('content')
 
        
  <!-- /.card --> 
        
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">All Rider Record</h3>
                    <div class=" d-flex justify-content-end align-items-center">
                    <a href="{{route('riderCreate')}}" class="btn btn-outline-warning">New</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                      
                  <div class="card-body p-0">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                            <th>ID</th>
                          <th>User </th>
                          <th>vehicle type</th>
                          <th>Vehicle number</th>
                          <th>License number</th>
                          <th>Is_available</th>
                          <th>Is_verified</th>
                          <th>Edit</th>
                          <th>Delete</th>

                        </tr>
                      </thead>
                  @foreach ($riders as $rider )
                      <tbody>
                        <tr class="align-middle">
                         <td>{{ $rider['id'] }}</td>
                         <td>{{ $rider->user->name }}</td>
                         <td>{{ $rider['vehicle_type'] }}</td>
                         <td>{{ $rider['vehicle_number']}}</td>
                         <td>{{ $rider['license_number']}}</td>
                         <td>{{ $rider['is_available']?"yes":"no"}}</td>
                         <td>{{ $rider['is_verified']?"yes":"no"}}</td>


                          <td><a href="{{route('riderEdit',['edit_id'=>$rider['id']])}}" class="btn btn-outline-primary">Edit</a></td>
                          <td><a href="{{route('riderDelete',['delete_id'=>$rider['id']])}}" class="btn btn-outline-danger">Delete</a></td>
                        </tr>
                      </tbody>
                  @endforeach

                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>

@endsection
















                