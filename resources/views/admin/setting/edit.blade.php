<x-admin.layout.app>
  <x-slot name="title">Settings</x-slot>
  
  <x-admin.page-header title="Settings" />
  
  <form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="space-y-8">
      <div class="card bg-base-100 shadow col-span-3 xl:col-span-1">
        <div class="p-4 bg-base-content font-bold text-lg rounded-t-2xl text-base-100">General</div>
        <div class="card-body space-y-4">
          <div class="form-control w-full">
            <label for="app_name" class="label">
              <span class="label-text">App Name</span>
            </label>
            <input type="text" name="app_name" value="{{ old('app_name', $settings->app_name) }}" id="app_name" class="input input-bordered" />
            <p class="text-xs px-1 pt-2 base-content">Default: Zautashvili</p>
            @error('app_name')
              <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
            @enderror
          </div>
        </div>
      </div>

      <div class="card bg-base-100 shadow col-span-3 xl:col-span-1">
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

      <div class="card bg-base-100 shadow col-span-3 xl:col-span-1">
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