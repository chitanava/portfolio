<div class="flex justify-between lg:hidden pt-5 pb-2 px-10 sticky top-0 bg-white z-10 bg-opacity-70 backdrop-blur">
  <h2 class="font-La-belle-aurore text-4xl app-name header_app-name">{{ $settings->app_name ?? config('app.name') }}</h2>
  <label for="my-drawer" class="btn btn-primary drawer-button cursor-pointer">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
      <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
    </svg>            
  </label>
</div>