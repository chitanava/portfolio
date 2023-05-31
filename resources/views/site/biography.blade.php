<x-site.layout.app>
  <x-slot name="title">{{ __('common.Biography') }}</x-slot>

  <div class="lg:w-2/3 text-justify trix-content">
    {!! htmlspecialchars_decode($biography->body) !!}
  </div>

  @push('footer-scripts')
  <script>
    const trixContentLinks = [...document.querySelectorAll('.trix-content a')];
    trixContentLinks.forEach(function(el){
      el.href.includes('.pdf') && el.setAttribute('target', '_blank');
    })
  </script>
  @endpush
</x-site.layout.app>