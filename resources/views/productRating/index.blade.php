   


        
    


@extends('admin_penal.master')
@section('content')
 
        
  <!-- /.card --> 
        
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Category Record</h3>
                    <div class=" d-flex justify-content-end align-items-center">
                    <a href="{{route('ratingCreate')}}" class="btn btn-info">New</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                      
                  <div class="card-body p-0">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Product</th>
                          <th>User</th>
                          <th>Order</th>
                          <th>Rating</th>
                          <th>Title</th>
                          <th>Review</th>
                          <th>Approved</th>
                          <th>Edit</th>
                          <th>Delete</th>

                        </tr>
                      </thead>
                  @foreach ($rating as $rate)

                      <tbody>
                        <tr class="align-middle">
                         <td>{{$rate->id }}</td>
                         <td>{{$rate->product_id }}</td>
                         <td>{{$rate->user_id }}</td>
                         <td>{{$rate->order_id}}</td>
                         <td>{{$rate->rating}}</td>
                         <td>{{$rate->title}}</td>
                         <td>{{$rate->review}}</td>
                         <td>{{$rate->is_approved?'yes':'no'}}</td>

                          <td><a href="{{route('ratingEdit',['edit_id'=>$rate['id']])}}" class="btn btn-outline-primary">Edit</a></td>
                          <td><a href="{{route('ratingDelete',['delete_id'=>$rate['id']])}}" class="btn btn-outline-danger">Delete</a></td>
                        </tr>
                      </tbody>
                  @endforeach

                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>

@endsection
