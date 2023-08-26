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
  </div>

</x-site.layout.app>