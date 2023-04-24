<input type="checkbox" id="modal-delete" class="modal-toggle" />
<div 
  class="modal"
  x-data="{ 
    action: '',
    title: '',
    body: '',
  }" 
  x-init="() => {
    Livewire.on('delete', (payload) => {
      action = payload.action
      title = payload.title
      body = payload.body
    })
  }" 
>
  <div class="modal-box">
    <h2 class="font-bold text-2xl mb-4">Delete Confirmation</h2>
      <template x-if="title">
        <h3 x-text="title" class="font-bold text-lg"></h3>
      </template>
      <template x-if="body">
        <p x-text="body" class="text-sm"></p>
      </template>

    <div class="modal-action">
      <form  
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