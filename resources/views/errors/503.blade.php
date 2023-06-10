<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  @if ($settings->default_fonts)
  <link
    href="https://fonts.googleapis.com/css2?family=La+Belle+Aurore&family=Poppins:ital,wght@0,400;0,600;1,400;1,600&display=swap" rel="stylesheet">
  @endif
  @vite(['resources/css/front.css', 'resources/js/front.js'])
  @if ($settings->custom_css)<style>{!! $settings->custom_css !!}</style>@endif
  <title>Service Unavailable</title>
</head>

<body>
  <div class="h-full fixed w-full flex flex-col gap-2 justify-center items-center px-6">
    <div class="font-La-belle-aurore text-6xl app-name not-found_app-name">{{ $settings->app_name ?? config('app.name') }}</div>
    <div class="text-2xl text-center">Please note that<br> the website is temporarily disabled <br>for maintenance purposes.</div>
  </div>
</body>
</html>