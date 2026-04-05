
@extends('admin_penal.master')
@section('content')
 
        
  <!-- /.card --> 
        
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Category Record</h3>
                    <div class=" d-flex justify-content-end align-items-center">
                    <a href="{{route('categoryCreate')}}" class="btn btn-outline-warning">New</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                      
                  <div class="card-body p-0">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                            <th>ID</th>
                          <th>Name</th>
                          <th>Slug</th>
                          <th>Image</th>
                          <th>Parent_id</th>
                          <th>Is_active</th>
                          <th>Edit</th>
                          <th>Delete</th>

                        </tr>
                      </thead>
                  @foreach ($categories as $category )
                      <tbody>
                        <tr class="align-middle">
                         <td>{{ $category['id'] }}</td>
                         <td>{{ $category['name'] }}</td>
                         <td>{{ $category['slug'] }}</td>
                         <td><img src="{{ asset('storage/'.$category->image) }}" width="100" height="100"></td>
                         <td>{{ $category['parent_id']}}</td>
                         <td>{{ $category['is_active']}}</td>
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
















                