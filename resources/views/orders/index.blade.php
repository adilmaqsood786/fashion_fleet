@extends('admin_penal.master')

@section('content')
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">All Orders</h3>
                    <div class=" d-flex justify-content-end align-items-center">
                    <a href="{{route('orderCreate')}}" class="btn btn-warning">New</a>
                    </div>
                  </div>

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
                          <th>Rider</th>
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
                         <td>{{ $order->rider->user->name ?? 'Not Assigned' }}</td>
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
                         <td>
                               <div class="dropdown">
                               <button class="btn btn-outline-secondary dropdown-toggle rider-assign-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                 {{ $order->rider->user->name ?? 'Assign Rider' }}
                               </button>
                               <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                @forelse ($riders as $rider)
                                 <li>
                                     <form action="{{ route('orderAssignRider', ['order_id' => $order->id]) }}" method="post" class="dropdown-item d-flex justify-content-between align-items-center">
                                         @csrf
                                         <input type="hidden" name="rider_id" value="{{ $rider->id }}">
                                         <span>{{ $rider->user->name }}</span>
                                         <button type="submit" class="btn btn-sm {{ $order->rider_id == $rider->id ? 'btn-primary' : 'btn-outline-primary' }}">
                                            {{ $order->rider_id == $rider->id ? 'Assigned' : 'Assign' }}
                                         </button>
                                     </form>
                                 </li>
                                @empty
                                 <li><span class="dropdown-item text-muted">No riders available</span></li>
                                @endforelse
                               </ul>
                             </div>

                         </td>
                          <td><a href="{{route('orderEdit',['edit_id'=>$order['id']])}}" class="btn btn-outline-primary">Edit</a></td>
                          <td><a href="{{route('orderDelete',['delete_id'=>$order['id']])}}" class="btn btn-outline-danger">Delete</a></td>
                        </tr>
                      </tbody>
                  @endforeach

                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>

<script>
window.addEventListener('load', function () {
    document.querySelectorAll('.rider-assign-toggle').forEach(function (toggle) {
        bootstrap.Dropdown.getOrCreateInstance(toggle, {
            popperConfig: function (defaultConfig) {
                return Object.assign({}, defaultConfig, { strategy: 'fixed' });
            }
        });
    });
});
</script>

@endsection
