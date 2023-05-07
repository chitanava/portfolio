<x-site.layout.app>
  <x-slot name="title">{{ $album->title }} - {{ $gallery->title }}</x-slot>
  
  <x-site.art-gallery :gallery="$gallery" :items="$images" />

  <x-slot name="albumDescription">
    <div class="description flex flex-col gap-10">
      <div class="h-px bg-gray-300"></div>
      <div>
        <h2 class="font-bold text-lg">{{ $album->title }}</h2> 
        <div>{!! $album->description !!}</div>
      </div>
    </div>
  </x-slot>
</x-site.layout.app>