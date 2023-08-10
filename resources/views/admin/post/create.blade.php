<x-admin.layout.app>
  <x-slot name="title">Create Post</x-slot>

  <x-slot name="breadcrumbs">
    <x-admin.breadcrumbs :items="[
        ['title' => 'Posts', 'url' => route('admin.posts.index')],
        ['title' => 'Post'],
        ['title' => 'Create']
    ]" />
  </x-slot>

  <x-admin.page-header title="Create Post" />

  <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
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
            <label for="body" class="label">
              <span class="label-text">Body</span>
            </label>
            <input id="x" type="hidden" name="body" value="{{ old('body') }}">
            <trix-editor data-trix-attachment-add-url="{!! route('admin.biography.attachment.add') !!}"
              data-trix-attachment-remove-url="{!! route('admin.biography.attachment.remove') !!}" input="x"
              class="trix-content textarea textarea-bordered min-h-[15rem] rounded-none">
            </trix-editor>
            @error('body')
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
          <div class="form-control w-full">
            <label for="published_at" class="label">
              <span class="label-text">Published at</span>
            </label>
            <input type="datetime-local" name="published_at" value="{{ old('published_at') }}" id="published_at"
              class="input input-bordered" />
            @error('published_at')
            <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>

      <div class="col-span-3 xl:col-span-1 space-y-8">
        <div class="card bg-base-100 shadow">
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
        <livewire:admin.post-tags/>
      </div>
    </div>

    <div class="mt-8 xl:mt-4">
      <button type="submit" class="btn btn-accent">Create</button>
    </div>
  </form>

  @push('header-scripts')
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
  @endpush

  @push('footer-scripts')
  <script src="{!! asset('storage/js/trix-attachment.js') !!}"></script>
  @endpush

</x-admin.layout.app>