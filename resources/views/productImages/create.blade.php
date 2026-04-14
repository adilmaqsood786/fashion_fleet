
@extends('admin_penal.master')
@section('content')
                  <div class="card-header">
    <div class="card-title"><h3>Product Image Details</h3></div>
</div>
{{-- @if($errors->any())
@foreach ($errors->all() as $error)
  {{$error 
  }}
@endforeach
@endif --}}
{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
<form action="{{route('imageStore')}}" method="post" class="needs-validation"  enctype="multipart/form-data" novalidate>
    @csrf
    <div class="card-body">
        <div class="row g-3">
                

            <!-- User ID -->
            <div class="col-md-6">
                <label class="form-label">Product</label>
                {{-- <input type="number" class="form-control" name="user_id" value="{{old('user_id')}}" required /><br> --}}
                <select name="product_id" value="{{old('product_id')}}"  id="name" class="form-control form-select">
                    <option value="select" > Select</option>
                  
                    @foreach ($product as $pro )

                         <option value="{{$pro->id}}">{{$pro->name}}</option>
                              
              
                    @endforeach
                
                </select>
              
                    {{-- <span style="color: red">@error('product_id')
                     {{$message}}
                    @enderror
                  </span> --}}

    
                  
                <div class="valid-feedback">Looks good!</div>
            </div>

            <!-- Vehicle Type -->
            <div class="col-md-6">
                <label class="form-label">Image</label>
                <input type="file" class="form-control"  name="image_path" required />
                <span style="color: red">
                  @error('image')
                   {{$message}}
                @enderror
                </span>
                <div class="valid-feedback">Looks good!</div>
            </div>

            <!-- Vehicle Number -->
            <div class="col-md-6">
                <label class="form-label">Sort Order</label>
                <input type="number" class="form-control" name="sort_order" value="{{old('sort_order')}}"  required />
                <div class="valid-feedback">Looks good!</div>
                 <span style="color: red">
                  @error('sort_order')
                   {{$message}}
                @enderror
                </span>
            </div>

        </div>
    </div>

    <div class="card-footer mt-5">
        <button class="btn btn-info" type="submit">Submit Form</button>
    </div>
</form>


@endsection
