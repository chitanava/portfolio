<x-admin.layout.app>
  <x-slot name="title">Biography</x-slot>
  
  <x-admin.page-header title="Biography" />

  <form action="{{ route('admin.biography.update') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card bg-base-100 shadow">
      <div class="card-body space-y-4">
        <div class="form-control w-full">
          <input id="x" type="hidden" name="body" value="{{ old('body', $biography->body) }}">
          <trix-editor input="x" class="trix-content textarea textarea-bordered white rounded-none min-h-[15rem]"></trix-editor>
          @error('body')
          <p class="text-xs text-error px-1 pt-2">{{ $message }}</p>
        @enderror
        </div>
      </div>
    </div>

    <div class="mt-8 xl:mt-4">
      <button type="submit" class="btn btn-accent">Update</button>
    </div>
  </form>  

  @push('header-scripts')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
  @endpush

  @push('footer-scripts')
    <script>
      (function(){
        addEventListener("trix-attachment-add", function(event) {
          const data = new FormData()
          data.append("Content-Type", event.attachment.file.type)
          data.append("file", event.attachment.file)

          axios.post("{{ route('admin.biography.attachment.add') }}", data, {
            onUploadProgress: (progressEvent) => {
              let progress = progressEvent.loaded / progressEvent.total * 100
              event.attachment.setUploadProgress(progress)
            }
          }).then((res) => {
            if(res.data.success === false){
              event.attachment.remove()
              alert(res.data.message)
            } else {
              const attributes = {
                url: res.data.url,
                file: res.data.file,
              }

              if(event.attachment.file.type === 'application/pdf'){
                attributes.href = `${res.data.url}?content-disposition=attachment`
              }

              event.attachment.setAttributes(attributes)
            }
          })
        })

        addEventListener("trix-attachment-remove", function(event) {
            axios.post("{{ route('admin.biography.attachment.remove') }}", {
              file: event.attachment.attachment.attributes.values.file,
            }).then((res) => {
              console.log(res.data)
            })
        })
      })();
    </script>
  @endpush

</x-admin.layout.app>