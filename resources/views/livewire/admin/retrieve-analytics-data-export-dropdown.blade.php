<div class="dropdown dropdown-end">
    <label tabindex="0" class="btn btn-sm btn-ghost btn-active btn-square mb-1">
        <x-admin.icon size="5">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
        </x-admin.icon>
    </label>

    <ul tabindex="0" class="dropdown-content menu menu-compact p-2 shadow bg-base-100 rounded-box">
        <li>
            <a wire:click="export" class="whitespace-nowrap gap-2">
                <x-admin.icon size="4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                </x-admin.icon>
                Export data to excel
            </a>
        </li>
    </ul>
</div>
