<div class="text-sm breadcrumbs">
  <ul>
    @foreach ($items as $item)
      @if (isset($item['url']))
        <li><a href="{{ $item['url'] }}">{{ $item['title'] }}</a></li>
      @else
        <li><span class="text-zinc-400">{{ $item['title'] }}</span></li>
      @endif
    @endforeach
  </ul>
</div>