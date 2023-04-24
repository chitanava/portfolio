import './bootstrap';

import Alpine from 'alpinejs'

import Trix from "trix"
 
window.Alpine = Alpine
 
Alpine.start()

document.addEventListener("trix-before-initialize", () => {
  // Change Trix.config if you need
})