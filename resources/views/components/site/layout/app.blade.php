<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css2?family=La+Belle+Aurore&family=Poppins:ital,wght@0,400;0,600;1,400;1,600&display=swap"
  rel="stylesheet">
  @vite(['resources/css/front.css', 'resources/js/front.js'])
  @livewireStyles
  @stack('header-scripts')
  <title>@isset($title) {{ $title }} - @endisset {{ config('app.name') }}</title>
</head>
<body>
  <div class="drawer drawer-mobile">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col items-center justify-center">
      <!-- Page content here -->
      <label for="my-drawer" class="btn btn-primary drawer-button lg:hidden">Open drawer</label>
    
    </div> 
    <div class="drawer-side">
      <label for="my-drawer" class="drawer-overlay"></label> 
      <ul class="menu p-4 w-80 bg-base-100 text-base-content">
        <!-- Sidebar content here -->
        <li><a>Sidebar Item 1</a></li>
        <li><a>Sidebar Item 2</a></li>
      </ul>
    
    </div>
  </div>

  @livewireScripts
  @stack('footer-scripts')
</body>
</html>