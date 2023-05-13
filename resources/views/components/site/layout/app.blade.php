<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="{{ $settings->seo_description }}">
  <meta name="keywords" content="{{ $settings->seo_keywords }}">
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
  @if ($settings->custom_css)<style>{!! $settings->custom_css !!}</style>@endif
  <title>@isset($title) {{ $title }} - @endisset {{ config('app.name') }}</title>
</head>

<body>
  <div class="drawer drawer-mobile">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col relative">
      <x-site.header/>
      <main class="py-5 pl-10 pr-10 lg:pl-0 lg:py-10 space-y-5 lg:space-y-0">
        {{ $slot }}
      </main>
    </div>
    <x-site.sidebar>
      {{ $albumDescription ?? '' }}
    </x-site.sidebar>
  </div>

  @livewireScripts
  @stack('footer-scripts')
</body>

</html>