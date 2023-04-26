<x-admin.layout.app>
  <x-slot name="title">{{ $album->title }} - Album</x-slot>

  <x-slot name="breadcrumbs">
    <x-admin.breadcrumbs :items="[
        ['title' => 'Galleries', 'url' => route('admin.galleries')],
        ['title' => $gallery->title, 'url' => route('admin.galleries.show', $gallery->id)],
        ['title' => $album->title],
    ]"/>
  </x-slot>

  <x-admin.page-header title="{{ $album->title }}">
    <div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-accent btn-square mb-1">
        <x-admin.icon size="6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
        </x-admin.icon>     
      </label>

      <ul tabindex="0" class="dropdown-content menu menu-compact p-2 shadow bg-base-100 rounded-box w-52">
        <li>
          <div class="divider hover:bg-transparent cursor-auto uppercase">Album</div>
        </li>
        <li>
          <a href="{{ route('admin.galleries.albums.edit', [$gallery->id, $album->id]) }}">
              <x-admin.icon size="4">
                  <path stroke-linecap="round" stroke-linejoin="round"
                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
              </x-admin.icon>
              Edit
          </a>
        </li>
        <li>
          <label 
          for="modal-delete"
          onclick="Livewire.emit('delete', {
            action: '{{ route('admin.galleries.albums.destroy', [$gallery->id, $album->id]) }}',
            title: 'Are you sure you want to delete the Album?',
            body: 'This action will permanently remove all data, including images, associated with it.'
          })">
            <x-admin.icon size="4">
              <path stroke-linecap="round" stroke-linejoin="round"
                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
            </x-admin.icon>
            Delete
          </label>
        </li>
        <li>
          <div class="divider hover:bg-transparent cursor-auto">OR</div>
        </li>
        <li>
            <a href="{{ route('admin.galleries.albums.images.create', [$gallery->id, $album->id]) }}">
                <x-admin.icon size="4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </x-admin.icon>
                Add image 
            </a>
        </li>
      </ul>
    </div>
  </x-admin.page-header>

  @livewire('admin.image-list', ['album' => $album, 'gallery' => $gallery])

  <x-slot:modal>
    <x-admin.modal-delete/>
  </x-slot:modal>

  @push('footer-scripts')
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
  @endpush
</x-admin.layout.app>