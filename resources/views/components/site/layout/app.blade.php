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
  @stack('header-scripts')
  <title>@isset($title) {{ $title }} - @endisset {{ config('app.name') }}</title>
</head>

<body>
  <div class="drawer drawer-mobile">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col relative">
      <!-- Page content here -->
      {{-- <label for="my-drawer" class="btn btn-primary drawer-button lg:hidden">Open drawer</label> --}}
    {{ $slot }}
    </div>
    <div class="drawer-side ">
      <label for="my-drawer" class="drawer-overlay"></label>
      <aside class="w-80 bg-white">
        <div class="py-10 pl-10 pr-4 flex flex-col gap-10">
          <h2 class="font-La-belle-aurore text-5xl">Zautashvili</h2>
          <nav>
            <ul>
              <li>
                <a href="#" class="text-xl text-gray-500 hover:text-gray-900 block py-1">Biography</a>
              </li>
              <li>
                <a href="#" class="text-xl text-gray-500 hover:text-gray-900 block py-1">Exhibitions</a>
              </li>
              <li>
                <a href="#" class="text-xl text-gray-500 hover:text-gray-900 block py-1">Projects</a>
              </li>
              <li>
                <a href="#" class="text-xl text-gray-500 hover:text-gray-900 block py-1">Other</a>
              </li>
            </ul>
          </nav>
          <div class="description flex flex-col gap-10">
            <div class="h-px bg-gray-300"></div>
            <div>Lorem ipsum dolor sit amet consectetur.</div>
          </div>
          <div class="caption"></div>
        </div>
      </aside>
    </div>
  </div>

  @livewireScripts
  @stack('footer-scripts')
</body>

</html>