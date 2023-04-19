<x-admin.layout.app>
  <x-slot name="breadcrumbs">
    <x-admin.breadcrumbs :items="[
        ['title' => 'Galleries', 'url' => route('admin.galleries')],
        ['title' => 'List']
    ]"/>
  </x-slot>
  
  <x-admin.page-header title="Galleries">
    <a href="{{ route('admin.galleries.create') }}" class="btn btn-accent">New gallery</a>
  </x-admin.page-header>
</x-admin.layout.app>