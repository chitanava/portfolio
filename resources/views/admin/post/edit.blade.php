<x-admin.layout.app>
  <x-slot name="title">Edit Post</x-slot>

  <x-slot name="breadcrumbs">
    <x-admin.breadcrumbs :items="[
        ['title' => 'Posts', 'url' => route('admin.posts.index')],
        ['title' => $post->title],
        ['title' => 'Edit']
    ]" />
  </x-slot>

  <x-admin.page-header title="Edit {{ $post->title }}">
    <label for="modal-delete" class="btn btn-secondary" onclick="Livewire.emit('delete', {
        action: '{{ route('admin.posts.destroy', $post->id) }}',
        title: 'Are you sure you want to delete the Post?',
      })">Delete post</label>
  </x-admin.page-header>

  <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-3 gap-8 items-start">
      <div class="card bg-base-100 shadow col-span-3 xl:col-span-2">
        <div class="card-body space-y-4">
          <div class="form-control w-full">
            <label for="title" class="label">
              <span class="label-text">Title</span>
            </label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}" id="title"
              class="input input-bordered" />
            @error('title')
            <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
          </div>

          <div class="form-control w-full">
            <label for="body" class="label">
              <span class="label-text">Body</span>
            </label>
            <input id="x" type="hidden" name="body" value="{{ old('body', $post->body) }}">
            <trix-editor data-trix-attachment-add-url="{!! route('admin.biography.attachment.add') !!}"
              data-trix-attachment-remove-url="{!! route('admin.biography.attachment.remove') !!}" input="x"
              class="trix-content textarea textarea-bordered white rounded-none min-h-[15rem]"></trix-editor>
            @error('body')
            <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
          </div>

          <div class="form-control items-start">
            <label class="label cursor-pointer gap-4">
              <span class="label-text">Active</span>
              <input type="hidden" name="active" value="0">
              <input type="checkbox" name="active" value="1" class="toggle" @checked(old('active', $post->active)) />
            </label>
            @error('active')
            <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
          </div>
          <div class="form-control w-full">
            <label for="published_at" class="label">
              <span class="label-text">Published at</span>
            </label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at) }}"
              id="published_at" class="input input-bordered" />
            @error('published_at')
            <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>

      <div class="col-span-3 xl:col-span-1 space-y-8">
        <div class="card bg-base-100 shadow">
          <div class="p-4 bg-base-content font-bold text-lg rounded-t-2xl text-base-100">Image</div>
          <div class="p-8 space-y-6">
            <figure>
              <img src="{{ $post->getFirstMediaUrl('default', 'md') }}" class="max-w-xs rounded-xl" />
            </figure>
            <div class="form-control w-full">
              <input type="file" name="image" class="file-input file-input-bordered file-input-ghost w-full" />
              @error('image')
              <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>
        @php
          $old = collect(json_decode(old('post_tags'), true));
        @endphp
        <livewire:admin.post-tags :postTags="$old->isNotEmpty() ? $old : $tags"/>
      </div>
    </div>

    <div class="mt-8 xl:mt-4">
      <button type="submit" class="btn btn-accent">Update</button>
    </div>
  </form>

  <x-slot:modal>
    <x-admin.modal-delete />
  </x-slot:modal>

  @push('header-scripts')
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
  @endpush

  @push('footer-scripts')
  <script src="{!! asset('storage/js/trix-attachment.js') !!}"></script>
  @endpush

</x-admin.layout.app>