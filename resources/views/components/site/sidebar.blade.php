<div class="drawer-side">
  <label for="my-drawer" class="drawer-overlay"></label>
  <aside class="w-80 bg-white">
    <div class="py-10 pl-10 pr-4 flex flex-col gap-10">
      <h2 class="font-La-belle-aurore text-5xl app-name sidebar_app-name">
        <a href="{{  route('home')  }}">{{ $settings->app_name ?? config('app.name') }}</a>
      </h2>
      <nav>
        <ul>
          <li>
            <a href="{{ route('biography') }}" class="text-xl font-bold hover:text-gray-900 block py-1 {{ active_link('biography') ? 'text-gray-900' : 'text-gray-500' }}">{{ __('common.Biography') }}</a>
          </li>
          @foreach ($galleries as $gallery)
            <li>
              <a href="{{ route('gallery', $gallery->slug) }}" class="text-xl font-bold hover:text-gray-900 block py-1 {{ active_gallery_link('gallery*', $gallery->slug) ? 'text-gray-900' : 'text-gray-500' }}">{{ $gallery->title }}</a>
            </li>      
          @endforeach
          @if ($settings->blog)            
          <li>
            <a href="{{ route('posts.index') }}" class="text-xl font-bold hover:text-gray-900 block py-1 {{ active_link('posts*') ? 'text-gray-900' : 'text-gray-500' }}">{{ __('common.Blog') }}</a>
          </li>
          @endif
        </ul>
      </nav>

      <div x-data x-show="$store.app.showHomeSliderControls" x-cloak class="slider-controls hidden lg:block"></div>

      <div class="hidden lg:block">
        <div class="flex flex-col gap-10"> 
            {{ $slot }}
          <div class="image-caption"></div>
        </div>
      </div>
    </div>

    @if ($socialLinks->isNotEmpty())      
      <div class="fixed bottom-10 left-10 right-4 flex gap-2">
        @foreach ($socialLinks as $link)
            <a href="{{ $link->url }}" target="_blank">
              @svg('si-'.$link->icon_slug, 'w-4 h-4 text-gray-900')
            </a>
        @endforeach
      </div>
    @endif
  </aside>
</div>