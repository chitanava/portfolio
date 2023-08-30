@props([
  'isLivewire' => false
])

<input type="checkbox" id="modal-delete" class="modal-toggle" />
<div 
  class="modal"
  x-data="{ 
    action: '',
    title: '',
    body: '',
    pending: false,
    @if ($isLivewire)      
    trigger: {
      ['@click.debounce']() {
        const data = JSON.parse(this.action);
        Livewire.emit(data.action, data.id)
      },
    },
    @endif
  }" 
  x-init="() => {
    Livewire.hook('message.sent', (message, component) => {
      pending = true
    })
    Livewire.hook('message.processed', (message, component) => {
      pending = false
    })
    Livewire.on('delete', (payload) => {
      action = payload.action
      title = payload.title
      body = payload.body
    })
  }" 
>
  <div x-show="pending" x-cloak>
    <div aria-label="Loading..." role="status">
      <svg class="h-6 w-6 animate-spin" viewBox="3 3 18 18">
        <path
          class="fill-gray-200"
          d="M12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5ZM3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12Z"></path>
        <path
          class="fill-gray-800"
          d="M16.9497 7.05015C14.2161 4.31648 9.78392 4.31648 7.05025 7.05015C6.65973 7.44067 6.02656 7.44067 5.63604 7.05015C5.24551 6.65962 5.24551 6.02646 5.63604 5.63593C9.15076 2.12121 14.8492 2.12121 18.364 5.63593C18.7545 6.02646 18.7545 6.65962 18.364 7.05015C17.9734 7.44067 17.3403 7.44067 16.9497 7.05015Z"></path>
      </svg>
    </div>
  </div>

  <div x-show="!pending" class="modal-box">
    <h2 class="font-bold text-2xl mb-4">Delete Confirmation</h2>
      <template x-if="title">
        <h3 x-text="title" class="font-bold text-lg"></h3>
      </template>
      <template x-if="body">
        <p x-text="body" class="text-sm"></p>
      </template>

    <div class="modal-action">
      @if ($isLivewire)
      <label for="modal-delete"
        <button x-bind="trigger" class="btn btn-secondary">Yes, Delete</button>
      </label>
      @else
      <form  
        :action="action" 
        method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-secondary">Yes, Delete</button>
      </form>
      @endif

      <label for="modal-delete" class="btn btn-active btn-ghost">Close</label>
    </div>
  </div>
</div>