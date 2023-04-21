<li 
  :style="{width: `${itemWidth}px`}"
  {{ $attributes->merge(
    ['class' => 'py-4 px-6 grid gap-6 border-b border-b-base-200']
  )}}
>

  <div wire:sortable.handle class="cursor-pointer self-start">
    <x-admin.icon size="4" class="mx-auto">
      <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
    </x-admin.icon>
  </div>

  {{ $slot }}

  <div class="text-center">
    {{ $active }}
  </div>

  <div class="text-center">
    <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-sm btn-ghost btn-active btn-square mb-1">
          <x-admin.icon size="5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
          </x-admin.icon>     
        </label>

        <ul tabindex="0" class="dropdown-content menu menu-compact p-2 shadow bg-base-100 rounded-box w-52">
          {{ $actions }}
        </ul>
      </div>
</div>
</li>