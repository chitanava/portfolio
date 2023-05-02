<x-admin.layout.app>
  <x-slot name="title">Settings</x-slot>
  
  <x-admin.page-header title="Settings" />

  <form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card bg-base-100 shadow col-span-3 xl:col-span-1">
      <div class="p-4 bg-base-content font-bold text-lg rounded-t-2xl text-base-100">Custom CSS</div>
      <div class="card-body space-y-4">
        <div class="form-control w-full">
          <textarea name="custom_css" id="code">{{ $settings->custom_css }}</textarea>
        </div>
      </div>
    </div>

    <div class="mt-8 xl:mt-4">
      <button type="submit" class="btn btn-accent">Update</button>
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