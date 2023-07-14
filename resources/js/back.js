import './bootstrap';
import Alpine from 'alpinejs' 
import Trix from "trix"

document.addEventListener("trix-before-initialize", () => {
  Trix.config.attachments.preview.caption.name = false 
  Trix.config.attachments.preview.caption.size = false
  Trix.config.attachments.file.caption.size = false
})

 window.Alpine = Alpine
 Alpine.start()
 