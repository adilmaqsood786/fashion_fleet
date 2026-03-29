@extends('admin_penal.master')
@section('content')
 
   
        
  <!-- /.card --> 
        
                <div class="card mb-4">
                  <div class="card-header">
                    <h3 class="card-title">Vendor Record</h3>
                    <div class=" d-flex justify-content-end align-items-center">
                    <a href="{{route('vendorCreate')}}" class="btn btn-outline-warning">New</a>
                    </div>
                  </div>
                  <!-- /.card-header -->
                      
                  <div class="card-body p-0 table-responsive " >
                    <table class="table table-sm table-border">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Company Name</th>
                          <th>Slug</th>
                          <th>Description</th>
                          <th>logo</th>
                          <th>Account Number</th>
                          <th>Document</th>
                          <th>Address</th>
                          <th>Bank Name</th>
                          <th>Account Number</th>
                          <th>Account Title</th>
                          <th>Iban</th>
                          <th>payment Method</th>
                          <th>Status</th>
                          <th>Is verified</th>
                          <th>Edit</th>
                          <th>Delete</th>

                        </tr>
                      </thead>
                  @foreach ($vendors as $vendor )
                      <tbody>
                        <tr class="align-middle">
                          <td>{{$vendor['id']}}</td>
                          <td>{{$vendor['company_name']}}</td>
                          <td>{{$vendor['slug']}}</td>
                          <td>{{$vendor['description']}}</td>
                          {{-- <td>{{$vendor['logo']}}</td> --}}
                          <td><img src="{{ asset('storage/'.$vendor->logo) }}" width="100" height="100"></td>
                          <td>{{$vendor['contact_number']}}</td>
                          <td>{{$vendor['licenses']}}</td>
                          <td>{{$vendor['address']}}</td>
                          <td>{{$vendor['bank_name']}}</td>
                          <td>{{$vendor['account_number']}}</td>
                          <td>{{$vendor['account_title']}}</td>
                          <td>{{$vendor['iban']}}</td>
                          <td>{{$vendor['payment_method']}}</td>
                          <td>{{$vendor['status']}}</td>
                          <td>{{$vendor['is_verified']}}</td>
                          <td><a href="{{route('vendorEdit',['edit_id'=>$vendor['id']])}}" class="btn btn-outline-primary">Edit</a></td>
                          <td><a href="{{route('vendorDelete',['delete_id'=>$vendor['id']])}}" class="btn btn-outline-danger">Delete</a></td>
                        </tr>
                      </tbody>
                  @endforeach

                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>

@endsection
















                