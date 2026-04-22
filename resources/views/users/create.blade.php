@extends('admin_penal.master')
@section('content')


@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


 <div class="card-header">
                    <div class="card-title "><h3>User</h3></div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{ route('user.store') }}" method="post" class="needs-validation" novalidate>
                    <!--begin::Body-->
                    @csrf
                    <div class="card-body">
                      <section>
                      <!--begin::Row-->
                      <div class="row g-3">

                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Name</label>
                          
                          <input type="text" class="form-control" name="name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom02" class="form-label">Email</label>
                          
                          <input type="email" class="form-control" name="email" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Phone Number</label>
                          <div class="input-group has-validation">
                           
                            <input type="number" class="form-control" name="userPhone" />
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>  
                        </div>
                               {{-- <input type="number" name="userPhone"> --}}

                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Password</label>
                          <div class="input-group has-validation">
                           
                            <input type="password" class="form-control" name="password" />
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>  
                        </div>
                               {{-- <input type="number" name="userPhone"> --}}

                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">Role</label>
                        <select name="role" id="role" class="form-select" required>
                             <option value="">Select Role</option>
                             <option value="customer">Customer</option>
                             <option value="vendor">Vendor</option>
                             <option value="rider">Rider</option>
                          </select>
                        </div>
                        <!--end::Col-->
                          <!--begin::Col-->
                         <div class="col-md-6">
                           <label for="status" class="form-label">Status</label>
                         
                           <select name="status" class="form-select" required>
                               <option value="active">Active</option>
                               <option value="inactive">Inactive</option>
                           </select>
                         
                           <div class="invalid-feedback">Please select a valid status.</div>     
                   <!--end::Col-->
                   </div>
                  
                   {{-- <!--end::Row-->
                    </div> --}}
                  
                  </section>


             {{--=========vender_form=========--}}
             <section id="vendor_section" class="mt-5 d-none">
              <div class="row g-3">
                <h3>Vendor</h3>
                
        
                        <!--begin::Col-->
                         <div class="col-md-6">

                          <label for="validationCustom01" class="form-label">Store Name</label>
                          
                          <input type="text" class="form-control" name="store_name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                      
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="slug" class="form-label">Store Slug</label>
                        
                          {{-- <select name="store_slug"  required>
                              <option value="men">Men</option>
                              <option value="women">Women</option>
                          </select> --}}
                        <input type="text" name="slug" class="form-control" id="slug" >
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                       
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">Logo</label>
                        
                          <input type="file" class="form-control" name="logo" required />
                          <div class="invalid-feedback">Please provide a valid city.</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Description</label>
                          <div class="input-group has-validation">
                           
                            <input type="text" class="form-control" name="description" required />
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>
                        </div>
                        <!--end::Col-->
                        
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Address</label>
                          
                          <input type="text" class="form-control" name="address" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col--> 
                        
                       
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">City</label>
                          
                          <input type="text" class="form-control" name="city" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col--> <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Country</label>
                          
                          <input type="text" class="form-control" name="country" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Commission rate</label>
                          
                          <input type="text" class="form-control" name="commission_rate" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!-- Is Approved -->
            <div class="col-md-6">
                <label class="form-label">Is Approved</label>
                <select name="is_approved" class="form-control" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <!-- Is Active -->
            <div class="col-md-6 mt-4">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" checked>
                <label class="form-label">Is Active</label>
            </div>


              </div>
             </section>


  {{--=========User_profile=========--}}
<section id="customer_section" class="mt-5 d-none">
 <div class="row g-3">
                       
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Full Name</label>
                          <div class="input-group has-validation">
                           
                            <input type="text" class="form-control" name="full_name" required />
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">Phone Number</label>
                        
                          <input type="number" class="form-control" name="phone" required />
                          <div class="invalid-feedback">Please provide a valid city.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">Address line 1</label>
                         
                          <input type="text" class="form-control" name="address_line_1" required />
                          <div class="invalid-feedback">Please select a valid state.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom05" class="form-label">Address line 2</label>
                         
                          <input type="text" class="form-control" name="address_line_2" required />
                          <div class="invalid-feedback">Please provide a valid zip.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">City</label>
                         
                          <input type="text" class="form-control" name="city" required />
                          <div class="invalid-feedback">Please select a valid state.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">State</label>
                         
                          <input type="text" class="form-control" name="state" required />
                          <div class="invalid-feedback">Please select a valid state.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">Postal_code</label>
                         
                          <input type="text" class="form-control" name="postal_code" required />
                          <div class="invalid-feedback">Please select a valid state.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">Country</label>
                         
                          <input type="text" class="form-control" name="country" required />
                          <div class="invalid-feedback">Please select a valid state</div>
                        </div>
                        <!--end::Col-->
                      
  <!-- Latitude -->
            <div class="col-md-6">
                <label class="form-label">Latitude</label>
                <input type="number" step="0.000001" name="latitude" class="form-control" required>
            </div>

            <!-- Longitude -->
            <div class="col-md-6">
                <label class="form-label">Longitude</label>
                <input type="number" step="0.000001" name="longitude" class="form-control" required>
            </div>

            <!-- Is Default -->
            <div class="col-md-6 mt-4">
                <input type="hidden" name="is_default" value="0">
                <input type="checkbox" name="is_default" value="1">
                <label class="form-label">Set as Default</label>
            </div>

                      </div>
</section>
       {{--=============Rider_profile==============--}}
            <section id="rider_section" class="d-none">
               <div class="row g-3 mt-5">
             <h3>Rider Profile</h3>
                        <!--begin::Col-->
                        {{-- <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">User_id</label>
                          
                          <input type="number" class="form-control" name="user_id" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div> --}}
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Vehicle Type</label>
                          
                          <input type="text" class="form-control" name="vehicle_type" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Vehicle Number</label>
                          
                          <input type="text" class="form-control" name="vehicle_number" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom02" class="form-label">License Number</label>
                          
                          <input type="text" class="form-control" name="license_Number" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom02" class="form-label">Is_available</label>
                              <select name="is_available" class="form-control">
                           <option value="1">Yes</option>
                           <option value="0">No</option>
                       </select>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                      <!--begin::Col-->
                        <div class="col-md-6">
                        <input type="checkbox" id="is" name="is_verified" value="1">
                        <label for="status" for="is" class="form-label">Is_Verified</label>
                        </div>
                    <!--end::Body-->
                      </div>
             </section>



      

                     
                    <!--end::Body-->
                    </div>
                    <!--begin::Footer-->
                    <div class="card-footer mt-5">
                      <button class="btn btn-info" type="submit">Submit form</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->
@endsection
