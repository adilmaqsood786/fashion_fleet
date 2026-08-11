@extends('admin_penal.master')
@section('content')
 <div class="card-header">
                    <h3>Edit Order </h3>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{route('orderUpdate',['update_id'=>$orderRecord->id])}}" method="post"  class="needs-validation" novalidate>
                    <!--begin::Body-->
                    @csrf
                    <div class="card-body">
                      <!--begin::Row-->
                      <section>
                      <div class="row gss-3">
                          {{-- <!--begin::Col-->
                          <div class="col-md-6">
                            
                            <label for="validationCustom01" class="form-label">User Name</label>
                            
                              <select name="user_id" id="id" class="form-controls form-select">
                                @foreach ($users as $user)
                                  <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : ''}}>{{$user->name}}</option>

                                @endforeach
                              </select>
                            <span style="color: red">
                              @error('user_id')
                                  {{$message}}
                              @enderror
                            </span>

                            <div class="valid-feedback">Looks good!</div>
                          </div>
                          <!--end::Col--> --}}
                         <!--begin::Col-->
                        <div class="col-md-6">
                          
                          <label for="vendor_id" class="form-label">Shop Name</label>
                          
                            <select name="vendor_id" id="vendor_id" class="form-controls form-select">
                              @foreach ($vendors as $vendor)
                                 <option value="{{ $vendor->id }}" {{ old('vendor_id', $orderRecord->vendor_id) == $vendor->id ? 'selected' : '' }}>{{$vendor->store_name}}</option>
                              @endforeach
                            </select>
                          <span style="color: red">
                            @error('vendor_id')
                                {{$message}}
                            @enderror
                          </span>

                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          
                          <label for="rider_id" class="form-label">All Rider</label>
                          
                            <select name="rider_id" id="rider_id" class="form-controls form-select">
                              @foreach ($riders as $rider)
                                 <option value="{{$rider->id}}" {{ old('rider_id', $orderRecord->rider_id) == $rider->id ? 'selected' : '' }}>{{$rider->name}}</option>
                              @endforeach
                            </select>
                          <span style="color: red">
                            @error('rider_id')
                                {{$message}}
                            @enderror
                          </span>

                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          
                          <label for="profile_id" class="form-label">Customer Name</label>
                          
                          <select name="profile_id" id="profile_id" class="form-controls form-select">
                              @foreach ($profiles as $pro )
                                 <option value="{{$pro->id}}" {{ old('profile_id', $orderRecord->profile_id) == $pro->id ? 'selected' : '' }}>{{$pro->full_name}}</option>
                              @endforeach
                            </select>
                          <span style="color: red">
                            @error('profile_id')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">

                          <label for="validationCustom01" class="form-label">Order Number</label>
                          
                          <input type="text" class="form-control" value="{{old('order_number', $orderRecord->order_number)}}" name="order_number" required />
                          <span style="color: red">
                            @error('order_number')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <div class="col-12">
                          <div class="card card-body mt-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                              <h4 class="mb-0">Products</h4>
                              <button type="button" class="btn btn-sm btn-outline-primary" id="add-product-row">+ Add Product</button>
                            </div>
                            <div class="table-responsive">
                              <table class="table table-bordered align-middle" id="order-products-table">
                                <thead>
                                  <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Quantity</th>
                                    <th>Line Total</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody id="product-rows"></tbody>
                              </table>
                            </div>
                            <div class="text-end">
                              <strong>Subtotal:</strong> <span id="display-subtotal">0.00</span>
                            </div>
                          </div>
                        </div>
                        <!--end::Col-->
                      
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="subtotal" class="form-label">Subtotal</label>
                        <input type="number" name="subtotal" value="{{old('subtotal',isset($orderRecord->subtotal)?$orderRecord->subtotal:"")}}"  class="form-control"  id="subtotal" readonly>
                         
                        <span style="color: red">
                            @error('subtotal')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                       <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="total" class="form-label">Total</label>
                          
                          <input type="number" class="form-control" id="total" value="{{old('total',isset($orderRecord->total)?$orderRecord->total:"")}}" name="total" readonly />
                          <span style="color: red">
                            @error('total')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="short_description" class="form-label">Delivery Fee</label>
                        
                          <input type="number" class="form-control" value="{{old('delivery_fee',isset($orderRecord->delivery_fee)?$orderRecord->delivery_fee:"")}}" name="delivery_fee" required />
                          <span style="color: red">
                            @error('delivery_fee')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="invalid-feedback">Please provide a valid city.</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="description" class="form-label">Discount</label>
                          <div class="input-group has-validation">
                           
                            <input type="number" class="form-control" value="{{old('discount',isset($orderRecord->discount)?$orderRecord->discount:"")}}" name="discount" required />
                            
                            <div class="invalid-feedback">Please choose a username.</div>
                            
                          </div>
                          <span style="color: red">
                            @error('discount')
                                {{$message}}
                            @enderror
                          </span>
                        </div>
                        <!--end::Col-->
                        
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">tax</label>
                          
                          <input type="number" class="form-control" value="{{old('tax',isset($orderRecord->tax)?$orderRecord->tax:"")}}" name="tax" required />
                          <span style="color: red">
                            @error('tax')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col--> 
                        
                       
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Payment Status</label>
                          
                          {{-- <input type="text" class="form-control" name="payment_status" value="{{old('payment_status',isset($orderRecord->payment_status)?$orderRecord->payment_status:"")}}" required /> --}}
                          <label for="payment_status">Payment Status</label>
                           <select name="payment_status" class="form-control form-select">
                               <option value="pending" 
                                   {{ old('payment_status', $orderRecord->payment_status) == 'pending' ? 'selected' : '' }}>
                                   Pending
                               </option>
                           
                               <option value="paid" 
                                   {{ old('payment_status', $orderRecord->payment_status) == 'paid' ? 'selected' : '' }}>
                                   Paid
                               </option>
                           
                               <option value="failed" 
                                   {{ old('payment_status', $orderRecord->payment_status) == 'failed' ? 'selected' : '' }}>
                                   Failed
                               </option>
                           
                               <option value="refunded" 
                                   {{ old('payment_status', $orderRecord->payment_status) == 'refunded' ? 'selected' : '' }}>
                                   Refunded
                               </option>
                           
                               <option value="cancelled" 
                                   {{ old('payment_status', $orderRecord->payment_status) == 'cancelled' ? 'selected' : '' }}>
                                   Cancelled
                               </option>
                           
                               <option value="partial_paid" 
                                   {{ old('payment_status', $orderRecord->payment_status) == 'partial_paid' ? 'selected' : '' }}>
                                   Partial Paid
                               </option>
                           </select>
                          <span style="color: red">
                            @error('payment_status')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Order Status</label>
                          
                          {{-- <input type="order_status" class="form-control" value="{{old('order_status',isset($orderRecord->order_status)?$orderRecord->order_status:"")}}" name="order_status" required /> --}}
                          <label for="order_status">Order Status</label>
                         <select name="order_status" class="form-control form-select">
                              <option value="pending" {{ old('order_status', $orderRecord->order_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                              <option value="confirmed" {{ old('order_status', $orderRecord->order_status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                              <option value="processing" {{ old('order_status', $orderRecord->order_status) == 'processing' ? 'selected' : '' }}>Processing</option>
                              <option value="shipped" {{ old('order_status', $orderRecord->order_status) == 'shipped' ? 'selected' : '' }}>Shipped</option>
                              <option value="delivered" {{ old('order_status', $orderRecord->order_status) == 'delivered' ? 'selected' : '' }}>Delivered</option>
                              <option value="cancelled" {{ old('order_status', $orderRecord->order_status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                              <option value="returned" {{ old('order_status', $orderRecord->order_status) == 'returned' ? 'selected' : '' }}>Returned</option>
                        </select>
                          <span style="color: red">
                            @error('order_status')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>

                        </div>
                        <!--end::Col--> 
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Notes</label>
                          
                          <input type="text" class="form-control" name="notes" value="{{old('notes',isset($orderRecord->notes)?$orderRecord->notes:"")}}" required />
                          <span style="color: red">
                            @error('notes')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Placed At</label>
                          
                          <input type="datetime-local" class="form-control" name="placed_at" value="{{old('placed_at',isset($orderRecord->placed_at)?$orderRecord->placed_at:"")}}" required />
                          <span style="color: red">
                            @error('placed_at')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                             {{-- <!--end::Col--> <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Delivered At</label>
                          
                          <input type="datetime-local" class="form-control" name="delivered_at" value="{{old('delivered_at',isset($orderRecord->delivered_at)?$orderRecord->delivered_at:"")}}" required />
                          <span style="color: red">
                            @error('delivered_at')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div> --}}
                        <!--end::Col-->                    
                      </div>
                  
                      <!--end::Row-->
                  </section>













                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer mt-5">
                      <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->

<script>
window.oldOrderProducts = [];
@if(old('product_id') && is_array(old('product_id')))
window.oldOrderProducts = [
    @foreach(old('product_id') as $index => $productId)
        @if($productId)
            {
                product_id: {{ $productId }},
                quantity: {{ old('quantity')[$index] ?? 1 }},
            },
        @endif
    @endforeach
];
@else
window.oldOrderProducts = [
  @foreach ($orderRecord->items as $item)
    {
      product_id: {{ $item->product_id }},
      quantity: {{ $item->quantity }},
    },
  @endforeach
];
@endif
</script>
@include('orders.order-product-scripts')

@endsection

