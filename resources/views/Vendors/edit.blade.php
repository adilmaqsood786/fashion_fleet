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
                          <label for="validationCustom01" class="form-label">Company Name</label>
                          
                          <input type="text" class="form-control" value="{{isset($brandRecord['company_name'])?$brandRecord['company_name']:""}}"name="company_name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">First Name</label>
                          
                          <input type="text" class="form-control" value="{{isset($brandRecord['first_name'])?$brandRecord['first_name']:""}}" name="first_name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Last Name</label>
                          
                          <input type="text" class="form-control" value="{{isset($brandRecord['last_name'])?$brandRecord['last_name']:""}}" name="last_name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col--> <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Father Name</label>
                          
                          <input type="text" class="form-control" value="{{isset($brandRecord['father_name'])?$brandRecord['father_name']:""}}" name="father_name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                         <div class="col-md-6">
                           <label class="form-label">Slug</label>
                         
                           <select name="slug" class="form-select" required>
                               <option value="">Select Category</option>
                               <option value="men" {{ isset($brandRecord['slug'])?$brandRecord['slug']: '' }}>Men</option>
                               <option value="women" {{ isset($brandRecord['slug'])?$brandRecord['slug'] : '' }}>Women</option>
                           </select>
                         
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
                        
                          <input type="file" class="form-control" value="{{isset($brandRecord['logo'])?$brandRecord['logo']:""}}" name="logo" required />
                          <div class="invalid-feedback">Please provide a valid city.</div>
                        </div>
                        <!--end::Col-->
                        
                          <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Email Address</label>
                          
                          <input type="text" class="form-control" value="{{isset($brandRecord['email'])?$brandRecord['email']:""}}" name="email" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Contact Number</label>
                          
                          <input type="text" class="form-control" value="{{isset($brandRecord['contact_number'])?$brandRecord['contact_number']:""}}" name="contact_number" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Document</label>
                          
                          <input type="text" class="form-control" value="{{isset($brandRecord['licenses'])?$brandRecord['licenses']:""}}" name="licenses" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Address</label>
                          
                          <input type="text" class="form-control" value="{{isset($brandRecord['address'])?$brandRecord['address']:""}}" name="address" required />
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
                          
                          <input type="text" class="form-control" value="{{isset($brandRecord['bank_name'])?$brandRecord['bank_name']:""}}" name="bank_name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col--> <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Account Number</label>
                          
                          <input type="text" class="form-control" value="{{isset($brandRecord['account_number'])?$brandRecord['account_number']:""}}" name="account_number" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Account Title</label>
                          
                          <input type="text" class="form-control" value="{{isset($brandRecord['account_title'])?$brandRecord['account_title']:""}}" name="account_title" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Iban</label>
                          
                          <input type="text" class="form-control" value="{{isset($brandRecord['iban'])?$brandRecord['iban']:""}}" name="iban" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Payment Method</label>
                          
                          <input type="text" class="form-control" value="{{isset($brandRecord['payment_method'])?$brandRecord['payment_method']:""}}" name="payment_method" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                           
                         <!--begin::Col-->
                          <div class="col-md-6">
                            <label class="form-label">Status</label>
                          
                            <select name="status" class="form-select" required>
                                <option value="">Select Category</option>
                                <option value="men" {{ isset($brandRecord['status'])?$brandRecord['status']: '' }}>Active</option>
                                <option value="women" {{ isset($brandRecord['status'])?$brandRecord['status'] : '' }}>Inactive</option>
                            </select>
                          
                            <div class="invalid-feedback">Please select a valid category.</div>
                          </div>
                          <!--end::Col-->


                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Is_Verified</label>
                          
                          <input type="text" class="form-control" value="{{isset($brandRecord['is_verified'])?$brandRecord['is_verified']:""}}" name="is_verified" required />
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


