<div>
    <div class="lg:w-2/3 grid lg:grid-cols-3 gap-6">
        <div class="lg:order-last space-y-8">
            <div class="space-y-2">
                <div class="relative">
                    <form wire:submit.prevent="search">
                    <input wire:model.defer="searchKey"
                        type="text"
                        class="block w-full pl-2 pr-10 py-2 text-sm text-gray-900 border border-gray-300 focus:outline-none focus:border-gray-400 placeholder-gray-400"
                        placeholder="Search here">
                        @if ($search)
                        <div wire:click="resetSearch" class="absolute top-1/2 -translate-y-1/2 right-10 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                          </div>
                        @endif
                    <div class="absolute right-1.5 top-1/2 -translate-y-1/2">
                        <button type="submit"
                            class="w-7 h-7 bg-gray-900 flex justify-center items-center text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </button>
                    </div>
                </form>
                </div>
                @error('searchKey')<div class="text-xs leading-tight">{{ $message }}</div>@enderror
            </div>
            <div>
                <h3 class="text-lg font-bold mb-2">Tags</h3>
                <div>
                    @foreach ($tagsData as $indx => $tag)
                    @if (in_array($tag->slug, $tags))
                    <a wire:click.prevent="$set('tags.{{ $tag->order_column }}', null)" class="text-gray-900 hover:text-gray-900"
                        href="">
                        @else
                        <a wire:click.prevent="$set('tags.{{ $tag->order_column }}', '{{ $tag->slug }}')"
                            class="text-gray-500 hover:text-gray-900" href="">
                            @endif
                            {{ $tag->name }}</a>@if( !$loop->last),@endif
                        @endforeach
                </div>
            </div>
            <div 
                x-data 
                x-intersect:leave="$store.scrollToTop = true" 
                x-intersect:enter="$store.scrollToTop = false">
            </div>
        </div>
        <div x-data="{
        loadMore: @entangle('showLoadMore')
    }" class="lg:col-span-2">
            <div class="flex flex-col gap-10">
                @foreach ($posts as $post)
                @if (!$loop->first)
                <hr> 
                @endif
                <div wire:key="{{ $post->slug }}" class="item">
                    @if ($post->media->isNotEmpty())
                    <div class="mb-2">
                        <a href="{{ route('posts.show', $post->slug) }}" class="inline-block"><img src="{{ $post->media[0]->getUrl('md') }}"
                                alt="{{ $post->title }}"></a>
                    </div>
                    @endif
                    <div>
                        <h2 class="font-bold text-lg mb-4"><a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a></h2>
                        <p class="text-xs text-gray-400 mb-2 italic">{{ $post->published_at->format('F d, Y')}}
                        </p>
                        <p class="mb-4">{{ Str::words(strip_tags($post->body), 20, '...') }}</p>
                        <p class="text-sm"><a class="text-gray-500 hover:text-gray-900" href="{{ route('posts.show', $post->slug) }}">Read More</a></p>
                    </div>
                </div>
                
                @endforeach
                <div wire:loading wire:target="loadMore" aria-label="Loading..." role="status">
                    <svg class="h-6 w-6 animate-spin m-auto" viewBox="3 3 18 18">
                        <path class="fill-gray-200"
                            d="M12 5C8.13401 5 5 8.13401 5 12C5 15.866 8.13401 19 12 19C15.866 19 19 15.866 19 12C19 8.13401 15.866 5 12 5ZM3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12Z">
                        </path>
                        <path class="fill-gray-800"
                            d="M16.9497 7.05015C14.2161 4.31648 9.78392 4.31648 7.05025 7.05015C6.65973 7.44067 6.02656 7.44067 5.63604 7.05015C5.24551 6.65962 5.24551 6.02646 5.63604 5.63593C9.15076 2.12121 14.8492 2.12121 18.364 5.63593C18.7545 6.02646 18.7545 6.65962 18.364 7.05015C17.9734 7.44067 17.3403 7.44067 16.9497 7.05015Z">
                        </path>
                    </svg>
                </div>
            </div>

            <div wire:key="{{ rand() }}" x-show="loadMore" x-cloak x-data="{
                observe () {
                    let observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                @this.call('loadMore')
                            }
                        })
                    }, {
                        root: null,
                    })
        
                    observer.observe(this.$el)
                }
            }" x-init="observe"></div>
        </div>
    </div>
    <div 
        x-data 
        x-show="$store.scrollToTop" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-full"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-full"
        x-cloak
        class="hidden lg:block fixed bottom-10 right-14">
        <button x-data x-on:click="document.querySelector('.drawer-content').scrollTo({ top: 0, behavior: 'smooth' })"
            class="w-7 h-7 bg-gray-900 opacity-30 hover:opacity-100 transition-opacity duration-200 flex justify-center items-center text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
            </svg>
        </button>
    </div>
</div>