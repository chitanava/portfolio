<x-site.layout.app>
  @if ($images->isNotEmpty())
      <x-site.slider-gallery :images="$images" />
  @endif
</x-site.layout.app>