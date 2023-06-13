<x-site.layout.app>
  <x-slot name="title">{{ $album->title }} - {{ $gallery->title }}</x-slot>
  
  <div class="lg:hidden">
    @if ($gallery->description)          
      <div class="gallery-description mb-2">
        {!! $gallery->description !!}
      </div>
    @endif
    <h2 class="font-bold text-lg">{{ $album->title }}</h2> 
    <div class="text-sm">{!! $album->description !!}</div>
  </div>
  <x-site.art-gallery :gallery="$gallery" :items="$albumItems" />

  <x-slot name="descriptions">
    <div class="h-px bg-gray-300"></div>   
    
    @if ($gallery->description)          
      <div class="gallery-description">
        {!! $gallery->description !!}
      </div>
    @endif

    <div class="album-description">
      <div class="font-bold text-lg">{{ $album->title }}</div> 
      <div>{!! $album->description !!}</div>
    </div>

  </x-slot>
</x-site.layout.app>