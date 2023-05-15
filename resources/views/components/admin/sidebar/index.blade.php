<aside class="bg-base-200 w-80 flex flex-col gap-8">
  <div class="h-16 flex justify-center items-center">
    <a href="{{ route('home') }}" target="_blank" class="btn btn-ghost normal-case font-normal">
      <span class="mt-3 font-La-belle-aurore text-4xl app-name admin_app-name">{{ $settings->app_name ?? config('app.name') }}</span>
    </a>
  </div>

  <x-admin.sidebar.menu />
</aside>