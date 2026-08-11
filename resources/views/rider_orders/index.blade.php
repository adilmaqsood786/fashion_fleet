@extends('admin_penal.master')

@section('content')
  <div class="card mb-4">
    <div class="card-header"><h3 class="card-title">My Assigned Orders</h3></div>

    @if (session('success'))
      <div class="alert alert-success m-3 mb-0">{{ session('success') }}</div>
    @endif

    <div class="card-body p-0 table-responsive">
      <table class="table table-sm mb-0">
        <thead>
          <tr>
            <th>Order</th>
            <th>Customer</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Products</th>
            <th>Total</th>
            <th>Order Date</th>
            <th>Delivery Status</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($orders as $order)
            <tr class="align-middle">
              <td>#{{ $order->id }}<br><small>{{ $order->order_number }}</small></td>
              <td>{{ $order->profile?->full_name ?? $order->user?->name }}</td>
              <td>{{ $order->profile?->address_line_1 }} {{ $order->profile?->address_line_2 }}</td>
              <td>{{ $order->user?->userPhone }}</td>
              <td>
                @foreach ($order->items as $item)
                  <div>{{ $item->product_name }} × {{ $item->quantity }}</div>
                @endforeach
              </td>
              <td>{{ $order->total }}</td>
              <td>{{ $order->placed_at?->format('Y-m-d H:i') }}</td>
              <td>
                <div class="mb-1"><span class="badge text-bg-secondary">{{ $order->delivery_status }}</span></div>
                @if (in_array($order->delivery_status, ['Assigned', 'Picked Up', 'Out for Delivery'], true))
                  @php($nextStatuses = ['Assigned' => 'Picked Up', 'Picked Up' => 'Out for Delivery', 'Out for Delivery' => 'Delivered'])
                  <form action="{{ route('riderOrders.updateDeliveryStatus', $order) }}" method="POST">
                    @csrf
                    <input type="hidden" name="delivery_status" value="{{ $nextStatuses[$order->delivery_status] }}">
                    <button type="submit" class="btn btn-sm btn-primary">Mark {{ $nextStatuses[$order->delivery_status] }}</button>
                  </form>
                @endif
              </td>
            </tr>
          @empty
            <tr><td colspan="8" class="text-center py-4">No orders are assigned to you.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
