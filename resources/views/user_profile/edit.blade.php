@extends('admin_penal.master')
@section('content')
 <div class="card-header">
                    <div class="card-title"><h3>Address</h3></div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{route('profileUpdate',['update_id'=>$userProfile['id']])}}" method="post" class="needs-validation" novalidate>
                    <!--begin::Body-->
                    @csrf
                    <div class="card-body">
                      <!--begin::Row-->
                      <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">User_id</label>
                          
                          <input type="number" class="form-control" value="{{isset($userProfile->user_id)?$userProfile->user_id:""}}"  name="user_id" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom02" class="form-label">Label</label>
                          
                          <input type="text" class="form-control" name="label"  value="{{isset($userProfile->label)?$userProfile->label:""}}" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Full Name</label>
                          <div class="input-group has-validation">
                           
                            <input type="text" class="form-control" name="full_name"  value="{{isset($userProfile->full_name)?$userProfile->full_name:""}}" required />
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">Phone Number</label>
                        
                          <input type="number" class="form-control" name="phone"  value="{{isset($userProfile->phone)?$userProfile->phone:""}}" required />
                          <div class="invalid-feedback">Please provide a valid city.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">Address line 1</label>
                         
                          <input type="text" class="form-control" name="address_line_1"  value="{{isset($userProfile->address_line_1)?$userProfile->address_line_1:""}}" required />
                          <div class="invalid-feedback">Please select a valid state.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom05" class="form-label">Address line 2</label>
                         
                          <input type="text" class="form-control" name="address_line_2" value="{{isset($userProfile->address_line_2)?$userProfile->address_line_2:""}}" required />
                          <div class="invalid-feedback">Please provide a valid zip.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">City</label>
                         
                          <input type="text" class="form-control" name="city" value="{{isset($userProfile->city)?$userProfile->city:""}}" required />
                          <div class="invalid-feedback">Please select a valid state.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">State</label>
                         
                          <input type="text" class="form-control" name="state" value="{{isset($userProfile->state)?$userProfile->state:""}}" required />
                          <div class="invalid-feedback">Please select a valid state.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">Postal_code</label>
                         
                          <input type="text" class="form-control" name="postal_code" value="{{isset($userProfile->postal_code)?$userProfile->postal_code:""}}" required />
                          <div class="invalid-feedback">Please select a valid state.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">Country</label>
                         
                          <input type="text" class="form-control" name="country" value="{{isset($userProfile->country)?$userProfile->country:""}}" required />
                          <div class="invalid-feedback">Please select a valid state</div>
                        </div>
                        <!--end::Col-->
                      
  <!-- Latitude -->
            <div class="col-md-6">
                <label class="form-label">Latitude</label>
                <input type="number" step="0.000001" name="latitude" class="form-control" value="{{isset($userProfile->latitude)?$userProfile->latitude:""}}" required>
            </div>

            <!-- Longitude -->
            <div class="col-md-6">
                <label class="form-label">Longitude</label>
                <input type="number" step="0.000001" name="longitude" class="form-control" value="{{isset($userProfile->longitude)?$userProfile->longitude:""}}" required>
            </div>

            <!-- Is Default -->
            <div class="col-md-6 mt-4">
                <input type="hidden" name="is_default" value="0">
                <input type="checkbox" name="is_default" value="{{isset($userProfile->is_default)?$userProfile->is_default:""}}" value="1">
                <label class="form-label">Set as Default</label>
            </div>

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