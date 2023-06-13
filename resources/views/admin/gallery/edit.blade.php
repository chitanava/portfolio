<x-admin.layout.app>
  <x-slot name="title">Edit Gallery</x-slot>

  <x-slot name="breadcrumbs">
    <x-admin.breadcrumbs :items="[
        ['title' => 'Galleries', 'url' => route('admin.galleries')],
        ['title' => $gallery->title, 'url' => route('admin.galleries.show', $gallery->id)],
        ['title' => 'Edit']
    ]"/>
  </x-slot>
  
  <x-admin.page-header title="Edit {{ $gallery->title }}">    
    <label 
      for="modal-delete"
      class="btn btn-secondary" 
      onclick="Livewire.emit('delete', {
          action: '{{ route('admin.galleries.destroy', $gallery->id) }}',
          title: 'Are you sure you want to delete the Gallery?',
          body: 'This action will permanently remove all data, including albums, images and videos associated with it.'
        })">Delete gallery</label>
  </x-admin.page-header>

  <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card bg-base-100 shadow">
      <div class="card-body space-y-4">
        <div class="form-control w-full">
          <label for="title" class="label">
            <span class="label-text">Title</span>
          </label>
          <input type="text" name="title" value="{{ old('title', $gallery->title) }}" id="title" class="input input-bordered" />
          @error('title')
            <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-control items-start">
          <label class="label cursor-pointer gap-4">
            <span class="label-text">Active</span> 
            <input type="hidden" name="active" value="0">
            <input type="checkbox" name="active" value="1" class="toggle" @checked(old('active', $gallery->active)) />
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

  <x-slot:modal>
    <x-admin.modal-delete/>
  </x-slot:modal>

</x-admin.layout.app>