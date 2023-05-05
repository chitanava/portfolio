<x-site.layout.app>
  <x-slot name="title">Home</x-slot>
  <div
    x-data="{
      images: [],
      current: null,
      total: null,
      prev: false,
      next: false,
      show: false,

      init(){
        self = this
      
        this.images = [...document.querySelectorAll('.art-box_image')].map((el, index) => {
          el.dataset.id = index + 1

          el.addEventListener('click', function(event){
            self.preview(event)
          })

          return {
            id: parseInt(el.dataset.id),
            name: el.dataset.name,
            icon: el.dataset.icon,
            caption: el.dataset.caption,
            path: el.src
          }
        })

        this.total = this.images.length
      },

      preview(event){
        const id = parseInt(event.target.dataset.id)

        console.log(event.target)

        this.show = true
        this.current = this.images.filter((el) => {
          return el.id == id;
        })[0]

        this.prev = id === 1 ? 0 : id - 1
        this.next = id === this.total ? 0 : id + 1
      },

      close(){
        this.show = false
      }
    }"
  >
    <div class="py-10 pl-10 pr-10 lg:pl-0">
      <div class="art-box">
        <img data-caption="Lorem ipsum dolor sit amet consectetur adipisicing elit. 1" class="art-box_image"
          src="https://picsum.photos/800/700">
        <img data-caption="Lorem ipsum dolor sit amet consectetur adipisicing elit. 2" class="art-box_image"
          src="https://picsum.photos/800/701">
        <img data-caption="Lorem ipsum dolor sit amet consectetur adipisicing elit. 3" class="art-box_image"
          src="https://picsum.photos/800/702">
        <img data-caption="Lorem ipsum dolor sit amet consectetur adipisicing elit. 4" class="art-box_image"
          src="https://picsum.photos/800/703">
        <img data-caption="Lorem ipsum dolor sit amet consectetur adipisicing elit. 5" class="art-box_image"
          src="https://picsum.photos/800/704">
        <img data-caption="Lorem ipsum dolor sit amet consectetur adipisicing elit. 6" class="art-box_image"
          src="https://picsum.photos/800/705">
        <img data-caption="Lorem ipsum dolor sit amet consectetur adipisicing elit. 7" class="art-box_image"
          src="https://picsum.photos/800/706">
        <img data-caption="Lorem ipsum dolor sit amet consectetur adipisicing elit. 8" class="art-box_image"
          src="https://picsum.photos/800/707">
      </div>
    </div>

    <div x-show="show" id="art-screen" class="absolute top-0 left-0 w-full h-full bg-white">
      <div class="art-image h-full flex justify-center items-center pl-10 pr-10 lg:pl-0 py-20">
        <img class="max-w-full max-h-full m-auto" :src="current?.path" alt="">
      </div>

      <template x-teleport=".caption">
        <div x-show="show" class="flex flex-col gap-10">
          <div class="h-px bg-gray-300 devider"></div>
          <div x-text="current?.caption"></div>
        </div>
      </template>

      <div x-on:click="close()" class="absolute top-5 right-10">
        <button class="w-8 h-8 bg-gray-900 flex justify-center items-center text-white">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
            stroke="currentColor" className="w-6 h-6">
            <path strokeLinecap="round" strokeLinejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

      <div class="absolute bottom-5 right-10 flex gap-2">
        <button :disabled="!prev" x-on:click="preview(event)" :data-id="prev" class="w-8 h-8 bg-gray-900 flex justify-center items-center text-white disabled:bg-gray-400">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6 pointer-events-none">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
          </svg>
        </button>
        <button :disabled="!next" x-on:click="preview(event)" :data-id="next" class="w-8 h-8 bg-gray-900 flex justify-center items-center text-white disabled:bg-gray-400">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6 pointer-events-none">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</x-site.layout.app>