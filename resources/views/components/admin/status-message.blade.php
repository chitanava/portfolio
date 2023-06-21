@props([
'isLivewire' => false
])

<div x-data="{
  @if($isLivewire) 
    show: false, 
  @else 
    show: true, 
  @endif
  @if($isLivewire) 
    msg: '', 
  @endif
  _t: undefined,
  timeout(){
    this._t = setTimeout(() => this.show = false, 5000);
  }
}" x-init="
  @if($isLivewire)
    document.addEventListener('lwStatusMessage', (e) => {
      show = true
      msg = e.detail
      clearTimeout(_t)
      timeout()
    })
  @else
    timeout();
  @endif
" x-on:mouseenter="clearTimeout(_t)" x-on:mouseleave="timeout()" x-show="show" x-cloak
  class="alert alert-success shadow-sm">
  <div>
    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-5 w-5" fill="none"
      viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    @if($isLivewire)
    <span x-text="msg" class="text-sm"></span>
    @else
    <span class="text-sm">{{ session('status') }}</span>
    @endif
  </div>
</div>