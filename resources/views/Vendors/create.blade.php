@extends('admin_penal.master')
@section('content')

 


 <div class="card-header">
                    <h3>Owner detaile :</h3>
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
                          <label for="validationCustom01" class="form-label">Company Name</label>
                          
                          <input type="text" class="form-control" name="company_name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">First Name</label>
                          
                          <input type="text" class="form-control" name="first_name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Last Name</label>
                          
                          <input type="text" class="form-control" name="last_name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col--> <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Father Name</label>
                          
                          <input type="text" class="form-control" name="father_name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                                                <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="slug" class="form-label">Slug</label>
                        
                          <select name="slug" class="form-control" required>
                              <option value="">Select Category</option>
                              <option value="men">Men</option>
                              <option value="women">Women</option>
                          </select>
                        
                          <div class="valid-feedback">Looks good!</div>
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
                          <label for="validationCustom03" class="form-label">Logo</label>
                        
                          <input type="file" class="form-control" name="logo" required />
                          <div class="invalid-feedback">Please provide a valid city.</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Email Address</label>
                          
                          <input type="text" class="form-control" name="email" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Contact Number</label>
                          
                          <input type="text" class="form-control" name="contact_number" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Document</label>
                          
                          <input type="text" class="form-control" name="licenses" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Address</label>
                          
                          <input type="text" class="form-control" name="address" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col--> 
                        
                        {{--========Brand Payment details:========--}}
                          <div>
                            <div class="h3">Brand Payment details:</div>
                          </div>
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Bank Name</label>
                          
                          <input type="text" class="form-control" name="bank_name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col--> <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Account Number</label>
                          
                          <input type="text" class="form-control" name="account_number" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Account Title</label>
                          
                          <input type="text" class="form-control" name="account_title" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Iban</label>
                          
                          <input type="text" class="form-control" name="iban" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Payment Method</label>
                          
                          <input type="text" class="form-control" name="payment_method" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                       <!--begin::Col-->
                <div class="col-md-6">
                  <label for="status" class="form-label">Status</label>
                
                  <select name="status" class="form-select" required>
                      <option value="">Select Status</option>
                      <option value="active">Active</option>
                      <option value="inactive">Inactive</option>
                  </select>
                
                  <div class="invalid-feedback">Please select a valid status.</div>
                </div>
                   <!--end::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Is_Verified</label>
                          
                          <input type="text" class="form-control" name="is_verified" required />
                          <div class="valid-feedback">Looks good!</div>
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

