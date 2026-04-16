@extends('admin_penal.master')
@section('content')

 


 <div class="card-header">
                    <h3>New vendor :</h3>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{route("vendorStore")}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <!--begin::Body-->
                    @csrf
                    <div class="card-body">
                      <!--begin::Row-->
                      <div class="row g-3">
                         <!--begin::Col-->
                        <div class="col-md-6">
                          
                          <label for="validationCustom01" class="form-label">User</label>
                          
                          {{-- <input type="text" class="form-control" name="user_id"  required /> --}}
                          <select name="user_id" class="form-control form-select" id="">
                                  @foreach ($users as $user )
                            <option value="{{$user->id}}">{{$user->name}}</option>
                                    
                                  @endforeach
                          </select>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
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
                        
                          <select name="store_slug" class="form-control" required>
                              <option value="men">Men</option>
                              <option value="women">Women</option>
                          </select>
                        
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


                  
                    
          {{--===========User_form============--}}

<section>
  <h3>user</h3>
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
                           
                            <input type="numeric" class="form-control" name="phone" required />
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>
                        </div>
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
                  
                   <!--end::Row-->
                    </div>
                  
                  </section>
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

