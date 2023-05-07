<x-site.layout.app>
  <x-slot name="title">{{ $gallery->title }}</x-slot>
  
  <x-site.art-gallery :gallery="$gallery" :items="$galleryItems" />
</x-site.layout.app>