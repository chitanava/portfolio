<table>
  <thead>
  <tr>
    @foreach ($fields as $field)
    <th>{{ __('common.'.$field) }}</th>
    @endforeach
  </tr>
  </thead>
  <tbody>
    @foreach ($data as $item)
    <tr>
        @foreach ($item as $value)
        <td>{{ $value }}</td>
        @endforeach
    </tr>
    @endforeach
  </tbody>
</table>