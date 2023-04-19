@props([
  'size' => 5
])

<svg 
  {{ $attributes->merge([
    'stroke-width' => '1.5',
    'class' => 'w-'.$size.' h-'.$size
  ]) }}
  xmlns="http://www.w3.org/2000/svg" 
  fill="none" 
  viewBox="0 0 24 24" 
  stroke="currentColor">
    {{ $slot }}
</svg>