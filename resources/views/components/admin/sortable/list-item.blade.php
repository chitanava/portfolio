<li 
  :style="{width: `${itemWidth}px`}"
  {{ $attributes->merge(
    ['class' => 'grid gap-6 border-b border-b-base-200 py-2 border-l-4 border-base-200 mt-1 items-center justify-items-center']
  )}}
>

  <div wire:sortable.handle class="flex cursor-pointer">
    <x-admin.icon size="6" class="mx-auto">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
    </x-admin.icon>
  </div>

  {{ $slot }}

  <div>
    {{ $active }}
  </div>

  <div>
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