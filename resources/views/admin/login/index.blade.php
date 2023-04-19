<x:admin.layout.auth>
  <div class="flex h-screen justify-center items-center">
    <div class="card w-96 shadow-md">
      <form action="{{ route('admin.authenticate') }}" method="POST" autocomplete="off">
        <div class="card-body gap-4">
          @csrf
          <div class="form-control gap-2">
            <input type="text" name="username" value="{{ old('username') }}" placeholder="Username" class="input input-bordered" />
            @error('username')
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
            <button type="submit" class="btn btn-accent">Log in</button>
          </div>
        </div>
      </form>
      </div>
  </div>
</x:admin.layout.auth>