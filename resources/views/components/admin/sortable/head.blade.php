@props([
  'cols' => []
])

<div 
  {{ $attributes->merge([
    'class' => 'bg-base-200 py-4 px-6 rounded-t-lg grid gap-6'
  ]) }}>

  <div></div>

  @foreach ($cols as $col)
    <div class="font-bold text-xs uppercase">{{ $col }}</div>
  @endforeach

  <div class="font-bold text-xs uppercase text-center">Active</div>
  <div class="font-bold text-xs uppercase text-center">Actions</div>
</div>