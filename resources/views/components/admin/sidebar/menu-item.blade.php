@props([
  'active' => false,
  'link' => '#'
])

<li>
  <a href="{{ $link }}" {{ $attributes->class(['active' => $active]) }}>
    {{ $slot }}
  </a>
</li>