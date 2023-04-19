@extends('admin.layout.app')

@section('content')
<x-admin.page-header title="Edit Profile" />

<form action="{{ route('admin.profile.update') }}" method="POST">
  @csrf
  @method('PUT')
  <div class="card bg-base-100 shadow">
    <div class="card-body space-y-4">
      <div class="form-control w-full">
        <label for="old_password" class="label">
          <span class="label-text">Old password</span>
        </label>
        <input type="password" name="old_password" id="old_password" class="input input-bordered" />
        @error('old_password')
          <p class="text-xs text-error px-1 py-2">{{ $message }}</p>
        @enderror
      </div>
      <div class="form-control w-full">
        <label for="password" class="label">
          <span class="label-text">New password</span>
        </label>
        <input type="password" name="password" id="password" class="input input-bordered" />
        @error('password')
          <p class="text-xs text-error px-1 py-2">{{ $message }}</p>
        @enderror
      </div>
      <div class="form-control w-full">
        <label for="password_confirmation" class="label">
          <span class="label-text">Password confirmation</span>
        </label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="input input-bordered" />
        @error('password_confirmation')
          <p class="text-xs text-error px-1 py-2">{{ $message }}</p>
        @enderror
      </div>
    </div>
  </div>  

  <div class="mt-4">
    <button type="submit" class="btn btn-accent">Update</button>
  </div>
</form>
@endsection