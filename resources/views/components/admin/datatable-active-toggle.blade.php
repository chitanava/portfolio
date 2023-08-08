@props([
  'item'
])

<livewire:admin.datatable-active-toggle-button :item="$item" :wire:key="'item-'.$item->id"/>