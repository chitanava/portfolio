@extends('admin.layout.app')

@section('content')
<div class="flex h-screen justify-center items-center">
  <div class="card w-96 shadow-md">
    <form action="{{ route('admin.login.authenticate') }}" method="POST" autocomplete="off">
      <div class="card-body gap-4">
        @csrf
        <div class="form-control gap-2">
          <input type="text" name="email" value="{{ old('email') }}" placeholder="Email" class="input input-bordered" />
          @error('email')
            <p class="text-sm text-error">{{ $message }}</p>
          @enderror
        </div>
        <div class="form-control gap-2">
          <input type="password" name="password" placeholder="Password" class="input input-bordered" />
          @error('password')
            <p class="text-sm text-error">{{ $message }}</p>
          @enderror
        </div>
        @if (session('status'))
          <p class="text-sm text-error">{{ session('status') }}</p>
        @endif
        <div class="card-actions justify-end">
          <button type="submit" class="btn btn-accent">Login</button>
        </div>
      </div>
    </form>
    </div>
</div>
@endsection