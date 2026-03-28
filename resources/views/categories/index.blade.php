
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
                            <th>ID</th>
                          <th>Name</th>
                          <th>Parent</th>
                          <th>Status</th>
                          <th>Edit</th>
                          <th>Delete</th>

                        </tr>
                      </thead>
                  @foreach ($categories as $category )
                      <tbody>
                        <tr class="align-middle">
                         <td>{{ $category['id'] }}</td>
                         <td>{{ $category['name'] }}</td>
                         <td>{{ $category['parent_id']}}</td>
                         <td>{{ $category['status']}}</td>
                          <td><a href="{{route('categoryEdit',['edit_id'=>$category['id']])}}" class="btn btn-outline-primary">Edit</a></td>
                          <td><a href="{{route('categoryDelete',['delete_id'=>$category['id']])}}" class="btn btn-outline-danger">Delete</a></td>
                        </tr>
                      </tbody>
                  @endforeach

                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>

@endsection
















                