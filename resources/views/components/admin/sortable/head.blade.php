@props([
  'cols' => []
])

<div 
  {{ $attributes->merge([
    'class' => 'bg-base-200 py-4 border-l-4 border-base-200 rounded-t-lg grid gap-6 justify-items-center'
  ]) }}>

  <div></div>

  @foreach ($cols as $col)
    <div class="font-bold text-xs uppercase justify-self-start">{{ $col }}</div>
  @endforeach

  <div class="font-bold text-xs uppercase">Active</div>
  <div class="font-bold text-xs uppercase">Actions</div>
</div>