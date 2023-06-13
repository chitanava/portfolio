<x-site.layout.app>
  {{-- <x-slot name="title">Home</x-slot> --}}
  @if ($images->isNotEmpty())
    @if ($images->count() == 1)
      <div x-show="show" class="fixed top-0 right-0 bottom-0 left-0 lg:left-80 bg-white">
        <div class="art-image h-full flex flex-col gap-3 justify-center items-center pl-10 pr-10 lg:pl-0 py-24 relative">
          <img class="max-w-full max-h-full" src="{{ $images[0]->getFirstMediaUrl() }}" alt="{{ strip_tags($images[0]->caption) }}">
        </div>
      </div>
    @else
      <x-site.art-gallery :items="$images" />
    @endif
  @endif
</x-site.layout.app>