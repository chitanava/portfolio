<x-admin.layout.app>
  <x-slot name="title">Posts</x-slot>

  <x-slot name="breadcrumbs">
    <x-admin.breadcrumbs :items="[
        ['title' => 'Posts', 'url' => route('admin.posts.index')],
        ['title' => 'List']
    ]"/>
  </x-slot>
  
  <x-admin.page-header title="Posts">
    <a href="{{ route('admin.posts.create') }}" class="btn btn-accent">New post</a>
  </x-admin.page-header>

  <livewire:admin.post-table />

  <x-slot:modal>
    <x-admin.modal-delete isLivewire/>
  </x-slot:modal>

  @push('footer-scripts')
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
  @endpush
</x-admin.layout.app>