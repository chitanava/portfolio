<x-admin.layout.app>
  <x-slot name="title">Edit Image</x-slot>

  <x-slot name="breadcrumbs">
    <x-admin.breadcrumbs :items="[
        ['title' => 'Galleries', 'url' => route('admin.galleries')],
        ['title' => $gallery->title, 'url' => route('admin.galleries.show', $gallery->id)],
        ['title' => $image->title],
        ['title' => 'Edit']
    ]"/>
  </x-slot>

  <x-admin.page-header title="Edit {{ $image->title }}">
    <label 
    for="modal-delete"
    class="btn btn-secondary" 
    onclick="Livewire.emit('delete', {
        action: '{{ route('admin.galleries.images.destroy', [$gallery->id, $image->id]) }}',
        title: 'Are you sure you want to delete the Image?',
        body: 'This action will permanently remove image.'
      })">Delete image</label>
  </x-admin.page-header>

  <form action="{{ route('admin.galleries.images.update', [$gallery->id, $image->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-3 gap-8 items-start">
      <div class="card bg-base-100 shadow col-span-3 xl:col-span-2">
      <div class="card-body space-y-4">
        <div class="form-control w-full">
          <label for="title" class="label">
            <span class="label-text">Title</span>
          </label>
          <input type="text" name="title" value="{{ old('title', $image->title) }}" id="title" class="input input-bordered" />
          @error('title')
            <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-control w-full">
          <label for="caption" class="label">
            <span class="label-text">Caption</span>
          </label>
          <input id="x" type="hidden" name="caption" value="{{ old('caption', $image->caption) }}">
          <trix-editor input="x" class="textarea textarea-bordered white rounded-none min-h-[15rem]"></trix-editor>
          @error('caption')
            <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-control items-start">
          <label class="label cursor-pointer gap-4">
            <span class="label-text">Active</span> 
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" value="1" class="toggle" @checked(old('active', $image->active)) />
          </label>
          @error('active')
            <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
          @enderror
        </div>
      </div>
      </div>  

      <div class="card bg-base-100 shadow col-span-3 xl:col-span-1">
        <div class="p-4 bg-base-content font-bold text-lg rounded-t-2xl text-base-100">Image</div>
        <div class="p-8 space-y-6">
          <figure>
            <img src="{{ $image->getFirstMediaUrl('default', 'thumb') }}" class="max-w-xs rounded-xl" />
          </figure>
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
      <button type="submit" class="btn btn-accent">Update</button>
    </div>
  </form> 

  @push('header-scripts')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
  @endpush

  <x-slot:modal>
    <x-admin.modal-delete/>
  </x-slot:modal>
</x-admin.layout.app>