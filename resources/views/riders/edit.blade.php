<div>
    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
</div>

@extends('admin_penal.master')
@section('content')

                  <div class="card-header">
    <div class="card-title"><h3>Edit Rider</h3></div>
</div>

<form action="{{ route('riderUpdate',['update_id'=>$riderRecord['id']]) }}" method="post" class="needs-validation" novalidate>
    @csrf
    <div class="card-body">
        <div class="row g-3">
            <!-- User ID -->
            <div class="col-md-6">
                <label class="form-label">User ID</label>
                <input type="number" class="form-control" value="{{isset($riderRecord['user_id'])?$riderRecord['user_id']:""}}" name="user_id" required />
                <div class="valid-feedback">Looks good!</div>
            </div>

            <!-- Vehicle Type -->
            <div class="col-md-6">
                <label class="form-label">Vehicle Type</label>
                <input type="text" class="form-control" value="{{isset($riderRecord['vehicle_type'])?$riderRecord['vehicle_type']:""}}" name="vehicle_type" required />
                <div class="valid-feedback">Looks good!</div>
            </div>

            <!-- Vehicle Number -->
            <div class="col-md-6">
                <label class="form-label">Vehicle Number</label>
                <input type="text" class="form-control" value="{{isset($riderRecord['vehicle_number'])?$riderRecord['vehicle_number']:""}}" name="vehicle_number" required />
                <div class="valid-feedback">Looks good!</div>
            </div>

            <!-- License Number -->
            <div class="col-md-6">
                <label class="form-label">License Number</label>
                <input type="text" class="form-control" name="license_number" value="{{isset($riderRecord['license_number'])?$riderRecord['license_number']:""}}" required />
                <div class="valid-feedback">Looks good!</div>
            </div>

            <!-- Is Available -->
            <div class="col-md-6">
                <label class="form-label">Is Available</label>
                <select name="is_available" class="form-control" value="{{isset($riderRecord['is_available'])?$riderRecord['is_available']:""}}" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                <div class="valid-feedback">Looks good!</div>
            </div>

            <!-- Is Verified -->
            <div class="col-md-6 mt-4">
                <input type="hidden" name="is_verified" value="0">
                <input type="checkbox" id="is" name="is_verified" value="{{isset($riderRecord['is_verified'])?$riderRecord['is_verified']:""}}" value="1">
                <label for="is" class="form-label">Is Verified</label>
            </div>

      {{--===========user_form===========--}}
        <section>
          <h3>
            User
          </h3>
                      <!--begin::Row-->
                      <div class="row g-3">

                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Name</label>
                          
                          <input type="text" class="form-control" value="{{isset($riderRecord->user->name)?$riderRecord->user->name:""}}" name="name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom02" class="form-label">Email</label>
                          
                          <input type="email" class="form-control" value="{{isset($riderRecord->user->email)?$riderRecord->user->email:""}}" name="email" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Phone Number</label>
                          <div class="input-group has-validation">
                           
                            <input type="numeric" class="form-control" name="userPhone" value="{{isset($riderRecord->user->userPhone)?$riderRecord->user->userPhone:""}}" required />
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














        </div>
    </div>

    <div class="card-footer mt-5">
        <button class="btn btn-info" type="submit">Submit Form</button>
    </div>
</form>


@endsection
