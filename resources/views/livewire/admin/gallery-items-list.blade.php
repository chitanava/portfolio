<div>
    @if ($data->isEmpty())
        <div>No items found. Please add new content to display.</div>
    @else
        <x-admin.sortable.head class="grid-cols-[2rem_3fr_3fr_1fr_1fr]" :cols="['title', 'type']" />
    
        <x-admin.sortable.list wire:sortable="updateOrder">
            @foreach ($data as $item)
                @if (class_basename($item['class']) === 'Album')
                    <x-admin.sortable.list-item 
                        class="grid-cols-[2rem_3fr_3fr_1fr_1fr]" 
                        wire:sortable.item="{{ $item['id'] }}:{{ $item['class'] }}"
                        wire:key="task-{{ $loop->iteration }}">
            
                        <div class="justify-self-start flex items-center gap-3">
                            <div class="avatar">
                                <div class="w-16 h-16 mask mask-squircle"><img src="{{ $item->getFirstMediaUrl('default', 'sm') }}" alt=""></div>
                            </div>
                            <a class="hover:underline underline-offset-4" href="{{ route('admin.galleries.albums.show', [$gallery->id, $item['id']]) }}">{{ $item['title'] }}</a>
                        </div>

                        <div class="justify-self-start">
                            {{ class_basename($item['class']) }}
                        </div>
            
                        <x-slot:active>
                            <input wire:click="active({{ $item['id'] }}, '{{ addslashes($item['class']) }}')" name="active" type="checkbox" class="toggle toggle-sm" @checked($item['active']) />
                        </x-slot:active>
            
                        <x-slot:actions>
                            <li>
                                <div class="divider hover:bg-transparent cursor-auto uppercase">Album</div>
                            </li>
                            <li>
                                <a href="{{ route('admin.galleries.albums.show', [$gallery->id, $item['id']]) }}">
                                    <x-admin.icon size="4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                                    </x-admin.icon>
                                    Open
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.galleries.albums.edit', [$gallery->id, $item['id']]) }}">
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
                            <li>
                                <div class="divider hover:bg-transparent cursor-auto">OR</div>
                            </li>
                            <li>
                                <a href="{{ route('admin.galleries.albums.images.create', [$gallery->id, $item['id']]) }}">
                                    <x-admin.icon size="4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </x-admin.icon>
                                    Add image 
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.galleries.albums.videos.create', [$gallery->id, $item['id']]) }}">
                                    <x-admin.icon size="4">
                                        <path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                                    </x-admin.icon>
                                    Add video 
                                </a>
                            </li>
                        </x-slot:actions>
                    </x-admin.sortable.list-item>            
                @elseif (class_basename($item['class']) === 'Video')
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
                                <a href="{{ route('admin.galleries.videos.edit', [$gallery->id, $item['id']]) }}">
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
                                <a href="{{ route('admin.galleries.images.edit', [$gallery->id, $item['id']]) }}">
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
            @endforeach
        </x-admin.sortable.list>
    @endif
</div>
