<div>
    @if ($data->isEmpty())
    <div>No items found. Please add new content to display.</div>
    @else
    <x-admin.sortable.head class="grid-cols-[2rem_3fr_3fr_1fr_1fr]" :cols="['title', 'type']" />

    <x-admin.sortable.list wire:sortable="updateOrder">
        @foreach ($data as $item)
        @if (class_basename($item['class']) === 'Video')
            <x-admin.sortable.list-item 
            class="grid-cols-[2rem_3fr_3fr_1fr_1fr]" 
            wire:sortable.item="{{ $item['id'] }}:{{ $item['class'] }}"
            wire:key="task-{{ $loop->iteration }}">

            <div class="justify-self-start flex items-center gap-3">
                <div class="avatar">
                    <div class="w-16 h-16 mask mask-squircle"><img src="{{ $item->getFirstMediaUrl('default', 'sm') }}" alt=""></div>
                </div>
                <span>{{ $item['title'] }}</span>
            </div>

            <div class="justify-self-start">
                {{ class_basename($item['class']) }}
            </div>

            <x-slot:active>
                <input wire:click="active({{ $item['id'] }}, '{{ addslashes($item['class']) }}')" name="active" type="checkbox" class="toggle toggle-sm" @checked($item['active']) />
            </x-slot:active>

            <x-slot:actions>
                <li>
                    <div class="divider hover:bg-transparent cursor-auto uppercase">Video</div>
                </li>
                <li>
                    <a href="{{ route('admin.galleries.albums.videos.edit', [$gallery->id, $album->id, $item['id']]) }}">
                        <x-admin.icon size="4">
                            <path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                        </x-admin.icon>
                        Edit
                    </a>
                </li>
                <li>
                    <label wire:click="delete({{ $item['id'] }}, '{{ addslashes($item['class']) }}')" for="modal-delete">
                        <x-admin.icon size="4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </x-admin.icon>
                        Delete
                    </label>
                </li>
            </x-slot:actions>
            </x-admin.sortable.list-item>                   
        @else
            <x-admin.sortable.list-item 
                class="grid-cols-[2rem_3fr_3fr_1fr_1fr]" 
                wire:sortable.item="{{ $item['id'] }}:{{ $item['class'] }}"
                wire:key="task-{{ $loop->iteration }}">

                <div class="justify-self-start flex items-center gap-3">
                    <div class="avatar">
                        <div class="w-16 h-16 mask mask-squircle"><img src="{{ $item->getFirstMediaUrl('default', 'sm') }}" alt=""></div>
                    </div>
                    <span>{{ $item['title'] }}</span>
                </div>

                <div class="justify-self-start">
                    {{ class_basename($item['class']) }}
                </div>

                <x-slot:active>
                    <input wire:click="active({{ $item['id'] }}, '{{ addslashes($item['class']) }}')" name="active" type="checkbox" class="toggle toggle-sm" @checked($item['active']) />
                </x-slot:active>

                <x-slot:actions>
                    <li>
                        <div class="divider hover:bg-transparent cursor-auto uppercase">Image</div>
                    </li>
                    <li>
                        <a href="{{ route('admin.galleries.albums.images.edit', [$gallery->id, $album->id, $item['id']]) }}">
                            <x-admin.icon size="4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </x-admin.icon>
                            Edit
                        </a>
                    </li>
                    <li>
                        <label wire:click="delete({{ $item['id'] }}, '{{ addslashes($item['class']) }}')" for="modal-delete">
                            <x-admin.icon size="4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </x-admin.icon>
                            Delete
                        </label>
                    </li>
                </x-slot:actions>
            </x-admin.sortable.list-item>         
        @endif


            {{-- <x-admin.sortable.list-item class="grid-cols-[2rem_3fr_1fr_1fr]" wire:sortable.item="{{ $image->id }}"
                wire:key="task-{{ $image->id }}">

                <div class="justify-self-start flex items-center gap-3">
                    <div class="avatar">
                        <div class="w-16 h-16 mask mask-squircle"><img src="{{ $image->getFirstMediaUrl('default', 'sm') }}" alt=""></div>
                    </div>
                    <span>{{ $image->title }}</span>
                </div>

                <x-slot:active>
                    <input wire:click="active({{ $image->id }})" name="active" type="checkbox" class="toggle toggle-sm" @checked($image->active) />
                </x-slot:active>

                <x-slot:actions>
                    <li>
                        <div class="divider hover:bg-transparent cursor-auto uppercase">Image</div>
                    </li>
                    <li>
                        <a href="{{ route('admin.galleries.albums.images.edit', [$gallery->id, $album->id, $image->id]) }}">
                            <x-admin.icon size="4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </x-admin.icon>
                            Edit
                        </a>
                    </li>
                    <li>
                        <label wire:click="delete({{ $image->id }})" for="modal-delete">
                            <x-admin.icon size="4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </x-admin.icon>
                            Delete
                        </label>
                    </li>
                </x-slot:actions>
            </x-admin.sortable.list-item> --}}
        @endforeach
    </x-admin.sortable.list>
    @endif
</div>
