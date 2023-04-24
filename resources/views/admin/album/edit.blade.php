<x-admin.layout.app>
  <x-slot name="title">Edit Album</x-slot>

  <x-slot name="breadcrumbs">
    <x-admin.breadcrumbs :items="[
        ['title' => 'Galleries', 'url' => route('admin.galleries')],
        ['title' => $gallery->title, 'url' => route('admin.galleries.show', $gallery->id)],
        ['title' => $album->title, 'url' => '#'],
        ['title' => 'Edit']
    ]"/>
  </x-slot>
  
  <x-admin.page-header title="Edit {{ $album->title }}">
    <label 
    for="modal-delete"
    class="btn btn-secondary" 
    onclick="Livewire.emit('delete', {
        action: '{{ route('admin.galleries.albums.destroy', [$gallery->id, $album->id]) }}',
        title: 'Are you sure you want to delete the Album?',
        body: 'This action will permanently remove all data, including images, associated with it.'
      })">Delete album</label>
  </x-admin.page-header>

  <form action="{{ route('admin.galleries.albums.update', [$gallery->id, $album->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card bg-base-100 shadow">
      <div class="card-body space-y-4">
        <div class="form-control w-full">
          <label for="title" class="label">
            <span class="label-text">Title</span>
          </label>
          <input type="text" name="title" value="{{ old('title', $album->title) }}" id="title" class="input input-bordered" />
          @error('title')
            <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-control w-full">
          <label for="description" class="label">
            <span class="label-text">Description</span>
          </label>
          <input id="x" type="hidden" name="description" value="{{ old('description', $album->description) }}">
          <trix-editor input="x" class="textarea textarea-bordered h-60 rounded-none"></trix-editor>
          @error('description')
          <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
        @enderror
        </div>

        <div class="form-control items-start">
          <label class="label cursor-pointer gap-4">
            <span class="label-text">Active</span> 
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" value="1" class="toggle" @checked(old('active', $album->active)) />
          </label>
          @error('active')
            <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
          @enderror
        </div>
      </div>
    </div>  

    <div class="mt-4">
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