   

@extends('admin_penal.master')

@section('content')

<div class="card mb-4">

    <div class="card-header">
        <h3 class="card-title">All Product Rating</h3>

        <div class="d-flex justify-content-end align-items-center">
            <a href="{{ route('ratingCreate') }}" class="btn btn-info">
                New
            </a>
        </div>
    </div>

    <div class="card-body p-0">

        <table class="table table-sm">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>User</th>
                    <th>Order</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Approved</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($rating as $rate)

                    <tr class="align-middle">

                        <td>
                            {{ $rate->id }}
                        </td>

                        <td>
                            {{ $rate->product ? $rate->product->name : '' }}
                        </td>

                        <td>
                            {{ $rate->user ? $rate->user->name : '' }}
                        </td>

                        <td>
                            {{ $rate->order ? $rate->order->payment_status : '' }}
                        </td>

                        <td>
                            {{ $rate->rating }}
                        </td>


                        <td>
                            {{ $rate->review }}
                        </td>

                        {{-- APPROVED --}}
                        <td>

    {{-- YES BUTTON --}}
    <a href="{{ route('ratingApproval', [
        'id' => $rate->id,
        'status' => 1
    ]) }}"
    class="btn {{ $rate->is_approved == 1 ? 'btn-success' : 'btn-outline-success' }}">
        Yes
    </a>


    {{-- NO BUTTON --}}
    <a href="{{ route('ratingApproval', [
        'id' => $rate->id,
        'status' => 0
    ]) }}"
    class="btn {{ $rate->is_approved == 0 ? 'btn-danger' : 'btn-outline-danger' }}">
        No
    </a>

</td>

                        {{-- EDIT --}}
                        <td>
                            <a href="{{ route('ratingEdit', [
                                'edit_id' => $rate->id
                            ]) }}"
                            class="btn btn-outline-primary">
                                Edit
                            </a>
                        </td>

                        {{-- DELETE --}}
                        <td>
                            <a href="{{ route('ratingDelete', [
                                'delete_id' => $rate->id
                            ]) }}"
                            class="btn btn-outline-danger">
                                Delete
                            </a>
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection
        


















    


{{-- @extends('admin_penal.master')
@section('content')
 
        
  <!-- /.card --> 
        
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">All Product Rating</h3>
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
                         <td>{{$rate->product_id ? $rate->product->name:""}}</td>
                         <td>{{$rate->user->name }}</td>
                         <td>{{$rate->order->payment_status}}</td>
                         <td>{{$rate->rating}}</td>
                         <td>{{$rate->title}}</td>
                         <td>{{$rate->review}}</td>
                         {{-- <td>{{$rate->is_approved?'yes':'no'}}</td> --}}
                         {{-- <td> --}}
    {{-- @if($rate->is_approved)
        <a href="{{ route('ratingApproval', [
            'id' => $rate->id,
            'status' => 0
        ]) }}"
           class="btn btn-success">
            Yes
        </a>
        <a href="{{ route('ratingApproval', [
            'id' => $rate->id,
            'status' => 1
        ]) }}"
           class="btn btn-danger">
            No
        </a>
    
        
    @endif --}}
{{-- </td>
                          <td><a href="{{route('ratingEdit',['edit_id'=>$rate['id']])}}" class="btn btn-outline-primary">Edit</a></td>
                          <td><a href="{{route('ratingDelete',['delete_id'=>$rate['id']])}}" class="btn btn-outline-danger">Delete</a></td>
                        </tr>
                      </tbody>
                  @endforeach

                    </table>
                  </div>
                  <!-- /.card-body -->
                </div> --}}

{{-- @endsection --}} 
