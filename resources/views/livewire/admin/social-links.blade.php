<div>
    <div class="card bg-base-100 shadow">
        <div class="card-body space-y-4">
            <div class="grid grid-cols-[3fr_1fr_auto] gap-4">
                @foreach($inputs as $key => $input)
                <div class="form-control w-full">
                    <input type="text" wire:model.defer="inputs.{{$key}}.url" class="input input-bordered"
                        placeholder="URL" autocomplete="off" />
                    @error('inputs.'.$key.'.url')
                    <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-control w-full">
                    <input type="text" wire:model.defer="inputs.{{$key}}.icon_slug" class="input input-bordered"
                        placeholder="Icon slug" autocomplete="off" />
                    @error('inputs.'.$key.'.icon_slug')
                    <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
                    @enderror
                </div>
                <button wire:click="removeInput({{$key}})" class="mt-2 btn btn-square btn-sm btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
                @endforeach

                <div class="place-self-end col-span-2">
                    <button wire:click="addInput" type="submit"
                        class="btn btn-sm btn-link text-base-content no-underline hover:no-underline">Add New
                        Link</button>
                </div>
            </div>
        </div>
    </div>
    <p class="text-xs px-1 pt-2 base-content mt-2">To display the appropriate icon for a social link,
        please provide the corresponding icon slug for each URL. You can refer to the list of available
        icon slugs on the <a href="https://simpleicons.org/" target="_blank" class="text-secondary-focus">Simple
            Icons</a> website.</p>
    <div class="mt-4">
        <button wire:click="submit" class="btn btn-accent">Update</button>
    </div>
</div>