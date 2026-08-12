@extends('admin_penal.master')
@section('content')

                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Orders assigned to {{ $riderRecord->user->name }}</h3>
                    <div class="d-flex justify-content-end align-items-center">
                    <a href="{{ route('riderIndex') }}" class="btn btn-outline-secondary">Back to Riders</a>
                    </div>
                  </div>
                  <!-- /.card-header -->

                  <div class="card-body p-0 table-responsive">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Order Number</th>
                          <th>Shop Name</th>
                          <th>Customer Name</th>
                          <th>Total</th>
                          <th>Payment Status</th>
                          <th>Order Status</th>
                          <th>Placed At</th>
                          <th>Delivered At</th>
                        </tr>
                      </thead>
                      <tbody>
                      @forelse ($orders as $order)
                        <tr class="align-middle">
                         <td>{{ $order->id }}</td>
                         <td>{{ $order->order_number }}</td>
                         <td>{{ $order->vendor->store_name ?? '-' }}</td>
                         <td>{{ $order->profile->full_name ?? '-' }}</td>
                         <td>{{ $order->total }}</td>
                         <td>{{ $order->payment_status }}</td>
                         <td>
                            <span class="badge
                                @class([
                                    'bg-warning' => $order->order_status == 'pending',
                                    'bg-info' => $order->order_status == 'assigned',
                                    'bg-primary' => $order->order_status == 'out_for_delivery',
                                    'bg-success' => $order->order_status == 'delivered',
                                    'bg-danger' => $order->order_status == 'cancelled',
                                    'bg-secondary' => !in_array($order->order_status, ['pending','assigned','out_for_delivery','delivered','cancelled']),
                                ])">
                                {{ ucfirst(str_replace('_',' ', $order->order_status)) }}
                            </span>
                         </td>
                         <td>{{ $order->placed_at }}</td>
                         <td>{{ $order->delivered_at ?? '-' }}</td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="9" class="text-center">No orders assigned to this rider yet.</td>
                        </tr>
                      @endforelse
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>

@endsection
