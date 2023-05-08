<aside class="bg-base-200 w-80 flex flex-col gap-8">
  <div class="h-16 flex justify-center items-center">
    <a href="{{ route('home') }}" target="_blank" class="btn btn-ghost lowercase font-normal">
      <span class="mt-3 font-La-belle-aurore text-4xl">{{ config('app.name') }}</span>
    </a>
  </div>

  <x-admin.sidebar.menu />
</aside>