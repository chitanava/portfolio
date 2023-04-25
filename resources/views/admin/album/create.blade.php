<x-admin.layout.app>
  <x-slot name="title">Create Album</x-slot>

  <x-slot name="breadcrumbs">
    <x-admin.breadcrumbs :items="[
        ['title' => 'Galleries', 'url' => route('admin.galleries')],
        ['title' => $gallery->title, 'url' => route('admin.galleries')],
        ['title' => 'Albums'],
        ['title' => 'Create']
    ]"/>
  </x-slot>
  
  <x-admin.page-header title="Create Album"/>

  <form action="{{ route('admin.galleries.albums.store', $gallery->id) }}" method="POST" enctype="multipart/form-data">
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
          <label for="description" class="label">
            <span class="label-text">Description</span>
          </label>
          <input id="x" type="hidden" name="description" value="{{ old('description') }}">
          <trix-editor input="x" class="textarea textarea-bordered h-60 rounded-none"></trix-editor>
          @error('description')
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
        <div class="p-4 bg-base-content font-bold text-lg rounded-t-2xl text-base-100">Cover image</div>
        <div class="card-body space-y-4">
          <div class="form-control w-full">
            <input type="file" name="cover" class="file-input file-input-bordered file-input-ghost w-full" />
            @error('cover')
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
    {{-- <style>
      .trix-button-group.trix-button-group--file-tools {
        display:none;
      }
    </style> --}}
  @endpush

</x-admin.layout.app>