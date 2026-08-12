@extends('admin_penal.master')
@section('content')
 <div class="card">
                  <div class="card-header">
                    <h3>Add New Order</h3>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{ route('orderStore') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <!--begin::Body-->
                    @csrf
                    <div class="card-body">
                      <section>
                      <!--begin::Row-->
                      <div class="row g-3">
                        <!--begin::Col-->
                        {{-- <div class="col-md-6">
                          
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
                          
                          <label for="validationCustom01" class="form-label">Shope Name</label>  
                          
                          {{-- <input type="number" class="form-control" name="vendor_id" value="{{old('vendor_id')}}"  required /> --}}
                            <select name="vendor_id" class="form-select">
                              @foreach ($vendors as $vendor)
                                 <option value="{{ $vendor->id }}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>{{$vendor->store_name}}</option>

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
                          
                          <label for="validationCustom01" class="form-label">All Rider</label>
                          
                            <select name="rider_id" class="form-select">
                              @foreach ($riders as $rider)
                                 <option value="{{ $rider->id }}" {{ old('rider_id') == $rider->id ? 'selected' : '' }}>{{ $rider->user->name }}</option>

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
                          
                          <label for="validationCustom01" class="form-label">Customer Name</label>
                          
                          <select name="profile_id" class="form-select">
                              @foreach ($profiles as $pro )
                                 <option value="{{ $pro->id }}" {{ old('profile_id') == $pro->id ? 'selected' : '' }}>{{ $pro->full_name }}</option>

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
                          
                          <input type="text" class="form-control" value="{{old('order_number')}}" name="order_number" required />
                          <span style="color: red">
                            @error('order_number')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                      
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="slug" class="form-label">Subtotal</label>
                        <input type="number" name="subtotal" value="{{old('subtotal')}}"  class="form-control"  id="slug" >
                         
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
                          <label for="validationCustom01" class="form-label">Total</label>
                          
                          <input type="number" class="form-control" value="{{old('total')}}" name="total" required />
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
                        
                          <input type="number" class="form-control" value="{{old('delivery_fee')}}" name="delivery_fee" required />
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
                           
                            <input type="number" class="form-control" value="{{old('discount')}}" name="discount" required />
                            
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
                          
                          <input type="number" class="form-control" value="{{old('tax')}}" name="tax" required />
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
                          
                          {{-- <input type="text" class="form-control" name="payment_status" value="{{old('payment_status')}}" required /> --}}
                       <select name="payment_status" class="form-control form-select">
                                   <option value="pending" {{ old('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                   <option value="paid" {{ old('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                   <option value="failed" {{ old('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
                                   <option value="refunded" {{ old('payment_status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                   <option value="cancelled" {{ old('payment_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                   <option value="partial_paid" {{ old('payment_status') == 'partial_paid' ? 'selected' : '' }}>Partial Paid</option>
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
                          
                          {{-- <input type="order_status" class="form-control" value="{{old('order_status')}}" name="order_status" required /> --}}
                       <select name="order_status" class="form-control form-select">
                                <option value="pending" {{ old('order_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ old('order_status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="processing" {{ old('order_status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ old('order_status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ old('order_status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ old('order_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="returned" {{ old('order_status') == 'returned' ? 'selected' : '' }}>Returned</option>
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
                          
                          <input type="text" class="form-control" name="notes" value="{{old('notes')}}" required />
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
                          
                          <input type="date" class="form-control" name="placed_at" value="{{old('placed_at')}}" required />
                          <span style="color: red">
                            @error('placed_at')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                             <!--end::Col--> <!--begin::Col-->
                        {{-- <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Delivered Date</label>
                          
                          <input type="date" class="form-control " name="delivered_at" value="{{old('delivered_at')}}" required />
                          <span style="color: red">
                            @error('delivered_at')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div> --}}
                        <!--end::Col--> 
                                           
                      </div>
                  </section>

                  <section class="mt-4">
                      <h4>Order Products</h4>
                      <div id="order-items" class="row g-3">
                          <div class="col-12">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>Product</th>
                                          <th>Quantity</th>
                                          <th>Price</th>
                                          <th>Total</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody id="order-items-body">
                                      <tr class="order-item-row">
                                          <td>
                                              <select name="product_id[]" class="form-control form-select product-select">
                                                  <option value="">Select product</option>
                                                  @foreach ($products as $product)
                                                      <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                                  @endforeach
                                              </select>
                                          </td>
                                          <td>
                                              <input type="number" name="quantity[]" class="form-control quantity-input" value="1" min="1" />
                                          </td>
                                          <td>
                                              <input type="number" name="product_price[]" class="form-control price-input" value="0" step="0.01" readonly />
                                          </td>
                                          <td>
                                              <input type="number" name="item_total[]" class="form-control total-input" value="0" step="0.01" readonly />
                                          </td>
                                          <td>
                                              <button type="button" class="btn btn-danger remove-order-item">Remove</button>
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                          <div class="col-12">
                              <button type="button" id="add-order-item" class="btn btn-primary">Add Product</button>
                          </div>
                      </div>
                  </section>

                      <!--end::Row-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer mt-5">
                      <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
                </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productData = @json($products->map(fn($product) => ['id' => $product->id, 'name' => $product->name, 'price' => $product->price]));

        function buildOptions() {
            return ['<option value="">Select product</option>', ...productData.map(product => `<option value="${product.id}" data-price="${product.price}">${product.name}</option>`)].join('');
        }

        function recalculateRow(row) {
            const productSelect = row.querySelector('.product-select');
            const quantityInput = row.querySelector('.quantity-input');
            const priceInput = row.querySelector('.price-input');
            const totalInput = row.querySelector('.total-input');

            const selectedOption = productSelect.options[productSelect.selectedIndex];
            const price = parseFloat(selectedOption.dataset.price || 0);
            const quantity = parseInt(quantityInput.value || 0, 10);
            const rowTotal = price * quantity;

            priceInput.value = price.toFixed(2);
            totalInput.value = rowTotal.toFixed(2);
        }

        function bindRowEvents(row) {
            const productSelect = row.querySelector('.product-select');
            const quantityInput = row.querySelector('.quantity-input');
            const removeButton = row.querySelector('.remove-order-item');

            productSelect.addEventListener('change', function () {
                recalculateRow(row);
            });

            quantityInput.addEventListener('input', function () {
                recalculateRow(row);
            });

            removeButton.addEventListener('click', function () {
                const rows = document.querySelectorAll('.order-item-row');
                if (rows.length > 1) {
                    row.remove();
                }
            });
        }

        function addOrderItem() {
            const row = document.createElement('tr');
            row.classList.add('order-item-row');
            row.innerHTML = `
                <td>
                    <select name="product_id[]" class="form-control form-select product-select">
                        ${buildOptions()}
                    </select>
                </td>
                <td>
                    <input type="number" name="quantity[]" class="form-control quantity-input" value="1" min="1" />
                </td>
                <td>
                    <input type="number" name="product_price[]" class="form-control price-input" value="0" step="0.01" readonly />
                </td>
                <td>
                    <input type="number" name="item_total[]" class="form-control total-input" value="0" step="0.01" readonly />
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-order-item">Remove</button>
                </td>
            `;
            document.getElementById('order-items-body').appendChild(row);
            bindRowEvents(row);
        }

        document.getElementById('add-order-item').addEventListener('click', addOrderItem);
        document.querySelectorAll('.order-item-row').forEach(bindRowEvents);
    });
</script>@endsection