@extends('admin_penal.master')
@section('content')
 <div class="card-header">
                    <div class="card-title">New category</div>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{route('categoryStore')}}" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                    <!--begin::Body-->
                    @csrf
                    <div class="card-body">
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
                          <label for="validationCustom01" class="form-label">Slug</label>
                          
                          <input type="text" class="form-control" name="slug" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Image</label>
                          
                          <input type="file" class="form-control" name="image" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom02" class="form-label">Main Category</label>
                          
                        
                         <select name="parent_id" class="form-control form-select">
                                    <option value="">None</option>

                                    @foreach ($categories as $cate)
                                        @if (empty($cate->parent_id))
                                            <option value="{{ $cate->id }}" {{ old('parent_id') == $cate->id ? 'selected' : '' }}>
                                                {{ $cate->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                       
                      <!--begin::Col-->
                <div class="col-md-6">
                <input type="checkbox" id="is" name="is_active" value="1">
                  <label for="status" for="is" class="form-label">Is_active</label>
                
                    <!--end::Body-->
                    <!--begin::Footer-->
                    <div class="card-footer mt-5">
                      <button class="btn btn-info" type="submit">Submit form</button>
                    </div>
                    <!--end::Footer-->
                  </form>
                  <!--end::Form-->


@endsection