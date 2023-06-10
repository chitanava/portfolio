<x-admin.layout.app>
  <x-slot name="title">Settings</x-slot>
  
  <x-admin.page-header title="Settings" />
  
  <form action="{{ route('admin.settings.update') }}" method="POST">
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
        <div class="p-4 bg-base-content font-bold text-lg rounded-t-2xl text-base-100">Custom CSS</div>
        <div class="card-body space-y-4">
          <div class="form-control w-full">
            <textarea name="custom_css" id="code">{{ old('custom_css', $settings->custom_css) }}</textarea>
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
      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        lineNumbers: true,
        theme: 'dracula',
        matchBrackets: true,
        mode: "text/css",
        indentUnit: 2,
        indentWithTabs: true,
        tabSize: 2,
        lineWrapping: true,
        setTize: '800px'
      });

      editor.setSize('100%', '270px')
    </script>
  @endpush

</x-admin.layout.app>