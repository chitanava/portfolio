<div class="drawer-side">
  <label for="my-drawer" class="drawer-overlay"></label>
  <aside class="w-80 bg-white">
    <div class="py-10 pl-10 pr-4 flex flex-col gap-10">
      <h2 class="font-La-belle-aurore text-5xl app-name sidebar_app-name">{{ $settings->app_name ?? config('app.name') }}</h2>
      <nav>
        <ul>
          <li>
            <a href="{{ route('home') }}" class="text-xl font-bold hover:text-gray-900 block py-1 {{ active_link('home') ? 'text-gray-900' : 'text-gray-500' }}">{{ __('common.Home') }}</a>
          </li>
          <li>
            <a href="{{ route('biography') }}" class="text-xl font-bold hover:text-gray-900 block py-1 {{ active_link('biography') ? 'text-gray-900' : 'text-gray-500' }}">{{ __('common.Biography') }}</a>
          </li>
          @foreach ($galleries as $gallery)
            <li>
              <a href="{{ route('gallery', $gallery->slug) }}" class="text-xl font-bold hover:text-gray-900 block py-1 {{ active_gallery_link('gallery*', $gallery->slug) ? 'text-gray-900' : 'text-gray-500' }}">{{ $gallery->title }}</a>
            </li>      
          @endforeach
        </ul>
      </nav>

      {{ $slot }}

      <div class="caption hidden lg:block"></div>
    </div>
  </aside>
</div>