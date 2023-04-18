

<div>
    <ul wire:sortable="updateTaskOrder">
        @foreach ($tasks as $k => $task)
            <li wire:sortable.item="{{ $task['id'] }}:{{ $task['model'] }}"  wire:key="task-{{ $task['ord'] }}">
                <h4 wire:sortable.handle>{{ $task['title'] }}</h4>
            </li>
        @endforeach
    </ul>
</div>
