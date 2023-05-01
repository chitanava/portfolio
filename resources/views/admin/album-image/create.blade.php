<x-admin.layout.app>
  <x-slot name="title">Create Image</x-slot>

  <x-slot name="breadcrumbs">
    <x-admin.breadcrumbs :items="[
        ['title' => 'Galleries', 'url' => route('admin.galleries')],
        ['title' => $gallery->title, 'url' => route('admin.galleries')],
        ['title' => $album->title, 'url' => route('admin.galleries.albums.show', [$gallery->id, $album->id])],
        ['title' => 'Images'],
        ['title' => 'Create']
    ]"/>
  </x-slot>

  <x-admin.page-header title="Create Image"/>

  <form action="{{ route('admin.galleries.albums.images.store', [$gallery->id, $album->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-3 gap-8 items-start">
      <div class="card bg-base-100 shadow col-span-3 xl:col-span-2">
      <div class="card-body space-y-4">
        <div class="form-control w-full">
          <label for="title" class="label">
            <span class="label-text">Title</span>
          </label>
          <input type="text" name="title" value="{{ old('title') }}" id="title" class="input input-bordered" />
          @error('title')
            <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-control w-full">
          <label for="caption" class="label">
            <span class="label-text">Caption</span>
          </label>
          <input id="x" type="hidden" name="caption" value="{{ old('caption') }}">
          <trix-editor input="x" class="trix-content textarea textarea-bordered h-60 rounded-none"></trix-editor>
          @error('caption')
          <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
        @enderror
        </div>

        <div class="form-control items-start">
          <label class="label cursor-pointer gap-4">
            <span class="label-text">Active</span> 
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" value="1" class="toggle" @checked(old('active', true)) />
          </label>
          @error('active')
            <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
          @enderror
        </div>
      </div>
      </div>  

      <div class="card bg-base-100 shadow col-span-3 xl:col-span-1">
        <div class="p-4 bg-base-content font-bold text-lg rounded-t-2xl text-base-100">Image</div>
        <div class="card-body space-y-4">
          <div class="form-control w-full">
            <input type="file" name="image" class="file-input file-input-bordered file-input-ghost w-full" />
            @error('image')
              <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>
    </div>

    <div class="mt-8 xl:mt-4">
      <button type="submit" class="btn btn-accent">Create</button>
    </div>
  </form> 
  
  @push('header-scripts')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
  @endpush
</x-admin.layout.app>