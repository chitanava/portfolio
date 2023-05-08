<x-site.layout.app>
  <x-slot name="title">Biography</x-slot>
  
  <div class="md:w-1/2 lg:w-1/3 text-justify trix-content">
    {!! htmlspecialchars_decode($biography->body) !!}
  </div>
</x-site.layout.app>