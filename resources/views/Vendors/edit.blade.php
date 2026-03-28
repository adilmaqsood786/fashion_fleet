@extends('admin_penal.master')
@section('content')

 


 <div class="card-header">
                    <div class="card-title">Form Validation</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{route('vendorUpdate',['update_id'=>$brandRecord['id']])}}" method="post" class="needs-validation" novalidate>
                    <!--begin::Body-->
                    @csrf
                    <div class="card-body">
                      <!--begin::Row-->
                      <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Name</label>
                          
                          <input type="text" class="form-control" value="{{isset($brandRecord['name'])?$brandRecord['name']:""}}" name="name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom02" class="form-label">Slug</label>
                          
                          <input type="text" class="form-control" value="{{isset($brandRecord['slug'])?$brandRecord['slug']:""}}" name="slug" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Description</label>
                          <div class="input-group has-validation">
                           
                            <input type="text" class="form-control" value="{{isset($brandRecord['description'])?$brandRecord['description']:""}}" name="description" required />
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">Logo</label>
                        
                          <input type="email" class="form-control" value="{{isset($brandRecord['logo'])?$brandRecord['logo']:""}}" name="logo" required />
                          <div class="invalid-feedback">Please provide a valid city.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom04" class="form-label">Status</label>
                         
                          <input type="text" class="form-control" value="{{isset($brandRecord['status'])?$brandRecord['status']:""}}" name="status" required />
                          <div class="invalid-feedback">Please select a valid state.</div>
                        </div>
                        <!--end::Col-->
                        {{-- <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom05" class="form-label">Address</label>
                         
                          <input type="text" class="form-control" name="address" required />
                          <div class="invalid-feedback">Please provide a valid zip.</div>
                        </div>
                        
                            <label class="form-check-label" for="invalidCheck">
                              Agree to terms and conditions
                            </label>
                            <div class="invalid-feedback">You must agree before submitting.</div>
                          </div>
                        </div> 
                        <!--end::Col-->
                      </div> --}}
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


