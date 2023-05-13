<x-site.layout.app>
  <x-slot name="title">{{ $album->title }} - {{ $gallery->title }}</x-slot>
  
  <div class="lg:hidden">
    <h2 class="font-bold text-md">{{ $album->title }}</h2> 
    <div class="text-sm">{!! $album->description !!}</div>
  </div>
  <x-site.art-gallery :gallery="$gallery" :items="$images" />

  <x-slot name="albumDescription">
    <div class="description flex-col gap-10 hidden lg:flex">
      <div class="h-px bg-gray-300"></div>
      <div>
        <h2 class="font-bold text-lg">{{ $album->title }}</h2> 
        <div>{!! $album->description !!}</div>
      </div>
    </div>
  </x-slot>
</x-site.layout.app>