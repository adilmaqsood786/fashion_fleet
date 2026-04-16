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
 <!-- Password -->
                <div class="col-md-6">
                    <label class="form-label">Password</label>
                    <input type="text" class="form-control" name="password" value="{{ old('password', $user->password) }}" required>
                    <div class="invalid-feedback">Please provide a valid phone.</div>
                </div>
                <!-- Role -->
                <div class="col-md-6">
                    <label class="form-label">Role</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="">Select Role</option>
                        <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                        <option value="vendor" {{ $user->role == 'vendor' ? 'selected' : '' }}>Vendor</option>
                        <option value="rider" {{ $user->role == 'rider' ? 'selected' : '' }}>Rider</option>
                    </select>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
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
                    <label class="form-label">Phone</label>
                    <input type="text" class="form-control" name="profile_phone" value="{{ $user->profile->phone ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Address Line 1</label>
                    <input type="text" class="form-control" name="address_line_1" value="{{ $user->profile->address_line_1 ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Address Line 2</label>
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
                            
                        <select name="store_slug" class="form-control">
                           <option value="men" {{ ($user->vendor->store_slug ?? '') == 'men' ? 'selected' : '' }}>Men</option>
                           <option value="women" {{ ($user->vendor->store_slug ?? '') == 'women' ? 'selected' : '' }}>Women</option>
                        </select>
                             </div>
                        <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom03" class="form-label">Logo</label>
                        
                          <input type="file" class="form-control" value="{{  $user->vendor->logo ?? '' }}  name="logo" required />
                          <div class="invalid-feedback">Please provide a valid city.</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustomUsername" class="form-label">Description</label>
                          <div class="input-group has-validation">
                           
                            <input type="text" class="form-control"  value="{{  $user->vendor->description ?? '' }}" name="description" required />
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>
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
                          
                          <input type="text" class="form-control" name="city" value="{{  $user->vendor->city ?? '' }}" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col--> <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Country</label>
                          
                          <input type="text" class="form-control" value="{{  $user->vendor->country ?? '' }}" name="country" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <!--end::Col-->
                         <!--begin::Col-->
                        <div class="col-md-6">
                          <label for="validationCustom01" class="form-label">Commission rate</label>
                          
                          <input type="text" class="form-control" value="{{  $user->vendor->commission_rate ?? '' }}" name="commission_rate" required />
                          <div class="valid-feedback">Looks good!</div>
                        </div><div class="col-md-6">
    <label class="form-label">Is Approved</label>
    <select name="is_approved" class="form-control" required>
        <option value="1" {{ ($user->vendor->is_approved ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
        <option value="0" {{ ($user->vendor->is_approved ?? 0) == 0 ? 'selected' : '' }}>No</option>
    </select>
</div>
            <!-- Is Active -->
            <div class="col-md-6 mt-4">
                <input type="hidden" name="is_active" value="0">
               <input type="checkbox" name="is_active" id="is" value="1" {{ ($user->vendor->is_active ?? 0) == 1 ? 'checked' : '' }}>
                 <label for="is" class="form-label">Is_active</label>
            </div>

            </div>
        </section>

    </div>

    <div class="card-footer mt-5">
        <button class="btn btn-info" type="submit">Update User</button>
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