@extends('admin_penal.master')
@section('content')
 <div class="card-header">
                    <h3>Owner detaile :</h3>
                  </div>
                  <!--end::Header-->
                  <!--begin::Form-->
                  <form action="{{route('productStore')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <!--begin::Body-->
                    @csrf
                    <div class="card-body">
                      <!--begin::Row-->
                      <div class="row g-3">
                         <!--begin::Col-->
                        <div class="col-md-6">
                          
                          <label for="validationCustom01" class="form-label">Vendor Name</label>
                          
                          {{-- <input type="number" class="form-control" name="vendor_id" value="{{old('vendor_id')}}"  required /> --}}
                            <select name="vendor_id" id="id" class="form-controls form-select">
                              @foreach ($vendors as $vendor)
                                 <option value="{{$vendor->id}}">{{$vendor->store_name}}</option>

                              @endforeach
                            </select>
                          <span style="color: red">
                            @error('vendor_id')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          
                          <label for="validationCustom01" class="form-label">Category Name</label>
                          
                          {{-- <input type="number" class="form-control" name="category_id" value="{{old('category_id')}}"  required /> --}}
                          <select name="vendor_id" id="id" class="form-controls form-select">
                              @foreach ($categories as $category)
                                 <option value="{{$category->id}}">{{$category->name}}</option>

                              @endforeach
                            </select>
                          <span style="color: red">
                            @error('category_id')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6">

                          <label for="validationCustom01" class="form-label">Name</label>
                          
                          <input type="text" class="form-control" value="{{old('name')}}" name="name" required />
                          <span style="color: red">
                            @error('name')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                      
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="slug" class="form-label">Slug</label>
                        
                          <select name="slug" class="form-select form-control"  required>
                              <option value="iPhone">iPhone</option>
                              <option value="Android">Android</option>
                          </select>
                        {{-- <span style="color: red">
                            @error('slug')
                                {{$message}}
                            @enderror
                          </span> --}}
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                       
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">Short description</label>
                        
                          <input type="text" class="form-control" value="{{old('short_description')}}" name="short_description" required />
                          <span style="color: red">
                            @error('short_description')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="invalid-feedback">Please provide a valid city.</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Description</label>
                          <div class="input-group has-validation">
                           
                            <input type="text" class="form-control" value="{{old('description')}}" name="description" required />
                            
                            <div class="invalid-feedback">Please choose a username.</div>
                            
                          </div>
                          <span style="color: red">
                            @error('description')
                                {{$message}}
                            @enderror
                          </span>
                        </div>
                        <!--end::Col-->
                        
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">SKU</label>
                          
                          <input type="text" class="form-control" value="{{old('sku')}}" name="sku" required />
                          <span style="color: red">
                            @error('sku')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col--> 
                        
                       
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Price</label>
                          
                          <input type="number" class="form-control" value="{{old('price')}}" name="price" required />
                          <span style="color: red">
                            @error('price')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col--> <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Sale Price</label>
                          
                          <input type="number" class="form-control" name="sale_price" value="{{old('sale_price')}}" required />
                          <span style="color: red">
                            @error('sale_price')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Stock</label>
                          
                          <input type="text" class="form-control" value="{{old('stock')}}" name="stock" required />
                          <span style="color: red">
                            @error('stock')
                                {{$message}}
                            @enderror
                          </span>
                          <div class="valid-feedback">Looks good!</div>

                        </div>
    
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Main Image</label>
                          
                          <input type="file" value="{{old('main_image')}}" class="form-control" name="main_image" required />
                          <div class="valid-feedback">Looks good!</div>
                          <span style="color: red">
                            @error('main_image')
                                {{$message}}
                            @enderror
                          </span>
                        </div>
                        <!--end::Col-->
                      
                        <!-- Is Active Dropdown -->
                    <div class="form-group col-md-6">
                        <label for="is_active" class="form-label">Is Active</label>
                        <select name="is_active" id="is_active" class="form-select">
                            <option value="1" {{ old('is_active', $item->is_active ?? false) ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active', $item->is_active ?? false) ? '' : 'selected' }}>Inactive</option>
                        </select>
                        <span style="color: red">
                            @error('is_active')
                                {{$message}}
                            @enderror
                          </span>
                    </div>
                    
                    <!-- Is Featured Dropdown -->
                    <div class="form-group col-md-6">
                        <label for="is_featured" class="form-label">Is Featured</label>
                        <select name="is_featured" id="is_featured" class="form-select">
                            <option value="1" {{ old('is_featured', $item->is_featured ?? false) ? 'selected' : '' }}>Featured</option>
                            <option value="0" {{ old('is_featured', $item->is_featured ?? false) ? '' : 'selected' }}>Regular</option>
                        </select>
                        <span style="color: red">
                            @error('is_featured')
                                {{$message}}
                            @enderror
                          </span>
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

