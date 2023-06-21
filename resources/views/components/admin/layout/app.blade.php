<!DOCTYPE html>
<html data-theme="cupcake" lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  @if ($settings->default_fonts)
    <link href="https://fonts.googleapis.com/css2?family=La+Belle+Aurore&family=Poppins:ital,wght@0,400;0,600;1,400;1,600&display=swap"
    rel="stylesheet">
  @endif
  @vite(['resources/css/back.css', 'resources/js/back.js'])
  @livewireStyles
  <style>
    [x-cloak] {
      display: none;
    }
  </style>
  @stack('header-scripts')
  @if ($settings->custom_css)<style>{!! $settings->custom_css !!}</style>@endif
  <title>@isset($title) {{ $title }} - @endisset Admin</title>
</head>
<body
  class="no-animation"
    x-init="() => {
      window.addEventListener('load', function() {
        setTimeout(() => {
          document.body.classList.remove('no-animation');
        }, 500)
      })
    }"
>
  <div class="drawer drawer-mobile">
    <input id="my-drawer" type="checkbox" class="drawer-toggle"/>
    <div class="drawer-content">
      <div class="flex flex-col gap-8">
        <x-admin.header>
          {{ $breadcrumbs ?? '' }}
        </x-admin.header>

        <main class="w-full max-w-7xl mx-auto px-6 gap-8 mb-8 flex flex-col">
          <x-admin.status-message isLivewire/>

          @if (session('status'))
            <x-admin.status-message />
          @endif

          {{ $slot }}
        </main>
      </div>
    </div>
    <div class="drawer-side">
      <label for="my-drawer" class="drawer-overlay"></label>
      <x-admin.sidebar></x-admin.sidebar>
    </div>
  </div>

  {{ $modal ?? '' }}

  @livewireScripts
  @stack('footer-scripts')
</body>
</html>