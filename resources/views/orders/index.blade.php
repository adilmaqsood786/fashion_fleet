@extends('admin_penal.master')

@section('content')
  <div class="card mb-4">
    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
      <h3 class="card-title mb-0">All Orders</h3>
      <a href="{{ route('orderCreate') }}" class="btn btn-info">New</a>
    </div>

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
