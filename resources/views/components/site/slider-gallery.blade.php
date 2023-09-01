<div x-data="{
  images: @js($images),
  activeIndex: 0,
  loadedAmount: 0,
  pending: true,
  interval: 5000,
  paused: false,
  t: undefined,
  next() {
    if (event?.target.closest('button')?.dataset.pause || event?.type === 'swiped-left') this.pause();
    this.activeIndex = (this.activeIndex + 1) % this.images.length;
  },
  play() {
    this.t = setInterval(this.next.bind(this), this.interval);
    this.paused = false;
  },
  pause(){
    clearInterval(this.t);
    this.paused = true;
  },
  prev(){
    if (event?.target.closest('button')?.dataset.pause || event?.type === 'swiped-right') this.pause();
    this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;
  },
  handleLoad(){
    this.loadedAmount++;
    if(this.loadedAmount === this.images.length) {
      this.pending = false;

      if(this.images.length > 1)
      $store.app.showHomeSliderControls = true;

      this.play();
    }
  },
  init(){
    document.querySelector('#slider-gallery').addEventListener('swiped-right', (e) => {
      this.prev();
    });
    
    document.querySelector('#slider-gallery').addEventListener('swiped-left', (e) => {
      this.next();
    });
  }
}">
  <div id="slider-gallery" class="fixed top-16 right-0 bottom-0 left-0 lg:left-80 lg:top-0">
    <div x-show="pending" x-cloak class="absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2">
      <svg class="h-6 w-6 animate-spin m-auto" viewBox="3 3 18 18">
        <path class="fill-gray-200"
          d="M12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5ZM3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12Z">
        </path>
        <path class="fill-gray-800"
          d="M16.9497 7.05015C14.2161 4.31648 9.78392 4.31648 7.05025 7.05015C6.65973 7.44067 6.02656 7.44067 5.63604 7.05015C5.24551 6.65962 5.24551 6.02646 5.63604 5.63593C9.15076 2.12121 14.8492 2.12121 18.364 5.63593C18.7545 6.02646 18.7545 6.65962 18.364 7.05015C17.9734 7.44067 17.3403 7.44067 16.9497 7.05015Z">
        </path>
      </svg>
    </div>

    <div x-show="!pending" x-cloak>
      <template x-for="(image, index) in images" :key="index">
        <img :src="image" @load="handleLoad"
          :class="{ 'opacity-0': index !== activeIndex, 'opacity-100': index === activeIndex }"
          class="transition-opacity duration-500 max-w-full max-h-full p-10 absolute top-1/2 -translate-y-1/2 left-1/2 -translate-x-1/2"
          x-cloak />
      </template>
    </div>

    <template x-teleport=".slider-controls">
      <div class="space-y-10">
        <hr>
        <div class="leading-4">
          <div>
            <button x-show="!paused" @click="pause"><span
                class="uppercase text-[11px] text-gray-600">Pause</span></button>
            <button x-show="paused" @click="play"><span class="uppercase text-[11px] text-gray-600">Play</span></button>
          </div>
          <div>
            <button data-pause="true" @click="prev"><span
                class="uppercase text-[11px] text-gray-600">Prev</span></button>
            <span class="text-[8px] before:content-['\002F'] text-gray-600"></span>
            <button data-pause="true" @click="next"><span
                class="uppercase text-[11px] text-gray-600">Next</span></button>
          </div>
        </div>
      </div>
    </template>
  </div>
</div>

@push('footer-scripts')
<script src="{{ asset('js/swiped-events.min.js') }}"></script>
@endpush