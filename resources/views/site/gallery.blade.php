<x-site.layout.app>
  <x-slot name="title">{{ $gallery->title }}</x-slot>

  <div class="lg:hidden">
    @if ($gallery->description)          
      <div class="gallery-description">
        {!! $gallery->description !!}
      </div>
    @endif
  </div>
  
  <x-site.art-gallery :gallery="$gallery" :items="$galleryItems" />

  @if ($gallery->description)
    <x-slot name="descriptions">
      <div class="h-px bg-gray-300"></div>          
      <div class="gallery-description">
        {!! $gallery->description !!}
      </div>
    </x-slot>
  @endif
</x-site.layout.app>