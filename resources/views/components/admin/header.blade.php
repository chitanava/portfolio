<header
  class="flex justify-between items-center h-16 px-6 bg-base-100 bg-opacity-70 backdrop-blur sticky top-0 z-30 shadow-sm">
  <div class="flex gap-6 items-center">
    <div class="lg:hidden">
      <span class="tooltip tooltip-bottom before:text-xs before:content-[attr(data-tip)]" data-tip="Menu">
        <label for="my-drawer" class="btn btn-square btn-ghost drawer-button">
          <x-admin.icon size="6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </x-admin.icon>
        </label>
      </span>
    </div>
    {{ $slot }}
  </div>
  <div>
    <div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-ghost normal-case m-1">Admin</label>
      <ul tabindex="0" class="dropdown-content menu menu-compact p-2 shadow-2xl bg-base-200 rounded-box w-52">
        <li>
          <a>
            <x-admin.icon size="4">
              <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </x-admin.icon>
            Profile
          </a>
        </li>
        <li>
          <a>
            <x-admin.icon size="4">
              <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
            </x-admin.icon>
            Log out
          </a>
        </li>
      </ul>
    </div>
  </div>
</header>