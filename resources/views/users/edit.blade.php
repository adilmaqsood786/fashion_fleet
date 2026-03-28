@extends('admin_penal.master')
@section('content')
 

         <div class="card-header">
                    <div class="card-title">Form Validation</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{route('userUpdate',['update_id'=>$userRecord['id']])}}" method="post" class="needs-validation" novalidate>
                    <!--begin::Body-->
                    @csrf
                    <div class="card-body">
                      <!--begin::Row-->
                      <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">First name</label>
                         
                          <input type="text" class="form-control"  value="{{isset($userRecord['first_name'])?$userRecord['first_name']:""}}" name="first_name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom02" class="form-label">Last name</label>
                       
                          <input type="text" class="form-control"  value="{{isset($userRecord['last_name'])?$userRecord['last_name']:""}}" name="last_name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Father name</label>
                          <div class="input-group has-validation">
                            
                            <input type="text" class="form-control" value="{{isset($userRecord['father_name'])?$userRecord['father_name']:""}}" name="father_name" required />
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">Email</label>
                         
                          <input type="email" class="form-control" value="{{isset($userRecord['email'])?$userRecord['email']:""}}" name="email" required />
                          <div class="invalid-feedback">Please provide a valid city.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">Phone no.</label>
                         
                          <input type="number" class="form-control" value="{{isset($userRecord['phone'])?$userRecord['phone']:""}}" name="phone" required />
                          <div class="invalid-feedback">Please select a valid state.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom05" class="form-label">Address</label>
                        
                          <input type="text" class="form-control" value="{{isset($userRecord['address'])?$userRecord['address']:""}}" name="address" required />
                          <div class="invalid-feedback">Please provide a valid zip.</div>
                        </div>
                        <!--end::Col-->

                      <!--end::Row-->
                    </div>
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer mt-5">
                      <button class="btn btn-info" type="submit">Update Record</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->

@endsection