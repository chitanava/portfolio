<ul 
  x-data="{
  itemWidth: '',
  adjustWidth () {
      const sortableList = document.querySelector('#sortable-list')
      this.itemWidth = sortableList.offsetWidth
  }
  }" 
  x-init="adjustWidth"
  x-on:resize.window="adjustWidth"
  id="sortable-list"
  {{ $attributes }}>
  
  {{ $slot }}
  
</ul>