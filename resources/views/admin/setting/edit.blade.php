<x-admin.layout.app>
  <x-slot name="title">Settings</x-slot>
  
  <x-admin.page-header title="Settings" />
  
  <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="space-y-8">
      <div class="card bg-base-100 shadow">
        <div class="p-4 bg-base-content font-bold text-lg rounded-t-2xl text-base-100">General</div>
        <div class="card-body space-y-4">
          <div class="form-control w-full">
            <label for="app_name" class="label">
              <span class="label-text">App Name</span>
            </label>
            <input type="text" name="app_name" value="{{ old('app_name', $settings->app_name) }}" id="app_name" class="input input-bordered" />
            <p class="text-xs px-1 pt-2 base-content">Default: {{ config('app.name') }}</p>
            @error('app_name')
              <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
          </div>
          
          <div class="form-control items-start">
            <label class="label cursor-pointer gap-4">
              <span class="label-text">Blog</span> 
              <input type="hidden" name="blog" value="0">
              <input type="checkbox" name="blog" value="1" class="toggle" @checked(old('blog', $settings->blog)) />
            </label>
            <p class="text-xs px-1 pt-2 base-content">Enabling the blog will allow it to be shown in the navigation of the site.</p>
            @error('blog')
              <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
          </div>

          <div class="form-control items-start">
            <label class="label cursor-pointer gap-4">
              <span class="label-text">Default Fonts</span> 
              <input type="hidden" name="default_fonts" value="0">
              <input type="checkbox" name="default_fonts" value="1" class="toggle" @checked(old('default_fonts', $settings->default_fonts)) />
            </label>
            @error('default_fonts')
              <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
          </div>

          <div class="form-control items-start">
            <label class="label cursor-pointer gap-4">
              <span class="label-text">Maintenance Mode</span> 
              <input type="hidden" name="maintenance_mode" value="0">
              <input type="checkbox" name="maintenance_mode" value="1" class="toggle" @checked(old('maintenance_mode', $settings->maintenance_mode)) />
            </label>
            @error('maintenance_mode')
              <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
            @if ($settings->maintenance_mode && $settings->maintenance_token)
              <div class="mt-3 alert shadow-lg">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  <p class="text-sm">You can access the application by using the token <span class="text-secondary-focus">{{ $settings->maintenance_token }}</span> in the URL.</p>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>

      <div class="card bg-base-100 shadow">
        <div class="p-4 bg-base-content font-bold text-lg rounded-t-2xl text-base-100">Home Page</div>
        <div class="card-body space-y-4">
          <div class="form-control w-full">
            <div class="px-1 label-text">Home Bank</div>
            <p class="text-xs px-1 pt-2 base-content mb-3">Please select the galleries and albums from which you want to display images on the home page.</p>
            <div class="flex flex-col sm:gap-8 sm:flex-row">
              @if ($galleries->isEmpty() && $albums->isEmpty())
                <div class="alert alert-warning shadow-lg">
                  <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                    <span class="text-sm">Oops! It seems like there are no galleries or albums to display.</span>
                  </div>
                </div>
              @endif

              @if ($galleries->isNotEmpty())                  
                <div>
                  @foreach ($galleries as $gallery)                    
                    <label class="label cursor-pointer">
                      <span class="label-text mr-3">{{ $gallery->title }}</span> 
                      <input type="checkbox" name="gallery_bank[]" value="{{ $gallery->id }}" @checked($gallery->home_bank) class="checkbox checkbox-accent checkbox-sm" />
                    </label>
                  @endforeach
                </div>
              @endif
              @if ($albums->isNotEmpty())    
                <div>
                  @foreach ($albums as $album)                    
                    <label class="label cursor-pointer">
                      <span class="label-text mr-3">{{ $album->title }}</span> 
                      <input type="checkbox" name="album_bank[]" value="{{ $album->id }}" @checked($album->home_bank) class="checkbox checkbox-accent checkbox-sm" />
                    </label>
                  @endforeach
                </div>
              @endif
            </div>
            @error('gallery_bank')
                <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
            @error('album_bank')
              <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
          </div>
          <div class="form-control w-full">
            <label for="home_images" class="label">
              <span class="label-text">Number of Images</span>
            </label>
            <input type="text" name="home_images" value="{{ old('home_images', $settings->home_images) }}" id="home_images" class="input input-bordered" />
            <p class="text-xs px-1 pt-2 base-content">Please enter the number of images you would like to appear on the home page.</p>
            <p class="text-xs px-1 pt-2 base-content">Default: {{ config('settings.home_images') }}</p>
            @error('home_images')
              <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>

      <div class="card bg-base-100 shadow">
        <div class="p-4 bg-base-content font-bold text-lg rounded-t-2xl text-base-100">SEO</div>
        <div class="card-body space-y-4">
          <div class="form-control w-full">
            <label for="description" class="label">
              <span class="label-text">Description</span>
            </label>
            <input type="text" name="seo_description" value="{{ old('seo_description', $settings->seo_description) }}" id="description" class="input input-bordered" />
            @error('seo_description')
              <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
          </div>

          <div class="form-control w-full">
            <label for="keywords" class="label">
              <span class="label-text">Keywords</span>
            </label>
            <input type="text" name="seo_keywords" value="{{ old('seo_keywords', $settings->seo_keywords) }}" id="keywords" class="input input-bordered" />
            <p class="text-xs px-1 pt-2 base-content">Please input the keywords for the site, separating each one with a comma.</p>
            @error('seo_keywords')
              <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>

      <div class="card bg-base-100 shadow">
        <div class="p-4 bg-base-content font-bold text-lg rounded-t-2xl text-base-100">Analytics</div>
        <div class="card-body space-y-4">
          <div class="form-control w-full">
            <label for="" class="label">
              <span class="label-text">Google Tag</span>
            </label>
            <textarea class="code" data-editor-height="170" name="google_tag" class="textarea textarea-bordered rounded-lg">{{ old('google_tag',$settings->google_tag) }}</textarea>
            @error('google_tag')
              <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
          </div>
          <div x-data="{
              showConfiguration: {{ old('analytics_retrieve_data', $settings->analytics_retrieve_data) }},
              showUploadForm: {{ Storage::disk('analytics')->exists(env('ANALYTICS_SECRET_JSON')) ? 0 : 1 }},
              deleteFile: false,
            }"
            class="space-y-4">
            <div class="form-control items-start">
              <label class="label cursor-pointer gap-4">
                <span class="label-text">Retrieve Data</span> 
                <input type="hidden" name="analytics_retrieve_data" value="0">
                <input x-on:click="showConfiguration = !showConfiguration" type="checkbox" name="analytics_retrieve_data" value="1" class="toggle" @checked(old('analytics_retrieve_data', $settings->analytics_retrieve_data)) />
              </label>
              <p class="text-xs px-1 pt-2 base-content">After enabling data retrieval, the current data from Google Analytics will appear on the dashboard.</p>
              @error('analytics_retrieve_data')
                <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
              @enderror
            </div>

            <div x-show="showConfiguration" class="space-y-4" x-cloak>
              <div class="form-control w-full">
                <label for="analytics_property_id" class="label">
                  <span class="label-text">Property ID</span>
                </label>
                <input type="text" name="analytics_property_id" value="{{ old('analytics_property_id', $settings->analytics_property_id) }}" id="analytics_property_id" class="input input-bordered" />
                @error('analytics_property_id')
                  <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
                @enderror
              </div>

              <div class="form-control w-full">
                <label for="" class="label">
                  <span class="label-text">Account Credentials</span>
                </label>

                <div x-show="!showUploadForm" x-cloak class="w-full relative">
                  <div class="absolute top-0 right-0 translate-x-2 -translate-y-2">
                      <button x-on:click.prevent="showUploadForm = true; deleteFile = true;" class="btn btn-square btn-xs btn-secondary">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                              stroke="currentColor" class="w-4 h-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                          </svg>
                      </button>
                  </div>
                  <div class="grid w-full h-12 rounded-full bg-base-300 place-items-center">
                      <a href="{{ route('admin.settings.analytics.download', env('ANALYTICS_SECRET_JSON')) }}">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                              stroke="currentColor" class="w-4 h-4 inline mr-1">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                          </svg>
          
                          <span class="text-sm">{{ env('ANALYTICS_SECRET_JSON') }}</span>
                      </a>
                  </div>
                  <input type="hidden" name="delete_file" x-model="deleteFile">
                </div>
                
                <div x-show="showUploadForm" x-cloak>
                  <input type="file" name="analytics_secret_json" class="file-input file-input-bordered file-input-ghost w-full" />
                  @error('analytics_secret_json')
                    <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card bg-base-100 shadow">
        <div class="p-4 bg-base-content font-bold text-lg rounded-t-2xl text-base-100">Custom CSS</div>
        <div class="card-body space-y-4">
          <div class="form-control w-full">
            <textarea name="custom_css" class="code" data-editor-height="270">{{ old('custom_css', $settings->custom_css) }}</textarea>
            @error('custom_css')
              <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>

      <div>
        <button type="submit" class="btn btn-accent">Update</button>
      </div>
    </div>
  </form>  

  @push('header-scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/theme/dracula.min.css">
    <style>
      .cm-s-dracula {
        border-radius: .8rem;
        padding: .8rem 0;
      }
    </style>
  @endpush

  @push('footer-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/addon/edit/matchbrackets.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/6.65.7/mode/css/css.min.js"></script>

    <script>
      const renderEditor = function(el) {
        const editor = CodeMirror.fromTextArea(el, {
          lineNumbers: true,
          theme: 'dracula',
          matchBrackets: true,
          indentUnit: 2,
          indentWithTabs: true,
          tabSize: 2,
          lineWrapping: true,
        });
        
        editor.setSize('100%', `${el.dataset.editorHeight}px`);
      };

      [...document.querySelectorAll('.code')].forEach(el => {
        renderEditor(el);
      })
    </script>
  @endpush

</x-admin.layout.app>