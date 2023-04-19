<div class="text-sm breadcrumbs">
  <ul>
    @foreach ($items as $item)
      @unless ($loop->last)
        <li><a href="{{ $item['url'] }}">{{ $item['title'] }}</a></li>
      @else
        <li>{{ $item['title'] }}</li>
      @endunless
    @endforeach
  </ul>
</div>