<div wire:init="loadAnalyticsData" class="shadow rounded-2xl p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold">{{ $title }}</h3>
        <select wire:model="analyticsDays" class="select select-bordered w-full max-w-xs">
            <option value="1">Today</option>
            <option value="2">Yesterday</option>
            <option value="7">Last 7 days</option>
            <option value="14">Last 14 days</option>
            <option value="30">Last 30 days</option>
        </select>
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
                        <th @if(in_array($field, $centerFields)) class="text-center"  @endif>{{ __('common.'.$field) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody wire:loading.class="opacity-10">
                    @foreach ($data as $item)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        @foreach ($item as $key => $value)
                        <td @if(in_array($key, $centerFields)) class="text-center"  @endif>
                            @if (in_array($key, $forHumans))
                            {{ $value->diffForHumans() }}
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