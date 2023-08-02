<div x-data='{
    hiddenItems: [],
    viewAll(e){
        this.hiddenItems.forEach(item => item.classList.remove("hidden"));
        e.target.closest("div").remove();
    },
    init(){
        $wire.on("dataIsFetched", () => {
            const items = [...$el.querySelectorAll("tbody tr")];
            this.hiddenItems = items.slice(5);

            this.hiddenItems.forEach(item => item.classList.add("hidden"));

            if(items.length > 5) {
                const viewAllBtn = `<div class="mt-5 text-right"><button class="btn btn-warning btn-sm btn-outline no-animation" x-on:click="viewAll">View All Data</button></div>`;
                
                $el.querySelector(".overflow-x-auto").insertAdjacentHTML("afterend", viewAllBtn);
            }
        })
    },
}' wire:init="loadAnalyticsData" class="shadow rounded-2xl p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold">{{ $title }}</h3>
        <div class="flex items-center gap-4">
            <select wire:model="analyticsDays" class="select select-bordered">
                <option value="0">Today</option>
                <option value="1">Yesterday</option>
                <option value="6">Last 7 days</option>
                <option value="13">Last 14 days</option>
                <option value="29">Last 30 days</option>
            </select>
            @if(count($data))
            <livewire:admin.retrieve-analytics-data-export-dropdown :method="$method" :title="$title" :wire:key="Str::slug($title)"/>
            @endif
        </div>
    </div>

    <div class="relative">
        <div wire:loading.block class="text-center absolute @if (count($data))top-[calc(50%_+_24px)] @else top-1/2
 @endif left-1/2 -translate-x-1/2 -translate-y-1/2 z-10">
            Loading Data...
        </div>
        <div class="overflow-x-auto">
            @if(count($data))
            <table class="table w-full">
                <thead>
                    <tr>
                        <th></th>
                        @foreach ($fields as $field)
                        <th @if(in_array($field, $centerFields)) class="text-center" @endif>{{ __('common.'.$field) }}
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody wire:loading.class="opacity-10">
                    @foreach ($data as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        @foreach ($item as $key => $value)
                        <td @if(in_array($key, $centerFields)) class="text-center" @endif>
                            @if (in_array($key, $forHumans))
                            {{ differenceInDays($value) }}
                            @else
                            {{ $value }}
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div wire:loading.class="invisible" class="text-center py-10">
                {{ $message }}
            </div>
            @endif
        </div>
    </div>
</div>