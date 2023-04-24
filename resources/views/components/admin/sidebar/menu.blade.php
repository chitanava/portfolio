<ul class="menu menu-compact py-0 px-4 space-y-1">
  <x-admin.sidebar.menu-item :link="route('admin.galleries')" :active="active_link('admin.galleries*')">
    <x-admin.icon stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
    </x-admin.icon>
    Galleries
  </x-admin.sidebar.menu-item>
</ul>
