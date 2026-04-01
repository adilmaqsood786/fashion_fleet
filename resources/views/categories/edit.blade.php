@extends('admin_penal.master')
@section('content')
 <div class="card-header">
                    <div class="card-title">New created Reccord</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{route('categoryUpdate',['update_id'=>$categoryRecord['id']])}}" method="post" class="needs-validation" novalidate>
                    <!--begin::Body-->
                    @csrf
                    <div class="card-body">
                      <!--begin::Row-->
                      <div class="row g-3">
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Name</label>
                          
                          <input type="text" class="form-control" value="{{isset($categoryRecord['name'])?$categoryRecord['name']:""}}" name="name" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Slug</label>
                          
                          <input type="text" class="form-control" value="{{isset($categoryRecord['slug'])?$categoryRecord['slug']:""}}" name="slug" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">Image</label>
                        
                          <input type="file" class="form-control" value="{{isset($brandRecord['image'])?$brandRecord['image']:""}}" name="image" required />
                          <div class="invalid-feedback">Please provide a valid city.</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom02" class="form-label">Parent_id</label>
                          
                          <input type="text" class="form-control" value="{{isset($categoryRecord['parent_id'])?$categoryRecord['parent_id']:""}}" name="parent_id" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                       
                      <!--begin::Col-->
                          <div class="col-md-6">
                            <input type="checkbox" id="is" value="{{isset($categoryRecord['is_active'])?$categoryRecord['is_active']:""}}" name="is_active" value="1">
                            <label class="form-label" for="is">Is_active</label>
                       
                            <div class="invalid-feedback">Please select a valid category.</div>
                          </div>
                          <!--end::Col-->
                    <!--begin::Footer-->
                    <div class="card-footer mt-5">
                      <button class="btn btn-info" type="submit">Submit form</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->


@endsection