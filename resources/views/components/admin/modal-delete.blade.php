<input type="checkbox" id="modal-delete" class="modal-toggle" />
<div class="modal">
  <div class="modal-box">
    <h2 class="font-bold text-2xl mb-4">Delete Confirmation</h2>
    @if (isset($body))
      <h3 class="font-bold text-lg">{{ $title }}</h3>
      <p class="text-sm">{{ $body }}</p>
    @else
      <h3>{{ $title }}</h3>
    @endif
    <div class="modal-action">
      <form 
        x-data="{ action: '' }" 
        x-init="() => {
          Livewire.on('delete', (payload) => {
            action = payload
          })
        }"  
        :action="action" 
        method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-secondary">Yes, Delete</button>
      </form>
      <label for="modal-delete" class="btn btn-active btn-ghost">Close</label>
    </div>
  </div>
</div>