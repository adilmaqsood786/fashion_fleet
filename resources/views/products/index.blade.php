


@extends('admin_penal.master')
@section('content')
 
        
  <!-- /.card --> 
        
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Product Detail</h3>
                    <div class=" d-flex justify-content-end align-items-center">
                    <a href="{{route('productCreate')}}" class="btn btn-info">New</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                      
                  <div class="card-body p-0 table-responsive">
                    <table class="table table-sm">
                      <thead>
                        <tr>
                            <th>ID</th>
                          <th>Vender</th>
                          <th>Categroy</th>
                          <th>Name</th>
                          <th>Slug</th>
                          <th>Short description</th>
                          <th>Description</th>
                          <th>SKU</th>
                          <th>Price</th>
                          <th>Sale Price</th>
                          <th>Stock</th>
                          <th>Sale Image</th>
                          <th>Active</th>
                          <th>Featured</th>
                          <th>Edit</th>
                          <th>Delete</th>

                        </tr>
                      </thead>
                  @foreach ($product as $pro )
                      <tbody>
                        <tr class="align-middle">
                         <td>{{ $pro->id}}</td>
                         <td>{{ $pro->vendor->store_name}}</td>
                         <td>{{ $pro->categories->name}}</td>
                         <td>{{ $pro->name}}</td>
                         <td>{{ $pro->slug}}</td>
                         <td>{{ $pro->short_description}}</td>
                         <td>{{ $pro->description}}</td>
                         <td>{{ $pro->sku}}</td>
                         <td>{{ $pro->price}}</td>
                         <td>{{ $pro->sale_price}}</td>
                         <td>{{ $pro->stock}}</td>
                         <td><img src="{{ asset('storage/'.$pro->main_image) }}" width="100" height="100"></td>
                         <td>{{ $pro->is_active}}</td>
                         <td>{{ $pro->is_featured}}</td>




                          <td><a href="{{route('productEdit',['edit_id'=>$pro['id']])}}" class="btn btn-outline-primary">Edit</a></td>
                          <td><a href="{{route('productDelete',['delete_id'=>$pro['id']])}}" class="btn btn-outline-danger">Delete</a></td>
                        </tr>
                      </tbody>
                  @endforeach

                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>

@endsection
















                