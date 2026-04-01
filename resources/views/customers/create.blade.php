@extends('admin_penal.master')
@section('content')
 <div class="card-header">
                    <div class="card-title"><h3>New Customer</h3></div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{route('customerStore')}}" method="post" class="needs-validation" novalidate>
                    <!--begin::Body-->
                    @csrf
                    <div class="card-body">
                      <!--begin::Row-->
                      <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">First name</label>
                          
                          <input type="text" class="form-control" name="first_name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom02" class="form-label">Last name</label>
                          
                          <input type="text" class="form-control" name="last_name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Father name</label>
                          <div class="input-group has-validation">
                           
                            <input type="text" class="form-control" name="father_name" required />
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">Email</label>
                        
                          <input type="email" class="form-control" name="email" required />
                          <div class="invalid-feedback">Please provide a valid city.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">Phone no.</label>
                         
                          <input type="number" class="form-control" name="phone" required />
                          <div class="invalid-feedback">Please select a valid state.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom05" class="form-label">Address</label>
                         
                          <input type="text" class="form-control" name="address" required />
                          <div class="invalid-feedback">Please provide a valid zip.</div>
                        
                        </div> 

              {{--===========User_form==============--}}
                       


 {{--===========User_form============--}}


                       <h3>User</h3>
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
                           
                            <input type="numeric" class="form-control" name="phone" required />
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="vender">Vender</option>
                            <option value="admin">Admin</option>
                            <option value="customer">Customer</option>
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
                         </div>
                     
                 
                      <!--end::Row-->
{{--==========User_address=============--}}
               <h3>User Address</h3>
<!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">User_id</label>
                          
                          <input type="number" class="form-control" name="user_id" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom02" class="form-label">Label</label>
                          
                          <input type="text" class="form-control" name="label" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
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
                      </div>















                       

                      <!--end::Row-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer mt-5">
                      <button class="btn btn-info" type="submit">Submit form</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->


@endsection