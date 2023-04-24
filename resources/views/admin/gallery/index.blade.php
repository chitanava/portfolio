<x-admin.layout.app>
  <x-slot name="title">Galleries</x-slot>

  <x-slot name="breadcrumbs">
    <x-admin.breadcrumbs :items="[
        ['title' => 'Galleries', 'url' => route('admin.galleries')],
        ['title' => 'List']
    ]"/>
  </x-slot>
  
  <x-admin.page-header title="Galleries">
    <a href="{{ route('admin.galleries.create') }}" class="btn btn-accent">New gallery</a>
  </x-admin.page-header>

  @livewire('admin.gallery-list')

  <x-slot:modal>
    <x-admin.modal-delete />
  </x-slot:modal>

  @push('footer-scripts')
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
  @endpush
</x-admin.layout.app>