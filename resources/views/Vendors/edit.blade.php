@extends('admin_penal.master')
@section('content')

 


 <div class="card-header">
                    <h3>Owner detaile :</h3>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{route('vendorUpdate',['update_id'=>$vendorRecord['id']])}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <!--begin::Body-->
                    @csrf
                    <div class="card-body">
                      <!--begin::Row-->
                      <div class="row g-3">
                         <!--begin::Col-->
                        <div class="col-md-6">
                          
                          <label for="validationCustom01" class="form-label">User Id</label>
                          
                          <input type="text" class="form-control" name="user_id" value="{{isset($vendorRecord['user_id'])?$vendorRecord['user_id']:""}}" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">

                          <label for="validationCustom01" class="form-label">Store Name</label>
                          
                          <input type="text" class="form-control" name="store_name" value="{{isset($vendorRecord['store_name'])?$vendorRecord['store_name']:""}}" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                      
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="slug" class="form-label">Store Slug</label>
                        
                          <select name="store_slug" class="form-control" value="{{isset($vendorRecord['store_slug'])?$vendorRecord['store_slug']:""}}" required>
                              <option value="men">Men</option>
                              <option value="women">Women</option>
                          </select>
                        
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                       
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">Logo</label>
                        
                          <input type="file" class="form-control" name="logo" value="{{isset($vendorRecord['logo'])?$vendorRecord['logo']:""}}" required />
                          <div class="invalid-feedback">Please provide a valid city.</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Description</label>
                          <div class="input-group has-validation">
                           
                            <input type="text" class="form-control" name="description" value="{{isset($vendorRecord['description'])?$vendorRecord['description']:""}}" required />
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>
                        </div>
                        <!--end::Col-->
                        
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Address</label>
                          
                          <input type="text" class="form-control" name="address" value="{{isset($vendorRecord['address'])?$vendorRecord['address']:""}}" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col--> 
                        
                       
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">City</label>
                          
                          <input type="text" class="form-control" value="{{isset($vendorRecord['city'])?$vendorRecord['city']:""}}" name="city" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col--> <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Country</label>
                          
                          <input type="text" class="form-control" name="country" value="{{isset($vendorRecord['country'])?$vendorRecord['country']:""}}" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Commission rate</label>
                          
                          <input type="text" class="form-control" name="commission_rate" value="{{isset($vendorRecord['commission_rate'])?$vendorRecord['commission_rate']:""}}" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!-- Is Approved -->
            <div class="col-md-6">
                <label class="form-label">Is Approved</label>
                <select name="is_approved" class="form-control" value="{{isset($vendorRecord['is_approved'])?$vendorRecord['is_approved']:""}}" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <!-- Is Active -->
            <div class="col-md-6 mt-4">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" value="{{isset($vendorRecord['is_active'])?$vendorRecord['is_active']:""}}" checked>
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
                          
                          <input type="text" class="form-control" name="name" value="{{isset($vendorRecord->user->name)?$vendorRecord->user->name:""}}" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom02" class="form-label">Email</label>
                          
                          <input type="email" class="form-control" name="email" value="{{isset($vendorRecord->user->email)?$vendorRecord->user->email:""}}" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Phone Number</label>
                          <div class="input-group has-validation">
                           
                            <input type="numeric" class="form-control" name="phone" value="{{isset($vendorRecord->user->phone)?$vendorRecord->user->phone:""}}" required />
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">Role</label>
                        <select name="role" id="role"class="form-select" required>
                             <option value="customer" value="{{isset($riderRecord->user->role)?$riderRecord->user->role:""}}">Customer</option>
                             <option value="vendor" value="{{isset($riderRecord->user->role)?$riderRecord->user->role:""}}">Vendor</option>
                             <option value="rider" value="{{isset($riderRecord->user->role)?$riderRecord->user->role:""}}">Rider</option>
                          </select>
                        </div>
                        <!--end::Col-->
                          <!--begin::Col-->
                         <div class="col-md-6">
                           <label for="status" class="form-label">Status</label>
                         
                           <select name="status" class="form-select"  required>
                               <option value="active" value="{{$riderRecord->user->status??""}}">Active</option>
                               <option value="inactive" value="{{$riderRecord->user->status??""}}">Inactive</option>
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

