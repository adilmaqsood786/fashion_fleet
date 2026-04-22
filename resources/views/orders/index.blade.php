{{-- @foreach ($orders as $order)
    <p>{{print_r($order)}}</p>
@endforeach --}}



@extends('admin_penal.master')
@section('content')
 
        
  <!-- /.card --> 
        
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">All Order</h3>
                    <div class=" d-flex justify-content-end align-items-center">
                    <a href="{{route('orderCreate')}}" class="btn btn-info">New</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                      
                  <div class="card-body p-0 table-responsive">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                            <th>ID</th>
                          <th>User</th>
                          <th>Vender</th>
                          <th>Rider</th>
                          <th>Customer</th>
                          <th>Order Number</th>
                          <th>Subtotal</th>
                          <th>Delivery Fee</th>
                          <th>Discount</th>
                          <th>Tax</th>
                          <th>Payment Status</th>
                          <th>Order Status</th>
                          <th>Notes</th>
                          <th>Placed At</th>
                          <th>Delivered At</th>
                          <th>Edit</th>
                          <th>Delete</th>

                        </tr>
                      </thead>
                  @foreach ($orders as $order )
                      <tbody>
                        <tr class="align-middle">
                         <td>{{ $order->id}}</td>
                         <td>{{ $order->user->name}}</td>
                         <td>{{ $order->vendor->store_name}}</td>
                         {{-- <td>{{ $order->rider->vehicle_type?$order->rider->vehicle_type:"No vehicle_type"}}</td> --}}
                         <td>{{ isset($order->rider->vehicle_number) ? $order->rider->vehicle_number: 'Not Assigned' }}</td>
                         <td>{{ $order->profile->full_name}}</td>
                         <td>{{ $order->order_number}}</td>
                         <td>{{ $order->subtotal}}</td>
                         <td>{{ $order->delivery_fee}}</td>
                         <td>{{ $order->discount}}</td>
                         <td>{{ $order->tax}}</td>
                         <td>{{ $order->payment_status}}</td>
                         <td>{{ $order->order_status}}</td>
                         <td>{{ $order->notes}}</td>
                         <td>{{ $order->placed_at}}</td>
                         <td>{{ $order->delivered_at}}</td>
                          <td><a href="{{route('orderEdit',['edit_id'=>$order['id']])}}" class="btn btn-outline-primary">Edit</a></td>
                          <td><a href="{{route('orderDelete',['delete_id'=>$order['id']])}}" class="btn btn-outline-danger">Delete</a></td>
                        </tr>
                      </tbody>
                  @endforeach

                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>

@endsection
















                