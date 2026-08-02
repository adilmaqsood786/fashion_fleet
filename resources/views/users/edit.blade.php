@extends('admin_penal.master')
@section('content')
<div class="card-header">
    <div class="card-title"><h3>Edit User</h3></div>
</div>

<form action="{{ route('user.update',$user->id) }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
    @csrf
    {{-- @method('PUT') <!-- Important for update --> --}}

    <div class="card-body">
        <section>
            <div class="row g-3">
                <!-- Name -->
                <div class="col-md-6">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                    <div class="valid-feedback">Looks good!</div>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                    <div class="valid-feedback">Looks good!</div>
                </div>

                <!-- Phone -->
                <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="userPhone" value="{{ old('userPhone', $user->userPhone) }}" required>
                    <div class="invalid-feedback">Please provide a valid phone.</div>
                </div>
 {{-- <!-- Password -->
                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" value="" required>
                    <div class="invalid-feedback">Please provide a valid phone.</div>
                </div> --}}
                <!-- Role -->
                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <select name="role" id="role"  class="form-select" disabled>
                        <option value="">Select Role</option>
                        <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                        <option value="vendor" {{ $user->role == 'vendor' ? 'selected' : '' }}>Vendor</option>
                        <option value="rider" {{ $user->role == 'rider' ? 'selected' : '' }}>Rider</option>
                    </select>
                       <input type="hidden" name="role" value="{{ $user->role }}">
                </div>

                <!-- Status -->
                {{-- <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div> --}}
<div class="col-md-6">
    <label class="form-label">Status</label>
    <select name="status" class="form-select" required>
        <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Active</option>
        <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Inactive</option>
    </select>
</div>

                <div class="col-md-6">
    <label>Email Verification</label>

    <select name="email_verified" class="form-control form-select">
        <option value="1" {{ $user->email_verified_at ? 'selected' : '' }}>Verified</option>
        <option value="0" {{ !$user->email_verified_at ? 'selected' : '' }}>Not Verified</option>
    </select>
</div>
            </div>
        </section>

        {{--================= Customer Profile =================--}}
        <section id="customer_section" class="mt-5 {{ $user->role != 'customer' ? 'd-none' : '' }}">
            <h3>Customer Profile</h3>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="full_name" value="{{ $user->profile->full_name ?? '' }}">
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">Address 1</label>
                    <input type="text" class="form-control" name="address_line_1" value="{{ $user->profile->address_line_1 ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Address 2</label>
                    <input type="text" class="form-control" name="address_line_2" value="{{ $user->profile->address_line_2 ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">City</label>
                    <input type="text" class="form-control" name="city" value="{{ $user->profile->city ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">State</label>
                    <input type="text" class="form-control" name="state" value="{{ $user->profile->state ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Postal Code</label>
                    <input type="text" class="form-control" name="postal_code" value="{{ $user->profile->postal_code ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Country</label>
                    <input type="text" class="form-control" name="country" value="{{ $user->profile->country ?? '' }}">
                </div>


  <!-- Latitude -->
            <div class="col-md-6">
                <label class="form-label">Latitude</label>
                <input type="number" step="0.000001" name="latitude" class="form-control" value="{{isset($user->profile->latitude)?$user->profile->latitude:""}}" required>
            </div>

            <!-- Longitude -->
            <div class="col-md-6">
                <label class="form-label">Longitude</label>
                <input type="number" step="0.000001" name="longitude" class="form-control" value="{{isset($user->profile->longitude)?$user->profile->longitude:""}}" required>
            </div>
          
            <div class="col-md-6 mt-4">
    <label class="form-label" for="id">Set as Default</label>

    <select name="is_default" class="form-select form-control" id="id">
        <option value="1" {{ ($user->profile->is_default ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
        <option value="0" {{ ($user->profile->is_default ?? 0) == 0 ? 'selected' : '' }}>No</option>
    </select>
</div>
            </div>

        </section>

        {{--================= Vendor Profile =================--}}
        <section id="vendor_section" class="mt-5 {{ $user->role != 'vendor' ? 'd-none' : '' }}">
            <h3>Vendor Profile</h3>
            <div class="row g-3">
                 <div class="col-md-6">

                          <label for="validationCustom01" class="form-label">Store Name</label>
                          <input type="text" name="store_name" class="form-control" value="{{  $user->vendor->store_name ?? '' }}">
                          {{-- <input type="text" class="form-control" name="store_name" value="{{ old('store_name', $user->vendor->store_name ?? '') }}">  --}}
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                             <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Store Slug</label>


                    <input type="text" name="store_slug" class="form-control" value="{{old('$user->vendor->store_slug ',isset($user->vendor->store_slug )?$user->vendor->store_slug :"")}}"  id="slug">
                    </div>
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">Logo</label>

                          <input type="file" class="form-control" value="{{  $user->vendor->logo ?? '' }} " name="logo" required />
                          <div class="invalid-feedback">Please provide a valid city.</div>
                        </div>
                        <!--end::Col--> 
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">Registration Number</label>

                          <input type="text" class="form-control" name="register" value="{{  $user->vendor->register ?? '' }} " required />
                          <div class="invalid-feedback">Please provide a valid city.</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">License Number</label>

                          <input type="text" class="form-control" name="license" value="{{  $user->vendor->license ?? '' }} " required />
                          <div class="invalid-feedback">Please provide a valid city.</div>
                        </div>
                        
                        <!--end::Col-->

                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Address</label>

                          <input type="text" class="form-control" name="address" value="{{  $user->vendor->address ?? '' }} "required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->


                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">City</label>

                          <input type="text" class="form-control" name="vendor_city" value="{{ old("vendor_city",isset($user->vendor->vendor_city) ?$user->vendor->vendor_city : '')  }}" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col--> <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Country</label>

                          <input type="text" class="form-control" value="{{  $user->vendor->vendor_country ?? '' }}" name="vendor_country" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Commission rate</label>

                          <input type="text" class="form-control" value="{{  $user->vendor->commission_rate ?? '' }}" name="commission_rate" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>

          
            <!-- Is Default -->
<div class="col-md-6 mt-4">
    <label class="form-label" for="id">Active</label>   

    <select name="is_active" class="form-select form-control" id="id">
        <option value="1" {{ ($user->vendor->is_active ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
        <option value="0" {{ ($user->vendor->is_active ?? 0) == 0 ? 'selected' : '' }}>No</option>
    </select>
</div>

            </div>




        </section>
 
{{--================= Rider Profile =================--}}
<section id="rider_section" class="mt-5 {{ $user->role != 'rider' ? 'd-none' : '' }}">
    <h3>Rider Profile</h3>

    <div class="row g-3">

        <div class="col-md-6">
            <label class="form-label">Vehicle Type</label>
            <input type="text"
                   class="form-control"
                   name="vehicle_type"
                   value="{{ old('vehicle_type', $user->rider->vehicle_type ?? '') }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Vehicle Number</label>
            <input type="text"
                   class="form-control"
                   name="vehicle_number"
                   value="{{ old('vehicle_number', $user->rider->vehicle_number ?? '') }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">License Number</label>
            <input type="text"
                   class="form-control"
                   name="license_number"
                   value="{{ old('license_number', $user->rider->license_number ?? '') }}">
        </div>

        <div class="col-md-6">
            <label class="form-label">Available</label>
            <select name="is_available" class="form-select">
                <option value="1" {{ ($user->rider->is_available ?? 1) == 1 ? 'selected' : '' }}>
                    Yes
                </option>

                <option value="0" {{ ($user->rider->is_available ?? 1) == 0 ? 'selected' : '' }}>
                    No
                </option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Verification</label>
            <select name="is_verified" class="form-select">
                <option value="1" {{ ($user->rider->is_verified ?? 0) == 1 ? 'selected' : '' }}>
                    Verified
                </option>

                <option value="0" {{ ($user->rider->is_verified ?? 0) == 0 ? 'selected' : '' }}>
                    Not Verified
                </option>
            </select>
        </div>

    </div>
</section>


    </div>

    <div class="card-footer mt-5">
        <button class="btn btn-success" type="submit">Update</button>
    </div>
</form>

<script>
    document.getElementById('role').addEventListener('change', function(){
        document.getElementById('customer_section').classList.add('d-none');
        document.getElementById('vendor_section').classList.add('d-none');
        document.getElementById('rider_section').classList.add('d-none');

        if(this.value === 'customer') document.getElementById('customer_section').classList.remove('d-none');
        if(this.value === 'vendor') document.getElementById('vendor_section').classList.remove('d-none');
        if(this.value === 'rider') document.getElementById('rider_section').classList.remove('d-none');
    });
</script>
@endsection
