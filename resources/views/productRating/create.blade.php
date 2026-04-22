


@extends('admin_penal.master')
@section('content')

                  <div class="card-header">
    <div class="card-title"><h3>New Product Rating</h3></div>
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
<form action="{{route('ratingStore')}}" method="post" class="needs-validation" novalidate>
    @csrf
    <div class="card-body">
        <div class="row g-3">
                

     <!-- User ID -->
     <div class="col-md-6">
         <!-- Product -->
    <label>Product</label>
    <select name="product_id" class="form-control form-select "  required>
        @foreach($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
        @endforeach
    </select>

    <div class="valid-feedback">Looks good!</div>
    </div>

    <!-- Vehicle Type -->
    <div class="col-md-6">
      <!-- Order -->
    <label>Order</label>
    <select name="order_id" class="form-control form-select "  required>
        @foreach($orders as $order)
            <option value="{{ $order->id }}">Order #{{ $order->id }}</option>
        @endforeach
    </select>
    <div class="valid-feedback">Looks good!</div>
    </div>

     <!-- Vehicle Number -->
     <div class="col-md-6">
     <label>User</label>
    <select name="user_id"  class="form-control form-select " required>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>
            </div>

    <!-- License Number -->
    <div class="col-md-6">
       <label>Rating</label>
         
         <div id="star-rating">
             <span class="star" data-value="1">★</span>
             <span class="star" data-value="2">★</span>
             <span class="star" data-value="3">★</span>
             <span class="star" data-value="4">★</span>
             <span class="star" data-value="5">★</span>
         </div>

          <input type="hidden" name="rating" value="{{old('rating')}}" id="rating-value" >
               <span style="color: red">
          @error('rating')
                   {{$message}}
                @enderror
               </span>
            </div>

            <!-- Is Available -->
            <div class="col-md-6">
              <label>Title</label>
                   <input type="text" name="title" class="form-control" >
               <span style="color: red">
          
                 @error('title')
                   {{$message}}
                @enderror
               </span>
                <div class="valid-feedback">Looks good!</div>
            </div>

            <!-- Is Verified -->
            <div class="col-md-6 mt-4">
               <label>Review</label>
                  <textarea name="review" class="form-control "></textarea>
               <span style="color: red">
                  @error('review')
                   {{$message}}
                @enderror
                </span>
            </div>
            <div class="col-md-6 mt-4">

             <label>Approved</label>
                  <select name="is_approved" class="form-control form-select">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                    </select>
               </div>
      
        </div>
    </div>

    <div class="card-footer mt-5">
        <button class="btn btn-info" type="submit">Submit Form</button>
    </div>
</form>





{{-- //css and jquery --}}
<style id="fjdlke">
#star-rating .star {
    font-size: 30px;
    color: #ccc;
    cursor: pointer;
}

#star-rating .star.active {
    color: gold;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script id="kdf83j">
$(document).ready(function(){

    $('.star').on('click', function(){
        let rating = $(this).data('value');

        // Set hidden input value
        $('#rating-value').val(rating);

        // Reset all stars
        $('.star').removeClass('active');

        // Highlight selected stars
        $('.star').each(function(){
            if($(this).data('value') <= rating){
                $(this).addClass('active');
            }
        });
    });
    
//     $('.star').hover(function(){
//     let rating = $(this).data('value');

//     $('.star').each(function(){
//         if($(this).data('value') <= rating){
//             $(this).addClass('active');
//         }
//     });

// }, function(){
//     let selected = $('#rating-value').val();

//     $('.star').removeClass('active');

//     $('.star').each(function(){
//         if($(this).data('value') <= selected){
//             $(this).addClass('active');
//         }
//     });
// });

});
</script>
@endsection
