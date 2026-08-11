@extends('admin_penal.master')

@section('content')
<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-body text-center">
        <img src="{{ asset('admin/assets/img/user2-160x160.jpg') }}" class="img-thumbnail rounded-circle mb-3" alt="Avatar">
        <h4>{{ $user->name }}</h4>
        <p class="text-muted">{{ $user->email }}</p>
        @if($user->profile)
        <p><strong>Full name:</strong> {{ $user->profile->full_name ?? '-' }}</p>
        <p><strong>Address:</strong> {{ $user->profile->address_line_1 ?? '-' }}</p>
        <p><strong>City:</strong> {{ $user->profile->city ?? '-' }}</p>
        @endif
        <div class="d-grid gap-2">
          @if($user->profile)
            <a href="{{ route('profileEdit', ['edit_id' => $user->profile->id]) }}" class="btn btn-primary">Edit Profile</a>
          @else
            <a href="{{ route('profileCreate') }}" class="btn btn-primary">Create Profile</a>
          @endif
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Profile Details</h3>
      </div>
      <div class="card-body">
        <p><strong>Full name:</strong> {{ $user->profile->full_name ?? '-' }}</p>
        <p><strong>Address:</strong> {{ $user->profile->address_line_1 ?? '-' }}</p>
        <p><strong>City:</strong> {{ $user->profile->city ?? '-' }}</p>
        <p><strong>Orders:</strong> {{ $user->orders->count() }}</p>
        <hr>
        <a href="{{ route('profile.followers') }}" class="btn btn-outline-secondary">Followers</a>
        <a href="{{ route('profile.sales') }}" class="btn btn-outline-secondary">Sales</a>
        <a href="{{ route('profile.workers') }}" class="btn btn-outline-secondary">Workers</a>
      </div>
    </div>
  </div>
</div>
@endsection
