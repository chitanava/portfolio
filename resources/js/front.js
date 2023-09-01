import './bootstrap';
import Alpine from 'alpinejs'
import intersect from '@alpinejs/intersect'

window.Alpine = Alpine
Alpine.plugin(intersect)
Alpine.store('app', {
  scrollToTop: false,
  showHomeSliderControls: false,
})
Alpine.start()