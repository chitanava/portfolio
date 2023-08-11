<div>
    <div class="card bg-base-100 shadow">
        <div class="p-4 bg-base-content font-bold text-lg rounded-t-2xl text-base-100">Tags</div>
        <div class="card-body">
            <div class="form-control space-y-3">
                @if ($tags->isNotEmpty())
                <div>
                    @foreach ($tags as $tag)
                    <div class="badge badge-ghost gap-2">
                        <svg wire:key="badge-{{ $loop->iteration }}" wire:click="removeTag('{{ $tag['name'] }}')"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block w-4 h-4 stroke-current cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span>{{ $tag['name'] }}</span>
                    </div>
                    @endforeach
                </div>
                @endif
                <input type="hidden" name="post_tags" value="{{ $tags->toJson() }}">
                <input x-init="$wire.on('inputTagAutoFocus', () => {$el.focus()})" id="foo"
                    wire:keydown.enter.prevent="addTag($event.target.value)"
                    wire:keydown.space.prevent="addTag($event.target.value)" wire:model="inputTag" type="text"
                    class="input input-bordered" />

                @if ($suggestions->isNotEmpty())
                <ul class="menu menu-compact bg-base-100 w-full p-2  shadow-lg rounded-box">
                    @foreach ($suggestions as $item)
                    <li><a wire:click.prevent="addTag($event.target.textContent)">{{ $item->name }}</a></li>
                    @endforeach
                </ul>
                @endif

                <p class="text-xs px-1 pt-2 base-content">Type Something and Hit <kbd class="kbd">ENTER</kbd> or <kbd
                        class="kbd">SPACE</kbd></p>
            </div>
        </div>
    </div>
</div>