<div
x-data="{
  images: [],
  cache: [],
  current: null,
  total: null,
  prev: false,
  next: false,
  show: false,
  loading: false,
  drawerContent: null,

  init(){
    self = this

    this.drawerContent = document.querySelector('.drawer-content')
  
    this.images = [...document.querySelectorAll('.art-box_image')].map((el, index) => {
      el.dataset.id = index + 1

      el.addEventListener('click', function(event){
        self.open(event)
      })

      return {
        id: parseInt(el.dataset.id),
        caption: el.dataset.caption,
        path: el.dataset.path,
      }
    })

    this.total = this.images.length

    document.querySelector('#art-screen .art-image img').addEventListener('load', function(){
      self.loading = false
    })
  },

  open(event){
    const id = parseInt(event.target.dataset.id)
    {{-- this.drawerContent.scrollTo(0, 0) --}}
    this.drawerContent.classList.add('!h-full', '!overflow-hidden')
    this.show = true
    this.loading = true
    
    this.current = this.images.filter((el) => {
      return el.id == id;
    })[0]

    this.cache.push(this.current)

    this.prev = id === 1 ? 0 : id - 1
    this.next = id === this.total ? 0 : id + 1
  },

  close(){
    this.show = false
    this.current = null
    this.drawerContent.classList.remove('!h-full', '!overflow-hidden')
  }
}">

<div class="art-box">
  @foreach ($items as $item)
    @if (class_basename($item['class']) === 'Album')
    <a href="{{ route('gallery.album', [$gallery->slug, $item->slug]) }}" class="bg-slate-100 relative group">
      <img 
        src="{{ $item->getFirstMediaUrl('default', 'md') }}"
        class="object-cover cursor-pointer w-full h-full bg-gray-100 group-hover:opacity-95">
        <div class="absolute bottom-0 left-0">
          <h2 class="max-w-fit backdrop-blur-md bg-white/10 text-gray-200 font-bold text-lg px-4 py-2 text-center group-hover:text-gray-50">{{ $item->title }}</h2>
        </div>
    </a>
    @else
      <img 
        src="{{ $item->getFirstMediaUrl('default', 'md') }}"
        data-path="{{ $item->getFirstMediaUrl() }}"
        data-caption="{{ $item->caption }}" 
        class="art-box_image object-cover cursor-pointer w-full h-full bg-gray-100 hover:opacity-95">
    @endif
  @endforeach
</div>



<div x-show="show" id="art-screen" class="fixed top-0 right-0 bottom-0 left-0 lg:left-80 bg-white z-20" x-cloak>
  <div class="art-image h-full flex flex-col gap-3 justify-center items-center pl-10 pr-10 lg:pl-0 py-24 relative">
    <img class="max-w-full max-h-full" :src="current?.path" alt="">
    <div x-show="current?.caption" x-html="current?.caption" class="text-sm lg:hidden"></div>

    <div x-show="loading" class="w-full h-full bg-white absolute top-0 left-0 flex justify-center items-center" x-cloak>
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
  </div>

  <template x-teleport=".caption">
    <div x-show="show && current?.caption" class="flex flex-col gap-10" x-cloak>
      <div class="h-px bg-gray-300 devider"></div>
      <div x-html="current?.caption"></div>
    </div>
  </template>

  <div x-on:click="close()" class="absolute top-5 right-10">
    <button class="w-8 h-8 bg-gray-900 flex justify-center items-center text-white">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>

  <div class="absolute bottom-5 right-10 flex gap-2">
    <button :disabled="!prev" x-on:click="open(event)" :data-id="prev" class="w-8 h-8 bg-gray-900 flex justify-center items-center text-white disabled:bg-gray-400">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="w-6 h-6 pointer-events-none">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
      </svg>
    </button>
    <button :disabled="!next" x-on:click="open(event)" :data-id="next" class="w-8 h-8 bg-gray-900 flex justify-center items-center text-white disabled:bg-gray-400">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="w-6 h-6 pointer-events-none">
        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
      </svg>
    </button>
  </div>
</div>

<template x-for="image in cache">
  <img :src="image.path" class="hidden">
</template>
</div>