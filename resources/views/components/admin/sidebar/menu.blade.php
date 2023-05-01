<ul class="menu menu-compact py-0 px-4 space-y-1">
  <x-admin.sidebar.menu-item :link="route('admin.biography.edit', 1)" :active="active_link('admin.biography.edit')">
    <x-admin.icon stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
    </x-admin.icon>
    Biography
  </x-admin.sidebar.menu-item>
  <x-admin.sidebar.menu-item :link="route('admin.galleries')" :active="active_link('admin.galleries*')">
    <x-admin.icon stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
    </x-admin.icon>
    Galleries
  </x-admin.sidebar.menu-item>
</ul>

