<x-site.layout.app>
  <x-slot name="title">{{ $post->title }}</x-slot>

  <div class="lg:w-2/3 space-y-12">
    <div class="space-y-8">
      @if ($post->media->isNotEmpty())
      <div>
        <img src="{{ $post->media[0]->getUrl() }}" alt="{{ $post->title }}">
      </div>
      @endif
      <div>
        <h1 class="font-bold text-xl mb-1">{{ $post->title }}</h1>
      </div>

      <div class="text-justify trix-content">{!! $post->body !!}</div>
    </div>

    @if ($post->tags->isNotEmpty())
    <div class="flex gap-4 items-center flex-wrap">
      <p class="text-xs text-gray-400 italic">Published on {{ $post->published_at->format('F d, Y')}} in</p>
      @foreach ($post->tags as $tag)
      <a class="px-4 py-2 border border-gray-300 hover:border-gray-900"
        href="{{ route('posts.index', Arr::query(['tags' => [$tag->order_column => $tag->slug]])) }}">{{ $tag->name
        }}</a>
      @endforeach
    </div>
    @endif

    @if ($previous || $next)
    <div class="flex justify-end gap-2"> 
      @if ($previous)
      <a href="{{ route('posts.show', $previous->slug) }}" class="w-8 h-8 bg-gray-900 flex justify-center items-center text-white">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 pointer-events-none">
          <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
        </svg>
      </a>
      @endif

      @if ($next)
      <a href="{{ route('posts.show', $next->slug) }}" class="w-8 h-8 bg-gray-900 flex justify-center items-center text-white">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 pointer-events-none">
          <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
        </svg>
      </a>
      @endif
    </div>
    @endif
  </div>

</x-site.layout.app>