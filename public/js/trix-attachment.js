(function(){
  const trixContentEl = document.querySelector('.trix-content');
  const trixAttachmentAddUrl = trixContentEl.dataset.trixAttachmentAddUrl;
  const trixAttachmentRemoveUrl = trixContentEl.dataset.trixAttachmentRemoveUrl;
  
  addEventListener("trix-attachment-add", function(event) {
    const data = new FormData()
    data.append("Content-Type", event.attachment.file.type)
    data.append("file", event.attachment.file)

    axios.post(trixAttachmentAddUrl, data, {
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
      axios.post(trixAttachmentRemoveUrl, {
        file: event.attachment.attachment.attributes.values.file,
      }).then((res) => {
        console.log(res.data)
      })
  })
})();