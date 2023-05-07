<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link
    href="https://fonts.googleapis.com/css2?family=La+Belle+Aurore&family=Poppins:ital,wght@0,400;0,600;1,400;1,600&display=swap"
    rel="stylesheet">
  @vite(['resources/css/front.css', 'resources/js/front.js'])
  @livewireStyles
  <style>
    [x-cloak] {
      display: none;
    }
  </style>
  @stack('header-scripts')
  <title>@isset($title) {{ $title }} - @endisset {{ config('app.name') }}</title>
</head>

<body>
  <div class="drawer drawer-mobile">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col relative">
      <!-- Page content here -->
      {{-- <label for="my-drawer" class="btn btn-primary drawer-button lg:hidden">Open drawer</label> --}}
      <main class="py-10 pl-10 pr-10 lg:pl-0">
        {{ $slot }}
      </main>
    </div>
    <div class="drawer-side ">
      <label for="my-drawer" class="drawer-overlay"></label>
      <aside class="w-80 bg-white">
        <div class="py-10 pl-10 pr-4 flex flex-col gap-10">
          <h2 class="font-La-belle-aurore text-5xl">Zautashvili</h2>
          <nav>
            <ul>
              <li>
                <a href="{{ route('home') }}" class="text-xl font-bold hover:text-gray-900 block py-1 {{ active_link('home') ? 'text-gray-900' : 'text-gray-500' }}">Home</a>
              </li>
              <li>
                <a href="{{ route('biography') }}" class="text-xl font-bold hover:text-gray-900 block py-1 {{ active_link('biography') ? 'text-gray-900' : 'text-gray-500' }}">Biography</a>
              </li>
              @foreach ($galleries as $gallery)
              <li>
                <a href="{{ route('gallery', $gallery->slug) }}" class="text-xl font-bold hover:text-gray-900 block py-1 {{ active_gallery_link('gallery*', $gallery->slug) ? 'text-gray-900' : 'text-gray-500' }}">{{ $gallery->title }}</a>
              </li>      
              @endforeach
            </ul>
          </nav>

          {{ $albumDescription ?? '' }}

          <div class="caption"></div>
        </div>
      </aside>
    </div>
  </div>

  @livewireScripts
  @stack('footer-scripts')
</body>

</html>