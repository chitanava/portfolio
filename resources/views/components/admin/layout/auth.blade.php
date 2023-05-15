<!DOCTYPE html>
<html data-theme="cupcake" lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @if ($settings->default_fonts)
    <link href="https://fonts.googleapis.com/css2?family=La+Belle+Aurore&family=Poppins:ital,wght@0,400;0,600;1,400;1,600&display=swap" rel="stylesheet">
  @endif
  @vite(['resources/css/back.css', 'resources/js/back.js'])
  <style>
    [x-cloak] {
      display: none;
    }
  </style>
  @if ($settings->custom_css)<style>{!! $settings->custom_css !!}</style>@endif
  <title>Log in - Admin</title>
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
  {{ $slot }}
</body>
</html>